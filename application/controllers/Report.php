<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'report_model',
			'doctor_model',
			'representative_model',
			'department_model',
		));
 
// 		if ($this->session->userdata('isLogIn') == false
// 			|| $this->session->userdata('user_role') != 1) 
// 			redirect('login'); 

        if ($this->session->userdata('isLogIn') == false)
        redirect('login'); 
		
	}
 

	//Assign By Count
	public function assign_by_all()
	{  
		$data['title'] = display('appointment_assign_by_all');
		#-------------------------------#
		$data['date'] = (object)$getData = array(  	
			'start_date' => date('Y-m-d', strtotime(($this->input->post('start_date',true) != null)? $this->input->post('start_date',true): date('Y-m-d'))),
			'end_date' => date('Y-m-d', strtotime(($this->input->post('end_date',true) != null)? $this->input->post('end_date',true): date('Y-m-d'))), 
		);
		#-------------------------------#
    	$data['appointments'] = $this->report_model->assign_by_all($getData);
		$data['content'] = $this->load->view('report_assign_by_all',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 

	//Assign by doctor
	public function assign_by_all_doctor()
	{  
		$data['title'] = display('appointment_assign_by_doctor');
		#-------------------------------#
		$data['user'] = (object)$getData = [
			'start_date' => $this->input->get('start_date',true),
			'end_date'	 => $this->input->get('end_date',true),	
			'user_id'	 => $this->input->get('user_id',true)
		];
		#-------------------------------#
    	$data['user_list'] = $this->doctor_model->doctor_list();
    	$data['appointments'] = $this->report_model->assign_by_user($getData);
		$data['content'] = $this->load->view('report_assign_by_all_doctor',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 
 
	public function assign_by_all_representative()
	{  
		$data['title'] = display('appointment_assign_by_representative');
		#-------------------------------#
		$data['user'] = (object)$getData = [
			'start_date' => $this->input->get('start_date',true),
			'end_date'	 => $this->input->get('end_date',true),	
			'user_id'	 => $this->input->get('user_id',true)
		];
		#-------------------------------#
    	$data['user_list'] = $this->representative_model->representative_list();
    	$data['appointments'] = $this->report_model->assign_by_user($getData);
		$data['content'] = $this->load->view('report_assign_by_all_representative',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 


	public function assign_to_all_doctor()
	{   
		$data['title'] = display('appointment_assign_to_all_doctor');
		#-------------------------------#
		$data['user'] = (object)$getData = [
			'start_date' => $this->input->get('start_date',true),
			'end_date'	 => $this->input->get('end_date',true),	
			'user_id'	 => $this->input->get('user_id',true)
		];
		#-------------------------------#
    	$data['user_list'] = $this->doctor_model->doctor_list();
    	$data['appointments'] = $this->report_model->assign_to_user($getData);
		$data['content'] = $this->load->view('report_assign_to_all_doctor',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 


	//Patent count

	//*Department wise opd patient count

public function deptopdcount()
{
    $section = 'opd';
    $year = '%' . $this->session->userdata['acyear'] . '%';
    $Cyear = $this->session->userdata['acyear'];

    $data['datefrom'] = $Cyear . '-01-01';
    $data['dateto'] = $Cyear . '-12-31';

    // Determine the department table based on the academic year
    if ($Cyear == '2025') {
        $departmentTable = 'department_new';
    } else {
        $departmentTable = 'department';
    }

    // Query for OPD count by department
    $data['opdcount'] = $this->db->select($departmentTable . '.name, COUNT(*) as Total')
        ->from('patient')
        ->join($departmentTable, 'patient.department_id = ' . $departmentTable . '.dprt_id')
        ->where('patient.ipd_opd', $section)
        ->where('create_date LIKE', $year)
        ->group_by($departmentTable . '.name')
        ->get()
        ->result();

    // Query for total OPD count
    $data['totalopdcount'] = $this->db->select('COUNT(*) as Total')
        ->from('patient')
        ->where('patient.ipd_opd', $section)
        ->where('create_date LIKE', $year)
        ->get()
        ->result();

    // Load the view to display the results
    $data['content'] = $this->load->view('dept_opd_count', $data, true);
    $this->load->view('layout/main_wrapper', $data);
}

	//Department by count by date 
	public function deptopdcountdate()
{
    $section = 'opd';
    $start_date1 = $this->input->get('start_date', TRUE);
    $end_date1   = $this->input->get('end_date', TRUE);
    $start_date = date('Y-m-d', strtotime($start_date1));
    $end_date   = date('Y-m-d', strtotime($end_date1));

    $data['datefrom'] = $start_date;
    $data['dateto'] = $end_date;

    // Fetch academic year directly from the session
    $acyear = $this->session->userdata['acyear'];
    $year = '%' . $acyear . '%';

    // Determine the department table based on the academic year
    if ($acyear == '2025') {
        $departmentTable = 'department_new';
    } else {
        $departmentTable = 'department';
    }

    // Query for OPD count grouped by department
    $data['opdcount'] = $this->db->select("$departmentTable.name, COUNT(*) as Total")
        ->from('patient')
        ->join($departmentTable, "patient.department_id = $departmentTable.dprt_id")
        ->where('patient.ipd_opd', $section)
        ->where('create_date >=', $start_date)
        ->where('create_date <=', $end_date)
        ->where('create_date LIKE', $year)
        ->group_by("$departmentTable.name")
        ->get()
        ->result();

    // Query for total OPD count
    $data['totalopdcount'] = $this->db->select('COUNT(*) as Total')
        ->from('patient')
        ->where('patient.ipd_opd', $section)
        ->where('create_date >=', $start_date)
        ->where('create_date <=', $end_date)
        ->where('create_date LIKE', $year)
        ->get()
        ->result();

    // Load the view
    $data['content'] = $this->load->view('dept_opd_count', $data, true);
    $this->load->view('layout/main_wrapper', $data);
}


	
	public function deptipdcountdate()
{
    $section = 'ipd';
    $start_date1 = $this->input->get('start_date', TRUE);
    $end_date1   = $this->input->get('end_date', TRUE);
    $start_date = date('Y-m-d', strtotime($start_date1));
    $end_date   = date('Y-m-d', strtotime($end_date1));

    $data['datefrom'] = $start_date;
    $data['dateto'] = $end_date;

    // Fetch academic year directly from the session
    $acyear = $this->session->userdata['acyear'];
    $year = '%' . $acyear . '%';

    // Determine the department table based on the academic year
    if ($acyear == '2025') {
        $departmentTable = 'department_new';
    } else {
        $departmentTable = 'department';
    }

    // Query for IPD count grouped by department
    $data['ipdcount'] = $this->db->select("$departmentTable.name, COUNT(*) as Total")
        ->from('patient_ipd')
        ->join($departmentTable, "patient_ipd.department_id = $departmentTable.dprt_id")
        ->where('patient_ipd.ipd_opd', $section)
        ->where('create_date >=', $start_date)
        ->where('create_date <=', $end_date)
        ->where('create_date LIKE', $year)
        ->group_by("$departmentTable.name")
        ->get()
        ->result();
// print_r($this->db->last_query());
    // Query for total IPD count
    $data['totalipdcount'] = $this->db->select('COUNT(*) as Total')
        ->from('patient_ipd')
        ->where('patient_ipd.ipd_opd', $section)
        ->where('create_date >=', $start_date)
        ->where('create_date <=', $end_date)
        ->where('create_date LIKE', $year)
        ->get()
        ->result();

    // Load the view
    $data['content'] = $this->load->view('dept_ipd_count', $data, true);
    $this->load->view('layout/main_wrapper', $data);
}





	public function deptipdcount()
{
    $section = 'ipd';

    // Get the academic year and construct the wildcard for SQL LIKE
    $year = '%' . $this->session->userdata['acyear'] . '%';
    $Cyear = $this->session->userdata['acyear'];

    // Set the date range for the entire year
    $data['datefrom'] = $Cyear . '-01-01';
    $data['dateto'] = $Cyear . '-12-31';

    // Determine the department table based on the academic year
    if ($Cyear == '2025') {
        $departmentTable = 'department_new';
    } else {
        $departmentTable = 'department';
    }

    // Query for IPD count grouped by department
    $data['ipdcount'] = $this->db->select("$departmentTable.name, COUNT(*) as Total")
        ->from('patient_ipd')
        ->join($departmentTable, "patient_ipd.department_id = $departmentTable.dprt_id")
        ->where('patient_ipd.ipd_opd', $section)
        ->where('create_date LIKE', $year)
        ->group_by("$departmentTable.name")
        ->get()
        ->result();

    // Query for total IPD count
    $data['totalipdcount'] = $this->db->select('COUNT(*) as Total')
        ->from('patient_ipd')
        ->where('patient_ipd.ipd_opd', $section)
        ->where('create_date LIKE', $year)
        ->get()
        ->result();

    // Load the view
    $data['content'] = $this->load->view('dept_ipd_count', $data, true);
    $this->load->view('layout/main_wrapper', $data);
}

	

	///akjdcbnkjsn

	//******************* */


	//***************************************** */
	//***************************************** */

    




	//***************************************** */
	//***************************************** */
public function deptopdcountbydatefilter()
{
    $section = 'opd';

    // Get academic year and construct wildcard for LIKE
    $Cyear = $this->session->userdata['acyear'];
    $year = '%' . $Cyear . '%';

    // Determine the department table based on the academic year
    $departmentTable = ($Cyear == '2025') ? 'department_new' : 'department';

    $start_date1 = $this->input->get('start_date', TRUE);
    $end_date1 = $this->input->get('end_date', TRUE);

    $start_date = date('Y-m-d', strtotime($start_date1));
    $end_date = date('Y-m-d', strtotime($end_date1));

    $data['datefrom'] = $start_date;
    $data['dateto'] = $end_date;

    $data['department'] = $this->db->select('name')
        ->from($departmentTable)
        ->get()
        ->result();

    $data['date'] = $this->db->distinct()
        ->select('create_date, COUNT(*) as Total')
        ->from('patient')
        ->where('patient.ipd_opd', $section)
        ->where('create_date >=', $start_date)
        ->where('create_date <=', $end_date)
        ->where('create_date LIKE', $year)
        ->group_by('patient.create_date')
        ->get()
        ->result();	

    $data['departmenttotal'] = $this->db->select("COUNT(*) as Total, $departmentTable.dprt_id as dprt_id")
        ->from('patient')
        ->join($departmentTable, 'patient.department_id = ' . $departmentTable . '.dprt_id')
        ->where('patient.ipd_opd', $section)
        ->where('create_date >=', $start_date)
        ->where('create_date <=', $end_date)
        ->where('create_date LIKE', $year)
        ->group_by($departmentTable . '.dprt_id')
        ->get()
        ->result();		

    // Generate date sequence between start and end
    $Date1 = $start_date; 
    $Date2 = $end_date; 
    $array = array(); 
    $Variable1 = strtotime($Date1); 
    $Variable2 = strtotime($Date2); 

    for ($currentDate = $Variable1; $currentDate <= $Variable2; $currentDate += 86400) { 
        $Store = date('Y-m-d', $currentDate); 
        $array[] = $Store; 
    } 
    $data['dateseq'] = $array;

    // IPD count by date and department
    $data['ipdcountdater'] = $this->db->select("$departmentTable.name, patient.department_id, patient.create_date as Date, COUNT(*) as Total, COUNT(patient.old_reg_no) as Patientoldcount, COUNT(patient.yearly_reg_no) as Patientnewcount, COUNT(patient.create_date) as datecount")
        ->from('patient')
        ->join($departmentTable, 'patient.department_id = ' . $departmentTable . '.dprt_id')
        ->where('patient.ipd_opd', $section)
        ->where('create_date LIKE', $year)
        ->where('create_date >=', $start_date)
        ->where('create_date <=', $end_date)
        ->group_by('patient.create_date, patient.department_id')
        ->get()
        ->result();

    $data['ipdcountdatercount'] = $this->db->select('COUNT(yearly_reg_no) as newcount, COUNT(old_reg_no) as oldcount, COUNT(*) as totalcount')
        ->from('patient')
        ->where('create_date >=', $start_date)
        ->where('create_date <=', $end_date)
        ->where('patient.ipd_opd', $section)
        ->where('create_date LIKE', $year)
        ->get()
        ->result();

    $data['content'] = $this->load->view('dept_opd_date_count', $data, true);
    $this->load->view('layout/main_wrapper', $data);
}



		//*******************Date Filter********************** */
		//***************************************** */
	public function deptopdcountbydatefilter12(){
		$section = 'opd';

		$year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);


		$start_date = date('Y-m-d',strtotime($start_date1));

		$end_date   = date('Y-m-d',strtotime($end_date1));

		
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$data['date'] = $this->db->distinct()
		->select('create_date, COUNT(*) as Total')
		->from('patient')
		->where('patient.ipd_opd', $section)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('create_date LIKE', $year)
		->group_by('patient.create_date')
		->get()
		->result();	

		$data['departmenttotal'] = $this->db->select('COUNT(*) as Total')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('patient.ipd_opd', $section)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('create_date LIKE', $year)
		->group_by('department.dprt_id')
		->get()
		->result();	


		// Declare two dates 
		$Date1 = $start_date; 
		$Date2 = $end_date;  
		
		// Declare an empty array 
		$array = array(); 
		
		// Use strtotime function 
		$Variable1 = strtotime($Date1); 
		$Variable2 = strtotime($Date2); 
		
		// Use for loop to store dates into array 
		// 86400 sec = 24 hrs = 60*60*24 = 1 day 
		for ($currentDate = $Variable1; $currentDate <= $Variable2;  
										$currentDate += (86400)) { 
											
		$Store = date('Y-m-d', $currentDate); 
		$array[] = $Store; 
		} 

		$data['dateseq'] = $array;
		
		// Display the dates in array format 
		//print_r($data); 
		//die();

		
		//28
		$data['ipdcountdater'] = $this->db->select('department.name,patient.department_id, patient.create_date as Date, COUNT(*) as Total, COUNT(patient.old_reg_no) as Patientoldcount, COUNT(patient.yearly_reg_no) as Patientnewcount, COUNT(patient.create_date) as datecount')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.department_id = 28')
		->group_by('patient.create_date, patient.department_id')
		->get()
		->result();


		$data['ipdcountdatercount'] = $this->db->select('COUNT(yearly_reg_no) as newcount, COUNT(old_reg_no) as oldcount, COUNT(*) as totalcount')
		->from('patient')
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('patient.department_id = 28')
		->get()
		->result();

		
		//29
		$data['ipdcountdater29'] = $this->db->select('department.name,patient.department_id, patient.create_date as Date, COUNT(*) as Total, COUNT(patient.old_reg_no) as Patientoldcount, COUNT(patient.yearly_reg_no) as Patientnewcount, COUNT(patient.create_date) as datecount')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.department_id = 29')
		->group_by('patient.create_date, patient.department_id')
		->get()
		->result();


		$data['ipdcountdatercount29'] = $this->db->select('COUNT(yearly_reg_no) as newcount, COUNT(old_reg_no) as oldcount, COUNT(*) as totalcount')
		->from('patient')
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('patient.department_id = 29')
		->get()
		->result();

		//30
		$data['ipdcountdatere'] = $this->db->select('department.name,patient.department_id, patient.create_date as Date, COUNT(*) as Total, COUNT(patient.old_reg_no) as Patientoldcount, COUNT(patient.yearly_reg_no) as Patientnewcount, COUNT(patient.create_date) as datecount')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.department_id = 30')
		->group_by('patient.create_date, patient.department_id')
		->get()
		->result();


		$data['ipdcountdaterecount'] = $this->db->select('COUNT(yearly_reg_no) as newcount, COUNT(old_reg_no) as oldcount, COUNT(*) as totalcount')
		->from('patient')
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('patient.department_id = 30')
		->get()
		->result();


		//31
		$data['ipdcountdater31'] = $this->db->select('department.name,patient.department_id, patient.create_date as Date, COUNT(*) as Total, COUNT(patient.old_reg_no) as Patientoldcount, COUNT(patient.yearly_reg_no) as Patientnewcount, COUNT(patient.create_date) as datecount')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.department_id = 31')
		->group_by('patient.create_date, patient.department_id')
		->get()
		->result();

		$data['ipdcountdater31count'] = $this->db->select('COUNT(yearly_reg_no) as newcount, COUNT(old_reg_no) as oldcount, COUNT(*) as totalcount')
		->from('patient')
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('patient.department_id = 31')
		->get()
		->result();


		//32
		$data['ipdcountdater32'] = $this->db->select('department.name,patient.department_id, patient.create_date as Date, COUNT(*) as Total, COUNT(patient.old_reg_no) as Patientoldcount, COUNT(patient.yearly_reg_no) as Patientnewcount, COUNT(patient.create_date) as datecount')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.department_id = 32')
		->group_by('patient.create_date, patient.department_id')
		->get()
		->result();

		$data['ipdcountdater32count'] = $this->db->select('COUNT(yearly_reg_no) as newcount, COUNT(old_reg_no) as oldcount, COUNT(*) as totalcount')
		->from('patient')
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('patient.department_id = 32')
		->get()
		->result();


		//33
		$data['ipdcountdate33'] = $this->db->select('patient.department_id, patient.create_date as Date, COUNT(*) as Total, COUNT(patient.old_reg_no) as Patientoldcount, COUNT(patient.yearly_reg_no) as Patientnewcount, COUNT(patient.create_date) as datecount')
		->from('patient')
		// ->join('department', 'patient.department_id = department.dprt_id')
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.department_id = 33')
		->group_by('patient.create_date, patient.department_id')
		->get()
		->result();


		$data['ipdcountdate33count'] = $this->db->select('COUNT(yearly_reg_no) as newcount, COUNT(old_reg_no) as oldcount, COUNT(*) as totalcount')
		->from('patient')
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('patient.department_id = 33')
		->get()
		->result();



		//34
		$data['ipdcountdater34'] = $this->db->select('department.name,patient.department_id, patient.create_date as Date, COUNT(*) as Total, COUNT(patient.old_reg_no) as Patientoldcount, COUNT(patient.yearly_reg_no) as Patientnewcount, COUNT(patient.create_date) as datecount')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.department_id = 34')
		->group_by('patient.create_date, patient.department_id')
		->get()
		->result();

		$data['ipdcountdater34count'] = $this->db->select('COUNT(yearly_reg_no) as newcount, COUNT(old_reg_no) as oldcount, COUNT(*) as totalcount')
		->from('patient')
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('patient.department_id = 34')
		->get()
		->result();

		//35
		$data['ipdcountdater35'] = $this->db->select('department.name,patient.department_id, patient.create_date as Date, COUNT(*) as Total, COUNT(patient.old_reg_no) as Patientoldcount, COUNT(patient.yearly_reg_no) as Patientnewcount, COUNT(patient.create_date) as datecount')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.department_id = 35')
		->group_by('patient.create_date, patient.department_id')
		->get()
		->result();


		$data['ipdcountdatercount35'] = $this->db->select('COUNT(yearly_reg_no) as newcount, COUNT(old_reg_no) as oldcount, COUNT(*) as totalcount')
		->from('patient')
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('patient.department_id = 35')
		->get()
		->result();



		$data['ipdcountdatecount'] = $this->db->select('department.name,patient.department_id, patient.create_date as Date, COUNT(*) as Total, COUNT(patient.old_reg_no) as Patientoldcount, COUNT(patient.yearly_reg_no) as Patientnewcount, COUNT(patient.create_date) as datecount')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->group_by('patient.create_date, patient.department_id')
		->get()
		->result();
	
		$data['content'] = $this->load->view('dept_opd_date_count_2',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}






	
	// public function deptipdcountbydate()
    // {
	
	// 	$section = 'ipd';

	// 	$year = '%'.$this->session->userdata['acyear'].'%';

	// 	// $data['department'] = $this->db->select('name,dprt_id')
	// 	// ->from('department')
	// 	// ->where('department.dprt_id NOT IN (35)')
	// 	// ->get()
	// 	// ->result();

		
	// 	$data['datefrom'] = '2019-01-01';
	// 	$data['dateto'] = '2019';

	// 	$data['date'] = $this->db->distinct()
	// 	->select('create_date, COUNT(*) as Total')
	// 	->from('patient_ipd')
	// 	->where('patient_ipd.ipd_opd', $section)
	// 	->where('create_date LIKE', $year)
	// 	->group_by('patient_ipd.create_date')
	// 	->get()
	// 	->result();	

	// 	$data['departmenttotal'] = $this->db->select('COUNT(*) as Total, department.dprt_id as dprt_id')
	// 	->from('patient_ipd')
	// 	->join('department', 'patient_ipd.department_id = department.dprt_id')
	// 	->where('patient_ipd.ipd_opd', $section)
	// 	->where('create_date LIKE', $year)
	// 	->group_by('department.dprt_id')
	// 	->get()
	// 	->result();		

	// 	// Declare two dates 
	// 	$Date1 = '2019-01-01'; 
	// 	$Date2 = '2019-01-31'; 
		
	// 	// Declare an empty array 
	// 	$array = array(); 
		
	// 	// Use strtotime function 
	// 	$Variable1 = strtotime($Date1); 
	// 	$Variable2 = strtotime($Date2); 
		
	// 	// Use for loop to store dates into array 
	// 	// 86400 sec = 24 hrs = 60*60*24 = 1 day 
	// 	for ($currentDate = $Variable1; $currentDate <= $Variable2;  
	// 									$currentDate += (86400)) { 
											
	// 	$Store = date('Y-m-d', $currentDate); 
	// 	$array[] = $Store; 
	// 	} 

	// 	$data['dateseq'] = $array;
		
	// 	// Display the dates in array format 
	// 	//print_r($data); 
	// 	//die();

	// 	$data['ipdcountdate33'] = $this->db->select('patient_ipd.department_id, patient_ipd.create_date as Date, COUNT(*) as Total, COUNT(patient_ipd.old_reg_no) as Patientoldcount, COUNT(patient_ipd.yearly_reg_no) as Patientnewcount, COUNT(patient_ipd.create_date) as datecount')
	// 	->from('patient_ipd')
	// 	// ->join('department', 'patient.department_id = department.dprt_id')
	// 	->where('patient_ipd.ipd_opd', $section)
	// 	->where('create_date LIKE', $year)
	// 	->where('create_date >=', $Date1)
	// 	->where('create_date <=', $Date2)
	// 	->where('patient_ipd.department_id = 33')
	// 	->group_by('patient_ipd.create_date, patient_ipd.department_id')
	// 	->get()
	// 	->result();


	// 	$data['ipdcountdate33count'] = $this->db->select('COUNT(yearly_reg_no) as newcount, COUNT(old_reg_no) as oldcount, COUNT(*) as totalcount')
	// 	->from('patient_ipd')
	// 	->where('create_date >=', $Date1)
	// 	->where('create_date <=', $Date2)
	// 	->where('patient_ipd.ipd_opd', $section)
	// 	->where('create_date LIKE', $year)
	// 	->where('patient_ipd.department_id = 33')
	// 	->get()
	// 	->result();


	// 	$data['ipdcountdater'] = $this->db->select('department.name,patient_ipd.department_id, patient_ipd.create_date as Date, COUNT(*) as Total, COUNT(patient_ipd.old_reg_no) as Patientoldcount, COUNT(patient_ipd.yearly_reg_no) as Patientnewcount, COUNT(patient_ipd.create_date) as datecount')
	// 	->from('patient_ipd')
	// 	->join('department', 'patient_ipd.department_id = department.dprt_id')
	// 	->where('patient_ipd.ipd_opd', $section)
	// 	->where('create_date LIKE', $year)
	// 	->where('create_date >=', $Date1)
	// 	->where('create_date <=', $Date2)
	// 	->where('patient_ipd.department_id = 29')
	// 	->group_by('patient_ipd.create_date, patient_ipd.department_id')
	// 	->get()
	// 	->result();


	// 	$data['ipdcountdatercount'] = $this->db->select('COUNT(yearly_reg_no) as newcount, COUNT(old_reg_no) as oldcount, COUNT(*) as totalcount')
	// 	->from('patient_ipd')
	// 	->where('create_date >=', $Date1)
	// 	->where('create_date <=', $Date2)
	// 	->where('patient_ipd.ipd_opd', $section)
	// 	->where('create_date LIKE', $year)
	// 	->where('patient_ipd.department_id = 29')
	// 	->get()
	// 	->result();


	// 	$data['ipdcountdatere'] =$this->db->select('department.name,patient_ipd.department_id, patient_ipd.create_date as Date, COUNT(*) as Total, COUNT(patient_ipd.old_reg_no) as Patientoldcount, COUNT(patient_ipd.yearly_reg_no) as Patientnewcount, COUNT(patient_ipd.create_date) as datecount')
	// 	->from('patient_ipd')
	// 	->join('department', 'patient_ipd.department_id = department.dprt_id')
	// 	->where('patient_ipd.ipd_opd', $section)
	// 	->where('create_date LIKE', $year)
	// 	->where('create_date >=', $Date1)
	// 	->where('create_date <=', $Date2)
	// 	->where('patient_ipd.department_id = 30')
	// 	->group_by('patient_ipd.create_date, patient_ipd.department_id')
	// 	->get()
	// 	->result();


	// 	$data['ipdcountdaterecount'] =$this->db->select('COUNT(yearly_reg_no) as newcount, COUNT(old_reg_no) as oldcount, COUNT(*) as totalcount')
	// 	->from('patient_ipd')
	// 	->where('create_date >=', $Date1)
	// 	->where('create_date <=', $Date2)
	// 	->where('patient_ipd.ipd_opd', $section)
	// 	->where('create_date LIKE', $year)
	// 	->where('patient_ipd.department_id = 30')
	// 	->get()
	// 	->result();


	// 	$data['ipdcountdater31'] = $this->db->select('department.name,patient_ipd.department_id, patient_ipd.create_date as Date, COUNT(*) as Total, COUNT(patient_ipd.old_reg_no) as Patientoldcount, COUNT(patient_ipd.yearly_reg_no) as Patientnewcount, COUNT(patient_ipd.create_date) as datecount')
	// 	->from('patient_ipd')
	// 	->join('department', 'patient_ipd.department_id = department.dprt_id')
	// 	->where('patient_ipd.ipd_opd', $section)
	// 	->where('create_date LIKE', $year)
	// 	->where('create_date >=', $Date1)
	// 	->where('create_date <=', $Date2)
	// 	->where('patient_ipd.department_id = 31')
	// 	->group_by('patient_ipd.create_date, patient_ipd.department_id')
	// 	->get()
	// 	->result();

	// 	$data['ipdcountdater31count'] = $this->db->select('COUNT(yearly_reg_no) as newcount, COUNT(old_reg_no) as oldcount, COUNT(*) as totalcount')
	// 	->from('patient_ipd')
	// 	->where('create_date >=', $Date1)
	// 	->where('create_date <=', $Date2)
	// 	->where('patient_ipd.ipd_opd', $section)
	// 	->where('create_date LIKE', $year)
	// 	->where('patient_ipd.department_id = 31')
	// 	->get()
	// 	->result();

	// 	$data['ipdcountdater32'] = $this->db->select('department.name,patient_ipd.department_id, patient_ipd.create_date as Date, COUNT(*) as Total, COUNT(patient_ipd.old_reg_no) as Patientoldcount, COUNT(patient_ipd.yearly_reg_no) as Patientnewcount, COUNT(patient_ipd.create_date) as datecount')
	// 	->from('patient_ipd')
	// 	->join('department', 'patient_ipd.department_id = department.dprt_id')
	// 	->where('patient_ipd.ipd_opd', $section)
	// 	->where('create_date LIKE', $year)
	// 	->where('create_date >=', $Date1)
	// 	->where('create_date <=', $Date2)
	// 	->where('patient_ipd.department_id = 32')
	// 	->group_by('patient_ipd.create_date, patient_ipd.department_id')
	// 	->get()
	// 	->result();

	// 	$data['ipdcountdater32count'] = $this->db->select('COUNT(yearly_reg_no) as newcount, COUNT(old_reg_no) as oldcount, COUNT(*) as totalcount')
	// 	->from('patient_ipd')
	// 	->where('create_date >=', $Date1)
	// 	->where('create_date <=', $Date2)
	// 	->where('patient_ipd.ipd_opd', $section)
	// 	->where('create_date LIKE', $year)
	// 	->where('patient_ipd.department_id = 32')
	// 	->get()
	// 	->result();

	// 	$data['ipdcountdater34'] = $this->db->select('department.name,patient_ipd.department_id, patient_ipd.create_date as Date, COUNT(*) as Total, COUNT(patient_ipd.old_reg_no) as Patientoldcount, COUNT(patient_ipd.yearly_reg_no) as Patientnewcount, COUNT(patient_ipd.create_date) as datecount')
	// 	->from('patient_ipd')
	// 	->join('department', 'patient_ipd.department_id = department.dprt_id')
	// 	->where('patient_ipd.ipd_opd', $section)
	// 	->where('create_date LIKE', $year)
	// 	->where('create_date >=', $Date1)
	// 	->where('create_date <=', $Date2)
	// 	->where('patient_ipd.department_id = 34')
	// 	->group_by('patient_ipd.create_date, patient_ipd.department_id')
	// 	->get()
	// 	->result();

	// 	$data['ipdcountdater34count'] = $this->db->select('COUNT(yearly_reg_no) as newcount, COUNT(old_reg_no) as oldcount, COUNT(*) as totalcount')
	// 	->from('patient_ipd')
	// 	->where('create_date >=', $Date1)
	// 	->where('create_date <=', $Date2)
	// 	->where('patient_ipd.ipd_opd', $section)
	// 	->where('create_date LIKE', $year)
	// 	->where('patient_ipd.department_id = 34')
	// 	->get()
	// 	->result();



	// 	$data['ipdcountdatecount'] = $this->db->select('department.name,patient_ipd.department_id, patient_ipd.create_date as Date, COUNT(*) as Total, COUNT(patient_ipd.old_reg_no) as Patientoldcount, COUNT(patient_ipd.yearly_reg_no) as Patientnewcount, COUNT(patient_ipd.create_date) as datecount')
	// 	->from('patient_ipd')
	// 	->join('department', 'patient_ipd.department_id = department.dprt_id')
	// 	->where('patient_ipd.ipd_opd', $section)
	// 	->where('create_date LIKE', $year)
	// 	->where('create_date >=', $Date1)
	// 	->where('create_date <=', $Date2)
	// 	->group_by('patient_ipd.create_date, patient_ipd.department_id')
	// 	->get()
	// 	->result();
		

	// 	$data['content'] = $this->load->view('dept_ipd_date_count',$data,true);
	// 	$this->load->view('layout/main_wrapper',$data);
	// }


		//*******************Date Filter********************** */
		//***************************************** */

	public function deptipdcountbydatedfilter(){
	
		$section = 'ipd';

		$year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);


		$start_date = date('Y-m-d',strtotime($start_date1));

		$end_date   = date('Y-m-d',strtotime($end_date1));

		
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		
		$data['date'] = $this->db->distinct()
		->select('create_date, COUNT(*) as Total')
		->from('patient')
		->where('patient.ipd_opd', $section)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('create_date LIKE', $year)
		->group_by('patient.create_date')
		->get()
		->result();	

		$data['departmenttotal'] = $this->db->select('COUNT(*) as Total')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('patient.ipd_opd', $section)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('create_date LIKE', $year)
		->group_by('department.dprt_id')
		->get()
		->result();	


		// Declare two dates 
		$Date1 = $start_date; 
		$Date2 = $end_date;  
		
		// Declare an empty array 
		$array = array(); 
		
		// Use strtotime function 
		$Variable1 = strtotime($Date1); 
		$Variable2 = strtotime($Date2); 
		
		// Use for loop to store dates into array 
		// 86400 sec = 24 hrs = 60*60*24 = 1 day 
		for ($currentDate = $Variable1; $currentDate <= $Variable2;  
										$currentDate += (86400)) { 
											
		$Store = date('Y-m-d', $currentDate); 
		$array[] = $Store; 
		} 

		$data['dateseq'] = $array;
		
		// Display the dates in array format 
		//print_r($data); 
		//die();

		$data['ipdcountdate33'] = $this->db->select('patient.department_id, patient.create_date as Date, COUNT(*) as Total, COUNT(patient.old_reg_no) as Patientoldcount, COUNT(patient.yearly_reg_no) as Patientnewcount, COUNT(patient.create_date) as datecount')
		->from('patient')
		// ->join('department', 'patient.department_id = department.dprt_id')
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.department_id = 33')
		->group_by('patient.create_date, patient.department_id')
		->get()
		->result();


		$data['ipdcountdate33count'] = $this->db->select('COUNT(yearly_reg_no) as newcount, COUNT(old_reg_no) as oldcount, COUNT(*) as totalcount')
		->from('patient')
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('patient.department_id = 33')
		->get()
		->result();


		$data['ipdcountdater'] = $this->db->select('department.name,patient.department_id, patient.create_date as Date, COUNT(*) as Total, COUNT(patient.old_reg_no) as Patientoldcount, COUNT(patient.yearly_reg_no) as Patientnewcount, COUNT(patient.create_date) as datecount')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.department_id = 29')
		->group_by('patient.create_date, patient.department_id')
		->get()
		->result();


		$data['ipdcountdatercount'] = $this->db->select('COUNT(yearly_reg_no) as newcount, COUNT(old_reg_no) as oldcount, COUNT(*) as totalcount')
		->from('patient')
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('patient.department_id = 29')
		->get()
		->result();


		$data['ipdcountdatere'] = $this->db->select('department.name,patient.department_id, patient.create_date as Date, COUNT(*) as Total, COUNT(patient.old_reg_no) as Patientoldcount, COUNT(patient.yearly_reg_no) as Patientnewcount, COUNT(patient.create_date) as datecount')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.department_id = 30')
		->group_by('patient.create_date, patient.department_id')
		->get()
		->result();


		$data['ipdcountdaterecount'] = $this->db->select('COUNT(yearly_reg_no) as newcount, COUNT(old_reg_no) as oldcount, COUNT(*) as totalcount')
		->from('patient')
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('patient.department_id = 30')
		->get()
		->result();


		$data['ipdcountdater31'] = $this->db->select('department.name,patient.department_id, patient.create_date as Date, COUNT(*) as Total, COUNT(patient.old_reg_no) as Patientoldcount, COUNT(patient.yearly_reg_no) as Patientnewcount, COUNT(patient.create_date) as datecount')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.department_id = 31')
		->group_by('patient.create_date, patient.department_id')
		->get()
		->result();

		$data['ipdcountdater31count'] = $this->db->select('COUNT(yearly_reg_no) as newcount, COUNT(old_reg_no) as oldcount, COUNT(*) as totalcount')
		->from('patient')
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('patient.department_id = 31')
		->get()
		->result();

		$data['ipdcountdater32'] = $this->db->select('department.name,patient.department_id, patient.create_date as Date, COUNT(*) as Total, COUNT(patient.old_reg_no) as Patientoldcount, COUNT(patient.yearly_reg_no) as Patientnewcount, COUNT(patient.create_date) as datecount')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.department_id = 32')
		->group_by('patient.create_date, patient.department_id')
		->get()
		->result();

		$data['ipdcountdater32count'] = $this->db->select('COUNT(yearly_reg_no) as newcount, COUNT(old_reg_no) as oldcount, COUNT(*) as totalcount')
		->from('patient')
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('patient.department_id = 32')
		->get()
		->result();

		$data['ipdcountdater34'] = $this->db->select('department.name,patient.department_id, patient.create_date as Date, COUNT(*) as Total, COUNT(patient.old_reg_no) as Patientoldcount, COUNT(patient.yearly_reg_no) as Patientnewcount, COUNT(patient.create_date) as datecount')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.department_id = 34')
		->group_by('patient.create_date, patient.department_id')
		->get()
		->result();

		$data['ipdcountdater34count'] = $this->db->select('COUNT(yearly_reg_no) as newcount, COUNT(old_reg_no) as oldcount, COUNT(*) as totalcount')
		->from('patient')
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('patient.department_id = 34')
		->get()
		->result();



		$data['ipdcountdatecount'] = $this->db->select('department.name,patient.department_id, patient.create_date as Date, COUNT(*) as Total, COUNT(patient.old_reg_no) as Patientoldcount, COUNT(patient.yearly_reg_no) as Patientnewcount, COUNT(patient.create_date) as datecount')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('create_date >=', $Date1)
		->where('create_date <=', $Date2)
		->group_by('patient.create_date, patient.department_id')
		->get()
		->result();
		
		$data['content'] = $this->load->view('dept_ipd_date_count',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}



/////////////////////////////////////////////////////////////////



public function deptopdcountbydate()
{
    $section = 'opd';

    $departmentid = 0;

    // Get the academic year and construct the wildcard for SQL LIKE
    $year = '%' . $this->session->userdata['acyear'] . '%';
    $Cyear = $this->session->userdata['acyear'];

    // Set the date range (example dates used, adjust as needed)
    $data['datefrom'] = $Cyear . '-01-01';
    $data['dateto'] = $Cyear . '-12-31';

    // Determine the department table based on the academic year
    if ($Cyear == '2025') {
        $departmentTable = 'department_new';
    } else {
        $departmentTable = 'department';
    }

    // Get department names
    $data['department'] = $this->db->select('name')
        ->from($departmentTable)
        ->get()
        ->result();

    // Get distinct dates and counts for OPD
    $data['date'] = $this->db->distinct()
        ->select('create_date, COUNT(*) as Total')
        ->from('patient')
        ->where('patient.ipd_opd', $section)
        ->where('create_date LIKE', $year)
        ->group_by('patient.create_date')
        ->get()
        ->result();

    // Department-wise total OPD count
    $data['departmenttotal'] = $this->db->select("COUNT(*) as Total, $departmentTable.dprt_id as dprt_id")
        ->from('patient')
        ->join($departmentTable, "patient.department_id = $departmentTable.dprt_id")
        ->where('patient.ipd_opd', $section)
        ->where('create_date LIKE', $year)
        ->group_by("$departmentTable.dprt_id")
        ->get()
        ->result();

    // Generate date sequence
    $Date1 = $Cyear . '-01-01';
    $Date2 = $Cyear . '-01-31';

    $array = [];
    $Variable1 = strtotime($Date1);
    $Variable2 = strtotime($Date2);

    for ($currentDate = $Variable1; $currentDate <= $Variable2; $currentDate += 86400) {
        $Store = date('Y-m-d', $currentDate);
        $array[] = $Store;
    }

    $data['dateseq'] = $array;

    // Detailed counts by date and department
    $data['ipdcountdater'] = $this->db->select("$departmentTable.name, patient.department_id, patient.create_date as Date, COUNT(*) as Total, COUNT(patient.old_reg_no) as Patientoldcount, COUNT(patient.yearly_reg_no) as Patientnewcount, COUNT(patient.create_date) as datecount")
        ->from('patient')
        ->join($departmentTable, "patient.department_id = $departmentTable.dprt_id")
        ->where('patient.ipd_opd', $section)
        ->where('create_date LIKE', $year)
        ->group_by('patient.create_date, patient.department_id')
        ->get()
        ->result();

    // Total counts for new and old patients
    $data['ipdcountdatercount'] = $this->db->select('COUNT(yearly_reg_no) as newcount, COUNT(old_reg_no) as oldcount, COUNT(*) as totalcount')
        ->from('patient')
        ->where('patient.ipd_opd', $section)
        ->where('create_date LIKE', $year)
        ->get()
        ->result();

    // Load the view
    $data['content'] = $this->load->view('dept_opd_date_count', $data, true);
    $this->load->view('layout/main_wrapper', $data);
}
public function genderwisereport() 
{
    $cyear = $this->session->userdata['acyear']; // Fixed case
    $year = '%' . $cyear . '%'; 
    $section = 'opd';
    
    $data['datefrom'] = '2019-01-01';
    $data['dateto'] = '2019';

    // Determine the department table based on the academic year
    $departmentTable = ($cyear == '2025') ? 'department_new' : 'department';

    // Corrected Query with Proper String Interpolation
    $data['gendercount'] = $this->db->select("$departmentTable.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old")
        ->from('patient')
        ->join($departmentTable, "patient.department_id = $departmentTable.dprt_id")
        ->where('create_date LIKE', $year)
        ->where('ipd_opd', $section)
        ->group_by("$departmentTable.name, patient.sex") // Fixed group_by syntax
        ->get()
        ->result();

    $data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
        ->from('patient')
        ->where('create_date LIKE', $year)
        ->where('ipd_opd', $section)
        ->get()
        ->result();

    $data['content'] = $this->load->view('gender_wise_count', $data, true);
    $this->load->view('layout/main_wrapper', $data);
}

	

public function gendercountdate()
{
    $year = '%' . $this->session->userdata['acyear'] . '%';
    $section = 'opd';

    // Get start_date, end_date, and department from GET request
    $start_date1 = $this->input->get('start_date', TRUE);
    $end_date1 = $this->input->get('end_date', TRUE);
    $department_id = $this->input->get('department', TRUE); // Department filter

    // Validate and format dates
    $start_date = ($start_date1) ? date('Y-m-d', strtotime($start_date1)) : date('Y-m-d', strtotime('-30 days')); // Default to last 30 days
    $end_date = ($end_date1) ? date('Y-m-d', strtotime($end_date1)) : date('Y-m-d'); // Default to today

    // Determine department table based on academic year
    $departmentTable = ($this->session->userdata['acyear'] == '2025') ? 'department_new' : 'department';

    $data['datefrom'] = $start_date;
    $data['dateto'] = $end_date;

    // Query with optional department filter
    $this->db->select("$departmentTable.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old")
        ->from('patient')
        ->join($departmentTable, "patient.department_id = $departmentTable.dprt_id")
        ->where('create_date >=', $start_date)
        ->where('create_date <=', $end_date)
        ->where('ipd_opd', $section);

    if (!empty($department_id)) {
        $this->db->where("$departmentTable.dprt_id", $department_id); // Filter by department
    }

    $data['gendercount'] = $this->db->group_by("$departmentTable.name, patient.sex")->get()->result();

    // Total count query
    $this->db->select("COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold")
        ->from('patient')
        ->where('create_date >=', $start_date)
        ->where('create_date <=', $end_date)
        ->where('ipd_opd', $section);

    if (!empty($department_id)) {
        $this->db->where('patient.department_id', $department_id); // Apply department filter here too
    }

    $data['gendercounttotal'] = $this->db->get()->result();

    // Load views
    $data['content'] = $this->load->view('gender_wise_count', $data, true);
    $this->load->view('layout/main_wrapper', $data);
}



	public function genderwiseipdreport()
{
    $year = '%' . $this->session->userdata['acyear'] . '%';
    $section = 'ipd';

    // Get department filter from GET request
    $department_id = $this->input->get('department', TRUE);

    // Determine department table based on academic year
    $departmentTable = ($this->session->userdata['acyear'] == '2025') ? 'department_new' : 'department';

    $data['datefrom'] = '2019-01-01';
    $data['dateto'] = '2019';

    // Gender count query
    $this->db->select("$departmentTable.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old")
        ->from('patient_ipd')
        ->join($departmentTable, "patient_ipd.department_id = $departmentTable.dprt_id")
        ->where('patient_ipd.ipd_opd', $section)
        ->where('create_date LIKE', $year);

    if (!empty($department_id)) {
        $this->db->where("$departmentTable.dprt_id", $department_id); // Apply department filter
    }

    $data['gendercount'] = $this->db->group_by("$departmentTable.name, patient_ipd.sex")->get()->result();

    // Total count query
    $this->db->select("COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold")
        ->from('patient_ipd')
        ->where('patient_ipd.ipd_opd', $section)
        ->where('create_date LIKE', $year);

    if (!empty($department_id)) {
        $this->db->where('patient_ipd.department_id', $department_id); // Apply department filter here too
    }

    $data['gendercounttotal'] = $this->db->get()->result();

    // Load views
    $data['content'] = $this->load->view('gender_wise_ipd_count', $data, true);
    $this->load->view('layout/main_wrapper', $data);
}



	public function gendercountipddate()
{
    $year = '%' . $this->session->userdata['acyear'] . '%';
    $section = 'ipd';

    // Get start_date, end_date, and department from GET request
    $start_date1 = $this->input->get('start_date', TRUE);
    $end_date1 = $this->input->get('end_date', TRUE);
    $department_id = $this->input->get('department', TRUE); // Department filter

    // Validate and format dates
    $start_date = ($start_date1) ? date('Y-m-d', strtotime($start_date1)) : date('Y-m-d', strtotime('-30 days')); // Default: last 30 days
    $end_date = ($end_date1) ? date('Y-m-d', strtotime($end_date1)) : date('Y-m-d'); // Default: today

    // Determine department table based on academic year
    $departmentTable = ($this->session->userdata['acyear'] == '2025') ? 'department_new' : 'department';

    $data['datefrom'] = $start_date;
    $data['dateto'] = $end_date;

    // Query: Gender count by department
    $this->db->select("$departmentTable.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old")
        ->from('patient_ipd')
        ->join($departmentTable, "patient_ipd.department_id = $departmentTable.dprt_id")
        ->where('patient_ipd.ipd_opd', $section)
        ->where('create_date >=', $start_date)
        ->where('create_date <=', $end_date);

    if (!empty($department_id)) {
        $this->db->where("$departmentTable.dprt_id", $department_id); // Apply department filter
    }

    $data['gendercount'] = $this->db->group_by("$departmentTable.name, patient_ipd.sex")->get()->result();

    // Query: Total Gender Count
    $this->db->select("COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold")
        ->from('patient_ipd')
        ->where('patient_ipd.ipd_opd', $section)
        ->where('create_date >=', $start_date)
        ->where('create_date <=', $end_date);

    if (!empty($department_id)) {
        $this->db->where('patient_ipd.department_id', $department_id); // Apply department filter
    }

    $data['gendercounttotal'] = $this->db->get()->result();

    // Load views
    $data['content'] = $this->load->view('gender_wise_ipd_count', $data, true);
    $this->load->view('layout/main_wrapper', $data);
}



	//Laboratory Count
	public function labcount(){

		$year = '%'.$this->session->userdata['acyear'].'%';

		$data['monthcounts'] = $this->db->select('MONTHNAME(create_date) AS month, MONTH(create_date) AS m, COUNT(patient.patient_id) AS patient')
		->from('patient')
		->where('create_date LIKE', $year)
		->group_by('month')
		->order_by('m')
		->get()
		->result();

		//Urean Report
		$this->db->select('MONTHNAME(patient.create_date) AS month, MONTH(patient.create_date) AS m, COUNT(urinexamination2.opd_no) as urinexam');
		$this->db->from('patient');
		$this->db->join('urinexamination2', 'urinexamination2.opd_no = patient.yearly_reg_no', 'left');
		$this->db->where('create_date LIKE', $year);
		$this->db->group_by('month');
		$query1 = $this->db->get_compiled_select();

		 $this->db->select('MONTHNAME(patient.create_date) AS month, MONTH(patient.create_date) AS m, COUNT(urinexamination2.opd_no) as urinexam');
		 $this->db->from('patient');
		 $this->db->join('urinexamination2', 'urinexamination2.opd_no = patient.yearly_reg_no', 'right');
		 $this->db->where('create_date LIKE', $year);
		 $this->db->group_by('month');
		 $this->db->order_by('m');
		$query2 = $this->db->get_compiled_select();

		$query = $this->db->query($query1." UNION ".$query2);
		$data['urinexamination2counts'] = $query->result(); 
		

		//biochemicaltest2 count Report
		$this->db->select('MONTHNAME(patient.create_date) AS month, MONTH(patient.create_date) AS m, COUNT(biochemicaltest2.opd_no) as biochemicaltest2');
		$this->db->from('patient');
		$this->db->join('biochemicaltest2', 'biochemicaltest2.opd_no = patient.yearly_reg_no', 'left');
		$this->db->where('patient.create_date LIKE', $year);
		$this->db->group_by('month');
		$query1 = $this->db->get_compiled_select();

		 $this->db->select('MONTHNAME(patient.create_date) AS month, MONTH(patient.create_date) AS m, COUNT(biochemicaltest2.opd_no) as biochemicaltest2');
		 $this->db->from('patient');
		 $this->db->join('biochemicaltest2', 'biochemicaltest2.opd_no = patient.yearly_reg_no', 'right');
		 $this->db->where('patient.create_date LIKE', $year);
		 $this->db->group_by('month');
		 $this->db->order_by('m');
		$query2 = $this->db->get_compiled_select();

		$query = $this->db->query($query1." UNION ".$query2);
		$data['biochemicaltest2'] = $query->result(); 
		

		//stool count Report
		$this->db->select('MONTHNAME(patient.create_date) AS month, MONTH(patient.create_date) AS m, COUNT(stool.opd_no) as stool');
		$this->db->from('patient');
		$this->db->join('stool', 'stool.opd_no = patient.yearly_reg_no', 'left');
		$this->db->where('patient.create_date LIKE', $year);
		$this->db->group_by('month');
		$query1 = $this->db->get_compiled_select();

		 $this->db->select('MONTHNAME(patient.create_date) AS month, MONTH(patient.create_date) AS m, COUNT(stool.opd_no) as stool');
		 $this->db->from('patient');
		 $this->db->join('stool', 'stool.opd_no = patient.yearly_reg_no', 'right');
		 $this->db->where('patient.create_date LIKE', $year);
		 $this->db->group_by('month');
		 $this->db->order_by('m');
		$query2 = $this->db->get_compiled_select();

		$query = $this->db->query($query1." UNION ".$query2);
		$data['stool'] = $query->result(); 
		

		//seological  count Report
		$this->db->select('MONTHNAME(patient.create_date) AS month, MONTH(patient.create_date) AS m, COUNT(seological.opd_no) as seological');
		$this->db->from('patient');
		$this->db->join('seological', 'seological.opd_no = patient.yearly_reg_no', 'left');
		$this->db->where('patient.create_date LIKE', $year);
		$this->db->group_by('month');
		$query1 = $this->db->get_compiled_select();

		 $this->db->select('MONTHNAME(patient.create_date) AS month, MONTH(patient.create_date) AS m, COUNT(seological.opd_no) as seological');
		 $this->db->from('patient');
		 $this->db->join('seological', 'seological.opd_no = patient.yearly_reg_no', 'right');
		 $this->db->where('patient.create_date LIKE', $year);
		 $this->db->group_by('month');
		 $this->db->order_by('m');
		$query2 = $this->db->get_compiled_select();

		$query = $this->db->query($query1." UNION ".$query2);
		$data['seological'] = $query->result(); 
		

		//haemogram  count Report
		$this->db->select('MONTHNAME(patient.create_date) AS month, MONTH(patient.create_date) AS m, COUNT(haemogram.opd_no) as haemogram');
		$this->db->from('patient');
		$this->db->join('haemogram', 'haemogram.opd_no = patient.yearly_reg_no', 'left');
		$this->db->where('patient.create_date LIKE', $year);
		$this->db->group_by('month');
		$query1 = $this->db->get_compiled_select();

		 $this->db->select('MONTHNAME(patient.create_date) AS month, MONTH(patient.create_date) AS m, COUNT(haemogram.opd_no) as haemogram');
		 $this->db->from('patient');
		 $this->db->join('haemogram', 'haemogram.opd_no = patient.yearly_reg_no', 'right');
		 $this->db->where('patient.create_date LIKE', $year);
		 $this->db->group_by('month');
		 $this->db->order_by('m');
		$query2 = $this->db->get_compiled_select();

		$query = $this->db->query($query1." UNION ".$query2);
		$data['haemogram'] = $query->result(); 
		
		//Total count Report

		$this->db->select('Count(*) as haemogram');
		$this->db->from('patient');		
		$this->db->where('create_date LIKE', $year);
		$query10 = $this->db->get_compiled_select();

		$this->db->select('Count(*) as haemogram');
		$this->db->from('haemogram');	
		$this->db->where('create_date LIKE', $year);
		$query11 = $this->db->get_compiled_select();

		$this->db->select('Count(*) as biochemicaltest2');
		$this->db->from('biochemicaltest2');		
		$this->db->where('create_date LIKE', $year);
		$query12 = $this->db->get_compiled_select();

		$this->db->select('Count(*) as seological');
		$this->db->from('seological');	
		$this->db->where('create_date LIKE', $year);
		$query13 = $this->db->get_compiled_select();

		$this->db->select('Count(*) as urinexamination2');
		$this->db->from('urinexamination2');	
		// $this->db->where('create_date LIKE', $year);
		$query14 = $this->db->get_compiled_select();

		$this->db->select('Count(*) as stool');
		$this->db->from('stool');		
		// $this->db->where('create_date LIKE', $year);
		$query15 = $this->db->get_compiled_select();

		$query = $this->db->query($query10." UNION ".$query11." UNION ".$query12 ." UNION ".$query13." UNION ".$query14." UNION ".$query15);
		$data['totalsum'] = $query->result(); 



		$data['content'] = $this->load->view('laboratory_count',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
	
	
	public function dept_gender_summery_report(){
        
        $year = '%'.$this->session->userdata['acyear'].'%';
		$section = $this->input->get('section', TRUE);

		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1   = $this->input->get('end_date', TRUE);
		
		$start_date = date('Y-m-d',strtotime($start_date1));
		$end_date   = date('Y-m-d',strtotime($end_date1));

		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;
		
		if($section=='ipd'){$data['tableName']='patient_ipd';}
		elseif($section=='opd'){$data['tableName']='patient';}
		else{$data['tableName']='';}
		
		$data['department'] = $this->db->get('department')->result();
		
		$data['content'] = $this->load->view('dept_gender_summery_report',$data,true);
		$this->load->view('layout/main_wrapper',$data);
        
    }

   public function dept_gender_ipd_occupancy_summery_report()
   {
        error_reporting(0);

        $year = '%'.$this->session->userdata['acyear'].'%';
        $current_year = $this->session->userdata['acyear'];
        $section = $this->input->get('section', TRUE);

        $start_date1 = $this->input->get('start_date', TRUE);
        $end_date1   = $this->input->get('end_date', TRUE);

        $start_date = date('Y-m-d',strtotime($start_date1));
        $end_date   = date('Y-m-d',strtotime($end_date1));


        if($start_date1 != '' || $start_date1 != null){
        $data['datefrom'] = $datefrom = $start_date;
        }
        else{
        $current_year = $this->session->userdata['acyear'];
        $data['datefrom'] = $datefrom = date('Y-m-d',strtotime($current_year.'-01-01'));
        }

        if($end_date1 != '' || $end_date1 != null){
        $data['dateto'] = $dateto = $end_date;
        }
        else{
        $current_year = $this->session->userdata['acyear'];
        $current_date_year  = date('Y');
        if($current_date_year == $current_year)
        {
        $checkLastPatient = $this->db->where('year(create_date)',$current_year)->order_by('id','desc')->limit(1)->get('patient_ipd')->row();
        $data['dateto'] = $dateto = date('Y-m-d',strtotime($checkLastPatient->create_date));
        }
        else
        {
        $checkLastPatient = $this->db->where('year(create_date)',$current_year)->order_by('id','desc')->limit(1)->get('patient_ipd')->row();
        $dateto = date('Y-m-d',strtotime($checkLastPatient->create_date));
        if($dateto != $current_year.'-12-31')
        {
        $data['dateto'] = $dateto = $current_year.'-12-31'; 
        }
        else
        {
        $data['dateto'] = $dateto = date('Y-m-d',strtotime($checkLastPatient->create_date));
        }
        }
        }

        if($section != '' || $section != null){
        $data['section'] = $section;
        }
        else{
        $data['section'] = $section = "ipd";
        }

        $data['tableName'] = $tableName = 'patient_ipd';
        $dept_id = array('28', '35');


        $year = '%' . $this->session->userdata('acyear') . '%';
        $Cyear = (int) $this->session->userdata('acyear');

        $departmentTable = ($Cyear >= 2025) ? 'department_new' : 'department';

        $data['department'] = $department = $this->db
        ->where_not_in('dprt_id', $dept_id)
        ->get($departmentTable)
        ->result();


        // $data['department'] = $department = $this->db->where_not_in('dprt_id', $dept_id)->get('department')->result();

        $date1=date('Y-m-d',strtotime($datefrom));
        $date2=date('Y-m-d',strtotime($dateto));
        $datetime1 = date_create($date1); 
        $datetime2 = date_create($date2); 
        // calculates the difference between DateTime objects 
        $interval = date_diff($datetime1, $datetime2); 
        // printing result in days format 
        $day= $interval->format('%a') + 1; 

        $dateArray = array();
        for($i=0;$i<$day;$i++){
        $deptMFCountArray = array();
        $dateArray1 = array();
        foreach ($department as $dept) {
        $checkRecord = $this->db->where('create_date >=',date('Y-m-d', strtotime($i." days", strtotime($datefrom))))->limit(1)->get($tableName)->num_rows();
        if($checkRecord != 0){
        $dateCheck = date('Y-m-d', strtotime($i." days", strtotime($datefrom)));
        $disDateCheck = date('Y-m-d', strtotime($datefrom));
        $res1 = $this->db->select('COUNT(*) as maleCount')->from($tableName)->where(['department_id'=>$dept->dprt_id, 'sex'=>'M', 'discharge_date > '=>$dateCheck, 'create_date <= '=>$dateCheck, 'ipd_opd'=>$section])
        ->or_where('department_id', $dept->dprt_id)
        ->where(['sex'=>'M', 'create_date <= '=>$dateCheck, 'discharge_date LIKE'=>'%0000-00-00%', 'ipd_opd'=>$section])
        ->get()->row();
        $res2 = $this->db->select('COUNT(*) as femaleCount')->from($tableName)->where(['department_id'=>$dept->dprt_id, 'sex'=>'F', 'discharge_date > '=>$dateCheck, 'create_date <= '=>$dateCheck, 'ipd_opd'=>$section])
        ->or_where('department_id', $dept->dprt_id)
        ->where(['sex'=>'F', 'create_date <= '=>$dateCheck, 'discharge_date LIKE'=>'%0000-00-00%', 'ipd_opd'=>$section])
        ->get()->row();

        $result1 = $res1->maleCount;
        $result2 = $res2->femaleCount;
        } else{
        $result1 = 0;
        $result2 = 0;
        }
        $deptMFCountArray = array('department_id'=>$dept->dprt_id, 'maleCount'=>$result1, 'femaleCount'=>$result2);
        array_push($dateArray1, $deptMFCountArray);
        }
        array_push($dateArray, $dateArray1);
        unset($dateArray1);
        }
        $data['dateArray'] = $dateArray;

        $data['content'] = $this->load->view('dept_gender_ipd_occupancy_summery_report',$data,true);
        $this->load->view('layout/main_wrapper',$data);
    }
    
    public function dept_gender_ipd_occupancy_summery_report11(){
        
        $year = '%'.$this->session->userdata['acyear'].'%';
        $current_year = $this->session->userdata['acyear'];
		$section = $this->input->get('section', TRUE);

		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1   = $this->input->get('end_date', TRUE);
		
		$start_date = date('Y-m-d',strtotime($start_date1));
		$end_date   = date('Y-m-d',strtotime($end_date1));
		
		
		if($start_date1 != '' || $start_date1 != null){
		    $data['datefrom'] = $datefrom = $start_date;
		}
		else{
		    $current_year = $this->session->userdata['acyear'];
		    $data['datefrom'] = $datefrom = date('Y-m-d',strtotime($current_year.'-01-01'));
		}
		
		if($end_date1 != '' || $end_date1 != null){
		    $data['dateto'] = $dateto = $end_date;
		}
		else{
		    $current_year = $this->session->userdata['acyear'];
		    $checkLastPatient = $this->db->where('year(create_date)',$current_year)->order_by('id','desc')->limit(1)->get('patient_ipd')->row();
		    $data['dateto'] = $dateto = date('Y-m-d',strtotime($checkLastPatient->create_date));
		}
		
		if($section != '' || $section != null){
		    $data['section'] = $section;
		}
		else{
		    $data['section'] = $section = "ipd";
		}
		
        $data['tableName'] = $tableName = 'patient_ipd';
        $dept_id = array('28', '35');
        $data['department'] = $department = $this->db->where_not_in('dprt_id', $dept_id)->get('department')->result();
        
        $date1=date('Y-m-d',strtotime($datefrom));
        $date2=date('Y-m-d',strtotime($dateto));
        $datetime1 = date_create($date1); 
        $datetime2 = date_create($date2); 
        // calculates the difference between DateTime objects 
        $interval = date_diff($datetime1, $datetime2); 
        // printing result in days format 
        $day= $interval->format('%a') + 1; 
        
        $dateArray = array();
        for($i=0;$i<$day;$i++){
            $deptMFCountArray = array();
            $dateArray1 = array();
            foreach ($department as $dept) {
                $checkRecord = $this->db->where('create_date >=',date('Y-m-d', strtotime($i." days", strtotime($datefrom))))->limit(1)->get($tableName)->num_rows();
                if($checkRecord != 0){
                    $dateCheck = date('Y-m-d', strtotime($i." days", strtotime($datefrom)));
                    $disDateCheck = date('Y-m-d', strtotime($datefrom));
                    $res1 = $this->db->select('COUNT(*) as maleCount')->from($tableName)->where(['department_id'=>$dept->dprt_id, 'sex'=>'M', 'discharge_date > '=>$dateCheck, 'create_date <= '=>$dateCheck, 'ipd_opd'=>$section])
                        ->or_where('department_id', $dept->dprt_id)
                        ->where(['sex'=>'M', 'create_date <= '=>$dateCheck, 'discharge_date LIKE'=>'%0000-00-00%', 'ipd_opd'=>$section])
                        ->get()->row();
                    $res2 = $this->db->select('COUNT(*) as femaleCount')->from($tableName)->where(['department_id'=>$dept->dprt_id, 'sex'=>'F', 'discharge_date > '=>$dateCheck, 'create_date <= '=>$dateCheck, 'ipd_opd'=>$section])
                        ->or_where('department_id', $dept->dprt_id)
                        ->where(['sex'=>'F', 'create_date <= '=>$dateCheck, 'discharge_date LIKE'=>'%0000-00-00%', 'ipd_opd'=>$section])
                        ->get()->row();
                    
                    $result1 = $res1->maleCount;
                    $result2 = $res2->femaleCount;
                } else{
                    $result1 = 0;
                    $result2 = 0;
                }
                $deptMFCountArray = array('department_id'=>$dept->dprt_id, 'maleCount'=>$result1, 'femaleCount'=>$result2);
                array_push($dateArray1, $deptMFCountArray);
            }
            array_push($dateArray, $dateArray1);
            unset($dateArray1);
        }
        $data['dateArray'] = $dateArray;
		
		$data['content'] = $this->load->view('dept_gender_ipd_occupancy_summery_report',$data,true);
		$this->load->view('layout/main_wrapper',$data);
    }

   /* public function getInvestiPanchCount($section = NULL, $type = NULL, $report_cat = NULL, $report_type = NULL, $other_reg = NULL){
        $acYear = $this->session->userdata['acyear'];
        
        if($report_cat == 'pt'){ 
            if($section == 'opd'){
                $table_name = 'investi_panch_opd_total_count';
            }else{
                $table_name = 'investi_panch_ipd_total_count';
            }
        }else{ 
            if($section == 'opd'){
                $table_name = 'investi_panch_opd_test_total_count'; 
            }else{
                $table_name = 'investi_panch_ipd_test_total_count';
            }
        }
        
        if($report_type == 'y' || $report_type == 'd'){
            
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');
            
            if($start_date && $end_date){
                $data['datefrom'] = $startDate = date('Y-m-d', strtotime($start_date));
                $data['dateto'] = $endDate = date('Y-m-d', strtotime($end_date));
            }
            else{
                $data['datefrom'] = $startDate = $acYear.'-01-01';
                $data['dateto'] = $endDate = $acYear.'-12-31';
            }
        }elseif($report_type == 'dm'){
            $month_id = $this->input->get('month_id');
            $start_date = $acyear.'-'.$month_id.'-01';
            $end_date = date("Y-m-t", strtotime($start_date));
            $data['datefrom'] = $startDate = date('Y-m-d', strtotime($start_date));
            $data['dateto'] = $endDate = date('Y-m-d', strtotime($end_date));
        
        }elseif($report_type == 'm'){
            $data['datefrom'] = $startDate = $acYear.'-01-01';
            $data['dateto'] = $endDate = $acYear.'-12-31';
        }
        
        if($section == 'opd'){
            if($report_type == 'y'){
                $result = $this->db->select('sum(snehan_count) as snehanCount, sum(swedan_count) as swedanCount, sum(vaman_count) as vamanCount, sum(virechan_count) as virechanCount, sum(nasya_count) as nasyaCount, sum(raktmokshan_count) as raktmokshanCount, sum(shirodhara_count) as shirodharaCount, sum(shirobasti_count) as shirobastiCount, sum(uttarbasti_count) as uttarbastiCount, sum(basti_count) as bastiCount, sum(yonidhavan_count) as yonidhavanCount, sum(yonipichu_count) as yonipichuCount, sum(others_count) as othersCount, sum(hematology_count) as hematologyCount, sum(serology_count) as serologyCount, sum(biochemistry_count) as biochemistryCount, sum(microbiology_count) as microbiologyCount, sum(xray_count) as xrayCount, sum(ecg_count) as ecgCount, sum(usg_count) as usgCount')
                    ->where('year(create_date)',$acYear)
                    ->where('ipd_opd', $section)
                    ->where('create_date >= ', $startDate)
                    ->where('create_date <= ', $endDate)
                    ->get($table_name)
                    ->row();
            }
            elseif($report_type == 'd'){
                $result = $this->db->select('create_date as date, snehan_count as snehanCount, swedan_count as swedanCount, vaman_count as vamanCount, virechan_count as virechanCount, nasya_count as nasyaCount, raktmokshan_count as raktmokshanCount, shirodhara_count as shirodharaCount, shirobasti_count as shirobastiCount, uttarbasti_count as uttarbastiCount, basti_count as bastiCount, yonidhavan_count as yonidhavanCount, yonipichu_count as yonipichuCount, others_count as othersCount, hematology_count as hematologyCount, serology_count as serologyCount, biochemistry_count as biochemistryCount, microbiology_count as microbiologyCount, xray_count as xrayCount, ecg_count as ecgCount, usg_count as usgCount')
                    ->where('year(create_date)',$acYear)
                    ->where('ipd_opd', $section)
                    ->where('create_date >= ', $startDate)
                    ->where('create_date <= ', $endDate)
                    ->get($table_name)
                    ->result();
            }
            elseif($report_type == 'm'){
                $result = array();
                for($i=1; $i<=12; $i++){
                    $month_start_date = $acYear.'-'.$i.'-01';
                    $month_end_date = date("Y-m-t", strtotime($month_start_date));
                    
                    $result_month_count = $this->db->select('sum(snehan_count) as snehanCount, sum(swedan_count) as swedanCount, sum(vaman_count) as vamanCount, sum(virechan_count) as virechanCount, sum(nasya_count) as nasyaCount, sum(raktmokshan_count) as raktmokshanCount, sum(shirodhara_count) as shirodharaCount, sum(shirobasti_count) as shirobastiCount, sum(uttarbasti_count) as uttarbastiCount, sum(basti_count) as bastiCount, sum(yonidhavan_count) as yonidhavanCount, sum(yonipichu_count) as yonipichuCount, sum(others_count) as othersCount, sum(hematology_count) as hematologyCount, sum(serology_count) as serologyCount, sum(biochemistry_count) as biochemistryCount, sum(microbiology_count) as microbiologyCount, sum(xray_count) as xrayCount, sum(ecg_count) as ecgCount, sum(usg_count) as usgCount')
                        ->where('year(create_date)',$acYear)
                        ->where('ipd_opd', $section)
                        ->where('create_date >= ', $month_start_date)
                        ->where('create_date <= ', $month_end_date)
                        ->get($table_name)
                        ->row_array();
                        
                    array_push($result, $result_month_count);
                }
            }
            elseif($report_type == 'dm'){
                
            }
        }else{
            if($report_type == 'y'){
                $result = $this->db->select('sum(snehan_count) as snehanCount, sum(swedan_count) as swedanCount, sum(vaman_count) as vamanCount, sum(virechan_count) as virechanCount, sum(nasya_count) as nasyaCount, sum(raktmokshan_count) as raktmokshanCount, sum(shirodhara_count) as shirodharaCount, sum(shirobasti_count) as shirobastiCount, sum(uttarbasti_count) as uttarbastiCount, sum(basti_count) as bastiCount, sum(yonidhavan_count) as yonidhavanCount, sum(yonipichu_count) as yonipichuCount, sum(others_count) as othersCount, sum(hematology_count) as hematologyCount, sum(serology_count) as serologyCount, sum(biochemistry_count) as biochemistryCount, sum(microbiology_count) as microbiologyCount, sum(xray_count) as xrayCount, sum(ecg_count) as ecgCount, sum(usg_count) as usgCount')
                    ->where('year(create_date)',$acYear)
                    ->where('ipd_opd', $section)
                    ->where('create_date >= ', $startDate)
                    ->where('create_date <= ', $endDate)
                    ->get($table_name)
                    ->row();
            }
            elseif($report_type == 'd'){
                $result = $this->db->select('create_date as date, snehan_count as snehanCount, swedan_count as swedanCount, vaman_count as vamanCount, virechan_count as virechanCount, nasya_count as nasyaCount, raktmokshan_count as raktmokshanCount, shirodhara_count as shirodharaCount, shirobasti_count as shirobastiCount, uttarbasti_count as uttarbastiCount, basti_count as bastiCount, yonidhavan_count as yonidhavanCount, yonipichu_count as yonipichuCount, others_count as othersCount, hematology_count as hematologyCount, serology_count as serologyCount, biochemistry_count as biochemistryCount, microbiology_count as microbiologyCount, xray_count as xrayCount, ecg_count as ecgCount, usg_count as usgCount')
                    ->where('year(create_date)',$acYear)
                    ->where('ipd_opd', $section)
                    ->where('create_date >= ', $startDate)
                    ->where('create_date <= ', $endDate)
                    ->get($table_name)
                    ->result();
            }
            elseif($report_type == 'm'){
                $result = array();
                for($i=1; $i<=12; $i++){
                    $month_start_date = $acYear.'-'.$i.'-01';
                    $month_end_date = date("Y-m-t", strtotime($month_start_date));
                    
                    $result_month_count = $this->db->select('sum(snehan_count) as snehanCount, sum(swedan_count) as swedanCount, sum(vaman_count) as vamanCount, sum(virechan_count) as virechanCount, sum(nasya_count) as nasyaCount, sum(raktmokshan_count) as raktmokshanCount, sum(shirodhara_count) as shirodharaCount, sum(shirobasti_count) as shirobastiCount, sum(uttarbasti_count) as uttarbastiCount, sum(basti_count) as bastiCount, sum(yonidhavan_count) as yonidhavanCount, sum(yonipichu_count) as yonipichuCount, sum(others_count) as othersCount, sum(hematology_count) as hematologyCount, sum(serology_count) as serologyCount, sum(biochemistry_count) as biochemistryCount, sum(microbiology_count) as microbiologyCount, sum(xray_count) as xrayCount, sum(ecg_count) as ecgCount, sum(usg_count) as usgCount')
                        ->where('year(create_date)',$acYear)
                        ->where('ipd_opd', $section)
                        ->where('create_date >= ', $month_start_date)
                        ->where('create_date <= ', $month_end_date)
                        ->get($table_name)
                        ->row_array();
                        
                    array_push($result, $result_month_count);
                }
            }
            elseif($report_type == 'dm'){
                
            }
        }
        $data['section'] = $section;
        $data['report_cat'] = $report_cat;
        $data['report_type'] = $report_type;
        $data['other_reg'] = $other_reg;
        $data['resultData'] = $result;
        if($type == 'investi'){
            if($report_type == 'y'){
                $data['content'] = $this->load->view('patient_investi_count_report',$data,true);
            }elseif($report_type == 'd'){
                $data['content'] = $this->load->view('patient_investi_datewise_count_report',$data,true);
            }elseif($report_type == 'm'){
                $data['content'] = $this->load->view('patient_investi_monthwise_count_report',$data,true);
            }
        }elseif($type == 'panch'){
            if($report_type == 'y'){
                if($other_reg == 'o'){
                    $data['content'] = $this->load->view('patient_other_panch_count_report',$data,true);
                }else{
                    $data['content'] = $this->load->view('patient_panch_count_report',$data,true);
                }
            }elseif($report_type == 'd'){
                if($other_reg == 'o'){
                    $data['content'] = $this->load->view('patient_other_panch_datewise_count_report',$data,true);
                }else{
                    $data['content'] = $this->load->view('patient_panch_datewise_count_report',$data,true);
                }
            }elseif($report_type == 'm'){
                if($other_reg == 'o'){
                    $data['content'] = $this->load->view('patient_other_panch_monthwise_count_report',$data,true);
                }else{
                    $data['content'] = $this->load->view('patient_panch_monthwise_count_report',$data,true);
                }
            }
        }
		$this->load->view('layout/main_wrapper',$data);
    }*/
    
//      public function getInvestiPanchCount($section = NULL, $type = NULL, $report_cat = NULL, $report_type = NULL, $other_reg = NULL)
//     {
//         $acYear = $this->session->userdata['acyear'];
        
//         if($report_cat == 'pt'){ 
//             if($section == 'opd'){
//                 $table_name = 'investi_panch_opd_total_count';
//             }else{
//                 $table_name = 'investi_panch_ipd_total_count';
//             }
//         }else{ 
//             if($section == 'opd'){
//                 $table_name = 'investi_panch_opd_test_total_count'; 
//             }else{
//                 $table_name = 'investi_panch_ipd_test_total_count';
//             }
//         }
        
//         if($report_type == 'y' || $report_type == 'd'){
            
//             $start_date = $this->input->get('start_date');
//             $end_date = $this->input->get('end_date');
            
//             if($start_date && $end_date){
//                 $data['datefrom'] = $startDate = date('Y-m-d', strtotime($start_date));
//                 $data['dateto'] = $endDate = date('Y-m-d', strtotime($end_date));
//             }
//             else{
//                 $data['datefrom'] = $startDate = $acYear.'-01-01';
//                 $data['dateto'] = $endDate = $acYear.'-12-31';
//             }
//         }elseif($report_type == 'dm'){
//             $month_id = $this->input->get('month_id');
//             $start_date = $acyear.'-'.$month_id.'-01';
//             $end_date = date("Y-m-t", strtotime($start_date));
//             $data['datefrom'] = $startDate = date('Y-m-d', strtotime($start_date));
//             $data['dateto'] = $endDate = date('Y-m-d', strtotime($end_date));
        
//         }elseif($report_type == 'm'){
//             $data['datefrom'] = $startDate = $acYear.'-01-01';
//             $data['dateto'] = $endDate = $acYear.'-12-31';
//         }
        
//         if($section == 'opd'){
//             if($report_type == 'y'){
//                 $result = $this->db->select('sum(snehan_count) as snehanCount, sum(swedan_count) as swedanCount, sum(vaman_count) as vamanCount, sum(virechan_count) as virechanCount, sum(nasya_count) as nasyaCount, sum(raktmokshan_count) as raktmokshanCount, sum(shirodhara_count) as shirodharaCount, sum(shirobasti_count) as shirobastiCount, sum(uttarbasti_count) as uttarbastiCount, sum(basti_count) as bastiCount, sum(yonidhavan_count) as yonidhavanCount, sum(yonipichu_count) as yonipichuCount, sum(others_count) as othersCount, sum(hematology_count) as hematologyCount, sum(serology_count) as serologyCount, sum(biochemistry_count) as biochemistryCount, sum(microbiology_count) as microbiologyCount, sum(xray_count) as xrayCount, sum(ecg_count) as ecgCount, sum(usg_count) as usgCount')
//                     ->where('year(create_date)',$acYear)
//                     ->where('ipd_opd', $section)
//                     ->where('create_date >= ', $startDate)
//                     ->where('create_date <= ', $endDate)
//                     ->get($table_name)
//                     ->row();
//             }
//             elseif($report_type == 'd'){
//                 $result = $this->db->select('create_date as date, snehan_count as snehanCount, swedan_count as swedanCount, vaman_count as vamanCount, virechan_count as virechanCount, nasya_count as nasyaCount, raktmokshan_count as raktmokshanCount, shirodhara_count as shirodharaCount, shirobasti_count as shirobastiCount, uttarbasti_count as uttarbastiCount, basti_count as bastiCount, yonidhavan_count as yonidhavanCount, yonipichu_count as yonipichuCount, others_count as othersCount, hematology_count as hematologyCount, serology_count as serologyCount, biochemistry_count as biochemistryCount, microbiology_count as microbiologyCount, xray_count as xrayCount, ecg_count as ecgCount, usg_count as usgCount')
//                     ->where('year(create_date)',$acYear)
//                     ->where('ipd_opd', $section)
//                     ->where('create_date >= ', $startDate)
//                     ->where('create_date <= ', $endDate)
//                     ->get($table_name)
//                     ->result();
//             }
//             elseif($report_type == 'm'){
//                 $result = array();
//                 for($i=1; $i<=12; $i++){
//                     $month_start_date = $acYear.'-'.$i.'-01';
//                     $month_end_date = date("Y-m-t", strtotime($month_start_date));
                    
//                     $result_month_count = $this->db->select('sum(snehan_count) as snehanCount, sum(swedan_count) as swedanCount, sum(vaman_count) as vamanCount, sum(virechan_count) as virechanCount, sum(nasya_count) as nasyaCount, sum(raktmokshan_count) as raktmokshanCount, sum(shirodhara_count) as shirodharaCount, sum(shirobasti_count) as shirobastiCount, sum(uttarbasti_count) as uttarbastiCount, sum(basti_count) as bastiCount, sum(yonidhavan_count) as yonidhavanCount, sum(yonipichu_count) as yonipichuCount, sum(others_count) as othersCount, sum(hematology_count) as hematologyCount, sum(serology_count) as serologyCount, sum(biochemistry_count) as biochemistryCount, sum(microbiology_count) as microbiologyCount, sum(xray_count) as xrayCount, sum(ecg_count) as ecgCount, sum(usg_count) as usgCount')
//                         ->where('year(create_date)',$acYear)
//                         ->where('ipd_opd', $section)
//                         ->where('create_date >= ', $month_start_date)
//                         ->where('create_date <= ', $month_end_date)
//                         ->get($table_name)
//                         ->row_array();
                        
//                     array_push($result, $result_month_count);
//                 }
//             }
//             elseif($report_type == 'dm'){
                
//             }
//         }else{
//             if($report_type == 'y'){
//                 $result = $this->db->select('sum(snehan_count) as snehanCount, sum(swedan_count) as swedanCount, sum(vaman_count) as vamanCount, sum(virechan_count) as virechanCount, sum(nasya_count) as nasyaCount, sum(raktmokshan_count) as raktmokshanCount, sum(shirodhara_count) as shirodharaCount, sum(shirobasti_count) as shirobastiCount, sum(uttarbasti_count) as uttarbastiCount, sum(basti_count) as bastiCount, sum(yonidhavan_count) as yonidhavanCount, sum(yonipichu_count) as yonipichuCount, sum(others_count) as othersCount, sum(hematology_count) as hematologyCount, sum(serology_count) as serologyCount, sum(biochemistry_count) as biochemistryCount, sum(microbiology_count) as microbiologyCount, sum(xray_count) as xrayCount, sum(ecg_count) as ecgCount, sum(usg_count) as usgCount')
//                     ->where('year(create_date)',$acYear)
//                     ->where('ipd_opd', $section)
//                     ->where('create_date >= ', $startDate)
//                     ->where('create_date <= ', $endDate)
//                     ->get($table_name)
//                     ->row();
//             }
//             elseif($report_type == 'd'){
//                 $result = $this->db->select('create_date as date, snehan_count as snehanCount, swedan_count as swedanCount, vaman_count as vamanCount, virechan_count as virechanCount, nasya_count as nasyaCount, raktmokshan_count as raktmokshanCount, shirodhara_count as shirodharaCount, shirobasti_count as shirobastiCount, uttarbasti_count as uttarbastiCount, basti_count as bastiCount, yonidhavan_count as yonidhavanCount, yonipichu_count as yonipichuCount, others_count as othersCount, hematology_count as hematologyCount, serology_count as serologyCount, biochemistry_count as biochemistryCount, microbiology_count as microbiologyCount, xray_count as xrayCount, ecg_count as ecgCount, usg_count as usgCount')
//                     ->where('year(create_date)',$acYear)
//                     ->where('ipd_opd', $section)
//                     ->where('create_date >= ', $startDate)
//                     ->where('create_date <= ', $endDate)
//                     ->get($table_name)
//                     ->result();
//             }
//             elseif($report_type == 'm'){
//                 $result = array();
//                 for($i=1; $i<=12; $i++){
//                     $month_start_date = $acYear.'-'.$i.'-01';
//                     $month_end_date = date("Y-m-t", strtotime($month_start_date));
                    
//                     $result_month_count = $this->db->select('sum(snehan_count) as snehanCount, sum(swedan_count) as swedanCount, sum(vaman_count) as vamanCount, sum(virechan_count) as virechanCount, sum(nasya_count) as nasyaCount, sum(raktmokshan_count) as raktmokshanCount, sum(shirodhara_count) as shirodharaCount, sum(shirobasti_count) as shirobastiCount, sum(uttarbasti_count) as uttarbastiCount, sum(basti_count) as bastiCount, sum(yonidhavan_count) as yonidhavanCount, sum(yonipichu_count) as yonipichuCount, sum(others_count) as othersCount, sum(hematology_count) as hematologyCount, sum(serology_count) as serologyCount, sum(biochemistry_count) as biochemistryCount, sum(microbiology_count) as microbiologyCount, sum(xray_count) as xrayCount, sum(ecg_count) as ecgCount, sum(usg_count) as usgCount')
//                         ->where('year(create_date)',$acYear)
//                         ->where('ipd_opd', $section)
//                         ->where('create_date >= ', $month_start_date)
//                         ->where('create_date <= ', $month_end_date)
//                         ->get($table_name)
//                         ->row_array();
                        
//                     array_push($result, $result_month_count);
//                 }
//             }
//             elseif($report_type == 'dm'){
                
//             }
//         }
//         $data['section'] = $section;
//         $data['report_cat'] = $report_cat;
//         $data['report_type'] = $report_type;
//         $data['other_reg'] = $other_reg;
//         $data['resultData'] = $result;
//         if($type == 'investi'){
//             if($report_type == 'y'){
//                 $data['content'] = $this->load->view('patient_investi_count_report',$data,true);
//             }elseif($report_type == 'd'){
//                 $data['content'] = $this->load->view('patient_investi_datewise_count_report',$data,true);
//             }elseif($report_type == 'm'){
//                 $data['content'] = $this->load->view('patient_investi_monthwise_count_report',$data,true);
//             }
//         }elseif($type == 'xray_investi'){
//             if($report_type == 'y'){
//                 $data['content'] = $this->load->view('patient_investi_count_report_xray',$data,true);
//             }elseif($report_type == 'd'){
//                 $data['content'] = $this->load->view('patient_investi_datewise_count_report_xray',$data,true);
//             }elseif($report_type == 'm'){
//                 $data['content'] = $this->load->view('patient_investi_monthwise_count_report_xray',$data,true);
//             }
//         }elseif($type == 'ecg_investi'){
//             if($report_type == 'y'){
//                 $data['content'] = $this->load->view('patient_investi_count_report_ecg',$data,true);
//             }elseif($report_type == 'd'){
//                 $data['content'] = $this->load->view('patient_investi_datewise_count_report_ecg',$data,true);
//             }elseif($report_type == 'm'){
//                 $data['content'] = $this->load->view('patient_investi_monthwise_count_report_ecg',$data,true);
//             }
//         }elseif($type == 'usg_investi'){
//             if($report_type == 'y'){
//                 $data['content'] = $this->load->view('patient_investi_count_report_usg',$data,true);
//             }elseif($report_type == 'd'){
//                 $data['content'] = $this->load->view('patient_investi_datewise_count_report_usg',$data,true);
//             }elseif($report_type == 'm'){
//                 $data['content'] = $this->load->view('patient_investi_monthwise_count_report_usg',$data,true);
//             }
//         }elseif($type == 'panch'){
//             if($report_type == 'y'){
//                 if($other_reg == 'o'){
//                     $data['content'] = $this->load->view('patient_other_panch_count_report',$data,true);
//                 }else{
//                     $data['content'] = $this->load->view('patient_panch_count_report',$data,true);
//                 }
//             }elseif($report_type == 'd'){
//                 if($other_reg == 'o'){
//                     $data['content'] = $this->load->view('patient_other_panch_datewise_count_report',$data,true);
//                 }else{
//                     $data['content'] = $this->load->view('patient_panch_datewise_count_report',$data,true);
//                 }
//             }elseif($report_type == 'm'){
//                 if($other_reg == 'o'){
//                     $data['content'] = $this->load->view('patient_other_panch_monthwise_count_report',$data,true);
//                 }else{
//                     $data['content'] = $this->load->view('patient_panch_monthwise_count_report',$data,true);
//                 }
//             }
//         }
        
// 		$this->load->view('layout/main_wrapper',$data);
//     }
    
    
    
    /////////////////////////////////////////////////////// Panchkarma ///////////////////////////////////////////////////////////////
	
	 public function getInvestiPanchCount($section = NULL, $type = NULL, $report_cat = NULL, $report_type = NULL, $other_reg = NULL)
    {
        $acYear = $this->session->userdata['acyear'];
        
        if($report_cat == 'pt'){ 
            if($section == 'opd'){
                $table_name = 'investi_patient_count_opd';
            }else{
                $table_name = 'investi_patient_count_ipd';
            }
        }else{ 
            if($section == 'opd'){
                $table_name = 'investi_patient_count_opd'; 
            }else{
                $table_name = 'investi_patient_count_ipd';
            }
        }
        
        if($report_type == 'y' || $report_type == 'd'){
            
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');
            
            if($start_date && $end_date){
                $data['datefrom'] = $startDate = date('Y-m-d', strtotime($start_date));
                $data['dateto'] = $endDate = date('Y-m-d', strtotime($end_date));
            }
            else{
                $data['datefrom'] = $startDate = $acYear.'-01-01';
                $data['dateto'] = $endDate = $acYear.'-12-31';
            }
        }elseif($report_type == 'dm'){
            $month_id = $this->input->get('month_id');
            $start_date = $acyear.'-'.$month_id.'-01';
            $end_date = date("Y-m-t", strtotime($start_date));
            $data['datefrom'] = $startDate = date('Y-m-d', strtotime($start_date));
            $data['dateto'] = $endDate = date('Y-m-d', strtotime($end_date));
        
        }elseif($report_type == 'm'){
            $data['datefrom'] = $startDate = $acYear.'-01-01';
            $data['dateto'] = $endDate = $acYear.'-12-31';
        }
        
        if($section == 'opd'){
            if($report_type == 'y'){
                // $result = $this->db->select('Count(hematology) as hematologyCount, Count(serology) as serologyCount, Count(biochemistry) as biochemistryCount, Count(microbiology) as microbiologyCount, Count(xray) as xrayCount, Count(ecg) as ecgCount, Count(usg) as usgCount')
                //     ->where('year(create_date)',$acYear)
                //     ->where('ipd_opd', $section)
                //     ->where('create_date >= ', $startDate)
                //     ->where('create_date <= ', $endDate)
                //     ->get($table_name)
                //     ->row();
				 $result = $this->db->select('
                
                            SUM(LENGTH(REPLACE(hematology, \' \', \'\')) - LENGTH(REGEXP_REPLACE(REPLACE(hematology, \' \', \'\'), \'[,]+\', \'\')) + 1) AS hematologyCount,
                SUM(LENGTH(REPLACE(serology, \' \', \'\')) - LENGTH(REGEXP_REPLACE(REPLACE(serology, \' \', \'\'), \'[,]+\', \'\')) + 1) AS serologyCount,
                SUM(LENGTH(REPLACE(biochemistry, \' \', \'\')) - LENGTH(REGEXP_REPLACE(REPLACE(biochemistry, \' \', \'\'), \'[,]+\', \'\')) + 1) AS biochemistryCount,
                SUM(LENGTH(REPLACE(microbiology, \' \', \'\')) - LENGTH(REGEXP_REPLACE(REPLACE(microbiology, \' \', \'\'), \'[,]+\', \'\')) + 1) AS microbiologyCount'
                   )

                    ->where('year(create_date)',$acYear)
                    ->where('ipd_opd', $section)
                    ->where('create_date >= ', $startDate)
                    ->where('create_date <= ', $endDate)
                    ->get($table_name)
                    ->row();
            }
            elseif($report_type == 'd'){
                // $result = $this->db->select('create_date as date,Count(hematology) as hematologyCount, Count(serology) as serologyCount, Count(biochemistry) as biochemistryCount, Count(microbiology) as microbiologyCount, Count(xray) as xrayCount, Count(ecg) as ecgCount, Count(usg) as usgCount')
                //     ->where('year(create_date)',$acYear)
                //     ->where('ipd_opd', $section)
                //     ->where('create_date >= ', $startDate)
                //     ->where('create_date <= ', $endDate)
				// 	->group_by('create_date')
                //     ->get($table_name)
                //     ->result();
					// print_r($this->db->last_query());

					 $result = $this->db->select('create_date as date,
                        SUM(LENGTH(REPLACE(hematology, \' \', \'\')) - LENGTH(REGEXP_REPLACE(REPLACE(hematology, \' \', \'\'), \'[,]+\', \'\')) + 1) AS hematologyCount,
            SUM(LENGTH(REPLACE(serology, \' \', \'\')) - LENGTH(REGEXP_REPLACE(REPLACE(serology, \' \', \'\'), \'[,]+\', \'\')) + 1) AS serologyCount,
            SUM(LENGTH(REPLACE(biochemistry, \' \', \'\')) - LENGTH(REGEXP_REPLACE(REPLACE(biochemistry, \' \', \'\'), \'[,]+\', \'\')) + 1) AS biochemistryCount,
            SUM(LENGTH(REPLACE(microbiology, \' \', \'\')) - LENGTH(REGEXP_REPLACE(REPLACE(microbiology, \' \', \'\'), \'[,]+\', \'\')) + 1) AS microbiologyCount')
                    ->where('year(create_date)',$acYear)
                    ->where('ipd_opd', $section)
                    ->where('create_date >= ', $startDate)
                    ->where('create_date <= ', $endDate)
                    ->group_by('create_date')
                    ->get($table_name)
                    ->result();
            }
            elseif($report_type == 'm'){
                $result = array();
                for($i=1; $i<=12; $i++){
                    $month_start_date = $acYear.'-'.$i.'-01';
                    $month_end_date = date("Y-m-t", strtotime($month_start_date));
                    
                    // $result_month_count = $this->db->select('Count(hematology) as hematologyCount, Count(serology) as serologyCount, Count(biochemistry) as biochemistryCount, Count(microbiology) as microbiologyCount, Count(xray) as xrayCount, Count(ecg) as ecgCount, Count(usg) as usgCount')
                    //     ->where('year(create_date)',$acYear)
                    //     ->where('ipd_opd', $section)
                    //     ->where('create_date >= ', $month_start_date)
                    //     ->where('create_date <= ', $month_end_date)
                    //     ->get($table_name)
                    //     ->row_array();
					 $result_month_count = $this->db->select(' 
                                    SUM(LENGTH(REPLACE(hematology, \' \', \'\')) - LENGTH(REGEXP_REPLACE(REPLACE(hematology, \' \', \'\'), \'[,]+\', \'\')) + 1) AS hematologyCount,
                    SUM(LENGTH(REPLACE(serology, \' \', \'\')) - LENGTH(REGEXP_REPLACE(REPLACE(serology, \' \', \'\'), \'[,]+\', \'\')) + 1) AS serologyCount,
                    SUM(LENGTH(REPLACE(biochemistry, \' \', \'\')) - LENGTH(REGEXP_REPLACE(REPLACE(biochemistry, \' \', \'\'), \'[,]+\', \'\')) + 1) AS biochemistryCount,
                    SUM(LENGTH(REPLACE(microbiology, \' \', \'\')) - LENGTH(REGEXP_REPLACE(REPLACE(microbiology, \' \', \'\'), \'[,]+\', \'\')) + 1) AS microbiologyCount')

                        ->where('year(create_date)',$acYear)
                        ->where('ipd_opd', $section)
                        ->where('create_date >= ', $month_start_date)
                        ->where('create_date <= ', $month_end_date)
                        ->get($table_name)
                        ->row_array();
                        
                    array_push($result, $result_month_count);
                }
            }
            elseif($report_type == 'dm'){
                
            }
        }else{
            if($report_type == 'y'){
                //  $result = $this->db->select('Count(hematology) as hematologyCount, Count(serology) as serologyCount, Count(biochemistry) as biochemistryCount, Count(microbiology) as microbiologyCount, Count(xray) as xrayCount, Count(ecg) as ecgCount, Count(usg) as usgCount')
                //     ->where('year(create_date)',$acYear)
                //     ->where('ipd_opd', $section)
                //     ->where('create_date >= ', $startDate)
                //     ->where('create_date <= ', $endDate)
                //     ->get($table_name)
                //     ->row();
				$result = $this->db->select('
                
                    SUM(LENGTH(REPLACE(hematology, \' \', \'\')) - LENGTH(REGEXP_REPLACE(REPLACE(hematology, \' \', \'\'), \'[,]+\', \'\')) + 1) AS hematologyCount,
                    SUM(LENGTH(REPLACE(serology, \' \', \'\')) - LENGTH(REGEXP_REPLACE(REPLACE(serology, \' \', \'\'), \'[,]+\', \'\')) + 1) AS serologyCount,
                    SUM(LENGTH(REPLACE(biochemistry, \' \', \'\')) - LENGTH(REGEXP_REPLACE(REPLACE(biochemistry, \' \', \'\'), \'[,]+\', \'\')) + 1) AS biochemistryCount,
                    SUM(LENGTH(REPLACE(microbiology, \' \', \'\')) - LENGTH(REGEXP_REPLACE(REPLACE(microbiology, \' \', \'\'), \'[,]+\', \'\')) + 1) AS microbiologyCount'
                   )
                    ->where('year(create_date)',$acYear)
                    ->where('ipd_opd', $section)
                    ->where('create_date >= ', $startDate)
                    ->where('create_date <= ', $endDate)
                    ->get($table_name)
                    ->row();
                    
                     
            }
            elseif($report_type == 'd'){
                // $result = $this->db->select('create_date as date,Count(hematology) as hematologyCount, Count(serology) as serologyCount, Count(biochemistry) as biochemistryCount, Count(microbiology) as microbiologyCount, Count(xray) as xrayCount, Count(ecg) as ecgCount, Count(usg) as usgCount')
                //     ->where('year(create_date)',$acYear)
                //     ->where('ipd_opd', $section)
                //     ->where('create_date >= ', $startDate)
                //     ->where('create_date <= ', $endDate)
				// 	->group_by('create_date')
                //     ->get($table_name)
                //     ->result();

				   $result = $this->db->select('create_date as date,
                SUM(LENGTH(REPLACE(hematology, \' \', \'\')) - LENGTH(REGEXP_REPLACE(REPLACE(hematology, \' \', \'\'), \'[,]+\', \'\')) + 1) AS hematologyCount,
                SUM(LENGTH(REPLACE(serology, \' \', \'\')) - LENGTH(REGEXP_REPLACE(REPLACE(serology, \' \', \'\'), \'[,]+\', \'\')) + 1) AS serologyCount,
                SUM(LENGTH(REPLACE(biochemistry, \' \', \'\')) - LENGTH(REGEXP_REPLACE(REPLACE(biochemistry, \' \', \'\'), \'[,]+\', \'\')) + 1) AS biochemistryCount,
                SUM(LENGTH(REPLACE(microbiology, \' \', \'\')) - LENGTH(REGEXP_REPLACE(REPLACE(microbiology, \' \', \'\'), \'[,]+\', \'\')) + 1) AS microbiologyCount,')
                    ->where('year(create_date)',$acYear)
                    ->where('ipd_opd', $section)
                    ->where('create_date >= ', $startDate)
                    ->where('create_date <= ', $endDate)
                    ->get($table_name)
                    ->result();
            }
            elseif($report_type == 'm'){
                $result = array();
                for($i=1; $i<=12; $i++){
                    $month_start_date = $acYear.'-'.$i.'-01';
                    $month_end_date = date("Y-m-t", strtotime($month_start_date));
                    
                //   $result_month_count = $this->db->select('Count(hematology) as hematologyCount, Count(serology) as serologyCount, Count(biochemistry) as biochemistryCount, Count(microbiology) as microbiologyCount, Count(xray) as xrayCount, Count(ecg) as ecgCount, Count(usg) as usgCount')
                //         ->where('year(create_date)',$acYear)
                //         ->where('ipd_opd', $section)
                //         ->where('create_date >= ', $month_start_date)
                //         ->where('create_date <= ', $month_end_date)
                //         ->get($table_name)
                //         ->row_array();
                        

						 $result_month_count = $this->db->select('  SUM(LENGTH(REPLACE(hematology, \' \', \'\')) - LENGTH(REGEXP_REPLACE(REPLACE(hematology, \' \', \'\'), \'[,]+\', \'\')) + 1) AS hematologyCount,
                    SUM(LENGTH(REPLACE(serology, \' \', \'\')) - LENGTH(REGEXP_REPLACE(REPLACE(serology, \' \', \'\'), \'[,]+\', \'\')) + 1) AS serologyCount,
                    SUM(LENGTH(REPLACE(biochemistry, \' \', \'\')) - LENGTH(REGEXP_REPLACE(REPLACE(biochemistry, \' \', \'\'), \'[,]+\', \'\')) + 1) AS biochemistryCount,
                    SUM(LENGTH(REPLACE(microbiology, \' \', \'\')) - LENGTH(REGEXP_REPLACE(REPLACE(microbiology, \' \', \'\'), \'[,]+\', \'\')) + 1) AS microbiologyCount')
                        ->where('year(create_date)',$acYear)
                        ->where('ipd_opd', $section)
                        ->where('create_date >= ', $month_start_date)
                        ->where('create_date <= ', $month_end_date)
                        ->get($table_name)
                        ->row_array();
                    array_push($result, $result_month_count);
                }
            }
            elseif($report_type == 'dm'){
                
            }
        }
        
        $data['section'] = $section;
        $data['report_cat'] = $report_cat;
        $data['report_type'] = $report_type;
        $data['other_reg'] = $other_reg;
        $data['resultData'] = $result;
        if($type == 'investi'){
            if($report_type == 'y'){
                $data['content'] = $this->load->view('patient_investi_count_report',$data,true);
            }elseif($report_type == 'd'){
                $data['content'] = $this->load->view('patient_investi_datewise_count_report',$data,true);
            }elseif($report_type == 'm'){
                $data['content'] = $this->load->view('patient_investi_monthwise_count_report',$data,true);
            }
        }elseif($type == 'xray_investi'){
            if($report_type == 'y'){
                $data['content'] = $this->load->view('patient_investi_count_report_xray',$data,true);
            }elseif($report_type == 'd'){
                $data['content'] = $this->load->view('patient_investi_datewise_count_report_xray',$data,true);
            }elseif($report_type == 'm'){
                $data['content'] = $this->load->view('patient_investi_monthwise_count_report_xray',$data,true);
            }
        }elseif($type == 'ecg_investi'){
            if($report_type == 'y'){
                $data['content'] = $this->load->view('patient_investi_count_report_ecg',$data,true);
            }elseif($report_type == 'd'){
                $data['content'] = $this->load->view('patient_investi_datewise_count_report_ecg',$data,true);
            }elseif($report_type == 'm'){
                $data['content'] = $this->load->view('patient_investi_monthwise_count_report_ecg',$data,true);
            }
        }elseif($type == 'usg_investi'){
            if($report_type == 'y'){
                $data['content'] = $this->load->view('patient_investi_count_report_usg',$data,true);
            }elseif($report_type == 'd'){
                $data['content'] = $this->load->view('patient_investi_datewise_count_report_usg',$data,true);
            }elseif($report_type == 'm'){
                $data['content'] = $this->load->view('patient_investi_monthwise_count_report_usg',$data,true);
            }
        }elseif($type == 'panch'){
            if($report_type == 'y'){
                if($other_reg == 'o'){
                    $data['content'] = $this->load->view('patient_other_panch_count_report',$data,true);
                }else{
                    $data['content'] = $this->load->view('patient_panch_count_report',$data,true);
                }
            }elseif($report_type == 'd'){
                if($other_reg == 'o'){
                    $data['content'] = $this->load->view('patient_other_panch_datewise_count_report',$data,true);
                }else{
                    $data['content'] = $this->load->view('patient_panch_datewise_count_report',$data,true);
                }
            }elseif($report_type == 'm'){
                if($other_reg == 'o'){
                    $data['content'] = $this->load->view('patient_other_panch_monthwise_count_report',$data,true);
                }else{
                    $data['content'] = $this->load->view('patient_panch_monthwise_count_report',$data,true);
                }
            }
        }
        
		$this->load->view('layout/main_wrapper',$data);
    }
  
  
  
  
  
    public function getInvestiPanchCount1($section = NULL, $type = NULL, $report_cat = NULL, $report_type = NULL, $other_reg = NULL)
    {
        $acYear = $this->session->userdata['acyear'];
        
        if($report_cat == 'pt'){ 
            if($section == 'opd'){
                $table_name = 'panchkarma_patient_count_opd';
            }else{
                $table_name = 'panchkarma_patient_count_ipd';
            }
        }else{ 
            if($section == 'opd'){
                $table_name = '	panchkarma_patient_count_opd'; 
            }else{
                $table_name = '	panchkarma_patient_count_ipd';
            }
        }
        
        if($report_type == 'y' || $report_type == 'd'){
            
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');
            
            if($start_date && $end_date){
                $data['datefrom'] = $startDate = date('Y-m-d', strtotime($start_date));
                $data['dateto'] = $endDate = date('Y-m-d', strtotime($end_date));
            }
            else{
                $data['datefrom'] = $startDate = $acYear.'-01-01';
                $data['dateto'] = $endDate = $acYear.'-12-31';
            }
        }elseif($report_type == 'dm'){
            $month_id = $this->input->get('month_id');
            $start_date = $acyear.'-'.$month_id.'-01';
            $end_date = date("Y-m-t", strtotime($start_date));
            $data['datefrom'] = $startDate = date('Y-m-d', strtotime($start_date));
            $data['dateto'] = $endDate = date('Y-m-d', strtotime($end_date));
        
        }elseif($report_type == 'm'){
            $data['datefrom'] = $startDate = $acYear.'-01-01';
            $data['dateto'] = $endDate = $acYear.'-12-31';
        }
        
        if($section == 'opd')
        {
            if($report_type == 'y'){
                $result = $this->db->select('COUNT(snehan) as snehanCount, COUNT(swedan) as swedanCount, COUNT(vaman) as vamanCount, COUNT(virechan) as virechanCount, COUNT(nasya) as nasyaCount, COUNT(raktmokshan) as raktmokshanCount, COUNT(shirodhara) as shirodharaCount, COUNT(shirobasti) as shirobastiCount, COUNT(uttarbasti) as uttarbastiCount, COUNT(basti) as bastiCount, COUNT(yonidhavan) as yonidhavanCount, COUNT(yonipichu) as yonipichuCount, COUNT(others) as othersCount, COUNT(hematology) as hematologyCount, COUNT(serology) as serologyCount, COUNT(biochemistry) as biochemistryCount, COUNT(microbiology) as microbiologyCount, COUNT(xray) as xrayCount, COUNT(ecg) as ecgCount, COUNT(usg) as usgCount')

                    ->where('year(create_date)',$acYear)
                    ->where('ipd_opd', $section)
                    ->where('create_date >= ', $startDate)
                    ->where('create_date <= ', $endDate)
                    ->get($table_name)
                    ->row();
            }
            elseif($report_type == 'd'){
                $result = $this->db->select('create_date as date, COUNT(snehan) as snehanCount, COUNT(swedan) as swedanCount, COUNT(vaman) as vamanCount, COUNT(virechan) as virechanCount, COUNT(nasya) as nasyaCount, COUNT(raktmokshan) as raktmokshanCount, COUNT(shirodhara) as shirodharaCount, COUNT(shirobasti) as shirobastiCount, COUNT(uttarbasti) as uttarbastiCount, COUNT(basti) as bastiCount, COUNT(yonidhavan) as yonidhavanCount, COUNT(yonipichu) as yonipichuCount, COUNT(others) as othersCount, COUNT(hematology) as hematologyCount, COUNT(serology) as serologyCount, COUNT(biochemistry) as biochemistryCount, COUNT(microbiology) as microbiologyCount, COUNT(xray) as xrayCount, COUNT(ecg) as ecgCount, COUNT(usg) as usgCount')
                    ->where('year(create_date)',$acYear)
                    ->where('ipd_opd', $section)
                    ->where('create_date >= ', $startDate)
                    ->where('create_date <= ', $endDate)
                    ->group_by('create_date')
                    ->get($table_name)
                    ->result();
            }
            elseif($report_type == 'm'){
                $result = array();
                for($i=1; $i<=12; $i++){
                    $month_start_date = $acYear.'-'.$i.'-01';
                    $month_end_date = date("Y-m-t", strtotime($month_start_date));
                    
                    $result_month_count = $this->db->select('COUNT(snehan) as snehanCount, COUNT(swedan) as swedanCount, COUNT(vaman) as vamanCount, COUNT(virechan) as virechanCount, COUNT(nasya) as nasyaCount, COUNT(raktmokshan) as raktmokshanCount, COUNT(shirodhara) as shirodharaCount, COUNT(shirobasti) as shirobastiCount, COUNT(uttarbasti) as uttarbastiCount, COUNT(basti) as bastiCount, COUNT(yonidhavan) as yonidhavanCount, COUNT(yonipichu) as yonipichuCount, COUNT(others) as othersCount, COUNT(hematology) as hematologyCount, COUNT(serology) as serologyCount, COUNT(biochemistry) as biochemistryCount, COUNT(microbiology) as microbiologyCount, COUNT(xray) as xrayCount, COUNT(ecg) as ecgCount, COUNT(usg) as usgCount')
                        ->where('year(create_date)',$acYear)
                        ->where('ipd_opd', $section)
                        ->where('create_date >= ', $month_start_date)
                        ->where('create_date <= ', $month_end_date)
                        ->get($table_name)
                        ->row_array();
                        
                    array_push($result, $result_month_count);
                }
            }
            elseif($report_type == 'dm'){
                
            }
        }else
        {
            if($report_type == 'y'){
                $result = $this->db->select('COUNT(snehan) as snehanCount, COUNT(swedan) as swedanCount, COUNT(vaman) as vamanCount, COUNT(virechan) as virechanCount, COUNT(nasya) as nasyaCount, COUNT(raktmokshan) as raktmokshanCount, COUNT(shirodhara) as shirodharaCount, COUNT(shirobasti) as shirobastiCount, COUNT(uttarbasti) as uttarbastiCount, COUNT(basti) as bastiCount, COUNT(yonidhavan) as yonidhavanCount, COUNT(yonipichu) as yonipichuCount, COUNT(others) as othersCount, COUNT(hematology) as hematologyCount, COUNT(serology) as serologyCount, COUNT(biochemistry) as biochemistryCount, COUNT(microbiology) as microbiologyCount, COUNT(xray) as xrayCount, COUNT(ecg) as ecgCount, COUNT(usg) as usgCount')
                    ->where('year(create_date)',$acYear)
                    ->where('ipd_opd', $section)
                    ->where('create_date >= ', $startDate)
                    ->where('create_date <= ', $endDate)
                    ->get($table_name)
                    ->row();
                    
                     
            }
            elseif($report_type == 'd'){
                $result = $this->db->select('create_date as date, COUNT(snehan) as snehanCount, COUNT(swedan) as swedanCount, COUNT(vaman) as vamanCount, COUNT(virechan) as virechanCount, COUNT(nasya) as nasyaCount, COUNT(raktmokshan) as raktmokshanCount, COUNT(shirodhara) as shirodharaCount, COUNT(shirobasti) as shirobastiCount, COUNT(uttarbasti) as uttarbastiCount, COUNT(basti) as bastiCount, COUNT(yonidhavan) as yonidhavanCount, COUNT(yonipichu) as yonipichuCount, COUNT(others) as othersCount, COUNT(hematology) as hematologyCount, COUNT(serology) as serologyCount, COUNT(biochemistry) as biochemistryCount, COUNT(microbiology) as microbiologyCount, COUNT(xray) as xrayCount, COUNT(ecg) as ecgCount, COUNT(usg) as usgCount')
                    ->where('year(create_date)',$acYear)
                    ->where('ipd_opd', $section)
                    ->where('create_date >= ', $startDate)
                    ->where('create_date <= ', $endDate)
                    ->group_by('create_date')
                    ->get($table_name)
                    ->result();
            }
            elseif($report_type == 'm'){
                $result = array();
                for($i=1; $i<=12; $i++){
                    $month_start_date = $acYear.'-'.$i.'-01';
                    $month_end_date = date("Y-m-t", strtotime($month_start_date));
                    
                    $result_month_count = $this->db->select('COUNT(snehan) as snehanCount, COUNT(swedan) as swedanCount, COUNT(vaman) as vamanCount, COUNT(virechan) as virechanCount, COUNT(nasya) as nasyaCount, COUNT(raktmokshan) as raktmokshanCount, COUNT(shirodhara) as shirodharaCount, COUNT(shirobasti) as shirobastiCount, COUNT(uttarbasti) as uttarbastiCount, COUNT(basti) as bastiCount, COUNT(yonidhavan) as yonidhavanCount, COUNT(yonipichu) as yonipichuCount, COUNT(others) as othersCount, COUNT(hematology) as hematologyCount, COUNT(serology) as serologyCount, COUNT(biochemistry) as biochemistryCount, COUNT(microbiology) as microbiologyCount, COUNT(xray) as xrayCount, COUNT(ecg) as ecgCount, COUNT(usg) as usgCount')
                        ->where('year(create_date)',$acYear)
                        ->where('ipd_opd', $section)
                        ->where('create_date >= ', $month_start_date)
                        ->where('create_date <= ', $month_end_date)
                        ->get($table_name)
                        ->row_array();
                        
                    array_push($result, $result_month_count);
                }
            }
            elseif($report_type == 'dm'){
                
            }
        }
        
        $data['section'] = $section;
        $data['report_cat'] = $report_cat;
        $data['report_type'] = $report_type;
        $data['other_reg'] = $other_reg;
        $data['resultData'] = $result;
        if($type == 'investi'){
            if($report_type == 'y'){
                $data['content'] = $this->load->view('patient_investi_count_report',$data,true);
            }elseif($report_type == 'd'){
                $data['content'] = $this->load->view('patient_investi_datewise_count_report',$data,true);
            }elseif($report_type == 'm'){
                $data['content'] = $this->load->view('patient_investi_monthwise_count_report',$data,true);
            }
        }elseif($type == 'xray_investi'){
            if($report_type == 'y'){
                $data['content'] = $this->load->view('patient_investi_count_report_xray',$data,true);
            }elseif($report_type == 'd'){
                $data['content'] = $this->load->view('patient_investi_datewise_count_report_xray',$data,true);
            }elseif($report_type == 'm'){
                $data['content'] = $this->load->view('patient_investi_monthwise_count_report_xray',$data,true);
            }
        }elseif($type == 'ecg_investi'){
            if($report_type == 'y'){
                $data['content'] = $this->load->view('patient_investi_count_report_ecg',$data,true);
            }elseif($report_type == 'd'){
                $data['content'] = $this->load->view('patient_investi_datewise_count_report_ecg',$data,true);
            }elseif($report_type == 'm'){
                $data['content'] = $this->load->view('patient_investi_monthwise_count_report_ecg',$data,true);
            }
        }elseif($type == 'usg_investi'){
            if($report_type == 'y'){
                $data['content'] = $this->load->view('patient_investi_count_report_usg',$data,true);
            }elseif($report_type == 'd'){
                $data['content'] = $this->load->view('patient_investi_datewise_count_report_usg',$data,true);
            }elseif($report_type == 'm'){
                $data['content'] = $this->load->view('patient_investi_monthwise_count_report_usg',$data,true);
            }
        }elseif($type == 'panch'){
            if($report_type == 'y'){
                if($other_reg == 'o'){
                    $data['content'] = $this->load->view('patient_other_panch_count_report',$data,true);
                }else{
                    $data['content'] = $this->load->view('patient_panch_count_report',$data,true);
                }
            }elseif($report_type == 'd'){
                if($other_reg == 'o'){
                    $data['content'] = $this->load->view('patient_other_panch_datewise_count_report',$data,true);
                }else{
                    $data['content'] = $this->load->view('patient_panch_datewise_count_report',$data,true);
                }
            }elseif($report_type == 'm'){
                if($other_reg == 'o'){
                    $data['content'] = $this->load->view('patient_other_panch_monthwise_count_report',$data,true);
                }else{
                    $data['content'] = $this->load->view('patient_panch_monthwise_count_report',$data,true);
                }
            }
        }
        
		$this->load->view('layout/main_wrapper',$data);
    }

    /////////////////////////////////////////////////////// END Panchkarma ///////////////////////////////////////////////////////////////
	
	
	public function male_female_count_panch()
	{
	    $year = '%'.$this->session->userdata['acyear'].'%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1   = $this->input->get('end_date', TRUE);
		$start_date2 = date('Y-m-d',strtotime($start_date1));
		$end_date2   = date('Y-m-d',strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
        $start_date= $start_date2;
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] =$section;
		
		if($section=='opd')
		{
		    $table='investi_panch_opd_patient_count';
		}
		else
		{
		    $table='investi_panch_ipd_patient_count';
		}
		
		
		//for male count start
		$data['SnehanCount'] = $this->db->select('COUNT(`snehan`) as SnehanCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('snehan !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		      //  print_r ($this->db->last_query());
		        
		        $data['SwedanCount'] = $this->db->select('COUNT(`swedan`) as SwedanCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('swedan !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		     //   print_r ($this->db->last_query());
		        
		        $data['VamanCount'] = $this->db->select('COUNT(`vaman`) as VamanCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('vaman !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		     //   print_r ($this->db->last_query());
		        
		        $data['VirechanCount'] = $this->db->select('COUNT(`virechan`) as VirechanCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('virechan !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		        //print_r ($this->db->last_query());
		        
		        $data['NasyaCount'] = $this->db->select('COUNT(`nasya`) as NasyaCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('nasya !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		       // print_r ($this->db->last_query());
		        
		        $data['RaktmokshanCount'] = $this->db->select('COUNT(`raktmokshan`) as RaktmokshanCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('raktmokshan !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		       // print_r ($this->db->last_query());
		        
		        $data['ShirodharaCount'] = $this->db->select('COUNT(`shirodhara`) as ShirodharaCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('shirodhara !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		       // print_r ($this->db->last_query());
		       
		       $data['ShirobastiCount'] = $this->db->select('COUNT(`shirobasti`) as ShirobastiCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('shirobasti !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		       // print_r ($this->db->last_query());
		        
		        $data['BastiCount'] = $this->db->select('COUNT(`basti`) as BastiCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        //->where('basti !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		      //  print_r ($this->db->last_query());
		        
		        
		        
		        $data['OthersCount'] = $this->db->select('COUNT(`others`) as OthersCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('others !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		        
		       // print_r ($this->db->last_query());
		        
		
		//for male count end
		
		
		
			//for female count start
		        $data['FSnehanCount'] = $this->db->select('COUNT(`snehan`) as FSnehanCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('snehan !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		        //print_r ($this->db->last_query());
		        
		        $data['FSwedanCount'] = $this->db->select('COUNT(`swedan`) as FSwedanCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('swedan !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		     //   print_r ($this->db->last_query());
		        
		        $data['FVamanCount'] = $this->db->select('COUNT(`vaman`) as FVamanCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('vaman !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		     //   print_r ($this->db->last_query());
		        
		        $data['FVirechanCount'] = $this->db->select('COUNT(`virechan`) as FVirechanCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('virechan !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		        //print_r ($this->db->last_query());
		        
		        $data['FNasyaCount'] = $this->db->select('COUNT(`nasya`) as FNasyaCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('nasya !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		       // print_r ($this->db->last_query());
		        
		        $data['FRaktmokshanCount'] = $this->db->select('COUNT(`raktmokshan`) as FRaktmokshanCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('raktmokshan !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		       // print_r ($this->db->last_query());
		        
		        $data['FShirodharaCount'] = $this->db->select('COUNT(`shirodhara`) as FShirodharaCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('shirodhara !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		       // print_r ($this->db->last_query());
		        
		        $data['FShirobastiCount'] = $this->db->select('COUNT(`shirobasti`) as FShirobastiCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('shirobasti !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		       // print_r ($this->db->last_query());
		       
		        $data['FBastiCount'] = $this->db->select('COUNT(`basti`) as FBastiCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        //->where('basti !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		       // print_r ($this->db->last_query());
		        
		        
		        
		        $data['FOthersCount'] = $this->db->select('COUNT(`others`) as FOthersCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('others !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		        
		       // print_r ($this->db->last_query());
		        
		
		//for female count end
		
		
		
	    //$data['data1']='1';
	    $data['content'] = $this->load->view('male_female_count',$data,true);
	    $this->load->view('layout/main_wrapper',$data);
	}
	public function male_list_panch()
	{
	    
	    $year = '%'.$this->session->userdata['acyear'].'%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1   = $this->input->get('end_date', TRUE);
		$start_date2 = date('Y-m-d',strtotime($start_date1));
		$end_date2   = date('Y-m-d',strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
        $start_date= $start_date2;
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] =$section;
		
		
		if($section=='opd')
		{
		    $table='investi_panch_opd_patient_count';
		   //$table1 = 'patient';
		}
		else
		{
		    $table='investi_panch_ipd_patient_count';
		    //$table1 = 'patient_ipd';
		}
	
            
            $data['panchResult'] = $this->db->select('*')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        //->where('snehan !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		       // print_r ($this->db->last_query());
	
        
		$data['SnehanCount'] = $this->db->select('COUNT(`snehan`) as SnehanCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('snehan !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		      //  print_r ($this->db->last_query());
		        
		        $data['SwedanCount'] = $this->db->select('COUNT(`swedan`) as SwedanCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('swedan !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		     //   print_r ($this->db->last_query());
		        
		        $data['VamanCount'] = $this->db->select('COUNT(`vaman`) as VamanCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('vaman !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		     //   print_r ($this->db->last_query());
		        
		        $data['VirechanCount'] = $this->db->select('COUNT(`virechan`) as VirechanCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('virechan !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		        //print_r ($this->db->last_query());
		        
		        $data['NasyaCount'] = $this->db->select('COUNT(`nasya`) as NasyaCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('nasya !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		       // print_r ($this->db->last_query());
		        
		        $data['RaktmokshanCount'] = $this->db->select('COUNT(`raktmokshan`) as RaktmokshanCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('raktmokshan !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		       // print_r ($this->db->last_query());
		        
		        $data['ShirodharaCount'] = $this->db->select('COUNT(`shirodhara`) as ShirodharaCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('shirodhara !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		       // print_r ($this->db->last_query());
		       
		       $data['ShirobastiCount'] = $this->db->select('COUNT(`shirobasti`) as ShirobastiCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('shirobasti !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		       // print_r ($this->db->last_query());
		        
		        $data['BastiCount'] = $this->db->select('COUNT(`basti`) as BastiCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        //->where('basti !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		      //  print_r ($this->db->last_query());
		        
		        
		        
		        $data['OthersCount'] = $this->db->select('COUNT(`others`) as OthersCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('others !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		        
		       // print_r ($this->db->last_query());
		        
		
		//for male count end
		
		
		
		
	
		
		
		//$data['data1']='1';
	    $data['content'] = $this->load->view('male_list_panch',$data,true);
	    $this->load->view('layout/main_wrapper',$data);
	}
	public function female_list_panch()
	{
	    
	    $year = '%'.$this->session->userdata['acyear'].'%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1   = $this->input->get('end_date', TRUE);
		$start_date2 = date('Y-m-d',strtotime($start_date1));
		$end_date2   = date('Y-m-d',strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
        $start_date= $start_date2;
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] =$section;
		
		
		if($section=='opd')
		{
		    $table='investi_panch_opd_patient_count';
		   //$table1 = 'patient';
		}
		else
		{
		    $table='investi_panch_ipd_patient_count';
		    //$table1 = 'patient_ipd';
		}
	
            
            $data['panchResult'] = $this->db->select('*')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        //->where('snehan !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		       // print_r ($this->db->last_query());
	
        
		$data['SnehanCount'] = $this->db->select('COUNT(`snehan`) as SnehanCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('snehan !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		      //  print_r ($this->db->last_query());
		        
		        $data['SwedanCount'] = $this->db->select('COUNT(`swedan`) as SwedanCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('swedan !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		     //   print_r ($this->db->last_query());
		        
		        $data['VamanCount'] = $this->db->select('COUNT(`vaman`) as VamanCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('vaman !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		     //   print_r ($this->db->last_query());
		        
		        $data['VirechanCount'] = $this->db->select('COUNT(`virechan`) as VirechanCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('virechan !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		        //print_r ($this->db->last_query());
		        
		        $data['NasyaCount'] = $this->db->select('COUNT(`nasya`) as NasyaCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('nasya !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		       // print_r ($this->db->last_query());
		        
		        $data['RaktmokshanCount'] = $this->db->select('COUNT(`raktmokshan`) as RaktmokshanCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('raktmokshan !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		       // print_r ($this->db->last_query());
		        
		        $data['ShirodharaCount'] = $this->db->select('COUNT(`shirodhara`) as ShirodharaCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('shirodhara !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		       // print_r ($this->db->last_query());
		       
		       $data['ShirobastiCount'] = $this->db->select('COUNT(`shirobasti`) as ShirobastiCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('shirobasti !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		       // print_r ($this->db->last_query());
		        
		        $data['BastiCount'] = $this->db->select('COUNT(`basti`) as BastiCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        //->where('basti !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		      //  print_r ($this->db->last_query());
		        
		        
		        
		        $data['OthersCount'] = $this->db->select('COUNT(`others`) as OthersCount')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('others !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		        
		       // print_r ($this->db->last_query());
		        
		
		//for male count end
		
		
		
		
	
		
		
		//$data['data1']='1';
	    $data['content'] = $this->load->view('female_list_panch',$data,true);
	    $this->load->view('layout/main_wrapper',$data);
	}
	

    public function male_female_testwise_count()
	{
	    $year = '%'.$this->session->userdata['acyear'].'%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1   = $this->input->get('end_date', TRUE);
		$start_date2 = date('Y-m-d',strtotime($start_date1));
		$end_date2   = date('Y-m-d',strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
        $start_date= $start_date2;
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] =$section;
		
		if($section=='opd')
		{
		    $table='investi_panch_opd_patient_count';
		}
		else
		{
		    $table='investi_panch_ipd_patient_count';
		}
		
		
		//for male count start
		$HMCount = $this->db->select('*')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('hematology !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		        
		        
		        if($HMCount)
		        {
		            $h = 0;
		          foreach($HMCount as $hm )
		          {
    		          $hme = $hm->hematology;
    		        // echo "<br>";
    		         $hmex = explode(",",$hme);
    		        // print_r($hmex);
    		         $hmcount = count($hmex);
    		        //print_r ($hmcount);
    		        $data['Hemotology_male'] = $h += $hmcount;
    		       //print_r($c) ;
		          }
		        }
		        else
		        {
		            $data['Hemotology_male'] = '0';
		        }
		        
               // print_r ($this->db->last_query());
		        
		        
		        $SECount = $this->db->select('*')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('serology !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		        
		        if($SECount)
		        {
		            
		          $s = 0;
		          foreach($SECount as $se )
		          {
    		          $sen = $se->serology;
    		         //echo "<br>";
    		         $seex = explode(",",$sen);
    		         $secount = count($seex);
    		        // print_r ($d);
    		        $data['Serology_male'] = $s += $secount;
    		       //print_r($c) ;
		          }
		        }else
		        {
		            $data['Serology_male'] = '0';
		        }
		     //   print_r ($this->db->last_query());
		        
		        $BICount = $this->db->select('*')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('biochemistry !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		        
		        if($BICount)
		        {
		        $b = 0;
		          foreach($BICount as $bi )
		          {
    		          $bin = $bi->biochemistry;
    		         //echo "<br>";
    		         $biex = explode(",",$bin);
    		         $bicount = count($biex);
    		        // print_r ($d);
    		        $data['Biochemical_male'] = $b += $bicount;
    		       //print_r($c) ;
		          }
		        }else
		        {
		            $data['Biochemical_male'] = '0';
		        }
		     //   print_r ($this->db->last_query());
		        
		        $MICount = $this->db->select('*')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('microbiology !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		        
		        if($MICount){
		        $m = 0;
		          foreach($MICount as $mi )
		          {
    		          $min = $bi->microbiology;
    		         //echo "<br>";
    		         $miex = explode(",",$min);
    		         $micount = count($miex);
    		        // print_r ($d);
    		        $data['Microbiology_male'] = $m += $micount;
    		       //print_r($c) ;
		          }
		        }
		        else
		        {
		            $data['Microbiology_male'] = '0';
		        }
		        
		       // print_r ($this->db->last_query());
		        
		//for male count end
		
		
		
			//for female count start
		       $FHMCount = $this->db->select('*')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('hematology !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		        
		        if($FHMCount)
		        {
		         $fh = 0;
		          foreach($FHMCount as $fhm )
		          {
    		          $fhme = $fhm->hematology;
    		         //echo "<br>";
    		         $fhmex = explode(",",$fhme);
    		         $fhmcount = count($fhmex);
    		        // print_r ($d);
    		        $data['Hemotology_female'] = $fh += $fhmcount;
    		       //print_r($c) ;
		          }
		        }
		        else
		        {
		            $data['Hemotology_female'] = '0';
		        }
		        
		        //print_r ($this->db->last_query());
		        
		        $FSECount = $this->db->select('*')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('serology !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		        
		        
		         //   print_r ($this->db->last_query());
		         if($FSECount){
		        $fs = 0;
		          foreach($FSECount as $fse )
		          {
    		          $fsen = $fse->serology;
    		         //echo "<br>";
    		         $fseex = explode(",",$fsen);
    		         $fsecount = count($fseex);
    		        // print_r ($d);
    		        $data['Serology_female'] = $fs += $fsecount;
    		       //print_r($c) ;
		          }
		        
		         }else
		         {
		             $data['Serology_female'] = '0';
		         }
		        
		        $FBICount = $this->db->select('*')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('biochemistry !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		        
		        if($FBICount){
		        $fb = 0;
		          foreach($FBICount as $fbi )
		          {
    		          $fbin = $fbi->biochemistry;
    		         //echo "<br>";
    		         $fbiex = explode(",",$fbin);
    		         $fbicount = count($fbiex);
    		        // print_r ($d);
    		        $data['Biochemical_female'] = $fb += $fbicount;
    		       //print_r($c) ;
		          }
		        }else{
		            $data['Biochemical_female'] = '0';
		        }
		        
		        
		       // print_r ($this->db->last_query());
		        
		        $FMICount = $this->db->select('*')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('microbiology !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		        
		        if($FMICount){
		        $fm = 0;
		          foreach($FMICount as $fmi )
		          {
    		          $fmin = $fmi->microbiology;
    		         //echo "<br>";
    		         $fmiex = explode(",",$fmin);
    		         $fmicount = count($fmiex);
    		        // print_r ($d);
    		        $data['Microbiology_female'] = $fm += $fmicount;
    		       //print_r($c) ;
		          }
		        }else{
		            $data['Microbiology_female'] = '0';
		        }
		        
		        
		      //  print_r ($this->db->last_query());
		        
		        
		        
		
		//for female count end
		
		
		
	    //$data['data1']='1';
	    $data['content'] = $this->load->view('male_female_testwise_count',$data,true);
	    $this->load->view('layout/main_wrapper',$data);
	}
	
	
	public function male_list_testwise_investigation()
	{
	    
	    $year = '%'.$this->session->userdata['acyear'].'%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1   = $this->input->get('end_date', TRUE);
		$start_date2 = date('Y-m-d',strtotime($start_date1));
		$end_date2   = date('Y-m-d',strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
        $start_date= $start_date2;
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] =$section;
		
		
		if($section=='opd')
		{
		    $table='investi_panch_opd_patient_count';
		   //$table1 = 'patient';
		}
		else
		{
		    $table='investi_panch_ipd_patient_count';
		    //$table1 = 'patient_ipd';
		}
	

	
	$query = $this->db->select('*')
		->from($table)
		->where('create_date >=',$start_date2)
		->where('create_date <=',$end_date2)
		->where('sex','M')
		->get()
		->result();
			$data['investiResultTest'] = $query;
		
		
		
		$HMCount = $this->db->select('*')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('hematology !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		        
		        
		        if($HMCount)
		        {
		            $h = 0;
		          foreach($HMCount as $hm )
		          {
    		          $hme = $hm->hematology;
    		         //echo "<br>";
    		         $hmex = explode(",",$hme);
    		         $hmcount = count($hmex);
    		        // print_r ($d);
    		        $data['Hemotology_male'] = $h += $hmcount;
    		       //print_r($c) ;
		          }
		        }else{
		            $data['Hemotology_male'] = '0';
		        }
		        
               // print_r ($this->db->last_query());
		        
		        
		        $SECount = $this->db->select('*')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('serology !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		        
		        if($SECount)
		        {
		            
		          $s = 0;
		          foreach($SECount as $se )
		          {
    		          $sen = $se->serology;
    		         //echo "<br>";
    		         $seex = explode(",",$sen);
    		         $secount = count($seex);
    		        // print_r ($d);
    		        $data['Serology_male'] = $s += $secount;
    		       //print_r($c) ;
		          }
		        }else
		        {
		            $data['Serology_male'] = '0';
		        }
		     //   print_r ($this->db->last_query());
		        
		        $BICount = $this->db->select('*')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('biochemistry !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		        
		        if($BICount)
		        {
		        $b = 0;
		          foreach($BICount as $bi )
		          {
    		          $bin = $bi->biochemistry;
    		         //echo "<br>";
    		         $biex = explode(",",$bin);
    		         $bicount = count($biex);
    		        // print_r ($d);
    		        $data['Biochemical_male'] = $b += $bicount;
    		       //print_r($c) ;
		          }
		        }else
		        {
		            $data['Biochemical_male'] = '0';
		        }
		     //   print_r ($this->db->last_query());
		        
		        $MICount = $this->db->select('*')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('microbiology !=', '')
		        ->where('sex', 'M')
		        ->get()
		        ->result();
		        
		        if($MICount){
		        $m = 0;
		          foreach($MICount as $mi )
		          {
    		          $min = $bi->microbiology;
    		         //echo "<br>";
    		         $miex = explode(",",$min);
    		         $micount = count($miex);
    		        // print_r ($d);
    		        $data['Microbiology_male'] = $m += $micount;
    		       //print_r($c) ;
		          }
		        }
		        else
		        {
		            $data['Microbiology_male'] = '0';
		        }
		
	//	print_r ($this->db->last_query());
	
		
		
		//$data['data1']='1';
	    $data['content'] = $this->load->view('male_list_testwise_investigation',$data,true);
	    $this->load->view('layout/main_wrapper',$data);
	}
	public function female_list_testwise_investigation()
	{
	    
	    $year = '%'.$this->session->userdata['acyear'].'%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1   = $this->input->get('end_date', TRUE);
		$start_date2 = date('Y-m-d',strtotime($start_date1));
		$end_date2   = date('Y-m-d',strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
        $start_date= $start_date2;
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] =$section;
		
		
		if($section=='opd')
		{
		    $table='investi_panch_opd_patient_count';
		   //$table1 = 'patient';
		}
		else
		{
		    $table='investi_panch_ipd_patient_count';
		    //$table1 = 'patient_ipd';
		}
	

	
	$query = $this->db->select('*')
		->from($table)
		->where('create_date >=',$start_date2)
		->where('create_date <=',$end_date2)
		->where('sex','F')
		->get()
		->result();
			$data['investiResultTest'] = $query;
		
			//for female count start
		       $FHMCount = $this->db->select('*')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('hematology !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		        
		        if($FHMCount)
		        {
		         $fh = 0;
		          foreach($FHMCount as $fhm )
		          {
    		          $fhme = $fhm->hematology;
    		         //echo "<br>";
    		         $fhmex = explode(",",$fhme);
    		         $fhmcount = count($fhmex);
    		        // print_r ($d);
    		        $data['Hemotology_female'] = $fh += $fhmcount;
    		       //print_r($c) ;
		          }
		        }
		        else
		        {
		            $data['Hemotology_female'] = '0';
		        }
		        
		        //print_r ($this->db->last_query());
		        
		        $FSECount = $this->db->select('*')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('serology !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		        
		        
		         //   print_r ($this->db->last_query());
		         if($FSECount){
		        $fs = 0;
		          foreach($FSECount as $fse )
		          {
    		          $fsen = $fse->serology;
    		         //echo "<br>";
    		         $fseex = explode(",",$fsen);
    		         $fsecount = count($fseex);
    		        // print_r ($d);
    		        $data['Serology_female'] = $fs += $fsecount;
    		       //print_r($c) ;
		          }
		        
		         }else
		         {
		             $data['Serology_female'] = '0';
		         }
		        
		        $FBICount = $this->db->select('*')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('biochemistry !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		        
		        if($FBICount){
		        $fb = 0;
		          foreach($FBICount as $fbi )
		          {
    		          $fbin = $fbi->biochemistry;
    		         //echo "<br>";
    		         $fbiex = explode(",",$fbin);
    		         $fbicount = count($fbiex);
    		        // print_r ($d);
    		        $data['Biochemical_female'] = $fb += $fbicount;
    		       //print_r($c) ;
		          }
		        }else{
		            $data['Biochemical_female'] = '0';
		        }
		        
		        
		       // print_r ($this->db->last_query());
		        
		        $FMICount = $this->db->select('*')
		        ->from($table)
		        ->where('create_date>=',$start_date2)
		        ->where('create_date<=',$end_date2)
		        ->where('microbiology !=', '')
		        ->where('sex', 'F')
		        ->get()
		        ->result();
		        
		        if($FMICount){
		        $fm = 0;
		          foreach($FMICount as $fmi )
		          {
    		          $fmin = $fmi->microbiology;
    		         //echo "<br>";
    		         $fmiex = explode(",",$fmin);
    		         $fmicount = count($fmiex);
    		        // print_r ($d);
    		        $data['Microbiology_female'] = $fm += $fmicount;
    		       //print_r($c) ;
		          }
		        }else{
		            $data['Microbiology_female'] = '0';
		        }
		        
		        
		      //  print_r ($this->db->last_query());
		        
		        
		        
		
		//for female count end
	//	print_r ($this->db->last_query());
	
		
		
		//$data['data1']='1';
	    $data['content'] = $this->load->view('female_list_testwise_investigation',$data,true);
	    $this->load->view('layout/main_wrapper',$data);
	}
  
   public function getInvestiPanchCount2($section = NULL, $type = NULL, $report_cat = NULL, $report_type = NULL, $other_reg = NULL)
    {
        $acYear = $this->session->userdata['acyear'];
        
        if($report_cat == 'pt'){ 
            if($section == 'opd'){
                $table_name = 'xray_total_count_opd';
            }else{
                $table_name = 'xray_total_count_ipd';
            }
        }else{ 
            if($section == 'opd'){
                $table_name = 'xray_total_count_opd'; 
            }else{
                $table_name = 'xray_total_count_ipd';
            }
        }
        
        if($report_type == 'y' || $report_type == 'd'){
            
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');
            
            if($start_date && $end_date){
                $data['datefrom'] = $startDate = date('Y-m-d', strtotime($start_date));
                $data['dateto'] = $endDate = date('Y-m-d', strtotime($end_date));
            }
            else{
                $data['datefrom'] = $startDate = $acYear.'-01-01';
                $data['dateto'] = $endDate = $acYear.'-12-31';
            }
        }elseif($report_type == 'dm'){
            $month_id = $this->input->get('month_id');
            $start_date = $acyear.'-'.$month_id.'-01';
            $end_date = date("Y-m-t", strtotime($start_date));
            $data['datefrom'] = $startDate = date('Y-m-d', strtotime($start_date));
            $data['dateto'] = $endDate = date('Y-m-d', strtotime($end_date));
        
        }elseif($report_type == 'm'){
            $data['datefrom'] = $startDate = $acYear.'-01-01';
            $data['dateto'] = $endDate = $acYear.'-12-31';
        }
        
        if($section == 'opd'){
            if($report_type == 'y'){
                $result = $this->db->select('sum(xray_count) as xrayCount')
                    ->where('year(create_date)',$acYear)
                    ->where('ipd_opd', $section)
                    ->where('create_date >= ', $startDate)
                    ->where('create_date <= ', $endDate)
                    ->get($table_name)
                    ->row();
            }
            elseif($report_type == 'd'){
                $result = $this->db->select('create_date as date,xray_count as xrayCount')
                    ->where('year(create_date)',$acYear)
                    ->where('ipd_opd', $section)
                    ->where('create_date >= ', $startDate)
                    ->where('create_date <= ', $endDate)
                    ->get($table_name)
                    ->result();
             
            }
            elseif($report_type == 'm'){
                $result = array();
                for($i=1; $i<=12; $i++){
                    $month_start_date = $acYear.'-'.$i.'-01';
                    $month_end_date = date("Y-m-t", strtotime($month_start_date));
                     $result_month_count = $this->db->select('sum(xray_count) as xrayCount')
                  //  $result_month_count = $this->db->select('sum(snehan_count) as snehanCount, sum(swedan_count) as swedanCount, sum(vaman_count) as vamanCount, sum(virechan_count) as virechanCount, sum(nasya_count) as nasyaCount, sum(raktmokshan_count) as raktmokshanCount, sum(shirodhara_count) as shirodharaCount, sum(shirobasti_count) as shirobastiCount, sum(uttarbasti_count) as uttarbastiCount, sum(basti_count) as bastiCount, sum(yonidhavan_count) as yonidhavanCount, sum(yonipichu_count) as yonipichuCount, sum(others_count) as othersCount, sum(hematology_count) as hematologyCount, sum(serology_count) as serologyCount, sum(biochemistry_count) as biochemistryCount, sum(microbiology_count) as microbiologyCount, sum(xray_count) as xrayCount, sum(ecg_count) as ecgCount, sum(usg_count) as usgCount')
                        ->where('year(create_date)',$acYear)
                        ->where('ipd_opd', $section)
                        ->where('create_date >= ', $month_start_date)
                        ->where('create_date <= ', $month_end_date)
                        ->get($table_name)
                        ->row_array();
                        
                    array_push($result, $result_month_count);
                }
            }
            elseif($report_type == 'dm'){
                
            }
        }else{
            if($report_type == 'y'){
              $result = $this->db->select('sum(xray_count) as xrayCount')
               // $result = $this->db->select('sum(snehan_count) as snehanCount, sum(swedan_count) as swedanCount, sum(vaman_count) as vamanCount, sum(virechan_count) as virechanCount, sum(nasya_count) as nasyaCount, sum(raktmokshan_count) as raktmokshanCount, sum(shirodhara_count) as shirodharaCount, sum(shirobasti_count) as shirobastiCount, sum(uttarbasti_count) as uttarbastiCount, sum(basti_count) as bastiCount, sum(yonidhavan_count) as yonidhavanCount, sum(yonipichu_count) as yonipichuCount, sum(others_count) as othersCount, sum(hematology_count) as hematologyCount, sum(serology_count) as serologyCount, sum(biochemistry_count) as biochemistryCount, sum(microbiology_count) as microbiologyCount, sum(xray_count) as xrayCount, sum(ecg_count) as ecgCount, sum(usg_count) as usgCount')
                    ->where('year(create_date)',$acYear)
                    ->where('ipd_opd', $section)
                    ->where('create_date >= ', $startDate)
                    ->where('create_date <= ', $endDate)
                    ->get($table_name)
                    ->row();
                    
                     
            }
            elseif($report_type == 'd'){
              $result = $this->db->select('create_date as date, xray_count as xrayCount')
              //  $result = $this->db->select('create_date as date, snehan_count as snehanCount, swedan_count as swedanCount, vaman_count as vamanCount, virechan_count as virechanCount, nasya_count as nasyaCount, raktmokshan_count as raktmokshanCount, shirodhara_count as shirodharaCount, shirobasti_count as shirobastiCount, uttarbasti_count as uttarbastiCount, basti_count as bastiCount, yonidhavan_count as yonidhavanCount, yonipichu_count as yonipichuCount, others_count as othersCount, hematology_count as hematologyCount, serology_count as serologyCount, biochemistry_count as biochemistryCount, microbiology_count as microbiologyCount, xray_count as xrayCount, ecg_count as ecgCount, usg_count as usgCount')
                    ->where('year(create_date)',$acYear)
                    ->where('ipd_opd', $section)
                    ->where('create_date >= ', $startDate)
                    ->where('create_date <= ', $endDate)
                    ->get($table_name)
                    ->result();
            }
            elseif($report_type == 'm'){
                $result = array();
                for($i=1; $i<=12; $i++){
                    $month_start_date = $acYear.'-'.$i.'-01';
                    $month_end_date = date("Y-m-t", strtotime($month_start_date));
                    $result_month_count = $this->db->select('sum(xray_count) as xrayCount')
                 //   $result_month_count = $this->db->select('sum(snehan_count) as snehanCount, sum(swedan_count) as swedanCount, sum(vaman_count) as vamanCount, sum(virechan_count) as virechanCount, sum(nasya_count) as nasyaCount, sum(raktmokshan_count) as raktmokshanCount, sum(shirodhara_count) as shirodharaCount, sum(shirobasti_count) as shirobastiCount, sum(uttarbasti_count) as uttarbastiCount, sum(basti_count) as bastiCount, sum(yonidhavan_count) as yonidhavanCount, sum(yonipichu_count) as yonipichuCount, sum(others_count) as othersCount, sum(hematology_count) as hematologyCount, sum(serology_count) as serologyCount, sum(biochemistry_count) as biochemistryCount, sum(microbiology_count) as microbiologyCount, sum(xray_count) as xrayCount, sum(ecg_count) as ecgCount, sum(usg_count) as usgCount')
                        ->where('year(create_date)',$acYear)
                        ->where('ipd_opd', $section)
                        ->where('create_date >= ', $month_start_date)
                        ->where('create_date <= ', $month_end_date)
                        ->get($table_name)
                        ->row_array();
                        
                    array_push($result, $result_month_count);
                }
            }
            elseif($report_type == 'dm'){
                
            }
        }
        
        $data['section'] = $section;
        $data['report_cat'] = $report_cat;
        $data['report_type'] = $report_type;
        $data['other_reg'] = $other_reg;
        $data['resultData'] = $result;
        if($type == 'investi'){
            if($report_type == 'y'){
                $data['content'] = $this->load->view('patient_investi_count_report',$data,true);
            }elseif($report_type == 'd'){
                $data['content'] = $this->load->view('patient_investi_datewise_count_report',$data,true);
            }elseif($report_type == 'm'){
                $data['content'] = $this->load->view('patient_investi_monthwise_count_report',$data,true);
            }
        }elseif($type == 'xray_investi'){
            if($report_type == 'y'){
                $data['content'] = $this->load->view('patient_investi_count_report_xray',$data,true);
            }elseif($report_type == 'd'){
                $data['content'] = $this->load->view('patient_investi_datewise_count_report_xray',$data,true);
            }elseif($report_type == 'm'){
                $data['content'] = $this->load->view('patient_investi_monthwise_count_report_xray',$data,true);
            }
        }elseif($type == 'ecg_investi'){
            if($report_type == 'y'){
                $data['content'] = $this->load->view('patient_investi_count_report_ecg',$data,true);
            }elseif($report_type == 'd'){
                $data['content'] = $this->load->view('patient_investi_datewise_count_report_ecg',$data,true);
            }elseif($report_type == 'm'){
                $data['content'] = $this->load->view('patient_investi_monthwise_count_report_ecg',$data,true);
            }
        }elseif($type == 'usg_investi'){
            if($report_type == 'y'){
                $data['content'] = $this->load->view('patient_investi_count_report_usg',$data,true);
            }elseif($report_type == 'd'){
                $data['content'] = $this->load->view('patient_investi_datewise_count_report_usg',$data,true);
            }elseif($report_type == 'm'){
                $data['content'] = $this->load->view('patient_investi_monthwise_count_report_usg',$data,true);
            }
        }elseif($type == 'panch'){
            if($report_type == 'y'){
                if($other_reg == 'o'){
                    $data['content'] = $this->load->view('patient_other_panch_count_report',$data,true);
                }else{
                    $data['content'] = $this->load->view('patient_panch_count_report',$data,true);
                }
            }elseif($report_type == 'd'){
                if($other_reg == 'o'){
                    $data['content'] = $this->load->view('patient_other_panch_datewise_count_report',$data,true);
                }else{
                    $data['content'] = $this->load->view('patient_panch_datewise_count_report',$data,true);
                }
            }elseif($report_type == 'm'){
                if($other_reg == 'o'){
                    $data['content'] = $this->load->view('patient_other_panch_monthwise_count_report',$data,true);
                }else{
                    $data['content'] = $this->load->view('patient_panch_monthwise_count_report',$data,true);
                }
            }
        }
        
		$this->load->view('layout/main_wrapper',$data);
    }

  
   public function getInvestiPanchCount3($section = NULL, $type = NULL, $report_cat = NULL, $report_type = NULL, $other_reg = NULL)
    {
        $acYear = $this->session->userdata['acyear'];
        
        if($report_cat == 'pt'){ 
            if($section == 'opd'){
                $table_name = 'ecg_total_count_opd';
            }else{
                $table_name = 'ecg_total_count_ipd';
            }
        }else{ 
            if($section == 'opd'){
                $table_name = 'ecg_test_total_count_opd'; 
            }else{
                $table_name = 'ecg_test_total_count_ipd';
            }
        }
        
        if($report_type == 'y' || $report_type == 'd'){
            
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');
            
            if($start_date && $end_date){
                $data['datefrom'] = $startDate = date('Y-m-d', strtotime($start_date));
                $data['dateto'] = $endDate = date('Y-m-d', strtotime($end_date));
            }
            else{
                $data['datefrom'] = $startDate = $acYear.'-01-01';
                $data['dateto'] = $endDate = $acYear.'-12-31';
            }
        }elseif($report_type == 'dm'){
            $month_id = $this->input->get('month_id');
            $start_date = $acyear.'-'.$month_id.'-01';
            $end_date = date("Y-m-t", strtotime($start_date));
            $data['datefrom'] = $startDate = date('Y-m-d', strtotime($start_date));
            $data['dateto'] = $endDate = date('Y-m-d', strtotime($end_date));
        
        }elseif($report_type == 'm'){
            $data['datefrom'] = $startDate = $acYear.'-01-01';
            $data['dateto'] = $endDate = $acYear.'-12-31';
        }
        
        if($section == 'opd'){
            if($report_type == 'y'){
                $result = $this->db->select('sum(ecg_count) as ecgCount')
                    ->where('year(create_date)',$acYear)
                    ->where('ipd_opd', $section)
                    ->where('create_date >= ', $startDate)
                    ->where('create_date <= ', $endDate)
                    ->get($table_name)
                    ->row();
            }
           elseif($report_type == 'd'){
                $result = $this->db->select('create_date as date,ecg_count as ecgCount')
                    ->where('year(create_date)',$acYear)
                    ->where('ipd_opd', $section)
                    ->where('create_date >= ', $startDate)
                    ->where('create_date <= ', $endDate)
                    ->get($table_name)
                    ->result();
              // print_r($this->db->last_query());
            }
            elseif($report_type == 'm'){
                $result = array();
                for($i=1; $i<=12; $i++){
                    $month_start_date = $acYear.'-'.$i.'-01';
                    $month_end_date = date("Y-m-t", strtotime($month_start_date));
                     $result_month_count = $this->db->select('sum(ecg_count) as ecgCount')
                  //  $result_month_count = $this->db->select('sum(snehan_count) as snehanCount, sum(swedan_count) as swedanCount, sum(vaman_count) as vamanCount, sum(virechan_count) as virechanCount, sum(nasya_count) as nasyaCount, sum(raktmokshan_count) as raktmokshanCount, sum(shirodhara_count) as shirodharaCount, sum(shirobasti_count) as shirobastiCount, sum(uttarbasti_count) as uttarbastiCount, sum(basti_count) as bastiCount, sum(yonidhavan_count) as yonidhavanCount, sum(yonipichu_count) as yonipichuCount, sum(others_count) as othersCount, sum(hematology_count) as hematologyCount, sum(serology_count) as serologyCount, sum(biochemistry_count) as biochemistryCount, sum(microbiology_count) as microbiologyCount, sum(xray_count) as xrayCount, sum(ecg_count) as ecgCount, sum(usg_count) as usgCount')
                        ->where('year(create_date)',$acYear)
                        ->where('ipd_opd', $section)
                        ->where('create_date >= ', $month_start_date)
                        ->where('create_date <= ', $month_end_date)
                        ->get($table_name)
                        ->row_array();
                        
                    array_push($result, $result_month_count);
                }
            }
            elseif($report_type == 'dm'){
                
            }
        }else{
            if($report_type == 'y'){
              $result = $this->db->select('sum(ecg_count) as ecgCount')
               // $result = $this->db->select('sum(snehan_count) as snehanCount, sum(swedan_count) as swedanCount, sum(vaman_count) as vamanCount, sum(virechan_count) as virechanCount, sum(nasya_count) as nasyaCount, sum(raktmokshan_count) as raktmokshanCount, sum(shirodhara_count) as shirodharaCount, sum(shirobasti_count) as shirobastiCount, sum(uttarbasti_count) as uttarbastiCount, sum(basti_count) as bastiCount, sum(yonidhavan_count) as yonidhavanCount, sum(yonipichu_count) as yonipichuCount, sum(others_count) as othersCount, sum(hematology_count) as hematologyCount, sum(serology_count) as serologyCount, sum(biochemistry_count) as biochemistryCount, sum(microbiology_count) as microbiologyCount, sum(xray_count) as xrayCount, sum(ecg_count) as ecgCount, sum(usg_count) as usgCount')
                    ->where('year(create_date)',$acYear)
                    ->where('ipd_opd', $section)
                    ->where('create_date >= ', $startDate)
                    ->where('create_date <= ', $endDate)
                    ->get($table_name)
                    ->row();
                    
                     
            }
            elseif($report_type == 'd'){
              $result = $this->db->select('create_date as date,ecg_count as ecgCount')
              //  $result = $this->db->select('create_date as date, snehan_count as snehanCount, swedan_count as swedanCount, vaman_count as vamanCount, virechan_count as virechanCount, nasya_count as nasyaCount, raktmokshan_count as raktmokshanCount, shirodhara_count as shirodharaCount, shirobasti_count as shirobastiCount, uttarbasti_count as uttarbastiCount, basti_count as bastiCount, yonidhavan_count as yonidhavanCount, yonipichu_count as yonipichuCount, others_count as othersCount, hematology_count as hematologyCount, serology_count as serologyCount, biochemistry_count as biochemistryCount, microbiology_count as microbiologyCount, xray_count as xrayCount, ecg_count as ecgCount, usg_count as usgCount')
                    ->where('year(create_date)',$acYear)
                    ->where('ipd_opd', $section)
                    ->where('create_date >= ', $startDate)
                    ->where('create_date <= ', $endDate)
                    ->get($table_name)
                    ->result();
            }
            elseif($report_type == 'm'){
                $result = array();
                for($i=1; $i<=12; $i++){
                    $month_start_date = $acYear.'-'.$i.'-01';
                    $month_end_date = date("Y-m-t", strtotime($month_start_date));
                    $result_month_count = $this->db->select('sum(ecg_count) as ecgCount')
                 //   $result_month_count = $this->db->select('sum(snehan_count) as snehanCount, sum(swedan_count) as swedanCount, sum(vaman_count) as vamanCount, sum(virechan_count) as virechanCount, sum(nasya_count) as nasyaCount, sum(raktmokshan_count) as raktmokshanCount, sum(shirodhara_count) as shirodharaCount, sum(shirobasti_count) as shirobastiCount, sum(uttarbasti_count) as uttarbastiCount, sum(basti_count) as bastiCount, sum(yonidhavan_count) as yonidhavanCount, sum(yonipichu_count) as yonipichuCount, sum(others_count) as othersCount, sum(hematology_count) as hematologyCount, sum(serology_count) as serologyCount, sum(biochemistry_count) as biochemistryCount, sum(microbiology_count) as microbiologyCount, sum(xray_count) as xrayCount, sum(ecg_count) as ecgCount, sum(usg_count) as usgCount')
                        ->where('year(create_date)',$acYear)
                        ->where('ipd_opd', $section)
                        ->where('create_date >= ', $month_start_date)
                        ->where('create_date <= ', $month_end_date)
                        ->get($table_name)
                        ->row_array();
                        
                    array_push($result, $result_month_count);
                }
            }
            elseif($report_type == 'dm'){
                
            }
        }
        
        $data['section'] = $section;
        $data['report_cat'] = $report_cat;
        $data['report_type'] = $report_type;
        $data['other_reg'] = $other_reg;
        $data['resultData'] = $result;
        if($type == 'investi'){
            if($report_type == 'y'){
                $data['content'] = $this->load->view('patient_investi_count_report',$data,true);
            }elseif($report_type == 'd'){
                $data['content'] = $this->load->view('patient_investi_datewise_count_report',$data,true);
            }elseif($report_type == 'm'){
                $data['content'] = $this->load->view('patient_investi_monthwise_count_report',$data,true);
            }
        }elseif($type == 'xray_investi'){
            if($report_type == 'y'){
                $data['content'] = $this->load->view('patient_investi_count_report_xray',$data,true);
            }elseif($report_type == 'd'){
                $data['content'] = $this->load->view('patient_investi_datewise_count_report_xray',$data,true);
            }elseif($report_type == 'm'){
                $data['content'] = $this->load->view('patient_investi_monthwise_count_report_xray',$data,true);
            }
        }elseif($type == 'ecg_investi'){
            if($report_type == 'y'){
                $data['content'] = $this->load->view('patient_investi_count_report_ecg',$data,true);
            }elseif($report_type == 'd'){
                $data['content'] = $this->load->view('patient_investi_datewise_count_report_ecg',$data,true);
            }elseif($report_type == 'm'){
                $data['content'] = $this->load->view('patient_investi_monthwise_count_report_ecg',$data,true);
            }
        }elseif($type == 'usg_investi'){
            if($report_type == 'y'){
                $data['content'] = $this->load->view('patient_investi_count_report_usg',$data,true);
            }elseif($report_type == 'd'){
                $data['content'] = $this->load->view('patient_investi_datewise_count_report_usg',$data,true);
            }elseif($report_type == 'm'){
                $data['content'] = $this->load->view('patient_investi_monthwise_count_report_usg',$data,true);
            }
        }elseif($type == 'panch'){
            if($report_type == 'y'){
                if($other_reg == 'o'){
                    $data['content'] = $this->load->view('patient_other_panch_count_report',$data,true);
                }else{
                    $data['content'] = $this->load->view('patient_panch_count_report',$data,true);
                }
            }elseif($report_type == 'd'){
                if($other_reg == 'o'){
                    $data['content'] = $this->load->view('patient_other_panch_datewise_count_report',$data,true);
                }else{
                    $data['content'] = $this->load->view('patient_panch_datewise_count_report',$data,true);
                }
            }elseif($report_type == 'm'){
                if($other_reg == 'o'){
                    $data['content'] = $this->load->view('patient_other_panch_monthwise_count_report',$data,true);
                }else{
                    $data['content'] = $this->load->view('patient_panch_monthwise_count_report',$data,true);
                }
            }
        }
        
		$this->load->view('layout/main_wrapper',$data);
    }
    
  
  
   public function getInvestiPanchCount4($section = NULL, $type = NULL, $report_cat = NULL, $report_type = NULL, $other_reg = NULL)
    {
        $acYear = $this->session->userdata['acyear'];
        
        if($report_cat == 'pt'){ 
            if($section == 'opd'){
                $table_name = 'usg_total_count_opd';
            }else{
                $table_name = 'usg_total_count_ipd';
            }
        }else{ 
            if($section == 'opd'){
                $table_name = 'usg_test_total_count_opd'; 
            }else{
                $table_name = 'usg_test_total_count_ipd';
            }
        }
        
        if($report_type == 'y' || $report_type == 'd'){
            
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');
            
            if($start_date && $end_date){
                $data['datefrom'] = $startDate = date('Y-m-d', strtotime($start_date));
                $data['dateto'] = $endDate = date('Y-m-d', strtotime($end_date));
            }
            else{
                $data['datefrom'] = $startDate = $acYear.'-01-01';
                $data['dateto'] = $endDate = $acYear.'-12-31';
            }
        }elseif($report_type == 'dm'){
            $month_id = $this->input->get('month_id');
            $start_date = $acyear.'-'.$month_id.'-01';
            $end_date = date("Y-m-t", strtotime($start_date));
            $data['datefrom'] = $startDate = date('Y-m-d', strtotime($start_date));
            $data['dateto'] = $endDate = date('Y-m-d', strtotime($end_date));
        
        }elseif($report_type == 'm'){
            $data['datefrom'] = $startDate = $acYear.'-01-01';
            $data['dateto'] = $endDate = $acYear.'-12-31';
        }
        
        if($section == 'opd'){
            if($report_type == 'y'){
                $result = $this->db->select('sum(usg_count) as usgCount')
                    ->where('year(create_date)',$acYear)
                    ->where('ipd_opd', $section)
                    ->where('create_date >= ', $startDate)
                    ->where('create_date <= ', $endDate)
                    ->get($table_name)
                    ->row();
            }
           elseif($report_type == 'd'){
                $result = $this->db->select('create_date as date,usg_count as usgCount')
                    ->where('year(create_date)',$acYear)
                    ->where('ipd_opd', $section)
                    ->where('create_date >= ', $startDate)
                    ->where('create_date <= ', $endDate)
                    ->get($table_name)
                    ->result();
              // print_r($this->db->last_query());
            }
            elseif($report_type == 'm'){
                $result = array();
                for($i=1; $i<=12; $i++){
                    $month_start_date = $acYear.'-'.$i.'-01';
                    $month_end_date = date("Y-m-t", strtotime($month_start_date));
                     $result_month_count = $this->db->select('sum(usg_count) as usgCount')
                  //  $result_month_count = $this->db->select('sum(snehan_count) as snehanCount, sum(swedan_count) as swedanCount, sum(vaman_count) as vamanCount, sum(virechan_count) as virechanCount, sum(nasya_count) as nasyaCount, sum(raktmokshan_count) as raktmokshanCount, sum(shirodhara_count) as shirodharaCount, sum(shirobasti_count) as shirobastiCount, sum(uttarbasti_count) as uttarbastiCount, sum(basti_count) as bastiCount, sum(yonidhavan_count) as yonidhavanCount, sum(yonipichu_count) as yonipichuCount, sum(others_count) as othersCount, sum(hematology_count) as hematologyCount, sum(serology_count) as serologyCount, sum(biochemistry_count) as biochemistryCount, sum(microbiology_count) as microbiologyCount, sum(xray_count) as xrayCount, sum(ecg_count) as ecgCount, sum(usg_count) as usgCount')
                        ->where('year(create_date)',$acYear)
                        ->where('ipd_opd', $section)
                        ->where('create_date >= ', $month_start_date)
                        ->where('create_date <= ', $month_end_date)
                        ->get($table_name)
                        ->row_array();
                        
                    array_push($result, $result_month_count);
                }
            }
            elseif($report_type == 'dm'){
                
            }
        }else{
            if($report_type == 'y'){
              $result = $this->db->select('sum(usg_count) as usgCount')
               // $result = $this->db->select('sum(snehan_count) as snehanCount, sum(swedan_count) as swedanCount, sum(vaman_count) as vamanCount, sum(virechan_count) as virechanCount, sum(nasya_count) as nasyaCount, sum(raktmokshan_count) as raktmokshanCount, sum(shirodhara_count) as shirodharaCount, sum(shirobasti_count) as shirobastiCount, sum(uttarbasti_count) as uttarbastiCount, sum(basti_count) as bastiCount, sum(yonidhavan_count) as yonidhavanCount, sum(yonipichu_count) as yonipichuCount, sum(others_count) as othersCount, sum(hematology_count) as hematologyCount, sum(serology_count) as serologyCount, sum(biochemistry_count) as biochemistryCount, sum(microbiology_count) as microbiologyCount, sum(xray_count) as xrayCount, sum(ecg_count) as ecgCount, sum(usg_count) as usgCount')
                    ->where('year(create_date)',$acYear)
                    ->where('ipd_opd', $section)
                    ->where('create_date >= ', $startDate)
                    ->where('create_date <= ', $endDate)
                    ->get($table_name)
                    ->row();
                    
                     
            }
            elseif($report_type == 'd'){
              $result_month_count = $this->db->select('create_date as date,usg_count as usgCount')
              //  $result = $this->db->select('create_date as date, snehan_count as snehanCount, swedan_count as swedanCount, vaman_count as vamanCount, virechan_count as virechanCount, nasya_count as nasyaCount, raktmokshan_count as raktmokshanCount, shirodhara_count as shirodharaCount, shirobasti_count as shirobastiCount, uttarbasti_count as uttarbastiCount, basti_count as bastiCount, yonidhavan_count as yonidhavanCount, yonipichu_count as yonipichuCount, others_count as othersCount, hematology_count as hematologyCount, serology_count as serologyCount, biochemistry_count as biochemistryCount, microbiology_count as microbiologyCount, xray_count as xrayCount, ecg_count as ecgCount, usg_count as usgCount')
                    ->where('year(create_date)',$acYear)
                    ->where('ipd_opd', $section)
                    ->where('create_date >= ', $startDate)
                    ->where('create_date <= ', $endDate)
                    ->get($table_name)
                    ->result();
            }
            elseif($report_type == 'm'){
                $result = array();
                for($i=1; $i<=12; $i++){
                    $month_start_date = $acYear.'-'.$i.'-01';
                    $month_end_date = date("Y-m-t", strtotime($month_start_date));
                    $result_month_count = $this->db->select('sum(usg_count) as usgCount')
                 //   $result_month_count = $this->db->select('sum(snehan_count) as snehanCount, sum(swedan_count) as swedanCount, sum(vaman_count) as vamanCount, sum(virechan_count) as virechanCount, sum(nasya_count) as nasyaCount, sum(raktmokshan_count) as raktmokshanCount, sum(shirodhara_count) as shirodharaCount, sum(shirobasti_count) as shirobastiCount, sum(uttarbasti_count) as uttarbastiCount, sum(basti_count) as bastiCount, sum(yonidhavan_count) as yonidhavanCount, sum(yonipichu_count) as yonipichuCount, sum(others_count) as othersCount, sum(hematology_count) as hematologyCount, sum(serology_count) as serologyCount, sum(biochemistry_count) as biochemistryCount, sum(microbiology_count) as microbiologyCount, sum(xray_count) as xrayCount, sum(ecg_count) as ecgCount, sum(usg_count) as usgCount')
                        ->where('year(create_date)',$acYear)
                        ->where('ipd_opd', $section)
                        ->where('create_date >= ', $month_start_date)
                        ->where('create_date <= ', $month_end_date)
                        ->get($table_name)
                        ->row_array();
                        
                    array_push($result, $result_month_count);
                }
            }
            elseif($report_type == 'dm'){
                
            }
        }
        
        $data['section'] = $section;
        $data['report_cat'] = $report_cat;
        $data['report_type'] = $report_type;
        $data['other_reg'] = $other_reg;
        $data['resultData'] = $result;
        if($type == 'investi'){
            if($report_type == 'y'){
                $data['content'] = $this->load->view('patient_investi_count_report',$data,true);
            }elseif($report_type == 'd'){
                $data['content'] = $this->load->view('patient_investi_datewise_count_report',$data,true);
            }elseif($report_type == 'm'){
                $data['content'] = $this->load->view('patient_investi_monthwise_count_report',$data,true);
            }
        }elseif($type == 'xray_investi'){
            if($report_type == 'y'){
                $data['content'] = $this->load->view('patient_investi_count_report_xray',$data,true);
            }elseif($report_type == 'd'){
                $data['content'] = $this->load->view('patient_investi_datewise_count_report_xray',$data,true);
            }elseif($report_type == 'm'){
                $data['content'] = $this->load->view('patient_investi_monthwise_count_report_xray',$data,true);
            }
        }elseif($type == 'ecg_investi'){
            if($report_type == 'y'){
                $data['content'] = $this->load->view('patient_investi_count_report_ecg',$data,true);
            }elseif($report_type == 'd'){
                $data['content'] = $this->load->view('patient_investi_datewise_count_report_ecg',$data,true);
            }elseif($report_type == 'm'){
                $data['content'] = $this->load->view('patient_investi_monthwise_count_report_ecg',$data,true);
            }
        }elseif($type == 'usg_investi'){
            if($report_type == 'y'){
                $data['content'] = $this->load->view('patient_investi_count_report_usg',$data,true);
            }elseif($report_type == 'd'){
                $data['content'] = $this->load->view('patient_investi_datewise_count_report_usg',$data,true);
            }elseif($report_type == 'm'){
                $data['content'] = $this->load->view('patient_investi_monthwise_count_report_usg',$data,true);
            }
        }elseif($type == 'panch'){
            if($report_type == 'y'){
                if($other_reg == 'o'){
                    $data['content'] = $this->load->view('patient_other_panch_count_report',$data,true);
                }else{
                    $data['content'] = $this->load->view('patient_panch_count_report',$data,true);
                }
            }elseif($report_type == 'd'){
                if($other_reg == 'o'){
                    $data['content'] = $this->load->view('patient_other_panch_datewise_count_report',$data,true);
                }else{
                    $data['content'] = $this->load->view('patient_panch_datewise_count_report',$data,true);
                }
            }elseif($report_type == 'm'){
                if($other_reg == 'o'){
                    $data['content'] = $this->load->view('patient_other_panch_monthwise_count_report',$data,true);
                }else{
                    $data['content'] = $this->load->view('patient_panch_monthwise_count_report',$data,true);
                }
            }
        }
        
		$this->load->view('layout/main_wrapper',$data);
    }
  public function deptipdcountbydate()
{
    $section = 'ipd';
    $departmentid = 0;
    $acyear = $this->session->userdata('acyear');

    if (!is_numeric($acyear)) {
        show_error('Invalid academic year.');
    }

    $current_date = date("Y-m-d");

    // Get last date entry
    $lastdate = $this->db->select('create_date')
        ->where('YEAR(create_date)', $acyear)
        ->order_by('id', 'DESC')
        ->limit(1)
        ->get('patient_ipd')
        ->row('create_date') ?? $current_date;

    // Adjust date end
    $date_end = (date('Y-m-d', strtotime($lastdate)) != $current_date)
        ? date('Y-m-d', strtotime("-1 days", strtotime($current_date)))
        : date('Y-m-d', strtotime($lastdate));

    $data['datefrom'] = $acyear . '-01-01';
    $data['dateto'] = $date_end;

    // Determine department table
    $departmentTable = ($acyear == '2025') ? 'department_new' : 'department';

    // Fetch department list excluding specific IDs
    $data['department'] = $this->db->select('dprt_id, name')
        ->from($departmentTable)
        ->where_not_in('dprt_id', ['28', '35'])
        ->order_by('dprt_id', 'ASC')
        ->get()
        ->result();

    // Load views
    $data['content'] = $this->load->view('dept_ipd_date_count', $data, true);
    $this->load->view('layout/main_wrapper', $data);
}

public function deptipdcountbydatefilter()
{
    $section = 'ipd';

    // Get academic year and construct wildcard for LIKE
    $Cyear = $this->session->userdata['acyear'];
    $year = '%' . $Cyear . '%';

    // Determine the department table based on the academic year
    $departmentTable = ($Cyear == '2025') ? 'department_new' : 'department';

    $start_date1 = $this->input->get('start_date', TRUE);
    $end_date1 = $this->input->get('end_date', TRUE);

    $start_date = date('Y-m-d', strtotime($start_date1));
    $end_date = date('Y-m-d', strtotime($end_date1));

    $data['datefrom'] = $start_date;
    $data['dateto'] = $end_date;

    $data['department'] = $this->db->select('dprt_id,name')
        ->from($departmentTable)
        ->get()
        ->result();

    $data['date'] = $this->db->distinct()
        ->select('create_date, COUNT(*) as Total')
        ->from('patient_ipd')
        ->where('patient_ipd.ipd_opd', $section)
        ->where('create_date >=', $start_date)
        ->where('create_date <=', $end_date)
        ->where('create_date LIKE', $year)
        ->group_by('patient_ipd.create_date')
        ->get()
        ->result();	

    $data['departmenttotal'] = $this->db->select("COUNT(*) as Total, $departmentTable.dprt_id as dprt_id")
        ->from('patient_ipd')
        ->join($departmentTable, 'patient_ipd.department_id = ' . $departmentTable . '.dprt_id')
        ->where('patient_ipd.ipd_opd', $section)
        ->where('create_date >=', $start_date)
        ->where('create_date <=', $end_date)
        ->where('create_date LIKE', $year)
        ->group_by($departmentTable . '.dprt_id')
        ->get()
        ->result();		

    // Generate date sequence between start and end
    $Date1 = $start_date; 
    $Date2 = $end_date; 
    $array = array(); 
    $Variable1 = strtotime($Date1); 
    $Variable2 = strtotime($Date2); 

    for ($currentDate = $Variable1; $currentDate <= $Variable2; $currentDate += 86400) { 
        $Store = date('Y-m-d', $currentDate); 
        $array[] = $Store; 
    } 
    $data['dateseq'] = $array;

    // IPD count by date and department
    $data['ipdcountdater'] = $this->db->select("$departmentTable.name, patient_ipd.department_id, patient_ipd.create_date as Date, COUNT(*) as Total, COUNT(patient_ipd.old_reg_no) as Patientoldcount, COUNT(patient_ipd.yearly_reg_no) as Patientnewcount, COUNT(patient_ipd.create_date) as datecount")
        ->from('patient_ipd')
        ->join($departmentTable, 'patient_ipd.department_id = ' . $departmentTable . '.dprt_id')
        ->where('patient_ipd.ipd_opd', $section)
        ->where('create_date LIKE', $year)
        ->where('create_date >=', $start_date)
        ->where('create_date <=', $end_date)
        ->group_by('patient_ipd.create_date, patient_ipd.department_id')
        ->get()
        ->result();

    $data['ipdcountdatercount'] = $this->db->select('COUNT(yearly_reg_no) as newcount, COUNT(old_reg_no) as oldcount, COUNT(*) as totalcount')
        ->from('patient_ipd')
        ->where('create_date >=', $start_date)
        ->where('create_date <=', $end_date)
        ->where('patient_ipd.ipd_opd', $section)
        ->where('create_date LIKE', $year)
        ->get()
        ->result();

    $data['content'] = $this->load->view('dept_ipd_date_count', $data, true);
    $this->load->view('layout/main_wrapper', $data);
}









//////////////////
public function admit_discharge_patient() 
{
    $acyear = $this->session->userdata('acyear');

    if (!is_numeric($acyear)) {
        show_error('Invalid academic year.');
    }

    $current_date = date("Y-m-d");

    // Get last entry date from patient_ipd
    $lastdate = $this->db->select('create_date')
        ->where('YEAR(create_date)', $acyear)
        ->order_by('id', 'DESC')
        ->limit(1)
        ->get('patient_ipd')
        ->row('create_date') ?? $current_date;

    $date_end = (date('Y-m-d', strtotime($lastdate)) != $current_date)
        ? date('Y-m-d', strtotime("-1 days", strtotime($current_date)))
        : date('Y-m-d', strtotime($lastdate));

    $data['datefrom'] = $acyear . '-01-01';
    $data['dateto'] = $date_end;

    // ✅ Determine the department table
    $departmentTable = ($acyear >= '2025') ? 'department_new' : 'department';

    // ✅ Fetch departments from appropriate table
    $data['departments'] = $this->db->select('dprt_id as id, name')
        ->order_by('dprt_id', 'ASC')
        ->get($departmentTable)
        ->result_array();

    // Load the view
    $data['content'] = $this->load->view('dept_ipd_admit_discharge_format', $data, true);
    $this->load->view('layout/main_wrapper', $data);
}


public function dept_ipd_admit_discharge_format_date()
{
    $section = 'ipd';

    // Get academic year and construct wildcard for LIKE
    $Cyear = $this->session->userdata['acyear'];
    $year = '%' . $Cyear . '%';

    // Determine the department table based on the academic year
    $departmentTable = ($Cyear == '2025') ? 'department_new' : 'department';

    $start_date1 = $this->input->get('start_date', TRUE);
    $end_date1 = $this->input->get('end_date', TRUE);

    $start_date = date('Y-m-d', strtotime($start_date1));
    $end_date = date('Y-m-d', strtotime($end_date1));

    $data['datefrom'] = $start_date;
    $data['dateto'] = $end_date;

    $data['department'] = $this->db->select('dprt_id,name')
        ->from($departmentTable)
        ->get()
        ->result();

    $data['date'] = $this->db->distinct()
        ->select('create_date, COUNT(*) as Total')
        ->from('patient_ipd')
        ->where('patient_ipd.ipd_opd', $section)
        ->where('create_date >=', $start_date)
        ->where('create_date <=', $end_date)
        ->where('create_date LIKE', $year)
        ->group_by('patient_ipd.create_date')
        ->get()
        ->result();	

    $data['departmenttotal'] = $this->db->select("COUNT(*) as Total, $departmentTable.dprt_id as dprt_id")
        ->from('patient_ipd')
        ->join($departmentTable, 'patient_ipd.department_id = ' . $departmentTable . '.dprt_id')
        ->where('patient_ipd.ipd_opd', $section)
        ->where('create_date >=', $start_date)
        ->where('create_date <=', $end_date)
        ->where('create_date LIKE', $year)
        ->group_by($departmentTable . '.dprt_id')
        ->get()
        ->result();		

    // Generate date sequence between start and end
    $Date1 = $start_date; 
    $Date2 = $end_date; 
    $array = array(); 
    $Variable1 = strtotime($Date1); 
    $Variable2 = strtotime($Date2); 

    for ($currentDate = $Variable1; $currentDate <= $Variable2; $currentDate += 86400) { 
        $Store = date('Y-m-d', $currentDate); 
        $array[] = $Store; 
    } 
    $data['dateseq'] = $array;

    // IPD count by date and department
    $data['ipdcountdater'] = $this->db->select("$departmentTable.name, patient_ipd.department_id, patient_ipd.create_date as Date, COUNT(*) as Total, COUNT(patient_ipd.old_reg_no) as Patientoldcount, COUNT(patient_ipd.yearly_reg_no) as Patientnewcount, COUNT(patient_ipd.create_date) as datecount")
        ->from('patient_ipd')
        ->join($departmentTable, 'patient_ipd.department_id = ' . $departmentTable . '.dprt_id')
        ->where('patient_ipd.ipd_opd', $section)
        ->where('create_date LIKE', $year)
        ->where('create_date >=', $start_date)
        ->where('create_date <=', $end_date)
        ->group_by('patient_ipd.create_date, patient_ipd.department_id')
        ->get()
        ->result();

    $data['ipdcountdatercount'] = $this->db->select('COUNT(yearly_reg_no) as newcount, COUNT(old_reg_no) as oldcount, COUNT(*) as totalcount')
        ->from('patient_ipd')
        ->where('create_date >=', $start_date)
        ->where('create_date <=', $end_date)
        ->where('patient_ipd.ipd_opd', $section)
        ->where('create_date LIKE', $year)
        ->get()
        ->result();

    $data['content'] = $this->load->view('dept_ipd_date_count_admit_dischagre', $data, true);
    $this->load->view('layout/main_wrapper', $data);
}


}
