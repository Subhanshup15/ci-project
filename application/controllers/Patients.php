<?php defined('BASEPATH') or exit('No direct script access allowed');

class Patients extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model(array(
			'patient_model',
			'doctor_model',
			'document_model',
			'department_model',
			'dignosis_model',
			'bed_manager/bed_model'
		));

		$this->load->helper('url');
		$this->load->library("pagination");

		$this->load->library('excel');

		// 		if ($this->session->userdata('isLogIn') == false
// 			|| $this->session->userdata('user_role') != 1) 
// 			redirect('login');

		if ($this->session->userdata('isLogIn') == false)
			redirect('login');
	}

	public function index()
	{

		$section = 'opd';

		$year = '%' . $this->session->userdata['acyear'] . '%';

		$data['title'] = "Patient OPD List";
		$data['patients'] = $this->patient_model->read();

		$data['content'] = $this->load->view('patient', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function gender_wise_midnight()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);

		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);
		$data['section'] = $section;

		$start_date = $start_date2;
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";

		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$date1 = date_create($start_date2);
		$date2 = date_create($end_date2);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");

		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '1';
		}

		if ($section == 'opd') {
			$data['patients'] = $this->db->select("*")
				->from('patient')
				->join('department_new', 'department_new.dprt_id =  patient.department_id')
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)
				->where('create_date <=', $end_date)
				->where('create_date LIKE', $year)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {
			$data['patients1'] = $this->db->select("*")
				->from('patient_ipd')
				->join('department_new', 'department_new.dprt_id = patient_ipd.department_id')
				->where('discharge_date >=', $start_date_f)
				->where('create_date <=', $start_date_f)
				->where('ipd_opd', 'ipd')
				->or_where('discharge_date', $start_date)
				->where('ipd_opd', 'ipd')
				->get()
				->result();

			//Array 2
			$data['patients2'] = $this->db->select("*")
				->from('patient_ipd')
				->join('department_new', 'department_new.dprt_id = patient_ipd.department_id')
				->where('create_date <=', $start_date)
				->where('discharge_date LIKE', '%0000-00-00%')
				->where('ipd_opd', 'ipd')
				->get()
				->result();

			$data['patients'] = array_merge($data['patients1'], $data['patients2']);

			$data['department_by_section'] = 'ipd';
		}

		if ($data == null) {
			$data['content'] = $this->load->view('gender_wise_midnight', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		} else {
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('gender_wise_midnight', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}
	}

	public function kriyakalp_register()
	{
		$data['title'] = display('patient_information');
		#-------------------------------#
		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);
		//$end_date1 = $start_date1;

		$start_date2 = date('Y-m-d', strtotime($start_date1));

		$end_date2 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);
		//	$section = ($this->input->get('section', TRUE))?$this->input->get('section', TRUE):$section;


		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";

		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;
		if ($section == 'opd') {
			//$end_date2   = date('Y-m-d',strtotime($end_date1));
			$data['patients'] = $this->db->select('*')
				->from('patient')
				->where('create_date >=', $start_date2)
				->where('create_date <=', $end_date2)
				->where('department_id', '30')
				->where('ipd_opd', $section)
				->get()
				->result();
		} else {
			$data['patients'] = $this->db->select('*')
				->from('patient_ipd')
				->where('create_date >=', $start_date2)
				->where('create_date <=', $end_date2)
				->where('department_id', '30')
				->where('ipd_opd', $section)
				->get()
				->result();
		}


		$data['content'] = $this->load->view('kriyakalp_register', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function email_check($email, $id)
	{
		$emailExists = $this->db->select('email')
			->where('email', $email)
			->where_not_in('id', $id)
			->get('patient')
			->num_rows();

		if ($emailExists > 0) {
			$this->form_validation->set_message('email_check', 'The {field} field must contain a unique value.');
			return false;
		} else {
			return true;
		}
	}
	public function get_all_patient_investi()
	{
		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);


		$start_date2 = date('Y-m-d', strtotime($start_date1));

		$end_date2 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);

		$start_date = $start_date2;
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";

		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;

		if ($section == 'opd') {
			// $data['opd_patients'] = $this->db->select('*')
			//   ->from('investi_panch_opd_patient_count')
			//   ->where('(hematology != '' OR serology != '' OR biochemistry != '' OR microbiology != '')')
			//   //->or_where('serology !=','')
			//  // ->or_where('biochemistry !=','')
			//   //->or_where('microbiology !=','')
			//   ->where('create_date >=',$start_date2)
			//   ->where('create_date <=',$end_date2)
			//   ->where('ipd_opd',$section)
			//   ->get()
			//   ->result();

			$this->db->select('*');
			$this->db->from('investi_patient_count_opd');
			$this->db->where("(hematology != '' OR serology != '' OR biochemistry != '' OR microbiology != '')");
			$this->db->where('create_date >=', $start_date2);
			$this->db->where('create_date <=', $end_date2);
			$this->db->where('ipd_opd', 'opd');
			$query = $this->db->get();
			$data['patients'] = $query->result();
			//print_r($this->db->last_query());
			//print_r($this->db->last_query());
		} else {
			//$data['opd_patients'] = $this->db->select('*')
			//  ->from('investi_panch_ipd_patient_count')
			//  ->where('hematology !=','')
			//  ->or_where('serology !=','')
			//  ->or_where('biochemistry !=','')
			//  ->or_where('microbiology !=','')
			//  ->where('create_date >=',$start_date2)
			//  ->where('create_date <=',$end_date2)
			//  ->where('ipd_opd',$section)
			//  ->get()
			//  ->result();

			$this->db->select('*');
			$this->db->from('investi_patient_count_ipd');
			$this->db->where("(hematology != '' OR serology != '' OR biochemistry != '' OR microbiology != '')");
			$this->db->where('create_date >=', $start_date2);
			$this->db->where('create_date <=', $end_date2);
			$this->db->where('ipd_opd', 'ipd');
			$query = $this->db->get();
			$data['patients'] = $query->result();
			// print_r($this->db->last_query());
		}

		$data['content'] = $this->load->view('get_all_patient_investi', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function get_all_patient_investi_profile($patient_auto_id = NULL, $section = NULL)
	{
		if ($section == 'opd') {
			$data['get_all_patient_investi_profile'] = $this->db
				->select('*')
				->from('investi_opd_report_result')
				->where('patient_auto_id', $patient_auto_id)
				->get()
				->row();
			// print_r($this->db->last_query());

			$data['haematology_pro'] = $this->db->select('distinct(investi_opd_report_result.report_type),investi_opd_report_result.*,patient.id,patient.sex,patient.date_of_birth')
				->from('investi_opd_report_result')
				->join('patient', 'patient.id = investi_opd_report_result.patient_auto_id')
				->where('investi_opd_report_result.patient_auto_id', $patient_auto_id)
				->limit(1)
				->get()
				->result();
		} else {
			$data['get_all_patient_investi_profile'] = $this->db
				->select('*')
				->from('investi_ipd_report_result')
				->where('patient_auto_id', $patient_auto_id)
				->get()
				->row();
			// print_r($this->db->last_query());
			$data['haematology_pro'] = $this->db->select('distinct(investi_ipd_report_result.report_type),investi_ipd_report_result.*,patient_ipd.id,patient_ipd.sex,patient_ipd.date_of_birth')
				->from('investi_ipd_report_result')
				->join('patient_ipd', 'patient_ipd.id = investi_ipd_report_result.patient_auto_id')
				->where('investi_ipd_report_result.patient_auto_id', $patient_auto_id)
				->limit(1)
				->get()
				->result();

		}

		$id = $patient_auto_id;
		$data['patient_id'] = $id;

		$data['section'] = $section;
		$data['content'] = $this->load->view('get_all_patient_investi_profile', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function discharge_patient_by_id()
	{
		$id = $this->input->get('discharge_id');
		"<br>";
		$discharge_date1 = $this->input->get('discharge_date');
		$discharge_date = date('Y-m-d', strtotime($discharge_date1));
		$bedno = $this->input->get('bedno');
		$data['patient'] = (object) $postData = [
			'id' => $id,
			'discharge_date' => $discharge_date,
			'bed_status' => 0
		];

		$data['patient1'] = (object) $postData1 = [
			'id' => $bedno,
			'status' => 0
		];
		if ($postData) {
			$this->patient_model->update_dis($postData);
			$this->patient_model->update_beds($postData1);
			$this->session->set_flashdata('message', display('update_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		redirect('patients/ipdprofile/' . $id);

	}


	public function despensing($section)
	{
		$data['title'] = display('patient_list');

		$data['date'] = (object) $getData = array(
			'start_date' => date('Y-m-d', strtotime(($this->input->post('start_date', true) != null) ? $this->input->post('start_date', true) : date('Y-m-d'))),
			'end_date' => date('Y-m-d', strtotime(($this->input->post('end_date', true) != null) ? $this->input->post('end_date', true) : date('Y-m-d'))),
		);
		$date_c = date('Y-m-d', strtotime("+ 5 days"));
		$data['patients'] = $this->patient_model->read_by_section($section);
		$data['check_data'] = $this->patient_model->read_by_check_data($section, $date_c);

		//	echo count($data['patients'] );exit;
		$section = $section;


		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'ipd') {

			date_default_timezone_set('Asia/kolkata');
			$data['department_by_section'] = 'ipd';
			$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
			$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
			$data['gobs'] = 'gobs';

			$data['content'] = $this->load->view('patient_despensing', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		} else {
			date_default_timezone_set('Asia/kolkata');
			$data['department_by_section'] = 'opd';
			$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
			$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
			$data['content'] = $this->load->view('patient_despensing', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}
	}

	public function patient_despensing_by_date()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);


		$start_date2 = date('Y-m-d', strtotime($start_date1));

		$end_date2 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);

		$start_date = $start_date2;
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";

		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$date1 = date_create($start_date2);
		$date2 = date_create($end_date2);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '1';
		}



		if ($section == 'opd') {
			$data['patients'] = $this->db->select("*")

				->from('patient')

				//	->join('department','department.dprt_id =  patient.department_id')

				->where('ipd_opd', $section)

				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)

				->where('create_date LIKE', $year)
				->get()

				->result();

			$data['department_by_section'] = 'opd';
		} else {

			$data['patients1'] = $this->db->select("*")

				->from('patient_ipd')

				->join('department', 'department.dprt_id = patient_ipd.department_id')

				->where('discharge_date >=', $start_date_f)

				->where('create_date <=', $start_date_f)

				->where('ipd_opd', 'ipd')
				->or_where('discharge_date', $start_date)

				->where('ipd_opd', 'ipd')

				->get()

				->result();



			//Array 2
			$data['patients2'] = $this->db->select("*")

				->from('patient_ipd')

				->join('department', 'department.dprt_id = patient_ipd.department_id')

				->where('create_date <=', $start_date)

				->where('discharge_date LIKE', '%0000-00-00%')

				->where('ipd_opd', 'ipd')

				->get()

				->result();


			$data['patients'] = array_merge($data['patients1'], $data['patients2']);

			$data['department_by_section'] = 'ipd';
		}


		if ($data == null) {
			$data['content'] = $this->load->view('patient_despensing', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		} else {
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patient_despensing', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}


	}

	public function patient_by_date_occupancy1111()
	{
		error_reporting(0);
		ini_set('memory_limit', '-1');
		$year = '%' . $this->session->userdata['acyear'] . '%';
		$login_year = $this->session->userdata['acyear'];
		$next_year = $login_year + 1;

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);
		//$array_push=array('2019-02-15');

		$period = new DatePeriod(
			new DateTime($login_year . '-01-01'),
			new DateInterval('P1D'),
			new DateTime($next_year . '-01-01')
		);
		$array_push = array();
		foreach ($period as $key => $value) {

			$value->format('Y-m-d');
			/* echo "<br>";*/
			array_push($array_push, $value->format('Y-m-d'));
		}
		//array_push($array_push,'2019-12-31');
		// echo '2019-12-31';
		// echo "<br>";
		// echo "<br>";

		$jan1 = 0;
		$feb1 = 0;
		$march1 = 0;
		$april1 = 0;
		$may1 = 0;
		$june1 = 0;
		$jully1 = 0;
		$aguest1 = 0;
		$sebt1 = 0;
		$octo1 = 0;
		$nove1 = 0;
		$desm1 = 0;
		$tot_sum = 0;
		$tot_sum1 = 0;

		$k1 = 0;
		$k2 = 0;
		$k3 = 0;
		$k4 = 0;
		$k5 = 0;
		$k6 = 0;
		$k7 = 0;
		$k8 = 0;
		$k9 = 0;
		$k10 = 0;
		$k11 = 0;
		$k12 = 0;

		$pn1 = 0;
		$p2 = 0;
		$p3 = 0;
		$p4 = 0;
		$p5 = 0;
		$p6 = 0;
		$p7 = 0;
		$p8 = 0;
		$p9 = 0;
		$p10 = 0;
		$p11 = 0;
		$p12 = 0;

		$sl1 = 0;
		$sl2 = 0;
		$sl3 = 0;
		$sl4 = 0;
		$sl5 = 0;
		$sl6 = 0;
		$sl7 = 0;
		$sl8 = 0;
		$sl9 = 0;
		$sl10 = 0;
		$sl11 = 0;
		$sl12 = 0;

		$sk1 = 0;
		$sk2 = 0;
		$sk3 = 0;
		$sk4 = 0;
		$sk5 = 0;
		$sk6 = 0;
		$sk7 = 0;
		$sk8 = 0;
		$sk9 = 0;
		$sk10 = 0;
		$sk11 = 0;
		$sk12 = 0;

		$st1 = 0;
		$st2 = 0;
		$st3 = 0;
		$st4 = 0;
		$st5 = 0;
		$st6 = 0;
		$st7 = 0;
		$st8 = 0;
		$st9 = 0;
		$st10 = 0;
		$st11 = 0;
		$st12 = 0;

		$b1 = 0;
		$b2 = 0;
		$b3 = 0;
		$b4 = 0;
		$b5 = 0;
		$b6 = 0;
		$b7 = 0;
		$b8 = 0;
		$b9 = 0;
		$b10 = 0;
		$b11 = 0;
		$b12 = 0;



		for ($i = 0; $i < count($array_push); $i++) {

			$start_date2 = date('Y-m-d', strtotime($array_push[$i]));

			$end_date2 = date('Y-m-d', strtotime($array_push[$i]));

			$section = 'ipd';

			$start_date = $start_date2 . " 00:00:00";
			$start_date_f = $start_date2 . " 23:59:00";
			$end_date = $end_date2 . " 23:59:00";
			// $start_date=$start_date1." 00:00:00";
			// $end_date=$end_date1." 23:59:00";
			$data['datefrom'] = $start_date;
			$data['dateto'] = $end_date;


			//echo $section;
			$month = date('m', strtotime($end_date));


			$patients1 = $this->db->select("COUNT(*) as Total,department.dprt_id as name")

				->from('patient_ipd')

				->join('department', 'department.dprt_id = patient_ipd.department_id')

				->where('discharge_date >=', $start_date_f)
				->group_by('department.dprt_id')
				->where('create_date <=', $end_date)


				->where('ipd_opd', $section)
				//	->or_where('discharge_date', $start_date)

				//	->where('create_date LIKE', $year)

				->get()

				->result();

			//	print_r($patients1);
			$patients12 = 0;
			$p1 = 0;

			for ($n = 0; $n < count($patients1); $n++) {
				//echo $patients1[$n]->Total;
				//  echo "<br>";





				//Array 2
				$patients2 = $this->db->select("COUNT(*) as Total,department.dprt_id as name")

					->from('patient_ipd')

					->join('department', 'department.dprt_id = patient_ipd.department_id')

					->where('create_date <=', $end_date)
					->group_by('department.dprt_id')

					->where('discharge_date LIKE', '%0000-00-00%')

					->where('ipd_opd', $section)

					->get()

					->result();

				if ($patients2[$n]) {
					$pp1 += $patients2[$n]->Total;
				} else {
					$pp1 = 0;
				}
				//echo $end_date; echo "  ";

				$patients12 += $patients1[$n]->Total + $pp1;

				//echo $patients1[$n]->name;
				if ($patients1[$n]->name == 34) {
					if ($patients2[$n]) {
						$ss = $patients2[$n]->Total;
					} else {
						$ss = 0;
					}
					$k += $patients1[$n]->Total + $ss;
					if ($month == '01') {
						$jan1 += $patients1[$n]->Total + $ss;
						$k1 += $patients1[$n]->Total + $ss;
					} else if ($month == '02') {
						$feb1 += $patients1[$n]->Total + $ss;
						$k2 += $patients1[$n]->Total + $ss;
					} else if ($month == '03') {
						$march1 += $patients1[$n]->Total + $ss;
						$k3 += $patients1[$n]->Total + $ss;
					} else if ($month == '04') {
						$april1 += $patients1[$n]->Total + $ss;
						$k4 += $patients1[$n]->Total + $ss;
					} else if ($month == '05') {
						$may1 += $patients1[$n]->Total + $ss;
						$k5 += $patients1[$n]->Total + $ss;
					} else if ($month == '06') {
						$june1 += $patients1[$n]->Total + $ss;
						$k6 += $patients1[$n]->Total + $ss;
					}
					if ($month == '07') {
						$jully1 += $patients1[$n]->Total + $ss;
						$k7 += $patients1[$n]->Total + $ss;
					} else if ($month == '08') {
						$aguest1 += $patients1[$n]->Total + $ss;
						$k8 += $patients1[$n]->Total + $ss;
					} else if ($month == '09') {
						$sebt1 += $patients1[$n]->Total + $ss;
						$k9 += $patients1[$n]->Total + $ss;
					} else if ($month == '10') {
						$octo1 += $patients1[$n]->Total + $ss;
						$k10 += $patients1[$n]->Total + $ss;
					} else if ($month == '11') {
						$nove1 += $patients1[$n]->Total + $ss;
						$k11 += $patients1[$n]->Total + $ss;
					} else if ($month == '12') {
						$desm1 += $patients1[$n]->Total + $ss;
						$k12 += $patients1[$n]->Total + $ss;
					}
				}

				if ($patients1[$n]->name == 33) {
					if ($patients2[$n]) {
						$ss = $patients2[$n]->Total;
					} else {
						$ss = 0;
					}
					$p += $patients1[$n]->Total + $ss;
					if ($month == '01') {
						$jan1 += $patients1[$n]->Total + $ss;
						$pn1 += $patients1[$n]->Total + $ss;
					} else if ($month == '02') {
						$feb1 += $patients1[$n]->Total + $ss;
						$p2 += $patients1[$n]->Total + $ss;
					} else if ($month == '03') {
						$march1 += $patients1[$n]->Total + $ss;
						$p3 += $patients1[$n]->Total + $ss;
					} else if ($month == '04') {
						$april1 += $patients1[$n]->Total + $ss;
						$p4 += $patients1[$n]->Total + $ss;
					} else if ($month == '05') {
						$may1 += $patients1[$n]->Total + $ss;
						$p5 += $patients1[$n]->Total + $ss;
					} else if ($month == '06') {
						$june1 += $patients1[$n]->Total + $ss;
						$p6 += $patients1[$n]->Total + $ss;
					}
					if ($month == '07') {
						$jully1 += $patients1[$n]->Total + $ss;
						$p7 += $patients1[$n]->Total + $ss;
					} else if ($month == '08') {
						$aguest1 += $patients1[$n]->Total + $ss;
						$p8 += $patients1[$n]->Total + $ss;
					} else if ($month == '09') {
						$sebt1 += $patients1[$n]->Total + $ss;
						$p9 += $patients1[$n]->Total + $ss;
					} else if ($month == '10') {
						$octo1 += $patients1[$n]->Total + $ss;
						$p10 += $patients1[$n]->Total + $ss;
					} else if ($month == '11') {
						$nove1 += $patients1[$n]->Total + $ss;
						$p11 += $patients1[$n]->Total + $ss;
					} else if ($month == '12') {
						$desm1 += $patients1[$n]->Total + $ss;
						$p12 += $patients1[$n]->Total + $ss;
					}
				}
				if ($patients1[$n]->name == 32) {
					if ($patients2[$n]) {
						$ss = $patients2[$n]->Total;
					} else {
						$ss = 0;
					}
					$b += $patients1[$n]->Total + $ss;
					if ($month == '01') {
						$jan1 += $patients1[$n]->Total + $ss;
						$b1 += $patients1[$n]->Total + $ss;
					} else if ($month == '02') {
						$feb1 += $patients1[$n]->Total + $ss;
						$b2 += $patients1[$n]->Total + $ss;
					} else if ($month == '03') {
						$march1 += $patients1[$n]->Total + $ss;
						$b3 += $patients1[$n]->Total + $ss;
					} else if ($month == '04') {
						$april1 += $patients1[$n]->Total + $ss;
						$b4 += $patients1[$n]->Total + $ss;
					} else if ($month == '05') {
						$may1 += $patients1[$n]->Total + $ss;
						$b5 += $patients1[$n]->Total + $ss;
					} else if ($month == '06') {
						$june1 += $patients1[$n]->Total + $ss;
						$b6 += $patients1[$n]->Total + $ss;
					}
					if ($month == '07') {
						$jully1 += $patients1[$n]->Total + $ss;
						$b7 += $patients1[$n]->Total + $ss;
					} else if ($month == '08') {
						$aguest1 += $patients1[$n]->Total + $ss;
						$b8 += $patients1[$n]->Total + $ss;
					} else if ($month == '09') {
						$sebt1 += $patients1[$n]->Total + $ss;
						$b9 += $patients1[$n]->Total + $ss;
					} else if ($month == '10') {
						$octo1 += $patients1[$n]->Total + $ss;
						$b10 += $patients1[$n]->Total + $ss;
					} else if ($month == '11') {
						$nove1 += $patients1[$n]->Total + $ss;
						$b11 += $patients1[$n]->Total + $ss;
					} else if ($month == '12') {
						$desm1 += $patients1[$n]->Total + $ss;
						$b12 += $patients1[$n]->Total + $ss;
					}
				}
				if ($patients1[$n]->name == 31) {
					if ($patients2[$n]) {
						$ss = $patients2[$n]->Total;
					} else {
						$ss = 0;
					}
					$sl += $patients1[$n]->Total + $ss;
					if ($month == '01') {
						$jan1 += $patients1[$n]->Total + $ss;
						$sl1 += $patients1[$n]->Total + $ss;
					} else if ($month == '02') {
						$feb1 += $patients1[$n]->Total + $ss;
						$sl2 += $patients1[$n]->Total + $ss;
					} else if ($month == '03') {
						$march1 += $patients1[$n]->Total + $ss;
						$sl3 += $patients1[$n]->Total + $ss;
					} else if ($month == '04') {
						$april1 += $patients1[$n]->Total + $ss;
						$sl4 += $patients1[$n]->Total + $ss;
					} else if ($month == '05') {
						$may1 += $patients1[$n]->Total + $ss;
						$sl5 += $patients1[$n]->Total + $ss;
					} else if ($month == '06') {
						$june1 += $patients1[$n]->Total + $ss;
						$sl6 += $patients1[$n]->Total + $ss;
					}
					if ($month == '07') {
						$jully1 += $patients1[$n]->Total + $ss;
						$sl7 += $patients1[$n]->Total + $ss;
					} else if ($month == '08') {
						$aguest1 += $patients1[$n]->Total + $ss;
						$sl8 += $patients1[$n]->Total + $ss;
					} else if ($month == '09') {
						$sebt1 += $patients1[$n]->Total + $ss;
						$sl9 += $patients1[$n]->Total + $ss;
					} else if ($month == '10') {
						$octo1 += $patients1[$n]->Total + $ss;
						$sl10 += $patients1[$n]->Total + $ss;
					} else if ($month == '11') {
						$nove1 += $patients1[$n]->Total + $ss;
						$sl11 += $patients1[$n]->Total + $ss;
					} else if ($month == '12') {
						$desm1 += $patients1[$n]->Total + $ss;
						$sl12 += $patients1[$n]->Total + $ss;
					}
				}
				if ($patients1[$n]->name == 30) {
					if ($patients2[$n]) {
						$ss = $patients2[$n]->Total;
					} else {
						$ss = 0;
					}
					$sk += $patients1[$n]->Total + $ss;
					if ($month == '01') {
						$jan1 += $patients1[$n]->Total + $ss;
						$sk1 += $patients1[$n]->Total + $ss;
					} else if ($month == '02') {
						$feb1 += $patients1[$n]->Total + $ss;
						$sk2 += $patients1[$n]->Total + $ss;
					} else if ($month == '03') {
						$march1 += $patients1[$n]->Total + $ss;
						$sk3 += $patients1[$n]->Total + $ss;
					} else if ($month == '04') {
						$april1 += $patients1[$n]->Total + $ss;
						$sk4 += $patients1[$n]->Total + $ss;
					} else if ($month == '05') {
						$may1 += $patients1[$n]->Total + $ss;
						$sk5 += $patients1[$n]->Total + $ss;
					} else if ($month == '06') {
						$june1 += $patients1[$n]->Total + $ss;
						$sk6 += $patients1[$n]->Total + $ss;
					}
					if ($month == '07') {
						$jully1 += $patients1[$n]->Total + $ss;
						$sk7 += $patients1[$n]->Total + $ss;
					} else if ($month == '08') {
						$aguest1 += $patients1[$n]->Total + $ss;
						$sk8 += $patients1[$n]->Total + $ss;
					} else if ($month == '09') {
						$sebt1 += $patients1[$n]->Total + $ss;
						$sk9 += $patients1[$n]->Total + $ss;
					} else if ($month == '10') {
						$octo1 += $patients1[$n]->Total + $ss;
						$sk10 += $patients1[$n]->Total + $ss;
					} else if ($month == '11') {
						$nove1 += $patients1[$n]->Total + $ss;
						$sk11 += $patients1[$n]->Total + $ss;
					} else if ($month == '12') {
						$desm1 += $patients1[$n]->Total + $ss;
						$sk12 += $patients1[$n]->Total + $ss;
					}
				}
				if ($patients1[$n]->name == 29) {
					if ($patients2[$n]) {
						$ss = $patients2[$n]->Total;
					} else {
						$ss = 0;
					}
					$st += $patients1[$n]->Total + $ss;
					if ($month == '01') {
						$jan1 += $patients1[$n]->Total + $ss;
						$st1 += $patients1[$n]->Total + $ss;
					} else if ($month == '02') {
						$feb1 += $patients1[$n]->Total + $ss;
						$st2 += $patients1[$n]->Total + $ss;
					} else if ($month == '03') {
						$march1 += $patients1[$n]->Total + $ss;
						$st3 += $patients1[$n]->Total + $ss;
					} else if ($month == '04') {
						$april1 += $patients1[$n]->Total + $ss;
						$st4 += $patients1[$n]->Total + $ss;
					} else if ($month == '05') {
						$may1 += $patients1[$n]->Total + $ss;
						$st5 += $patients1[$n]->Total + $ss;
					} else if ($month == '06') {
						$june1 += $patients1[$n]->Total + $ss;
						$st6 += $patients1[$n]->Total + $ss;
					}
					if ($month == '07') {
						$jully1 += $patients1[$n]->Total + $ss;
						$st7 += $patients1[$n]->Total + $ss;
					} else if ($month == '08') {
						$aguest1 += $patients1[$n]->Total + $ss;
						$st8 += $patients1[$n]->Total + $ss;
					} else if ($month == '09') {
						$sebt1 += $patients1[$n]->Total + $ss;
						$st9 += $patients1[$n]->Total + $ss;
					} else if ($month == '10') {
						$octo1 += $patients1[$n]->Total + $ss;
						$st10 += $patients1[$n]->Total + $ss;
					} else if ($month == '11') {
						$nove1 += $patients1[$n]->Total + $ss;
						$st11 += $patients1[$n]->Total + $ss;
					} else if ($month == '12') {
						$desm1 += $patients1[$n]->Total + $ss;
						$st12 += $patients1[$n]->Total + $ss;
					}
				}


			}
			//echo $end_date;	echo " ";	echo $patients12;	echo " ";
			//	echo $k;echo " ";echo $p;	echo " "; echo $b;echo " ";echo $sl;echo " ";	echo $sk;echo " ";echo $st;

		}
		/* echo "<br>";
		echo $k1;echo " ";	echo $k2;  echo " ";	echo $k3;echo " ";	echo $k4; echo " ";	echo $k5;echo " ";	echo $k6;  echo " ";	echo $k7;echo " ";	echo $k8; 
		echo " ";	echo $k9;echo " ";	echo $k10;  echo " ";	echo $k11;echo " ";	echo $k12;*/
		$b1;

		$data['jan'] = array($st1, $sk1, $sl1, $b1, $pn1, $k1);
		$data['feb'] = array($st2, $sk2, $sl2, $b2, $p2, $k2);
		$data['march'] = array($st3, $sk3, $sl3, $b3, $p3, $k3);
		$data['april'] = array($st4, $sk4, $sl4, $b4, $p4, $k4);
		$data['may'] = array($st5, $sk5, $sl5, $b5, $p5, $k5);

		$data['june'] = array($st6, $sk6, $sl6, $b6, $p6, $k6);
		$data['jully'] = array($st7, $sk7, $sl7, $b7, $p7, $k7);
		$data['aguest'] = array($st8, $sk8, $sl8, $b8, $p8, $k8);
		$data['sebt'] = array($st9, $sk9, $sl9, $b9, $p9, $k9);
		$data['octo'] = array($st10, $sk10, $sl10, $b10, $p10, $k10);
		$data['nove'] = array($st11, $sk11, $sl11, $b11, $p11, $k11);
		$data['desm'] = array($st12, $sk12, $sl12, $b12, $p12, $k12);







		/*echo  $jan1; echo " ";	echo  $feb1; echo " ";	echo " ";	echo $march1; echo " ";	echo  $april1;echo " ";	echo $may1;echo " ";	echo $june1;
		echo " ";	echo $jully1; echo " ";	echo  $aguest1; echo " ";	echo $sebt1; echo " ";	echo  $octo1; echo " ";	echo $nove1; echo " "; echo $desm1;*/






		//$data['department']=$this->patient_model->get_all_dept();
		$dept_id = array('28', '35');
		$data['department'] = $this->db->where_not_in('dprt_id', $dept_id)->get('department')->result();

		$data['datefrom'] = '2018';
		$data['dateto'] = '2018';

		$data['month_bed'] = 'month_bed';



		$data['content'] = $this->load->view('patient_month_report', $data, true);

		$this->load->view('layout/main_wrapper', $data);


	}



	public function create()
	{

		//echo "dsdsd";
		//exit;
		//echo error_reporting(0); 
		$data['title'] = display('add_patient');
		$id = $this->input->post('id');

		$status_ipd_opd = $this->input->post('ipd_opd');

		#-------------------------------#
		$this->form_validation->set_rules('firstname', display('first_name'), 'required|max_length[50]');
		//$this->form_validation->set_rules('blood_group', display('blood_group'),'m');
		$this->form_validation->set_rules('sex', display('sex'), 'required');
		$this->form_validation->set_rules('date_of_birth', display('date_of_birth'), 'required|max_length[10]');
		$this->form_validation->set_rules('create_date', display('create_date'), 'required|max_length[20]');
		//$this->form_validation->set_rules('assign_date', display('assign_date'),'required|max_length[10]');
		$this->form_validation->set_rules('department_id', display('department_name'), 'required|max_length[255]');
		$this->form_validation->set_rules('address', display('address'), 'required|max_length[255]');
		$this->form_validation->set_rules('status', display('status'), 'required');
		if ($id != null && $status_ipd_opd == 'ipd') {
			$this->form_validation->set_rules('doctor_id', display('doctor_name'), 'required|max_length[255]');
		} elseif ($status_ipd_opd == 'ipd') {
			$this->form_validation->set_rules('bedNo', display('bedNo'), 'required');
			$this->form_validation->set_rules('doctor_id', display('doctor_name'), 'required|max_length[255]');
		}

		#-------------------------------#
		//picture upload
		$picture = $this->fileupload->do_upload(
			'assets/images/patient/',
			'picture'
		);


		//Registration numbr create

		$acyear = $this->session->userdata('acyear');

		if ($status_ipd_opd == 'opd') {
			$q = $this->db->select('patient_id,yearly_reg_no, yearly_no, monthly_reg_no, daily_reg_no, old_reg_no, create_date')
				->from('patient')
				->where('yearly_reg_no != ', '')
				->where('year(create_date)', $acyear)
				->order_by("id desc")
				->limit(1)->get()->result_array();
		} else {
			$q = $this->db->select('patient_id,yearly_reg_no, yearly_no, monthly_reg_no, daily_reg_no, old_reg_no, create_date')
				->from('patient_ipd')
				//->where('create_date LIKE', $acyear)
				->order_by("id desc")
				->limit(1)->get()->result_array();
		}

		//print_r($status_ipd_opd);
		//print_r($q);
		//print_r($this->db->last_query());
		//die();

		$timezone = "Asia/Kolkata";
		date_default_timezone_set($timezone);

		/*$patient_id = $q[0]['patient_id'];
		$yearly_reg_no1 = $q[0]['yearly_reg_no'];
		if($yearly_reg_no1){
		$yearly_reg_no2 = $q[0]['yearly_reg_no'] + 1;
		}
		else{
		  $yearly_reg_no2 = 1;  
		}
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
		$oldday = date("d/m/Y", strtotime($q[0]['create_date']));*/

		$patient_id = 0;
		$yearly_reg_no = 0;
		$yearly_no1 = 0;
		$monthly_reg_no1 = 0;
		$daily_reg_no1 = 0;
		$old_reg_no1 = 0;
		$create_date1 = 0;

		$currentYear = 0;
		$currentmonth = 0;
		$currentday = 0;

		$oldyear = 0;
		$oldmonth = 0;
		$oldday = 0;
		if ($q != null) {
			$patient_id = $q[0]['patient_id'];
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
		}

		if ($yearly_reg_no1 != 0) {
			$yearly_reg_no2 = $q[0]['yearly_reg_no'] + 1;
		} else {
			$yearly_reg_no2 = 1;
		}
		//print_r($yearly_reg_no2);
		//die();

		//print_r($currentYear);
		//print_r('===>');
		//print_r($oldyear);

		//Yearly Number
		$monthly_reg_no = 0;
		if ($currentYear > $oldyear) {
			//	$yearly_no = 1;
			$yearly_no = 1;
			$yearly_reg_no1 = 1;
			$patient_id = 1;
			$monthly_reg_no = 1;

		} else {
			//	$yearly_no = $yearly_no1 + 1;
			$yearly_no = $yearly_no1 + 1;
			$yearly_reg_no1 = $yearly_reg_no + 1;
			$patient_id = $patient_id + 1;
			//Monthly Number
			if ($currentmonth > $oldmonth) {
				$monthly_reg_no = 1;

			} else {
				$monthly_reg_no = (int) $monthly_reg_no1 + 1;
			}
		}
		//print_r('===>');
		//print_r($yearly_no);

		//Daily Number
		$daily_reg_no = '';
		if ($currentday == $oldday) {
			$daily_reg_no = (int) $daily_reg_no1 + 1;
		} else {
			$daily_reg_no = 1;
		}
		//print_r($daily_reg_no);

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

		$sex = $this->input->post('sex');
		if ($sex == 'Male') {
			//$sex1 ='Male';
			$sex = 'M';

		} elseif ($sex == 'Female') {
			//$sex1 ='Female';
			$sex = 'F';
		}

		// 			$duplicate_no = $this->db->select('*')->from('patient')->where('yearly_reg_no',$this->input->post('yearly_reg_no'))->get()->row();
// 		    $count = mysqli_num_rows($duplicate_no);
// 		    if($count>='1'){

		// 		    }else
// 		    {

		// 		    }
		#-------------------------------#
		if ($this->input->post('id') == null) {
			if ($this->input->post('old_reg_no') == null || $this->input->post('old_reg_no') == '') {

				$opd_no = $this->input->post('yearly_reg_no');

				$data['patient'] = (object) $postData = [
					'id' => $this->input->post('id'),
					'patient_id' => $patient_id,
					'yearly_reg_no' => $this->input->post('yearly_reg_no'),
					'yearly_no' => $yearly_no,
					'monthly_reg_no' => $monthly_reg_no,
					'daily_reg_no' => $daily_reg_no,
					'ipd_no' => $this->input->post('ipd_no'),
					'firstname' => strtoupper($this->input->post('firstname')),
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'password' => md5($this->input->post('password')),
					'phone' => $this->input->post('mobile'),
					'mobile' => $this->input->post('mobile'),
					'blood_group' => $this->input->post('blood_group'),
					'sex' => $sex,
					'date_of_birth' => $this->input->post('date_of_birth'),
					'address' => $this->input->post('address'),
					'picture' => (!empty($picture) ? $picture : $this->input->post('old_picture')),
					'affliate' => null,
					'create_date' => date('Y-m-d', strtotime(($this->input->post('create_date') != null) ? $this->input->post('create_date') : date('Y-m-d'))),
					// 'created_by'   => $this->session->userdata('user_role'),
					'created_by' => NULL,
					'proxy_id' => 1,
					'status' => $this->input->post('status'),
					'ipd_opd' => $this->input->post('ipd_opd'),
					'department_id' => $this->input->post('department_id', true),
					'doctor_id' => $this->input->post('doctor_id', true),
					'assign_date' => $this->input->post('assign_date'),
					'discharge_date' => ($this->input->post('discharge_date') != '') ? $this->input->post('discharge_date') : '0000-00-00',
					'dignosis' => $this->input->post('dignosis'),
					'wardType' => $this->input->post('wardType'),
					'bedNo' => ($this->input->post('bedNo') != '') ? $this->input->post('bedNo') : $this->input->post('update_bed_no'),
					'income' => $this->input->post('income'),
					'occupation' => $this->input->post('occupation'),
					'wieght' => $this->input->post('weight'),
					'anesthesia' => $this->input->post('anesthesia'),
					'religion' => $this->input->post('religion'),
					'fol_up_date' => ($this->input->post('fol_up_date') != '') ? $this->input->post('fol_up_date') : NULL,
					'result' => $this->input->post('result')

				];
			} else {
				if ($this->input->post('status1') == 'old' && $this->input->post('ipd_opd') == 'opd') {
					$y_new_reg = null;
					$y_old_reg = $this->input->post('old_reg_no');
					$patient_id = $this->input->post('old_reg_no');
					$yearly_no = $this->input->post('old_reg_no');
				} elseif ($this->input->post('ipd_opd') == 'ipd') {
					$y_new_reg = $this->input->post('old_reg_no');
				} else {
					$y_new_reg = $yearly_reg_no1;
					$y_old_reg = $this->input->post('old_reg_no');
				}


				$opd_no = $this->input->post('yearly_reg_no');
				$data['patient'] = (object) $postData = [
					'id' => $this->input->post('id'),
					'patient_id' => $patient_id,
					'yearly_reg_no' => $y_new_reg,
					'yearly_no' => $yearly_no,
					'monthly_reg_no' => $monthly_reg_no,
					'daily_reg_no' => $daily_reg_no,
					'old_reg_no' => ($this->input->post('ipd_opd') != 'ipd') ? $y_old_reg : null,
					'ipd_no' => $this->input->post('ipd_no'),
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'password' => md5($this->input->post('password')),
					'phone' => $this->input->post('mobile'),
					'mobile' => $this->input->post('mobile'),
					'blood_group' => $this->input->post('blood_group'),
					'sex' => $sex,
					'date_of_birth' => $this->input->post('date_of_birth'),
					'address' => $this->input->post('address'),
					'picture' => (!empty($picture) ? $picture : $this->input->post('old_picture')),
					'affliate' => null,
					'create_date' => date('Y-m-d', strtotime(($this->input->post('create_date') != null) ? $this->input->post('create_date') : date('Y-m-d'))),
					// 'created_by'   => $this->session->userdata('user_role'),
					'status' => $this->input->post('status'),
					'ipd_opd' => $this->input->post('ipd_opd'),
					'department_id' => $this->input->post('department_id', true),
					'doctor_id' => $this->input->post('doctor_id', true),
					'assign_date' => $this->input->post('assign_date'),
					'discharge_date' => ($this->input->post('discharge_date') != '') ? $this->input->post('discharge_date') : '0000-00-00',
					'dignosis' => $this->input->post('dignosis'),
					'wardType' => $this->input->post('wardType'),
					'bedNo' => ($this->input->post('bedNo') != '') ? $this->input->post('bedNo') : $this->input->post('update_bed_no'),
					'income' => $this->input->post('income'),
					'occupation' => $this->input->post('occupation'),
					'wieght' => $this->input->post('weight'),
					'anesthesia' => $this->input->post('anesthesia'),
					'religion' => $this->input->post('religion'),
					'fol_up_date' => ($this->input->post('fol_up_date') != '') ? $this->input->post('fol_up_date') : NULL,
					'created_by' => NULL,
					'proxy_id' => 1,
					'result' => $this->input->post('result')
				];
			}
		} else {
			if ($this->input->post('update_old_reg_no') != '' && $this->input->post('ipd_opd') == 'opd') {

				$opd_no = $this->input->post('yearly_reg_no');

				$data['patient'] = (object) $postData = [
					'id' => $this->input->post('id'),
					'patient_id' => $this->input->post('update_old_reg_no'),
					'yearly_reg_no' => ($this->input->post('yearly_reg_no')) ? $this->input->post('yearly_reg_no') : NULL,
					'yearly_no' => $this->input->post('update_old_reg_no'),
					'old_reg_no' => $this->input->post('update_old_reg_no'),
					'firstname' => strtoupper($this->input->post('firstname')),
					'blood_group' => $this->input->post('blood_group'),
					'sex' => $sex,
					'date_of_birth' => $this->input->post('date_of_birth'),
					'address' => $this->input->post('address'),
					'affliate' => null,
					'create_date' => date('Y-m-d', strtotime(($this->input->post('create_date') != null) ? $this->input->post('create_date') : date('Y-m-d'))),
					// 'created_by'   => $this->session->userdata('user_role'),
					'status' => $this->input->post('status'),
					'ipd_opd' => $this->input->post('ipd_opd'),
					'department_id' => $this->input->post('department_id', true),
					'doctor_id' => $this->input->post('doctor_id', true),
					'assign_date' => $this->input->post('assign_date'),
					'discharge_date' => ($this->input->post('discharge_date') != '') ? $this->input->post('discharge_date') : '0000-00-00',
					'dignosis' => $this->input->post('dignosis'),
					'wardType' => $this->input->post('wardType'),
					'bedNo' => ($this->input->post('bedNo') != '') ? $this->input->post('bedNo') : $this->input->post('update_bed_no'),
					'income' => $this->input->post('income'),
					'occupation' => $this->input->post('occupation'),
					'wieght' => $this->input->post('weight'),
					'anesthesia' => $this->input->post('anesthesia'),
					'religion' => $this->input->post('religion'),
					'fol_up_date' => ($this->input->post('fol_up_date') != '') ? $this->input->post('fol_up_date') : NULL,
					'created_by' => NULL,
					'proxy_id' => 1,
					'result' => $this->input->post('result')
				];
			} else {

				$opd_no = $this->input->post('yearly_reg_no');
				$data['patient'] = (object) $postData = [
					'id' => $this->input->post('id'),
					'yearly_reg_no' => $this->input->post('yearly_reg_no'),
					'old_reg_no' => $this->input->post('update_old_reg_no'),
					'firstname' => strtoupper($this->input->post('firstname')),
					'blood_group' => $this->input->post('blood_group'),
					'sex' => $sex,
					'date_of_birth' => $this->input->post('date_of_birth'),
					'address' => $this->input->post('address'),
					'affliate' => null,
					'create_date' => date('Y-m-d', strtotime(($this->input->post('create_date') != null) ? $this->input->post('create_date') : date('Y-m-d'))),
					// 'created_by'   => $this->session->userdata('user_role'),
					'status' => $this->input->post('status'),
					'ipd_opd' => $this->input->post('ipd_opd'),
					'department_id' => $this->input->post('department_id', true),
					'doctor_id' => $this->input->post('doctor_id', true),
					'assign_date' => $this->input->post('assign_date'),
					'discharge_date' => ($this->input->post('discharge_date') != '') ? $this->input->post('discharge_date') : '0000-00-00',
					'dignosis' => $this->input->post('dignosis'),
					'wardType' => $this->input->post('wardType'),
					'bedNo' => ($this->input->post('bedNo') != '') ? $this->input->post('bedNo') : $this->input->post('update_bed_no'),
					'income' => $this->input->post('income'),
					'occupation' => $this->input->post('occupation'),
					'wieght' => $this->input->post('weight'),
					'anesthesia' => $this->input->post('anesthesia'),
					'religion' => $this->input->post('religion'),
					'fol_up_date' => ($this->input->post('fol_up_date') != '') ? $this->input->post('fol_up_date') : NULL,
					'created_by' => NULL,
					'proxy_id' => 1,
					'result' => $this->input->post('result')
				];
			}
		}
		#-------------------------------#

		if ($this->form_validation->run() === true) {
			#if empty $id then insert data
			if ($this->input->post('id') == null) {
				$ipd_opd_sec = $this->input->post('ipd_opd');
				if ($ipd_opd_sec == 'opd') {

					// Stop duplicate entry
					$this->db->select('*');
					$this->db->where('year(create_date)', $acyear);
					$this->db->where('yearly_reg_no', $opd_no);
					$last_opd_no = $this->db->get('patient');
					$count = $last_opd_no->num_rows();

					if ($count >= 1) {
						echo $this->session->set_flashdata('exception', display('Record is Already Exist!'));
					} else {
						$last_id = $this->patient_model->create($postData);
					}

				} else {
					$last_id = $this->patient_model->create_ipd($postData);
				}

				if ($last_id) {
					$id = $this->input->post('bedNo');
					$status = 1;
					$this->bed_model->updateBedSelection($id, $status);
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
					//redirect('patients/profile/'.$last_id,$data,true);
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				$name = strtoupper($this->input->post('firstname'));
				$diagnosis = strtoupper($this->input->post('dignosis'));
				$year_reg_id = $this->input->post('yearly_reg_no');
				if ($year_reg_id) {
					$year_reg_id = $this->input->post('yearly_reg_no');
				} else {
					$year_reg_id = $this->input->post('old_reg_no');
				}
				redirect('patients/create', $data, true);
			} else {

				if ($this->patient_model->update($postData)) {
					$id = $this->input->post('bedNo');
					$oldBedNo = $this->input->post('update_bed_no');
					$status = 1;
					if ($id == null || $id == '') {
						$id = $oldBedNo;
					}
					$this->bed_model->updateOldBedSelection($oldBedNo);
					$this->bed_model->updateBedSelection($id, $status);
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('patients/create', 'refresh');
			}

		} else {
			$data['serial_no'] = '1';
			$data['dignosis_list'] = $this->dignosis_model->dignosis_sub_list();
			// $data['department_list'] = $this->department_model->department_list();
			$data['department_list'] = $this->department_model->department_list_2025();
			$data['address_list'] = $this->department_model->address_list();

			$data['beds'] = $this->bed_model->read();

			$data['content'] = $this->load->view('patient_form', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}
	}



	public function create_1()
	{    //echo "dsdsd";exit;
		echo error_reporting(0);
		$data['title'] = display('add_patient');
		$id = $this->input->post('id');
		#-------------------------------#
		$this->form_validation->set_rules('firstname', display('first_name'), 'required|max_length[50]');
		//$this->form_validation->set_rules('blood_group', display('blood_group'),'m');
		$this->form_validation->set_rules('sex', display('sex'), 'required');
		$this->form_validation->set_rules('date_of_birth', display('date_of_birth'), 'required|max_length[10]');
		$this->form_validation->set_rules('address', display('address'), 'required|max_length[255]');
		$this->form_validation->set_rules('status', display('status'), 'required');
		#-------------------------------#
		//picture upload
		$picture = $this->fileupload->do_upload(
			'assets/images/patient/',
			'picture'
		);


		//Registration numbr create

		$acyear = $this->session->userdata('acyear');
		$status_ipd_opd = $this->input->post('ipd_opd');
		if ($status_ipd_opd == 'opd') {
			$q = $this->db->select('patient_id,yearly_reg_no, yearly_no, monthly_reg_no, daily_reg_no, old_reg_no, create_date')
				->from('patient')
				//->where('create_date LIKE', $acyear)
				->order_by("id desc")
				->limit(1)->get()->result_array();

		} else {
			$q = $this->db->select('patient_id,yearly_reg_no, yearly_no, monthly_reg_no, daily_reg_no, old_reg_no, create_date')
				->from('patient_ipd')
				//->where('create_date LIKE', $acyear)
				->order_by("id desc")
				->limit(1)->get()->result_array();

		}

		$timezone = "Asia/Kolkata";
		date_default_timezone_set($timezone);

		$patient_id = $q[0]['patient_id'];
		$yearly_reg_no1 = $q[0]['yearly_reg_no'];
		if ($yearly_reg_no1) {
			$yearly_reg_no2 = $q[0]['yearly_reg_no'] + 1;
		} else {
			$yearly_reg_no2 = 1;
		}
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
		if ($currentYear > $oldyear) {
			//	$yearly_no = 1;
			$yearly_no = 1;
			$yearly_reg_no1 = 1;
			$patient_id = 1;
			$monthly_reg_no = 1;

		} else {
			//	$yearly_no = $yearly_no1 + 1;
			$yearly_no = $yearly_no1 + 1;
			$yearly_reg_no1 = $yearly_reg_no1 + 1;
			$patient_id = $patient_id + 1;
			//Monthly Number
			if ($currentmonth > $oldmonth) {
				$monthly_reg_no = 1;

			} else {
				$monthly_reg_no = $monthly_reg_no1 + 1;

			}
		}

		//Daily Number		
		if ($currentday == $oldday) {
			$daily_reg_no = $daily_reg_no1 + 1;
		} else {
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

		$sex = $this->input->post('sex');
		if ($sex == 'पुरुष') {
			$sex1 = 'M';

		} elseif ($sex == 'स्त्री') {
			$sex1 = 'F';

		} elseif ($sex == 'Boy') {
			$sex1 = 'M';

		} elseif ($sex == 'Girl') {
			$sex1 = 'F';

		} else {
			$sex1 = 'other';
		}

		#-------------------------------#
		if ($this->input->post('id') == null) { //create a patient
			if ($this->input->post('old_reg_no') == null) {
				$data['patient'] = (object) $postData = [
					'id' => $this->input->post('id'),
					/*'patient_id'   => $this->randStrGen(2,7),*/
					'patient_id' => $patient_id,
					'yearly_reg_no' => $yearly_reg_no2,
					'yearly_no' => $yearly_no,
					'monthly_reg_no' => $monthly_reg_no,
					'daily_reg_no' => $daily_reg_no,
					'ipd_no' => $this->input->post('ipd_no'),
					//	'old_reg_no' => $this->input->post('old_reg_no'),
					'firstname' => strtoupper($this->input->post('firstname')),
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'password' => md5($this->input->post('password')),
					'phone' => $this->input->post('phone'),
					'mobile' => $this->input->post('mobile'),
					'blood_group' => $this->input->post('blood_group'),
					'sex' => $sex1,
					'date_of_birth' => $this->input->post('date_of_birth'),
					'address' => $this->input->post('address'),
					'picture' => (!empty($picture) ? $picture : $this->input->post('old_picture')),
					'affliate' => null,
					'create_date' => date('Y-m-d', strtotime(($this->input->post('create_date') != null) ? $this->input->post('create_date') : date('Y-m-d'))),
					'created_by' => $this->session->userdata('user_id'),
					'status' => $this->input->post('status'),
					'ipd_opd' => $this->input->post('ipd_opd'),
					'department_id' => $this->input->post('department_id', true),
					'doctor_id' => $this->input->post('doctor_id', true),
					'assign_date' => $this->input->post('assign_date'),
					'discharge_date' => $this->input->post('discharge_date'),
					'dignosis' => strtoupper($this->input->post('dignosis')),
					'wardType' => $this->input->post('wardType'),
					'bedNo' => $this->input->post('bedNo'),
					'income' => $this->input->post('income'),
					'occupation' => $this->input->post('occupation'),
					'wieght' => $this->input->post('wieght'),
					'anesthesia' => $this->input->post('anesthesia'),
					'religion' => $this->input->post('religion'),
					'result' => $this->input->post('result')

				];
			} else {
				$data['patient'] = (object) $postData = [
					'id' => $this->input->post('id'),
					/*'patient_id'   => $this->randStrGen(2,7),*/
					'patient_id' => $patient_id,
					//'yearly_reg_no' =>  $this->input->post('yearly_reg_no'),
					'yearly_no' => $yearly_no,
					'monthly_reg_no' => $monthly_reg_no,
					'daily_reg_no' => $daily_reg_no,
					'old_reg_no' => $this->input->post('old_reg_no'),
					'ipd_no' => $this->input->post('ipd_no'),
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'password' => md5($this->input->post('password')),
					'phone' => $this->input->post('phone'),
					'mobile' => $this->input->post('mobile'),
					'blood_group' => $this->input->post('blood_group'),
					'sex' => $sex1,
					//'date_of_birth' => date('Y-m-d', strtotime(($this->input->post('date_of_birth') != null)? $this->input->post('date_of_birth'): date('Y-m-d'))),
					'date_of_birth' => $this->input->post('date_of_birth'),
					'address' => $this->input->post('address'),
					'picture' => (!empty($picture) ? $picture : $this->input->post('old_picture')),
					'affliate' => null,
					'create_date' => date('Y-m-d', strtotime(($this->input->post('create_date') != null) ? $this->input->post('create_date') : date('Y-m-d'))),
					'created_by' => $this->session->userdata('user_id'),
					'status' => $this->input->post('status'),
					'ipd_opd' => $this->input->post('ipd_opd'),
					'department_id' => $this->input->post('department_id', true),
					'doctor_id' => $this->input->post('doctor_id', true),
					'assign_date' => $this->input->post('assign_date'),
					'discharge_date' => $this->input->post('discharge_date'),
					'dignosis' => $this->input->post('dignosis'),
					'wardType' => $this->input->post('wardType'),
					'bedNo' => $this->input->post('bedNo'),
					'income' => $this->input->post('income'),
					'occupation' => $this->input->post('occupation'),
					'wieght' => $this->input->post('wieght'),
					'anesthesia' => $this->input->post('anesthesia'),
					'religion' => $this->input->post('religion'),
					'result' => $this->input->post('result')
				];
			}
		} else { // update patient

			$data['patient'] = (object) $postData = [
				'id' => $this->input->post('id'),
				'yearly_reg_no' => $this->input->post('yearly_reg_no'),
				//'yearly_no' => $this->input->post('yearly_no'),
				//'monthly_reg_no' => $this->input->post('monthly_reg_no'),
				//	'daily_reg_no' => $this->input->post('daily_reg_no'),
				'old_reg_no' => $this->input->post('old_reg_no'),
				//	'ipd_no' => $this->input->post('ipd_no'),
				'firstname' => strtoupper($this->input->post('firstname')),
				//	'lastname' 	   => $this->input->post('lastname'),
				//	'email' 	   => $this->input->post('email'),
				//	'password' 	   => md5($this->input->post('password')),
				//	'phone'   	   => $this->input->post('phone'),
				//	'mobile'       => $this->input->post('mobile'),
				'blood_group' => $this->input->post('blood_group'),
				'sex' => $sex1,
				'date_of_birth' => $this->input->post('date_of_birth'),
				'address' => $this->input->post('address'),
				//	'picture'      => (!empty($picture)?$picture:$this->input->post('old_picture')),
				'affliate' => null,
				'created_by' => $this->session->userdata('user_id'),
				'status' => $this->input->post('status'),
				'ipd_opd' => $this->input->post('ipd_opd'),
				'department_id' => $this->input->post('department_id', true),
				'doctor_id' => $this->input->post('doctor_id', true),
				'assign_date' => $this->input->post('assign_date'),
				'discharge_date' => $this->input->post('discharge_date'),
				'dignosis' => strtoupper($this->input->post('dignosis')),
				'wardType' => $this->input->post('wardType'),
				'bedNo' => $this->input->post('bedNo'),
				'income' => $this->input->post('income'),
				'occupation' => $this->input->post('occupation'),
				'wieght' => $this->input->post('wieght'),
				'anesthesia' => $this->input->post('anesthesia'),
				'religion' => $this->input->post('religion'),
				'result' => $this->input->post('result')
			];
		}
		//print_r($postData); exit;
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id then insert data
			if ($this->input->post('id') == null) {
				$ipd_opd_sec = $this->input->post('ipd_opd');
				if ($ipd_opd_sec == 'opd') {
					$last_id = $this->patient_model->create($postData);
				} else {
					$last_id = $this->patient_model->create_ipd($postData);
				}
				if ($last_id) {

					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				$name = strtoupper($this->input->post('firstname'));
				$diagnosis = strtoupper($this->input->post('dignosis'));
				$year_reg_id = $this->input->post('yearly_reg_no');
				if ($year_reg_id) {
					$year_reg_id = $this->input->post('yearly_reg_no');
				} else {
					$year_reg_id = $this->input->post('old_reg_no');
				}

				redirect('patients/patient_check/' . $last_id . '/' . $status_ipd_opd);
				//redirect('patients/treatment/'.$last_id.'/'.$status_ipd_opd.'/'.$diagnosis);
				//	redirect('patients/create',$data,true);
			} else {

				if ($this->patient_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('patients/edit/' . $postData['id']);
			}

		} else {
			$data['serial_no'] = '1';
			$data['dignosis_list'] = $this->dignosis_model->dignosis_sub_list();
			// $data['department_list'] = $this->department_model->department_list();
			$data['department_list'] = $this->department_model->department_list_2025();
			$data['address_list'] = $this->department_model->address_list();
			$data['content'] = $this->load->view('patient_form', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}
	}

	public function create_2orignal()
	{    //echo "dsdsd";
		//exit;
		//echo error_reporting(0); 
		$data['title'] = display('add_patient');
		$id = $this->input->post('id');

		$status_ipd_opd = $this->input->post('ipd_opd');

		#-------------------------------#
		$this->form_validation->set_rules('firstname', display('first_name'), 'required|max_length[50]');
		//$this->form_validation->set_rules('blood_group', display('blood_group'),'m');
		$this->form_validation->set_rules('sex', display('sex'), 'required');
		$this->form_validation->set_rules('date_of_birth', display('date_of_birth'), 'required|max_length[10]');
		$this->form_validation->set_rules('create_date', display('create_date'), 'required|max_length[20]');
		//$this->form_validation->set_rules('assign_date', display('assign_date'),'required|max_length[10]');
		$this->form_validation->set_rules('department_id', display('department_name'), 'required|max_length[255]');
		$this->form_validation->set_rules('address', display('address'), 'required|max_length[255]');
		$this->form_validation->set_rules('status', display('status'), 'required');
		if ($id != null) {
			$this->form_validation->set_rules('doctor_id', display('doctor_name'), 'required|max_length[255]');
		} elseif ($status_ipd_opd == 'ipd') {
			$this->form_validation->set_rules('bedNo', display('bedNo'), 'required');
			$this->form_validation->set_rules('doctor_id', display('doctor_name'), 'required|max_length[255]');
		}

		#-------------------------------#
		//picture upload
		$picture = $this->fileupload->do_upload(
			'assets/images/patient/',
			'picture'
		);


		//Registration numbr create

		$acyear = $this->session->userdata('acyear');

		if ($status_ipd_opd == 'opd') {
			$q = $this->db->select('patient_id,yearly_reg_no, yearly_no, monthly_reg_no, daily_reg_no, old_reg_no, create_date')
				->from('patient')
				//->where('yearly_reg_no != ', '')
				//->where('create_date LIKE', $acyear)
				->order_by("id desc")
				->limit(1)->get()->result_array();
		} else {
			$q = $this->db->select('patient_id,yearly_reg_no, yearly_no, monthly_reg_no, daily_reg_no, old_reg_no, create_date')
				->from('patient_ipd')
				//->where('create_date LIKE', $acyear)
				->order_by("id desc")
				->limit(1)->get()->result_array();
		}

		//print_r($status_ipd_opd);
		//print_r($q);
		//print_r($this->db->last_query());
		//die();

		$timezone = "Asia/Kolkata";
		date_default_timezone_set($timezone);

		/*$patient_id = $q[0]['patient_id'];
		$yearly_reg_no1 = $q[0]['yearly_reg_no'];
		if($yearly_reg_no1){
		$yearly_reg_no2 = $q[0]['yearly_reg_no'] + 1;
		}
		else{
		  $yearly_reg_no2 = 1;  
		}
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
		$oldday = date("d/m/Y", strtotime($q[0]['create_date']));*/

		$patient_id = 0;
		$yearly_reg_no1 = 0;
		$yearly_no1 = 0;
		$monthly_reg_no1 = 0;
		$daily_reg_no1 = 0;
		$old_reg_no1 = 0;
		$create_date1 = 0;

		$currentYear = 0;
		$currentmonth = 0;
		$currentday = 0;

		$oldyear = 0;
		$oldmonth = 0;
		$oldday = 0;
		if ($q != null) {
			$patient_id = $q[0]['patient_id'];
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
		}

		if ($yearly_reg_no1 != 0) {
			$yearly_reg_no2 = $q[0]['yearly_reg_no'] + 1;
		} else {
			$yearly_reg_no2 = 1;
		}
		//print_r($yearly_reg_no2);
		//die();

		//print_r($currentYear);
		//print_r('===>');
		//print_r($oldyear);

		//Yearly Number
		$monthly_reg_no = 0;
		if ($currentYear > $oldyear) {
			//	$yearly_no = 1;
			$yearly_no = 1;
			$yearly_reg_no1 = 1;
			$patient_id = 1;
			$monthly_reg_no = 1;

		} else {
			//	$yearly_no = $yearly_no1 + 1;
			$yearly_no = $yearly_no1 + 1;
			$yearly_reg_no1 = $yearly_reg_no1 + 1;
			$patient_id = $patient_id + 1;
			//Monthly Number
			if ($currentmonth > $oldmonth) {
				$monthly_reg_no = 1;

			} else {
				$monthly_reg_no = (int) $monthly_reg_no1 + 1;
			}
		}
		//print_r('===>');
		//print_r($yearly_no);

		//Daily Number
		$daily_reg_no = '';
		if ($currentday == $oldday) {
			$daily_reg_no = (int) $daily_reg_no1 + 1;
		} else {
			$daily_reg_no = 1;
		}
		//print_r($daily_reg_no);

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

		$sex = $this->input->post('sex');
		if ($sex == 'Male') {
			//$sex1 ='Male';
			$sex = 'M';

		} elseif ($sex == 'Female') {
			//$sex1 ='Female';
			$sex = 'F';
		}

		// 			print_r($this->input->post('id'));
// 			die();
//             print_r('====>');
// 			print_r($this->input->post('yearly_reg_no'));
//  			die();

		#-------------------------------#
		if ($this->input->post('id') == null) { //create a patient
// 			print_r('********');
// 			print_r($this->input->post('old_reg_no'));
//print_r($yearly_reg_no2);
//print_r($this->input->post('bedNo'));
			//die();
			//print_r($yearly_no);
			if ($this->input->post('old_reg_no') == null || $this->input->post('old_reg_no') == '') {

				$data['patient'] = (object) $postData = [
					'id' => $this->input->post('id'),
					/*'patient_id'   => $this->randStrGen(2,7),*/
					'patient_id' => $patient_id,
					//'yearly_reg_no' => $yearly_reg_no2,
					'yearly_reg_no' => $this->input->post('yearly_reg_no'),
					'yearly_no' => $yearly_no,
					'monthly_reg_no' => $monthly_reg_no,
					'daily_reg_no' => $daily_reg_no,
					'ipd_no' => $this->input->post('ipd_no'),
					//'old_reg_no' => $this->input->post('old_reg_no'),
					'firstname' => strtoupper($this->input->post('firstname')),
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'password' => md5($this->input->post('password')),
					'phone' => $this->input->post('phone'),
					'mobile' => $this->input->post('mobile'),
					'blood_group' => $this->input->post('blood_group'),
					//'sex' 		   => $sex1,
					'sex' => $sex,
					'date_of_birth' => $this->input->post('date_of_birth'),
					'address' => $this->input->post('address'),
					'picture' => (!empty($picture) ? $picture : $this->input->post('old_picture')),
					'affliate' => null,
					'create_date' => date('Y-m-d', strtotime(($this->input->post('create_date') != null) ? $this->input->post('create_date') : date('Y-m-d'))),
					'created_by' => $this->session->userdata('user_id'),
					'status' => $this->input->post('status'),
					'ipd_opd' => $this->input->post('ipd_opd'),
					'department_id' => $this->input->post('department_id', true),
					'doctor_id' => $this->input->post('doctor_id', true),
					'assign_date' => $this->input->post('assign_date'),
					'discharge_date' => ($this->input->post('discharge_date') != '') ? $this->input->post('discharge_date') : '0000-00-00',
					'dignosis' => strtoupper($this->input->post('dignosis')),
					'wardType' => $this->input->post('wardType'),
					'bedNo' => ($this->input->post('bedNo') != '') ? $this->input->post('bedNo') : $this->input->post('update_bed_no'),
					'income' => $this->input->post('income'),
					'occupation' => $this->input->post('occupation'),
					'wieght' => $this->input->post('weight'),
					'anesthesia' => $this->input->post('anesthesia'),
					'religion' => $this->input->post('religion'),
					'result' => $this->input->post('result')

				];
			} else {
				// print_r($this->input->post('status1'));
				// print_r($this->input->post('ipd_opd'));
				// die();
				if ($this->input->post('status1') == 'old' && $this->input->post('ipd_opd') == 'opd') {
					$y_new_reg = null;
					$y_old_reg = $this->input->post('old_reg_no');
				} elseif ($this->input->post('ipd_opd') == 'ipd') {
					$y_new_reg = $this->input->post('old_reg_no');
				} else {
					$y_new_reg = $yearly_reg_no1;
					$y_old_reg = $this->input->post('old_reg_no');
				}
				//print_r("12     ");
				//print_r($yearly_no);
				// print_r($yearly_reg_no2);
				$data['patient'] = (object) $postData = [
					'id' => $this->input->post('id'),
					/*'patient_id'   => $this->randStrGen(2,7),*/
					'patient_id' => $patient_id,
					//'yearly_reg_no' =>  $this->input->post('yearly_reg_no'),//working
					'yearly_reg_no' => $y_new_reg,
					//'yearly_reg_no' =>  $yearly_reg_no1,
					'yearly_no' => $yearly_no,
					'monthly_reg_no' => $monthly_reg_no,
					'daily_reg_no' => $daily_reg_no,
					//'old_reg_no' => $this->input->post('old_reg_no'),//working
					'old_reg_no' => ($this->input->post('ipd_opd') != 'ipd') ? $y_old_reg : null,
					'ipd_no' => $this->input->post('ipd_no'),
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'password' => md5($this->input->post('password')),
					'phone' => $this->input->post('phone'),
					'mobile' => $this->input->post('mobile'),
					'blood_group' => $this->input->post('blood_group'),
					//'sex' 		   => $sex1, 
					'sex' => $sex,
					//'date_of_birth' => date('Y-m-d', strtotime(($this->input->post('date_of_birth') != null)? $this->input->post('date_of_birth'): date('Y-m-d'))),
					'date_of_birth' => $this->input->post('date_of_birth'),
					'address' => $this->input->post('address'),
					'picture' => (!empty($picture) ? $picture : $this->input->post('old_picture')),
					'affliate' => null,
					'create_date' => date('Y-m-d', strtotime(($this->input->post('create_date') != null) ? $this->input->post('create_date') : date('Y-m-d'))),
					'created_by' => $this->session->userdata('user_id'),
					'status' => $this->input->post('status'),
					'ipd_opd' => $this->input->post('ipd_opd'),
					'department_id' => $this->input->post('department_id', true),
					'doctor_id' => $this->input->post('doctor_id', true),
					'assign_date' => $this->input->post('assign_date'),
					'discharge_date' => ($this->input->post('discharge_date') != '') ? $this->input->post('discharge_date') : '0000-00-00',
					'dignosis' => $this->input->post('dignosis'),
					'wardType' => $this->input->post('wardType'),
					'bedNo' => ($this->input->post('bedNo') != '') ? $this->input->post('bedNo') : $this->input->post('update_bed_no'),
					'income' => $this->input->post('income'),
					'occupation' => $this->input->post('occupation'),
					'wieght' => $this->input->post('weight'),
					'anesthesia' => $this->input->post('anesthesia'),
					'religion' => $this->input->post('religion'),
					'result' => $this->input->post('result')
				];
			}
		} else { // update patient
			//print_r($status_ipd_opd);
			//die();
			$data['patient'] = (object) $postData = [
				'id' => $this->input->post('id'),
				'yearly_reg_no' => $this->input->post('yearly_reg_no'),
				//'yearly_no' => $this->input->post('yearly_no'),
				//'monthly_reg_no' => $this->input->post('monthly_reg_no'),
				//	'daily_reg_no' => $this->input->post('daily_reg_no'),
				'old_reg_no' => $this->input->post('update_old_reg_no'),
				//	'ipd_no' => $this->input->post('ipd_no'),
				'firstname' => strtoupper($this->input->post('firstname')),
				//	'lastname' 	   => $this->input->post('lastname'),
				//	'email' 	   => $this->input->post('email'),
				//	'password' 	   => md5($this->input->post('password')),
				//	'phone'   	   => $this->input->post('phone'),
				//	'mobile'       => $this->input->post('mobile'),
				'blood_group' => $this->input->post('blood_group'),
				//'sex' 		   => $sex1,
				'sex' => $sex,
				'date_of_birth' => $this->input->post('date_of_birth'),
				'address' => $this->input->post('address'),
				//	'picture'      => (!empty($picture)?$picture:$this->input->post('old_picture')),
				'affliate' => null,
				'created_by' => $this->session->userdata('user_id'),
				'status' => $this->input->post('status'),
				'ipd_opd' => $this->input->post('ipd_opd'),
				'department_id' => $this->input->post('department_id', true),
				'doctor_id' => $this->input->post('doctor_id', true),
				'assign_date' => $this->input->post('assign_date'),
				'discharge_date' => ($this->input->post('discharge_date') != '') ? $this->input->post('discharge_date') : '0000-00-00',
				'dignosis' => strtoupper($this->input->post('dignosis')),
				'wardType' => $this->input->post('wardType'),
				'bedNo' => ($this->input->post('bedNo') != '') ? $this->input->post('bedNo') : $this->input->post('update_bed_no'),
				'income' => $this->input->post('income'),
				'occupation' => $this->input->post('occupation'),
				'wieght' => $this->input->post('weight'),
				'anesthesia' => $this->input->post('anesthesia'),
				'religion' => $this->input->post('religion'),
				'result' => $this->input->post('result')
			];
		}
		// print_r($postData); 
		// exit;
		#-------------------------------#

		if ($this->form_validation->run() === true) {
			//print_r("iddddd  ");
//print_r($this->input->post('id'));
			#if empty $id then insert data
			if ($this->input->post('id') == null) {
				$ipd_opd_sec = $this->input->post('ipd_opd');
				if ($ipd_opd_sec == 'opd') {
					$last_id = $this->patient_model->create($postData);
				} else {
					$last_id = $this->patient_model->create_ipd($postData);
				}
				//print_r("laaast  ");
//print_r($last_id);

				if ($last_id) {
					$id = $this->input->post('bedNo');
					$status = 1;
					$this->bed_model->updateBedSelection($id, $status);
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				$name = strtoupper($this->input->post('firstname'));
				$diagnosis = strtoupper($this->input->post('dignosis'));
				$year_reg_id = $this->input->post('yearly_reg_no');
				if ($year_reg_id) {
					$year_reg_id = $this->input->post('yearly_reg_no');
				} else {
					$year_reg_id = $this->input->post('old_reg_no');
				}

				//redirect('patients/create','refresh');

				//redirect('patients/patient_check/'.$last_id.'/'.$status_ipd_opd);
				//redirect('patients/treatment/'.$last_id.'/'.$status_ipd_opd.'/'.$diagnosis);
				redirect('patients/create', $data, true);
			} else {

				if ($this->patient_model->update($postData)) {
					$id = $this->input->post('bedNo');
					$oldBedNo = $this->input->post('update_bed_no');
					$status = 1;
					if ($id == null || $id == '') {
						$id = $oldBedNo;
					}
					$this->bed_model->updateOldBedSelection($oldBedNo);
					$this->bed_model->updateBedSelection($id, $status);
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				//redirect('patients/edit/'.$postData['id']);
				redirect('patients/create', 'refresh');
			}

		} else {
			$data['serial_no'] = '1';
			$data['dignosis_list'] = $this->dignosis_model->dignosis_sub_list();
			$data['department_list'] = $this->department_model->department_list_2025();
			$data['address_list'] = $this->department_model->address_list();

			$data['beds'] = $this->bed_model->read();

			$data['content'] = $this->load->view('patient_form', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}
	}



	public function treatment_save()
	{
		$section = $this->input->post('ipd_opd');
		$data['patient'] = (object) $postData = [
			'dignosis' => $this->input->post('dignosis'),
			'patient_id_auto' => $this->input->post('patient_id'),
			'panch_adv_flag' => $this->input->post('panch_adv_flag'),
			'department_id' => $this->input->post('department_id'),
			'ipd_opd' => $this->input->post('ipd_opd'),
			'RX1' => $this->input->post('RX1'),
			'RX2' => $this->input->post('RX2'),
			'RX3' => $this->input->post('RX3'),
			'SNEHAN' => $this->input->post('SNEHAN'),
			'SWEDAN' => $this->input->post('SWEDAN'),
			'VAMAN' => $this->input->post('VAMAN'),
			'VIRECHAN' => $this->input->post('VIRECHAN'),
			'BASTI' => $this->input->post('BASTI'),

			'NASYA' => $this->input->post('NASYA'),
			'RAKTAMOKSHAN' => $this->input->post('RAKTAMOKSHAN'),
			'SHIRODHARA_SHIROBASTI' => $this->input->post('SHIRODHARA_SHIROBASTI'),
			'OTHER' => $this->input->post('OTHER'),

			'SWA1' => $this->input->post('SWA1'),
			'SWA2' => $this->input->post('SWA2'),

			'HEMATOLOGICAL' => $this->input->post('HEMATOLOGICAL'),
			'SEROLOGYCAL' => $this->input->post('SEROLOGYCAL'),
			'BIOCHEMICAL' => $this->input->post('BIOCHEMICAL'),
			'MICROBIOLOGICAL' => $this->input->post('MICROBIOLOGICAL'),

			'X_RAY' => $this->input->post('X_RAY'),
			'ECG' => $this->input->post('ECG'),
		];

		$id = $this->input->post('patient_id');
		$data['patient'] = (object) $postData1 = [
			'id' => $this->input->post('patient_id'),
			'manual_status' => '1'
		];
		$this->patient_model->update_manual_treatment($postData1, $section);
		if ($this->patient_model->create_manual_treatment($postData, $section)) {

			#set success message
			$this->session->set_flashdata('message', display('save_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		if ($section == 'ipd') {
			redirect('patients/ipdprofile/' . $id);
		} else {
			redirect('patients/profile/' . $id);
		}
	}

	public function case_paper_print($section = '')
	{
		$data['title'] = display('patient_list');

		$data['date'] = (object) $getData = array(
			'start_date' => date('Y-m-d', strtotime(($this->input->post('start_date', true) != null) ? $this->input->post('start_date', true) : date('Y-m-d'))),
			'end_date' => date('Y-m-d', strtotime(($this->input->post('end_date', true) != null) ? $this->input->post('end_date', true) : date('Y-m-d'))),

		);
		$date_c = date('Y-m-d', strtotime("+ 5 days"));
		$data['patients'] = $this->patient_model->read_by_section($section);
		$data['check_data'] = $this->patient_model->read_by_check_data($section, $date_c);

		//	echo count($data['patients'] );exit;
		$section = $section;
		$data['section'] = $section;
		// $end_date= $start_date;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'ipd') {

			date_default_timezone_set('Asia/kolkata');
			$data['department_by_section'] = 'ipd';
			$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
			$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
			$data['gobs'] = 'gobs';

			$data['content'] = $this->load->view('case_paper_print', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		} else {

			date_default_timezone_set('Asia/kolkata');
			$data['department_by_section'] = 'opd';
			$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
			$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));


			$data['content'] = $this->load->view('case_paper_print', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}
	}


	public function case_paper_print_date()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $start_date1;

		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = date('Y-m-d', strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
		$data['section'] = $section;

		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$date1 = date_create($start_date2);
		$date2 = date_create($end_date2);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '1';
		}

		//echo $section;

		if ($section == 'opd') {
			$data['patients'] = $this->db->select("*")
				->from('patient')
				->join('department', 'department.dprt_id =  patient.department_id')
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)
				->where('create_date <=', $end_date)
				->where('yearly_reg_no !=', '')
				->where('create_date LIKE', $year)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {

			$data['patients'] = $this->db->select("*")
				->from('patient_ipd')
				->join('department', 'department.dprt_id =  patient_ipd.department_id')
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)
				->where('create_date <=', $end_date)
				->where('create_date LIKE', $year)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}

		if ($data == null) {
			if ($section == 'opd') {
				$data['content'] = $this->load->view('case_paper_print_opd', $data, true);
				$this->load->view('layout/main_wrapper', $data);
			} else {
				$data['content'] = $this->load->view('case_paper_print_ipd', $data, true);
				$this->load->view('layout/main_wrapper', $data);
			}

		} else {

			if ($section == 'opd') {



				$data['content'] = $this->load->view('case_paper_print_opd', $data, true);
				$this->load->view('layout/main_wrapper', $data);

			} else {
				$data['content'] = $this->load->view('case_paper_print_ipd', $data, true);
				$this->load->view('layout/main_wrapper', $data);
			}
		}


	}







	public function checked_data()
	{
		$section = $this->input->get('section');
		$check = $this->input->get('check');
		$date = $this->input->get('start_date1');
		$c_date = date('Y-m-d', strtotime($date));
		$c_date1 = '%' . $c_date . '%';

		$section1 = '%' . $section . '%';

		if ($section == 'opd') {
			$dd = $this->db->select('*')
				->from('check_data')
				->where('c_date LIKE', $c_date1)
				->where('section LIKE', $section1)
				->get()->result_array();

			$data['patient'] = (object) $postData = [
				'section' => $this->input->post('dignosis'),
				'c_date' => $c_date

			];

			if ($dd[0]['c_date']) {
				$data['patient'] = (object) $postData = [
					'section' => $section,
					'check_date' => $check,
					'c_date' => $c_date,
					'id' => $dd[0]['id']

				];
				if ($this->patient_model->check_data_update($postData, $section)) {

					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
			} else {
				$data['patient'] = (object) $postData = [
					'section' => $section,
					'check_date' => $check,
					'c_date' => $c_date

				];


				if ($this->patient_model->check_data_create($postData, $section)) {

					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
			}


			if ($section == 'ipd') {
				redirect('patientList/' . $section);
			} else {
				redirect('patientList/' . $section);
			}
		} else {
			$dd = $this->db->select('*')
				->from('check_data')
				->where('c_date LIKE', $c_date1)
				->where('section LIKE', $section1)
				->get()->result_array();

			$data['patient'] = (object) $postData = [
				'section' => $this->input->post('dignosis'),
				'c_date' => $c_date

			];

			if ($dd[0]['c_date']) {
				$data['patient'] = (object) $postData = [
					'section' => $section,
					'check_date' => $check,
					'c_date' => $c_date,
					'id' => $dd[0]['id']

				];
				if ($this->patient_model->check_data_update($postData, $section)) {

					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
			} else {
				$data['patient'] = (object) $postData = [
					'section' => $section,
					'check_date' => $check,
					'c_date' => $c_date

				];


				if ($this->patient_model->check_data_create($postData, $section)) {

					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
			}


			if ($section == 'ipd') {
				redirect('patientList/' . $section);
			} else {
				redirect('patientList/' . $section);
			}
		}
	}





	public function treatment_check_up()
	{
		$id = $this->input->post('id');
		$section = $this->input->post('section');
		$dignosis = $this->input->post('dignosis');
		$round = $this->input->post('round');
		$check_round = $this->patient_model->check_round($section, $id, $round);

		if ($section == 'opd') {
			$data['patient'] = (object) $postData = [
				'id' => $id,
				//'dignosis' => $this->input->post('dignosis'),
				'nadi' => $this->input->post('nadi'),
				'pulse' => $this->input->post('pulse'),
				// 'ipd_opd' => $this->input->post('ipd_opd'),
				'shudha' => $this->input->post('shudha'),
				'mal' => $this->input->post('mal'),
				'nidra' => $this->input->post('nidra'),
				'c_o' => $this->input->post('c_o'),
				'f_h' => strtoupper($this->input->post('f_h')),
				'h_o' => strtoupper($this->input->post('h_o')),
				'bp' => $this->input->post('bp'),
				'ur' => $this->input->post('ur'),
				'udar' => $this->input->post('udar'),
				'cvs' => $this->input->post('cvs'),
				'givwa' => $this->input->post('givwa'),

				'ahar' => $this->input->post('ahar'),
				'mutra' => $this->input->post('mutra')

			];
		} else {
			if ($check_round == 0) {
				$data['patient'] = (object) $postData = [
					// 'id' => $id,
					//'dignosis' => $this->input->post('dignosis'),

					'patient_id_auto' => $this->input->post('id'),
					'nadi' => $this->input->post('nadi'),
					'pulse' => $this->input->post('pulse'),
					'ipd_opd' => $this->input->post('ipd_opd'),
					'shudha' => $this->input->post('shudha'),
					'mal' => $this->input->post('mal'),
					'netra' => $this->input->post('netra'),
					'sym_name' => $this->input->post('c_o'),
					'f_o' => strtoupper($this->input->post('f_h')),
					'h_o' => strtoupper($this->input->post('h_o')),
					'bp' => $this->input->post('bp'),
					'RS' => $this->input->post('RS'),
					'ra' => $this->input->post('udar'),
					'cvs' => $this->input->post('cvs'),
					'givwa' => $this->input->post('givwa'),

					'ahar' => $this->input->post('ahar'),
					'mutra' => $this->input->post('mutra'),

					'RX1' => $this->input->post('RX1'),
					'RX2' => $this->input->post('RX2'),
					'RX3' => $this->input->post('RX3'),
					'RX4' => $this->input->post('RX4'),
					'RX5' => $this->input->post('RX5'),
					'tapman' => $this->input->post('tapman'),
					'rounds' => $this->input->post('round')
				];
			} else {

				$data['patient'] = (object) $postData = [
					'id' => $id,
					//'dignosis' => $this->input->post('dignosis'),

					'patient_id_auto' => $this->input->post('id'),
					'nadi' => $this->input->post('nadi'),
					'pulse' => $this->input->post('pulse'),
					'ipd_opd' => $this->input->post('ipd_opd'),
					'shudha' => $this->input->post('shudha'),
					'mal' => $this->input->post('mal'),
					'netra' => $this->input->post('netra'),
					'sym_name' => $this->input->post('c_o'),
					'f_o' => strtoupper($this->input->post('f_h')),
					'h_o' => strtoupper($this->input->post('h_o')),
					'bp' => $this->input->post('bp'),
					'RS' => $this->input->post('RS'),
					'ra' => $this->input->post('udar'),
					'cvs' => $this->input->post('cvs'),
					'givwa' => $this->input->post('givwa'),
					'ahar' => $this->input->post('ahar'),
					'mutra' => $this->input->post('mutra'),
					'RX1' => $this->input->post('RX1'),
					'RX2' => $this->input->post('RX2'),
					'RX3' => $this->input->post('RX3'),
					'RX4' => $this->input->post('RX4'),
					'RX5' => $this->input->post('RX5'),
					'tapman' => $this->input->post('tapman'),
					'rounds' => $this->input->post('round')
				];
			}
		}

		if ($check_round == 0) {

			if ($this->patient_model->insert_manual_check_up($postData, $section)) {

				#set success message
				$this->session->set_flashdata('message', display('save_successfully'));
			} else {
				#set exception message
				$this->session->set_flashdata('exception', display('please_try_again'));
			}

			// redirect('patients/treatment/'.$id.'/'.$section.'/'.$dignosis);
			if ($section == 'opd') {
				redirect('patients/profile/' . $id);
			} else {
				redirect('patients/ipdprofile/' . $id);
			}

		} else {

			if ($this->patient_model->update_manual_check_up_forround($postData, $section)) {

				#set success message
				$this->session->set_flashdata('message', display('save_successfully'));
			} else {
				#set exception message
				$this->session->set_flashdata('exception', display('please_try_again'));
			}

			// redirect('patients/treatment/'.$id.'/'.$section.'/'.$dignosis);
			if ($section == 'opd') {
				redirect('patients/profile/' . $id);
			} else {
				redirect('patients/ipdprofile/' . $id);
			}

		}
	}

	public function treatment_check_up_lib()
	{
		$id = $this->input->post('id');
		$section = $this->input->post('section');
		$dignosis = $this->input->post('dignosis');



		if ($section == 'opd') {
			$data['patient'] = (object) $postData = [
				'id' => $id,
				//'dignosis' => $this->input->post('dignosis'),
				'nadi' => $this->input->post('nadi'),
				'pulse' => $this->input->post('pulse'),
				// 'ipd_opd' => $this->input->post('ipd_opd'),
				'shudha' => $this->input->post('shudha'),
				'mal' => $this->input->post('mal'),
				'nidra' => $this->input->post('nidra'),
				'c_o' => $this->input->post('c_o'),
				'f_h' => strtoupper($this->input->post('f_h')),
				'h_o' => strtoupper($this->input->post('h_o')),
				'bp' => $this->input->post('bp'),
				'ur' => $this->input->post('ur'),
				'udar' => $this->input->post('udar'),
				'cvs' => $this->input->post('cvs'),
				'givwa' => $this->input->post('givwa'),

				'ahar' => $this->input->post('ahar'),
				'mutra' => $this->input->post('mutra')

			];
		} else {


			$data['patient'] = (object) $postData = [
				'id' => $id,
				//'dignosis' => $this->input->post('dignosis'),


				'Hb' => $this->input->post('Hb'),
				'TLC' => $this->input->post('TLC'),
				'DLC_Neutro' => $this->input->post('DLC_Neutro'),
				'Lymphocytes' => $this->input->post('Lymphocytes'),
				'Monocytes' => $this->input->post('Monocytes'),
				'Eosinophils' => $this->input->post('Eosinophils'),
				'ESR' => $this->input->post('ESR'),
				'Platelet_Count' => strtoupper($this->input->post('Platelet_Count')),
				'B_Sugar' => strtoupper($this->input->post('B_Sugar')),
				'Blood_Sugar' => $this->input->post('Blood_Sugar'),
				'Blood_Urea' => $this->input->post('Blood_Urea'),
				'S_Creatinine' => $this->input->post('S_Creatinine'),
				'S_Uric_Acid' => $this->input->post('S_Uric_Acid'),
				'SNat' => $this->input->post('SNat'),

				'SK' => $this->input->post('SK'),
				'Total_Cholestrol' => $this->input->post('Total_Cholestrol'),

				'STg' => $this->input->post('STg'),
				'LDL' => $this->input->post('LDL'),
				'VLDL' => $this->input->post('VLDL'),
				'BillirubinT' => $this->input->post('BillirubinT'),
				'BillirubinI' => $this->input->post('BillirubinI')

			];

		}



		if ($this->patient_model->update_manual_check_up_lib($postData, $section)) {

			#set success message
			$this->session->set_flashdata('message', display('save_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}

		// redirect('patients/treatment/'.$id.'/'.$section.'/'.$dignosis);
		if ($section == 'opd') {
			redirect('patients/patient_check_LABORATORY/' . $id . '/' . $section);
		} else {
			redirect('patients/patient_check_LABORATORY/' . $id . '/' . $section);
		}


	}

	public function medicine_save()
	{
		$type = $this->input->post('medicine_type');
		$name = $this->input->post('medicine_name');
		$dignosis = $this->input->post('dignosis');
		$patient_id = $this->input->post('patient_id');
		$ipd_opd = $this->input->post('ipd_opd');


		if ($type == 'RX1') {
			$data['patient'] = (object) $postData = ['RX1' => $name, 'ipd_opd' => $ipd_opd];
		} else if ($type == 'RX2') {
			$data['patient'] = (object) $postData = ['RX2' => $name, 'ipd_opd' => $ipd_opd];

		} else if ($type == 'RX3') {
			$data['patient'] = (object) $postData = ['RX3' => $name, 'ipd_opd' => $ipd_opd];

		} else if ($type == 'SNEHAN') {
			$data['patient'] = (object) $postData = ['SNEHAN' => $name, 'ipd_opd' => $ipd_opd];

		} else if ($type == 'SWEDAN') {
			$data['patient'] = (object) $postData = ['SWEDAN' => $name, 'ipd_opd' => $ipd_opd];

		} else if ($type == 'VAMAN') {
			$data['patient'] = (object) $postData = ['VAMAN' => $name, 'ipd_opd' => $ipd_opd];

		} else if ($type == 'VIRECHAN') {
			$data['patient'] = (object) $postData = ['VIRECHAN' => $name, 'ipd_opd' => $ipd_opd];

		} else if ($type == 'BASTI') {
			$data['patient'] = (object) $postData = ['BASTI' => $name, 'ipd_opd' => $ipd_opd];

		} else if ($type == 'NASYA') {
			$data['patient'] = (object) $postData = ['NASYA' => $name, 'ipd_opd' => $ipd_opd];

		} else if ($type == 'RAKTAMOKSHAN') {
			$data['patient'] = (object) $postData = ['RAKTAMOKSHAN' => $name, 'ipd_opd' => $ipd_opd];

		} else if ($type == 'SHIRODHARA_SHIROBASTI') {
			$data['patient'] = (object) $postData = ['SHIRODHARA_SHIROBASTI' => $name, 'ipd_opd' => $ipd_opd];

		} else if ($type == 'OTHER') {
			$data['patient'] = (object) $postData = ['OTHER' => $name, 'ipd_opd' => $ipd_opd];

		} else if ($type == 'SWA1') {
			$data['patient'] = (object) $postData = ['SWA1' => $name, 'ipd_opd' => $ipd_opd];

		} else if ($type == 'SWA2') {
			$data['patient'] = (object) $postData = ['SWA2' => $name, 'ipd_opd' => $ipd_opd];

		} else if ($type == 'HEMATOLOGICAL') {
			$data['patient'] = (object) $postData = ['HEMATOLOGICAL' => $name, 'ipd_opd' => $ipd_opd];

		} else if ($type == 'SEROLOGYCAL') {
			$data['patient'] = (object) $postData = ['SEROLOGYCAL' => $name, 'ipd_opd' => $ipd_opd];

		} else if ($type == 'BIOCHEMICAL') {
			$data['patient'] = (object) $postData = ['BIOCHEMICAL' => $name, 'ipd_opd' => $ipd_opd];

		} else if ($type == 'MICROBIOLOGICAL') {
			$data['patient'] = (object) $postData = ['MICROBIOLOGICAL' => $name, 'ipd_opd' => $ipd_opd];

		} else if ($type == 'X_RAY') {
			$data['patient'] = (object) $postData = ['X_RAY' => $name, 'ipd_opd' => $ipd_opd];

		} else {
			$data['patient'] = (object) $postData = ['ECG' => $name, 'ipd_opd' => $ipd_opd];

		}
		if ($this->patient_model->create_medicine($postData)) {



			#set success message
			$this->session->set_flashdata('message', display('save_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}

		redirect('patients/treatment/' . $patient_id . '/' . $ipd_opd . '/' . $dignosis);

	}

	public function profile($patient_id = null)
	{
		$data['title'] = display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->patient_model->read_by_id($patient_id);
		//	print_r($this->db->last_query());
		$data['documents'] = $this->document_model->read_by_patient($patient_id);
		//	print_r($this->db->last_query());
		$data['content'] = $this->load->view('patient_profile', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function ipd_profile_change($patient_id = null)
	{
		$data['title'] = display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->patient_model->read_by_id($patient_id);
		$data['documents'] = $this->document_model->read_by_patient($patient_id);
		$data['content'] = $this->load->view('ipd_profile_change', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function profile_anc($patient_id = null)
	{
		$data['title'] = display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->patient_model->read_by_id($patient_id);
		$data['documents'] = $this->document_model->read_by_patient($patient_id);
		$data['content'] = $this->load->view('patient_profile_anc', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function profile_bill($patient_id = null)
	{
		$data['title'] = display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->patient_model->read_by_id($patient_id);
		$data['documents'] = $this->document_model->read_by_patient($patient_id);
		$data['content'] = $this->load->view('profile_bill', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function ipdprofile($patient_id = null)
	{
		$data['title'] = display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->patient_model->read_by_id_ipd($patient_id);
		//print_r($this->db->last_query());

		$data['documents'] = $this->document_model->read_by_patient($patient_id);
		$data['content'] = $this->load->view('patientipd_profile2', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function ipdprofile_sky($patient_id = null)
	{
		$data['title'] = display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->patient_model->read_by_id_ipd($patient_id);
		//print_r($this->db->last_query());

		$data['documents'] = $this->document_model->read_by_patient($patient_id);
		$data['content'] = $this->load->view('patientipd_profile2_sky', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}


	public function ipdprofile_bill($patient_id = null)
	{
		$data['title'] = display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->patient_model->read_by_id_ipd($patient_id);

		$data['documents'] = $this->document_model->read_by_patient($patient_id);
		$data['content'] = $this->load->view('profile_bill_ipd', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}




	public function treatment($patient_id = null, $section = null, $dignosis = null)
	{

		$treatment_list_HEMATOLOGICAL = array(
			'NULL' => 'None',
			'CBC' => 'CBC',
			'ESR' => 'ESR',
			'BTCT' => 'BTCT',
			'BLOOD GROUP' => 'BLOOD GROUP',
			'HB' => 'HB'
		);


		$treatment_list_SEROLOGYCAL = array(
			'NULL' => 'None',
			'MP' => 'MP',
			'HIV' => 'HIV',
			'HCV' => 'HCV',
			'HBsAG' => 'HBsAG',
			'VDRL' => 'VDRL',
			'UPT' => 'UPT',
			'PS FOR MP' => 'PS FOR MP',
			'WIDAL TEST' => 'WIDAL TEST',
			'DENGUE' => 'DENGUE',
			'SHBG' => 'SHBG',
			'CRP' => 'CRP',
			'HIV TRIDOT' => 'HIV TRIDOT',
			'RA TEST' => 'RA TEST'
		);


		$treatment_list_BIOCHEMICAL = array(
			'NULL' => 'None',
			'LFT' => 'LFT',
			'BSL-R' => 'BSL-R',
			'KFT' => 'KFT',
			'LIPID PROFILE' => 'LIPID PROFILE',
			'Sr.Prolactin' => 'Sr.Prolactin',
			'S.ELECTROLYTES' => 'S.ELECTROLYTES',
			'RFT' => 'RFT',
			'S.Uric Acid' => 'S.Uric Acid',
			'S.CREATININE' => 'S.CREATININE',
			'GTT' => 'GTT',
			'TESTOSTIRONE' => 'TESTOSTIRONE',
			'HbA1C' => 'HbA1C',
			'AMH' => 'AMH',
			'FSH' => 'FSH',
			'LH' => 'LH',
			'BSL-F-PP' => 'BSL-F-PP',
			'FASTING - POSTMEAL' => 'FASTING - POSTMEAL'




			// 'SR.BILIRUBIN'=>'SR.BILIRUBIN', 
			// 'SR.CREATINE'=>'SR.CREATINE',
			// 'SR.URIC ACID'=>'SR.URIC ACID',
			// 'SR.CALCIUM'=>'SR.CALCIUM', 
			// 'LIPID PROFILE'=>'LIPID PROFILE',
			// 'LFT'=>'LFT',
			// 'SGOT'=>'SGOT', 
			// 'SGPT'=>'SGPT', 
			// 'RFT'=>'RFT',
			// 'BLOOD SUGAR(RANDOM)'=>'BLOOD SUGAR(RANDOM)', 
			// 'FASTING - POSTMEAL'=>'FASTING - POSTMEAL', 
			// 'CHOLESTEROL'=>'CHOLESTEROL', 
			// 'TRIGLYCERIDE'=>'TRIGLYCERIDE', 
			// 'HDL'=>'HDL', 
			// 'SR.UREA'=>'SR.UREA',
			// 'CRP'=>'CRP',
			// 'SR.ALKALINE PHOSPHOT'=>'SR.ALKALINE PHOSPHOT'
		);

		$treatment_list_MICROBIOLOGICAL = array(
			'NULL' => 'None',
			'STOOL R-M' => 'STOOL R-M',
			'URINE R' => 'URINE R',
			'URINE R-M' => 'URINE R-M',
			'URINE ROUTINE' => 'URINE ROUTINE'
		);



		$treatment_list_usg = array(
			'NULL' => 'None',
			'USG WHOLE ABDOMEN' => 'USG WHOLE ABDOMEN',
			'USG WHOLE ABDOMEN (if required)' => 'USG WHOLE ABDOMEN (if required)',
			'USG - A+P' => 'USG - A+P',
			'USG - OBS' => 'USG - OBS',
			'USG - KUB' => 'USG - KUB',
			'USG ABD & PELVIS' => 'USG ABD & PELVIS',
			'USG - PELVIS' => 'USG - PELVIS',
			'COLOUR DOPPLER' => 'COLOUR DOPPLER',
			'AV DOPPLER' => 'AV DOPPLER'
		);

		if ($section == 'ipd') {
			$data['title'] = display('patient_Treatment');
			$dignosis1 = str_replace("%20", " ", $dignosis);
			$data['patient'] = $this->patient_model->read_by_id_treatment($patient_id, $section);
			$data['dignosis_list'] = $this->department_model->dignosis_list();
			$data['department_list'] = $this->department_model->department_list();


			$result = $this->db->get('pharma1')->result();
			$data['treatment_list_rx1'] = $result;
			$data['treatment_list_rx2'] = $result;
			$data['treatment_list_rx3'] = $result;
			$data['treatment_list_rx4'] = $result;
			$data['treatment_list_rx5'] = $result;
			$data['treatment_list_rx6'] = $result;
			$data['treatment_list_rx7'] = $result;
			$data['treatment_list_rx8'] = $result;
			$data['treatment_list_rx9'] = $result;
			$data['treatment_list_rx10'] = $result;
			$data['treatment_list_rx_other'] = $result;
			$data['treatment_list_rx_other1'] = $result;
			$data['treatment_list_drx1'] = $result;
			$data['treatment_list_drx2'] = $result;
			$data['treatment_list_drx3'] = $result;

			$data['treatment_list_pk1'] = $this->department_model->treatment_list_pk1($dignosis1, $section);
			$data['treatment_list_pk2'] = $this->department_model->treatment_list_pk2($dignosis1, $section);
			$data['treatment_list_karma'] = $this->department_model->treatment_list_karma($dignosis1, $section);
			$data['treatment_list_swa1'] = $this->department_model->treatment_list_swa1($dignosis1, $section);
			$data['treatment_list_swa2'] = $this->department_model->treatment_list_swa2($dignosis1, $section);

			$data['treatment_list_patho'] = $this->department_model->treatment_list_patho($dignosis1, $section);
			$data['treatment_list_patho2'] = $this->department_model->treatment_list_patho2($dignosis1, $section);
			$data['treatment_list_patho3'] = $this->department_model->treatment_list_patho3($dignosis1, $section);

			$data['treatment_list_OTHER'] = $this->department_model->treatment_list_OTHER($dignosis1, $section);
			$data['treatment_list_swa11'] = $this->department_model->treatment_list_swa11($dignosis1, $section);
			$data['treatment_list_swa12'] = $this->department_model->treatment_list_swa12($dignosis1, $section);

			//// $data['treatment_list_SEROLOGYCAL'] = $this->department_model->treatment_list_SEROLOGYCAL($dignosis1,$section);
			//// $data['treatment_list_MICROBIOLOGICAL'] = $this->department_model->treatment_list_MICROBIOLOGICAL($dignosis1,$section);
			//// $data['treatment_list_HEMATOLOGICAL'] = $this->department_model->treatment_list_HEMATOLOGICAL($dignosis1,$section);
			//// $data['treatment_list_BIOCHEMICAL'] = $this->department_model->treatment_list_BIOCHEMICAL($dignosis1,$section);

			$data['treatment_list_SEROLOGYCAL'] = $treatment_list_SEROLOGYCAL;
			$data['treatment_list_MICROBIOLOGICAL'] = $treatment_list_MICROBIOLOGICAL;
			$data['treatment_list_BIOCHEMICAL'] = $treatment_list_BIOCHEMICAL;
			$data['treatment_list_HEMATOLOGICAL'] = $treatment_list_HEMATOLOGICAL;

			$data['treatment_list_x_ray'] = $this->department_model->treatment_list_x_ray($dignosis1, $section);
			$data['treatment_list_ecg'] = $this->department_model->treatment_list_ecg($dignosis1, $section);
			//// $data['treatment_list_usg'] = $this->department_model->treatment_list_usg($dignosis1,$section);
			$data['treatment_list_usg'] = $treatment_list_usg;

			// print_r($data['digno_sub_list']); exit;
			//$data['treatment_power'] = $this->department_model->treatment_power_list();
			$data['documents'] = $this->document_model->read_by_id_treatment($patient_id);
			$data['content'] = $this->load->view('patientipd_treatment', $data, true);
			$this->load->view('layout/main_wrapper', $data);

			$data['patient_auto_id'] = $patient_id;

		} else {
			$data['title'] = display('patient_Treatment');
			$dignosis1 = str_replace("%20", " ", $dignosis);
			$data['patient'] = $this->patient_model->read_by_id_treatment($patient_id, $section);
			$data['dignosis_list'] = $this->department_model->dignosis_list();
			$data['department_list'] = $this->department_model->department_list();

			$result = $this->db->get('pharma1')->result();
			$data['treatment_list_rx1'] = $result;
			$data['treatment_list_rx2'] = $result;
			$data['treatment_list_rx3'] = $result;
			$data['treatment_list_rx4'] = $result;
			$data['treatment_list_rx5'] = $result;
			$data['treatment_list_rx6'] = $result;
			$data['treatment_list_rx7'] = $result;
			$data['treatment_list_rx8'] = $result;
			$data['treatment_list_rx9'] = $result;
			$data['treatment_list_rx10'] = $result;
			$data['treatment_list_rx_other'] = $result;
			$data['treatment_list_rx_other1'] = $result;
			$data['treatment_list_drx1'] = $result;
			$data['treatment_list_drx2'] = $result;
			$data['treatment_list_drx3'] = $result;

			$data['treatment_list_pk1'] = $this->department_model->treatment_list_pk1($dignosis1, $section);
			$data['treatment_list_pk2'] = $this->department_model->treatment_list_pk2($dignosis1, $section);
			$data['treatment_list_karma'] = $this->department_model->treatment_list_karma($dignosis1, $section);
			$data['treatment_list_swa1'] = $this->department_model->treatment_list_swa1($dignosis1, $section);
			$data['treatment_list_swa2'] = $this->department_model->treatment_list_swa2($dignosis1, $section);

			$data['treatment_list_patho'] = $this->department_model->treatment_list_patho($dignosis1, $section);
			$data['treatment_list_patho2'] = $this->department_model->treatment_list_patho2($dignosis1, $section);
			$data['treatment_list_patho3'] = $this->department_model->treatment_list_patho3($dignosis1, $section);

			$data['treatment_list_OTHER'] = $this->department_model->treatment_list_OTHER($dignosis1, $section);
			$data['treatment_list_swa11'] = $this->department_model->treatment_list_swa11($dignosis1, $section);
			$data['treatment_list_swa12'] = $this->department_model->treatment_list_swa12($dignosis1, $section);

			// $data['treatment_list_SEROLOGYCAL'] = $this->department_model->treatment_list_SEROLOGYCAL($dignosis1,$section);
			// $data['treatment_list_MICROBIOLOGICAL'] = $this->department_model->treatment_list_MICROBIOLOGICAL($dignosis1,$section);
			// $data['treatment_list_HEMATOLOGICAL'] = $this->department_model->treatment_list_HEMATOLOGICAL($dignosis1,$section);
			// $data['treatment_list_BIOCHEMICAL'] = $this->department_model->treatment_list_BIOCHEMICAL($dignosis1,$section);

			$data['treatment_list_SEROLOGYCAL'] = $treatment_list_SEROLOGYCAL;
			$data['treatment_list_MICROBIOLOGICAL'] = $treatment_list_MICROBIOLOGICAL;
			$data['treatment_list_BIOCHEMICAL'] = $treatment_list_BIOCHEMICAL;
			$data['treatment_list_HEMATOLOGICAL'] = $treatment_list_HEMATOLOGICAL;

			$data['treatment_list_x_ray'] = $this->department_model->treatment_list_x_ray($dignosis1, $section);
			$data['treatment_list_ecg'] = $this->department_model->treatment_list_ecg($dignosis1, $section);
			//// $data['treatment_list_usg'] = $this->department_model->treatment_list_usg($dignosis1,$section);
			$data['treatment_list_usg'] = $treatment_list_usg;
			$data['patient_auto_id'] = $patient_id;
			// print_r($data['digno_sub_list']); exit;
			//$data['treatment_power'] = $this->department_model->treatment_power_list();
			$data['documents'] = $this->document_model->read_by_id_treatment($patient_id);
			$data['content'] = $this->load->view('patient_treatment', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}
	}



	public function patient_check($patient_id = null, $section = null)
	{
		$data['patient_id'] = $patient_id;
		$year = '%' . $this->session->userdata['acyear'] . '%';
		if ($section == 'ipd') {
			$data['title'] = display('patient_check_up');
			$dignosis1 = 'text';
			$data['patient'] = $this->patient_model->read_by_id_treatment($patient_id, $section);
			//print_r($this->db->last_query());
			$data['dignosis_list'] = $this->department_model->dignosis_list();
			//	$data['treatment_list'] = $this->department_model->treatment_list();	
			$data['department_list'] = $this->department_model->department_list();
			$data['treatment_list_rx1'] = $this->department_model->treatment_list_rx1($dignosis1, $section);
			$data['treatment_list_rx2'] = $this->department_model->treatment_list_rx2($dignosis1, $section);
			$data['treatment_list_rx3'] = $this->department_model->treatment_list_rx3($dignosis1, $section);
			$data['treatment_list_rx4'] = $this->department_model->treatment_list_rx4($dignosis1, $section);
			$data['treatment_list_rx5'] = $this->department_model->treatment_list_rx5($dignosis1, $section);
			$data['treatment_list_rx6'] = $this->department_model->treatment_list_rx6($dignosis1, $section);
			$data['treatment_list_rx7'] = $this->department_model->treatment_list_rx7($dignosis1, $section);
			$data['treatment_list_rx8'] = $this->department_model->treatment_list_rx8($dignosis1, $section);
			$data['treatment_list_rx9'] = $this->department_model->treatment_list_rx9($dignosis1, $section);
			$data['treatment_list_rx10'] = $this->department_model->treatment_list_rx10($dignosis1, $section);



			// print_r($data['digno_sub_list']); exit;
			//$data['treatment_power'] = $this->department_model->treatment_power_list();
			$data['documents'] = $this->document_model->read_by_id_treatment($patient_id);
			$data['content'] = $this->load->view('patient_check_ipd', $data, true);
			$this->load->view('layout/main_wrapper', $data);

		} else {
			$data['title'] = display('patient_check_up');
			// $dignosis1 = str_replace("%20"," ",$dignosis); 
			$data['patient'] = $this->patient_model->read_by_id_treatment($patient_id, $section);
			//print_r($this->db->last_query());
			$data['documents'] = $this->document_model->read_by_id_treatment($patient_id);

			$data['content'] = $this->load->view('patient_check', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}
	}



	public function patient_check_LABORATORY($patient_id = null, $section = null)
	{

		if ($section == 'ipd') {
			$data['title'] = display('patient_check_up');
			$dignosis1 = 'text';
			$data['patient'] = $this->patient_model->read_by_id_treatment($patient_id, $section);
			$data['dignosis_list'] = $this->department_model->dignosis_list();
			//	$data['treatment_list'] = $this->department_model->treatment_list();	
			$data['department_list'] = $this->department_model->department_list();
			$data['treatment_list_rx1'] = $this->department_model->treatment_list_rx1($dignosis1, $section);
			//	$data['treatment_list_rx11'] = $this->department_model->treatment_list_rx11($dignosis1,$section);
			$data['treatment_list_rx2'] = $this->department_model->treatment_list_rx2($dignosis1, $section);
			//	$data['treatment_list_rx22'] = $this->department_model->treatment_list_rx22($dignosis1,$section);
			$data['treatment_list_rx3'] = $this->department_model->treatment_list_rx3($dignosis1, $section);
			$data['treatment_list_rx4'] = $this->department_model->treatment_list_rx4($dignosis1, $section);
			$data['treatment_list_rx5'] = $this->department_model->treatment_list_rx5($dignosis1, $section);
			$data['treatment_list_rx6'] = $this->department_model->treatment_list_rx5($dignosis1, $section);
			$data['treatment_list_rx7'] = $this->department_model->treatment_list_rx5($dignosis1, $section);
			$data['treatment_list_rx8'] = $this->department_model->treatment_list_rx5($dignosis1, $section);
			$data['treatment_list_rx9'] = $this->department_model->treatment_list_rx5($dignosis1, $section);
			$data['treatment_list_rx10'] = $this->department_model->treatment_list_rx5($dignosis1, $section);


			$data['Other_RX'] = $this->department_model->ohter_rx($dignosis1, $section);
			$data['Other_RX1'] = $this->department_model->other_rx1($dignosis1, $section);

			//	$data['treatment_list_rx33'] = $this->department_model->treatment_list_rx33($dignosis1,$section);


			// print_r($data['digno_sub_list']); exit;
			//$data['treatment_power'] = $this->department_model->treatment_power_list();
			$data['documents'] = $this->document_model->read_by_id_treatment($patient_id);
			$data['content'] = $this->load->view('patient_check_LABORATORY', $data, true);
			$this->load->view('layout/main_wrapper', $data);

		} else {
			$data['title'] = display('patient_check_up');
			// $dignosis1 = str_replace("%20"," ",$dignosis); 


			// print_r($data['digno_sub_list']); exit;
			//$data['treatment_power'] = $this->department_model->treatment_power_list();
			$data['documents'] = $this->document_model->read_by_id_treatment($patient_id);
			$data['content'] = $this->load->view('patient_check_LABORATORY', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}
	}


	public function edit($patient_id = null)
	{
		//	print_r($patient_id);
		//die();
		$data['title'] = display('patient_edit');
		#-------------------------------#
		$data['patient'] = $this->patient_model->read_by_id($patient_id);
		$data['department_list'] = $this->department_model->department_list_2025();
		// print_r($data['patient']->firstname);
		//	die();
		$data['address_list'] = $this->department_model->address_list();
		$data['content'] = $this->load->view('patient_form', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function edit_ipd($patient_id = null)
	{
		//print_r('hi');
		//die();
		$data['title'] = display('patient_edit');
		#-------------------------------#
		$data['patient'] = $this->patient_model->read_by_id_ipd($patient_id);
		$data['department_list'] = $this->department_model->department_list_2025();
		$data['address_list'] = $this->department_model->address_list();
		$data['content'] = $this->load->view('patient_form', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}



	public function getpatientbydepartment($department_id = '', $section = '')
	{

		$department_id_decode = rawurldecode($department_id);
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id($department_id_decode, $section);
		//print_r($this->db->last_query());

		$section = $section;
		$data['section'] = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {

			$data['department_by_section'] = 'opd';
		} else {


			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
		$data['department_by'] = 'dpt';
		$data['department_id'] = $department_id_decode;
		$data['getpatientbydepartment_date'] = 'D';
		$data['section'] = $section;
		$data['content'] = $this->load->view('patient', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}


	public function getpatientbydepartment1($department_id = '', $section = '')
	{

		$department_id_decode = rawurldecode($department_id);
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id($department_id_decode, $section);

		//$section = $section;
		//$data['section']=$section;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {

			$data['department_by_section'] = 'opd';
		} else {


			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
		$data['department_by'] = 'dpt';
		$data['department_id'] = $department_id_decode;
		$data['getpatientbydepartment_date'] = 'D';
		//$data['section'] = $section;
		$data['content'] = $this->load->view('patientgob_new', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function getpatientbydepartment_admit_register($department_id = '', $section = '')
	{

		$department_id_decode = rawurldecode($department_id);
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id($department_id_decode, $section);
		$section = $section;
		$year = '%' . $this->session->userdata['acyear'] . '%';
		if ($section == 'opd') {
			$data['department_by_section'] = 'opd';
		} else {
			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
		$data['department_by'] = 'dpt';
		$data['department_id'] = $department_id_decode;
		$data['getpatientbydepartment_date'] = 'D';
		$data['content'] = $this->load->view('patient_amit_register', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function pharma_date_month($pharma = '', $section = '', $segment)
	{

		// echo $section;exit;


		$start_date1 = $this->input->get('start_date');

		$end_date1 = $this->input->get('end_date', TRUE);


		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = date('Y-m-d', strtotime($end_date1));
		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";

		$end_date_close = $end_date2 . " 00:00:00";

		$data['title'] = display('patient_Pharma');
		$data['patients'] = $this->patient_model->read_by_phrama($section);
		$data['patients__date'] = $this->patient_model->read_by_phrama_date_summary_month($section, $start_date, $end_date);

		$data['pharma'] = $this->patient_model->read_by_phrama_date_summary_month_name($section, $start_date, $end_date);

		$data['pharma_req'] = $this->patient_model->pharma_req($section, $start_date, $end_date);

		$data['pharma_close'] = $this->patient_model->pharma_close($section, $end_date_close, $end_date);
		$section = $section;

		$data['fisrt_hide'] = 1;

		$year = '%' . $this->session->userdata['acyear'] . '%';


		$data['department_by_section'] = $section;


		$data['datefrom'] = $start_date2;
		$data['dateto'] = $end_date2;
		$data['department_by'] = 'dpt';
		$data['pharmas'] = $pharma;
		$data['start'] = '1';

		$config = array();
		$config["base_url"] = base_url() . "patients/pharma/" . $pharma . '/' . $section;
		$config["total_rows"] = $this->patient_model->read_by_phrama_get_count($section);
		$config["per_page"] = 25;
		$config["uri_segment"] = 5;




		$this->pagination->initialize($config);

		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

		$data["links"] = $this->pagination->create_links();

		$data['patients'] = $this->patient_model->read_by_phrama($section, $config["per_page"], $page);

		$data['content'] = $this->load->view('pharma_Month', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function pharma_date_year($pharma = '', $section = '', $segment)
	{

		// echo $section;exit;


		$start_date1 = $this->input->get('start_date');

		$end_date1 = $this->input->get('end_date', TRUE);


		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = date('Y-m-d', strtotime($end_date1));
		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";

		$end_date_close = $end_date2 . " 00:00:00";

		$data['title'] = display('patient_Pharma');
		$data['patients'] = $this->patient_model->read_by_phrama($section);
		$data['patients__date'] = $this->patient_model->read_by_phrama_date_summary_year($section, $start_date, $end_date);

		$data['pharma'] = $this->patient_model->read_by_phrama_date_summary_month_name($section, $start_date, $end_date);

		$data['pharma_req'] = $this->patient_model->pharma_req($section, $start_date, $end_date);

		$data['pharma_close'] = $this->patient_model->pharma_close($section, $end_date_close, $end_date);
		$section = $section;

		$data['fisrt_hide'] = 1;

		$year = '%' . $this->session->userdata['acyear'] . '%';


		$data['department_by_section'] = $section;


		$data['datefrom'] = $start_date2;
		$data['dateto'] = $end_date2;
		$data['department_by'] = 'dpt';
		$data['pharmas'] = $pharma;
		$data['start'] = '1';

		$config = array();
		$config["base_url"] = base_url() . "patients/pharma/" . $pharma . '/' . $section;
		$config["total_rows"] = $this->patient_model->read_by_phrama_get_count($section);
		$config["per_page"] = 25;
		$config["uri_segment"] = 5;




		$this->pagination->initialize($config);

		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

		$data["links"] = $this->pagination->create_links();

		$data['patients'] = $this->patient_model->read_by_phrama($section, $config["per_page"], $page);

		$data['content'] = $this->load->view('pharma_year', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function pharma_date($pharma = '', $section = '', $segment)
	{


		$ses_year = $this->session->userdata['acyear'];
		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date');

		$end_date1 = $this->input->get('end_date', TRUE);


		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$start_date2_M_D = date('-m-d', strtotime($start_date1));
		$start_date2_M_D_Y = $ses_year . $start_date2_M_D;

		$end_date2 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);

		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";

		$pre_date = date('Y-m-d', strtotime("-1 days", strtotime($start_date2_M_D_Y)));

		$w_day11 = date('D', strtotime($pre_date));


		$holiday_pre = $this->db->select("*")

			->from('holiday')
			->where('holiday_date', $pre_date)
			//	->where('status',1)

			->get()

			->row();



		if ($start_date2_M_D_Y == '2018-10-01') {
			$date_for_pharma = $start_date2_M_D_Y;
			$fisrt_date = '2018-10-01';
		} else if ($holiday_pre) {
			$pre_date = date('Y-m-d', strtotime("-2 days", strtotime($start_date2_M_D_Y)));
			$w_day = date('D', strtotime($pre_date));
			if ($w_day != 'Sun') {
				$date_for_pharma = $pre_date;
			}
		} else if ($w_day11 != 'Sun') {
			$date_for_pharma = $pre_date;
		} else {

			$date_for_pharma = $pre_date;




		}

		$date_for_pharma;

		$data['pharmaaa'] = $this->patient_model->read_by_phrama_list1_daily($pharma, $date_for_pharma, $section);
		if ((!empty($data['pharmaaa'])) && (empty($fisrt_date))) {
			$data['pharma'] = $this->patient_model->read_by_phrama_list1_daily($pharma, $date_for_pharma, $section);
		} else {
			if (empty($data['pharma'])) {
				$data['pharma'] = $this->patient_model->read_by_phrama_list1($pharma);
			}
		}
		$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';


		$data['department_by_section'] = $section;

		$config = array();
		$config["base_url"] = base_url() . "patients/pharma/" . $pharma . '/' . $section;
		$config["total_rows"] = $this->patient_model->read_by_phrama_get_count1($section, $start_date, $end_date);
		$config["per_page"] = 25;
		$config["uri_segment"] = 5;

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

		$data["links"] = $this->pagination->create_links();
		// $data['patients'] = $this->patient_model->read_by_phrama_date($section,$start_date,$end_date,$config["per_page"], $page);
		// $data['patients'] = $this->patient_model->read_by_phrama_date_summary('opd',$start_date,$end_date);
		$data['patients'] = $this->patient_model->read_by_phrama_date_summary('opd', $start_date, $end_date);

		// $data['patients'] = array_merge( $data['patients_opd'], $data['patients_ipd']);


		//$data['patients_summary'] = $this->patient_model->read_by_phrama_date_summary('opd',$start_date,$end_date);
		$data['patients_summary'] = $this->patient_model->read_by_phrama_date_summary('opd', $start_date, $end_date);

		//$data['patients_summary'] = array_merge( $data['patients_summary_opd'], $data['patients_summary_ipd']);


		$data['datefrom'] = $start_date2;
		$data['dateto'] = $end_date2;
		$data['department_by'] = 'dpt';
		$data['pharmas'] = $pharma;
		$data['department_by_section'] = 'opd';

		$data['ipd'] = $section;

		$data['content'] = $this->load->view('pharma', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function pharma_date_Despensing($pharma = '', $section = '', $segment, $start_date, $end_date)
	{


		$ses_year = $this->session->userdata['acyear'];
		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date11 = $this->input->get('start_date');

		$end_date11 = $this->input->get('end_date', TRUE);

		if ($start_date11) {
			$start_date = date('Y-m-d', strtotime($start_date11));
			$start_date_n = date('Y-m-d', strtotime($start_date11));
		} else if ($start_date) {
			$start_date = date('Y-m-d', strtotime($start_date));
			$start_date_n = date('Y-m-d', strtotime($start_date));
		} else {
			$start_date = date('Y-m-d');
			$start_date_n = date('Y-m-d');
		}

		if ($end_date11) {
			$end_date = date('Y-m-d', strtotime($end_date11));
			$end_date_n = date('Y-m-d', strtotime($end_date11));
		} else
			if ($end_date) {
				$end_date = date('Y-m-d', strtotime($end_date));
				$end_date_n = date('Y-m-d', strtotime($end_date));
			} else {
				$end_date = date('Y-m-d');
				$end_date_n = date('Y-m-d');
			}

		$start_date1 = $start_date;

		$end_date1 = $end_date;


		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$start_date2_M_D = date('-m-d', strtotime($start_date1));
		$start_date2_M_D_Y = $ses_year . $start_date2_M_D;

		$end_date2 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);
		if (empty($section)) {
			$section = $this->uri->segment(4);
		}

		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";

		$pre_date = date('Y-m-d', strtotime("-1 days", strtotime($start_date2_M_D_Y)));

		$w_day11 = date('D', strtotime($pre_date));


		$holiday_pre = $this->db->select("*")

			->from('holiday')
			->where('holiday_date', $pre_date)
			//	->where('status',1)

			->get()

			->row();



		if ($start_date2_M_D_Y == '2018-10-01') {
			$date_for_pharma = $start_date2_M_D_Y;
			$fisrt_date = '2018-10-01';
		} else if ($holiday_pre) {
			$pre_date = date('Y-m-d', strtotime("-2 days", strtotime($start_date2_M_D_Y)));
			$w_day = date('D', strtotime($pre_date));
			if ($w_day != 'Sun') {
				$date_for_pharma = $pre_date;
			}
		} else if ($w_day11 != 'Sun') {
			$date_for_pharma = $pre_date;
		} else {

			$date_for_pharma = $pre_date;




		}

		$date_for_pharma;

		$data['pharmaaa'] = $this->patient_model->read_by_phrama_list1_daily($pharma, $date_for_pharma, $section);
		if ((!empty($data['pharmaaa'])) && (empty($fisrt_date))) {
			$data['pharma'] = $this->patient_model->read_by_phrama_list1_daily($pharma, $date_for_pharma, $section);
		} else {
			if (empty($data['pharma'])) {
				$data['pharma'] = $this->patient_model->read_by_phrama_list1($pharma);
			}
		}
		$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';


		$data['department_by_section'] = $section;

		$config = array();
		$config["base_url"] = base_url() . "patients/pharma_date_Despensing/" . $pharma . '/' . $section . '/0/' . $start_date_n . '/' . $end_date_n;
		$config["total_rows"] = $this->patient_model->read_by_phrama_get_count1($section, $start_date, $end_date);
		$config["per_page"] = 35;
		$config["uri_segment"] = 5;

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(8)) ? $this->uri->segment(8) : 0;

		$data["links"] = $this->pagination->create_links();
		$data['patients'] = $this->patient_model->read_by_phrama_date_summary_despencing($section, $start_date_n, $end_date_n, $config["per_page"], $page);
		// print_r($data['patients']); 
		//  $data['patients'] = $this->patient_model->read_by_phrama_date_summary('opd',$start_date,$end_date);
		//  $data['patients'] = $this->patient_model->read_by_phrama_date_summary('opd',$start_date,$end_date);

		// $data['patients'] = array_merge( $data['patients_opd'], $data['patients_ipd']);


		//$data['patients_summary'] = $this->patient_model->read_by_phrama_date_summary('opd',$start_date,$end_date);
		$data['patients_summary'] = $this->patient_model->read_by_phrama_date_summary('opd', $start_date, $end_date);

		//$data['patients_summary'] = array_merge( $data['patients_summary_opd'], $data['patients_summary_ipd']);


		$data['datefrom'] = $start_date2;
		$data['dateto'] = $end_date2;
		$data['department_by'] = 'dpt';
		$data['pharmas'] = $pharma;
		$data['department_by_section'] = 'opd';

		$data['ipd'] = $section;

		$data['content'] = $this->load->view('pharma_Despensing', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function pharma_date_ipd($pharma = '', $section = '', $segment)
	{
		$ses_year = $this->session->userdata['acyear'];
		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date');

		$end_date1 = $this->input->get('end_date', TRUE);


		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$start_date2_M_D = date('-m-d', strtotime($start_date1));
		$start_date2_M_D_Y = $ses_year . $start_date2_M_D;

		$end_date2 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);

		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";

		$pre_date = date('Y-m-d', strtotime("-1 days", strtotime($start_date2_M_D_Y)));

		$w_day11 = date('D', strtotime($pre_date));


		$holiday_pre = $this->db->select("*")

			->from('holiday')
			->where('holiday_date', $pre_date)
			//	->where('status',1)

			->get()

			->row();



		if ($start_date2_M_D_Y == '2018-10-01') {
			$date_for_pharma = $start_date2_M_D_Y;
			$fisrt_date = '2018-10-01';
		} else if ($holiday_pre) {
			$pre_date = date('Y-m-d', strtotime("-2 days", strtotime($start_date2_M_D_Y)));
			$w_day = date('D', strtotime($pre_date));
			if ($w_day != 'Sun') {
				$date_for_pharma = $pre_date;
			}
		} else if ($w_day11 != 'Sun') {
			$date_for_pharma = $pre_date;
		} else {

			$date_for_pharma = $pre_date;




		}

		$date_for_pharma;

		$data['pharmaaa'] = $this->patient_model->read_by_phrama_list1_daily($pharma, $date_for_pharma, $section);
		if ((!empty($data['pharmaaa'])) && (empty($fisrt_date))) {
			$data['pharma'] = $this->patient_model->read_by_phrama_list1_daily($pharma, $date_for_pharma, $section);
		} else {
			if (empty($data['pharma'])) {
				$data['pharma'] = $this->patient_model->read_by_phrama_list1_ipd($pharma);
			}
		}
		$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';


		$data['department_by_section'] = $section;

		$config = array();
		$config["base_url"] = base_url() . "patients/pharma/" . $pharma . '/' . $section;
		$config["total_rows"] = $this->patient_model->read_by_phrama_get_count1($section, $start_date, $end_date);
		$config["per_page"] = 25;
		$config["uri_segment"] = 5;

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

		$data["links"] = $this->pagination->create_links();
		// $data['patients'] = $this->patient_model->read_by_phrama_date($section,$start_date,$end_date,$config["per_page"], $page);
		// $data['patients'] = $this->patient_model->read_by_phrama_date_summary('opd',$start_date,$end_date);
		$data['patients'] = $this->patient_model->read_by_phrama_date_summary('ipd', $start_date, $end_date);

		// $data['patients'] = array_merge( $data['patients_opd'], $data['patients_ipd']);


		//$data['patients_summary'] = $this->patient_model->read_by_phrama_date_summary('opd',$start_date,$end_date);
		$data['patients_summary'] = $this->patient_model->read_by_phrama_date_summary('ipd', $start_date, $end_date);

		//$data['patients_summary'] = array_merge( $data['patients_summary_opd'], $data['patients_summary_ipd']);


		$data['datefrom'] = $start_date2;
		$data['dateto'] = $end_date2;
		$data['department_by'] = 'dpt';
		$data['pharmas'] = $pharma;
		$data['department_by_section'] = 'ipd';

		$data['ipd'] = $section;

		$data['content'] = $this->load->view('pharma_ipd', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}











	public function Ksharsutra()
	{
		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);
		if (empty($end_date1)) {
			$start_date1 = $this->session->userdata['acyear'] . '-01-01';
			$end_date1 = $this->session->userdata['acyear'] . '-01-01';
		}

		$start_date2 = date('Y-m-d', strtotime($start_date1));

		$end_date2 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);

		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;

		$date1 = date_create($start_date2);
		$date2 = date_create($end_date2);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '0';
		}






		if ($section == 'opd') {
			//Array 2
			$data['patients'] = $this->db->select("*")

				->from('patient')

				->join('department', 'department.dprt_id = patient.department_id')

				//->where('dignosis LIKE', '%BHAGANDAR%')
				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)

				->where('create_date LIKE', $year)
				->where('kstatus', '1')

				->where('ipd_opd', $section)

				->get()

				->result();
			//print_r($this->db->last_query());
		} else {

			//Array 2
			$data['patients'] = $this->db->select("*")

				->from('patient_ipd')

				->join('department', 'department.dprt_id = patient_ipd.department_id')

				->where('dignosis LIKE', '%BHAGANDAR%')
				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)

				->where('create_date LIKE', $year)

				->where('ipd_opd', $section)

				->get()

				->result();

			//	$data['patients'] = array_merge($data['patients1'], $data['patients2']);


			$data['gendercount'] = $this->db->select('department.name,patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				// ->where('create_date >=', $start_date)
				//->where('discharge_date LIKE', '0000-00-00')
				// ->or_where('discharge_date LIKE',$end_date1)
				->where("(discharge_date LIKE '0000-00-00')", NULL, FALSE)
				->where('create_date <=', $end_date)
				->where('ipd_opd', $section)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				//->where('create_date >=', $start_date)
				//->where('discharge_date LIKE', '0000-00-00')
				// ->or_where('discharge_date LIKE',$end_date1)
				->where("(discharge_date LIKE '0000-00-00')", NULL, FALSE)
				->where('create_date <=', $end_date)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}



		if ($data == null) {
			$data['content'] = $this->load->view('Ksharsutra', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		} else {
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('Ksharsutra', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}
	}

	public function ot()
	{
		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);
		if (empty($end_date1)) {
			$start_date1 = $this->session->userdata['acyear'] . '-01-01';
			$end_date1 = $this->session->userdata['acyear'] . '-01-01';
		}

		$start_date2 = date('Y-m-d', strtotime($start_date1));

		$end_date2 = date('Y-m-d', strtotime($end_date1));

		$section = 'ipd';

		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$date1 = date_create($start_date2);
		$date2 = date_create($end_date2);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '0';
		}





		//Array 2
		$data['patients'] = $this->db->select("*")

			->from('patient_ipd')

			->join('department', 'department.dprt_id = patient_ipd.department_id')

			->where('dignosis LIKE', '%BHAGANDAR%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)
			->or_where('dignosis LIKE', '%ARSHA%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)
			->or_where('dignosis LIKE', '%PARIKARTIKA%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)
			->or_where('dignosis LIKE', '%MUTRAVRUDDHI%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)
			->or_where('dignosis LIKE', '%VIDRADHI%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)
			->or_where('dignosis LIKE', '%MEDOJ GRANTHI%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)
			->or_where('dignosis LIKE', '%CHALAZION%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)

			->or_where('dignosis LIKE', '%ABSCESS%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)

			->or_where('dignosis LIKE', '%PERIANAL ABSCESS%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)

			->or_where('dignosis LIKE', '%USHTRAGREEV BHAGANDAR%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)

			->or_where('dignosis LIKE', '%PHYMOSIS%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)

			->or_where('dignosis LIKE', '%RAKTARSHA%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)

			->or_where('dignosis LIKE', '%SENTINAL TAG%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)

			->or_where('dignosis LIKE', '%HYDROCELE%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)


			->or_where('dignosis LIKE', '%VATAJ ARSHA%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)

			->or_where('dignosis LIKE', '%NIRUDDHA PRAKASHA%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)

			->or_where('dignosis LIKE', '%PILONIDLE SINUS%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)

			->or_where('dignosis LIKE', '%INTERNAL HAEMORRHOIDS%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)

			->or_where('dignosis LIKE', '%ACUTE FISSURE IN ANO%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)

			->or_where('dignosis LIKE', '%PTERYGIUM%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)


			->or_where('dignosis LIKE', '%TYMPANIC MEMBRANE PERFORATION%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)





			->or_where('dignosis LIKE', '%GILAYU SHOPH%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)

			->get()

			->result();


		//	$data['patients'] = array_merge($data['patients1'], $data['patients2']);



		$data['department_by_section'] = 'ipd';

		if ($data == null) {
			$data['content'] = $this->load->view('OT', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		} else {
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('OT', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}


	}

	public function minor_ot()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);
		if (empty($end_date1)) {
			$start_date1 = $this->session->userdata['acyear'] . '-01-01';
			$end_date1 = $this->session->userdata['acyear'] . '-01-01';
		}

		$start_date2 = date('Y-m-d', strtotime($start_date1));

		$end_date2 = date('Y-m-d', strtotime($end_date1));

		$section = 'ipd';

		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$date1 = date_create($start_date2);
		$date2 = date_create($end_date2);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '0';
		}

		//Array 2
		$data['patients'] = $this->db->select("*")

			->from('patient_ipd')

			->join('department', 'department.dprt_id = patient_ipd.department_id')

			->where('dignosis LIKE', '%VIDRADHI%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)
			->or_where('dignosis LIKE', '%MEDOJ GRANTHI%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)
			->or_where('dignosis LIKE', '%CHALAZION%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)

			->or_where('dignosis LIKE', '%ABSCESS%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)

			->or_where('dignosis LIKE', '%Karnapalibhed%')
			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			->where('ipd_opd', $section)



			->get()

			->result();

		//	$data['patients'] = array_merge($data['patients1'], $data['patients2']);

		$data['department_by_section'] = 'ipd';

		if ($data == null) {
			$data['content'] = $this->load->view('Minor_OT', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		} else {
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('Minor_OT', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}

	}

	public function major_ot()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);
		$department_id = $this->input->get('department_id', TRUE);
		// $data['department_id'] = $department_id;


		if (empty($end_date1)) {
			$start_date1 = $this->session->userdata['acyear'] . '-01-01';
			$end_date1 = $this->session->userdata['acyear'] . '-01-01';
		}

		$start_date3 = date('Y-m-d', strtotime($start_date1));
		$end_date3 = date('Y-m-d', strtotime($end_date1));
		$start_date2 = date('Y-m-d', strtotime("-1 days", strtotime($start_date1)));
		$end_date2 = date('Y-m-d', strtotime("-1 days", strtotime($end_date1)));
		$section = 'ipd';

		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";
		$data['datefrom'] = $start_date3;
		$data['dateto'] = $end_date3;

		$date1 = date_create($start_date2);
		$date2 = date_create($end_date2);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '0';
		}

		$data['department'] = $this->db->select('*')
			->from('department_new')
			->where_in('dprt_id', ['30', '36', '31'])
			->get()
			->result();

		//Array 2
		$data['patients'] = $this->db->select("*")
			->from('patient_ipd')
			->join('department_new', 'department_new.dprt_id = patient_ipd.department_id')

			->where('dignosis LIKE', '%BHAGANDAR%')
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)
			->where('department_id', $department_id)

			->or_where('dignosis LIKE', '%ARSHA%')
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)
			->where('department_id', $department_id)

			->or_where('dignosis LIKE', '%PARIKARTIKA%')
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)
			->where('department_id', $department_id)

			->or_where('dignosis LIKE', '%MUTRAVRUDDHI%')
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)
			->where('department_id', $department_id)


			->or_where('dignosis LIKE', '%PERIANAL ABSCESS%')
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)
			->where('department_id', $department_id)

			->or_where('dignosis LIKE', '%USHTRAGREEV BHAGANDAR%')
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)
			->where('department_id', $department_id)

			->or_where('dignosis LIKE', '%PHYMOSIS%')
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)
			->where('department_id', $department_id)

			->or_where('dignosis LIKE', '%RAKTARSHA%')
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)
			->where('department_id', $department_id)


			->or_where('dignosis LIKE', '%SENTINAL TAG%')
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)
			->where('department_id', $department_id)

			->or_where('dignosis LIKE', '%HYDROCELE%')
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)
			->where('department_id', $department_id)


			->or_where('dignosis LIKE', '%VATAJ ARSHA%')
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)
			->where('department_id', $department_id)

			->or_where('dignosis LIKE', '%NIRUDDHA PRAKASHA%')
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)
			->where('department_id', $department_id)

			->or_where('dignosis LIKE', '%PILONIDLE SINUS%')
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)
			->where('department_id', $department_id)

			->or_where('dignosis LIKE', '%INTERNAL HAEMORRHOIDS%')
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)->where('department_id', $department_id)


			->or_where('dignosis LIKE', '%ACUTE FISSURE IN ANO%')
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)
			->where('department_id', $department_id)

			->or_where('dignosis LIKE', '%TYMPANIC MEMBRANE PERFORATION%')
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)
			->where('department_id', $department_id)


			->or_where('dignosis LIKE', '%GILAYU SHOPH%')
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)->where('department_id', $department_id)



			->or_where('dignosis LIKE', '%RE Cataract%')
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)
			->where('department_id', $department_id)

			->or_where('dignosis LIKE', '%LE Cataract%')
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)
			->where('department_id', $department_id)

			->or_where('dignosis LIKE', '%TRAUMATIC CATARACT%')
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('manual_status =', '1')
			->where('department_id', $department_id)
			->where('ipd_opd', $section)



			->or_where('dignosis LIKE', '%Dacryosystitis%')
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)
			->where('department_id', $department_id)

			->or_where('dignosis LIKE', '%PTERYGIUM%')
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)
			->where('department_id', $department_id)

			->or_where('dignosis LIKE', '%Conjunctival Cyst%')
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)


			->where('department_id', $department_id)


			->get()
			->result();


		$data['department_by_section'] = 'ipd';

		if ($data == null) {
			$data['content'] = $this->load->view('Major_OT', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		} else {
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('Major_OT', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}

	}

	public function getpatientby_garbhini($section)
	{
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dignosis_garbhini($section);
		//$data['patients2'] = $this->patient_model->read_by_dept_investi($section='ipd');
		//$data['patients'] =array_merge($data['patients1'],$data['patients2']);
		$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {
			$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
				->from('patient')
				->join('department', 'patient.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
				->from('patient')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {

			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = '2019';
		$data['dateto'] = '2019';
		$data['department_by'] = 'dpt';
		//   $data['department_id'] = $department_id_decode;
		if ($section == 'opd') {

			$data['content'] = $this->load->view('patient_anc', $data, true);
		} else {
			$data['content'] = $this->load->view('patient_garbhini', $data, true);
		}

		$this->load->view('layout/main_wrapper', $data);
	}

	public function get_physiotherapy_report()
	{
		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);
		$section = $this->input->get('section', TRUE);
		$start_date1 = date('Y-m-d', strtotime($start_date1));
		$end_date1 = date('Y-m-d', strtotime($end_date1));

		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1;
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;

		$patient = $this->db->select('*')
			->from('patient')
			->join('physiohterapy_opd_report_result', 'physiohterapy_opd_report_result.patient_auto_id = patient.id')
			->where('physiohterapy_opd_report_result.create_date >=', $start_date)
			->where('physiohterapy_opd_report_result.create_date <=', $end_date)
			->where('patient.ipd_opd', $section)
			->get()
			->result();
		#  print_r($this->db->last_query());

		$data['patients'] = $patient;
		$data['content'] = $this->load->view('physiotherapy_report', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}

	public function PHYSIOTHERAPY($section = '')
	{
		$data['title'] = display('patient_list');

		$data['date'] = (object) $getData = array(
			'start_date' => date('Y-m-d', strtotime(($this->input->post('start_date', true) != null) ? $this->input->post('start_date', true) : date('Y-m-d'))),
			'end_date' => date('Y-m-d', strtotime(($this->input->post('end_date', true) != null) ? $this->input->post('end_date', true) : date('Y-m-d'))),
		);
		$date_c = date('Y-m-d', strtotime("+ 5 days"));
		$data['patients'] = $this->patient_model->read_by_section($section);
		$data['check_data'] = $this->patient_model->read_by_check_data($section, $date_c);

		//	echo count($data['patients'] );exit;
		$section = $section;


		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'ipd') {
			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				//	->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			date_default_timezone_set('Asia/kolkata');
			$data['department_by_section'] = 'ipd';
			$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 5 days"));
			$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 5 days"));
			$data['gobs'] = 'gobs';

			$data['content'] = $this->load->view('patient', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		} else {
			$data['gendercount'] = $this->db->select('department.name,  patient.sex, COUNT( patient.sex) as Gender, COUNT( patient.yearly_reg_no) as New, COUNT( patient.old_reg_no) as old')
				->from('patient')
				->join('department', ' patient.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name,  patient.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT( patient.sex) as totalGender, COUNT( patient.yearly_reg_no) as totalNew, COUNT( patient.old_reg_no) as totalold')
				->from('patient')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			date_default_timezone_set('Asia/kolkata');
			$data['department_by_section'] = 'opd';
			$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 5 days"));
			$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 5 days"));


			$data['content'] = $this->load->view('PHYSIOTHERAPY', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}
	}

	public function patient_by_date_p()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);


		$start_date2 = date('Y-m-d', strtotime($start_date1));

		$end_date2 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);

		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";
		// $start_date=$start_date1." 00:00:00";
		// $end_date=$end_date1." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$date1 = date_create($start_date2);
		$date2 = date_create($end_date2);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '0';
		}

		//echo $section;

		if ($section == 'opd') {
			$data['patients'] = $this->db->select("*")

				->from('patient')

				->join('department', 'department.dprt_id =  patient.department_id')

				->where('ipd_opd', $section)

				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)

				->where('create_date LIKE', $year)

				//	->order_by("id", "DESC")

				->get()

				->result();

			// echo count($data['patients']); exit;

			$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
				->from('patient')
				->join('department', ' patient.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('create_date >=', $start_date)
				->where('create_date <=', $end_date)
				->where('ipd_opd', $section)
				->group_by('department.name, patient.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT( patient.sex) as totalGender, COUNT( patient.yearly_reg_no) as totalNew, COUNT( patient.old_reg_no) as totalold')
				->from('patient')
				->where('create_date LIKE', $year)
				->where('create_date >=', $start_date)
				->where('create_date <=', $end_date)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {


			$data['patients1'] = $this->db->select("*")

				->from('patient_ipd')

				->join('department', 'department.dprt_id = patient_ipd.department_id')

				->where('discharge_date >=', $start_date_f)

				->where('create_date <=', $start_date_f)

				->where('ipd_opd', 'ipd')
				->or_where('discharge_date', $start_date)

				//	->where('create_date LIKE', $year)

				->get()

				->result();



			//Array 2
			$data['patients2'] = $this->db->select("*")

				->from('patient_ipd')

				->join('department', 'department.dprt_id = patient_ipd.department_id')

				->where('create_date <=', $start_date_f)

				->where('discharge_date LIKE', '%0000-00-00%')

				->where('ipd_opd', 'ipd')

				->get()

				->result();


			$data['patients'] = array_merge($data['patients1'], $data['patients2']);



			$data['gendercount'] = $this->db->select('department.name,patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				// ->where('create_date >=', $start_date)
				//->where('discharge_date LIKE', '0000-00-00')
				// ->or_where('discharge_date LIKE',$end_date1)
				->where("(discharge_date LIKE '0000-00-00')", NULL, FALSE)
				->where('create_date <=', $end_date)
				->where('ipd_opd', $section)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				//->where('create_date >=', $start_date)
				//->where('discharge_date LIKE', '0000-00-00')
				// ->or_where('discharge_date LIKE',$end_date1)
				->where("(discharge_date LIKE '0000-00-00')", NULL, FALSE)
				->where('create_date <=', $end_date)
				->where('ipd_opd', $section)
				->get()
				->result();

			$data['department_by_section'] = 'ipd';
		}

		//$data['patients'] = $this->patient_model->read_by_section_date($getData);
		if ($data == null) {
			$data['content'] = $this->load->view('PHYSIOTHERAPY', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		} else {
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('PHYSIOTHERAPY', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}


	}

	public function pharma($pharma = '', $section = '')
	{

		$start_date2 = date('Y-m-d', strtotime('2019-01-12'));
		$end_date2 = date('Y-m-d', strtotime('2019-01-12'));
		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";

		$data['title'] = display('patient_Pharma');
		$data['patients'] = $this->patient_model->read_by_phrama($section);
		$data['patients_summary'] = $this->patient_model->read_by_phrama_date_summary($section, $start_date, $end_date);
		$data['pharma'] = $this->patient_model->read_by_phrama_list($pharma);
		$section = $section;

		$data['fisrt_hide'] = 1;

		$year = '%' . $this->session->userdata['acyear'] . '%';


		$data['department_by_section'] = $section;


		$data['datefrom'] = $start_date2;
		$data['dateto'] = $start_date2;
		$data['department_by'] = 'dpt';
		$data['pharmas'] = $pharma;
		$data['start'] = '1';

		$config = array();
		$config["base_url"] = base_url() . "patients/pharma/" . $pharma . '/' . $section;
		$config["total_rows"] = $this->patient_model->read_by_phrama_get_count1($section, $start_date, $end_date);
		$config["per_page"] = 25;
		$config["uri_segment"] = 5;




		$this->pagination->initialize($config);

		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

		$data["links"] = $this->pagination->create_links();

		// $data['patients'] = $this->patient_model->read_by_phrama_date($section,$start_date,$end_date,$config["per_page"], $page);

		$data['content'] = $this->load->view('pharma', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function pharma_Month($pharma = '', $section = '')
	{

		$start_date2 = date('2020-01-01');
		$end_date2 = date('2020-01-31');
		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";
		$end_date_close = $end_date2 . " 00:00:00";

		$data['title'] = display('patient_Pharma');
		$data['patients'] = $this->patient_model->read_by_phrama($section);
		$data['patients__date'] = $this->patient_model->read_by_phrama_date_summary_month($section, $start_date, $end_date);

		$data['pharma'] = $this->patient_model->read_by_phrama_date_summary_month_name($section, $start_date, $end_date);

		$data['pharma_req'] = $this->patient_model->pharma_req($section, $start_date, $end_date);
		$data['pharma_close'] = $this->patient_model->pharma_close($section, $end_date_close, $end_date);
		// print_r($data['pharma_req']);
		$section = $section;

		$data['fisrt_hide'] = 1;

		$year = '%' . $this->session->userdata['acyear'] . '%';


		$data['department_by_section'] = $section;


		$data['datefrom'] = $start_date2;
		$data['dateto'] = $end_date2;
		$data['department_by'] = 'dpt';
		$data['pharmas'] = $pharma;
		$data['start'] = '1';

		$config = array();
		$config["base_url"] = base_url() . "patients/pharma/" . $pharma . '/' . $section;
		$config["total_rows"] = $this->patient_model->read_by_phrama_get_count($section);
		$config["per_page"] = 25;
		$config["uri_segment"] = 5;




		$this->pagination->initialize($config);

		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

		$data["links"] = $this->pagination->create_links();

		$data['patients'] = $this->patient_model->read_by_phrama($section, $config["per_page"], $page);

		$data['content'] = $this->load->view('pharma_Month', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function pharma_year($pharma = '', $section = '')
	{

		$start_date2 = date('2020-01-01');
		$end_date2 = date('2020-01-31');
		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";
		$end_date_close = $end_date2 . " 00:00:00";

		$data['title'] = display('patient_Pharma');
		$data['patients'] = $this->patient_model->read_by_phrama($section);
		$data['patients__date'] = $this->patient_model->read_by_phrama_date_summary_year($section, $start_date, $end_date);

		$data['pharma'] = $this->patient_model->read_by_phrama_date_summary_month_name($section, $start_date, $end_date);

		$data['pharma_req'] = $this->patient_model->pharma_req($section, $start_date, $end_date);
		$data['pharma_close'] = $this->patient_model->pharma_close($section, $end_date_close, $end_date);
		// print_r($data['pharma_req']);
		$section = $section;

		$data['fisrt_hide'] = 1;

		$year = '%' . $this->session->userdata['acyear'] . '%';


		$data['department_by_section'] = $section;


		$data['datefrom'] = $start_date2;
		$data['dateto'] = $end_date2;
		$data['department_by'] = 'dpt';
		$data['pharmas'] = $pharma;
		$data['start'] = '1';

		$config = array();
		$config["base_url"] = base_url() . "patients/pharma/" . $pharma . '/' . $section;
		$config["total_rows"] = $this->patient_model->read_by_phrama_get_count($section);
		$config["per_page"] = 25;
		$config["uri_segment"] = 5;




		$this->pagination->initialize($config);

		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

		$data["links"] = $this->pagination->create_links();

		$data['patients'] = $this->patient_model->read_by_phrama($section, $config["per_page"], $page);

		$data['content'] = $this->load->view('pharma_year', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function pharma_ipd($pharma = '', $section = '')
	{

		$start_date2 = date('Y-m-d');
		$end_date2 = date('Y-m-d');
		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";

		$data['title'] = display('patient_Pharma');
		$data['patients'] = $this->patient_model->read_by_phrama($section);
		$data['patients_summary'] = $this->patient_model->read_by_phrama_date_summary($section, $start_date, $end_date);
		$data['pharma'] = $this->patient_model->read_by_phrama_list($pharma);
		$section = $section;

		$data['fisrt_hide'] = 1;

		$year = '%' . $this->session->userdata['acyear'] . '%';


		$data['department_by_section'] = $section;


		$data['datefrom'] = $start_date2;
		$data['dateto'] = $start_date2;
		$data['department_by'] = 'dpt';
		$data['pharmas'] = $pharma;
		$data['start'] = '1';

		$config = array();
		$config["base_url"] = base_url() . "patients/pharma/" . $pharma . '/' . $section;
		$config["total_rows"] = $this->patient_model->read_by_phrama_get_count($section);
		$config["per_page"] = 25;
		$config["uri_segment"] = 5;




		$this->pagination->initialize($config);

		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

		$data["links"] = $this->pagination->create_links();

		$data['patients'] = $this->patient_model->read_by_phrama($section, $config["per_page"], $page);

		$data['content'] = $this->load->view('pharma_ipd', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function getMukh_dant_data_sky1($department_id = '', $section = '')
	{

		$year = $this->session->userdata['acyear'];
		$department_id_decode = rawurldecode($department_id);
		$start_date1 = date('Y-m-d', strtotime('01-01-' . $year));
		$end_date1 = date('Y-m-d', strtotime('31-12-' . $year));

		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";

		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id_date($department_id_decode, $section, $start_date, $end_date);
		$data['section'] = $section;

		$data['content'] = $this->load->view('netra_dant_month_report_sky', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function getMukh_dant_data_sky($department_id = '', $section = '')
	{

		$year = $this->session->userdata['acyear'];
		$department_id_decode = rawurldecode($department_id);
		$start_date1 = date('Y-m-d', strtotime('01-01-' . $year));
		$end_date1 = date('Y-m-d', strtotime('31-12-' . $year));

		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";

		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id_date($department_id_decode, $section, $start_date, $end_date);
		$data['section'] = $section;

		$data['content'] = $this->load->view('netra_dant_month_report_sky', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}


	public function getMukh_dant_data_sky_static($department_id = '', $section = '')
	{

		$year = $this->session->userdata['acyear'];
		$department_id_decode = rawurldecode($department_id);
		$start_date1 = date('Y-m-d', strtotime('01-01-' . $year));
		$end_date1 = date('Y-m-d', strtotime('31-12-' . $year));

		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";

		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id_date($department_id_decode, $section, $start_date, $end_date);
		$data['section'] = $section;

		$data['content'] = $this->load->view('netra_dant_month_report_sky_static', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}



	public function getpatientbydepartment_sky($department_id = '', $section = '')
	{

		$department_id_decode = rawurldecode($department_id);
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id($department_id_decode, $section);

		$section = $section;
		$data['section'] = $section;
		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {
			$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
				->from('patient')
				->join('department', 'patient.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
				->from('patient')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {

			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 5 days"));
		$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 5 days"));
		$data['department_by'] = 'dpt';
		$data['department_id'] = $department_id_decode;

		$data['content'] = $this->load->view('patient_sky', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}


	public function getpatientbydepartment_sky1($department_id = '', $section = '')
	{

		$department_id_decode = rawurldecode($department_id);
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id($department_id_decode, $section);
		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {
			$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
				->from('patient')
				->join('department', 'patient.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
				->from('patient')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {

			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 5 days"));
		$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 5 days"));
		$data['department_by'] = 'dpt';
		$data['department_id'] = $department_id_decode;

		$data['content'] = $this->load->view('patient_sky1', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}


	public function getpatientbydepartment_karma($section = '')
	{

		//$department_id_decode = rawurldecode($department_id);
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id_karma($section);

		$section = $section;
		$data['section'] = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {
			$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
				->from('patient')
				->join('department', 'patient.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
				->from('patient')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {

			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days")) . " 00:00:00";
		$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days")) . " 23:59:00";
		$data['department_by'] = 'dpt';
		$data['department_id'] = '';
		//$data['swat_id'] = '28';
		$data['content'] = $this->load->view('patient_karma', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}


	public function getpatientbydepartment_karma_other($section = '')
	{

		//$department_id_decode = rawurldecode($department_id);
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id_karma($section);

		$section = $section;
		$data['section'] = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {
			$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
				->from('patient')
				->join('department', 'patient.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
				->from('patient')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {

			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days")) . " 00:00:00";
		$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days")) . " 23:59:00";
		$data['department_by'] = 'dpt';
		$data['department_id'] = '';
		//$data['swat_id'] = '28';
		//$data['section']=$section;
		$data['content'] = $this->load->view('patient_karma_other', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}



	public function getpatientby_investigation($section = '')
	{


		$data['title'] = display('patient_list');
		/*	$data['patients1'] = $this->patient_model->read_by_dept_investi($section='opd');
			$data['patients2'] = $this->patient_model->read_by_dept_investi($section='ipd');

		   $data['patients'] =array_merge($data['patients1'],$data['patients2']);
					//print_r($data['patients'] ); exit;*/
		$data['patients'] = $this->patient_model->read_by_dept_investi($section);
		$section = $section;
		$data['section'] = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {
			$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
				->from('patient')
				->join('department', 'patient.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
				->from('patient')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {

			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
		$data['department_by'] = 'dpt';

		$data['section'] = $section;
		//   $data['department_id'] = $department_id_decode;

		$data['content'] = $this->load->view('patient_investi', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function getpatientby_investigation_testwise($section = '')
	{


		$data['title'] = display('patient_list');

		//$data['patients1'] = $this->patient_model->read_by_dept_investi($section='opd');
		//$data['patients2'] = $this->patient_model->read_by_dept_investi($section='ipd');

		$data['patients'] = $this->patient_model->read_by_dept_investi($section);
		$section = $section;
		$data['section'] = $section;

		// $data['section']=$section;
		// $data['patients'] =array_merge($data['patients1'],$data['patients2']);

		//$data['patients'] = $this->patient_model->read_by_dept_investi($section);
		//$data['section']=$section;

		//print_r($data['patients'] ); exit;

		//$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {
			$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
				->from('patient')
				->join('department', 'patient.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
				->from('patient')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {

			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
		$data['department_by'] = 'dpt';

		//$data['section']=$section;
		// $data['department_id'] = $department_id_decode;

		$data['content'] = $this->load->view('patient_investi_testwise', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function getpatientby_garbhini11($section = '')
	{


		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dignosis_garbhini($section = 'opd');
		//$data['patients2'] = $this->patient_model->read_by_dept_investi($section='ipd');
		//$data['patients'] =array_merge($data['patients1'],$data['patients2']);
		$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {
			$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
				->from('patient')
				->join('department', 'patient.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
				->from('patient')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {

			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = '2019';
		$data['dateto'] = '2019';
		$data['department_by'] = 'dpt';
		//   $data['department_id'] = $department_id_decode;

		$data['content'] = $this->load->view('patient_garbhini', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function getpatientbydepartment_gob()
	{
		$section = 'ipd';
		$start_date1 = date('Y-m-d');
		$end_date1 = $start_date1;

		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id_gob($section, $start_date, $end_date);

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$section = $section;
		$data['section'] = $section;

		$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
			->from('patient_ipd')
			->join('department', 'patient_ipd.department_id = department.dprt_id')
			->where('create_date LIKE', $year)
			->where('ipd_opd', $section)
			->where('discharge_date LIKE', '0000-00-00')
			->where('create_date <=', $end_date)
			->group_by('department.name, patient_ipd.sex')
			->get()
			->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
			->from('patient_ipd')
			->where('create_date LIKE', $year)
			->where('ipd_opd', $section)
			->where('discharge_date LIKE', '0000-00-00')
			->where('create_date <=', $end_date)
			->get()
			->result();
		$data['department_by_section'] = 'ipd';


		$data['department_by'] = 'dpt';
		$data['department_id'] = '';
		$data['flag'] = '1';
		$data['gob'] = 'gob';
		$data['content'] = $this->load->view('god_ipd_patient', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}


	public function getpatientbydepartment_gob1()
	{
		$section = 'ipd';
		//$department_id_decode = rawurldecode($department_id);
		$start_date1 = date('Y-m-d');

		//$end_date1   = date('Y-m-d');

		$end_date1 = $start_date1;

		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id_gob($section, $start_date, $end_date);

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$section = $section;
		$data['section'] = $section;

		$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
			->from('patient_ipd')
			->join('department', 'patient_ipd.department_id = department.dprt_id')
			->where('create_date LIKE', $year)
			//->where('department_id', $id)
			->where('ipd_opd', $section)
			->where('discharge_date LIKE', '0000-00-00')
			//	->where('create_date >=', $end_date)

			->where('create_date <=', $end_date)
			->group_by('department.name, patient_ipd.sex')
			->get()
			->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
			->from('patient_ipd')
			->where('create_date LIKE', $year)
			//->where('department_id', $id)
			->where('ipd_opd', $section)
			->where('discharge_date LIKE', '0000-00-00')
			//->where('create_date >=', $end_date)

			->where('create_date <=', $end_date)
			->get()
			->result();
		$data['department_by_section'] = 'ipd';


		$data['department_by'] = 'dpt';
		$data['department_id'] = '';
		$data['flag'] = '1';
		$data['gob'] = 'gob';
		$data['content'] = $this->load->view('patientgob_new', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function getpatientbydepartment_gob_dept($id = '', $section = '')
	{
		$section = 'ipd';
		$department_id_decode = rawurldecode($id);
		$start_date1 = date('Y-m-d');

		$end_date1 = date('Y-m-d');

		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_gob_dept($id, $section, $start_date, $end_date);

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$section = $section;
		$data['section'] = $section;

		$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
			->from('patient_ipd')
			->join('department', 'patient_ipd.department_id = department.dprt_id')
			->where('create_date LIKE', $year)
			->where('department_id', $id)
			->where('ipd_opd', $section)
			->where('discharge_date LIKE', '%0000-00-00%')
			//	->where('create_date >=', $end_date)

			->where('create_date <=', $end_date)
			->group_by('department.name, patient_ipd.sex')
			->get()
			->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
			->from('patient_ipd')
			->where('create_date LIKE', $year)
			->where('department_id', $id)
			->where('ipd_opd', $section)
			->where('discharge_date LIKE', '0000-00-00')
			//->where('create_date >=', $end_date)

			->where('create_date <=', $end_date)
			->get()
			->result();
		$data['department_by_section'] = 'ipd';


		$data['department_by'] = 'dpt';
		$data['department_id'] = '';
		$data['dept_id'] = $id;
		$data['flag'] = '1';
		$data['gob'] = 'gob';
		$data['content'] = $this->load->view('god_ipd_patient', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}



	public function getpatientbydepartment_gob_date()
	{

		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $start_date1;
		$id = $this->input->get('dept_id', TRUE);

		$start_date1 = date('Y-m-d', strtotime($start_date1));
		$end_date1 = date('Y-m-d', strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
		$data['section'] = $section;

		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['title'] = display('patient_list');
		$year = '%' . $this->session->userdata['acyear'] . '%';
		if ($id) {

			$data['patients'] = $this->patient_model->read_by_gob_dept_date($id, $section, $start_date, $end_date);
			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '%0000-00-00%')
				->where('create_date <=', $end_date)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '0000-00-00')
				->where('create_date <=', $end_date)
				->get()
				->result();
			$data['dept_id'] = $id;
		} else {
			$data['patients'] = $this->patient_model->read_by_dept_id_gob($section, $start_date, $end_date);

		}

		$section = $section;
		$year = '%' . $this->session->userdata['acyear'] . '%';
		$data['department_by'] = 'dpt';
		$data['department_by_section'] = 'ipd';
		$data['flag'] = '1';
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
		$data['gob'] = 'gob';

		$data['content'] = $this->load->view('god_ipd_patient', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function getpatientbydepartment_gob_date1()
	{
		// $section='ipd';
		//$department_id_decode = rawurldecode($department_id);

		$start_date1 = $this->input->get('start_date', TRUE);

		//$end_date1   = $this->input->get('end_date', TRUE);
		$end_date1 = $start_date1;
		$id = $this->input->get('dept_id', TRUE);


		$start_date1 = date('Y-m-d', strtotime($start_date1));

		$end_date1 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);
		$data['section'] = $section;

		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['title'] = display('patient_list');
		$year = '%' . $this->session->userdata['acyear'] . '%';
		if ($id) {

			$data['patients'] = $this->patient_model->read_by_gob_dept_date($id, $section, $start_date, $end_date);

			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '%0000-00-00%')
				//	->where('create_date >=', $end_date)

				->where('create_date <=', $end_date)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '0000-00-00')
				//->where('create_date >=', $end_date)

				->where('create_date <=', $end_date)
				->get()
				->result();
			$data['dept_id'] = $id;
		} else {
			$data['patients'] = $this->patient_model->read_by_dept_id_gob($section, $start_date, $end_date);

		}

		$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';



		$data['department_by'] = 'dpt';
		$data['department_by_section'] = 'ipd';
		$data['flag'] = '1';
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
		$data['gob'] = 'gob';

		$data['content'] = $this->load->view('patientgob_new', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function getrecordnysection($section = '')
	{
		$data['title'] = display('patient_list');

		$data['date'] = (object) $getData = array(
			'start_date' => date('Y-m-d', strtotime(($this->input->post('start_date', true) != null) ? $this->input->post('start_date', true) : date('Y-m-d'))),
			//'end_date' => date('Y-m-d', strtotime(($this->input->post('end_date',true) != null)? $this->input->post('end_date',true): date('Y-m-d'))),
			'end_date' => date('Y-m-d', strtotime(($this->input->post('start_date', true) != null) ? $this->input->post('start_date', true) : date('Y-m-d'))),
		);
		$date_c = date('Y-m-d', strtotime("+ 5 days"));
		$data['patients'] = $this->patient_model->read_by_section($section);
		$data['check_data'] = $this->patient_model->read_by_check_data($section, $date_c);

		//	echo count($data['patients'] );exit;
		$section = $section;
		$data['section'] = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'ipd') {
			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				//	->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			date_default_timezone_set('Asia/kolkata');
			$data['department_by_section'] = 'ipd';
			$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
			$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
			$data['gobs'] = 'gobs';

			$data['content'] = $this->load->view('patient', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		} else {
			$data['gendercount'] = $this->db->select('department.name,  patient.sex, COUNT( patient.sex) as Gender, COUNT( patient.yearly_reg_no) as New, COUNT( patient.old_reg_no) as old')
				->from('patient')
				->join('department', ' patient.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name,  patient.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT( patient.sex) as totalGender, COUNT( patient.yearly_reg_no) as totalNew, COUNT( patient.old_reg_no) as totalold')
				->from('patient')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			date_default_timezone_set('Asia/kolkata');
			$data['department_by_section'] = 'opd';
			$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
			$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));


			$data['content'] = $this->load->view('patient', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}
	}

	public function getbedlist($section = '')
	{
		$data['title'] = 'Assigned Bed List';

		$data['date'] = (object) $getData = array(
			'start_date' => date('Y-m-d', strtotime(($this->input->post('start_date', true) != null) ? $this->input->post('start_date', true) : date('Y-m-d'))),
			'end_date' => date('Y-m-d', strtotime(($this->input->post('end_date', true) != null) ? $this->input->post('end_date', true) : date('Y-m-d'))),
		);

		$data['patients'] = $this->patient_model->read_by_bed($section);

		//	echo count($data['patients'] );exit;
		$section = $section;


		$year = '%' . $this->session->userdata['acyear'] . '%';




		$data['datefrom'] = '2019';
		$data['dateto'] = '2019';


		$data['content'] = $this->load->view('assign_bed_list', $data, true);
		$this->load->view('layout/main_wrapper', $data);


	}

	public function getbedlist_date($section = '')
	{
		$data['title'] = 'Assigned Bed List';

		$data['date'] = (object) $getData = array(
			'start_date' => date('Y-m-d', strtotime(($this->input->post('start_date', true) != null) ? $this->input->post('start_date', true) : date('Y-m-d'))),
			'end_date' => date('Y-m-d', strtotime(($this->input->post('end_date', true) != null) ? $this->input->post('end_date', true) : date('Y-m-d'))),
		);

		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);


		$start_date1 = date('Y-m-d', strtotime($start_date1));

		$end_date1 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);


		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;


		$data['patients'] = $this->patient_model->read_by_bed_date($section, $start_date, $end_date);

		//	echo count($data['patients'] );exit;
		$section = $section;


		$year = '%' . $this->session->userdata['acyear'] . '%';




		$data['datefrom'] = '2019';
		$data['dateto'] = '2019';


		$data['content'] = $this->load->view('assign_bed_list', $data, true);
		$this->load->view('layout/main_wrapper', $data);


	}

	public function delete($patient_id = null)
	{
		if ($this->patient_model->delete($patient_id)) {
			#set success message
			$this->session->set_flashdata('message', display('delete_successfully'));
			redirect('patientList/opd');
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}

	}

	public function delete_ipd($patient_id = null)
	{
		if ($this->patient_model->delete_ipd($patient_id)) {
			#set success message
			$this->session->set_flashdata('message', display('delete_successfully'));
			redirect('patientList/opd');
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}

	}

	public function pdfdownload()
	{
		//PDF Download 
		if (isset($_POST['btn_excel_download'])) {
			$arr_user_ids = $this->input->post('checkbox');
			$delimiter = ",";
			$newline = "\r\n";
			$this->load->dbutil();
			$this->load->helper('file');
			$this->load->helper('download');
			$filename = 'Patient' . date('YmdHis') . ".csv";

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

	public function randStrGen($mode = null, $len = null)
	{
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

		if ($mode == 1):
			$chars = "0123456789";
		elseif ($mode == 2):
			$chars = "0123456789";
		elseif ($mode == 3):
			$chars = "0123456789";
		elseif ($mode == 4):
			$chars = "0123456789";
		endif;

		$charArray = str_split($chars);
		for ($i = 0; $i < $len; $i++) {
			$randItem = array_rand($charArray);
			$result .= "" . $charArray[$randItem];
		}
		return $result;
	}

	public function randStrGenforday()
	{
		$result = "";

		$currentdate = date('d/m/y');
		print_r($currentdate);
		die();

		if ($mode == 1):
			$chars = "0123456789";
		elseif ($mode == 2):
			$chars = "0123456789";
		elseif ($mode == 3):
			$chars = "0123456789";
		elseif ($mode == 4):
			$chars = "0123456789";
		endif;

		$charArray = str_split($chars);
		for ($i = 0; $i < $len; $i++) {
			$randItem = array_rand($charArray);
			$result .= "" . $charArray[$randItem];
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
		$data['content'] = $this->load->view('document', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function document_form()
	{
		$data['title'] = display('add_document');
		/*----------VALIDATION RULES----------*/
		$this->form_validation->set_rules('patient_id', display('patient_id'), 'required|max_length[30]');
		$this->form_validation->set_rules('doctor_name', display('doctor_id'), 'max_length[11]');
		$this->form_validation->set_rules('description', display('description'), 'trim');
		$this->form_validation->set_rules('hidden_attach_file', display('attach_file'), 'required|max_length[255]');
		/*-------------STORE DATA------------*/
		$urole = $this->session->userdata('user_role');
		$data['document'] = (object) $postData = array(
			'patient_id' => $this->input->post('patient_id'),
			'doctor_id' => $this->input->post('doctor_id'),
			'description' => $this->input->post('description'),
			'hidden_attach_file' => $this->input->post('hidden_attach_file'),
			'date' => date('Y-m-d'),
			'upload_by' => (($urole == 10) ? 0 : $this->session->userdata('user_id'))
		);

		/*-----------CREATE A NEW RECORD-----------*/
		if ($this->form_validation->run() === true) {

			if ($this->document_model->create($postData)) {
				#set success message
				$this->session->set_flashdata('message', display('save_successfully'));
			} else {
				#set exception message
				$this->session->set_flashdata('exception', display('please_try_again'));
			}
			redirect('patient/document_form');
		} else {
			$data['doctor_list'] = $this->doctor_model->doctor_list();
			$data['content'] = $this->load->view('document_form', $data, true);
			$this->load->view('layout/main_wrapper', $data);
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
			$email = $this->session->userdata('email');
			$filename = strstr($email, '@', true) . "_" . $filename;
			$filename = strtolower($filename);
			/*-----------------------------*/

			$config['upload_path'] = FCPATH . './assets/attachments/';
			// $config['allowed_types'] = 'csv|pdf|ai|xls|ppt|pptx|gz|gzip|tar|zip|rar|mp3|wav|bmp|gif|jpg|jpeg|jpe|png|txt|text|log|rtx|rtf|xsl|mpeg|mpg|mov|avi|doc|docx|dot|dotx|xlsx|xl|word|mp4|mpa|flv|webm|7zip|wma|svg';
			$config['allowed_types'] = '*';
			$config['max_size'] = 0;
			$config['max_width'] = 0;
			$config['max_height'] = 0;
			$config['file_ext_tolower'] = true;
			$config['file_name'] = $filename;
			$config['overwrite'] = false;

			$this->load->library('upload', $config);

			$name = 'attach_file';
			if (!$this->upload->do_upload($name)) {
				$data['exception'] = $this->upload->display_errors();
				$data['status'] = false;
				echo json_encode($data);
			} else {
				$upload = $this->upload->data();
				$data['message'] = display('upload_successfully');
				$data['filepath'] = './assets/attachments/' . $upload['file_name'];
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
				->where('department_id', $department_id)
				->where('user_role', 2)
				->where('status', 1)
				->get();

			$option = "<option value=\"\">" . display('select_option') . "</option>";
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

	public function import111111()
	{
		$configUpload['upload_path'] = FCPATH . '/'; //Upload Excel
		$configUpload['allowed_types'] = 'xls|xlsx|csv';
		$configUpload['max_size'] = '500000000000';
		$this->load->library('upload', $configUpload);
		$this->upload->do_upload('userfile');  //	
		$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
		$file_name = $upload_data['file_name']; //uploded file name
		$extension = $upload_data['file_ext'];    // uploded file extension


		//$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 	  
		//Set to read only
		$objReader->setReadDataOnly(true);
		//Load excel file
		$objPHPExcel = $objReader->load(FCPATH . $file_name);
		$totalrows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
		$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);

		//loop from first data untill last data
		for ($i = 2; $i <= $totalrows; $i++) {

			$dia = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue();
			$deprt = $objWorksheet->getCellByColumnAndRow(1, $i)->getValue();
			$ipd_opd = $objWorksheet->getCellByColumnAndRow(2, $i)->getValue();

			$RX1 = $objWorksheet->getCellByColumnAndRow(3, $i)->getValue();
			$RX2 = $objWorksheet->getCellByColumnAndRow(4, $i)->getValue();
			$RX3 = $objWorksheet->getCellByColumnAndRow(5, $i)->getValue();

			$SNEHAN = $objWorksheet->getCellByColumnAndRow(6, $i)->getValue();
			$SWEDAN = $objWorksheet->getCellByColumnAndRow(7, $i)->getValue();
			$VAMAN = $objWorksheet->getCellByColumnAndRow(8, $i)->getValue();
			$VIRECHAN = $objWorksheet->getCellByColumnAndRow(9, $i)->getValue();

			$BASTI = $objWorksheet->getCellByColumnAndRow(10, $i)->getValue();
			$NASYA = $objWorksheet->getCellByColumnAndRow(11, $i)->getValue();
			$RAKTAMOKSHAN = $objWorksheet->getCellByColumnAndRow(12, $i)->getValue();
			$SHIRODHARA_SHIROBASTI = $objWorksheet->getCellByColumnAndRow(13, $i)->getValue();
			$OTHER = $objWorksheet->getCellByColumnAndRow(14, $i)->getValue();
			$skya = $objWorksheet->getCellByColumnAndRow(15, $i)->getValue();
			$skarma = $objWorksheet->getCellByColumnAndRow(16, $i)->getValue();
			$vkarma = $objWorksheet->getCellByColumnAndRow(17, $i)->getValue();
			$KARMA = $objWorksheet->getCellByColumnAndRow(18, $i)->getValue();
			$PK1 = $objWorksheet->getCellByColumnAndRow(19, $i)->getValue();
			$PK2 = $objWorksheet->getCellByColumnAndRow(20, $i)->getValue();
			$SWA1 = $objWorksheet->getCellByColumnAndRow(21, $i)->getValue();
			$SWA2 = $objWorksheet->getCellByColumnAndRow(22, $i)->getValue();
			$HEMATOLOGICAL = $objWorksheet->getCellByColumnAndRow(23, $i)->getValue();
			$SEROLOGYCAL = $objWorksheet->getCellByColumnAndRow(24, $i)->getValue();
			$BIOCHEMICAL = $objWorksheet->getCellByColumnAndRow(25, $i)->getValue();
			$MICROBIOLOGICAL = $objWorksheet->getCellByColumnAndRow(26, $i)->getValue();

			$PATHO = $objWorksheet->getCellByColumnAndRow(27, $i)->getValue();
			$PATHO2 = $objWorksheet->getCellByColumnAndRow(28, $i)->getValue();
			$PATHO3 = $objWorksheet->getCellByColumnAndRow(29, $i)->getValue();

			$X_RAY = $objWorksheet->getCellByColumnAndRow(30, $i)->getValue();
			$ECG = $objWorksheet->getCellByColumnAndRow(31, $i)->getValue();
			$USG = $objWorksheet->getCellByColumnAndRow(32, $i)->getValue();
			$naration = $objWorksheet->getCellByColumnAndRow(33, $i)->getValue();

			$symptoms = $objWorksheet->getCellByColumnAndRow(34, $i)->getValue();
			$sym1 = $objWorksheet->getCellByColumnAndRow(35, $i)->getValue();
			$sym2 = $objWorksheet->getCellByColumnAndRow(36, $i)->getValue();
			$sym3 = $objWorksheet->getCellByColumnAndRow(37, $i)->getValue();

			//	$ipd_no9 = $objWorksheet->getCellByColumnAndRow(19, $i)->getValue();		
			//	$discharge_date = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(15, $i)->getValue()));
			//	$discharge_date = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(15, $i)->getValue()));

			//	$date1=date('Y-m-d');
/*if($date1==$discharge_date){
	
	$discharge_date="0000-00-00";
}else{
	
	$discharge_date=date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(15, $i)->getValue()));
}*/


			$data['patient'] = (object) $postData = [
				'dignosis' => $dia,
				'department_id' => $deprt,
				'ipd_opd' => $ipd_opd,
				'RX1' => $RX1,
				'RX2' => $RX2,
				'RX3' => $RX3,


				'SNEHAN' => $SNEHAN,
				'SWEDAN' => $SWEDAN,
				'VAMAN' => $VAMAN,
				'VIRECHAN' => $VIRECHAN,
				'BASTI' => $BASTI,
				'NASYA' => $NASYA,

				'RAKTAMOKSHAN' => $RAKTAMOKSHAN,

				'SHIRODHARA_SHIROBASTI' => $SHIRODHARA_SHIROBASTI,
				'OTHER' => $OTHER,
				'skya' => $skya,
				'skarma' => $skarma,
				'vkarma' => $vkarma,
				'KARMA' => $KARMA,
				'PK1' => $PK1,
				'PK2' => $PK2,
				'SWA1' => $SWA1,
				'SWA2' => $SWA2,
				'HEMATOLOGICAL' => $HEMATOLOGICAL,
				'SEROLOGYCAL' => $SEROLOGYCAL,
				'BIOCHEMICAL' => $BIOCHEMICAL,
				'MICROBIOLOGICAL' => $MICROBIOLOGICAL,
				'PATHO' => $PATHO,
				'PATHO2' => $PATHO2,
				'PATHO3' => $PATHO3,

				'X_RAY' => $X_RAY,
				'ECG' => $ECG,
				'USG' => $USG,
				'naration' => $naration,

				'symptoms' => $symptoms,
				'sym1' => $sym1,
				'sym2' => $sym1,
				'sym3' => $sym1



			];

			$this->patient_model->create($postData);
		}
		unlink('/' . $file_name); //File Deleted After uploading in database .			 
		redirect(base_url() . "patient");


	}

	public function import1()
	{
		$dbHost = "localhost";
		$dbDatabase = "srpayurved_db";
		$dbPasswrod = "gJXdRod3AOlyp4c9";
		$dbUser = "srpayurved_db";
		$mysqli = new mysqli($dbHost, $dbUser, $dbPasswrod, $dbDatabase);

		$configUpload['upload_path'] = FCPATH . '/'; //Upload Excel
		$configUpload['allowed_types'] = 'xls|xlsx|csv';
		$configUpload['max_size'] = '500000000000';
		$this->load->library('upload', $configUpload);
		$this->upload->do_upload('userfile');  //	
		$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
		$file_name = $upload_data['file_name']; //uploded file name
		$extension = $upload_data['file_ext'];    // uploded file extension


		//$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 	  
		//Set to read only
		$objReader->setReadDataOnly(true);
		//Load excel file
		$objPHPExcel = $objReader->load(FCPATH . $file_name);
		$totalrows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
		$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);

		//loop from first data untill last data

		$adress_def = array();
		$address = "SELECT * FROM address";
		$address1 = $mysqli->query($address);
		while ($address2 = $address1->fetch_assoc()) {
			// $auto_on_off2['description']."<br>";
			array_push($adress_def, $address2['name']);
		}
		for ($i = 2; $i <= $totalrows; $i++) {

			$patient_id = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue();
			$yearly_no = $objWorksheet->getCellByColumnAndRow(1, $i)->getValue();
			$yearly_reg_no = $objWorksheet->getCellByColumnAndRow(2, $i)->getValue();
			$daily_reg_no = $objWorksheet->getCellByColumnAndRow(3, $i)->getValue();
			$monthly_reg_no = $objWorksheet->getCellByColumnAndRow(4, $i)->getValue();

			$old_reg_no = $objWorksheet->getCellByColumnAndRow(5, $i)->getValue();
			$date = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(6, $i)->getValue()));
			$firstname = $objWorksheet->getCellByColumnAndRow(7, $i)->getValue();
			$sex = $objWorksheet->getCellByColumnAndRow(8, $i)->getValue();
			$date_of_birth = $objWorksheet->getCellByColumnAndRow(9, $i)->getValue();
			$address = $objWorksheet->getCellByColumnAndRow(10, $i)->getValue();
			$department_id = $objWorksheet->getCellByColumnAndRow(11, $i)->getValue();
			$degis_id = $objWorksheet->getCellByColumnAndRow(12, $i)->getValue();
			$ipd_opd = $objWorksheet->getCellByColumnAndRow(13, $i)->getValue();
			$ipd_no = $objWorksheet->getCellByColumnAndRow(14, $i)->getValue();
			$discharge_date = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(15, $i)->getValue()));
			$ipd_no1 = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(16, $i)->getValue()));

			$date1 = date('Y-m-d');
			if ($date1 == $discharge_date) {

				$discharge_date = '0000-00-00';
			} else {

				$discharge_date = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(15, $i)->getValue()));
			}

			$date1 = date('Y-m-d');
			if ($date1 == $ipd_no1) {

				$ipd_no1 = NULL;
			} else {

				$ipd_no1 = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(16, $i)->getValue()));
			}


			if (($sex == 'M') && ($department_id != 32)) {

				$occupation = array('Farmer', 'Office', 'Business', 'Driver', 'Labor', 'Jobless', 'Teacher', 'other');
				$a = array(41, 49, 44, 48, 50, 55, 61, 51, 63, 56, 67);

			} else if (($sex == 'F') && ($department_id != 32)) {
				$occupation = array('Farmer', 'Office', 'Business', 'Driver', 'Labor', 'Jobless', 'Teacher', 'other');
				$a = array(41, 49, 44, 48, 50, 55, 61, 51, 63, 56, 67);
			} else {
				$occupation = array('Student');
				$a = array(16, 18, 20, 22, 14, 11, 13);
				$key = array_rand($a);
			}

			$c_o = $degis_id;
			$h_o = 'NAD';
			$f_o = 'NAD';
			$bp = array('130/80', '124/86', '138/88', '149/90', '110/70', '150/84', '148/72', '128/60', '140/90');
			$nadi = array('मंडूकगति', 'सर्पगती', 'हंसगति', 'अविशेष');
			$Pulse = array(76, 78, 88, 90, 68, 72, 82, 66, 74, 92, 64);
			$ur = 'अविशेष';
			$cvs = 'S1S2 N';
			$udar = 'soft';
			$netra = array('आविल', 'अच्छ', 'इष्टपित');
			$givwa = array('साम', 'निराम');
			$sudha = array('तीक्षाग', 'मंदाग  ', 'समाग्नी ', 'विषमाग्नी');

			$ahar = array('प्रभत ', 'अल्प ', 'मध्यम');
			$mal = array('साम ', 'निराम ', 'कठीण ', 'दुर्गंधीयुक्त ', 'अविशेष');
			$mutra = array('पीत', 'आविल', 'दुर्गंधीयुक्त', 'अविशेष');
			$nidra = array('अविशेष', 'प्रभुत', 'अल्प');

			$key = array_rand($a);
			$a[$key];
			$key1 = array_rand($occupation);
			$occupation[$key1];
			$key2 = array_rand($adress_def);
			$adress_def[$key2];

			//$c_o1=array_rand($c_o);
			// $c_o[$c_o1];

			$bp1 = array_rand($bp);
			$bp[$bp1];

			$nadi1 = array_rand($nadi);
			$nadi[$nadi1];

			$Pulse1 = array_rand($Pulse);
			$Pulse[$Pulse1];

			$netra1 = array_rand($netra);
			$netra[$netra1];

			$givwa1 = array_rand($givwa);
			$givwa[$givwa1];


			$sudha1 = array_rand($sudha);
			$sudha[$sudha1];

			$ahar1 = array_rand($ahar);
			$ahar[$ahar1];

			$mal1 = array_rand($mal);
			$mal[$mal1];

			$mutra1 = array_rand($mutra);
			$mutra[$mutra1];

			$nidra1 = array_rand($nidra);
			$nidra[$nidra1];

			//	$date1=date('Y-m-d');
/*if($date1==$discharge_date){
	
	$discharge_date="0000-00-00";
}else{
	
	$discharge_date=date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(15, $i)->getValue()));
}*/


			$data['patient'] = (object) $postData = [
				'patient_id' => $patient_id,
				'yealry_number' => $yearly_no,
				'CopddD_New' => $yearly_reg_no,
				'Daily' => $daily_reg_no,
				'Monthly' => $monthly_reg_no,
				'Copdd_Old' => $old_reg_no,
				//'Date' => $date,
				'NAME' => $firstname,


				'SEX' => $sex,
				'AGE' => $date_of_birth,
				'Address' => $address,
				'VIBHAG' => $department_id,
				'NIDAN' => $degis_id,
				'ipd_opd' => $ipd_opd,
				'ipd_no' => $ipd_no,
				'discharge_date' => $discharge_date,



				'occupation' => $occupation[$key1],
				'wieght' => $a[$key],
				'c_o' => $degis_id,
				'h_o' => $h_o,
				'f_h' => $f_o,
				'nadi' => $nadi[$nadi1],
				'pulse' => $Pulse[$Pulse1],
				'shudha' => $sudha[$sudha1],
				'mal' => $mal[$mal1],
				'nidra' => $nidra[$nidra1],
				'bp' => $bp[$bp1],

				'ur' => $ur,
				'givwa' => $givwa[$givwa1],
				'ahar' => $ahar[$ahar1],
				'mutra' => $mutra[$mutra1],
				'udar' => $udar,
				'cvs' => $cvs,
				'netra' => $netra[$netra1],
				'fol_up_date' => $ipd_no1


			];

			$this->patient_model->create($postData);
		}
		unlink('/' . $file_name); //File Deleted After uploading in database .			 
		redirect(base_url() . "patient");


	}

	public function import()
	{
		ini_set('max_execution_time', '600');
		$configUpload['upload_path'] = FCPATH . '/'; //Upload Excel
		$configUpload['allowed_types'] = 'xls|xlsx|csv';
		$configUpload['max_size'] = '500000000000';
		$this->load->library('upload', $configUpload);
		$this->upload->do_upload('userfile');  //	
		$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
		$file_name = $upload_data['file_name']; //uploded file name
		$extension = $upload_data['file_ext'];    // uploded file extension


		//$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 	  
		//Set to read only
		$objReader->setReadDataOnly(true);
		//Load excel file
		$objPHPExcel = $objReader->load(FCPATH . $file_name);
		$totalrows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
		$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);

		//loop from first data untill last data
		for ($i = 2; $i <= $totalrows; $i++) {

			$patient_id = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue();
			$yearly_no = $objWorksheet->getCellByColumnAndRow(1, $i)->getValue();
			$daily_reg_no = $objWorksheet->getCellByColumnAndRow(3, $i)->getValue();
			$monthly_reg_no = $objWorksheet->getCellByColumnAndRow(4, $i)->getValue();
			$yearly_reg_no = $objWorksheet->getCellByColumnAndRow(2, $i)->getValue();
			$old_reg_no = $objWorksheet->getCellByColumnAndRow(5, $i)->getValue();
			$date = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(6, $i)->getValue()));
			$firstname = $objWorksheet->getCellByColumnAndRow(7, $i)->getValue();
			$sex = $objWorksheet->getCellByColumnAndRow(8, $i)->getValue();
			$date_of_birth = $objWorksheet->getCellByColumnAndRow(9, $i)->getValue();
			$address = $objWorksheet->getCellByColumnAndRow(10, $i)->getValue();
			$department_id = $objWorksheet->getCellByColumnAndRow(11, $i)->getValue();
			$degis_id = $objWorksheet->getCellByColumnAndRow(12, $i)->getValue();
			$ipd_opd = $objWorksheet->getCellByColumnAndRow(13, $i)->getValue();
			$ipd_no = $objWorksheet->getCellByColumnAndRow(14, $i)->getValue();
			$discharge_date = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(15, $i)->getValue()));

			$date1 = date('Y-m-d');
			if ($date1 == $discharge_date) {

				$discharge_date = "0000-00-00";
			} else {

				$discharge_date = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(15, $i)->getValue()));
			}


			$data['patient'] = (object) $postData = [
				'Sno' => $patient_id,
				'yealry_number' => $yearly_no,
				'CopddD_New' => $yearly_reg_no,
				'Monthly' => $monthly_reg_no,
				'Daily' => $daily_reg_no,
				'Copdd_Old' => $old_reg_no,
				'Date' => $date,
				'NAME' => $firstname,
				'SEX' => $sex,
				'AGE' => $date_of_birth,
				'Address' => $address,
				'VIBHAG' => $department_id,
				'NIDAN' => $degis_id,
				'ipd_opd' => $ipd_opd,
				'ipd_no' => $ipd_no,
				'Dischargedate' => $discharge_date
			];

			$this->patient_model->create11($postData);
		}
		unlink('/' . $file_name); //File Deleted After uploading in database .			 
		redirect(base_url() . "patient");


	}

	public function import_ipd()
	{
		$configUpload['upload_path'] = FCPATH . '/'; //Upload Excel
		$configUpload['allowed_types'] = 'xls|xlsx|csv';
		$configUpload['max_size'] = '500000000000';
		$this->load->library('upload', $configUpload);
		$this->upload->do_upload('userfile');  //	
		$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
		$file_name = $upload_data['file_name']; //uploded file name
		$extension = $upload_data['file_ext'];    // uploded file extension


		//$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 	  
		//Set to read only
		$objReader->setReadDataOnly(true);
		//Load excel file
		$objPHPExcel = $objReader->load(FCPATH . $file_name);
		$totalrows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
		$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);

		//loop from first data untill last data
		for ($i = 2; $i <= $totalrows; $i++) {

			$patient_id = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue();
			$yearly_no = $objWorksheet->getCellByColumnAndRow(1, $i)->getValue();
			$daily_reg_no = $objWorksheet->getCellByColumnAndRow(3, $i)->getValue();
			$monthly_reg_no = $objWorksheet->getCellByColumnAndRow(4, $i)->getValue();
			$yearly_reg_no = $objWorksheet->getCellByColumnAndRow(2, $i)->getValue();
			$old_reg_no = $objWorksheet->getCellByColumnAndRow(5, $i)->getValue();
			$date = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(6, $i)->getValue()));
			$firstname = $objWorksheet->getCellByColumnAndRow(7, $i)->getValue();
			$sex = $objWorksheet->getCellByColumnAndRow(8, $i)->getValue();
			$date_of_birth = $objWorksheet->getCellByColumnAndRow(9, $i)->getValue();
			$address = $objWorksheet->getCellByColumnAndRow(10, $i)->getValue();
			$department_id = $objWorksheet->getCellByColumnAndRow(11, $i)->getValue();
			$degis_id = $objWorksheet->getCellByColumnAndRow(12, $i)->getValue();
			$ipd_opd = $objWorksheet->getCellByColumnAndRow(13, $i)->getValue();
			$ipd_no = $objWorksheet->getCellByColumnAndRow(14, $i)->getValue();
			//$discharge_date = $objWorksheet->getCellByColumnAndRow(15, $i)->getValue();
			$discharge_date = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(15, $i)->getValue()));

			$date1 = date('Y-m-d');
			if ($date1 == $discharge_date) {

				$discharge_date = "0000-00-00";
			} else {

				$discharge_date = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(15, $i)->getValue()));
			}
			/* if($discharge_date){
				 $discharge_date1=$discharge_date;
			 }else{
				 $discharge_date1="0000-00-00";
			 }
	  */
			$data['patient'] = (object) $postData = [
				'patient_id' => $patient_id,
				'yearly_no' => $yearly_no,
				'yearly_reg_no' => $yearly_reg_no,
				'monthly_reg_no' => $monthly_reg_no,
				'daily_reg_no' => $daily_reg_no,
				'old_reg_no' => $old_reg_no,
				'create_date' => $date,
				'firstname' => $firstname,
				'sex' => $sex,
				'date_of_birth' => $date_of_birth,
				'address' => $address,
				'department_id' => $department_id,
				'dignosis' => $degis_id,
				'ipd_opd' => $ipd_opd,
				'ipd_no' => $ipd_no,
				'discharge_date' => $discharge_date
			];

			$this->patient_model->create_ipd($postData);
		}
		unlink('/' . $file_name); //File Deleted After uploading in database .			 
		redirect(base_url() . "patient");


	}



	public function check_patient($mode = null)
	{
		//$year = '%'.$this->session->userdata['acyear'].'%';
		$old_reg_no = $this->input->post('old_reg_no');
		$acyear = $this->session->userdata('acyear');
		$old_reg_no_like = '%' . $this->input->post('old_reg_no') . '%';

		if (!empty($old_reg_no)) {
			$query = $this->db->select('*')
				->from('patient')
				->where('year(create_date)', $acyear)
				->where('yearly_reg_no', $old_reg_no)
				->or_where('firstname Like', $old_reg_no_like)
				->where('status', 1)
				->order_by('create_date', 'DESC')
				->get();

			// ->result();
			//print_r(get());	
			$result = $query->row();
			/// $result->status;

			//print_r($this->db->last_query());

			if ($result->status == 1) {
				//$data['patient1'] = $result->status;
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


	public function createPagePatientsData()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);


		$start_date2 = date('Y-m-d', strtotime($start_date1));

		//print_r($start_date2);
		//exit;

		$end_date2 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);

		$start_date = $start_date2;
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";

		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$date1 = date_create($start_date2);
		$date2 = date_create($end_date2);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '1';
		}



		if ($section == 'opd') {
			$data['patients'] = $this->db->select("*")

				->from('patient')

				->join('department', 'department.dprt_id =  patient.department_id')

				->where('ipd_opd', $section)

				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)

				->where('create_date LIKE', $year)
				->get()

				->result();


			$data['department_by_section'] = 'opd';
		} else {

			$data['patients1'] = $this->db->select("*")

				->from('patient_ipd')

				->join('department', 'department.dprt_id = patient_ipd.department_id')

				->where('discharge_date >=', $start_date_f)

				->where('create_date <=', $start_date_f)

				->where('ipd_opd', 'ipd')
				->or_where('discharge_date', $start_date)

				->where('ipd_opd', 'ipd')

				->get()

				->result();



			//Array 2
			$data['patients2'] = $this->db->select("*")

				->from('patient_ipd')

				->join('department', 'department.dprt_id = patient_ipd.department_id')

				->where('create_date <=', $start_date)

				->where('discharge_date LIKE', '%0000-00-00%')

				->where('ipd_opd', 'ipd')

				->get()

				->result();


			$data['patients'] = array_merge($data['patients1'], $data['patients2']);
			//$data['patients'] = $data['patients2'];

			$data['department_by_section'] = 'ipd';
		}
		//	print_r($data['patients']);exit;

		/* $data['ipdcountdater'] = $this->db->select('department.name,patient.department_id, patient.create_date as Date, COUNT(*) as Total, COUNT(patient.old_reg_no) as Patientoldcount, COUNT(patient.yearly_reg_no) as Patientnewcount, COUNT(patient.create_date) as datecount')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		 ->where('yearly_reg_no !=', '')
		 ->where('patient.sex', 'M')
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
		 ->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)
		->group_by('patient.department_id')
		->get()
		->result();

		$dept=$this->db->select("*")
							   ->from('department')
							   ->order_by('dprt_id','desc')
							   ->get()
							   ->result_array();
		$i=0;
		foreach( $data['ipdcountdater']  as $date){
			if($dept[$i]['id']==$date->department_id){
				 echo $date->Total.'\n';
			}else{
			echo '0\n';
			}
			$i++;
		}

		echo count($data['ipdcountdater']);exit;*/
		$data['serial_no'] = '1';
		$data['dignosis_list'] = $this->dignosis_model->dignosis_sub_list();
		$data['department_list'] = $this->department_model->department_list();
		$data['address_list'] = $this->department_model->address_list();

		$data['beds'] = $this->bed_model->read();

		// 			$data['content'] = $this->load->view('patient_form',$data,true);
// 			$this->load->view('layout/main_wrapper',$data);

		if ($data == null) {
			$data['content'] = $this->load->view('patient_form', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		} else {
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patient_form', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}


	}



	public function patient_by_date()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		//$end_date1   = $this->input->get('end_date', TRUE);
		$end_date1 = $start_date1;
		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = date('Y-m-d', strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
		$data['section'] = $section;
		$start_date = $start_date2;
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";

		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$date1 = date_create($start_date2);
		$date2 = date_create($end_date2);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '1';
		}



		if ($section == 'opd') {
			$data['patients'] = $this->db->select("*")
				->from('patient')
				->join('department', 'department.dprt_id =  patient.department_id')
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)
				->where('create_date <=', $end_date)
				->where('create_date LIKE', $year)
				->get()

				->result();


			$data['department_by_section'] = 'opd';
		} else {

			$data['patients1'] = $this->db->select("*")
				->from('patient_ipd')
				->join('department', 'department.dprt_id = patient_ipd.department_id')
				->where('discharge_date >=', $start_date_f)
				->where('create_date <=', $start_date_f)
				->where('ipd_opd', 'ipd')
				->or_where('discharge_date', $start_date)
				->where('ipd_opd', 'ipd')
				->get()
				->result();

			//Array 2
			$data['patients2'] = $this->db->select("*")
				->from('patient_ipd')
				->join('department', 'department.dprt_id = patient_ipd.department_id')
				->where('create_date <=', $start_date)
				->where('discharge_date LIKE', '%0000-00-00%')
				->where('ipd_opd', 'ipd')
				->get()
				->result();


			$data['patients'] = array_merge($data['patients1'], $data['patients2']);
			$data['department_by_section'] = 'ipd';
		}

		if ($data == null) {
			$data['content'] = $this->load->view('patient', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		} else {
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patient', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}

	}

	public function patient_by_date_occupancy()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $start_date1;
		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = date('Y-m-d', strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";
		$data['section'] = $section;
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		if ($section == 'opd') {
			$data['patients'] = $this->db->select("*")
				->from('patient')
				->join('department', 'department.dprt_id =  patient.department_id')
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)
				->where('create_date <=', $end_date)
				->where('create_date LIKE', $year)
				->get()
				->result();

			$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
				->from('patient')
				->join('department', ' patient.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('create_date >=', $start_date)
				->where('create_date <=', $end_date)
				->where('ipd_opd', $section)
				->group_by('department.name, patient.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT( patient.sex) as totalGender, COUNT( patient.yearly_reg_no) as totalNew, COUNT( patient.old_reg_no) as totalold')
				->from('patient')
				->where('create_date LIKE', $year)
				->where('create_date >=', $start_date)
				->where('create_date <=', $end_date)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {
			$data['patients1'] = $this->db->select("*")
				->from('patient_ipd')
				->join('department', 'department.dprt_id = patient_ipd.department_id')
				->where('discharge_date >=', $start_date_f)
				->where('create_date <=', $end_date)
				->where('ipd_opd', 'ipd')
				->get()
				->result();
			//Array 2
			$data['patients2'] = $this->db->select("*")
				->from('patient_ipd')
				->join('department', 'department.dprt_id = patient_ipd.department_id')
				->where('create_date <=', $end_date)
				->where('discharge_date LIKE', '%0000-00-00%')
				->where('ipd_opd', 'ipd')
				->get()
				->result();
			$data['patients'] = array_merge($data['patients1'], $data['patients2']);
			$data['gendercount'] = $this->db->select('department.name,patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where("(discharge_date LIKE '0000-00-00')", NULL, FALSE)
				->where('create_date <=', $end_date)
				->where('ipd_opd', $section)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where("(discharge_date LIKE '0000-00-00')", NULL, FALSE)
				->where('create_date <=', $end_date)
				->where('ipd_opd', $section)
				->get()
				->result();

			$data['department_by_section'] = 'ipd';
		}

		if ($data == null) {
			$data['content'] = $this->load->view('patient', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		} else {
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patientoccupancy', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}


	}

	public function bed_occupancy()
	{
		//SELECT sum(m_n) FROM `bed_occupancy` WHERE create_date >='2020-01-01 00:00:00' and create_date <='2020-01-01' GROUP BY department_id ORDER BY department_id DESC

		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);


		$start_date2 = date('Y-m-d');

		$end_date2 = date('Y-m-d');

		//$section = $this->input->get('section', TRUE);



		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";

		$data['gendercount'] = $this->db->select('department_id, sum(m_n) as MN, sum(m_o) as MO, sum(f_n) as FN, sum(f_o) as FO, sum(t_t) as TT')
			->from('bed_occupancy')
			//->where('create_date LIKE', $year)
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', 'ipd')
			->group_by('department_id')
			->order_by("department_id", "DESC")

			->get()
			->result();

		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		//print_r($data['gendercount']);
		$data['content'] = $this->load->view('patient_bed', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function panchkarma_ipd()
	{
		//SELECT sum(m_n) FROM `bed_occupancy` WHERE create_date >='2020-01-01 00:00:00' and create_date <='2020-01-01' GROUP BY department_id ORDER BY department_id DESC

		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);


		$start_date2 = date('Y-m-d');

		$end_date2 = date('Y-m-d');

		//$section = $this->input->get('section', TRUE);



		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";

		$data['gendercount'] = $this->db->select('name, sum(number) as total')
			->from('panch_ipd')
			//->where('create_date LIKE', $year)
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			//->where('ipd_opd', 'ipd')
			->group_by('name')
			//->order_by("department_id", "DESC")

			->get()
			->result();

		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		//print_r($data['gendercount']);
		$data['content'] = $this->load->view('panchkarma_ipd', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function panchkarma_ipd_date()
	{
		//SELECT sum(m_n) FROM `bed_occupancy` WHERE create_date >='2020-01-01 00:00:00' and create_date <='2020-01-01' GROUP BY department_id ORDER BY department_id DESC

		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);


		$start_date2 = date('Y-m-d', strtotime($start_date1));

		$end_date2 = date('Y-m-d', strtotime($end_date1));

		//$section = $this->input->get('section', TRUE);



		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";

		$data['gendercount'] = $this->db->select('name, sum(number) as total')
			->from('panch_ipd')
			//->where('create_date LIKE', $year)
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', 'ipd')
			->group_by('order_name')
			//->order_by("department_id", "DESC")

			->get()
			->result();

		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		//print_r($data['gendercount']);
		$data['content'] = $this->load->view('panchkarma_ipd', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function bed_occupancy_date()
	{
		//SELECT sum(m_n) FROM `bed_occupancy` WHERE create_date >='2020-01-01 00:00:00' and create_date <='2020-01-01' GROUP BY department_id ORDER BY department_id DESC

		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);


		$start_date2 = date('Y-m-d', strtotime($start_date1));

		$end_date2 = date('Y-m-d', strtotime($end_date1));

		//$section = $this->input->get('section', TRUE);



		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";

		$data['gendercount'] = $this->db->select('department_id, sum(m_n) as MN, sum(m_o) as MO, sum(f_n) as FN, sum(f_o) as FO, sum(t_t) as TT')
			->from('bed_occupancy')
			//->where('create_date LIKE', $year)
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', 'ipd')
			->group_by('department_id')
			->order_by("department_id", "DESC")

			->get()
			->result();

		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		//print_r($data['gendercount']);
		$data['content'] = $this->load->view('patient_bed', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function patient_by_date_occupancy11111()
	{
		echo error_reporting(0);
		ini_set('memory_limit', '-1');
		$year = '%' . $this->session->userdata['acyear'] . '%';
		$login_year = $this->session->userdata['acyear'];
		$next_year = $login_year + 1;

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);
		//$array_push=array('2019-02-15');

		$period = new DatePeriod(
			new DateTime($login_year . '-01-01'),
			new DateInterval('P1D'),
			new DateTime($next_year . '-01-01')
		);
		$array_push = array();
		foreach ($period as $key => $value) {

			$value->format('Y-m-d');
			/* echo "<br>";*/
			array_push($array_push, $value->format('Y-m-d'));
		}
		//array_push($array_push,'2019-12-31');
		// echo '2019-12-31';
		// echo "<br>";
		// echo "<br>";

		$jan1 = 0;
		$feb1 = 0;
		$march1 = 0;
		$april1 = 0;
		$may1 = 0;
		$june1 = 0;
		$jully1 = 0;
		$aguest1 = 0;
		$sebt1 = 0;
		$octo1 = 0;
		$nove1 = 0;
		$desm1 = 0;
		$tot_sum = 0;
		$tot_sum1 = 0;

		$k1 = 0;
		$k2 = 0;
		$k3 = 0;
		$k4 = 0;
		$k5 = 0;
		$k6 = 0;
		$k7 = 0;
		$k8 = 0;
		$k9 = 0;
		$k10 = 0;
		$k11 = 0;
		$k12 = 0;

		$pn1 = 0;
		$p2 = 0;
		$p3 = 0;
		$p4 = 0;
		$p5 = 0;
		$p6 = 0;
		$p7 = 0;
		$p8 = 0;
		$p9 = 0;
		$p10 = 0;
		$p11 = 0;
		$p12 = 0;

		$sl1 = 0;
		$sl2 = 0;
		$sl3 = 0;
		$sl4 = 0;
		$sl5 = 0;
		$sl6 = 0;
		$sl7 = 0;
		$sl8 = 0;
		$sl9 = 0;
		$sl10 = 0;
		$sl11 = 0;
		$sl12 = 0;

		$sk1 = 0;
		$sk2 = 0;
		$sk3 = 0;
		$sk4 = 0;
		$sk5 = 0;
		$sk6 = 0;
		$sk7 = 0;
		$sk8 = 0;
		$sk9 = 0;
		$sk10 = 0;
		$sk11 = 0;
		$sk12 = 0;

		$st1 = 0;
		$st2 = 0;
		$st3 = 0;
		$st4 = 0;
		$st5 = 0;
		$st6 = 0;
		$st7 = 0;
		$st8 = 0;
		$st9 = 0;
		$st10 = 0;
		$st11 = 0;
		$st12 = 0;

		$b1 = 0;
		$b2 = 0;
		$b3 = 0;
		$b4 = 0;
		$b5 = 0;
		$b6 = 0;
		$b7 = 0;
		$b8 = 0;
		$b9 = 0;
		$b10 = 0;
		$b11 = 0;
		$b12 = 0;



		for ($i = 0; $i < count($array_push); $i++) {

			$start_date2 = date('Y-m-d', strtotime($array_push[$i]));

			$end_date2 = date('Y-m-d', strtotime($array_push[$i]));

			$section = 'ipd';

			$start_date = $start_date2 . " 00:00:00";
			$start_date_f = $start_date2 . " 23:59:00";
			$end_date = $end_date2 . " 23:59:00";
			// $start_date=$start_date1." 00:00:00";
			// $end_date=$end_date1." 23:59:00";
			$data['datefrom'] = $start_date;
			$data['dateto'] = $end_date;


			//echo $section;
			$month = date('m', strtotime($end_date));


			$patients1 = $this->db->select("create_date as datee,COUNT(*) as Total,department.dprt_id as name")

				->from('patient_ipd')

				->join('department', 'department.dprt_id = patient_ipd.department_id')

				->where('discharge_date >=', $start_date_f)
				->group_by('department.dprt_id')
				->where('create_date <=', $end_date)


				->where('ipd_opd', $section)
				//	->or_where('discharge_date', $start_date)

				//	->where('create_date LIKE', $year)

				->get()

				->result();

			//	print_r($patients1);
			$patients12 = 0;
			$p1 = 0;

			for ($n = 0; $n < count($patients1); $n++) {
				//echo $patients1[$n]->Total;
				//  echo "<br>";





				//Array 2
				$patients2 = $this->db->select("COUNT(*) as Total,department.dprt_id as name")

					->from('patient_ipd')

					->join('department', 'department.dprt_id = patient_ipd.department_id')

					->where('create_date <=', $end_date)
					->group_by('department.dprt_id')

					->where('discharge_date LIKE', '%0000-00-00%')

					->where('ipd_opd', 'ipd')

					->get()

					->result();

				if ($patients2[$n]) {
					$pp1 += $patients2[$n]->Total;
				} else {
					$pp1 = 0;
				}
				//echo $end_date; echo "  ";

				$patients12 += $patients1[$n]->Total + $pp1;

				//echo $patients1[$n]->name;
				if ($patients1[$n]->name == 34) {
					if ($patients2[$n]) {
						$ss = $patients2[$n]->Total;
					} else {
						$ss = 0;
					}
					$k += $patients1[$n]->Total + $ss;
					if ($month == '01') {
						$jan1 += $patients1[$n]->Total + $ss;
						$k1 += $patients1[$n]->Total + $ss;
					} else if ($month == '02') {
						$feb1 += $patients1[$n]->Total + $ss;
						$k2 += $patients1[$n]->Total + $ss;
					} else if ($month == '03') {
						$march1 += $patients1[$n]->Total + $ss;
						$k3 += $patients1[$n]->Total + $ss;
					} else if ($month == '04') {
						$april1 += $patients1[$n]->Total + $ss;
						$k4 += $patients1[$n]->Total + $ss;
					} else if ($month == '05') {
						$may1 += $patients1[$n]->Total + $ss;
						$k5 += $patients1[$n]->Total + $ss;
					} else if ($month == '06') {
						$june1 += $patients1[$n]->Total + $ss;
						$k6 += $patients1[$n]->Total + $ss;
					}
					if ($month == '07') {
						$jully1 += $patients1[$n]->Total + $ss;
						$k7 += $patients1[$n]->Total + $ss;
					} else if ($month == '08') {
						$aguest1 += $patients1[$n]->Total + $ss;
						$k8 += $patients1[$n]->Total + $ss;
					} else if ($month == '09') {
						$sebt1 += $patients1[$n]->Total + $ss;
						$k9 += $patients1[$n]->Total + $ss;
					} else if ($month == '10') {
						$octo1 += $patients1[$n]->Total + $ss;
						$k10 += $patients1[$n]->Total + $ss;
					} else if ($month == '11') {
						$nove1 += $patients1[$n]->Total + $ss;
						$k11 += $patients1[$n]->Total + $ss;
					} else if ($month == '12') {
						$desm1 += $patients1[$n]->Total + $ss;
						$k12 += $patients1[$n]->Total + $ss;
					}
				}

				if ($patients1[$n]->name == 33) {
					if ($patients2[$n]) {
						$ss = $patients2[$n]->Total;
					} else {
						$ss = 0;
					}
					$p += $patients1[$n]->Total + $ss;
					if ($month == '01') {
						$jan1 += $patients1[$n]->Total + $ss;
						$pn1 += $patients1[$n]->Total + $ss;
					} else if ($month == '02') {
						$feb1 += $patients1[$n]->Total + $ss;
						$p2 += $patients1[$n]->Total + $ss;
					} else if ($month == '03') {
						$march1 += $patients1[$n]->Total + $ss;
						$p3 += $patients1[$n]->Total + $ss;
					} else if ($month == '04') {
						$april1 += $patients1[$n]->Total + $ss;
						$p4 += $patients1[$n]->Total + $ss;
					} else if ($month == '05') {
						$may1 += $patients1[$n]->Total + $ss;
						$p5 += $patients1[$n]->Total + $ss;
					} else if ($month == '06') {
						$june1 += $patients1[$n]->Total + $ss;
						$p6 += $patients1[$n]->Total + $ss;
					}
					if ($month == '07') {
						$jully1 += $patients1[$n]->Total + $ss;
						$p7 += $patients1[$n]->Total + $ss;
					} else if ($month == '08') {
						$aguest1 += $patients1[$n]->Total + $ss;
						$p8 += $patients1[$n]->Total + $ss;
					} else if ($month == '09') {
						$sebt1 += $patients1[$n]->Total + $ss;
						$p9 += $patients1[$n]->Total + $ss;
					} else if ($month == '10') {
						$octo1 += $patients1[$n]->Total + $ss;
						$p10 += $patients1[$n]->Total + $ss;
					} else if ($month == '11') {
						$nove1 += $patients1[$n]->Total + $ss;
						$p11 += $patients1[$n]->Total + $ss;
					} else if ($month == '12') {
						$desm1 += $patients1[$n]->Total + $ss;
						$p12 += $patients1[$n]->Total + $ss;
					}
				}
				if ($patients1[$n]->name == 32) {
					if ($patients2[$n]) {
						$ss = $patients2[$n]->Total;
					} else {
						$ss = 0;
					}
					$b += $patients1[$n]->Total + $ss;
					if ($month == '01') {
						$jan1 += $patients1[$n]->Total + $ss;
						$b1 += $patients1[$n]->Total + $ss;
					} else if ($month == '02') {
						$feb1 += $patients1[$n]->Total + $ss;
						$b2 += $patients1[$n]->Total + $ss;
					} else if ($month == '03') {
						$march1 += $patients1[$n]->Total + $ss;
						$b3 += $patients1[$n]->Total + $ss;
					} else if ($month == '04') {
						$april1 += $patients1[$n]->Total + $ss;
						$b4 += $patients1[$n]->Total + $ss;
					} else if ($month == '05') {
						$may1 += $patients1[$n]->Total + $ss;
						$b5 += $patients1[$n]->Total + $ss;
					} else if ($month == '06') {
						$june1 += $patients1[$n]->Total + $ss;
						$b6 += $patients1[$n]->Total + $ss;
					}
					if ($month == '07') {
						$jully1 += $patients1[$n]->Total + $ss;
						$b7 += $patients1[$n]->Total + $ss;
					} else if ($month == '08') {
						$aguest1 += $patients1[$n]->Total + $ss;
						$b8 += $patients1[$n]->Total + $ss;
					} else if ($month == '09') {
						$sebt1 += $patients1[$n]->Total + $ss;
						$b9 += $patients1[$n]->Total + $ss;
					} else if ($month == '10') {
						$octo1 += $patients1[$n]->Total + $ss;
						$b10 += $patients1[$n]->Total + $ss;
					} else if ($month == '11') {
						$nove1 += $patients1[$n]->Total + $ss;
						$b11 += $patients1[$n]->Total + $ss;
					} else if ($month == '12') {
						$desm1 += $patients1[$n]->Total + $ss;
						$b12 += $patients1[$n]->Total + $ss;
					}
				}
				if ($patients1[$n]->name == 31) {
					if ($patients2[$n]) {
						$ss = $patients2[$n]->Total;
					} else {
						$ss = 0;
					}
					$sl += $patients1[$n]->Total + $ss;
					if ($month == '01') {
						$jan1 += $patients1[$n]->Total + $ss;
						$sl1 += $patients1[$n]->Total + $ss;
					} else if ($month == '02') {
						$feb1 += $patients1[$n]->Total + $ss;
						$sl2 += $patients1[$n]->Total + $ss;
					} else if ($month == '03') {
						$march1 += $patients1[$n]->Total + $ss;
						$sl3 += $patients1[$n]->Total + $ss;
					} else if ($month == '04') {
						$april1 += $patients1[$n]->Total + $ss;
						$sl4 += $patients1[$n]->Total + $ss;
					} else if ($month == '05') {
						$may1 += $patients1[$n]->Total + $ss;
						$sl5 += $patients1[$n]->Total + $ss;
					} else if ($month == '06') {
						$june1 += $patients1[$n]->Total + $ss;
						$sl6 += $patients1[$n]->Total + $ss;
					}
					if ($month == '07') {
						$jully1 += $patients1[$n]->Total + $ss;
						$sl7 += $patients1[$n]->Total + $ss;
					} else if ($month == '08') {
						$aguest1 += $patients1[$n]->Total + $ss;
						$sl8 += $patients1[$n]->Total + $ss;
					} else if ($month == '09') {
						$sebt1 += $patients1[$n]->Total + $ss;
						$sl9 += $patients1[$n]->Total + $ss;
					} else if ($month == '10') {
						$octo1 += $patients1[$n]->Total + $ss;
						$sl10 += $patients1[$n]->Total + $ss;
					} else if ($month == '11') {
						$nove1 += $patients1[$n]->Total + $ss;
						$sl11 += $patients1[$n]->Total + $ss;
					} else if ($month == '12') {
						$desm1 += $patients1[$n]->Total + $ss;
						$sl12 += $patients1[$n]->Total + $ss;
					}
				}
				if ($patients1[$n]->name == 30) {
					if ($patients2[$n]) {
						$ss = $patients2[$n]->Total;
					} else {
						$ss = 0;
					}
					$sk += $patients1[$n]->Total + $ss;
					if ($month == '01') {
						$jan1 += $patients1[$n]->Total + $ss;
						$sk1 += $patients1[$n]->Total + $ss;
					} else if ($month == '02') {
						$feb1 += $patients1[$n]->Total + $ss;
						$sk2 += $patients1[$n]->Total + $ss;
					} else if ($month == '03') {
						$march1 += $patients1[$n]->Total + $ss;
						$sk3 += $patients1[$n]->Total + $ss;
					} else if ($month == '04') {
						$april1 += $patients1[$n]->Total + $ss;
						$sk4 += $patients1[$n]->Total + $ss;
					} else if ($month == '05') {
						$may1 += $patients1[$n]->Total + $ss;
						$sk5 += $patients1[$n]->Total + $ss;
					} else if ($month == '06') {
						$june1 += $patients1[$n]->Total + $ss;
						$sk6 += $patients1[$n]->Total + $ss;
					}
					if ($month == '07') {
						$jully1 += $patients1[$n]->Total + $ss;
						$sk7 += $patients1[$n]->Total + $ss;
					} else if ($month == '08') {
						$aguest1 += $patients1[$n]->Total + $ss;
						$sk8 += $patients1[$n]->Total + $ss;
					} else if ($month == '09') {
						$sebt1 += $patients1[$n]->Total + $ss;
						$sk9 += $patients1[$n]->Total + $ss;
					} else if ($month == '10') {
						$octo1 += $patients1[$n]->Total + $ss;
						$sk10 += $patients1[$n]->Total + $ss;
					} else if ($month == '11') {
						$nove1 += $patients1[$n]->Total + $ss;
						$sk11 += $patients1[$n]->Total + $ss;
					} else if ($month == '12') {
						$desm1 += $patients1[$n]->Total + $ss;
						$sk12 += $patients1[$n]->Total + $ss;
					}
				}
				if ($patients1[$n]->name == 29) {
					if ($patients2[$n]) {
						$ss = $patients2[$n]->Total;
					} else {
						$ss = 0;
					}
					$st += $patients1[$n]->Total + $ss;
					if ($month == '01') {
						$jan1 += $patients1[$n]->Total + $ss;
						$st1 += $patients1[$n]->Total + $ss;
					} else if ($month == '02') {
						$feb1 += $patients1[$n]->Total + $ss;
						$st2 += $patients1[$n]->Total + $ss;
					} else if ($month == '03') {
						$march1 += $patients1[$n]->Total + $ss;
						$st3 += $patients1[$n]->Total + $ss;
					} else if ($month == '04') {
						$april1 += $patients1[$n]->Total + $ss;
						$st4 += $patients1[$n]->Total + $ss;
					} else if ($month == '05') {
						$may1 += $patients1[$n]->Total + $ss;
						$st5 += $patients1[$n]->Total + $ss;
					} else if ($month == '06') {
						$june1 += $patients1[$n]->Total + $ss;
						$st6 += $patients1[$n]->Total + $ss;
					}
					if ($month == '07') {
						$jully1 += $patients1[$n]->Total + $ss;
						$st7 += $patients1[$n]->Total + $ss;
					} else if ($month == '08') {
						$aguest1 += $patients1[$n]->Total + $ss;
						$st8 += $patients1[$n]->Total + $ss;
					} else if ($month == '09') {
						$sebt1 += $patients1[$n]->Total + $ss;
						$st9 += $patients1[$n]->Total + $ss;
					} else if ($month == '10') {
						$octo1 += $patients1[$n]->Total + $ss;
						$st10 += $patients1[$n]->Total + $ss;
					} else if ($month == '11') {
						$nove1 += $patients1[$n]->Total + $ss;
						$st11 += $patients1[$n]->Total + $ss;
					} else if ($month == '12') {
						$desm1 += $patients1[$n]->Total + $ss;
						$st12 += $patients1[$n]->Total + $ss;
					}
				}


			}
			//echo $end_date;	echo " ";	echo $patients12;	echo " ";
			//	echo $k;echo " ";echo $p;	echo " "; echo $b;echo " ";echo $sl;echo " ";	echo $sk;echo " ";echo $st;

		}
		/* echo "<br>";
		echo $k1;echo " ";	echo $k2;  echo " ";	echo $k3;echo " ";	echo $k4; echo " ";	echo $k5;echo " ";	echo $k6;  echo " ";	echo $k7;echo " ";	echo $k8; 
		echo " ";	echo $k9;echo " ";	echo $k10;  echo " ";	echo $k11;echo " ";	echo $k12;*/
		$b1;

		$data['jan'] = array('0', $st1, $sk1, $sl1, $b1, $pn1, $k1, '0');
		$data['feb'] = array('0', $st2, $sk2, $sl2, $b2, $p2, $k2, '0');
		$data['march'] = array('0', $st3, $sk3, $sl3, $b3, $p3, $k3, '0');
		$data['april'] = array('0', $st4, $sk4, $sl4, $b4, $p4, $k4, '0');
		$data['may'] = array('0', $st5, $sk5, $sl5, $b5, $p5, $k5, '0');

		$data['june'] = array('0', $st6, $sk6, $sl6, $b6, $p6, $k6, '0');
		$data['jully'] = array('0', $st7, $sk7, $sl7, $b7, $p7, $k7, '0');
		$data['aguest'] = array('0', $st8, $sk8, $sl8, $b8, $p8, $k8, '0');
		$data['sebt'] = array('0', $st9, $sk9, $sl9, $b9, $p9, $k9, '0');
		$data['octo'] = array('0', $st10, $sk10, $sl10, $b10, $p10, $k10, '0');
		$data['nove'] = array('0', $st11, $sk11, $sl11, $b11, $p11, $k11, '0');
		$data['desm'] = array('0', $st12, $sk12, $sl12, $b12, $p12, $k12, '0');







		/*echo  $jan1; echo " ";	echo  $feb1; echo " ";	echo " ";	echo $march1; echo " ";	echo  $april1;echo " ";	echo $may1;echo " ";	echo $june1;
		echo " ";	echo $jully1; echo " ";	echo  $aguest1; echo " ";	echo $sebt1; echo " ";	echo  $octo1; echo " ";	echo $nove1; echo " "; echo $desm1;*/






		$data['department'] = $this->patient_model->get_all_dept();

		$data['datefrom'] = '2018';
		$data['dateto'] = '2018';

		$data['month_bed'] = 'month_bed';



		$data['content'] = $this->load->view('patient_month_report', $data, true);

		$this->load->view('layout/main_wrapper', $data);


	}

	public function getpatientbydepartment_karma_date()
	{


		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		//$end_date1   = $this->input->get('end_date', TRUE);
		$end_date1 = $start_date1;
		// $id   = $this->input->get('dept_id', TRUE);


		$start_date1 = date('Y-m-d', strtotime($start_date1));

		$end_date1 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);


		$start_date = $start_date1 . " 00:00:00";

		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;


		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id_date_karma($section, $start_date, $end_date);
		//print_rdata['patients']); exit;
		$date1 = date_create($start_date1);
		$date2 = date_create($end_date1);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '1';
		}

		$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {

			$data['department_by_section'] = 'opd';
		} else {

			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
		$data['department_by'] = 'dpt';
		$data['department_id'] = '';
		$data['section'] = $section;
		$data['content'] = $this->load->view('patient_karma', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function getpatientbydepartment_karma_date_other()
	{


		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		//$end_date1   = $this->input->get('end_date', TRUE);
		$end_date1 = $start_date1;
		// $id   = $this->input->get('dept_id', TRUE);


		$start_date1 = date('Y-m-d', strtotime($start_date1));

		$end_date1 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);


		$start_date = $start_date1 . " 00:00:00";

		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;


		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id_date_karma($section, $start_date, $end_date);
		//print_rdata['patients']); exit;
		$date1 = date_create($start_date1);
		$date2 = date_create($end_date1);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '1';
		}

		$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {

			$data['department_by_section'] = 'opd';
		} else {

			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
		$data['department_by'] = 'dpt';
		$data['department_id'] = '';
		$data['section'] = $section;
		$data['content'] = $this->load->view('patient_karma_other', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}
	public function getpatientby_investigation_date()
	{


		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		//////$end_date1   = $this->input->get('end_date', TRUE);
		$end_date1 = $start_date1;

		//$id   = $this->input->get('dept_id', TRUE);


		$start_date1 = date('Y-m-d', strtotime($start_date1));

		$end_date1 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);

		//print_r($section);



		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$date1 = date_create($start_date1);
		$date2 = date_create($end_date1);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '1';
		}


		$data['title'] = display('patient_list');

		if ($section == 'ipd') {
			$data['patients'] = $this->db->select('*')
				->from('patient_ipd')
				->join('department', 'department.dprt_id = patient_ipd.department_id')
				->where('ipd_opd', $section)
				//->where('discharge_date IS NULL')
				->where('create_date >=', $start_date)
				->where('create_date <=', $end_date)
				->where('create_date LIKE', $year)->get()->result();
			//print_r($this->db->last_query());
			//print_r($data['patients']);
		} else {
			$data['patients'] = $this->patient_model->read_by_investi_date($section = 'opd', $start_date, $end_date);
		}

		//  investigation add opd and ipd both
		//  $data['patients2'] = $this->patient_model->read_by_investi_date($section='ipd',$start_date,$end_date);
		//	$data['patients'] =array_merge($data['patients1'],$data['patients2']);

		$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {
			$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
				->from('patient')
				->join('department', 'patient.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				//->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)
				->group_by('department.name, patient.sex')
				->get()
				->result();


			$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
				->from('patient')
				->where('create_date LIKE', $year)
				// ->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {

			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				//->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '0000-00-00')
				//	->where('create_date >=', $end_date)

				->where('create_date <=', $end_date)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				//->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '0000-00-00')
				//->where('create_date >=', $end_date)

				->where('create_date <=', $end_date)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
		$data['department_by'] = 'dpt';
		//$data['department_id'] = $id;
		$data['section'] = $section;
		$data['content'] = $this->load->view('patient_investi', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function getpatientby_investigation_date_testwise()
	{


		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		//$end_date1   = $this->input->get('end_date', TRUE);
		$end_date1 = $start_date1;

		//$id   = $this->input->get('dept_id', TRUE);


		$start_date1 = date('Y-m-d', strtotime($start_date1));

		$end_date1 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);

		//print_r($section);



		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$date1 = date_create($start_date1);
		$date2 = date_create($end_date1);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '1';
		}


		$data['title'] = display('patient_list');

		if ($section == 'ipd') {
			$data['patients'] = $this->db->select('*')
				->from('patient_ipd')
				->join('department', 'department.dprt_id = patient_ipd.department_id')
				->where('ipd_opd', $section)
				//->where('discharge_date IS NULL')
				->where('create_date >=', $start_date)
				->where('create_date <=', $end_date)
				->where('create_date LIKE', $year)->get()->result();
			//print_r($this->db->last_query());
			//print_r($data['patients']);
		} else {
			$data['patients'] = $this->patient_model->read_by_investi_date($section = 'opd', $start_date, $end_date);
		}

		//  investigation add opd and ipd both
		//  $data['patients2'] = $this->patient_model->read_by_investi_date($section='ipd',$start_date,$end_date);
		//	$data['patients'] =array_merge($data['patients1'],$data['patients2']);

		$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {
			$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
				->from('patient')
				->join('department', 'patient.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				//->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)
				->group_by('department.name, patient.sex')
				->get()
				->result();


			$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
				->from('patient')
				->where('create_date LIKE', $year)
				// ->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {

			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				//->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '0000-00-00')
				//	->where('create_date >=', $end_date)

				->where('create_date <=', $end_date)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				//->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '0000-00-00')
				//->where('create_date >=', $end_date)

				->where('create_date <=', $end_date)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
		$data['department_by'] = 'dpt';
		//$data['department_id'] = $id;
		$date['section'] = $section;
		$data['content'] = $this->load->view('patient_investi_testwise', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function getpatientby_investigation_date_ecg()
	{


		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);
		//$id   = $this->input->get('dept_id', TRUE);


		$start_date1 = date('Y-m-d', strtotime($start_date1));

		$end_date1 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);


		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$date1 = date_create($start_date1);
		$date2 = date_create($end_date1);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '0';
		}


		$data['title'] = display('patient_list');
		$data['patients1'] = $this->patient_model->read_by_investi_date($section = 'opd', $start_date, $end_date);
		$data['patients2'] = $this->patient_model->read_by_investi_date($section = 'ipd', $start_date, $end_date);
		$data['patients'] = array_merge($data['patients1'], $data['patients2']);

		$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {
			$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
				->from('patient')
				->join('department', 'patient.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				//->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)
				->group_by('department.name, patient.sex')
				->get()
				->result();


			$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
				->from('patient')
				->where('create_date LIKE', $year)
				// ->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {

			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				//->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '0000-00-00')
				//	->where('create_date >=', $end_date)

				->where('create_date <=', $end_date)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				//->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '0000-00-00')
				//->where('create_date >=', $end_date)

				->where('create_date <=', $end_date)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
		$data['department_by'] = 'dpt';
		//$data['department_id'] = $id;

		$data['content'] = $this->load->view('patient_investi_ecg', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function getpatientby_investigation_date_xay()
	{


		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);
		//$id   = $this->input->get('dept_id', TRUE);


		$start_date1 = date('Y-m-d', strtotime($start_date1));

		$end_date1 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);


		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$date1 = date_create($start_date1);
		$date2 = date_create($end_date1);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '0';
		}


		$data['title'] = display('patient_list');
		$data['patients1'] = $this->patient_model->read_by_investi_date($section = 'opd', $start_date, $end_date);
		$data['patients2'] = $this->patient_model->read_by_investi_date($section = 'ipd', $start_date, $end_date);
		$data['patients'] = array_merge($data['patients1'], $data['patients2']);

		$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {




			$data['department_by_section'] = 'opd';
		} else {




			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
		$data['department_by'] = 'dpt';
		//$data['department_id'] = $id;

		$data['content'] = $this->load->view('patient_investi_xray', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function getpatientby_investigation_ceg()
	{


		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);

		$start_date1 = date('Y-m-d', strtotime($start_date1));
		$end_date1 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);


		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$date1 = date_create($start_date1);
		$date2 = date_create($end_date1);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '0';
		}


		$data['title'] = display('patient_list');
		$data['patients1'] = $this->patient_model->read_by_investi_date($section = 'opd', $start_date, $end_date);
		$data['patients2'] = $this->patient_model->read_by_investi_date($section = 'ipd', $start_date, $end_date);
		$data['patients'] = array_merge($data['patients1'], $data['patients2']);

		$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {

			$data['department_by_section'] = 'opd';
		} else {

			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
		$data['department_by'] = 'dpt';
		//$data['department_id'] = $id;

		$data['content'] = $this->load->view('patient_investi_ecg', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function Geriatric()
	{


		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);

		if ($start_date1) {

			$start_date1 = date('Y-m-d', strtotime($start_date1));
			$end_date1 = date('Y-m-d', strtotime($end_date1));
		} else {
			$start_date1 = date('Y-m-d');
			$end_date1 = date('Y-m-d');

		}
		$section = $this->input->get('section', TRUE);


		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$date1 = date_create($start_date1);
		$date2 = date_create($end_date1);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '1';
		}


		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_investi_date($section = 'opdd', $start_date, $end_date);


		$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {

			$data['department_by_section'] = 'opd';
		} else {

			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
		$data['department_by'] = 'dpt';
		//$data['department_id'] = $id;

		$data['content'] = $this->load->view('Geriatric', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function Skin()
	{


		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);

		if ($start_date1) {

			$start_date1 = date('Y-m-d', strtotime($start_date1));
			$end_date1 = date('Y-m-d', strtotime($end_date1));
		} else {
			$start_date1 = date('Y-m-d');
			$end_date1 = date('Y-m-d');

		}
		$section = $this->input->get('section', TRUE);


		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$date1 = date_create($start_date1);
		$date2 = date_create($end_date1);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '1';
		}


		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_investi_date($section = 'opdd', $start_date, $end_date);


		$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {

			$data['department_by_section'] = 'opd';
		} else {

			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
		$data['department_by'] = 'dpt';
		//$data['department_id'] = $id;

		$data['content'] = $this->load->view('Skin', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function National()
	{


		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);

		if ($start_date1) {

			$start_date1 = date('Y-m-d', strtotime($start_date1));
			$end_date1 = date('Y-m-d', strtotime($end_date1));
		} else {
			$start_date1 = date('Y-m-d');
			$end_date1 = date('Y-m-d');

		}
		$section = $this->input->get('section', TRUE);


		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$date1 = date_create($start_date1);
		$date2 = date_create($end_date1);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '1';
		}


		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_investi_date($section = 'opdd', $start_date, $end_date);


		$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {

			$data['department_by_section'] = 'opd';
		} else {

			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
		$data['department_by'] = 'dpt';
		//$data['department_id'] = $id;

		$data['content'] = $this->load->view('National', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function Manas()
	{


		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);

		if ($start_date1) {

			$start_date1 = date('Y-m-d', strtotime($start_date1));
			$end_date1 = date('Y-m-d', strtotime($end_date1));
		} else {
			$start_date1 = date('Y-m-d');
			$end_date1 = date('Y-m-d');

		}
		$section = $this->input->get('section', TRUE);


		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$date1 = date_create($start_date1);
		$date2 = date_create($end_date1);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '1';
		}


		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_investi_date($section = 'opdd', $start_date, $end_date);


		$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {

			$data['department_by_section'] = 'opd';
		} else {

			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
		$data['department_by'] = 'dpt';
		//$data['department_id'] = $id;

		$data['content'] = $this->load->view('Manas', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function getpatientby_investigation_xray()
	{


		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);

		$start_date1 = date('Y-m-d', strtotime($start_date1));
		$end_date1 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);


		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$date1 = date_create($start_date1);
		$date2 = date_create($end_date1);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '1';
		}


		$data['title'] = display('patient_list');
		$data['patients1'] = $this->patient_model->read_by_investi_date($section = 'opd', $start_date, $end_date);
		$data['patients2'] = $this->patient_model->read_by_investi_date($section = 'ipd', $start_date, $end_date);
		$data['patients'] = array_merge($data['patients1'], $data['patients2']);

		$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {

			$data['department_by_section'] = 'opd';
		} else {

			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
		$data['department_by'] = 'dpt';
		//$data['department_id'] = $id;

		$data['content'] = $this->load->view('patient_investi_xray', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function getpatientbydepartment_date()
	{


		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		//$end_date1   = $this->input->get('end_date', TRUE);
		$end_date1 = $start_date1;
		$id = $this->input->get('dept_id', TRUE);


		$start_date1 = date('Y-m-d', strtotime($start_date1));

		$end_date1 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);
		$data['section'] = $section;

		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;


		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id_date($id, $section, $start_date, $end_date);



		$section = $section;


		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {
			$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
				->from('patient')
				->join('department', 'patient.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)
				->group_by('department.name, patient.sex')
				->get()
				->result();


			$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
				->from('patient')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {

			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '0000-00-00')
				//	->where('create_date >=', $end_date)

				->where('create_date <=', $end_date)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '0000-00-00')
				//->where('create_date >=', $end_date)

				->where('create_date <=', $end_date)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
		$data['department_by'] = 'dpt';
		$data['department_id'] = $id;
		$data['getpatientbydepartment_date'] = 'D';
		$data['section'] = $section;
		$data['content'] = $this->load->view('patient', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}


	public function getpatientbydepartment_date1()
	{
		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);
		$id = $this->input->get('dept_id', TRUE);

		$start_date1 = date('Y-m-d', strtotime($start_date1));
		$end_date1 = date('Y-m-d', strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id_date($id, $section, $start_date, $end_date);
		$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';
		if ($section == 'opd') {
			$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
				->from('patient')
				->join('department', 'patient.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)
				->where('create_date <=', $end_date)
				->group_by('department.name, patient.sex')
				->get()
				->result();
			$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
				->from('patient')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)
				->where('create_date <=', $end_date)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {

			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '0000-00-00')
				->where('create_date <=', $end_date)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();
			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '0000-00-00')
				->where('create_date <=', $end_date)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
		$data['department_by'] = 'dpt';
		$data['department_id'] = $id;
		$data['getpatientbydepartment_date'] = 'D';
		$data['section'] = $section;
		$data['content'] = $this->load->view('patientgob_new', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}


	public function getpatientbydepartment_admit_register_date()
	{


		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);
		$id = $this->input->get('dept_id', TRUE);


		$start_date1 = date('Y-m-d', strtotime($start_date1));

		$end_date1 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);


		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;


		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id_admit_register_date($id, $section, $start_date, $end_date);



		$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {

			$data['department_by_section'] = 'opd';
		} else {

			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
		$data['department_by'] = 'dpt';
		$data['department_id'] = $id;
		$data['getpatientbydepartment_date'] = 'D';

		$data['content'] = $this->load->view('patient_amit_register', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}


	public function getpatientbydepartment_date_sky()
	{


		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		//$end_date1   = $this->input->get('end_date', TRUE);
		$end_date1 = $start_date1;
		$id = $this->input->get('dept_id', TRUE);


		$start_date1 = date('Y-m-d', strtotime($start_date1));

		$end_date1 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);


		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;


		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id_date($id, $section, $start_date, $end_date);



		$section = $section;
		$data['section'] = $section;
		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {
			$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
				->from('patient')
				->join('department', 'patient.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)
				->group_by('department.name, patient.sex')
				->get()
				->result();


			$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
				->from('patient')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {

			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '0000-00-00')
				//	->where('create_date >=', $end_date)

				->where('create_date <=', $end_date)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '0000-00-00')
				//->where('create_date >=', $end_date)

				->where('create_date <=', $end_date)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
		$data['department_by'] = 'dpt';
		$data['department_id'] = $id;

		$data['content'] = $this->load->view('patient_sky', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}


	public function getpatientbydepartment_date_sky1()
	{


		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);
		//$end_date1 = $start_date1;
		$id = $this->input->get('dept_id', TRUE);


		$start_date1 = date('Y-m-d', strtotime($start_date1));

		$end_date1 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);


		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;


		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id_date($id, $section, $start_date, $end_date);
		//print_r($this->db->last_query());


		$section = $section;
		//$data['section'] = $section;
		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {
			$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
				->from('patient')
				->join('department', 'patient.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)
				->group_by('department.name, patient.sex')
				->get()
				->result();


			$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
				->from('patient')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {

			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '0000-00-00')
				//	->where('create_date >=', $end_date)

				->where('create_date <=', $end_date)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '0000-00-00')
				//->where('create_date >=', $end_date)

				->where('create_date <=', $end_date)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
		$data['department_by'] = 'dpt';
		$data['department_id'] = $id;

		$data['content'] = $this->load->view('patient_sky1', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function dischargedate($discharge_date, $yearly_reg_no)
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$section = 'ipd';

		$q = $this->db->select('*')
			->from('patient')
			->where('yearly_reg_no', $yearly_reg_no)
			->where('ipd_opd', $section)
			->or_where('old_reg_no', $yearly_reg_no)->get()->result();

		$registration1 = $q[0]->old_reg_no;
		$registration2 = $q[0]->yearly_reg_no;

		//Check registration value
		if ($registration2 != null) {


			$data = array(
				'discharge_date' => $discharge_date,
			);

			$this->db->where('yearly_reg_no', $registration2);
			$this->db->where('ipd_opd', $section);
			$this->db->where('create_date LIKE', $year);
			$this->db->update('patient', $data);

			print_r($registration2);

		} else {

			//$registration = $registration1;			
			$data = array(
				'discharge_date' => $discharge_date,
			);

			$this->db->where('old_reg_no', $registration1);
			$this->db->where('ipd_opd', $section);
			$this->db->where('create_date LIKE', $year);
			$this->db->update('patient', $data);

			print_r($registration1);

		}

	}



	public function admitpatient()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);
		$date = "";
		$start = date('Y-m-d', strtotime("+ 5 days"));
		$end = date('Y-m-d', strtotime("+ 5 days"));

		$start_date = date('Y-m-d', strtotime($start_date1)) . " 00:00:00";
		$end_date = date('Y-m-d', strtotime($end_date1)) . " 23:59:00";
		$section = $this->input->get('section', TRUE);

		$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));

		$data['patients'] = $this->db->select('*')
			->from('patient_ipd')
			->join('department', 'department.dprt_id = patient_ipd.department_id')
			->where('ipd_opd', $section)
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('create_date LIKE', $year)->get()->result();

		$data['gendercount'] = $this->db->select('department.name,patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
			->from('patient_ipd')
			->join('department', 'patient_ipd.department_id = department.dprt_id')
			->where('create_date LIKE', $year)
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)
			->group_by('department.name, patient_ipd.sex')
			->get()
			->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
			->from('patient_ipd')
			->where('create_date LIKE', $year)
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)
			->get()
			->result();

		$data['department_list'] = $this->department_model->department_list();
		$data['content'] = $this->load->view('admitpatient', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	// Admit Patient Date Filter

	public function admitpatientdate()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);

		$date = "";
		$start = date('Y-m-d', strtotime($start_date1));
		$end = date('Y-m-d', strtotime($end_date1));

		$start_date = date('Y-m-d', strtotime($start_date1)) . " 00:00:00";

		$end_date = date('Y-m-d', strtotime($end_date1)) . " 23:59:00";

		$section = $this->input->get('section', TRUE);

		$data['datefrom'] = $start;
		$data['dateto'] = $end;

		$data['patients'] = $this->db->select('*')
			->from('patient_ipd')
			->join('department', 'department.dprt_id = patient_ipd.department_id')
			->where('ipd_opd', $section)
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('create_date LIKE', $year)->get()->result();


		$data['gendercount'] = $this->db->select('department.name,patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
			->from('patient_ipd')
			->join('department', 'patient_ipd.department_id = department.dprt_id')
			->where('create_date LIKE', $year)
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)
			->group_by('department.name, patient_ipd.sex')
			->get()
			->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
			->from('patient_ipd')
			->where('create_date LIKE', $year)
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('ipd_opd', $section)
			->get()
			->result();

		$data['department_list'] = $this->department_model->department_list();
		$data['content'] = $this->load->view('admitpatient', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}

	//Discharge Patient Date 
	public function patientdischargedate()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);
		$start_date = date('Y-m-d', strtotime("+ 5 days"));
		$end_date = date('Y-m-d', strtotime("+ 5 days"));
		$start_date12 = $start_date . " 00:00:00";
		$end_date12 = $end_date . " 23:59:00";

		$section = 'ipd';
		$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));

		$data['patients'] = $this->db->select("*")
			->from('patient_ipd')
			->join('department', 'department.dprt_id = patient_ipd.department_id')
			->where('ipd_opd', $section)
			->where('discharge_date >=', $start_date12)
			->where('discharge_date <=', $end_date12)
			->get()
			->result();

		$data['gendercount'] = $this->db->select('department.name,patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
			->from('patient_ipd')
			->join('department', 'patient_ipd.department_id = department.dprt_id')
			->where('create_date LIKE', $year)
			->where('discharge_date >=', $start_date)
			->where('discharge_date <=', $end_date)
			->where('ipd_opd', $section)
			->group_by('department.name, patient_ipd.sex')
			->get()
			->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
			->from('patient_ipd')
			->where('create_date LIKE', $year)
			->where('discharge_date >=', $start_date)
			->where('discharge_date <=', $end_date)
			->where('ipd_opd', $section)
			->get()
			->result();

		if ($data == null) {
			$data['content'] = $this->load->view('patientdischargedate', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		} else {
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patientdischargedate', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}

	}

	public function patientdischargebydate()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);



		$start_date = date('Y-m-d', strtotime($start_date1));

		$end_date = date('Y-m-d', strtotime($end_date1));

		$start_date12 = $start_date;

		$end_date12 = $end_date;

		//$section = $this->input->get('section', TRUE);

		$section = 'ipd';
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;


		//echo $section;

		$data['patients'] = $this->db->select("*")

			->from('patient_ipd')

			->join('department', 'department.dprt_id = patient_ipd.department_id')

			->where('ipd_opd', $section)

			->where('discharge_date >=', $start_date12)

			->where('discharge_date <=', $end_date12)

			//->where('create_date LIKE', $year)

			->get()

			->result();



		if ($data == null) {
			$data['content'] = $this->load->view('patientdischargedate', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		} else {
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patientdischargedate', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}

	}

	//Occupancy Patient Date 
	public function patientoccupancy()
	{


		$start_date1 = $this->input->get('start_date', TRUE);
		//$end_date1   = $this->input->get('end_date', TRUE);
		$end_date1 = $start_date1;
		$end_date = date('Y-m-d', strtotime($end_date1));
		$year = '%' . $this->session->userdata['acyear'] . '%';
		$section = 'ipd';
		$data['section'] = $section;
		$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));


		//echo $section;
		if ($end_date1) {
			$data['patients'] = $this->db->select("*")
				->from('patient_ipd')
				->where('create_date <=', $end_date)
				->join('department', 'department.dprt_id = patient_ipd.department_id')
				->where('ipd_opd', $section)
				//	->where('discharge_date LIKE', '0000-00-00')
				//->where('discharge_date IS NULL',  null)
				//	->where('create_date LIKE', $year)
				->get()
				->result();

			// print_r($data['patients']);   exit;


			$data['gendercount'] = $this->db->select('department.name,patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->where('create_date <=', $end_date)
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('discharge_date LIKE', '0000-00-00')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date <=', $end_date)
				->where('discharge_date LIKE', '0000-00-00')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
		} else {

			$data['patients'] = $this->db->select("*")
				->from('patient_ipd')
				->join('department', 'department.dprt_id = patient_ipd.department_id')
				->where('ipd_opd', $section)

				//	->where('discharge_date is NULL', NULL, TRUE)
				->where('discharge_date LIKE', '0000-00-00')
				//->where('create_date LIKE', $year)
				->get()
				->result();


			$data['gendercount'] = $this->db->select('department.name,patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('discharge_date LIKE', '0000-00-00')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('discharge_date LIKE', '0000-00-00')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
		}

		//$data['patients'] = $this->patient_model->read_by_section_date($getData);
		if ($data == null) {
			$data['content'] = $this->load->view('patientoccupancy', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		} else {
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patientoccupancy', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}

	}

	public function patientoccupancybydate11()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);


		$start_date2 = date('Y-m-d', strtotime($start_date1));

		$end_date2 = date('Y-m-d', strtotime($end_date1));

		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";

		$section = $this->input->get('section', TRUE);


		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$null = NULL;

		//echo $section;

		$data['patients1'] = $this->db->select("*")

			->from('patient')

			->join('department', 'department.dprt_id = patient.department_id')

			//	->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('ipd_opd', $section)
			->where('discharge_date LIKE', '%0000-00-00%')
			//	->or_where('discharge_date', $start_date)

			//	->where('create_date LIKE', $year)

			->get()

			->result();

		//Array 2
		$data['patients2'] = $this->db->select("*")

			->from('patient')

			->join('department', 'department.dprt_id = patient.department_id')

			//->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			//->where('discharge_date =', NULL)
			->where('discharge_date LIKE', '0000-00-00')

			->where('ipd_opd', $section)

			->get()

			->result();


		$data['patients'] = array_merge($data['patients1'], $data['patients2']);


		//Count Array 

		$data['gendercount'] = $this->db->select('department.name,patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
			->from('patient')
			->join('department', 'patient.department_id = department.dprt_id')

			// ->where('discharge_date >=', $start_date)
			//	->where('discharge_date =', NULL)
			//	->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('discharge_date LIKE', '0000-00-00')
			->where('ipd_opd', $section)
			->where('create_date LIKE', $year)
			->group_by('department.name, patient.sex')
			->get()
			->result();

		// $data['gendercount2'] = $this->db->select('department.name,patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
		// ->from('patient')
		// ->join('department', 'patient.department_id = department.dprt_id')
		// ->where('ipd_opd', $section)
		// ->where('discharge_date >=', $start_date)
		// ->where('create_date <=', $start_date)
		// // ->or_where('discharge_date =', NULL)
		// ->where('create_date LIKE', $year)
		// ->group_by('department.name, patient.sex')
		// ->get()
		// ->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
			->from('patient')

			//->where('discharge_date =', NULL)
			//	->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('discharge_date LIKE', '0000-00-00')
			->where('ipd_opd', $section)
			// ->or_where('discharge_date =', NULL)
			->where('create_date LIKE', $year)
			->get()
			->result();

		// print_r($data['patients']);
		// die();

		//$data['patients'] = $this->patient_model->read_by_section_date($getData);
		if ($data == null) {
			$data['content'] = $this->load->view('patientoccupancy', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		} else {
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patientoccupancy', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}

	}

	public function patientoccupancybydate()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);


		$start_date2 = date('Y-m-d', strtotime($start_date1));

		$end_date2 = date('Y-m-d', strtotime($end_date1));

		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";

		$section = $this->input->get('section', TRUE);


		$data['datefrom'] = $start_date2;
		$data['dateto'] = $end_date2;

		$null = NULL;

		//echo $section;

		$data['patients1'] = $this->db->select("*")

			->from('patient_ipd')

			->join('department', 'department.dprt_id = patient_ipd.department_id')

			->where('discharge_date >=', $start_date_f)

			->where('create_date <=', $start_date_f)

			->where('ipd_opd', $section)
			//	->or_where('discharge_date', $start_date)

			//	->where('create_date LIKE', $year)

			->get()

			->result();



		//Array 2
		$data['patients2'] = $this->db->select("*")

			->from('patient_ipd')

			->join('department', 'department.dprt_id = patient_ipd.department_id')

			->where('create_date <=', $start_date_f)

			->where('discharge_date LIKE', '%0000-00-00%')

			->where('ipd_opd', $section)

			->get()

			->result();


		$data['patients'] = array_merge($data['patients1'], $data['patients2']);


		//Count Array 

		$data['gendercount'] = $this->db->select('department.name,patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
			->from('patient_ipd')
			->join('department', 'patient_ipd.department_id = department.dprt_id')
			->where('ipd_opd', $section)
			// ->where('discharge_date >=', $start_date)
			->where('discharge_date =', '0000-00-00')
			->where('create_date <=', $start_date)
			// ->or_where('discharge_date =', NULL)
			->where('create_date LIKE', $year)
			->group_by('department.name, patient_ipd.sex')
			->get()
			->result();

		// $data['gendercount2'] = $this->db->select('department.name,patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
		// ->from('patient')
		// ->join('department', 'patient.department_id = department.dprt_id')
		// ->where('ipd_opd', $section)
		// ->where('discharge_date >=', $start_date)
		// ->where('create_date <=', $start_date)
		// // ->or_where('discharge_date =', NULL)
		// ->where('create_date LIKE', $year)
		// ->group_by('department.name, patient.sex')
		// ->get()
		// ->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
			->from('patient_ipd')
			->where('ipd_opd', $section)
			->where('discharge_date =', '0000-00-00')
			->where('create_date <=', $start_date)
			// ->or_where('discharge_date =', NULL)
			->where('create_date LIKE', $year)
			->get()
			->result();

		// print_r($data['patients']);
		// die();

		//$data['patients'] = $this->patient_model->read_by_section_date($getData);
		if ($data == null) {
			$data['content'] = $this->load->view('patientoccupancy', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		} else {
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patientoccupancy', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}

	}

	public function getpatientby_month($section = '')
	{
		//echo error_reporting(0);
		error_reporting(0);
		ini_set('memory_limit', '-1');

		$data['title'] = display('Monthly Report');
		$year = '%' . $this->session->userdata['acyear'] . '%';
		$patients = $this->patient_model->read_by_dept_month($section, $year);
		$department = $this->patient_model->get_all_dept();

		$year = '%' . $this->session->userdata['acyear'] . '%';

		$vi_28_jan = 0;
		$vi_28_feb = 0;
		$vi_28_march = 0;
		$vi_28_april = 0;
		$vi_28_may = 0;
		$vi_28_june = 0;
		$vi_28_jully = 0;
		$vi_28_aguest = 0;
		$vi_28_sebt = 0;
		$vi_28_octo = 0;
		$vi_28_nove = 0;
		$vi_28_desm = 0;
		$sw_28_jan = 0;
		$sw_28_feb = 0;
		$sw_28_march = 0;
		$sw_28_april = 0;
		$sw_28_may = 0;
		$sw_28_june = 0;
		$sw_28_jully = 0;
		$sw_28_aguest = 0;
		$sw_28_sebt = 0;
		$sw_28_octo = 0;
		$sw_28_nove = 0;
		$sw_28_desm = 0;
		$str_28_jan = 0;
		$str_28_feb = 0;
		$str_28_march = 0;
		$str_28_april = 0;
		$str_28_may = 0;
		$str_28_june = 0;
		$str_28_jully = 0;
		$str_28_aguest = 0;
		$str_28_sebt = 0;
		$str_28_octo = 0;
		$str_28_nove = 0;
		$str_28_desm = 0;
		$sky_28_jan = 0;
		$sky_28_feb = 0;
		$sky_28_march = 0;
		$sky_28_april = 0;
		$sky_28_may = 0;
		$sky_28_june = 0;
		$sky_28_jully = 0;
		$sky_28_aguest = 0;
		$sky_28_sebt = 0;
		$sky_28_octo = 0;
		$sky_28_nove = 0;
		$sky_28_desm = 0;
		$sly_28_jan = 0;
		$sly_28_feb = 0;
		$sly_28_march = 0;
		$sly_28_april = 0;
		$sly_28_may = 0;
		$sly_28_june = 0;
		$sly_28_jully = 0;
		$sly_28_aguest = 0;
		$sly_28_sebt = 0;
		$sly_28_octo = 0;
		$sly_28_nove = 0;
		$sly_28_desm = 0;

		$bal_28_jan = 0;
		$bal_28_feb = 0;
		$bal_28_march = 0;
		$bal_28_april = 0;
		$bal_28_may = 0;
		$bal_28_june = 0;
		$bal_28_jully = 0;
		$bal_28_aguest = 0;
		$bal_28_sebt = 0;
		$bal_28_octo = 0;
		$bal_28_nove = 0;
		$bal_28_desm = 0;
		$pan_28_jan = 0;
		$pan_28_feb = 0;
		$pan_28_march = 0;
		$pan_28_april = 0;
		$pan_28_may = 0;
		$pan_28_june = 0;
		$pan_28_jully = 0;
		$pan_28_aguest = 0;
		$pan_28_sebt = 0;
		$pan_28_octo = 0;
		$pan_28_nove = 0;
		$pan_28_desm = 0;
		$kay_28_jan = 0;
		$kay_28_feb = 0;
		$kay_28_march = 0;
		$kay_28_april = 0;
		$kay_28_may = 0;
		$kay_28_june = 0;
		$kay_28_jully = 0;
		$kay_28_aguest = 0;
		$kay_28_sebt = 0;
		$kay_28_octo = 0;
		$kay_28_nove = 0;
		$kay_28_desm = 0;
		$aty_28_jan = 0;
		$aty_28_feb = 0;
		$aty_28_march = 0;
		$aty_28_april = 0;
		$aty_28_may = 0;
		$aty_28_june = 0;
		$aty_28_jully = 0;
		$aty_28_aguest = 0;
		$aty_28_sebt = 0;
		$aty_28_octo = 0;
		$aty_28_nove = 0;
		$aty_28_desm = 0;
		for ($i = 0; $i < count($patients); $i++) {


			$month_no = date('m', strtotime($patients[$i]->create_date));

			if ($patients[$i]->department_id == '27') {
				if ($month_no == '01') {
					$vi_28_jan++;
				} elseif ($month_no == '02') {
					$vi_28_feb++;
				} elseif ($month_no == '03') {
					$vi_28_march++;
				} elseif ($month_no == '04') {
					$vi_28_april++;
				} elseif ($month_no == '05') {
					$vi_28_may++;
				} elseif ($month_no == '06') {
					$vi_28_june++;
				} elseif ($month_no == '07') {
					$vi_28_jully++;
				} elseif ($month_no == '08') {
					$vi_28_aguest++;
				} elseif ($month_no == '09') {
					$vi_28_sebt++;
				} elseif ($month_no == '10') {
					$vi_28_octo++;
				} elseif ($month_no == '11') {
					$vi_28_nove++;
				} else {
					$vi_28_desm++;
				}

			} elseif ($patients[$i]->department_id == '28') {
				if ($month_no == '01') {
					$sw_28_jan++;
				} elseif ($month_no == '02') {
					$sw_28_feb++;
				} elseif ($month_no == '03') {
					$sw_28_march++;
				} elseif ($month_no == '04') {
					$sw_28_april++;
				} elseif ($month_no == '05') {
					$sw_28_may++;
				} elseif ($month_no == '06') {
					$sw_28_june++;
				} elseif ($month_no == '07') {
					$sw_28_jully++;
				} elseif ($month_no == '08') {
					$sw_28_aguest++;
				} elseif ($month_no == '09') {
					$sw_28_sebt++;
				} elseif ($month_no == '10') {
					$sw_28_octo++;
				} elseif ($month_no == '11') {
					$sw_28_nove++;
				} else {
					$sw_28_desm++;
				}

			} elseif ($patients[$i]->department_id == '29') {
				if ($month_no == '01') {
					$str_28_jan++;
				} elseif ($month_no == '02') {
					$str_28_feb++;
				} elseif ($month_no == '03') {
					$str_28_march++;
				} elseif ($month_no == '04') {
					$str_28_april++;
				} elseif ($month_no == '05') {
					$str_28_may++;
				} elseif ($month_no == '06') {
					$str_28_june++;
				} elseif ($month_no == '07') {
					$str_28_jully++;
				} elseif ($month_no == '08') {
					$str_28_aguest++;
				} elseif ($month_no == '09') {
					$str_28_sebt++;
				} elseif ($month_no == '10') {
					$str_28_octo++;
				} elseif ($month_no == '11') {
					$str_28_nove++;
				} else {
					$str_28_desm++;
				}

			} elseif ($patients[$i]->department_id == '30') {
				if ($month_no == '01') {
					$sky_28_jan++;
				} elseif ($month_no == '02') {
					$sky_28_feb++;
				} elseif ($month_no == '03') {
					$sky_28_march++;
				} elseif ($month_no == '04') {
					$sky_28_april++;
				} elseif ($month_no == '05') {
					$sky_28_may++;
				} elseif ($month_no == '06') {
					$sky_28_june++;
				} elseif ($month_no == '07') {
					$sky_28_jully++;

				} elseif ($month_no == '08') {
					$sky_28_aguest++;
				} elseif ($month_no == '09') {
					$sky_28_sebt++;
				} elseif ($month_no == '10') {
					$sky_28_octo++;
				} elseif ($month_no == '11') {
					$sky_28_nove++;
				} else {
					$sky_28_desm++;
				}
			} elseif ($patients[$i]->department_id == '31') {

				if ($month_no == '01') {
					$sly_28_jan++;
				} elseif ($month_no == '02') {
					$sly_28_feb++;
				} elseif ($month_no == '03') {
					$sly_28_march++;
				} elseif ($month_no == '04') {
					$sly_28_april++;
				} elseif ($month_no == '05') {
					$sly_28_may++;
				} elseif ($month_no == '06') {
					$sly_28_june++;
				} elseif ($month_no == '07') {
					$sly_28_jully++;

				} elseif ($month_no == '08') {
					$sly_28_aguest++;
				} elseif ($month_no == '09') {
					$sly_28_sebt++;
				} elseif ($month_no == '10') {
					$sly_28_octo++;
				} elseif ($month_no == '11') {
					$sly_28_nove++;
				} else {
					$sly_28_desm++;
				}
			} elseif ($patients[$i]->department_id == '32') {
				if ($month_no == '01') {
					$bal_28_jan++;
				} elseif ($month_no == '02') {
					$bal_28_feb++;
				} elseif ($month_no == '03') {
					$bal_28_march++;
				} elseif ($month_no == '04') {
					$bal_28_april++;
				} elseif ($month_no == '05') {
					$bal_28_may++;
				} elseif ($month_no == '06') {
					$bal_28_june++;
				} elseif ($month_no == '07') {
					$bal_28_jully++;

				} elseif ($month_no == '08') {
					$bal_28_aguest++;
				} elseif ($month_no == '09') {
					$bal_28_sebt++;
				} elseif ($month_no == '10') {
					$bal_28_octo++;
				} elseif ($month_no == '11') {
					$bal_28_nove++;
				} else {
					$bal_28_desm++;
				}
			} elseif ($patients[$i]->department_id == '33') {
				if ($month_no == '01') {
					$pan_28_jan++;
				} elseif ($month_no == '02') {
					$pan_28_feb++;
				} elseif ($month_no == '03') {
					$pan_28_march++;
				} elseif ($month_no == '04') {
					$pan_28_april++;
				} elseif ($month_no == '05') {
					$pan_28_may++;
				} elseif ($month_no == '06') {
					$pan_28_june++;
				} elseif ($month_no == '07') {
					$pan_28_jully++;

				} elseif ($month_no == '08') {
					$pan_28_aguest++;
				} elseif ($month_no == '09') {
					$pan_28_sebt++;
				} elseif ($month_no == '10') {
					$pan_28_octo++;
				} elseif ($month_no == '11') {
					$pan_28_nove++;
				} else {
					$pan_28_desm++;
				}

			} elseif ($patients[$i]->department_id == '34') {
				if ($month_no == '01') {
					$kay_28_jan++;
				} elseif ($month_no == '02') {
					$kay_28_feb++;
				} elseif ($month_no == '03') {
					$kay_28_march++;
				} elseif ($month_no == '04') {
					$kay_28_april++;
				} elseif ($month_no == '05') {
					$kay_28_may++;
				} elseif ($month_no == '06') {
					$kay_28_june++;
				} elseif ($month_no == '07') {
					$kay_28_jully++;

				} elseif ($month_no == '08') {
					$kay_28_aguest++;
				} elseif ($month_no == '09') {
					$kay_28_sebt++;
				} elseif ($month_no == '10') {
					$kay_28_octo++;
				} elseif ($month_no == '11') {
					$kay_28_nove++;
				} else {
					$kay_28_desm++;
				}
			} elseif ($patients[$i]->department_id == '35') {
				if ($month_no == '01') {
					$aty_28_jan++;
				} elseif ($month_no == '02') {
					$aty_28_feb++;
				} elseif ($month_no == '03') {
					$aty_28_march++;
				} elseif ($month_no == '04') {
					$aty_28_april++;
				} elseif ($month_no == '05') {
					$aty_28_may++;
				} elseif ($month_no == '06') {
					$aty_28_june++;
				} elseif ($month_no == '07') {
					$aty_28_jully++;

				} elseif ($month_no == '08') {
					$aty_28_aguest++;
				} elseif ($month_no == '09') {
					$aty_28_sebt++;
				} elseif ($month_no == '10') {
					$aty_28_octo++;
				} elseif ($month_no == '11') {
					$aty_28_nove++;
				} else {
					$aty_28_desm++;
				}

			}



		}
		$data['VI'] = array($vi_28_jan, $vi_28_feb, $vi_28_march, $vi_28_april, $vi_28_may, $vi_28_june, $vi_28_jully, $vi_28_aguest, $vi_28_sebt, $vi_28_octo, $vi_28_nove, $vi_28_desm);
		$data['SW'] = array($sw_28_jan, $sw_28_feb, $sw_28_march, $sw_28_april, $sw_28_may, $sw_28_june, $sw_28_jully, $sw_28_aguest, $sw_28_sebt, $sw_28_octo, $sw_28_nove, $sw_28_desm);
		$data['STR'] = array($str_28_jan, $str_28_feb, $str_28_march, $str_28_april, $str_28_may, $str_28_june, $str_28_jully, $str_28_aguest, $str_28_sebt, $str_28_octo, $str_28_nove, $str_28_desm);
		$data['SKY'] = array($sky_28_jan, $sky_28_feb, $sky_28_march, $sky_28_april, $sky_28_may, $sky_28_june, $sky_28_jully, $sky_28_aguest, $sky_28_sebt, $sky_28_octo, $sky_28_nove, $sky_28_desm);
		$data['SLY'] = array($sly_28_jan, $sly_28_feb, $sly_28_march, $sly_28_april, $sly_28_may, $sly_28_june, $sly_28_jully, $sly_28_aguest, $sly_28_sebt, $sly_28_octo, $sly_28_nove, $sly_28_desm);
		$data['BAL'] = array($bal_28_jan, $bal_28_feb, $bal_28_march, $bal_28_april, $bal_28_may, $bal_28_june, $bal_28_jully, $bal_28_aguest, $bal_28_sebt, $bal_28_octo, $bal_28_nove, $bal_28_desm);
		$data['PAN'] = array($pan_28_jan, $pan_28_feb, $pan_28_march, $pan_28_april, $pan_28_may, $pan_28_june, $pan_28_jully, $pan_28_aguest, $pan_28_sebt, $pan_28_octo, $pan_28_nove, $pan_28_desm);
		$data['KAY'] = array($kay_28_jan, $kay_28_feb, $kay_28_march, $kay_28_april, $kay_28_may, $kay_28_june, $kay_28_jully, $kay_28_aguest, $kay_28_sebt, $kay_28_octo, $kay_28_nove, $kay_28_desm);
		$data['ATY'] = array($aty_28_jan, $aty_28_feb, $aty_28_march, $aty_28_april, $aty_28_may, $aty_28_june, $aty_28_jully, $aty_28_aguest, $aty_28_sebt, $aty_28_octo, $aty_28_nove, $aty_28_desm);


		if ($section == 'opd') {
			$data['jan'] = array($vi_28_jan, $sw_28_jan, $str_28_jan, $sky_28_jan, $sly_28_jan, $bal_28_jan, $pan_28_jan, $kay_28_jan, $aty_28_jan);
			$data['feb'] = array($vi_28_feb, $sw_28_feb, $str_28_feb, $sky_28_feb, $sly_28_feb, $bal_28_feb, $pan_28_feb, $kay_28_feb, $aty_28_feb);

			$data['march'] = array($vi_28_march, $sw_28_march, $str_28_march, $sky_28_march, $sly_28_march, $bal_28_march, $pan_28_march, $kay_28_march, $aty_28_march);
			$data['april'] = array($vi_28_april, $sw_28_april, $str_28_april, $sky_28_april, $sly_28_april, $bal_28_april, $pan_28_april, $kay_28_april, $aty_28_april);
			$data['may'] = array($vi_28_may, $sw_28_may, $str_28_may, $sky_28_may, $sly_28_may, $bal_28_may, $pan_28_may, $kay_28_may, $aty_28_may);

			$data['june'] = array($vi_28_june, $sw_28_june, $str_28_june, $sky_28_june, $sly_28_june, $bal_28_june, $pan_28_june, $kay_28_june, $aty_28_june);
			$data['jully'] = array($vi_28_jully, $sw_28_jully, $str_28_jully, $sky_28_jully, $sly_28_jully, $bal_28_jully, $pan_28_jully, $kay_28_jully, $aty_28_jully);
			$data['aguest'] = array($vi_28_aguest, $sw_28_aguest, $str_28_aguest, $sky_28_aguest, $sly_28_aguest, $bal_28_aguest, $pan_28_aguest, $kay_28_aguest, $aty_28_aguest);
			$data['sebt'] = array($vi_28_sebt, $sw_28_sebt, $str_28_sebt, $sky_28_sebt, $sly_28_sebt, $bal_28_sebt, $pan_28_sebt, $kay_28_sebt, $aty_28_sebt);

			$data['octo'] = array($vi_28_octo, $sw_28_octo, $str_28_octo, $sky_28_octo, $sly_28_octo, $bal_28_octo, $pan_28_octo, $kay_28_octo, $aty_28_octo);
			$data['nove'] = array($vi_28_nove, $sw_28_nove, $str_28_nove, $sky_28_nove, $sly_28_nove, $bal_28_nove, $pan_28_nove, $kay_28_nove, $aty_28_nove);
			$data['desm'] = array($vi_28_desm, $sw_28_desm, $str_28_desm, $sky_28_desm, $sly_28_desm, $bal_28_desm, $pan_28_desm, $kay_28_desm, $aty_28_desm);
			$data['department'] = $this->patient_model->get_all_dept();
		} else {
			$data['jan'] = array($vi_28_jan, $str_28_jan, $sky_28_jan, $sly_28_jan, $bal_28_jan, $pan_28_jan, $kay_28_jan);
			$data['feb'] = array($vi_28_feb, $str_28_feb, $sky_28_feb, $sly_28_feb, $bal_28_feb, $pan_28_feb, $kay_28_feb);

			$data['march'] = array($vi_28_march, $str_28_march, $sky_28_march, $sly_28_march, $bal_28_march, $pan_28_march, $kay_28_march);
			$data['april'] = array($vi_28_april, $str_28_april, $sky_28_april, $sly_28_april, $bal_28_april, $pan_28_april, $kay_28_april);
			$data['may'] = array($vi_28_may, $str_28_may, $sky_28_may, $sly_28_may, $bal_28_may, $pan_28_may, $kay_28_may);

			$data['june'] = array($vi_28_june, $str_28_june, $sky_28_june, $sly_28_june, $bal_28_june, $pan_28_june, $kay_28_june);
			$data['jully'] = array($vi_28_jully, $str_28_jully, $sky_28_jully, $sly_28_jully, $bal_28_jully, $pan_28_jully, $kay_28_jully);
			$data['aguest'] = array($vi_28_aguest, $str_28_aguest, $sky_28_aguest, $sly_28_aguest, $bal_28_aguest, $pan_28_aguest, $kay_28_aguest);
			$data['sebt'] = array($vi_28_sebt, $str_28_sebt, $sky_28_sebt, $sly_28_sebt, $bal_28_sebt, $pan_28_sebt, $kay_28_sebt);

			$data['octo'] = array($vi_28_octo, $str_28_octo, $sky_28_octo, $sly_28_octo, $bal_28_octo, $pan_28_octo, $kay_28_octo);
			$data['nove'] = array($vi_28_nove, $str_28_nove, $sky_28_nove, $sly_28_nove, $bal_28_nove, $pan_28_nove, $kay_28_nove);
			$data['desm'] = array($vi_28_desm, $str_28_desm, $sky_28_desm, $sly_28_desm, $bal_28_desm, $pan_28_desm, $kay_28_desm);
			$data['department'] = $this->db->where('dprt_id != ', '28')->where('dprt_id !=', '35')->get('department')->result();

		}
		$data['datefrom'] = '2019';
		$data['dateto'] = '2019';
		$data['section'] = $section;
		//   $data['department_id'] = $department_id_decode;

		$data['content'] = $this->load->view('patient_month_report', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function getpatientby_month_date()
	{
		echo error_reporting(0);
		$section = $this->input->post('section');
		$year_no = $this->input->post('year_no');
		$year = '%' . $year_no . '%';
		$data['title'] = display('Monthly Report');
		$patients = $this->patient_model->read_by_dept_month($section, $year);
		$department = $this->patient_model->get_all_dept();
		print_r($patients);
		exit;
		//$year = '%'.$year_no.'%';

		$sw_28_jan = 0;
		$sw_28_feb = 0;
		$sw_28_march = 0;
		$sw_28_april = 0;
		$sw_28_may = 0;
		$sw_28_june = 0;
		$sw_28_jully = 0;
		$sw_28_aguest = 0;
		$sw_28_sebt = 0;
		$sw_28_octo = 0;
		$sw_28_nove = 0;
		$sw_28_desm = 0;
		$str_28_jan = 0;
		$str_28_feb = 0;
		$str_28_march = 0;
		$str_28_april = 0;
		$str_28_may = 0;
		$str_28_june = 0;
		$str_28_jully = 0;
		$str_28_aguest = 0;
		$str_28_sebt = 0;
		$str_28_octo = 0;
		$str_28_nove = 0;
		$str_28_desm = 0;
		$sky_28_jan = 0;
		$sky_28_feb = 0;
		$sky_28_march = 0;
		$sky_28_april = 0;
		$sky_28_may = 0;
		$sky_28_june = 0;
		$sky_28_jully = 0;
		$sky_28_aguest = 0;
		$sky_28_sebt = 0;
		$sky_28_octo = 0;
		$sky_28_nove = 0;
		$sky_28_desm = 0;
		$sly_28_jan = 0;
		$sly_28_feb = 0;
		$sly_28_march = 0;
		$sly_28_april = 0;
		$sly_28_may = 0;
		$sly_28_june = 0;
		$sly_28_jully = 0;
		$sly_28_aguest = 0;
		$sly_28_sebt = 0;
		$sly_28_octo = 0;
		$sly_28_nove = 0;
		$sly_28_desm = 0;

		$bal_28_jan = 0;
		$bal_28_feb = 0;
		$bal_28_march = 0;
		$bal_28_april = 0;
		$bal_28_may = 0;
		$bal_28_june = 0;
		$bal_28_jully = 0;
		$bal_28_aguest = 0;
		$bal_28_sebt = 0;
		$bal_28_octo = 0;
		$bal_28_nove = 0;
		$bal_28_desm = 0;
		$pan_28_jan = 0;
		$pan_28_feb = 0;
		$pan_28_march = 0;
		$pan_28_april = 0;
		$pan_28_may = 0;
		$pan_28_june = 0;
		$pan_28_jully = 0;
		$pan_28_aguest = 0;
		$pan_28_sebt = 0;
		$pan_28_octo = 0;
		$pan_28_nove = 0;
		$pan_28_desm = 0;
		$kay_28_jan = 0;
		$kay_28_feb = 0;
		$kay_28_march = 0;
		$kay_28_april = 0;
		$kay_28_may = 0;
		$kay_28_june = 0;
		$kay_28_jully = 0;
		$kay_28_aguest = 0;
		$kay_28_sebt = 0;
		$kay_28_octo = 0;
		$kay_28_nove = 0;
		$kay_28_desm = 0;
		$aty_28_jan = 0;
		$aty_28_feb = 0;
		$aty_28_march = 0;
		$aty_28_april = 0;
		$aty_28_may = 0;
		$aty_28_june = 0;
		$aty_28_jully = 0;
		$aty_28_aguest = 0;
		$aty_28_sebt = 0;
		$aty_28_octo = 0;
		$aty_28_nove = 0;
		$aty_28_desm = 0;
		for ($i = 0; $i < count($patients); $i++) {


			$month_no = date('m', strtotime($patients[$i]->create_date));

			if ($patients[$i]->department_id == '28') {
				if ($month_no == '01') {
					$sw_28_jan++;
				} elseif ($month_no == '02') {
					$sw_28_feb++;
				} elseif ($month_no == '03') {
					$sw_28_march++;
				} elseif ($month_no == '04') {
					$sw_28_april++;
				} elseif ($month_no == '05') {
					$sw_28_may++;
				} elseif ($month_no == '06') {
					$sw_28_june++;
				} elseif ($month_no == '07') {
					$sw_28_jully++;
				} elseif ($month_no == '08') {
					$sw_28_aguest++;
				} elseif ($month_no == '09') {
					$sw_28_sebt++;
				} elseif ($month_no == '10') {
					$sw_28_octo++;
				} elseif ($month_no == '11') {
					$sw_28_nove++;
				} else {
					$sw_28_desm++;
				}

			} elseif ($patients[$i]->department_id == '29') {
				if ($month_no == '01') {
					$str_28_jan++;
				} elseif ($month_no == '02') {
					$str_28_feb++;
				} elseif ($month_no == '03') {
					$str_28_march++;
				} elseif ($month_no == '04') {
					$str_28_april++;
				} elseif ($month_no == '05') {
					$str_28_may++;
				} elseif ($month_no == '06') {
					$str_28_june++;
				} elseif ($month_no == '07') {
					$str_28_jully++;
				} elseif ($month_no == '08') {
					$str_28_aguest++;
				} elseif ($month_no == '09') {
					$str_28_sebt++;
				} elseif ($month_no == '10') {
					$str_28_octo++;
				} elseif ($month_no == '11') {
					$str_28_nove++;
				} else {
					$str_28_desm++;
				}

			} elseif ($patients[$i]->department_id == '30') {
				if ($month_no == '01') {
					$sky_28_jan++;
				} elseif ($month_no == '02') {
					$sky_28_feb++;
				} elseif ($month_no == '03') {
					$sky_28_march++;
				} elseif ($month_no == '04') {
					$sky_28_april++;
				} elseif ($month_no == '05') {
					$sky_28_may++;
				} elseif ($month_no == '06') {
					$sky_28_june++;
				} elseif ($month_no == '07') {
					$sky_28_jully++;

				} elseif ($month_no == '08') {
					$sky_28_aguest++;
				} elseif ($month_no == '09') {
					$sky_28_sebt++;
				} elseif ($month_no == '10') {
					$sky_28_octo++;
				} elseif ($month_no == '11') {
					$sky_28_nove++;
				} else {
					$sky_28_desm++;
				}
			} elseif ($patients[$i]->department_id == '31') {

				if ($month_no == '01') {
					$sly_28_jan++;
				} elseif ($month_no == '02') {
					$sly_28_feb++;
				} elseif ($month_no == '03') {
					$sly_28_march++;
				} elseif ($month_no == '04') {
					$sly_28_april++;
				} elseif ($month_no == '05') {
					$sly_28_may++;
				} elseif ($month_no == '06') {
					$sly_28_june++;
				} elseif ($month_no == '07') {
					$sly_28_jully++;

				} elseif ($month_no == '08') {
					$sly_28_aguest++;
				} elseif ($month_no == '09') {
					$sly_28_sebt++;
				} elseif ($month_no == '10') {
					$sly_28_octo++;
				} elseif ($month_no == '11') {
					$sly_28_nove++;
				} else {
					$sly_28_desm++;
				}
			} elseif ($patients[$i]->department_id == '32') {
				if ($month_no == '01') {
					$bal_28_jan++;
				} elseif ($month_no == '02') {
					$bal_28_feb++;
				} elseif ($month_no == '03') {
					$bal_28_march++;
				} elseif ($month_no == '04') {
					$bal_28_april++;
				} elseif ($month_no == '05') {
					$bal_28_may++;
				} elseif ($month_no == '06') {
					$bal_28_june++;
				} elseif ($month_no == '07') {
					$bal_28_jully++;

				} elseif ($month_no == '08') {
					$bal_28_aguest++;
				} elseif ($month_no == '09') {
					$bal_28_sebt++;
				} elseif ($month_no == '10') {
					$bal_28_octo++;
				} elseif ($month_no == '11') {
					$bal_28_nove++;
				} else {
					$bal_28_desm++;
				}
			} elseif ($patients[$i]->department_id == '33') {
				if ($month_no == '01') {
					$pan_28_jan++;
				} elseif ($month_no == '02') {
					$pan_28_feb++;
				} elseif ($month_no == '03') {
					$pan_28_march++;
				} elseif ($month_no == '04') {
					$pan_28_april++;
				} elseif ($month_no == '05') {
					$pan_28_may++;
				} elseif ($month_no == '06') {
					$pan_28_june++;
				} elseif ($month_no == '07') {
					$pan_28_jully++;

				} elseif ($month_no == '08') {
					$pan_28_aguest++;
				} elseif ($month_no == '09') {
					$pan_28_sebt++;
				} elseif ($month_no == '10') {
					$pan_28_octo++;
				} elseif ($month_no == '11') {
					$pan_28_nove++;
				} else {
					$pan_28_desm++;
				}

			} elseif ($patients[$i]->department_id == '34') {
				if ($month_no == '01') {
					$kay_28_jan++;
				} elseif ($month_no == '02') {
					$kay_28_feb++;
				} elseif ($month_no == '03') {
					$kay_28_march++;
				} elseif ($month_no == '04') {
					$kay_28_april++;
				} elseif ($month_no == '05') {
					$kay_28_may++;
				} elseif ($month_no == '06') {
					$kay_28_june++;
				} elseif ($month_no == '07') {
					$kay_28_jully++;

				} elseif ($month_no == '08') {
					$kay_28_aguest++;
				} elseif ($month_no == '09') {
					$kay_28_sebt++;
				} elseif ($month_no == '10') {
					$kay_28_octo++;
				} elseif ($month_no == '11') {
					$kay_28_nove++;
				} else {
					$kay_28_desm++;
				}
			} elseif ($patients[$i]->department_id == '35') {
				if ($month_no == '01') {
					$aty_28_jan++;
				} elseif ($month_no == '02') {
					$aty_28_feb++;
				} elseif ($month_no == '03') {
					$aty_28_march++;
				} elseif ($month_no == '04') {
					$aty_28_april++;
				} elseif ($month_no == '05') {
					$aty_28_may++;
				} elseif ($month_no == '06') {
					$aty_28_june++;
				} elseif ($month_no == '07') {
					$aty_28_jully++;

				} elseif ($month_no == '08') {
					$aty_28_aguest++;
				} elseif ($month_no == '09') {
					$aty_28_sebt++;
				} elseif ($month_no == '10') {
					$aty_28_nove++;
				} else {
					$aty_28_desm++;
				}

			} elseif ($patients[$i]->department_id == '') {


			}



		}

		$data['jan'] = array($sw_28_jan, $str_28_jan, $sky_28_jan, $sly_28_jan, $bal_28_jan, $pan_28_jan, $kay_28_jan, $aty_28_jan);
		$data['feb'] = array($sw_28_feb, $str_28_feb, $sky_28_feb, $sly_28_feb, $bal_28_feb, $pan_28_feb, $kay_28_feb, $aty_28_feb);
		$data['march'] = array($sw_28_march, $str_28_march, $sky_28_march, $sly_28_march, $bal_28_march, $pan_28_march, $kay_28_march, $aty_28_march);
		$data['april'] = array($sw_28_april, $str_28_april, $sky_28_april, $sly_28_april, $bal_28_april, $pan_28_april, $kay_28_april, $aty_28_april);
		$data['may'] = array($sw_28_may, $str_28_may, $sky_28_may, $sly_28_may, $bal_28_may, $pan_28_may, $kay_28_may, $aty_28_may);

		$data['june'] = array($sw_28_june, $str_28_june, $sky_28_june, $sly_28_june, $bal_28_june, $pan_28_june, $kay_28_june, $aty_28_june);
		$data['jully'] = array($sw_28_jully, $str_28_jully, $sky_28_jully, $sly_28_jully, $bal_28_jully, $pan_28_jully, $kay_28_jully, $aty_28_jully);
		$data['aguest'] = array($sw_28_aguest, $str_28_aguest, $sky_28_aguest, $sly_28_aguest, $bal_28_aguest, $pan_28_aguest, $kay_28_aguest, $aty_28_aguest);
		$data['sebt'] = array($sw_28_sebt, $str_28_sebt, $sky_28_sebt, $sly_28_sebt, $bal_28_sebt, $pan_28_sebt, $kay_28_sebt, $aty_28_sebt);

		$data['octo'] = array($sw_28_octo, $str_28_octo, $sky_28_octo, $sly_28_octo, $bal_28_octo, $pan_28_octo, $kay_28_octo, $aty_28_octo);
		$data['nove'] = array($sw_28_nove, $str_28_nove, $sky_28_nove, $sly_28_nove, $bal_28_nove, $pan_28_nove, $kay_28_nove, $aty_28_nove);
		$data['desm'] = array($sw_28_desm, $str_28_desm, $sky_28_desm, $sly_28_desm, $bal_28_desm, $pan_28_desm, $kay_28_desm, $aty_28_desm);
		$data['department'] = $this->patient_model->get_all_dept();

		$data['datefrom'] = '2019';
		$data['dateto'] = '2019';
		$data['section'] = $section;
		//   $data['department_id'] = $department_id_decode;

		$data['content'] = $this->load->view('patient_month_report', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function getpatientby_month_bed($section = '')
	{
		echo error_reporting(0);

		$data['title'] = display('Monthly Report');
		$year = '%' . $this->session->userdata['acyear'] . '%';
		$patients = $this->patient_model->read_by_dept_month($section, $year);
		$department = $this->patient_model->get_all_dept();

		$year = '%' . $this->session->userdata['acyear'] . '%';

		$sw_28_jan = 0;
		$sw_28_feb = 0;
		$sw_28_march = 0;
		$sw_28_april = 0;
		$sw_28_may = 0;
		$sw_28_june = 0;
		$sw_28_jully = 0;
		$sw_28_aguest = 0;
		$sw_28_sebt = 0;
		$sw_28_octo = 0;
		$sw_28_nove = 0;
		$sw_28_desm = 0;
		$str_28_jan = 0;
		$str_28_feb = 0;
		$str_28_march = 0;
		$str_28_april = 0;
		$str_28_may = 0;
		$str_28_june = 0;
		$str_28_jully = 0;
		$str_28_aguest = 0;
		$str_28_sebt = 0;
		$str_28_octo = 0;
		$str_28_nove = 0;
		$str_28_desm = 0;
		$sky_28_jan = 0;
		$sky_28_feb = 0;
		$sky_28_march = 0;
		$sky_28_april = 0;
		$sky_28_may = 0;
		$sky_28_june = 0;
		$sky_28_jully = 0;
		$sky_28_aguest = 0;
		$sky_28_sebt = 0;
		$sky_28_octo = 0;
		$sky_28_nove = 0;
		$sky_28_desm = 0;
		$sly_28_jan = 0;
		$sly_28_feb = 0;
		$sly_28_march = 0;
		$sly_28_april = 0;
		$sly_28_may = 0;
		$sly_28_june = 0;
		$sly_28_jully = 0;
		$sly_28_aguest = 0;
		$sly_28_sebt = 0;
		$sly_28_octo = 0;
		$sly_28_nove = 0;
		$sly_28_desm = 0;

		$bal_28_jan = 0;
		$bal_28_feb = 0;
		$bal_28_march = 0;
		$bal_28_april = 0;
		$bal_28_may = 0;
		$bal_28_june = 0;
		$bal_28_jully = 0;
		$bal_28_aguest = 0;
		$bal_28_sebt = 0;
		$bal_28_octo = 0;
		$bal_28_nove = 0;
		$bal_28_desm = 0;
		$pan_28_jan = 0;
		$pan_28_feb = 0;
		$pan_28_march = 0;
		$pan_28_april = 0;
		$pan_28_may = 0;
		$pan_28_june = 0;
		$pan_28_jully = 0;
		$pan_28_aguest = 0;
		$pan_28_sebt = 0;
		$pan_28_octo = 0;
		$pan_28_nove = 0;
		$pan_28_desm = 0;
		$kay_28_jan = 0;
		$kay_28_feb = 0;
		$kay_28_march = 0;
		$kay_28_april = 0;
		$kay_28_may = 0;
		$kay_28_june = 0;
		$kay_28_jully = 0;
		$kay_28_aguest = 0;
		$kay_28_sebt = 0;
		$kay_28_octo = 0;
		$kay_28_nove = 0;
		$kay_28_desm = 0;
		$aty_28_jan = 0;
		$aty_28_feb = 0;
		$aty_28_march = 0;
		$aty_28_april = 0;
		$aty_28_may = 0;
		$aty_28_june = 0;
		$aty_28_jully = 0;
		$aty_28_aguest = 0;
		$aty_28_sebt = 0;
		$aty_28_octo = 0;
		$aty_28_nove = 0;
		$aty_28_desm = 0;
		for ($i = 0; $i < count($patients); $i++) {

			$month_no = date('m', strtotime($patients[$i]->create_date));

			if ($patients[$i]->department_id == '28') {
				if ($month_no == '01') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sw_28_jan += $interval->format('%a');
					//$sw_28_jan++;
				} elseif ($month_no == '02') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sw_28_feb += $interval->format('%a');
					//$sw_28_feb++;
				} elseif ($month_no == '03') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sw_28_march += $interval->format('%a');
					//$sw_28_march++;
				} elseif ($month_no == '04') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sw_28_april += $interval->format('%a');
					// $sw_28_april++;
				} elseif ($month_no == '05') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sw_28_may += $interval->format('%a');
					//$sw_28_may++;
				} elseif ($month_no == '06') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sw_28_june += $interval->format('%a');
					//$sw_28_june++;
				} elseif ($month_no == '07') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sw_28_jully += $interval->format('%a');
					//$sw_28_jully++;
				} elseif ($month_no == '08') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sw_28_aguest += $interval->format('%a');
					//$sw_28_aguest++;
				} elseif ($month_no == '09') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sw_28_sebt += $interval->format('%a');
					//$sw_28_sebt++;
				} elseif ($month_no == '10') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sw_28_octo += $interval->format('%a');
					// $sw_28_octo++;
				} elseif ($month_no == '11') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sw_28_nove += $interval->format('%a');
					//$sw_28_nove++;
				} else {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sw_28_desm += $interval->format('%a');
					//$sw_28_desm++;
				}

			} elseif ($patients[$i]->department_id == '29') {
				if ($month_no == '01') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$str_28_jan += $interval->format('%a');
					// $str_28_jan++;
				} elseif ($month_no == '02') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$str_28_feb += $interval->format('%a');
					//$str_28_feb++;
				} elseif ($month_no == '03') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$str_28_march += $interval->format('%a');
					//$str_28_march++;
				} elseif ($month_no == '04') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$str_28_april += $interval->format('%a');
					//$str_28_april++;
				} elseif ($month_no == '05') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$str_28_may += $interval->format('%a');
					//$str_28_may++;
				} elseif ($month_no == '06') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$str_28_june += $interval->format('%a');
					//$str_28_june++;
				} elseif ($month_no == '07') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$str_28_jully += $interval->format('%a');
					//$str_28_jully++;
				} elseif ($month_no == '08') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$str_28_aguest += $interval->format('%a');
					// $str_28_aguest++;
				} elseif ($month_no == '09') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$str_28_sebt += $interval->format('%a');
					// $str_28_sebt++;
				} elseif ($month_no == '10') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$str_28_octo += $interval->format('%a');
					//$str_28_octo++;
				} elseif ($month_no == '11') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$str_28_nove += $interval->format('%a');
					//$str_28_nove++;
				} else {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$str_28_desm += $interval->format('%a');
					// $str_28_desm++;
				}

			} elseif ($patients[$i]->department_id == '30') {
				if ($month_no == '01') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sky_28_jan += $interval->format('%a');
					//$sky_28_jan++;
				} elseif ($month_no == '02') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sky_28_feb += $interval->format('%a');
					//$sky_28_feb++;
				} elseif ($month_no == '03') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sky_28_march += $interval->format('%a');
					//$sky_28_march++;
				} elseif ($month_no == '04') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sky_28_april += $interval->format('%a');
					//$sky_28_april++;
				} elseif ($month_no == '05') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sky_28_may += $interval->format('%a');
					//$sky_28_may++;
				} elseif ($month_no == '06') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sky_28_june += $interval->format('%a');
					//$sky_28_june++;
				} elseif ($month_no == '07') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sky_28_jully += $interval->format('%a');
					// $sky_28_jully++;

				} elseif ($month_no == '08') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sky_28_aguest += $interval->format('%a');
					//$sky_28_aguest++;
				} elseif ($month_no == '09') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sky_28_sebt += $interval->format('%a');
					//$sky_28_sebt++;
				} elseif ($month_no == '10') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sky_28_octo += $interval->format('%a');
					//$sky_28_octo++;
				} elseif ($month_no == '11') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sky_28_nove += $interval->format('%a');
					//$sky_28_nove++;
				} else {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sky_28_desm += $interval->format('%a');
					//$sky_28_desm++;
				}
			} elseif ($patients[$i]->department_id == '31') {

				if ($month_no == '01') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sly_28_jan += $interval->format('%a');
					//$sly_28_jan++;
				} elseif ($month_no == '02') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sly_28_feb += $interval->format('%a');
					//$sly_28_feb++;
				} elseif ($month_no == '03') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sly_28_march += $interval->format('%a');
					//$sly_28_march++;
				} elseif ($month_no == '04') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sly_28_april += $interval->format('%a');
					//$sly_28_april++;
				} elseif ($month_no == '05') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sly_28_may += $interval->format('%a');
					// $sly_28_may++;
				} elseif ($month_no == '06') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sly_28_june += $interval->format('%a');
					//$sly_28_june++;
				} elseif ($month_no == '07') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sly_28_jully += $interval->format('%a');
					// $sly_28_jully++;

				} elseif ($month_no == '08') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sly_28_aguest += $interval->format('%a');
					//$sly_28_aguest++;
				} elseif ($month_no == '09') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sly_28_sebt += $interval->format('%a');
					//$sly_28_sebt++;
				} elseif ($month_no == '10') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sly_28_octo += $interval->format('%a');
					//$sly_28_octo++;
				} elseif ($month_no == '11') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sly_28_nove += $interval->format('%a');
					//$sly_28_nove++;
				} else {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$sly_28_desm += $interval->format('%a');
					//$sly_28_desm++;
				}
			} elseif ($patients[$i]->department_id == '32') {
				if ($month_no == '01') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$bal_28_jan += $interval->format('%a');
					//$bal_28_jan++;
				} elseif ($month_no == '02') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$bal_28_feb += $interval->format('%a');
					// $bal_28_feb++;
				} elseif ($month_no == '03') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$bal_28_march += $interval->format('%a');
					//$bal_28_march++;
				} elseif ($month_no == '04') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$bal_28_april += $interval->format('%a');
					//$bal_28_april++;
				} elseif ($month_no == '05') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$bal_28_may += $interval->format('%a');
					//$bal_28_may++;
				} elseif ($month_no == '06') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$bal_28_june += $interval->format('%a');
					//$bal_28_june++;
				} elseif ($month_no == '07') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$bal_28_jully += $interval->format('%a');
					// $bal_28_jully++;

				} elseif ($month_no == '08') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$bal_28_aguest += $interval->format('%a');
					//$bal_28_aguest++;
				} elseif ($month_no == '09') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$bal_28_sebt += $interval->format('%a');
					//$bal_28_sebt++;
				} elseif ($month_no == '10') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$bal_28_octo += $interval->format('%a');
					//$bal_28_octo++;
				} elseif ($month_no == '11') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$bal_28_nove += $interval->format('%a');
					// $bal_28_nove++;
				} else {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$bal_28_desm += $interval->format('%a');
					//$bal_28_desm++;
				}
			} elseif ($patients[$i]->department_id == '33') {
				if ($month_no == '01') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$pan_28_jan += $interval->format('%a');
					// $pan_28_jan++;
				} elseif ($month_no == '02') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$pan_28_feb += $interval->format('%a');
					//$pan_28_feb++;
				} elseif ($month_no == '03') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$pan_28_march += $interval->format('%a');
					//$pan_28_march++;
				} elseif ($month_no == '04') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$pan_28_april += $interval->format('%a');
					// $pan_28_april++;
				} elseif ($month_no == '05') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$pan_28_may += $interval->format('%a');
					//$pan_28_may++;
				} elseif ($month_no == '06') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$pan_28_june += $interval->format('%a');
					//$pan_28_june++;
				} elseif ($month_no == '07') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$pan_28_jully += $interval->format('%a');
					//$pan_28_jully++;

				} elseif ($month_no == '08') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$pan_28_aguest += $interval->format('%a');
					//$pan_28_aguest++;
				} elseif ($month_no == '09') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$pan_28_sebt += $interval->format('%a');
					//$pan_28_sebt++;
				} elseif ($month_no == '10') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$pan_28_octo += $interval->format('%a');
					// $pan_28_octo++;
				} elseif ($month_no == '11') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$pan_28_nove += $interval->format('%a');
					// $pan_28_nove++;
				} else {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$pan_28_desm += $interval->format('%a');
					//$pan_28_desm++;
				}

			} elseif ($patients[$i]->department_id == '34') {
				if ($month_no == '01') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$kay_28_jan += $interval->format('%a');
					// $kay_28_jan++;
				} elseif ($month_no == '02') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$kay_28_feb += $interval->format('%a');
					// $kay_28_feb++;
				} elseif ($month_no == '03') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$kay_28_march += $interval->format('%a');
					// $kay_28_march++;
				} elseif ($month_no == '04') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$kay_28_april += $interval->format('%a');
					//$kay_28_april++;
				} elseif ($month_no == '05') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$kay_28_may += $interval->format('%a');
					// $kay_28_may++;
				} elseif ($month_no == '06') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$kay_28_june += $interval->format('%a');
					//$kay_28_june++;
				} elseif ($month_no == '07') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$kay_28_jully += $interval->format('%a');
					// $kay_28_jully++;

				} elseif ($month_no == '08') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$kay_28_aguest += $interval->format('%a');
					//$kay_28_aguest++;
				} elseif ($month_no == '09') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$kay_28_sebt += $interval->format('%a');
					// $kay_28_sebt++;
				} elseif ($month_no == '10') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$kay_28_octo += $interval->format('%a');
					// $kay_28_octo++;
				} elseif ($month_no == '11') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$kay_28_nove += $interval->format('%a');
					//$kay_28_nove++;
				} else {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$kay_28_desm += $interval->format('%a');
					// $kay_28_desm++;
				}
			} elseif ($patients[$i]->department_id == '35') {
				if ($month_no == '01') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$aty_28_jan += $interval->format('%a');
					// $aty_28_jan++;
				} elseif ($month_no == '02') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$aty_28_feb += $interval->format('%a');
					//$aty_28_feb++;
				} elseif ($month_no == '03') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$aty_28_march += $interval->format('%a');
					//$aty_28_march++;
				} elseif ($month_no == '04') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$aty_28_april = $interval->format('%a');
					$aty_28_april++;
				} elseif ($month_no == '05') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$aty_28_may += $interval->format('%a');
					// $aty_28_may++;
				} elseif ($month_no == '06') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$aty_28_june += $interval->format('%a');
					// $aty_28_june++;
				} elseif ($month_no == '07') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$aty_28_jully += $interval->format('%a');
					//$aty_28_jully++;

				} elseif ($month_no == '08') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$aty_28_aguest += $interval->format('%a');
					//$aty_28_aguest++;
				} elseif ($month_no == '09') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$aty_28_sebt += $interval->format('%a');
					//$aty_28_sebt++;
				} elseif ($month_no == '10') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$aty_28_octo += $interval->format('%a');
					//$aty_28_octo++;
				} elseif ($month_no == '11') {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$aty_28_octo += $interval->format('%a');
					// $aty_28_desm++;
				} else {

					$date1 = date('Y-m-d', strtotime($patients[$i]->create_date));
					if ($patients[$i]->discharge_date == '0000-00-00') {
					} else {
						$date2 = date('Y-m-d', strtotime($patients[$i]->discharge_date));
					}
					$datetime1 = date_create($date1);
					$datetime2 = date_create($date2);

					$interval = date_diff($datetime1, $datetime2);
					$aty_28_octo += $interval->format('%a');
					// $aty_28_desm++;
				}

			} elseif ($patients[$i]->department_id == '') {


			}



		}

		$data['jan'] = array($sw_28_jan, $str_28_jan, $sky_28_jan, $sly_28_jan, $bal_28_jan, $pan_28_jan, $kay_28_jan, $aty_28_jan);
		$data['feb'] = array($sw_28_feb, $str_28_feb, $sky_28_feb, $sly_28_feb, $bal_28_feb, $pan_28_feb, $kay_28_feb, $aty_28_feb);
		$data['march'] = array($sw_28_march, $str_28_march, $sky_28_march, $sly_28_march, $bal_28_march, $pan_28_march, $kay_28_march, $aty_28_march);
		$data['april'] = array($sw_28_april, $str_28_april, $sky_28_april, $sly_28_april, $bal_28_april, $pan_28_april, $kay_28_april, $aty_28_april);
		$data['may'] = array($sw_28_may, $str_28_may, $sky_28_may, $sly_28_may, $bal_28_may, $pan_28_may, $kay_28_may, $aty_28_may);

		$data['june'] = array($sw_28_june, $str_28_june, $sky_28_june, $sly_28_june, $bal_28_june, $pan_28_june, $kay_28_june, $aty_28_june);
		$data['jully'] = array($sw_28_jully, $str_28_jully, $sky_28_jully, $sly_28_jully, $bal_28_jully, $pan_28_jully, $kay_28_jully, $aty_28_jully);
		$data['aguest'] = array($sw_28_aguest, $str_28_aguest, $sky_28_aguest, $sly_28_aguest, $bal_28_aguest, $pan_28_aguest, $kay_28_aguest, $aty_28_aguest);
		$data['sebt'] = array($sw_28_sebt, $str_28_sebt, $sky_28_sebt, $sly_28_sebt, $bal_28_sebt, $pan_28_sebt, $kay_28_sebt, $aty_28_sebt);

		$data['octo'] = array($sw_28_octo, $str_28_octo, $sky_28_octo, $sly_28_octo, $bal_28_octo, $pan_28_octo, $kay_28_octo, $aty_28_octo);
		$data['nove'] = array($sw_28_nove, $str_28_nove, $sky_28_nove, $sly_28_nove, $bal_28_nove, $pan_28_nove, $kay_28_nove, $aty_28_nove);
		$data['desm'] = array($sw_28_desm, $str_28_desm, $sky_28_desm, $sly_28_desm, $bal_28_desm, $pan_28_desm, $kay_28_desm, $aty_28_desm);
		$data['department'] = $this->patient_model->get_all_dept();

		$data['datefrom'] = '2019';
		$data['dateto'] = '2019';
		//$data['section'] = $section;
		$data['month_bed'] = 'month_bed';
		//   $data['department_id'] = $department_id_decode;

		$data['content'] = $this->load->view('patient_month_report', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	function excel_all_customer_admit()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date2 = $_GET['date1'];
		$end_date2 = $_GET['date2'];
		$section = $_GET['section'];

		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";






		$data['patients'] = $this->db->select("*")

			->from('patient_ipd')

			->join('department', 'department.dprt_id =  patient_ipd.department_id')

			->where('ipd_opd', $section)

			->where('create_date >=', $start_date)

			->where('create_date <=', $end_date)

			->where('create_date LIKE', $year)

			//	->order_by("id", "DESC")

			->get()

			->result();


		//	print_r($data['patients']);exit;
		//$data['patients'] = $this->patient_model->read_by_section_date($getData);
		if ($data['patients']) {

			$data['content'] = $this->load->view('excel_all_customer_exce', $data, true);
			//	$this->load->view('layout/main_wrapper',$data);
		} else {
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patient', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}

	}

	public function getpatientby_agnikarma()
	{
		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);
		$section = $this->input->get('section', TRUE);
		$start_date1 = date('Y-m-d', strtotime($start_date1));
		$end_date1 = date('Y-m-d', strtotime($end_date1));

		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1;
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;

		if ($section == 'opd') {
			$data['patients'] = $this->db->select('*')
				->from('patient')
				->where('create_date >=', $start_date)
				->where('create_date <=', $end_date1)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['section'] = 'opd';
		} else {
			$data['patients'] = $this->db->select('*')
				->from('patient_ipd')
				->where('create_date >=', $start_date)
				->where('create_date <=', $end_date1)
				->where('ipd_opd', $section)
				->get()
				->result();
			//  print_r($this->db->last_query());
			$data['section'] = 'ipd';

		}

		$data['content'] = $this->load->view('agnikarma_register', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}







	function excel_all_customer()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date2 = $_GET['date1'];
		$end_date2 = $_GET['date2'];
		$section = $_GET['section'];

		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";






		if ($section == 'opd') {
			$data['patients'] = $this->db->select("*")

				->from('patient')

				//	->join('department','department.dprt_id =  patient.department_id')

				->where('ipd_opd', $section)

				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)

				->where('create_date LIKE', $year)

				//	->order_by("id", "DESC")

				->get()

				->result();

		} else {


			$data['patients1'] = $this->db->select("*")

				->from('patient_ipd')

				->join('department', 'department.dprt_id = patient_ipd.department_id')

				->where('discharge_date >=', $start_date_f)

				->where('create_date <=', $start_date_f)

				->where('ipd_opd', $section)
				->or_where('discharge_date', $start_date)

				//	->where('create_date LIKE', $year)

				->get()

				->result();



			//Array 2
			$data['patients2'] = $this->db->select("*")

				->from('patient_ipd')

				->join('department', 'department.dprt_id = patient_ipd.department_id')

				->where('create_date <=', $start_date_f)

				->where('discharge_date LIKE', '%0000-00-00%')

				->where('ipd_opd', $section)

				->get()

				->result();


			$data['patients'] = array_merge($data['patients1'], $data['patients2']);

		}
		//print_r($data['patients']);exit;
		//$data['patients'] = $this->patient_model->read_by_section_date($getData);
		if ($data['patients']) {

			$data['content'] = $this->load->view('excel_all_customer_exce', $data, true);
			//	$this->load->view('layout/main_wrapper',$data);
		} else {
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patient', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}

	}

	function excel_all_customer_damii()
	{

		/*$year = '%'.$this->session->userdata['acyear'].'%';
		$start_date2=$_GET['date1'];
		$end_date2=$_GET['date2'];
		$section = $_GET['section'];

		$start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
		$end_date= $end_date2." 23:59:00";
	 */
		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date2 = '2020-01-11';
		$end_date2 = '2020-01-11';
		$section = 'opd';

		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";




		if ($section == 'opd') {
			$data['patients'] = $this->db->select("*")

				->from('patient')

				//	->join('department','department.dprt_id =  patient.department_id')

				->where('ipd_opd', $section)

				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)

				->where('create_date LIKE', $year)

				//	->order_by("id", "DESC")

				->get()

				->result();

		} else {


			$data['patients1'] = $this->db->select("*")

				->from('patient_ipd')

				->join('department', 'department.dprt_id = patient_ipd.department_id')

				->where('discharge_date >=', $start_date_f)

				->where('create_date <=', $start_date_f)

				->where('ipd_opd', $section)
				->or_where('discharge_date', $start_date)

				//	->where('create_date LIKE', $year)

				->get()

				->result();



			//Array 2
			$data['patients2'] = $this->db->select("*")

				->from('patient_ipd')

				->join('department', 'department.dprt_id = patient_ipd.department_id')

				->where('create_date <=', $start_date_f)

				->where('discharge_date LIKE', '%0000-00-00%')

				->where('ipd_opd', $section)

				->get()

				->result();


			$data['patients'] = array_merge($data['patients1'], $data['patients2']);

		}
		//print_r($data['patients']);exit;
		//$data['patients'] = $this->patient_model->read_by_section_date($getData);
		if ($data['patients']) {

			$data['content'] = $this->load->view('excel_all_customer_exce', $data, true);
			//	$this->load->view('layout/main_wrapper',$data);
		} else {
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patient', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}

	}

	function excel_all_customer_invistigation()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date2 = $_GET['date1'];
		$end_date2 = $_GET['date2'];
		$section = $_GET['section'];

		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";


		$data['patients1'] = $this->patient_model->read_by_investi_date($section = 'opd', $start_date, $end_date);
		$data['patients2'] = $this->patient_model->read_by_investi_date($section = 'ipd', $start_date, $end_date);
		$data['patients'] = array_merge($data['patients1'], $data['patients2']);

		//$data['department_by_section'] = 'opd';


		$data['datefrom'] = $start_date2;
		$data['dateto'] = $end_date2;
		$data['department_by'] = 'dpt';
		if ($data['patients']) {

			$data['content'] = $this->load->view('excel_all_customer_invistigation', $data, true);
			//	$this->load->view('layout/main_wrapper',$data);
		} else {
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patient', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}

	}




	public function storeManualTreatment()
	{
		date_default_timezone_set('Asia/Kolkata'); // time in India

		$section = $this->input->post('ipd_opd');

		$patient_id_auto = $this->input->post('patient_id');
		$ipd_round_date = date('Y-m-d', strtotime($this->input->post('roundDate')));
		$rounds = $this->input->post('round');
		if ($section == 'ipd') {
			$this->db->where(['patient_id_auto' => $patient_id_auto, 'ipd_round_date' => $ipd_round_date, 'ipd_opd' => $section, 'rounds' => $rounds]);
			$result = $this->db->get('manual_treatments')->row();
		} else {
			$this->db->where(['patient_id_auto' => $patient_id_auto, 'ipd_opd' => $section]);
			$result = $this->db->get('manual_treatments')->row();
		}



		if ($this->input->post('department_id') == '32' && $section == 'ipd') {
			$updatepatient_array = array(
				'wieght' => $this->input->post('weight'),
			);

			$year = '%' . $this->session->userdata['acyear'] . '%';

			// $this->db->where('create_date', $create_date);
			// $this->db->where('id', $id);
			$this->db->where('id', $this->input->post('patient_id'));
			$this->db->update('patient_ipd', $updatepatient_array);
		}
		if ($this->input->post('department_id') == '32' && $section == 'opd') {
			$updatepatient_array = array(
				'wieght' => $this->input->post('weight'),
			);
			$year = '%' . $this->session->userdata['acyear'] . '%';
			$this->db->where('yearly_reg_no', $this->input->post('opd_no'));
			$this->db->where('year(create_date) LIKE', $year);
			$this->db->update('patient', $updatepatient_array);

		}
		$RX1_medicine_name = $this->input->post('RX1');
		$RX1_morning_dose = ($this->input->post('morning_dose_rx1')) ? $this->input->post('morning_dose_rx1') : 0;
		$RX1_afternoon_dose = ($this->input->post('afternoon_dose_rx1')) ? $this->input->post('afternoon_dose_rx1') : 0;
		$RX1_evening_dose = ($this->input->post('evening_dose_rx1')) ? $this->input->post('evening_dose_rx1') : 0;
		$RX1_dose_day = $this->input->post('dose_day_rx1');
		$RX1_dose_take = $this->input->post('dose_take_with_rx1');
		$RX1_dose_anupan = $this->input->post('dose_anupan_rx1');

		$RX2_medicine_name = $this->input->post('RX2');
		$RX2_morning_dose = ($this->input->post('morning_dose_rx2')) ? $this->input->post('morning_dose_rx2') : 0;
		$RX2_afternoon_dose = ($this->input->post('afternoon_dose_rx2')) ? $this->input->post('afternoon_dose_rx2') : 0;
		$RX2_evening_dose = ($this->input->post('evening_dose_rx2')) ? $this->input->post('evening_dose_rx2') : 0;
		$RX2_dose_day = $this->input->post('dose_day_rx2');
		$RX2_dose_take = $this->input->post('dose_take_with_rx2');
		$RX2_dose_anupan = $this->input->post('dose_anupan_rx2');

		$RX3_medicine_name = $this->input->post('RX3');
		$RX3_morning_dose = ($this->input->post('morning_dose_rx3')) ? $this->input->post('morning_dose_rx3') : 0;
		$RX3_afternoon_dose = ($this->input->post('afternoon_dose_rx3')) ? $this->input->post('afternoon_dose_rx3') : 0;
		$RX3_evening_dose = ($this->input->post('evening_dose_rx3')) ? $this->input->post('evening_dose_rx3') : 0;
		$RX3_dose_day = $this->input->post('dose_day_rx3');
		$RX3_dose_take = $this->input->post('dose_take_with_rx3');
		$RX3_dose_anupan = $this->input->post('dose_anupan_rx3');

		$RX4_medicine_name = $this->input->post('RX4');
		$RX4_morning_dose = $this->input->post('morning_dose_rx4');
		$RX4_afternoon_dose = $this->input->post('afternoon_dose_rx4');
		$RX4_evening_dose = $this->input->post('evening_dose_rx4');
		$RX4_dose_day = $this->input->post('dose_day_rx4');
		$RX4_dose_take = $this->input->post('dose_take_with_rx4');
		$RX4_dose_anupan = $this->input->post('dose_anupan_rx4');

		$RX5_medicine_name = $this->input->post('RX5');
		$RX5_morning_dose = $this->input->post('morning_dose_rx5');
		$RX5_afternoon_dose = $this->input->post('afternoon_dose_rx5');
		$RX5_evening_dose = $this->input->post('evening_dose_rx5');
		$RX5_dose_day = $this->input->post('dose_day_rx5');
		$RX5_dose_take = $this->input->post('dose_take_with_rx5');
		$RX5_dose_anupan = $this->input->post('dose_anupan_rx5');


		$RX_other_medicine_name = $this->input->post('RX_other');
		$RX_other_morning_dose = $this->input->post('morning_dose_rx_other');
		$RX_other_afternoon_dose = $this->input->post('afternoon_dose_rx_other');
		$RX_other_evening_dose = $this->input->post('evening_dose_rx_other');
		$RX_other_dose_day = $this->input->post('dose_day_rx_other');
		$RX_other_dose_take = $this->input->post('dose_take_with_rx_other');
		$RX_other_dose_anupan = $this->input->post('dose_anupan_rx_other');

		$RX_other1_medicine_name = $this->input->post('RX_other1');
		$RX_other1_morning_dose = $this->input->post('morning_dose_rx_other1');
		$RX_other1_afternoon_dose = $this->input->post('afternoon_dose_rx_other1');
		$RX_other1_evening_dose = $this->input->post('evening_dose_rx_other1');
		$RX_other1_dose_day = $this->input->post('dose_day_rx_other1');
		$RX_other1_dose_take = $this->input->post('dose_take_with_rx_other1');
		$dose_anupan_rx_other1 = $this->input->post('dose_anupan_rx_other1');

		$DRX1_medicine_name = $this->input->post('DRX1');
		$DRX1_morning_dose = $this->input->post('DRX1_morning_dose');
		$DRX1_afternoon_dose = $this->input->post('DRX1_afternoon_dose');
		$DRX1_evening_dose = $this->input->post('DRX1_evening_dose');
		$DRX1_dose_day = $this->input->post('DRX1_dose_day');
		$DRX1_dose_take = $this->input->post('DRX1_dose_take');
		$DRX1_dose_anupan = $this->input->post('DRX1_dose_anupan');

		$DRX2_medicine_name = $this->input->post('DRX2');
		$DRX2_morning_dose = $this->input->post('DRX2_morning_dose');
		$DRX2_afternoon_dose = $this->input->post('DRX2_afternoon_dose');
		$DRX2_evening_dose = $this->input->post('DRX2_evening_dose');
		$DRX2_dose_day = $this->input->post('DRX2_dose_day');
		$DRX2_dose_take = $this->input->post('DRX2_dose_take');
		$DRX2_dose_anupan = $this->input->post('DRX2_dose_anupan');

		$DRX3_medicine_name = $this->input->post('DRX3');
		$DRX3_morning_dose = $this->input->post('DRX3_morning_dose');
		$DRX3_afternoon_dose = $this->input->post('DRX3_afternoon_dose');
		$DRX3_evening_dose = $this->input->post('DRX3_evening_dose');
		$DRX3_dose_day = $this->input->post('DRX3_dose_day');
		$DRX3_dose_take = $this->input->post('DRX3_dose_take');
		$DRX3_dose_anupan = $this->input->post('DRX3_dose_anupan');

		$RX1 = '';
		$RX2 = '';
		$RX3 = '';
		$RX4 = '';
		$RX5 = '';
		$RX6 = '';
		$RX7 = '';
		$RX8 = '';
		$RX9 = '';
		$RX10 = '';
		$RX_other = '';
		$RX_other1 = '';
		$DRX1 = '';
		$DRX2 = '';
		$DRX3 = '';

		if ($RX1_medicine_name) {
			if ($section == 'opd') {
				$RX1 = $RX1_medicine_name . ' ' . $RX1_morning_dose . ' X ' . $RX1_dose_day . 'D';
			} else {
				$RX1 = $RX1_medicine_name . ' ' . $RX1_morning_dose;
			}
		}
		if ($RX2_medicine_name) {
			if ($section == 'opd') {
				$RX2 = $RX2_medicine_name . ' ' . $RX2_morning_dose . ' X ' . $RX2_dose_day . 'D';
			} else {
				$RX2 = $RX2_medicine_name . ' ' . $RX2_morning_dose;
			}
		}
		if ($RX3_medicine_name) {
			if ($section == 'opd') {
				$RX3 = $RX3_medicine_name . ' ' . $RX3_morning_dose . ' X ' . $RX3_dose_day . 'D';
			} else {
				$RX3 = $RX3_medicine_name . ' ' . $RX3_morning_dose;
			}
		}
		if ($RX4_medicine_name) {
			if ($section == 'opd') {
				$RX4 = $RX4_medicine_name . ' ' . $RX4_morning_dose . ' X ' . $RX4_dose_day . 'D';
			} else {
				$RX4 = $RX4_medicine_name . ' ' . $RX4_morning_dose;
			}
		}
		if ($RX5_medicine_name) {
			if ($section == 'opd') {
				$RX5 = $RX5_medicine_name . ' ' . $RX5_morning_dose . ' X ' . $RX5_dose_day . 'D';
			} else {
				$RX5 = $RX5_medicine_name . ' ' . $RX5_morning_dose;
			}
		}
		// echo $RX1;
		// echo $RX2;
		// echo $RX3;
		// echo $RX4;
		// echo $RX5;
		// die();


		if ($RX_other_medicine_name) {
			if ($section == 'opd') {
				$RX_other = $RX_other_medicine_name . ' ' . $RX_other_morning_dose . ' X ' . $RX_other_dose_day . 'D';
			} else {
				$RX_other = $RX_other_medicine_name . ' ' . $RX_other_morning_dose;
			}
		}

		if ($RX_other1_medicine_name) {
			if ($section == 'opd') {
				$RX_other1 = $RX_other1_medicine_name . ' ' . $RX_other1_morning_dose . ' X ' . $RX_other1_dose_day . 'D';
			} else {
				$RX_other1 = $RX_other1_medicine_name . ' ' . $RX_other1_morning_dose;
			}
		}


		if ($DRX1_medicine_name) {
			$DRX1 = $DRX1_medicine_name . ' ' . $DRX1_morning_dose . ' X ' . $DRX1_dose_day . 'D';
		}
		if ($DRX2_medicine_name) {
			$DRX2 = $DRX2_medicine_name . ' ' . $DRX2_morning_dose . ' X ' . $DRX2_dose_day . 'D';
		}
		if ($DRX3_medicine_name) {
			$DRX3 = $DRX3_medicine_name . ' ' . $DRX3_morning_dose . ' X ' . $DRX3_dose_day . 'D';
		}

		$temp_hematological_label = $this->input->post('hematological');
		$temp_serologycal_label = $this->input->post('serologycal');
		$temp_biochemical_label = $this->input->post('biochemical');
		$temp_microbiological_label = $this->input->post('microbiological');
		$temp_xray_label = $this->input->post('xray');
		$temp_usg_label = $this->input->post('usg');

		if ($temp_hematological_label || $temp_serologycal_label || $temp_biochemical_label || $temp_microbiological_label || $temp_xray_label || $temp_usg_label) {
			$hematological_label = implode(',', (array) $temp_hematological_label);
			$serologycal_label = implode(',', (array) $temp_serologycal_label);
			$biochemical_label = implode(',', (array) $temp_biochemical_label);
			$microbiological_label = implode(',', (array) $temp_microbiological_label);
			$xray_label = implode(',', (array) $temp_xray_label);
			$usg_label = implode(',', (array) $temp_usg_label);
			// $hematological_label = $temp_hematological_label;
			// $serologycal_label = $temp_serologycal_label;
			// $biochemical_label = $temp_biochemical_label;
			// $microbiological_label = $temp_microbiological_label;
			// $xray_label = $temp_xray_label;
			// $usg_label = $temp_usg_label;
		} else {
			$hematological_label = NULL;
			$serologycal_label = NULL;
			$biochemical_label = NULL;
			$microbiological_label = NULL;
			$xray_label = NULL;
			$usg_label = NULL;
		}

		if ($result) {
			$data['patient'] = (object) $postData = [
				'dignosis' => $this->input->post('dignosis'),
				'patient_id_auto' => $this->input->post('patient_id'),
				'panch_adv_flag' => $this->input->post('panch_adv_flag'),
				'department_id' => $this->input->post('department_id'),
				'ipd_opd' => $this->input->post('ipd_opd'),
				'ipd_round_date' => ($this->input->post('roundDate')) ? date('Y-m-d', strtotime($this->input->post('roundDate'))) : $result->ipd_round_date,
				'rounds' => ($this->input->post('round')) ? $this->input->post('round') : $result->rounds,
				'ipd_days' => ($this->input->post('ipd_days')) ? $this->input->post('ipd_days') : $result->ipd_days,
				'RX1' => ($RX1) ? $RX1 : $result->RX1,
				'RX2' => ($RX2) ? $RX2 : $result->RX2,
				'RX3' => ($RX3) ? $RX3 : $result->RX3,
				'RX4' => ($RX4) ? $RX4 : $result->RX4,
				'RX5' => ($RX5) ? $RX5 : $result->RX5,
				'RX_other' => ($RX_other) ? $RX_other : $result->RX_other,
				'RX_other1' => ($RX_other1) ? $RX_other1 : $result->RX_other1,
				'DRX1' => ($DRX1) ? $DRX1 : $result->DRX1,
				'DRX2' => ($DRX2) ? $DRX2 : $result->DRX2,
				'DRX3' => ($DRX3) ? $DRX3 : $result->DRX3,
				'RX1_medicine_name' => ($this->input->post('RX1')) ? $this->input->post('RX1') : $result->RX1_medicine_name,
				'RX1_morning_dose' => ($this->input->post('morning_dose_rx1')) ? $this->input->post('morning_dose_rx1') : $result->RX1_morning_dose,
				'RX1_afternoon_dose' => ($this->input->post('afternoon_dose_rx1')) ? $this->input->post('afternoon_dose_rx1') : $result->RX1_afternoon_dose,
				'RX1_evening_dose' => ($this->input->post('evening_dose_rx1')) ? $this->input->post('evening_dose_rx1') : $result->RX1_evening_dose,
				'RX1_dose_day' => ($this->input->post('dose_day_rx1')) ? $this->input->post('dose_day_rx1') : $result->RX1_dose_day,
				'RX1_dose_take' => ($this->input->post('dose_take_with_rx1')) ? $this->input->post('dose_take_with_rx1') : $result->RX1_dose_take,
				'RX1_dose_anupan' => ($this->input->post('dose_anupan_rx1')) ? $this->input->post('dose_anupan_rx1') : $result->RX1_dose_anupan,
				'RX2_medicine_name' => ($this->input->post('RX2')) ? $this->input->post('RX2') : $result->RX2_medicine_name,
				'RX2_morning_dose' => ($this->input->post('morning_dose_rx2')) ? $this->input->post('morning_dose_rx2') : $result->RX2_morning_dose,
				'RX2_afternoon_dose' => ($this->input->post('afternoon_dose_rx2')) ? $this->input->post('afternoon_dose_rx2') : $result->RX2_afternoon_dose,
				'RX2_evening_dose' => ($this->input->post('evening_dose_rx2')) ? $this->input->post('evening_dose_rx2') : $result->RX2_evening_dose,
				'RX2_dose_day' => ($this->input->post('dose_day_rx2')) ? $this->input->post('dose_day_rx2') : $result->RX2_dose_day,
				'RX2_dose_take' => ($this->input->post('dose_take_with_rx2')) ? $this->input->post('dose_take_with_rx2') : $result->RX2_dose_take,
				'RX2_dose_anupan' => ($this->input->post('dose_anupan_rx2')) ? $this->input->post('dose_anupan_rx2') : $result->RX2_dose_anupan,
				'RX3_medicine_name' => ($this->input->post('RX3')) ? $this->input->post('RX3') : $result->RX3_medicine_name,
				'RX3_morning_dose' => ($this->input->post('morning_dose_rx3')) ? $this->input->post('morning_dose_rx3') : $result->RX3_morning_dose,
				'RX3_afternoon_dose' => ($this->input->post('afternoon_dose_rx3')) ? $this->input->post('afternoon_dose_rx3') : $result->RX3_afternoon_dose,
				'RX3_evening_dose' => ($this->input->post('evening_dose_rx3')) ? $this->input->post('evening_dose_rx3') : $result->RX3_evening_dose,
				'RX3_dose_day' => ($this->input->post('dose_day_rx3')) ? $this->input->post('dose_day_rx3') : $result->RX3_dose_day,
				'RX3_dose_take' => ($this->input->post('dose_take_with_rx3')) ? $this->input->post('dose_take_with_rx3') : $result->RX3_dose_take,
				'RX3_dose_anupan' => ($this->input->post('dose_anupan_rx3')) ? $this->input->post('dose_anupan_rx3') : $result->RX3_dose_anupan,
				'RX4_medicine_name' => ($this->input->post('RX4')) ? $this->input->post('RX4') : $result->RX4_medicine_name,
				'RX4_morning_dose' => ($this->input->post('morning_dose_rx4')) ? $this->input->post('morning_dose_rx4') : $result->RX4_morning_dose,
				'RX4_afternoon_dose' => ($this->input->post('afternoon_dose_rx4')) ? $this->input->post('afternoon_dose_rx4') : $result->RX4_afternoon_dose,
				'RX4_evening_dose' => ($this->input->post('evening_dose_rx4')) ? $this->input->post('evening_dose_rx4') : $result->RX4_evening_dose,
				'RX4_dose_day' => ($this->input->post('dose_day_rx4')) ? $this->input->post('dose_day_rx4') : $result->RX4_dose_day,
				'RX4_dose_take' => ($this->input->post('dose_take_with_rx4')) ? $this->input->post('dose_take_with_rx4') : $result->RX4_dose_take,
				'RX4_dose_anupan' => ($this->input->post('dose_anupan_rx4')) ? $this->input->post('dose_anupan_rx4') : $result->RX4_dose_anupan,
				'RX5_medicine_name' => ($this->input->post('RX5')) ? $this->input->post('RX5') : $result->RX5_medicine_name,
				'RX5_morning_dose' => ($this->input->post('morning_dose_rx5')) ? $this->input->post('morning_dose_rx5') : $result->RX5_morning_dose,
				'RX5_afternoon_dose' => ($this->input->post('afternoon_dose_rx5')) ? $this->input->post('afternoon_dose_rx5') : $result->RX5_afternoon_dose,
				'RX5_evening_dose' => ($this->input->post('evening_dose_rx5')) ? $this->input->post('evening_dose_rx5') : $result->RX5_evening_dose,
				'RX5_dose_day' => ($this->input->post('dose_day_rx5')) ? $this->input->post('dose_day_rx5') : $result->RX5_dose_day,
				'RX5_dose_take' => ($this->input->post('dose_take_with_rx5')) ? $this->input->post('dose_take_with_rx5') : $result->RX5_dose_take,
				'RX5_dose_anupan' => ($this->input->post('dose_anupan_rx5')) ? $this->input->post('dose_anupan_rx5') : $result->RX5_dose_anupan,

				'RX_other_medicine_name' => ($this->input->post('RX_other')) ? $this->input->post('RX_other') : $result->RX_other_medicine_name,
				'morning_dose_rx_other' => ($this->input->post('morning_dose_rx_other')) ? $this->input->post('morning_dose_rx_other') : $result->morning_dose_rx_other,
				'afternoon_dose_rx_other' => ($this->input->post('afternoon_dose_rx_other')) ? $this->input->post('afternoon_dose_rx_other') : $result->afternoon_dose_rx_other,
				'evening_dose_rx_other' => ($this->input->post('evening_dose_rx_other')) ? $this->input->post('evening_dose_rx_other') : $result->evening_dose_rx_other,
				'dose_day_rx_other' => ($this->input->post('dose_day_rx_other')) ? $this->input->post('dose_day_rx_other') : $result->dose_day_rx_other,
				'dose_take_with_rx_other' => ($this->input->post('dose_take_with_rx_other')) ? $this->input->post('dose_take_with_rx_other') : $result->dose_take_with_rx_other,
				'dose_anupan_rx_other' => ($this->input->post('dose_anupan_rx_other')) ? $this->input->post('dose_anupan_rx_other') : $result->dose_anupan_rx_other,

				'RX_other1_medicine_name' => ($this->input->post('RX_other1_medicine_name')) ? $this->input->post('RX_other1_medicine_name') : $result->RX_other1_medicine_name,
				'morning_dose_rx_other1' => ($this->input->post('morning_dose_rx_other1')) ? $this->input->post('morning_dose_rx_other1') : $result->morning_dose_rx_other1,
				'afternoon_dose_rx_other1' => ($this->input->post('afternoon_dose_rx_other1')) ? $this->input->post('afternoon_dose_rx_other1') : $result->afternoon_dose_rx_other1,
				'evening_dose_rx_other1' => ($this->input->post('evening_dose_rx_other1')) ? $this->input->post('evening_dose_rx_other1') : $result->evening_dose_rx_other1,
				'dose_day_rx_other1' => ($this->input->post('dose_day_rx_other1')) ? $this->input->post('dose_day_rx_other1') : $result->dose_day_rx_other1,
				'dose_take_with_rx_other1' => ($this->input->post('dose_take_with_rx_other1')) ? $this->input->post('dose_take_with_rx_other1') : $result->dose_take_with_rx_other1,
				'dose_anupan_rx_other1' => ($this->input->post('dose_anupan_rx_other1')) ? $this->input->post('dose_anupan_rx_other1') : $result->dose_anupan_rx_other1,


				'DRX1_medicine_name' => ($this->input->post('DRX1')) ? $this->input->post('DRX1') : $result->DRX1_medicine_name,
				'DRX1_morning_dose' => ($this->input->post('DRX1_morning_dose')) ? $this->input->post('DRX1_morning_dose') : $result->DRX1_morning_dose,
				'DRX1_afternoon_dose' => ($this->input->post('DRX1_afternoon_dose')) ? $this->input->post('DRX1_afternoon_dose') : $result->DRX1_afternoon_dose,
				'DRX1_evening_dose' => ($this->input->post('DRX1_evening_dose')) ? $this->input->post('DRX1_evening_dose') : $result->DRX1_evening_dose,
				'DRX1_dose_day' => ($this->input->post('DRX1_dose_day')) ? $this->input->post('DRX1_dose_day') : $result->DRX1_dose_day,
				'DRX1_dose_take' => ($this->input->post('DRX1_dose_take')) ? $this->input->post('DRX1_dose_take') : $result->DRX1_dose_take,
				'DRX1_dose_anupan' => ($this->input->post('DRX1_dose_anupan')) ? $this->input->post('DRX1_dose_anupan') : $result->DRX1_dose_anupan,
				'DRX2_medicine_name' => ($this->input->post('DRX2')) ? $this->input->post('DRX2') : $result->DRX2_medicine_name,
				'DRX2_morning_dose' => ($this->input->post('DRX2_morning_dose')) ? $this->input->post('DRX2_morning_dose') : $result->DRX2_morning_dose,
				'DRX2_afternoon_dose' => ($this->input->post('DRX2_afternoon_dose')) ? $this->input->post('DRX2_afternoon_dose') : $result->DRX2_afternoon_dose,
				'DRX2_evening_dose' => ($this->input->post('DRX2_evening_dose')) ? $this->input->post('DRX2_evening_dose') : $result->DRX2_evening_dose,
				'DRX2_dose_day' => ($this->input->post('DRX2_dose_day')) ? $this->input->post('DRX2_dose_day') : $result->DRX2_dose_day,
				'DRX2_dose_take' => ($this->input->post('DRX2_dose_take')) ? $this->input->post('DRX2_dose_take') : $result->DRX2_dose_take,
				'DRX2_dose_anupan' => ($this->input->post('DRX2_dose_anupan')) ? $this->input->post('DRX2_dose_anupan') : $result->DRX2_dose_anupan,
				'DRX3_medicine_name' => ($this->input->post('DRX3')) ? $this->input->post('DRX3') : $result->DRX3_medicine_name,
				'DRX3_morning_dose' => ($this->input->post('DRX3_morning_dose')) ? $this->input->post('DRX3_morning_dose') : $result->DRX3_morning_dose,
				'DRX3_afternoon_dose' => ($this->input->post('DRX3_afternoon_dose')) ? $this->input->post('DRX3_afternoon_dose') : $result->DRX3_afternoon_dose,
				'DRX3_evening_dose' => ($this->input->post('DRX3_evening_dose')) ? $this->input->post('DRX3_evening_dose') : $result->DRX3_evening_dose,
				'DRX3_dose_day' => ($this->input->post('DRX3_dose_day')) ? $this->input->post('DRX3_dose_day') : $result->DRX3_dose_day,
				'DRX3_dose_take' => ($this->input->post('DRX3_dose_take')) ? $this->input->post('DRX3_dose_take') : $result->DRX3_dose_take,
				'DRX3_dose_anupan' => ($this->input->post('DRX3_dose_anupan')) ? $this->input->post('DRX3_dose_anupan') : $result->DRX3_dose_anupan,
				'SNEHAN' => ($this->input->post('SNEHAN')) ? $this->input->post('SNEHAN') : $result->SNEHAN,
				'SWEDAN' => ($this->input->post('SWEDAN')) ? $this->input->post('SWEDAN') : $result->SWEDAN,
				'VAMAN' => ($this->input->post('VAMAN')) ? $this->input->post('VAMAN') : $result->VAMAN,
				'VIRECHAN' => ($this->input->post('VIRECHAN')) ? $this->input->post('VIRECHAN') : $result->VIRECHAN,
				'BASTI' => ($this->input->post('BASTI')) ? $this->input->post('BASTI') : $result->BASTI,


				'local_examination' => ($this->input->post('local_examination')) ? $this->input->post('local_examination') : $result->local_examination,
				'old_investigation' => ($this->input->post('old_investigation')) ? $this->input->post('old_investigation') : $result->old_investigation,

				'NASYA' => ($this->input->post('NASYA')) ? $this->input->post('NASYA') : $result->NASYA,
				'RAKTAMOKSHAN' => ($this->input->post('RAKTAMOKSHAN')) ? $this->input->post('RAKTAMOKSHAN') : $result->RAKTAMOKSHAN,
				'SHIRODHARA_SHIROBASTI' => ($this->input->post('SHIRODHARA_SHIROBASTI')) ? $this->input->post('SHIRODHARA_SHIROBASTI') : $result->SHIRODHARA_SHIROBASTI,
				'OTHER' => ($this->input->post('OTHER')) ? $this->input->post('OTHER') : $result->OTHER,

				// 'HEMATOLOGICAL'       => ($this->input->post('HEMATOLOGICAL')) ? $this->input->post('HEMATOLOGICAL') : $result->HEMATOLOGICAL,
				// 'SEROLOGYCAL' 	   => ($this->input->post('SEROLOGYCAL')) ? $this->input->post('SEROLOGYCAL') : $result->SEROLOGYCAL,
				// 'BIOCHEMICAL' 	   => ($this->input->post('BIOCHEMICAL')) ? $this->input->post('BIOCHEMICAL') : $result->BIOCHEMICAL,
				// 'MICROBIOLOGICAL' 	   =>($this->input->post('MICROBIOLOGICAL')) ? $this->input->post('MICROBIOLOGICAL') : $result->MICROBIOLOGICAL,
				// 'X_RAY'   	   => ($this->input->post('X_RAY')) ? $this->input->post('X_RAY') : $result->X_RAY,
				// 'ECG'       => ($this->input->post('ECG')) ? $this->input->post('ECG') : $result->ECG,
				// 'USG'       => ($this->input->post('USG')) ? $this->input->post('USG') : $result->USG,

				'other_equipment' => ($this->input->post('other_equipment')) ? $this->input->post('other_equipment') : $result->other_equipment,

				'other_equipment_drx' => ($this->input->post('other_equipment_drx')) ? $this->input->post('other_equipment_drx') : $result->other_equipment_drx,

				'HEMATOLOGICAL' => ($hematological_label) ? $hematological_label : $result->HEMATOLOGICAL,
				'SEROLOGYCAL' => ($serologycal_label) ? $serologycal_label : $result->SEROLOGYCAL,
				'BIOCHEMICAL' => ($biochemical_label) ? $biochemical_label : $result->BIOCHEMICAL,
				'MICROBIOLOGICAL' => ($microbiological_label) ? $microbiological_label : $result->MICROBIOLOGICAL,
				'X_RAY' => ($xray_label) ? $xray_label : $result->X_RAY,
				'ECG' => ($this->input->post('ECG')) ? $this->input->post('ECG') : $result->ECG,
				'USG' => ($usg_label) ? $usg_label : $result->USG,






				'PHYSIOTHERAPY' => ($this->input->post('PHYSIOTHERAPY')) ? $this->input->post('PHYSIOTHERAPY') : $result->PHYSIOTHERAPY,
				'nadi' => ($this->input->post('nadi')) ? $this->input->post('nadi') : $result->nadi,
				'pulse' => ($this->input->post('pulse')) ? $this->input->post('pulse') : $result->pulse,
				'shudha' => ($this->input->post('shudha')) ? $this->input->post('shudha') : $result->shudha,
				'mal' => ($this->input->post('mal')) ? $this->input->post('mal') : $result->mal,
				'netra' => ($this->input->post('netra')) ? $this->input->post('netra') : $result->netra,
				'sym_name' => ($this->input->post('c_o')) ? $this->input->post('c_o') : $result->sym_name,
				'f_o' => (strtoupper($this->input->post('f_h'))) ? strtoupper($this->input->post('f_h')) : $result->f_o,
				'h_o' => (strtoupper($this->input->post('h_o'))) ? strtoupper($this->input->post('h_o')) : $result->h_o,
				'bp' => ($this->input->post('bp')) ? $this->input->post('bp') : $result->bp,
				'rs' => ($this->input->post('RS')) ? $this->input->post('RS') : $result->rs,
				'ra' => ($this->input->post('udar')) ? $this->input->post('udar') : $result->ra,
				'cvs' => ($this->input->post('cvs')) ? $this->input->post('cvs') : $result->cvs,
				'givwa' => ($this->input->post('givwa')) ? $this->input->post('givwa') : $result->givwa,
				'ahar' => ($this->input->post('ahar')) ? $this->input->post('ahar') : $result->ahar,
				'mutra' => ($this->input->post('mutra')) ? $this->input->post('mutra') : $result->mutra,
				'tapman' => ($this->input->post('tapman')) ? $this->input->post('tapman') : $result->tapman,
				'nidra' => ($this->input->post('nidra')) ? $this->input->post('nidra') : $result->nidra,

				'cns' => ($this->input->post('cns')) ? $this->input->post('cns') : $result->cns,

				'LMP' => ($this->input->post('LMP')) ? date("Y-m-d", strtotime($this->input->post('LMP'))) : $result->LMP,

				'NO_OF_DAYS' => ($this->input->post('NO_OF_DAYS')) ? $this->input->post('NO_OF_DAYS') : $result->NO_OF_DAYS,
				'PATTERN' => ($this->input->post('PATTERN')) ? $this->input->post('PATTERN') : $result->PATTERN,
				'FLOW' => ($this->input->post('FLOW')) ? $this->input->post('FLOW') : $result->FLOW,

				'Obstetric_History' => ($this->input->post('Obstetric_History')) ? $this->input->post('Obstetric_History') : $result->Obstetric_History,


				'Marita_Status' => ($this->input->post('Marita_Status')) ? $this->input->post('Marita_Status') : $result->Marita_Status,
				'Marital_years' => ($this->input->post('Marital_years')) ? $this->input->post('Marital_years') : $result->Marital_years,


				'round_time' => ($this->input->post('round_time')) ? $this->input->post('round_time') : $result->round_time,
				'weight' => ($this->input->post('weight')) ? $this->input->post('weight') : $result->weight,

				'ashthvidh_psriksha_mutra' => ($this->input->post('ashthvidh_psriksha_mutra')) ? $this->input->post('ashthvidh_psriksha_mutra') : $result->ashthvidh_psriksha_mutra,
				'temp' => ($this->input->post('temp')) ? $this->input->post('temp') : $result->temp,
				'kco' => ($this->input->post('kco')) ? $this->input->post('kco') : $result->kco,
				'e_o' => ($this->input->post('e_o')) ? $this->input->post('e_o') : $result->e_o,
				'pconcent' => ($this->input->post('pconcent')) ? $this->input->post('pconcent') : $result->pconcent,
				'SPO2' => ($this->input->post('SPO2')) ? $this->input->post('SPO2') : $result->SPO2,
				'pa' => ($this->input->post('pa')) ? $this->input->post('pa') : $result->pa,
				'pr' => ($this->input->post('pr')) ? $this->input->post('pr') : $result->pr,
				'pv' => ($this->input->post('pv')) ? $this->input->post('pv') : $result->pv,
				'Only_1st_Dose' => ($this->input->post('Only_1st_Dose')) ? $this->input->post('Only_1st_Dose') : $result->Only_1st_Dose,
				'Pr_Op_Medication' => ($this->input->post('Pr_Op_Medication')) ? $this->input->post('Pr_Op_Medication') : $result->Pr_Op_Medication,
				'Pr_Op_Medication2nd' => ($this->input->post('Pr_Op_Medication2nd')) ? $this->input->post('Pr_Op_Medication2nd') : $result->Pr_Op_Medication2nd,
				'Post_Operative' => ($this->input->post('Post_Operative')) ? $this->input->post('Post_Operative') : $result->Post_Operative,
				'ICU_Order' => ($this->input->post('ICU_Order')) ? $this->input->post('ICU_Order') : $result->ICU_Order,
				'DRX1' => ($this->input->post('DRX1')) ? $this->input->post('DRX1') : $result->DRX1,
				'DRX2' => ($this->input->post('DRX2')) ? $this->input->post('DRX2') : $result->DRX2,
				'DRX3' => ($this->input->post('DRX3')) ? $this->input->post('DRX3') : $result->DRX3,
				'Input' => ($this->input->post('Input')) ? $this->input->post('Input') : $result->Input,
				'Output' => ($this->input->post('Output')) ? $this->input->post('Output') : $result->Output,
				'Sp_Investigations_pandamic' => ($this->input->post('Sp_Investigations_pandamic')) ? $this->input->post('Sp_Investigations_pandamic') : $result->Sp_Investigations_pandamic,
				'Only_2nd_Day_Morning_covid' => ($this->input->post('Only_2nd_Day_Morning_covid')) ? $this->input->post('Only_2nd_Day_Morning_covid') : $result->Only_2nd_Day_Morning_covid,

				'SROTAS' => ($this->input->post('SROTAS')) ? $this->input->post('SROTAS') : $result->SROTAS,
				'DOSHA' => ($this->input->post('DOSHA')) ? $this->input->post('DOSHA') : $result->DOSHA,
				'DUSHYA' => ($this->input->post('DUSHYA')) ? $this->input->post('DUSHYA') : $result->DUSHYA,
				'SHIROBASTI' => ($this->input->post('SHIROBASTI')) ? $this->input->post('SHIROBASTI') : $result->SHIROBASTI,
				'skarma' => ($this->input->post('skarma')) ? $this->input->post('skarma') : $result->skarma,
				'vkarma' => ($this->input->post('vkarma')) ? $this->input->post('vkarma') : $result->vkarma,
				'swa1' => ($this->input->post('swa1')) ? $this->input->post('swa1') : $result->SWA1,
				'swa2' => ($this->input->post('swa2')) ? $this->input->post('swa2') : $result->SWA2,



				'surgical_history' => ($this->input->post('surgical_history')) ? $this->input->post('surgical_history') : $result->surgical_history,
				'nidra1' => ($this->input->post('nidra1')) ? $this->input->post('nidra1') : $result->nidra1,
				'vyasan' => ($this->input->post('vyasan')) ? $this->input->post('vyasan') : $result->vyasan,
				'urine' => ($this->input->post('urine')) ? $this->input->post('urine') : $result->urine,
				'purish_pravrutti' => ($this->input->post('purish_pravrutti')) ? $this->input->post('purish_pravrutti') : $result->purish_pravrutti,
				'stool' => ($this->input->post('stool')) ? $this->input->post('stool') : $result->stool,
				'apanvayu' => ($this->input->post('apanvayu')) ? $this->input->post('apanvayu') : $result->apanvayu,
				'koshth' => ($this->input->post('koshth')) ? $this->input->post('koshth') : $result->koshth,
				'prakruti' => ($this->input->post('prakruti')) ? $this->input->post('prakruti') : $result->prakruti,
				'shariripraman' => ($this->input->post('shariripraman')) ? $this->input->post('shariripraman') : $result->shariripraman,
				'aharshakti' => ($this->input->post('aharshakti')) ? $this->input->post('aharshakti') : $result->aharshakti,
				'vyayam_shakti' => ($this->input->post('vyayam_shakti')) ? $this->input->post('vyayam_shakti') : $result->vyayam_shakti,
				'samprapti_ghatak' => ($this->input->post('samprapti_ghatak')) ? $this->input->post('samprapti_ghatak') : $result->samprapti_ghatak,
				'vishesh_shtrots_pariksha' => ($this->input->post('vishesh_shtrots_pariksha')) ? $this->input->post('vishesh_shtrots_pariksha') : $result->vishesh_shtrots_pariksha,
				'naidanik_pariksha' => ($this->input->post('naidanik_pariksha')) ? $this->input->post('naidanik_pariksha') : $result->naidanik_pariksha,
				'vyavched_nidan' => ($this->input->post('vyavched_nidan')) ? $this->input->post('vyavched_nidan') : $result->vyavched_nidan,
				'vyadhi_vinishray' => ($this->input->post('vyadhi_vinishray')) ? $this->input->post('vyadhi_vinishray') : $result->vyadhi_vinishray,

				'k_one' => ($this->input->post('k_one')) ? $this->input->post('k_one') : $result->k_one,
				'k_two' => ($this->input->post('k_two')) ? $this->input->post('k_two') : $result->k_two,
				'axil_length' => ($this->input->post('axil_length')) ? $this->input->post('axil_length') : $result->axil_length,
				'pciol' => ($this->input->post('pciol')) ? $this->input->post('pciol') : $result->pciol,
				'sac_syringing_le' => ($this->input->post('sac_syringing_le')) ? $this->input->post('sac_syringing_le') : $result->sac_syringing_le,
				'sac_syringing_re' => ($this->input->post('sac_syringing_re')) ? $this->input->post('sac_syringing_re') : $result->sac_syringing_re,
				'iop_re_ipd' => ($this->input->post('iop_re_ipd')) ? $this->input->post('iop_re_ipd') : $result->iop_re_ipd,
				'iop_le_ipd' => ($this->input->post('iop_le_ipd')) ? $this->input->post('iop_le_ipd') : $result->iop_le_ipd,
				'stanik' => ($this->input->post('stanik')) ? $this->input->post('stanik') : $result->stanik,
				'sarvdaivik' => ($this->input->post('sarvdaivik')) ? $this->input->post('sarvdaivik') : $result->sarvdaivik,
				'purvkarm' => ($this->input->post('purvkarm')) ? $this->input->post('purvkarm') : $result->purvkarm,
				'paschat_karm' => ($this->input->post('vyadhi_vinishray')) ? $this->input->post('vyadhi_vinishray') : $result->paschat_karm,
				'pradhankarm' => ($this->input->post('pradhankarm')) ? $this->input->post('pradhankarm') : $result->pradhankarm,
				'POVISIONALdignosis' => ($this->input->post('final_dignosis')) ? $this->input->post('final_dignosis') : $result->POVISIONALdignosis,



				'skya' => ($this->input->post('dept_type')) ? $this->input->post('dept_type') : $result->skya,
				'PAST_HISTORY' => ($this->input->post('PAST_HISTORY')) ? $this->input->post('PAST_HISTORY') : $result->PAST_HISTORY,
				'BAHYA_NETRA_RE' => ($this->input->post('BAHYA_NETRA_RE')) ? $this->input->post('BAHYA_NETRA_RE') : $result->BAHYA_NETRA_RE,
				'VARTMA_MANDAL_RE' => ($this->input->post('VARTMA_MANDAL_RE')) ? $this->input->post('VARTMA_MANDAL_RE') : $result->VARTMA_MANDAL_RE,
				'SHUKL_MANDAL_RE' => ($this->input->post('SHUKL_MANDAL_RE')) ? $this->input->post('SHUKL_MANDAL_RE') : $result->SHUKL_MANDAL_RE,
				'KRUSHNA_MANDAL_RE' => ($this->input->post('KRUSHNA_MANDAL_RE')) ? $this->input->post('KRUSHNA_MANDAL_RE') : $result->KRUSHNA_MANDAL_RE,
				'TARKA_MANDAL_RE' => ($this->input->post('TARKA_MANDAL_RE')) ? $this->input->post('TARKA_MANDAL_RE') : $result->TARKA_MANDAL_RE,
				'DRUSHTI_MANDAL_RE' => ($this->input->post('DRUSHTI_MANDAL_RE')) ? $this->input->post('DRUSHTI_MANDAL_RE') : $result->DRUSHTI_MANDAL_RE,
				'PURV_VESHMA_RE' => ($this->input->post('PURV_VESHMA_RE')) ? $this->input->post('PURV_VESHMA_RE') : $result->PURV_VESHMA_RE,
				'BAHYA_NETRA_LE' => ($this->input->post('BAHYA_NETRA_LE')) ? $this->input->post('BAHYA_NETRA_LE') : $result->BAHYA_NETRA_LE,
				'VARTMA_MANDAL_LE' => ($this->input->post('VARTMA_MANDAL_LE')) ? $this->input->post('VARTMA_MANDAL_LE') : $result->VARTMA_MANDAL_LE,
				'SHUKL_MANDAL_LE' => ($this->input->post('SHUKL_MANDAL_LE')) ? $this->input->post('SHUKL_MANDAL_LE') : $result->SHUKL_MANDAL_LE,
				'KRUSHNA_MANDAL_LE' => ($this->input->post('KRUSHNA_MANDAL_LE')) ? $this->input->post('KRUSHNA_MANDAL_LE') : $result->KRUSHNA_MANDAL_LE,
				'TARKA_MANDAL_LE' => ($this->input->post('TARKA_MANDAL_LE')) ? $this->input->post('TARKA_MANDAL_LE') : $result->TARKA_MANDAL_LE,
				'DRUSHTI_MANDAL_LE' => ($this->input->post('DRUSHTI_MANDAL_LE')) ? $this->input->post('DRUSHTI_MANDAL_LE') : $result->DRUSHTI_MANDAL_LE,
				'PURV_VESHMA_LE' => ($this->input->post('PURV_VESHMA_LE')) ? $this->input->post('PURV_VESHMA_LE') : $result->PURV_VESHMA_LE,
				'ABHING_RE' => ($this->input->post('ABHING_RE')) ? $this->input->post('ABHING_RE') : $result->ABHING_RE,
				'ABHING_LE' => ($this->input->post('ABHING_LE')) ? $this->input->post('ABHING_LE') : $result->ABHING_LE,
				'SABHING_RE' => ($this->input->post('SABHING_RE')) ? $this->input->post('SABHING_RE') : $result->SABHING_RE,
				'SABHING_LE' => ($this->input->post('SABHING_LE')) ? $this->input->post('SABHING_LE') : $result->SABHING_LE,
				'IOP_RE' => ($this->input->post('IOP_RE')) ? $this->input->post('IOP_RE') : $result->IOP_RE,
				'IOP_LE' => ($this->input->post('IOP_LE')) ? $this->input->post('IOP_LE') : $result->IOP_LE,
				'GONISCOPY' => ($this->input->post('GONISCOPY')) ? $this->input->post('GONISCOPY') : $result->GONISCOPY,
				'PUPIL_RE' => ($this->input->post('PUPIL_RE')) ? $this->input->post('PUPIL_RE') : $result->PUPIL_RE,
				'LENS_RE' => ($this->input->post('LENS_RE')) ? $this->input->post('LENS_RE') : $result->LENS_RE,
				'OD_RE' => ($this->input->post('OD_RE')) ? $this->input->post('OD_RE') : $result->OD_RE,
				'CDR_RE' => ($this->input->post('CDR_RE')) ? $this->input->post('CDR_RE') : $result->CDR_RE,
				'MACULA_RE' => ($this->input->post('MACULA_RE')) ? $this->input->post('MACULA_RE') : $result->MACULA_RE,
				'BLOOD_VESSELS_RE' => ($this->input->post('BLOOD_VESSELS_RE')) ? $this->input->post('BLOOD_VESSELS_RE') : $result->BLOOD_VESSELS_RE,
				'PERIPHERAL_RETINA_RE' => ($this->input->post('PERIPHERAL_RETINA_RE')) ? $this->input->post('PERIPHERAL_RETINA_RE') : $result->PERIPHERAL_RETINA_RE,
				'PUPIL_LE' => ($this->input->post('PUPIL_LE')) ? $this->input->post('PUPIL_LE') : $result->PUPIL_LE,
				'LENS_LE' => ($this->input->post('LENS_LE')) ? $this->input->post('LENS_LE') : $result->LENS_LE,
				'OD_LE' => ($this->input->post('OD_LE')) ? $this->input->post('OD_LE') : $result->OD_LE,
				'CDR_LE' => ($this->input->post('CDR_LE')) ? $this->input->post('CDR_LE') : $result->CDR_LE,
				'MACULA_LE' => ($this->input->post('MACULA_LE')) ? $this->input->post('MACULA_LE') : $result->MACULA_LE,
				'BLOOD_VESSELS_LE' => ($this->input->post('BLOOD_VESSELS_LE')) ? $this->input->post('BLOOD_VESSELS_LE') : $result->BLOOD_VESSELS_LE,
				'PERIPHERAL_RETINA_LE' => ($this->input->post('PERIPHERAL_RETINA_LE')) ? $this->input->post('PERIPHERAL_RETINA_LE') : $result->PERIPHERAL_RETINA_LE,
				'BAHYA_KARN_RE' => ($this->input->post('BAHYA_KARN_RE')) ? $this->input->post('BAHYA_KARN_RE') : $result->BAHYA_KARN_RE,
				'KARN_KUHAR_RE' => ($this->input->post('KARN_KUHAR_RE')) ? $this->input->post('KARN_KUHAR_RE') : $result->KARN_KUHAR_RE,
				'MADHYA_KARNA_RE' => ($this->input->post('MADHYA_KARNA_RE')) ? $this->input->post('MADHYA_KARNA_RE') : $result->MADHYA_KARNA_RE,
				'BAHYA_KARN_LE' => ($this->input->post('BAHYA_KARN_LE')) ? $this->input->post('BAHYA_KARN_LE') : $result->BAHYA_KARN_LE,
				'KARN_KUHAR_LE' => ($this->input->post('KARN_KUHAR_LE')) ? $this->input->post('KARN_KUHAR_LE') : $result->KARN_KUHAR_LE,
				'MADHYA_KARNA_LE' => ($this->input->post('MADHYA_KARNA_LE')) ? $this->input->post('MADHYA_KARNA_LE') : $result->MADHYA_KARNA_LE,
				'BAHYA_NASIKA_RE' => ($this->input->post('BAHYA_NASIKA_RE')) ? $this->input->post('BAHYA_NASIKA_RE') : $result->BAHYA_NASIKA_RE,
				'NASAGUHA_RE' => ($this->input->post('NASAGUHA_RE')) ? $this->input->post('NASAGUHA_RE') : $result->NASAGUHA_RE,
				'SHAILSHRIK_KALA_RE' => ($this->input->post('SHAILSHRIK_KALA_RE')) ? $this->input->post('SHAILSHRIK_KALA_RE') : $result->SHAILSHRIK_KALA_RE,
				'BAHYA_NASIKA_LE' => ($this->input->post('BAHYA_NASIKA_LE')) ? $this->input->post('BAHYA_NASIKA_LE') : $result->BAHYA_NASIKA_LE,
				'NASAGUHA_LE' => ($this->input->post('NASAGUHA_LE')) ? $this->input->post('NASAGUHA_LE') : $result->NASAGUHA_LE,
				'SHAILSHRIK_KALA_LE' => ($this->input->post('SHAILSHRIK_KALA_LE')) ? $this->input->post('SHAILSHRIK_KALA_LE') : $result->SHAILSHRIK_KALA_LE,
				'OSHTH' => ($this->input->post('OSHTH')) ? $this->input->post('OSHTH') : $result->OSHTH,
				'DANT' => ($this->input->post('DANT')) ? $this->input->post('DANT') : $result->DANT,
				'JIVHA' => ($this->input->post('JIVHA')) ? $this->input->post('JIVHA') : $result->JIVHA,
				'TALU' => ($this->input->post('TALU')) ? $this->input->post('TALU') : $result->TALU,
				'GILAYU' => ($this->input->post('GILAYU')) ? $this->input->post('GILAYU') : $result->GILAYU,
				'GAL_SHUNDIKA' => ($this->input->post('GAL_SHUNDIKA')) ? $this->input->post('GAL_SHUNDIKA') : $result->GAL_SHUNDIKA,
				'KANTH' => ($this->input->post('KANTH')) ? $this->input->post('KANTH') : $result->KANTH,
				'AKRUTI' => ($this->input->post('AKRUTI')) ? $this->input->post('AKRUTI') : $result->AKRUTI,
				'KAPALASTHI' => ($this->input->post('KAPALASTHI')) ? $this->input->post('KAPALASTHI') : $result->KAPALASTHI,
				'OTHER_CKECKUP' => ($this->input->post('OTHER_CKECKUP')) ? $this->input->post('OTHER_CKECKUP') : $result->OTHER_CKECKUP,
				'SHASRAKARM' => ($this->input->post('SHASRAKARM')) ? $this->input->post('SHASRAKARM') : $result->SHASRAKARM,
				'OPERATIVE_NOTES' => ($this->input->post('OPERATIVE_NOTES')) ? $this->input->post('OPERATIVE_NOTES') : $result->OPERATIVE_NOTES,
				'POST_OPERATIVE_NOTES' => ($this->input->post('POST_OPERATIVE_NOTES')) ? $this->input->post('POST_OPERATIVE_NOTES') : $result->POST_OPERATIVE_NOTES,

				'updated_at' => date("Y-m-d H:i:s")


			];
		} else {
			$data['patient'] = (object) $postData = [
				'dignosis' => $this->input->post('dignosis'),
				'patient_id_auto' => $this->input->post('patient_id'),
				'panch_adv_flag' => $this->input->post('panch_adv_flag'),
				'department_id' => $this->input->post('department_id'),
				'ipd_opd' => $this->input->post('ipd_opd'),
				'ipd_round_date' => ($this->input->post('roundDate')) ? date('Y-m-d', strtotime($this->input->post('roundDate'))) : NULL,
				'rounds' => ($this->input->post('round')) ? $this->input->post('round') : NULL,
				'ipd_days' => ($this->input->post('ipd_days')) ? $this->input->post('ipd_days') : NULL,
				'RX1' => ($RX1) ? $RX1 : NULL,
				'RX2' => ($RX2) ? $RX2 : NULL,
				'RX3' => ($RX3) ? $RX3 : NULL,
				'RX4' => ($RX4) ? $RX4 : NULL,
				'RX5' => ($RX5) ? $RX5 : NULL,
				'RX_other' => ($RX_other) ? $RX_other : NULL,
				'RX_other1' => ($RX_other1) ? $RX_other1 : NULL,

				'DRX1' => ($DRX1) ? $DRX1 : NULL,
				'DRX2' => ($DRX2) ? $DRX2 : NULL,
				'DRX3' => ($DRX3) ? $DRX3 : NULL,

				'RX1_medicine_name' => ($this->input->post('RX1')) ? $this->input->post('RX1') : NULL,
				'RX1_morning_dose' => ($this->input->post('morning_dose_rx1')) ? $this->input->post('morning_dose_rx1') : NULL,
				'RX1_afternoon_dose' => ($this->input->post('afternoon_dose_rx1')) ? $this->input->post('afternoon_dose_rx1') : NULL,
				'RX1_evening_dose' => ($this->input->post('evening_dose_rx1')) ? $this->input->post('evening_dose_rx1') : NULL,
				'RX1_dose_day' => ($this->input->post('dose_day_rx1')) ? $this->input->post('dose_day_rx1') : NULL,
				'RX1_dose_take' => ($this->input->post('dose_take_with_rx1')) ? $this->input->post('dose_take_with_rx1') : NULL,
				'RX1_dose_anupan' => ($this->input->post('dose_anupan_rx1')) ? $this->input->post('dose_anupan_rx1') : NULL,
				'RX2_medicine_name' => ($this->input->post('RX2')) ? $this->input->post('RX2') : NULL,
				'RX2_morning_dose' => ($this->input->post('morning_dose_rx2')) ? $this->input->post('morning_dose_rx2') : NULL,
				'RX2_afternoon_dose' => ($this->input->post('afternoon_dose_rx2')) ? $this->input->post('afternoon_dose_rx2') : NULL,
				'RX2_evening_dose' => ($this->input->post('evening_dose_rx2')) ? $this->input->post('evening_dose_rx2') : NULL,
				'RX2_dose_day' => ($this->input->post('dose_day_rx2')) ? $this->input->post('dose_day_rx2') : NULL,
				'RX2_dose_take' => ($this->input->post('dose_take_with_rx2')) ? $this->input->post('dose_take_with_rx2') : NULL,
				'RX2_dose_anupan' => ($this->input->post('dose_anupan_rx2')) ? $this->input->post('dose_anupan_rx2') : NULL,
				'RX3_medicine_name' => ($this->input->post('RX3')) ? $this->input->post('RX3') : NULL,
				'RX3_morning_dose' => ($this->input->post('morning_dose_rx3')) ? $this->input->post('morning_dose_rx3') : NULL,
				'RX3_afternoon_dose' => ($this->input->post('afternoon_dose_rx3')) ? $this->input->post('afternoon_dose_rx3') : NULL,
				'RX3_evening_dose' => ($this->input->post('evening_dose_rx3')) ? $this->input->post('evening_dose_rx3') : NULL,
				'RX3_dose_day' => ($this->input->post('dose_day_rx3')) ? $this->input->post('dose_day_rx3') : NULL,
				'RX3_dose_take' => ($this->input->post('dose_take_with_rx3')) ? $this->input->post('dose_take_with_rx3') : NULL,
				'RX3_dose_anupan' => ($this->input->post('dose_anupan_rx3')) ? $this->input->post('dose_anupan_rx3') : NULL,
				'RX4_medicine_name' => ($this->input->post('RX4')) ? $this->input->post('RX4') : NULL,
				'RX4_morning_dose' => ($this->input->post('morning_dose_rx4')) ? $this->input->post('morning_dose_rx4') : NULL,
				'RX4_afternoon_dose' => ($this->input->post('afternoon_dose_rx4')) ? $this->input->post('afternoon_dose_rx4') : NULL,
				'RX4_evening_dose' => ($this->input->post('evening_dose_rx4')) ? $this->input->post('evening_dose_rx4') : NULL,
				'RX4_dose_day' => ($this->input->post('dose_day_rx4')) ? $this->input->post('dose_day_rx4') : NULL,
				'RX4_dose_take' => ($this->input->post('dose_take_with_rx4')) ? $this->input->post('dose_take_with_rx4') : NULL,
				'RX4_dose_anupan' => ($this->input->post('dose_anupan_rx4')) ? $this->input->post('dose_anupan_rx4') : NULL,
				'RX5_medicine_name' => ($this->input->post('RX5')) ? $this->input->post('RX5') : NULL,
				'RX5_morning_dose' => ($this->input->post('morning_dose_rx5')) ? $this->input->post('morning_dose_rx5') : NULL,
				'RX5_afternoon_dose' => ($this->input->post('afternoon_dose_rx5')) ? $this->input->post('afternoon_dose_rx5') : NULL,
				'RX5_evening_dose' => ($this->input->post('evening_dose_rx5')) ? $this->input->post('evening_dose_rx5') : NULL,
				'RX5_dose_day' => ($this->input->post('dose_day_rx5')) ? $this->input->post('dose_day_rx5') : NULL,
				'RX5_dose_take' => ($this->input->post('dose_take_with_rx5')) ? $this->input->post('dose_take_with_rx5') : NULL,
				'RX5_dose_anupan' => ($this->input->post('dose_anupan_rx5')) ? $this->input->post('dose_anupan_rx5') : NULL,


				'RX_other_medicine_name' => ($this->input->post('RX_other')) ? $this->input->post('RX_other') : NULL,
				'morning_dose_rx_other' => ($this->input->post('morning_dose_rx_other')) ? $this->input->post('morning_dose_rx_other') : NULL,
				'afternoon_dose_rx_other' => ($this->input->post('afternoon_dose_rx_other')) ? $this->input->post('afternoon_dose_rx_other') : NULL,
				'evening_dose_rx_other' => ($this->input->post('evening_dose_rx_other')) ? $this->input->post('evening_dose_rx_other') : NULL,
				'dose_day_rx_other' => ($this->input->post('dose_day_rx_other')) ? $this->input->post('dose_day_rx_other') : NULL,
				'dose_take_with_rx_other' => ($this->input->post('dose_take_with_rx_other')) ? $this->input->post('dose_take_with_rx_other') : NULL,
				'dose_anupan_rx_other' => ($this->input->post('dose_anupan_rx_other')) ? $this->input->post('dose_anupan_rx_other') : NULL,
				'RX_other1_medicine_name' => ($this->input->post('RX_other1')) ? $this->input->post('RX_other1') : NULL,
				'morning_dose_rx_other1' => ($this->input->post('morning_dose_rx_other1')) ? $this->input->post('morning_dose_rx_other1') : NULL,
				'afternoon_dose_rx_other1' => ($this->input->post('afternoon_dose_rx_other1')) ? $this->input->post('afternoon_dose_rx_other1') : NULL,
				'evening_dose_rx_other1' => ($this->input->post('evening_dose_rx_other1')) ? $this->input->post('evening_dose_rx_other1') : NULL,
				'dose_day_rx_other1' => ($this->input->post('dose_day_rx_other1')) ? $this->input->post('dose_day_rx_other1') : NULL,
				'dose_take_with_rx_other1' => ($this->input->post('dose_take_with_rx_other1')) ? $this->input->post('dose_take_with_rx_other1') : NULL,
				'dose_anupan_rx_other1' => ($this->input->post('dose_anupan_rx_other1')) ? $this->input->post('dose_anupan_rx_other1') : NULL,


				'DRX1_medicine_name' => ($this->input->post('DRX1')) ? $this->input->post('DRX1') : NULL,
				'DRX1_morning_dose' => ($this->input->post('DRX1_morning_dose')) ? $this->input->post('DRX1_morning_dose') : NULL,
				'DRX1_afternoon_dose' => ($this->input->post('DRX1_afternoon_dose')) ? $this->input->post('DRX1_afternoon_dose') : NULL,
				'DRX1_evening_dose' => ($this->input->post('DRX1_evening_dose')) ? $this->input->post('DRX1_evening_dose') : NULL,
				'DRX1_dose_day' => ($this->input->post('DRX1_dose_day')) ? $this->input->post('DRX1_dose_day') : NULL,
				'DRX1_dose_take' => ($this->input->post('DRX1_dose_take')) ? $this->input->post('DRX1_dose_take') : NULL,
				'DRX1_dose_anupan' => ($this->input->post('DRX1_dose_anupan')) ? $this->input->post('DRX1_dose_anupan') : NULL,
				'DRX2_medicine_name' => ($this->input->post('DRX2')) ? $this->input->post('DRX2') : NULL,
				'DRX2_morning_dose' => ($this->input->post('DRX2_morning_dose')) ? $this->input->post('DRX2_morning_dose') : NULL,
				'DRX2_afternoon_dose' => ($this->input->post('DRX2_afternoon_dose')) ? $this->input->post('DRX2_afternoon_dose') : NULL,
				'DRX2_evening_dose' => ($this->input->post('DRX2_evening_dose')) ? $this->input->post('DRX2_evening_dose') : NULL,
				'DRX2_dose_day' => ($this->input->post('DRX2_dose_day')) ? $this->input->post('DRX2_dose_day') : NULL,
				'DRX2_dose_take' => ($this->input->post('DRX2_dose_take')) ? $this->input->post('DRX2_dose_take') : NULL,
				'DRX2_dose_anupan' => ($this->input->post('DRX2_dose_anupan')) ? $this->input->post('DRX2_dose_anupan') : NULL,
				'DRX3_medicine_name' => ($this->input->post('DRX3')) ? $this->input->post('DRX3') : NULL,
				'DRX3_morning_dose' => ($this->input->post('DRX3_morning_dose')) ? $this->input->post('DRX3_morning_dose') : NULL,
				'DRX3_afternoon_dose' => ($this->input->post('DRX3_afternoon_dose')) ? $this->input->post('DRX3_afternoon_dose') : NULL,
				'DRX3_evening_dose' => ($this->input->post('DRX3_evening_dose')) ? $this->input->post('DRX3_evening_dose') : NULL,
				'DRX3_dose_day' => ($this->input->post('DRX3_dose_day')) ? $this->input->post('DRX3_dose_day') : NULL,
				'DRX3_dose_take' => ($this->input->post('DRX3_dose_take')) ? $this->input->post('DRX3_dose_take') : NULL,
				'DRX3_dose_anupan' => ($this->input->post('DRX3_dose_anupan')) ? $this->input->post('DRX3_dose_anupan') : NULL,
				'SNEHAN' => ($this->input->post('SNEHAN')) ? $this->input->post('SNEHAN') : NULL,
				'SWEDAN' => ($this->input->post('SWEDAN')) ? $this->input->post('SWEDAN') : NULL,
				'VAMAN' => ($this->input->post('VAMAN')) ? $this->input->post('VAMAN') : NULL,
				'VIRECHAN' => ($this->input->post('VIRECHAN')) ? $this->input->post('VIRECHAN') : NULL,
				'BASTI' => ($this->input->post('BASTI')) ? $this->input->post('BASTI') : NULL,

				'NASYA' => ($this->input->post('NASYA')) ? $this->input->post('NASYA') : NULL,
				'RAKTAMOKSHAN' => ($this->input->post('RAKTAMOKSHAN')) ? $this->input->post('RAKTAMOKSHAN') : NULL,
				'SHIRODHARA_SHIROBASTI' => ($this->input->post('SHIRODHARA_SHIROBASTI')) ? $this->input->post('SHIRODHARA_SHIROBASTI') : NULL,
				'OTHER' => ($this->input->post('OTHER')) ? $this->input->post('OTHER') : NULL,

				// 'HEMATOLOGICAL'       => ($this->input->post('HEMATOLOGICAL')) ? $this->input->post('HEMATOLOGICAL') : NULL,
				// 'SEROLOGYCAL' 	   => ($this->input->post('SEROLOGYCAL')) ? $this->input->post('SEROLOGYCAL') : NULL,
				// 'BIOCHEMICAL' 	   => ($this->input->post('BIOCHEMICAL')) ? $this->input->post('BIOCHEMICAL') : NULL,
				// 'MICROBIOLOGICAL' 	   =>($this->input->post('MICROBIOLOGICAL')) ? $this->input->post('MICROBIOLOGICAL') : NULL,
				// 'X_RAY'   	   => ($this->input->post('X_RAY')) ? $this->input->post('X_RAY') : NULL,
				// 'ECG'       => ($this->input->post('ECG')) ? $this->input->post('ECG') : NULL,
				// 'USG'       => ($this->input->post('USG')) ? $this->input->post('USG') : NULL,

				'HEMATOLOGICAL' => ($hematological_label) ? $hematological_label : NULL,
				'SEROLOGYCAL' => ($serologycal_label) ? $serologycal_label : NULL,
				'BIOCHEMICAL' => ($biochemical_label) ? $biochemical_label : NULL,
				'MICROBIOLOGICAL' => ($microbiological_label) ? $microbiological_label : NULL,
				'X_RAY' => ($xray_label) ? $xray_label : NULL,
				'ECG' => ($this->input->post('ECG')) ? $this->input->post('ECG') : NULL,
				'USG' => ($usg_label) ? $usg_label : NULL,

				'other_equipment' => ($this->input->post('other_equipment')) ? $this->input->post('other_equipment') : NULL,

				'other_equipment_drx' => ($this->input->post('other_equipment_drx')) ? $this->input->post('other_equipment_drx') : NULL,


				'PHYSIOTHERAPY' => ($this->input->post('PHYSIOTHERAPY')) ? $this->input->post('PHYSIOTHERAPY') : NULL,
				'nadi' => ($this->input->post('nadi')) ? $this->input->post('nadi') : NULL,
				'pulse' => ($this->input->post('pulse')) ? $this->input->post('pulse') : NULL,
				'shudha' => ($this->input->post('shudha')) ? $this->input->post('shudha') : NULL,
				'mal' => ($this->input->post('mal')) ? $this->input->post('mal') : NULL,
				'netra' => ($this->input->post('netra')) ? $this->input->post('netra') : NULL,
				'sym_name' => ($this->input->post('c_o')) ? $this->input->post('c_o') : NULL,
				'f_o' => (strtoupper($this->input->post('f_h'))) ? strtoupper($this->input->post('f_h')) : NULL,
				'h_o' => (strtoupper($this->input->post('h_o'))) ? strtoupper($this->input->post('h_o')) : NULL,
				'bp' => ($this->input->post('bp')) ? $this->input->post('bp') : NULL,
				'rs' => ($this->input->post('RS')) ? $this->input->post('RS') : NULL,
				'ra' => ($this->input->post('udar')) ? $this->input->post('udar') : NULL,
				'cvs' => ($this->input->post('cvs')) ? $this->input->post('cvs') : NULL,
				'givwa' => ($this->input->post('givwa')) ? $this->input->post('givwa') : NULL,

				'ahar' => ($this->input->post('ahar')) ? $this->input->post('ahar') : NULL,
				'mutra' => ($this->input->post('mutra')) ? $this->input->post('mutra') : NULL,

				'tapman' => ($this->input->post('tapman')) ? $this->input->post('tapman') : NULL,
				'nidra' => ($this->input->post('nidra')) ? $this->input->post('nidra') : NULL,

				'LMP' => ($this->input->post('LMP')) ? date("Y-m-d", strtotime($this->input->post('LMP'))) : NULL,

				'NO_OF_DAYS' => ($this->input->post('NO_OF_DAYS')) ? $this->input->post('NO_OF_DAYS') : NULL,
				'PATTERN' => ($this->input->post('PATTERN')) ? $this->input->post('PATTERN') : NULL,
				'FLOW' => ($this->input->post('FLOW')) ? $this->input->post('FLOW') : NULL,

				'Obstetric_History' => ($this->input->post('Obstetric_History')) ? $this->input->post('Obstetric_History') : NULL,
				'Marita_Status' => ($this->input->post('Marita_Status')) ? $this->input->post('Marita_Status') : NULL,
				'Marital_years' => ($this->input->post('Marital_years')) ? $this->input->post('Marital_years') : NULL,


				'round_time' => ($this->input->post('round_time')) ? $this->input->post('round_time') : NULL,
				'weight' => ($this->input->post('weight')) ? $this->input->post('weight') : NULL,

				'ashthvidh_psriksha_mutra' => ($this->input->post('ashthvidh_psriksha_mutra')) ? $this->input->post('ashthvidh_psriksha_mutra') : NULL,
				'temp' => ($this->input->post('temp')) ? $this->input->post('temp') : NULL,
				'kco' => ($this->input->post('kco')) ? $this->input->post('kco') : NULL,
				'e_o' => ($this->input->post('e_o')) ? $this->input->post('e_o') : NULL,
				'pconcent' => ($this->input->post('pconcent')) ? $this->input->post('pconcent') : NULL,
				'cns' => ($this->input->post('cns')) ? $this->input->post('cns') : NULL,
				'SPO2' => ($this->input->post('SPO2')) ? $this->input->post('SPO2') : NULL,
				'pa' => ($this->input->post('pa')) ? $this->input->post('pa') : NULL,
				'pr' => ($this->input->post('pr')) ? $this->input->post('pr') : NULL,
				'pv' => ($this->input->post('pv')) ? $this->input->post('pv') : NULL,
				'Only_1st_Dose' => ($this->input->post('Only_1st_Dose')) ? $this->input->post('Only_1st_Dose') : NULL,
				'Pr_Op_Medication' => ($this->input->post('Pr_Op_Medication')) ? $this->input->post('Pr_Op_Medication') : NULL,
				'Pr_Op_Medication2nd' => ($this->input->post('Pr_Op_Medication2nd')) ? $this->input->post('Pr_Op_Medication2nd') : NULL,
				'Post_Operative' => ($this->input->post('Post_Operative')) ? $this->input->post('Post_Operative') : NULL,
				'ICU_Order' => ($this->input->post('ICU_Order')) ? $this->input->post('ICU_Order') : NULL,
				'DRX1' => ($this->input->post('DRX1')) ? $this->input->post('DRX1') : NULL,
				'DRX2' => ($this->input->post('DRX2')) ? $this->input->post('DRX2') : NULL,
				'DRX3' => ($this->input->post('DRX3')) ? $this->input->post('DRX3') : NULL,
				'Input' => ($this->input->post('Input')) ? $this->input->post('Input') : NULL,
				'Output' => ($this->input->post('Output')) ? $this->input->post('Output') : NULL,
				'Sp_Investigations_pandamic' => ($this->input->post('Sp_Investigations_pandamic')) ? $this->input->post('Sp_Investigations_pandamic') : NULL,
				'Only_2nd_Day_Morning_covid' => ($this->input->post('Only_2nd_Day_Morning_covid')) ? $this->input->post('Only_2nd_Day_Morning_covid') : NULL,
				'SROTAS' => ($this->input->post('SROTAS')) ? $this->input->post('SROTAS') : NULL,
				'DOSHA' => ($this->input->post('DOSHA')) ? $this->input->post('DOSHA') : NULL,
				'DUSHYA' => ($this->input->post('DUSHYA')) ? $this->input->post('DUSHYA') : NULL,
				'SHIROBASTI' => ($this->input->post('SHIROBASTI')) ? $this->input->post('SHIROBASTI') : NULL,
				'skarma' => ($this->input->post('skarma')) ? $this->input->post('skarma') : NULL,
				'vkarma' => ($this->input->post('vkarma')) ? $this->input->post('vkarma') : NULL,
				'swa1' => ($this->input->post('swa1')) ? $this->input->post('swa1') : NULL,
				'swa2' => ($this->input->post('swa2')) ? $this->input->post('swa2') : NULL,
				'local_examination' => ($this->input->post('local_examination')) ? $this->input->post('local_examination') : NULL,
				'old_investigation' => ($this->input->post('old_investigation')) ? $this->input->post('old_investigation') : NULL,

				'surgical_history' => ($this->input->post('surgical_history')) ? $this->input->post('surgical_history') : NULL,
				'nidra1' => ($this->input->post('nidra1')) ? $this->input->post('nidra1') : NULL,
				'vyasan' => ($this->input->post('vyasan')) ? $this->input->post('vyasan') : NULL,
				'urine' => ($this->input->post('urine')) ? $this->input->post('urine') : NULL,
				'purish_pravrutti' => ($this->input->post('purish_pravrutti')) ? $this->input->post('purish_pravrutti') : NULL,
				'stool' => ($this->input->post('stool')) ? $this->input->post('stool') : NULL,
				'apanvayu' => ($this->input->post('apanvayu')) ? $this->input->post('apanvayu') : NULL,
				'koshth' => ($this->input->post('koshth')) ? $this->input->post('koshth') : NULL,
				'prakruti' => ($this->input->post('prakruti')) ? $this->input->post('prakruti') : NULL,
				'shariripraman' => ($this->input->post('shariripraman')) ? $this->input->post('shariripraman') : NULL,
				'aharshakti' => ($this->input->post('aharshakti')) ? $this->input->post('aharshakti') : NULL,
				'vyayam_shakti' => ($this->input->post('vyayam_shakti')) ? $this->input->post('vyayam_shakti') : NULL,
				'samprapti_ghatak' => ($this->input->post('samprapti_ghatak')) ? $this->input->post('samprapti_ghatak') : NULL,
				'vishesh_shtrots_pariksha' => ($this->input->post('vishesh_shtrots_pariksha')) ? $this->input->post('vishesh_shtrots_pariksha') : NULL,
				'naidanik_pariksha' => ($this->input->post('naidanik_pariksha')) ? $this->input->post('naidanik_pariksha') : NULL,
				'vyavched_nidan' => ($this->input->post('vyavched_nidan')) ? $this->input->post('vyavched_nidan') : NULL,
				'vyadhi_vinishray' => ($this->input->post('vyadhi_vinishray')) ? $this->input->post('vyadhi_vinishray') : NULL,



				'k_one' => ($this->input->post('k_one')) ? $this->input->post('k_one') : NULL,
				'k_two' => ($this->input->post('k_two')) ? $this->input->post('k_two') : NULL,
				'axil_length' => ($this->input->post('axil_length')) ? $this->input->post('axil_length') : NULL,
				'pciol' => ($this->input->post('pciol')) ? $this->input->post('pciol') : NULL,
				'sac_syringing_le' => ($this->input->post('sac_syringing_le')) ? $this->input->post('sac_syringing_le') : NULL,
				'sac_syringing_re' => ($this->input->post('sac_syringing_re')) ? $this->input->post('sac_syringing_re') : NULL,
				'iop_re_ipd' => ($this->input->post('iop_re_ipd')) ? $this->input->post('iop_re_ipd') : NULL,
				'iop_le_ipd' => ($this->input->post('iop_le_ipd')) ? $this->input->post('iop_le_ipd') : NULL,
				'stanik' => ($this->input->post('stanik')) ? $this->input->post('stanik') : NULL,
				'sarvdaivik' => ($this->input->post('sarvdaivik')) ? $this->input->post('sarvdaivik') : NULL,
				'purvkarm' => ($this->input->post('purvkarm')) ? $this->input->post('purvkarm') : NULL,
				'paschat_karm' => ($this->input->post('vyadhi_vinishray')) ? $this->input->post('vyadhi_vinishray') : NULL,
				'pradhankarm' => ($this->input->post('pradhankarm')) ? $this->input->post('pradhankarm') : NULL,
				'POVISIONALdignosis' => ($this->input->post('final_dignosis')) ? $this->input->post('final_dignosis') : NULL,



				'skya' => ($this->input->post('dept_type')) ? $this->input->post('dept_type') : NULL,
				'PAST_HISTORY' => ($this->input->post('PAST_HISTORY')) ? $this->input->post('PAST_HISTORY') : NULL,
				'BAHYA_NETRA_RE' => ($this->input->post('BAHYA_NETRA_RE')) ? $this->input->post('BAHYA_NETRA_RE') : NULL,
				'VARTMA_MANDAL_RE' => ($this->input->post('VARTMA_MANDAL_RE')) ? $this->input->post('VARTMA_MANDAL_RE') : NULL,
				'SHUKL_MANDAL_RE' => ($this->input->post('SHUKL_MANDAL_RE')) ? $this->input->post('SHUKL_MANDAL_RE') : NULL,
				'KRUSHNA_MANDAL_RE' => ($this->input->post('KRUSHNA_MANDAL_RE')) ? $this->input->post('KRUSHNA_MANDAL_RE') : NULL,
				'TARKA_MANDAL_RE' => ($this->input->post('TARKA_MANDAL_RE')) ? $this->input->post('TARKA_MANDAL_RE') : NULL,
				'DRUSHTI_MANDAL_RE' => ($this->input->post('DRUSHTI_MANDAL_RE')) ? $this->input->post('DRUSHTI_MANDAL_RE') : NULL,
				'PURV_VESHMA_RE' => ($this->input->post('PURV_VESHMA_RE')) ? $this->input->post('PURV_VESHMA_RE') : NULL,
				'BAHYA_NETRA_LE' => ($this->input->post('BAHYA_NETRA_LE')) ? $this->input->post('BAHYA_NETRA_LE') : NULL,
				'VARTMA_MANDAL_LE' => ($this->input->post('VARTMA_MANDAL_LE')) ? $this->input->post('VARTMA_MANDAL_LE') : NULL,
				'SHUKL_MANDAL_LE' => ($this->input->post('SHUKL_MANDAL_LE')) ? $this->input->post('SHUKL_MANDAL_LE') : NULL,
				'KRUSHNA_MANDAL_LE' => ($this->input->post('KRUSHNA_MANDAL_LE')) ? $this->input->post('KRUSHNA_MANDAL_LE') : NULL,
				'TARKA_MANDAL_LE' => ($this->input->post('TARKA_MANDAL_LE')) ? $this->input->post('TARKA_MANDAL_LE') : NULL,
				'DRUSHTI_MANDAL_LE' => ($this->input->post('DRUSHTI_MANDAL_LE')) ? $this->input->post('DRUSHTI_MANDAL_LE') : NULL,
				'PURV_VESHMA_LE' => ($this->input->post('PURV_VESHMA_LE')) ? $this->input->post('PURV_VESHMA_LE') : NULL,
				'ABHING_RE' => ($this->input->post('ABHING_RE')) ? $this->input->post('ABHING_RE') : NULL,
				'ABHING_LE' => ($this->input->post('ABHING_LE')) ? $this->input->post('ABHING_LE') : NULL,
				'SABHING_RE' => ($this->input->post('SABHING_RE')) ? $this->input->post('SABHING_RE') : NULL,
				'SABHING_LE' => ($this->input->post('SABHING_LE')) ? $this->input->post('SABHING_LE') : NULL,
				'IOP_RE' => ($this->input->post('IOP_RE')) ? $this->input->post('IOP_RE') : NULL,
				'IOP_LE' => ($this->input->post('IOP_LE')) ? $this->input->post('IOP_LE') : NULL,
				'GONISCOPY' => ($this->input->post('GONISCOPY')) ? $this->input->post('GONISCOPY') : NULL,
				'PUPIL_RE' => ($this->input->post('PUPIL_RE')) ? $this->input->post('PUPIL_RE') : NULL,
				'LENS_RE' => ($this->input->post('LENS_RE')) ? $this->input->post('LENS_RE') : NULL,
				'OD_RE' => ($this->input->post('OD_RE')) ? $this->input->post('OD_RE') : NULL,
				'CDR_RE' => ($this->input->post('CDR_RE')) ? $this->input->post('CDR_RE') : NULL,
				'MACULA_RE' => ($this->input->post('MACULA_RE')) ? $this->input->post('MACULA_RE') : NULL,
				'BLOOD_VESSELS_RE' => ($this->input->post('BLOOD_VESSELS_RE')) ? $this->input->post('BLOOD_VESSELS_RE') : NULL,
				'PERIPHERAL_RETINA_RE' => ($this->input->post('PERIPHERAL_RETINA_RE')) ? $this->input->post('PERIPHERAL_RETINA_RE') : NULL,
				'PUPIL_LE' => ($this->input->post('PUPIL_LE')) ? $this->input->post('PUPIL_LE') : NULL,
				'LENS_LE' => ($this->input->post('LENS_LE')) ? $this->input->post('LENS_LE') : NULL,
				'OD_LE' => ($this->input->post('OD_LE')) ? $this->input->post('OD_LE') : NULL,
				'CDR_LE' => ($this->input->post('CDR_LE')) ? $this->input->post('CDR_LE') : NULL,
				'MACULA_LE' => ($this->input->post('MACULA_LE')) ? $this->input->post('MACULA_LE') : NULL,
				'BLOOD_VESSELS_LE' => ($this->input->post('BLOOD_VESSELS_LE')) ? $this->input->post('BLOOD_VESSELS_LE') : NULL,
				'PERIPHERAL_RETINA_LE' => ($this->input->post('PERIPHERAL_RETINA_LE')) ? $this->input->post('PERIPHERAL_RETINA_LE') : NULL,
				'BAHYA_KARN_RE' => ($this->input->post('BAHYA_KARN_RE')) ? $this->input->post('BAHYA_KARN_RE') : NULL,
				'KARN_KUHAR_RE' => ($this->input->post('KARN_KUHAR_RE')) ? $this->input->post('KARN_KUHAR_RE') : NULL,
				'MADHYA_KARNA_RE' => ($this->input->post('MADHYA_KARNA_RE')) ? $this->input->post('MADHYA_KARNA_RE') : NULL,
				'BAHYA_KARN_LE' => ($this->input->post('BAHYA_KARN_LE')) ? $this->input->post('BAHYA_KARN_LE') : NULL,
				'KARN_KUHAR_LE' => ($this->input->post('KARN_KUHAR_LE')) ? $this->input->post('KARN_KUHAR_LE') : NULL,
				'MADHYA_KARNA_LE' => ($this->input->post('MADHYA_KARNA_LE')) ? $this->input->post('MADHYA_KARNA_LE') : NULL,
				'BAHYA_NASIKA_RE' => ($this->input->post('BAHYA_NASIKA_RE')) ? $this->input->post('BAHYA_NASIKA_RE') : NULL,
				'NASAGUHA_RE' => ($this->input->post('NASAGUHA_RE')) ? $this->input->post('NASAGUHA_RE') : NULL,
				'SHAILSHRIK_KALA_RE' => ($this->input->post('SHAILSHRIK_KALA_RE')) ? $this->input->post('SHAILSHRIK_KALA_RE') : NULL,
				'BAHYA_NASIKA_LE' => ($this->input->post('BAHYA_NASIKA_LE')) ? $this->input->post('BAHYA_NASIKA_LE') : NULL,
				'NASAGUHA_LE' => ($this->input->post('NASAGUHA_LE')) ? $this->input->post('NASAGUHA_LE') : NULL,
				'SHAILSHRIK_KALA_LE' => ($this->input->post('SHAILSHRIK_KALA_LE')) ? $this->input->post('SHAILSHRIK_KALA_LE') : NULL,
				'OSHTH' => ($this->input->post('OSHTH')) ? $this->input->post('OSHTH') : NULL,
				'DANT' => ($this->input->post('DANT')) ? $this->input->post('DANT') : NULL,
				'JIVHA' => ($this->input->post('JIVHA')) ? $this->input->post('JIVHA') : NULL,
				'TALU' => ($this->input->post('TALU')) ? $this->input->post('TALU') : NULL,
				'GILAYU' => ($this->input->post('GILAYU')) ? $this->input->post('GILAYU') : NULL,
				'GAL_SHUNDIKA' => ($this->input->post('GAL_SHUNDIKA')) ? $this->input->post('GAL_SHUNDIKA') : NULL,
				'KANTH' => ($this->input->post('KANTH')) ? $this->input->post('KANTH') : NULL,
				'AKRUTI' => ($this->input->post('AKRUTI')) ? $this->input->post('AKRUTI') : NULL,
				'KAPALASTHI' => ($this->input->post('KAPALASTHI')) ? $this->input->post('KAPALASTHI') : NULL,
				'OTHER_CKECKUP' => ($this->input->post('OTHER_CKECKUP')) ? $this->input->post('OTHER_CKECKUP') : NULL,
				'SHASRAKARM' => ($this->input->post('SHASRAKARM')) ? $this->input->post('SHASRAKARM') : NULL,
				'OPERATIVE_NOTES' => ($this->input->post('OPERATIVE_NOTES')) ? $this->input->post('OPERATIVE_NOTES') : NULL,
				'POST_OPERATIVE_NOTES' => ($this->input->post('POST_OPERATIVE_NOTES')) ? $this->input->post('POST_OPERATIVE_NOTES') : NULL,

				'created_at' => date("Y-m-d H:i:s")

			];
		}

		// print_r($postData);
		// die();

		$id = $this->input->post('patient_id');
		$data['patient'] = (object) $postData1 = [
			'id' => $this->input->post('patient_id'),
			'dignosis' => $this->input->post('dignosis'),
			'manual_status' => '1'
		];


		if ($section == 'ipd') {

			if ($result) {
				//update
				/*print_r($result->id);
				die();*/
				$this->patient_model->update_manual_treatment($postData1, $section);
				if ($this->patient_model->edit_manual_treatment($postData, $section, $result->id)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
			} else {
				//create
				$this->patient_model->update_manual_treatment($postData1, $section);
				if ($this->patient_model->create_manual_treatment($postData, $section)) {
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
			}
		} else {
			if ($result) {
				//update
				/*print_r($result->id);
				die();*/
				$this->patient_model->update_manual_treatment($postData1, $section);
				if ($this->patient_model->edit_manual_treatment($postData, $section, $result->id)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
			} else {
				//create
				$this->patient_model->update_manual_treatment($postData1, $section);
				if ($this->patient_model->create_manual_treatment($postData, $section)) {
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
			}
		}
		if ($section == 'ipd') {
			redirect('patients/ipdprofile/' . $id);
		} else {
			redirect('patients/profile/' . $id);
		}



		// $this->patient_model->update_manual_treatment($postData1,$section);
		// if ($this->patient_model->create_manual_treatment($postData,$section)) {			

		// #set success message
		// $this->session->set_flashdata('message', display('save_successfully'));
		// } else {
		// #set exception message
		// $this->session->set_flashdata('exception', display('please_try_again'));
		// }
		// if($section=='ipd'){
		// redirect('patients/ipdprofile/'.$id);
		// } else{
		// redirect('patients/profile/'.$id);
		// }      
	}



	public function check_patient_manual_treatment()
	{
		$id = $this->input->post('patient_id');
		$roundDate = date('Y-m-d', strtotime($this->input->post('roundDate')));
		$round = $this->input->post('round');
		$section = $this->input->post('section');

		$result = $this->db->where(['patient_id_auto' => $id, 'ipd_round_date' => $roundDate, 'rounds' => $round, 'ipd_opd' => $section])
			->limit(1)
			->group_by('id')
			->get('manual_treatments')
			->row();
		echo json_encode($result);

	}




	public function getDistinctTreatment()
	{
		$dept_id = $this->input->post('department_id');
		$id = $this->input->post('id');
		$opd_no = $this->input->post('opd_no');
		$update_old_reg_no = $this->input->post('update_old_reg_no');
		$ipd_opd = $this->input->post('ipd_opd');

		$this->db->select('dISTINCT(dignosis)');
		if ($dept_id) {
			$this->db->where('department_id', $dept_id);
		}
		$result = $this->db->get('treatments1')->result();

		if ($id != '' && $ipd_opd != '') {
			if ($ipd_opd == 'opd') {
				$result1 = $this->db->select('dignosis')->where(['id' => $id, 'ipd_opd' => $ipd_opd])->get('patient')->row();
			} else if ($ipd_opd == 'ipd') {
				$result1 = $this->db->select('dignosis')->where(['id' => $id, 'ipd_opd' => $ipd_opd])->get('patient_ipd')->row();
			}
		} else if ($opd_no != '' && $ipd_opd != '') {
			//if($ipd_opd=='opd'){
			$result1 = $this->db->select('dignosis')->where(['yearly_reg_no' => $opd_no, 'ipd_opd' => 'opd'])->order_by('create_date', 'ASC')->get('patient')->row();
			// }else if($ipd_opd=='ipd'){
			//     $result1 = $this->db->select('dignosis')->where(['yearly_reg_no'=>$opd_no, 'ipd_opd'=>$ipd_opd])->order_by('create_date','ASC')->get('patient')->row();
			// }
		} else if ($update_old_reg_no != '' && $ipd_opd != '') {
			//if($ipd_opd=='opd'){
			$result1 = $this->db->select('dignosis')->where(['yearly_reg_no' => $update_old_reg_no, 'ipd_opd' => 'opd'])->order_by('create_date', 'ASC')->get('patient')->row();
			// }else if($ipd_opd=='ipd'){
			//     $result1 = $this->db->select('dignosis')->where(['yearly_reg_no'=>$update_old_reg_no, 'ipd_opd'=>$ipd_opd])->order_by('create_date','ASC')->get('patient')->row();
			// }
		} else {
			$result1 = '';
		}
		$res = array('diagnosisArr' => $result, 'patientDiagnosis' => $result1);
		echo json_encode($res);
		//return $result;
	}

	public function patient_summery($section = '')
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		//$end_date1   = $this->input->get('end_date', TRUE);
		$end_date1 = $start_date1;
		//$data['section'] = $section;

		$start_date2 = date('Y-m-d', strtotime($start_date1));

		$end_date2 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);
		$data['section'] = $section;
		$start_date = $start_date2;
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";

		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$date1 = date_create($start_date2);
		$date2 = date_create($end_date2);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '1';
		}



		if ($section == 'opd') {
			$data['patients'] = $this->db->select("*")
				->from('patient')
				->join('department', 'department.dprt_id =  patient.department_id')
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)
				->where('create_date <=', $end_date)
				->where('create_date LIKE', $year)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		}


		if ($data == null) {
			$data['content'] = $this->load->view('patient_summery', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		} else {
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patient_summery', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}


	}

	public function patient_history()
	{
		$data['title'] = display('patient_information');

		$cyear = $this->session->userdata['acyear'];
		$data['search_value'] = $search_value = ($this->input->post('opd_no')) ? $this->input->post('opd_no') : NULL;
		$data['section'] = $section = ($this->input->post('section')) ? $this->input->post('section') : NULL;

		if ($search_value && $section) {
			if ($section == 'opd') {
				$tableName = "patient";
			} else {
				$tableName = "patient_ipd";
			}
			$data['patient_data'] = $this->db->where('yearly_reg_no', $search_value)
				->where('ipd_opd', $section)
				->where('year(create_date)', $cyear)
				->or_where('old_reg_no', $search_value)
				->where('ipd_opd', $section)
				->where('year(create_date)', $cyear)
				->or_where('firstname like ', '%' . $search_value . '%')
				->where('ipd_opd', $section)
				->where('year(create_date)', $cyear)
				->get($tableName)
				->result();
		} else {
			$data['patient_data'] = NULL;
		}

		$data['content'] = $this->load->view('patient_history', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}





	public function get_monthly_headwise_all_bill_report_summary($start_date = '', $end_date = '')
	{
		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = ($this->input->get('start_date', TRUE)) ? $this->input->get('start_date', TRUE) : $start_date;
		$end_date1 = ($this->input->get('end_date', TRUE)) ? $this->input->get('end_date', TRUE) : $end_date;
		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = date('Y-m-d', strtotime($end_date1));
		//$section = $this->input->get('section', TRUE);
		//$section = ($this->input->get('section', TRUE))?$this->input->get('section', TRUE):$section;
		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$date1 = date_create($start_date2);
		$date2 = date_create($end_date2);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		$data['date_diff'] = $diff + 1;

		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '1';
		}

		if ($start_date) {
			$data['patients_opd'] = $this->db->select("*")
				->from('patient')
				->join('department', 'department.dprt_id =  patient.department_id')
				->where('ipd_opd', 'opd')
				->where('create_date >=', $start_date)
				->where('create_date <=', $end_date)
				//->where('yearly_reg_no !=','')
				->where('create_date LIKE', $year)
				->get()
				->result();


			$data['department_by_section'] = 'opd';
		} else {
			$data['datefrom'] = '';
			$data['dateto'] = '';
		}

		$data['medicine_cost'] = $this->db->select("*")
			->from('medicine_cost')
			->get()
			->row();

		/*$data['profile'] = $this->patient_model->read_by_id($patient_id);
		$data['documents'] = $this->document_model->read_by_patient($patient_id);*/
		$data['content'] = $this->load->view('profile_all_bill_headwise_opd_report', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}



	public function get_monthly_headwise_bill_report_ipd($start_date = '', $end_date = '')
	{
		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = ($this->input->get('start_date', TRUE)) ? $this->input->get('start_date', TRUE) : $start_date;
		$end_date1 = ($this->input->get('end_date', TRUE)) ? $this->input->get('end_date', TRUE) : $end_date;
		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = date('Y-m-d', strtotime($end_date1));
		//$section = $this->input->get('section', TRUE);
		//$section = ($this->input->get('section', TRUE))?$this->input->get('section', TRUE):$section;
		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$date1 = date_create($start_date2);
		$date2 = date_create($end_date2);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		$data['date_diff'] = $diff + 1;

		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '1';
		}

		if ($start_date) {

			$data['patients_ipd'] = $this->db->select("*")
				->from('patient_ipd')
				->join('department', 'department.dprt_id =  patient_ipd.department_id')
				->where('ipd_opd', 'ipd')
				// 		->where('create_date >=', $start_date2)
				// 		->where('create_date <=', $end_date2)
				->where('discharge_date >=', $start_date2)
				->where('discharge_date <=', $end_date2)
				->or_where('discharge_date', date('Y/m/d', strtotime($start_date2)))
				->where('discharge_date', date('Y/m/d', strtotime($end_date2)))
				// 		->where('discharge_date !=', '0000-00-00')
				// 		->where('create_date LIKE', $year)
				->get()
				->result();
			// 		print_r($this->db->last_query());
			// 		die();

			$data['department_by_section'] = 'ipd';

		} else {
			$data['datefrom'] = '';
			$data['dateto'] = '';
		}

		$data['medicine_cost'] = $this->db->select("*")
			->from('medicine_cost')
			->get()
			->row();

		/*$data['profile'] = $this->patient_model->read_by_id($patient_id);
		$data['documents'] = $this->document_model->read_by_patient($patient_id);*/
		$data['content'] = $this->load->view('profile_all_bill_headwise_ipd_report', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}



	public function get_all_bills($section = '')
	{
		$data['title'] = display('patient_information');
		#-------------------------------#

		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		//$end_date1   = $this->input->get('end_date', TRUE);
		$end_date1 = $start_date1;

		$start_date2 = date('Y-m-d', strtotime($start_date1));

		$end_date2 = date('Y-m-d', strtotime($end_date1));

		//$section = $this->input->get('section', TRUE);
		$section = ($this->input->get('section', TRUE)) ? $this->input->get('section', TRUE) : $section;


		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";

		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$date1 = date_create($start_date2);
		$date2 = date_create($end_date2);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '1';
		}



		if ($section == 'opd') {
			$data['patients'] = $this->db->select("*")

				->from('patient')

				->join('department', 'department.dprt_id =  patient.department_id')

				->where('ipd_opd', $section)

				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)

				//->where('yearly_reg_no !=','')

				->where('create_date LIKE', $year)

				->get()

				->result();


			$data['department_by_section'] = 'opd';
		} else {

			$data['patients'] = $this->db->select("*")

				->from('patient_ipd')

				->join('department', 'department.dprt_id =  patient_ipd.department_id')

				->where('ipd_opd', $section)

				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)

				->where('create_date LIKE', $year)

				->get()

				->result();


			$data['department_by_section'] = 'ipd';
		}


		/*$data['profile'] = $this->patient_model->read_by_id($patient_id);
		$data['documents'] = $this->document_model->read_by_patient($patient_id);*/
		$data['content'] = $this->load->view('profile_all_bill', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function get_all_ipd_bills($section = '')
	{
		$data['title'] = display('patient_information');
		#-------------------------------#

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		//$end_date1   = $this->input->get('end_date', TRUE);
		$end_date1 = $start_date1;
		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = date('Y-m-d', strtotime($end_date1));
		//$section = $this->input->get('section', TRUE);
		$section = ($this->input->get('section', TRUE)) ? $this->input->get('section', TRUE) : $section;
		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$date1 = date_create($start_date2);
		$date2 = date_create($end_date2);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");

		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '1';
		}

		if ($section == 'opd') {
			$data['patients'] = $this->db->select("*")
				->from('patient')
				->join('department', 'department.dprt_id =  patient.department_id')
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)
				->where('create_date <=', $end_date)
				->where('yearly_reg_no !=', '')
				->where('create_date LIKE', $year)
				->get()
				->result();


			$data['department_by_section'] = 'opd';
		} else {

			$data['patients'] = $this->db->select("*")
				->from('patient_ipd')
				->join('department', 'department.dprt_id =  patient_ipd.department_id')
				->where('ipd_opd', 'ipd')
				// 		->where('create_date >=', $start_date2)
				// 		->where('create_date <=', $end_date2)
				->where('discharge_date', $start_date2)
				->or_where('discharge_date', date('Y/m/d', strtotime($start_date2)))
				// 		->where('discharge_date !=', '0000-00-00')
				// 		->where('create_date LIKE', $year)
				->get()
				->result();
			// 		print_r($this->db->last_query());
			// 		die();

			$y = date('Y', strtotime($start_date2));
			$checkDate = $y . '-01-01';
			if ($checkDate == $start_date2) {
				$data['ipd_recepti_num'] = 0;
			} else {
				$cnt = $this->db->select("*")
					->from('patient_ipd')
					->join('department', 'department.dprt_id =  patient_ipd.department_id')
					->where('ipd_opd', 'ipd')
					->where('discharge_date < ', $start_date2)
					->where('discharge_date >= ', $checkDate)
					->get()
					->num_rows();
				$data['ipd_recepti_num'] = $cnt;
			}

			$data['department_by_section'] = 'ipd';
		}


		/*$data['profile'] = $this->patient_model->read_by_id($patient_id);
		$data['documents'] = $this->document_model->read_by_patient($patient_id);*/
		$data['content'] = $this->load->view('profile_ipd_all_bill', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function get_monthly_bill_report($start_date = '', $end_date = '', $finacial_year = '')
	{
		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = ($this->input->get('start_date', TRUE)) ? $this->input->get('start_date', TRUE) : $start_date;
		$end_date1 = ($this->input->get('end_date', TRUE)) ? $this->input->get('end_date', TRUE) : $end_date;

		$finacial_year = ($this->input->get('finacial_year', TRUE)) ? $this->input->get('finacial_year', TRUE) : $finacial_year;

		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = date('Y-m-d', strtotime($end_date1));
		//$section = $this->input->get('section', TRUE);
		//$section = ($this->input->get('section', TRUE))?$this->input->get('section', TRUE):$section;
		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$date1 = date_create($start_date2);
		$date2 = date_create($end_date2);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		$data['date_diff'] = $diff + 1;

		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '1';
		}

		if ($start_date) {
			$data['patients_opd'] = $this->db->select("*")
				->from('patient')
				->join('department', 'department.dprt_id =  patient.department_id')
				->where('ipd_opd', 'opd')
				->where('create_date >=', $start_date)
				->where('create_date <=', $end_date)
				//->where('yearly_reg_no !=','')
				->where('create_date LIKE', $year)
				->get()
				->result();


			$data['department_by_section'] = 'opd';

			$data['patients_ipd'] = $this->db->select("*")
				->from('patient_ipd')
				->join('department', 'department.dprt_id =  patient_ipd.department_id')
				->where('ipd_opd', 'ipd')
				// 		->where('create_date >=', $start_date2)
				// 		->where('create_date <=', $end_date2)
				->where('discharge_date >=', $start_date2)
				->where('discharge_date <=', $end_date2)
				->or_where('discharge_date', date('Y/m/d', strtotime($start_date2)))
				->where('discharge_date', date('Y/m/d', strtotime($end_date2)))
				// 		->where('discharge_date !=', '0000-00-00')
				// 		->where('create_date LIKE', $year)
				->get()
				->result();
			// 		print_r($this->db->last_query());
			// 		die();

			$data['department_by_section'] = 'ipd';
			$data['finacial_year'] = $finacial_year;
		} else {
			$data['datefrom'] = '';
			$data['dateto'] = '';
			$data['finacial_year'] = '';
		}

		// $data['medicine_cost'] =$this->db->select("*")
		//     ->from('medicine_cost')
		//     ->get()
		//     ->row();

		/*$data['profile'] = $this->patient_model->read_by_id($patient_id);
		$data['documents'] = $this->document_model->read_by_patient($patient_id);*/
		$data['content'] = $this->load->view('profile_all_bill_report', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function get_bill_summery_report($section = '')
	{
		$data['title'] = display('patient_information');
		#-------------------------------#

		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);


		$start_date2 = date('Y-m-d', strtotime($start_date1));

		$end_date2 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);
		//$section = ($this->input->get('section', TRUE))?$this->input->get('section', TRUE):$section;


		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";

		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;

		$date1 = date_create($start_date2);
		$date2 = date_create($end_date2);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '1';
		}



		if ($section == 'opd') {
			$data['patients'] = $this->db->select("*")

				->from('patient')

				->join('department', 'department.dprt_id =  patient.department_id')

				->where('ipd_opd', $section)

				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)

				//->where('yearly_reg_no !=','')

				->where('create_date LIKE', $year)

				->get()

				->result();


			$data['department_by_section'] = 'opd';
		} else {
			$data['patients'] = $this->db->select("*")
				->from('patient_ipd')
				->join('department', 'department.dprt_id =  patient_ipd.department_id')
				->where('ipd_opd', 'ipd')
				// 		->where('create_date >=', $start_date2)
				// 		->where('create_date <=', $end_date2)
				->where('discharge_date', $start_date2)
				->or_where('discharge_date', date('Y/m/d', strtotime($start_date2)))
				// 		->where('discharge_date !=', '0000-00-00')
				// 		->where('create_date LIKE', $year)
				->get()
				->result();
			// 		print_r($this->db->last_query());
			// 		die();

			$y = date('Y', strtotime($start_date2));
			$checkDate = $y . '-01-01';
			if ($checkDate == $start_date2) {
				$data['ipd_recepti_num'] = 0;
			} else {
				$cnt = $this->db->select("*")
					->from('patient_ipd')
					->join('department', 'department.dprt_id =  patient_ipd.department_id')
					->where('ipd_opd', 'ipd')
					->where('discharge_date < ', $start_date2)
					->where('discharge_date >= ', $checkDate)
					->get()
					->num_rows();
				$data['ipd_recepti_num'] = $cnt;
			}

			$data['department_by_section'] = 'ipd';
		}


		/*$data['profile'] = $this->patient_model->read_by_id($patient_id);
		$data['documents'] = $this->document_model->read_by_patient($patient_id);*/
		$data['content'] = $this->load->view('profile_all_bill_summery', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}
	public function getHivReport()
	{
		$data['title'] = display('hiv_report');
		#-------------------------------#

		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);


		$start_date2 = ($start_date1) ? date('Y-m-d', strtotime($start_date1)) : date('Y-m-d');

		$end_date2 = ($end_date1) ? date('Y-m-d', strtotime($end_date1)) : date('Y-m-d');

		$section = $this->input->get('section', TRUE);
		//$section = ($this->input->get('section', TRUE))?$this->input->get('section', TRUE):$section;


		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date_f = $end_date2 . " 23:59:00";



		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date_f;
		$data['section'] = $section;

		// print_r($start_date);
		// print_r($end_date_f);
		// print_r($section);


		if ($section == 'opd') {
			$this->db->select('yearly_reg_no');
			$this->db->from('patient_ipd');
			$this->db->where('discharge_date >=', $start_date_f);
			$this->db->where('create_date <=', $end_date_f);
			$this->db->where('ipd_opd', 'ipd');
			$subQuery = $this->db->get_compiled_select();

			$this->db->where('create_date >=', $start_date_f);
			$this->db->where('create_date <=', $end_date_f);
			$this->db->where("yearly_reg_no NOT IN ($subQuery)", NULL, FALSE);
			$this->db->where('ipd_opd', 'opd');
			$patientList = $this->db->get('patient')->result();
			$data['patientList'] = $patientList;
		} else {
			$patientList = $this->db->select("*")
				->from('patient_ipd')
				->join('department', 'department.dprt_id = patient_ipd.department_id')
				->where('create_date >=', $start_date_f)
				->where('create_date <=', $end_date_f)
				->where('ipd_opd', 'ipd')
				->get()
				->result();

			//print_r('q2   ');                    
			//print_r($this->db->last_query());
			//$patientList = array_merge($patients1, $patients2); 

			$data['patientList'] = $patientList;
		}
		// print_r($patientList);
		//print_r($this->db->last_query());
		// die();
		$data['content'] = $this->load->view('patient_investi_hiv', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function delivery_register()
	{

		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->delivery_registerM('ipd');

		$section = 'ipd';

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'ipd') {
			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		} else {

			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = '2019';
		$data['dateto'] = '2019';
		$data['department_by'] = 'dpt';
		//   $data['department_id'] = $department_id_decode;
		if ($section == 'ipd') {

			$data['content'] = $this->load->view('delivery_register', $data, true);
		}


		$this->load->view('layout/main_wrapper', $data);
	}

	public function patient_diet()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		//$end_date1   = $this->input->get('start_date', TRUE);
		$start_date2 = date('Y-m-d', strtotime($start_date1));
		//$end_date2   = date('Y-m-d',strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		//$end_date= $end_date2." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $start_date;

		$current_date = date("Y-m-d");

		$this->db->select('*');
		$this->db->where('create_date >=', $start_date_f);
		$this->db->where('create_date <=', $start_date_f);
		//	$this->db->where('create_date<=',$current_date);
		$this->db->where('ipd_opd', $section);
		$this->db->order_by('create_date', 'asc');
		$patient_diet = $this->db->get('patient_diet_result');
		$result = $patient_diet->result();
		$num = $patient_diet->num_rows();
		if ($num > 0) {
			$data['patient_data'] = $result;
		} else {
			$data['patients1'] = $this->db->select("*")
				->from('patient_ipd')
				->join('department', 'department.dprt_id = patient_ipd.department_id')
				->where('discharge_date >=', $start_date_f)
				->where('create_date <=', $start_date_f)
				->where('ipd_opd', 'ipd')
				->get()
				->result();

			// print_r($this->db->last_query());
			// die();

			$data['patients2'] = $this->db->select("*")
				->from('patient_ipd')
				->join('department', 'department.dprt_id = patient_ipd.department_id')
				->where('create_date <=', $start_date_f)
				->where('discharge_date LIKE', '%0000-00-00%')
				->where('ipd_opd', 'ipd')
				->get()
				->result();

			$ipd_patients = array_merge($data['patients1'], $data['patients2']);
			//  echo $ipd_patients;
			$data['department_by_section'] = 'ipd';

			foreach ($ipd_patients as $patients) {


				$che = trim($patients->dignosis);
				$section_tret = 'ipd';
				$len = strlen($che);
				$dd = substr($che, $len - 1);
				$str = $patients->dignosis;
				$arry = explode("-", $str);
				$t_c = count($arry);
				if ($t_c == '2') {
					$dd1 = substr($che, 0, -1);
					$new_str = trim($arry[0]);
					$p_dignosis = '%' . $new_str . '%';
					$p_dignosis_name = $patients->dignosis;
				} else {
					$p_dignosis = '%' . $che . '%';
					$p_dignosis_name = $patients->dignosis;
				}

				$this->db->select('*');
				$this->db->where('ipd_opd', 'ipd');
				$this->db->where('id <', $patients->id);
				// $this->db->where('create_date <=', $d_ipd_no);
				$this->db->where('create_date LIKE', date('Y', strtotime($start_date_f)));
				$query = $this->db->get('patient_ipd');
				$num_ipd_change = $query->num_rows();
				$tot_serial_ipd_change = $num_ipd_change;
				$tot_serial_ipd_change++;

				$this->db->where('diagnosis LIKE', $p_dignosis);
				$diet = $this->db->get('diet');
				$diet_result = $diet->result();

				$patient_diet_result_array = array(
					[

						'name' => $patients->firstname,
						'patient_auto_id' => $patients->id,
						'patient_id' => $patients->yearly_reg_no,
						'ipd_no' => $tot_serial_ipd_change,
						'create_date' => $start_date_f,
						'ipd_opd' => $patients->ipd_opd,
						'diagnosis' => $patients->dignosis,
						'gai_dudha' => $diet_result->gai_dudha,
						'sunth_gdudha' => $diet_result->sunth_gdudha,
						'pej' => $diet_result->pej,
						'mrudshay' => $diet_result->mrudshay,
						'abmil' => $diet_result->abmil,
						'alimbusar' => $diet_result->alimbusar,
						'htak' => $diet_result->htak,
						'bhajsup' => $diet_result->bhajsup,
						'maunsahar' => $diet_result->maunsahar,
						'chaha_cofe' => $diet_result->chaha_cofe,
						'khir' => $diet_result->khir,
						'naralpa' => $diet_result->naralpa,
						'usras' => $diet_result->usras,
						'svpey' => $diet_result->svpey,
						'khimaubhat' => $diet_result->khimaubhat,
						'shira' => $diet_result->shira,
						'pohe_upma' => $diet_result->pohe_upma,
						'abhurji_amlet' => $diet_result->abhurji_amlet,
						'ukad' => $diet_result->ukad,
						'dhavan' => $diet_result->dhavan,
						'edli' => $diet_result->edli,
						'vbhat' => $diet_result->vbhat,
						'mugkhich' => $diet_result->mugkhich,
						'palebha' => $diet_result->palebha,
						'phalbha' => $diet_result->phalbha,
						'kaddha' => $diet_result->kaddha,
						'kanbha' => $diet_result->kanbha,
						'maunsahar2' => $diet_result->maunsahar2,
						'machahar' => $diet_result->machahar,
						'poli' => $diet_result->poli,
						'jbnsbhakri' => $diet_result->jbnsbhakri,
						'god' => $diet_result->god,
						'amboli' => $diet_result->amboli,
						'etar' => $diet_result->etar
					]
				);


				$this->db->insert('patient_diet_result', $patient_diet_result_array);

				//print_r($this->db->last_query());
				//die();

			}
			$this->db->select('*');
			$this->db->where('create_date >=', $start_date_f);
			$this->db->where('create_date <=', $start_date_f);
			//	$this->db->where('create_date<=',$current_date);
			$this->db->where('ipd_opd', $section);
			$this->db->order_by('create_date', 'asc');
			$patient_diet = $this->db->get('patient_diet_result');
			$result = $patient_diet->result();

			$data['patient_data'] = $result;
		}


		$data['content'] = $this->load->view('diet_report', $data, true);
		$this->load->view('layout/main_wrapper', $data);


	}




	public function getPanchkarma_register($section = NULL)
	{

		if ($this->input->get('start_date')) {
			$searchStartDate = date('Y-m-d', strtotime($this->input->get('start_date')));
		} else {
			$searchStartDate = date('Y-m-d');
			//$searchStartDate = '2022-04-01';
		}
		$searchEndDate = $searchStartDate;

		if ($section == 'opd') {

			$this->db->where('snehan!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('swedan!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('vaman!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('virechan!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('nasya!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('raktmokshan!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('shirodhara!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('shirobasti!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('basti!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('others!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$query = $this->db->get('panchkarma_patient_count_opd');

			$this->db->where('snehan!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('swedan!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('vaman!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('virechan!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('nasya!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('raktmokshan!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('shirodhara!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('shirobasti!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('basti!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('others!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query1 = $this->db->get('panchkarma_patient_count_opd');

			$this->db->select('count(snehan) as snehanCount, count(swedan) as swedanCount, count(vaman) as vamanCount, count(virechan) as virechanCount, count(nasya) as nasyaCount, count(raktmokshan) as raktmokshanCount, count(shirodhara) as shirodharaCount, count(shirobasti) as shirobastiCount, count(uttarbasti) as uttarbastiCount, count(basti) as bastiCount, count(yonidhavan) as yonidhavanCount, count(yonipichu) as yonipichuCount, count(others) as othersCount');
			$this->db->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query2 = $this->db->get('panchkarma_patient_count_opd');

		} else {

			$this->db->where('snehan!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('swedan!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('vaman!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('virechan!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('nasya!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('raktmokshan!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('shirodhara!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('shirobasti!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('basti!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('others!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$query = $this->db->get('panchkarma_patient_count_ipd');

			$this->db->where('snehan!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('swedan!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('vaman!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('virechan!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('nasya!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('raktmokshan!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('shirodhara!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('shirobasti!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('basti!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('others!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query1 = $this->db->get('panchkarma_patient_count_ipd');

			$this->db->select('count(snehan) as snehanCount, count(swedan) as swedanCount, count(vaman) as vamanCount, count(virechan) as virechanCount, count(nasya) as nasyaCount, count(raktmokshan) as raktmokshanCount, count(shirodhara) as shirodharaCount, count(shirobasti) as shirobastiCount, count(uttarbasti) as uttarbastiCount, count(basti) as bastiCount, count(yonidhavan) as yonidhavanCount, count(yonipichu) as yonipichuCount, count(others) as othersCount');
			$this->db->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query2 = $this->db->get('panchkarma_patient_count_ipd');
		}

		$panchResultYearlyCount = $query->num_rows();
		$panchResult = $query1->result();
		$panchResultCount = $query2->row();


		$data['panchResultYearlyCount'] = $panchResultYearlyCount;
		$data['panchResult'] = $panchResult;
		$data['panchResultCount'] = $panchResultCount;
		$data['datefrom'] = $searchStartDate;
		$data['dateto'] = $searchEndDate;
		$data['section'] = $section;

		$data['content'] = $this->load->view('patient_panchkarma', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}


	// Start 04 - 10 - 2024 Start 
	public function getOtherPanchkarma_register($section = NULL)
	{

		if ($this->input->get('start_date')) {
			$searchStartDate = date('Y-m-d', strtotime($this->input->get('start_date')));
		} else {
			$searchStartDate = date('Y-m-d');
			//$searchStartDate = '2022-04-01';
		}
		$searchEndDate = $searchStartDate;

		if ($section == 'opd') {
			$this->db->where('uttarbasti!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('yonidhavan!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('yonipichu!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$query = $this->db->get('panchkarma_patient_count_opd');

			$this->db->where('uttarbasti!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('yonidhavan!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('yonipichu!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query1 = $this->db->get('panchkarma_patient_count_opd');

			$this->db->select('COUNT(uttarbasti) as uttarbastiCount, COUNT(yonidhavan) as yonidhavanCount, COUNT(yonipichu) as yonipichuCount');
			$this->db->where('create_date >=', $searchStartDate);
			$this->db->where('create_date <=', $searchEndDate);
			$this->db->where('ipd_opd', $section);

			// Grouping the conditions that ensure at least one of the fields is not empty
			$this->db->group_start();
			$this->db->where('uttarbasti !=', '');
			$this->db->or_where('yonidhavan !=', '');
			$this->db->or_where('yonipichu !=', '');
			$this->db->group_end();

			$query2 = $this->db->get('panchkarma_patient_count_opd');

			// print_r($this->db->last_query());
		} else {
			$this->db->where('uttarbasti!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('yonidhavan!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('yonipichu!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$query = $this->db->get('panchkarma_patient_count_ipd');

			$this->db->where('uttarbasti!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('yonidhavan!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('yonipichu!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query1 = $this->db->get('panchkarma_patient_count_ipd');

			// $this->db->select('sum(uttarbasti_count) as uttarbastiCount, sum(yonidhavan_count) as yonidhavanCount, sum(yonipichu_count) as yonipichuCount');
			// $this->db->where(['create_date >='=>$searchStartDate, 'create_date <='=>$searchEndDate, 'ipd_opd'=>$section]);
			// $query2 = $this->db->get('panchkarma_total_count_ipd');

			$this->db->select('COUNT(uttarbasti) as uttarbastiCount, COUNT(yonidhavan) as yonidhavanCount, COUNT(yonipichu) as yonipichuCount');
			$this->db->where('create_date >=', $searchStartDate);
			$this->db->where('create_date <=', $searchEndDate);
			$this->db->where('ipd_opd', $section);

			// Grouping the conditions that ensure at least one of the fields is not empty
			$this->db->group_start();
			$this->db->where('uttarbasti !=', '');
			$this->db->or_where('yonidhavan !=', '');
			$this->db->or_where('yonipichu !=', '');
			$this->db->group_end();

			$query2 = $this->db->get('panchkarma_patient_count_ipd');


		}
		$panchResultYearlyCount = $query->num_rows();
		$panchResult = $query1->result();
		$panchResultCount = $query2->row();
		// print_r("<pre>");
		// print_r($panchResultYearlyCount);

		$data['panchResultYearlyCount'] = $panchResultYearlyCount;
		$data['panchResult'] = $panchResult;
		$data['panchResultCount'] = $panchResultCount;
		$data['datefrom'] = $searchStartDate;
		$data['dateto'] = $searchEndDate;
		$data['section'] = $section;

		$data['content'] = $this->load->view('patient_panchkarma_other', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}




	public function getInvestigation_register_testwise($section = NULL)
	{

		if ($this->input->get('start_date')) {
			$searchStartDate = date('Y-m-d', strtotime($this->input->get('start_date')));
		} else {
			$searchStartDate = date('Y-m-d');
			//$searchStartDate = '2022-04-01';
		}
		$searchEndDate = $searchStartDate;

		if ($section == 'opd') {
			$this->db->where('hematology!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('serology!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('biochemistry!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('microbiology!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$query = $this->db->get('investi_patient_count_opd');

			$this->db->where('hematology!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('serology!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('biochemistry!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('microbiology!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query1 = $this->db->get('investi_patient_count_opd');

			$this->db->select("
            SUM(LENGTH(REPLACE(hematology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(hematology, ' ', ''), '[,]+', '')) + 1) AS hematologyCount,
            SUM(LENGTH(REPLACE(serology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(serology, ' ', ''), '[,]+', '')) + 1) AS serologyCount,
            SUM(LENGTH(REPLACE(biochemistry, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(biochemistry, ' ', ''), '[,]+', '')) + 1) AS biochemistryCount,
            SUM(LENGTH(REPLACE(microbiology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(microbiology, ' ', ''), '[,]+', '')) + 1) AS microbiologyCount"
			);
			$this->db->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query2 = $this->db->get('investi_patient_count_opd');

		} else {

			$this->db->where('hematology!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('serology!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('biochemistry!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('microbiology!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$query = $this->db->get('investi_patient_count_ipd');

			$this->db->where('hematology!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('serology!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('biochemistry!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('microbiology!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query1 = $this->db->get('investi_patient_count_ipd');

			$this->db->select("
            SUM(LENGTH(REPLACE(hematology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(hematology, ' ', ''), '[,]+', '')) + 1) AS hematologyCount,
            SUM(LENGTH(REPLACE(serology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(serology, ' ', ''), '[,]+', '')) + 1) AS serologyCount,
            SUM(LENGTH(REPLACE(biochemistry, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(biochemistry, ' ', ''), '[,]+', '')) + 1) AS biochemistryCount,
            SUM(LENGTH(REPLACE(microbiology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(microbiology, ' ', ''), '[,]+', '')) + 1) AS microbiologyCount"
			);
			$this->db->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query2 = $this->db->get('investi_patient_count_ipd');
		}
		$investiResultYearlyCountTest = $query->num_rows();
		$investiResultTest = $query1->result();
		$investiResultCountTest = $query2->row();
		// print_r("<pre>");
		// print_r($investiResult);

		$data['investiResultYearlyCountTest'] = $investiResultYearlyCountTest;
		$data['investiResultTest'] = $investiResultTest;
		$data['investiResultCountTest'] = $investiResultCountTest;
		$data['datefrom'] = $searchStartDate;
		$data['dateto'] = $searchEndDate;
		$data['section'] = $section;

		$data['content'] = $this->load->view('patient_investigation_testwise', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}

	public function getInvestigation_register_xray_testwise($section = NULL)
	{

		if ($this->input->get('start_date')) {
			$searchStartDate = date('Y-m-d', strtotime($this->input->get('start_date')));
		} else {
			$searchStartDate = date('Y-m-d');
			//$searchStartDate = '2022-04-01';
		}
		$searchEndDate = $searchStartDate;

		if ($section == 'opd') {
			$this->db->where('xray!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$query = $this->db->get('investi_panch_opd_patient_count');

			$this->db->where('xray!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query1 = $this->db->get('investi_panch_opd_patient_count');

			$this->db->select('sum(xray_count) as xrayCount');
			$this->db->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query2 = $this->db->get('investi_panch_opd_test_total_count');

		} else {

			$this->db->where('xray!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$query = $this->db->get('investi_panch_ipd_patient_count');

			$this->db->where('xray!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query1 = $this->db->get('investi_panch_ipd_patient_count');

			$this->db->select('sum(xray_count) as xrayCount');
			$this->db->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query2 = $this->db->get('investi_panch_ipd_test_total_count');
		}
		$investiXRAYResultYearlyCountTest = $query->num_rows();
		$investiXRAYResultTest = $query1->result();
		$investiXRAYResultCountTest = $query2->row();
		// print_r("<pre>");
		// print_r($investiResult);

		$data['investiXRAYResultYearlyCountTest'] = $investiXRAYResultYearlyCountTest;
		$data['investiXRAYResultTest'] = $investiXRAYResultTest;
		$data['investiXRAYResultCountTest'] = $investiXRAYResultCountTest;
		$data['datefrom'] = $searchStartDate;
		$data['dateto'] = $searchEndDate;
		$data['section'] = $section;

		$data['content'] = $this->load->view('patient_investigation_xray_testwise', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}

	public function getInvestigation_register_usg_testwise($section = NULL)
	{

		if ($this->input->get('start_date')) {
			$searchStartDate = date('Y-m-d', strtotime($this->input->get('start_date')));
		} else {
			$searchStartDate = date('Y-m-d');
			//$searchStartDate = '2022-04-01';
		}
		$searchEndDate = $searchStartDate;

		if ($section == 'opd') {
			$this->db->where('usg!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$query = $this->db->get('investi_panch_opd_patient_count');

			$this->db->where('usg!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query1 = $this->db->get('investi_panch_opd_patient_count');

			$this->db->select('sum(usg_count) as usgCount');
			$this->db->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query2 = $this->db->get('investi_panch_opd_test_total_count');

		} else {

			$this->db->where('usg!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$query = $this->db->get('investi_panch_ipd_patient_count');

			$this->db->where('usg!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query1 = $this->db->get('investi_panch_ipd_patient_count');

			$this->db->select('sum(usg_count) as usgCount');
			$this->db->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query2 = $this->db->get('investi_panch_ipd_test_total_count');
		}
		$investiUSGResultYearlyCountTest = $query->num_rows();
		$investiUSGResultTest = $query1->result();
		$investiUSGResultCountTest = $query2->row();
		// print_r("<pre>");
		// print_r($investiResult);

		$data['investiUSGResultYearlyCountTest'] = $investiUSGResultYearlyCountTest;
		$data['investiUSGResultTest'] = $investiUSGResultTest;
		$data['investiUSGResultCountTest'] = $investiUSGResultCountTest;
		$data['datefrom'] = $searchStartDate;
		$data['dateto'] = $searchEndDate;
		$data['section'] = $section;

		$data['content'] = $this->load->view('patient_investigation_usg_testwise', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}

	public function getInvestigation_register_xray($section = NULL)
	{

		if ($this->input->get('start_date')) {
			$searchStartDate = date('Y-m-d', strtotime($this->input->get('start_date')));
		} else {
			$searchStartDate = date('Y-m-d');
			//$searchStartDate = '2022-04-01';
		}


		if ($this->input->get('end_date')) {
			$searchEndDate = date('Y-m-d', strtotime($this->input->get('end_date')));
		} else {
			$searchEndDate = date('Y-m-d');
			//$searchStartDate = '2022-04-01';
		}


		//$searchEndDate = $searchStartDate;

		if ($section == 'opd') {
			$this->db->where('xray!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$query = $this->db->get('xray_patient_count_opd');

			$this->db->where('xray!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query1 = $this->db->get('xray_patient_count_opd');

			$this->db->select('sum(xray_count) as xrayCount');
			$this->db->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query2 = $this->db->get('xray_total_count_opd');

		} else {

			$this->db->where('xray!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$query = $this->db->get('xray_patient_count_ipd');

			$this->db->where('xray!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query1 = $this->db->get('xray_patient_count_ipd');

			$this->db->select('sum(xray_count) as xrayCount');
			$this->db->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query2 = $this->db->get('xray_total_count_ipd');
		}
		$investiXRAYResultYearlyCount = $query->num_rows();
		$investiXRAYResult = $query1->result();
		$investiXRAYResultCount = $query2->row();
		// print_r("<pre>");
		// print_r($investiResult);

		$data['investiXRAYResultYearlyCount'] = $investiXRAYResultYearlyCount;
		$data['investiXRAYResult'] = $investiXRAYResult;
		$data['investiXRAYResultCount'] = $investiXRAYResultCount;
		$data['datefrom'] = $searchStartDate;
		$data['dateto'] = $searchEndDate;
		$data['section'] = $section;

		$data['content'] = $this->load->view('patient_investigation_xray', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}

	public function getInvestigation_register($section = NULL)
	{

		if ($this->input->get('start_date')) {
			$searchStartDate = date('Y-m-d', strtotime($this->input->get('start_date')));
		} else {
			$searchStartDate = date('Y-m-d');
			//$searchStartDate = '2022-04-01';
		}
		$searchEndDate = $searchStartDate;

		if ($section == 'opd') {
			$this->db->where('hematology!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('serology!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('biochemistry!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('microbiology!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$query = $this->db->get('investi_panch_opd_patient_count');

			$this->db->where('hematology!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('serology!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('biochemistry!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('microbiology!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query1 = $this->db->get('investi_panch_opd_patient_count');

			$this->db->select('sum(hematology_count) as hematologyCount, sum(serology_count) as serologyCount, sum(biochemistry_count) as biochemistryCount, sum(microbiology_count) as microbiologyCount');
			$this->db->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query2 = $this->db->get('investi_panch_opd_total_count');
			//print_r($this->db->last_query());
		} else {

			$this->db->where('hematology!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('serology!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('biochemistry!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('microbiology!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$query = $this->db->get('investi_panch_ipd_patient_count');

			$this->db->where('hematology!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('serology!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('biochemistry!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('microbiology!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query1 = $this->db->get('investi_panch_ipd_patient_count');

			$this->db->select('sum(hematology_count) as hematologyCount, sum(serology_count) as serologyCount, sum(biochemistry_count) as biochemistryCount, sum(microbiology_count) as microbiologyCount');
			$this->db->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query2 = $this->db->get('investi_panch_ipd_total_count');
		}
		$investiResultYearlyCount = $query->num_rows();
		$investiResult = $query1->result();
		$investiResultCount = $query2->row();
		// print_r("<pre>");
		// print_r($investiResult);

		$data['investiResultYearlyCount'] = $investiResultYearlyCount;
		$data['investiResult'] = $investiResult;
		$data['investiResultCount'] = $investiResultCount;
		$data['datefrom'] = $searchStartDate;
		$data['dateto'] = $searchEndDate;
		$data['section'] = $section;

		$data['content'] = $this->load->view('patient_investigation', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}

	public function getInvestigation_register_ecg($section = NULL)
	{

		if ($this->input->get('start_date')) {
			$searchStartDate = date('Y-m-d', strtotime($this->input->get('start_date')));
		} else {
			$searchStartDate = date('Y-m-d');
			//$searchStartDate = '2022-04-01';
		}
		if ($this->input->get('end_date')) {
			$searchEndDate = date('Y-m-d', strtotime($this->input->get('end_date')));
		} else {
			$searchEndDate = date('Y-m-d');
			//$searchStartDate = '2022-04-01';
		}
		//$searchEndDate = $searchStartDate;

		if ($section == 'opd') {
			$this->db->where('ecg!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$query = $this->db->get('ecg_patient_count_opd');

			$this->db->where('ecg !=', '');
			$this->db->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->order_by('patient_auto_id', 'ASC');
			$query1 = $this->db->get('ecg_patient_count_opd');


			$this->db->select('sum(ecg_count) as ecgCount');
			$this->db->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query2 = $this->db->get('ecg_total_count_opd');

		} else {

			$this->db->where('ecg!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$query = $this->db->get('ecg_patient_count_ipd');

			// $this->db->where('ecg!=','')->where(['create_date >='=>$searchStartDate, 'create_date <='=>$searchEndDate, 'ipd_opd'=>$section]);
			// $query1 = $this->db->get('ecg_patient_count_ipd');


			$this->db->where('ecg !=', '');
			$this->db->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->order_by('patient_auto_id', 'ASC');
			$query1 = $this->db->get('ecg_patient_count_ipd');

			$this->db->select('sum(ecg_count) as ecgCount');
			$this->db->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query2 = $this->db->get('ecg_total_count_ipd');
		}
		$investiECGResultYearlyCount = $query->num_rows();
		$investiECGResult = $query1->result();
		$investiECGResultCount = $query2->row();
		// print_r("<pre>");
		// print_r($investiResult);

		$data['investiECGResultYearlyCount'] = $investiECGResultYearlyCount;
		$data['investiECGResult'] = $investiECGResult;
		$data['investiECGResultCount'] = $investiECGResultCount;
		$data['datefrom'] = $searchStartDate;
		$data['dateto'] = $searchEndDate;
		$data['section'] = $section;

		$data['content'] = $this->load->view('patient_investigation_ecg', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}

	public function getInvestigation_register_usg($section = NULL)
	{

		if ($this->input->get('start_date')) {
			$searchStartDate = date('Y-m-d', strtotime($this->input->get('start_date')));
		} else {
			$searchStartDate = date('Y-m-d');
			//$searchStartDate = '2022-04-01';
		}
		$searchEndDate = $searchStartDate;

		if ($section == 'opd') {
			$this->db->where('usg!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$query = $this->db->get('investi_panch_opd_patient_count');

			$this->db->where('usg!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query1 = $this->db->get('investi_panch_opd_patient_count');

			$this->db->select('sum(usg_count) as usgCount');
			$this->db->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query2 = $this->db->get('investi_panch_opd_total_count');

		} else {

			$this->db->where('usg!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$query = $this->db->get('investi_panch_ipd_patient_count');

			$this->db->where('usg!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query1 = $this->db->get('investi_panch_ipd_patient_count');

			$this->db->select('sum(usg_count) as usgCount');
			$this->db->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query2 = $this->db->get('investi_panch_ipd_total_count');
		}
		$investiUSGResultYearlyCount = $query->num_rows();
		$investiUSGResult = $query1->result();
		$investiUSGResultCount = $query2->row();
		// print_r("<pre>");
		// print_r($investiResult);

		$data['investiUSGResultYearlyCount'] = $investiUSGResultYearlyCount;
		$data['investiUSGResult'] = $investiUSGResult;
		$data['investiUSGResultCount'] = $investiUSGResultCount;
		$data['datefrom'] = $searchStartDate;
		$data['dateto'] = $searchEndDate;
		$data['section'] = $section;

		$data['content'] = $this->load->view('patient_investigation_usg', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}


	/////////////////////////////////////////////////////// END Panchkarma ///////////////////////////////////////////////////////////////


	public function labreport()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);
		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = date('Y-m-d', strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
		$start_date = $start_date2;
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;

		if ($section == 'opd') {
			$data['haematology'] = $this->db->select('patient.firstname,patient.department_id,patient.yearly_reg_no,patient.old_reg_no,patient.date_of_birth,patient.sex,patient.dignosis, patient.id')
				->from('patient')
				->join('treatments1', 'treatments1.dignosis = patient.dignosis')
				->where('patient.create_date >=', $start_date2)
				->where('patient.create_date <=', $end_date2)
				->where('patient.ipd_opd', $section)
				//->where('treatments1.HEMATOLOGICAL!=', '')
				// ->or_where('treatments1.SEROLOGYCAL!=', '')
				// ->or_where('treatments1.BIOCHEMICAL!=', '')
				// ->or_where('treatments1.MICROBIOLOGICAL!=', '')
				->group_by('patient.firstname,patient.department_id,patient.yearly_reg_no,patient.old_reg_no,patient.date_of_birth,patient.sex,patient.dignosis,patient.id')
				->get()
				->result();
			//print_r($this->db->last_query());
		} else {
			$data['haematology'] = $this->db->select('*')
				->from('patient_ipd')
				->join('treatments1', 'treatments1.dignosis = patient_ipd.dignosis')
				->where('patient_ipd.create_date >=', $start_date2)
				->where('patient_ipd.create_date <=', $end_date2)
				->where('patient_ipd.ipd_opd', $section)
				->get()
				->result();
			//print_r($this->db->last_query());
		}

		$data['content'] = $this->load->view('hemeto_view', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}


	public function getInvestigation_register_testwise1($section = NULL)
	{

		if ($this->input->get('start_date')) {
			$searchStartDate = date('Y-m-d', strtotime($this->input->get('start_date')));
		} else {
			$searchStartDate = date('Y-m-d');
			//$searchStartDate = '2022-04-01';
		}
		$searchEndDate = $searchStartDate;

		if ($section == 'opd') {
			$this->db->where('hematology!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('serology!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('biochemistry!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('microbiology!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$query = $this->db->get('investi_panch_opd_patient_count');

			$this->db->where('hematology!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('serology!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('biochemistry!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('microbiology!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query1 = $this->db->get('investi_panch_opd_patient_count');

			$this->db->select('sum(hematology_count) as hematologyCount, sum(serology_count) as serologyCount, sum(biochemistry_count) as biochemistryCount, sum(microbiology_count) as microbiologyCount');
			$this->db->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query2 = $this->db->get('investi_panch_opd_test_total_count');

		} else {

			$this->db->where('hematology!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('serology!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('biochemistry!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$this->db->or_where('microbiology!=', '')->where(['create_date < ' => $searchStartDate, 'create_date like ' => '%' . date('Y', strtotime($searchStartDate)) . '%', 'ipd_opd' => $section]);
			$query = $this->db->get('investi_panch_ipd_patient_count');

			$this->db->where('hematology!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('serology!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('biochemistry!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$this->db->or_where('microbiology!=', '')->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query1 = $this->db->get('investi_panch_ipd_patient_count');

			$this->db->select('sum(hematology_count) as hematologyCount, sum(serology_count) as serologyCount, sum(biochemistry_count) as biochemistryCount, sum(microbiology_count) as microbiologyCount');
			$this->db->where(['create_date >=' => $searchStartDate, 'create_date <=' => $searchEndDate, 'ipd_opd' => $section]);
			$query2 = $this->db->get('investi_panch_ipd_test_total_count');
		}
		$investiResultYearlyCountTest = $query->num_rows();
		$investiResultTest = $query1->result();
		$investiResultCountTest = $query2->row();
		// print_r("<pre>");
		// print_r($investiResult);

		$data['investiResultYearlyCountTest'] = $investiResultYearlyCountTest;
		$data['investiResultTest'] = $investiResultTest;
		$data['investiResultCountTest'] = $investiResultCountTest;
		$data['datefrom'] = $searchStartDate;
		$data['dateto'] = $searchEndDate;
		$data['section'] = $section;

		$data['content'] = $this->load->view('patient_investigation_testwise1', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}


	public function hemeto_profile1($id = NULL, $section = NULL)
	{

		if ($section == 'opd') {

			$data['haematology_profile_opd'] = $this->db
				->select('*')
				->from('investi_panch_opd_test_total_count')
				//->join('treatments1','treatments1.dignosis = patient.dignosis')
				->where('investi_panch_opd_test_total_count.id', $id)
				->get()
				->result();
			//print_r($this->db->last_query());

			$data['haematology_pro'] = $this->db->select('*')
				->from('investi_panch_opd_test_total_count')
				//->join('treatments1','treatments1.dignosis = patient.dignosis')
				->where('investi_panch_opd_test_total_count.id', $id)
				->limit(1)
				->get()
				->result();
		} else {
			$data['haematology_profile_ipd'] = $this->db
				->select('*')
				->from('patient_ipd')
				->join('treatments1', 'treatments1.dignosis = patient_ipd.dignosis')
				->where('patient_ipd.id', $id)
				->get()
				->result();
			// print_r($this->db->last_query());

			$data['haematology_pro'] = $this->db->select('*')
				->from('patient_ipd')
				->join('treatments1', 'treatments1.dignosis = patient_ipd.dignosis')
				->where('patient_ipd.id', $id)
				->limit(1)
				->get()
				->result();

		}

		//$id = $id;
		$data['patient_id'] = $id;
		$data['section'] = $section;
		$data['content'] = $this->load->view('haemato_profile', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}


	public function hemeto_profile($id = NULL, $section = NULL)
	{

		if ($section == 'opd') {

			$data['haematology_profile_opd'] = $this->db
				->select('*')
				->from('patient')
				->join('treatments1', 'treatments1.dignosis = patient.dignosis')
				->where('patient.id', $id)
				->get()
				->result();
			//print_r($this->db->last_query());

			$data['haematology_pro'] = $this->db->select('*')
				->from('patient')
				->join('treatments1', 'treatments1.dignosis = patient.dignosis')
				->where('patient.id', $id)
				->limit(1)
				->get()
				->result();
		} else {
			$data['haematology_profile_ipd'] = $this->db
				->select('*')
				->from('patient_ipd')
				->join('treatments1', 'treatments1.dignosis = patient_ipd.dignosis')
				->where('patient_ipd.id', $id)
				->get()
				->result();
			// print_r($this->db->last_query());

			$data['haematology_pro'] = $this->db->select('*')
				->from('patient_ipd')
				->join('treatments1', 'treatments1.dignosis = patient_ipd.dignosis')
				->where('patient_ipd.id', $id)
				->limit(1)
				->get()
				->result();

		}

		//$id = $id;
		$data['patient_id'] = $id;
		$data['section'] = $section;
		$data['content'] = $this->load->view('haemato_profile', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}



	public function edit_report($patient_auto_id = NULL, $section = NULL)
	{


		if ($section == 'opd') {
			$data['haematology_report_opd'] = $this->db
				->select('investi_opd_report_result.patient_auto_id,investi_opd_report_result.test_name,investi_opd_report_result.report_type,investi_opd_report_result.report_section,investi_opd_report_result.unit,investi_opd_report_result.reference_range,investi_opd_report_result.result,patient.id,patient.sex,patient.date_of_birth')
				->from('investi_opd_report_result')
				->join('patient', 'patient.id = investi_opd_report_result.patient_auto_id')
				->where('investi_opd_report_result.patient_auto_id', $patient_auto_id)
				->get()
				->result();
			// print_r($this->db->last_query());

			$data['haematology_pro'] = $this->db->select('distinct(investi_opd_report_result.report_type),investi_opd_report_result.*,patient.id,patient.sex,patient.date_of_birth')
				->from('investi_opd_report_result')
				->join('patient', 'patient.id = investi_opd_report_result.patient_auto_id')
				->where('investi_opd_report_result.patient_auto_id', $patient_auto_id)
				->limit(1)
				->get()
				->result();
		} else {
			$data['haematology_report_ipd'] = $this->db
				->select('investi_ipd_report_result.patient_auto_id,investi_ipd_report_result.test_name,investi_ipd_report_result.report_type,investi_ipd_report_result.report_section,investi_ipd_report_result.unit,investi_ipd_report_result.reference_range,investi_ipd_report_result.result,patient_ipd.id,patient_ipd.sex,patient_ipd.date_of_birth')
				->from('investi_ipd_report_result')
				->join('patient_ipd', 'patient_ipd.id = investi_ipd_report_result.patient_auto_id')
				->where('investi_ipd_report_result.patient_auto_id', $patient_auto_id)
				//->group_by('investi_ipd_report_result.patient_auto_id')
				->get()
				->result();
			// print_r($this->db->last_query());
			$data['haematology_pro'] = $this->db->select('distinct(investi_ipd_report_result.report_type),investi_ipd_report_result.*,patient_ipd.id,patient_ipd.sex,patient_ipd.date_of_birth')
				->from('investi_ipd_report_result')
				->join('patient_ipd', 'patient_ipd.id = investi_ipd_report_result.patient_auto_id')
				->where('investi_ipd_report_result.patient_auto_id', $patient_auto_id)
				->limit(1)
				->get()
				->result();

		}
		// print_r($this->db->last_query());
		$id = $patient_auto_id;
		//print_r($id);
		$data['patient_id'] = $id;


		$data['section'] = $section;
		// $data['test']='1';
		$data['content'] = $this->load->view('edit_report', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}



	public function get_haematology_patients()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);
		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = date('Y-m-d', strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
		$start_date = $start_date2;
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;

		if ($section == 'opd') {


			$data['haematology'] = $this->db->select('`investi_patient_count_opd`.`patient_auto_id`,investi_patient_count_opd.patient_name,investi_patient_count_opd.hematology,investi_patient_count_opd.ipd_opd, `patient`.`date_of_birth`,patient.yearly_reg_no,patient.old_reg_no,patient.sex,patient.department_id,patient.dignosis,patient.firstname')
				->from('investi_patient_count_opd')
				->join('patient', 'patient.id = investi_patient_count_opd.patient_auto_id')
				->where('investi_patient_count_opd.create_date >=', $start_date2)
				->where('investi_patient_count_opd.create_date <=', $end_date2)
				->where('investi_patient_count_opd.hematology !=', '')
				->where('investi_patient_count_opd.ipd_opd', $section)
				->group_by('`investi_patient_count_opd`.`patient_auto_id`,investi_patient_count_opd.hematology,investi_patient_count_opd.ipd_opd,investi_patient_count_opd.patient_name')
				->order_by('`investi_patient_count_opd`.`patient_auto_id`')
				->get()
				->result();

			$this->db->select("
            SUM(LENGTH(REPLACE(hematology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(hematology, ' ', ''), '[,]+', '')) + 1) AS hematologyCount,
            SUM(LENGTH(REPLACE(serology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(serology, ' ', ''), '[,]+', '')) + 1) AS serologyCount,
            SUM(LENGTH(REPLACE(biochemistry, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(biochemistry, ' ', ''), '[,]+', '')) + 1) AS biochemistryCount,
            SUM(LENGTH(REPLACE(microbiology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(microbiology, ' ', ''), '[,]+', '')) + 1) AS microbiologyCount"
			);
			$this->db->where(['create_date >=' => $start_date2, 'create_date <=' => $end_date2, 'ipd_opd' => $section]);
			$query2 = $this->db->get('investi_patient_count_opd');
			// print_r($this->db->last_query());
		} else {

			$data['haematology'] = $this->db->select('`investi_patient_count_ipd`.`patient_auto_id`,investi_patient_count_ipd.hematology,investi_patient_count_ipd.ipd_opd,investi_patient_count_ipd.patient_name, `patient_ipd`.`date_of_birth`,patient_ipd.yearly_reg_no,patient_ipd.old_reg_no,patient_ipd.sex,patient_ipd.department_id,patient_ipd.dignosis,patient_ipd.firstname')
				->from('investi_patient_count_ipd')
				->join('patient_ipd', 'patient_ipd.id = investi_patient_count_ipd.patient_auto_id')
				->where('investi_patient_count_ipd.create_date >=', $start_date2)
				->where('investi_patient_count_ipd.create_date <=', $end_date2)
				->where('investi_patient_count_ipd.ipd_opd', $section)
				->where('investi_patient_count_ipd.hematology !=', '')
				->group_by('`investi_patient_count_ipd`.`patient_auto_id`,investi_patient_count_ipd.hematology,investi_patient_count_ipd.ipd_opd,investi_patient_count_ipd.patient_name')
				->order_by('`investi_patient_count_ipd`.`patient_auto_id`')
				->get()
				->result();

			$this->db->select("
            SUM(LENGTH(REPLACE(hematology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(hematology, ' ', ''), '[,]+', '')) + 1) AS hematologyCount,
            SUM(LENGTH(REPLACE(serology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(serology, ' ', ''), '[,]+', '')) + 1) AS serologyCount,
            SUM(LENGTH(REPLACE(biochemistry, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(biochemistry, ' ', ''), '[,]+', '')) + 1) AS biochemistryCount,
            SUM(LENGTH(REPLACE(microbiology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(microbiology, ' ', ''), '[,]+', '')) + 1) AS microbiologyCount"
			);
			$this->db->where(['create_date >=' => $start_date2, 'create_date <=' => $end_date2, 'ipd_opd' => $section]);
			$query2 = $this->db->get('investi_patient_count_ipd');
			// print_r($this->db->last_query());
		}

		// print_r($this->db->last_query());
		//  print_r($haematology1);
		$investiResultCountTest = $query2->row();
		$data['investiResultCountTest'] = $investiResultCountTest;
		$data['content'] = $this->load->view('haematology_report', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function get_seriology_patients()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);
		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = date('Y-m-d', strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
		$start_date = $start_date2;
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;

		if ($section == 'opd') {
			$data['seriology'] = $this->db->select('`investi_patient_count_opd`.`patient_auto_id`,investi_patient_count_opd.patient_name,investi_patient_count_opd.serology,investi_patient_count_opd.ipd_opd, `patient`.`date_of_birth`,patient.yearly_reg_no,patient.old_reg_no,patient.sex,patient.department_id,patient.dignosis,patient.firstname')
				->from('investi_patient_count_opd')
				->join('investi_opd_report_result', 'investi_opd_report_result.patient_auto_id = investi_patient_count_opd.patient_auto_id')
				->join('patient', 'patient.id = investi_opd_report_result.patient_auto_id')
				->where('investi_opd_report_result.create_date >=', $start_date2)
				->where('investi_opd_report_result.create_date <=', $end_date2)
				->where('investi_patient_count_opd.serology !=', '')
				->where('investi_patient_count_opd.ipd_opd', $section)
				->group_by('`investi_patient_count_opd`.`patient_auto_id`,investi_patient_count_opd.serology,investi_patient_count_opd.ipd_opd,investi_patient_count_opd.patient_name')
				->order_by('`investi_patient_count_opd`.`patient_auto_id`')
				->get()
				->result();

			$this->db->select("
            SUM(LENGTH(REPLACE(hematology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(hematology, ' ', ''), '[,]+', '')) + 1) AS hematologyCount,
            SUM(LENGTH(REPLACE(serology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(serology, ' ', ''), '[,]+', '')) + 1) AS serologyCount,
            SUM(LENGTH(REPLACE(biochemistry, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(biochemistry, ' ', ''), '[,]+', '')) + 1) AS biochemistryCount,
            SUM(LENGTH(REPLACE(microbiology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(microbiology, ' ', ''), '[,]+', '')) + 1) AS microbiologyCount"
			);
			$this->db->where(['create_date >=' => $start_date2, 'create_date <=' => $end_date2, 'ipd_opd' => $section]);
			$query2 = $this->db->get('investi_patient_count_opd');
			# print_r($this->db->last_query()); echo"<br>";

		} else {
			$data['seriology'] = $this->db->select('`investi_patient_count_ipd`.`patient_auto_id`,investi_patient_count_ipd.serology,investi_patient_count_ipd.ipd_opd,investi_patient_count_ipd.patient_name, `patient_ipd`.`date_of_birth`,patient_ipd.yearly_reg_no,patient_ipd.old_reg_no,patient_ipd.sex,patient_ipd.department_id,patient_ipd.dignosis,patient_ipd.firstname')
				->from('investi_ipd_report_result')
				->join('investi_patient_count_ipd', 'investi_patient_count_ipd.patient_auto_id = investi_ipd_report_result.patient_auto_id')
				->join('patient_ipd', 'patient_ipd.id = investi_ipd_report_result.patient_auto_id')
				->where('investi_ipd_report_result.create_date >=', $start_date2)
				->where('investi_ipd_report_result.create_date <=', $end_date2)
				->where('investi_patient_count_ipd.ipd_opd', $section)
				->where('investi_patient_count_ipd.serology !=', '')
				->group_by('`investi_patient_count_ipd`.`patient_auto_id`,investi_patient_count_ipd.serology,investi_patient_count_ipd.ipd_opd,investi_patient_count_ipd.patient_name')
				->order_by('`investi_patient_count_ipd`.`patient_auto_id`')
				->get()
				->result();

			$this->db->select("
            SUM(LENGTH(REPLACE(hematology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(hematology, ' ', ''), '[,]+', '')) + 1) AS hematologyCount,
            SUM(LENGTH(REPLACE(serology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(serology, ' ', ''), '[,]+', '')) + 1) AS serologyCount,
            SUM(LENGTH(REPLACE(biochemistry, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(biochemistry, ' ', ''), '[,]+', '')) + 1) AS biochemistryCount,
            SUM(LENGTH(REPLACE(microbiology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(microbiology, ' ', ''), '[,]+', '')) + 1) AS microbiologyCount"
			);
			$this->db->where(['create_date >=' => $start_date2, 'create_date <=' => $end_date2, 'ipd_opd' => $section]);
			$query2 = $this->db->get('investi_patient_count_ipd');

			// print_r($this->db->last_query());
		}

		$investiResultCountTest = $query2->row();
		$data['investiResultCountTest'] = $investiResultCountTest;
		// print_r($this->db->last_query());
		//  print_r($haematology1);

		$data['content'] = $this->load->view('seriology_report', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function get_biochemistry_patients()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);
		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = date('Y-m-d', strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
		$start_date = $start_date2;
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;

		if ($section == 'opd') {


			$data['biochemistry'] = $this->db->select('`investi_patient_count_opd`.`patient_auto_id`,investi_patient_count_opd.patient_name,investi_patient_count_opd.biochemistry,investi_patient_count_opd.ipd_opd, `patient`.`date_of_birth`,patient.yearly_reg_no,patient.old_reg_no,patient.sex,patient.department_id,patient.dignosis,patient.firstname')
				->from('investi_patient_count_opd')
				->join('investi_opd_report_result', 'investi_opd_report_result.patient_auto_id = investi_patient_count_opd.patient_auto_id')
				->join('patient', 'patient.id = investi_opd_report_result.patient_auto_id')
				->where('investi_opd_report_result.create_date >=', $start_date2)
				->where('investi_opd_report_result.create_date <=', $end_date2)
				->where('investi_patient_count_opd.biochemistry !=', '')
				->where('investi_patient_count_opd.ipd_opd', $section)
				->group_by('`investi_patient_count_opd`.`patient_auto_id`,investi_patient_count_opd.biochemistry,investi_patient_count_opd.ipd_opd,investi_patient_count_opd.patient_name')
				->order_by('`investi_patient_count_opd`.`patient_auto_id`')
				->get()
				->result();


			$this->db->select("
            SUM(LENGTH(REPLACE(hematology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(hematology, ' ', ''), '[,]+', '')) + 1) AS hematologyCount,
            SUM(LENGTH(REPLACE(serology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(serology, ' ', ''), '[,]+', '')) + 1) AS serologyCount,
            SUM(LENGTH(REPLACE(biochemistry, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(biochemistry, ' ', ''), '[,]+', '')) + 1) AS biochemistryCount,
            SUM(LENGTH(REPLACE(microbiology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(microbiology, ' ', ''), '[,]+', '')) + 1) AS microbiologyCount"
			);
			$this->db->where(['create_date >=' => $start_date2, 'create_date <=' => $end_date2, 'ipd_opd' => $section]);
			$query2 = $this->db->get('investi_patient_count_opd');

		} else {



			$data['biochemistry'] = $this->db->select('`investi_patient_count_ipd`.`patient_auto_id`,investi_patient_count_ipd.biochemistry,investi_patient_count_ipd.ipd_opd,investi_patient_count_ipd.patient_name, `patient_ipd`.`date_of_birth`,patient_ipd.yearly_reg_no,patient_ipd.old_reg_no,patient_ipd.sex,patient_ipd.department_id,patient_ipd.dignosis,patient_ipd.firstname')
				->from('investi_ipd_report_result')
				->join('investi_patient_count_ipd', 'investi_patient_count_ipd.patient_auto_id = investi_ipd_report_result.patient_auto_id')
				->join('patient_ipd', 'patient_ipd.id = investi_ipd_report_result.patient_auto_id')
				->where('investi_ipd_report_result.create_date >=', $start_date2)
				->where('investi_ipd_report_result.create_date <=', $end_date2)
				->where('investi_patient_count_ipd.ipd_opd', $section)
				->where('investi_patient_count_ipd.biochemistry !=', '')
				->group_by('`investi_patient_count_ipd`.`patient_auto_id`,investi_patient_count_ipd.biochemistry,investi_patient_count_ipd.ipd_opd,investi_patient_count_ipd.patient_name')
				->order_by('`investi_patient_count_ipd`.`patient_auto_id`')
				->get()
				->result();

			$this->db->select("
            SUM(LENGTH(REPLACE(hematology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(hematology, ' ', ''), '[,]+', '')) + 1) AS hematologyCount,
            SUM(LENGTH(REPLACE(serology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(serology, ' ', ''), '[,]+', '')) + 1) AS serologyCount,
            SUM(LENGTH(REPLACE(biochemistry, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(biochemistry, ' ', ''), '[,]+', '')) + 1) AS biochemistryCount,
            SUM(LENGTH(REPLACE(microbiology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(microbiology, ' ', ''), '[,]+', '')) + 1) AS microbiologyCount"
			);
			$this->db->where(['create_date >=' => $start_date2, 'create_date <=' => $end_date2, 'ipd_opd' => $section]);
			$query2 = $this->db->get('investi_patient_count_ipd');

		}
		$investiResultCountTest = $query2->row();
		$data['investiResultCountTest'] = $investiResultCountTest;

		$data['content'] = $this->load->view('biochemistry_report', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}


	public function get_microbiology_patients()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);
		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = date('Y-m-d', strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
		$start_date = $start_date2;
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;

		if ($section == 'opd') {



			$data['microbiology'] = $this->db->select('`investi_patient_count_opd`.`patient_auto_id`,investi_patient_count_opd.patient_name,investi_patient_count_opd.microbiology,investi_patient_count_opd.ipd_opd, `patient`.`date_of_birth`,patient.yearly_reg_no,patient.old_reg_no,patient.sex,patient.department_id,patient.dignosis,patient.firstname')
				->from('investi_patient_count_opd')
				->join('investi_opd_report_result', 'investi_opd_report_result.patient_auto_id = investi_patient_count_opd.patient_auto_id')
				->join('patient', 'patient.id = investi_opd_report_result.patient_auto_id')
				->where('investi_opd_report_result.create_date >=', $start_date2)
				->where('investi_opd_report_result.create_date <=', $end_date2)
				->where('investi_patient_count_opd.microbiology !=', '')
				->where('investi_patient_count_opd.ipd_opd', $section)
				->group_by('`investi_patient_count_opd`.`patient_auto_id`,investi_patient_count_opd.microbiology,investi_patient_count_opd.ipd_opd,investi_patient_count_opd.patient_name')
				->order_by('`investi_patient_count_opd`.`patient_auto_id`')
				->get()
				->result();

			$this->db->select("
            SUM(LENGTH(REPLACE(hematology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(hematology, ' ', ''), '[,]+', '')) + 1) AS hematologyCount,
            SUM(LENGTH(REPLACE(serology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(serology, ' ', ''), '[,]+', '')) + 1) AS serologyCount,
            SUM(LENGTH(REPLACE(biochemistry, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(biochemistry, ' ', ''), '[,]+', '')) + 1) AS biochemistryCount,
            SUM(LENGTH(REPLACE(microbiology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(microbiology, ' ', ''), '[,]+', '')) + 1) AS microbiologyCount"
			);
			$this->db->where(['create_date >=' => $start_date2, 'create_date <=' => $end_date2, 'ipd_opd' => $section]);
			$query2 = $this->db->get('investi_patient_count_opd');

			//  print_r($this->db->last_query());
		} else {

			$data['microbiology'] = $this->db->select('`investi_patient_count_ipd`.`patient_auto_id`,investi_patient_count_ipd.microbiology,investi_patient_count_ipd.ipd_opd,investi_patient_count_ipd.patient_name, `patient_ipd`.`date_of_birth`,patient_ipd.yearly_reg_no,patient_ipd.old_reg_no,patient_ipd.sex,patient_ipd.department_id,patient_ipd.dignosis,patient_ipd.firstname')
				->from('investi_ipd_report_result')
				->join('investi_patient_count_ipd', 'investi_patient_count_ipd.patient_auto_id = investi_ipd_report_result.patient_auto_id')
				->join('patient_ipd', 'patient_ipd.id = investi_ipd_report_result.patient_auto_id')
				->where('investi_ipd_report_result.create_date >=', $start_date2)
				->where('investi_ipd_report_result.create_date <=', $end_date2)
				->where('investi_patient_count_ipd.ipd_opd', $section)
				->where('investi_patient_count_ipd.microbiology !=', '')
				->group_by('`investi_patient_count_ipd`.`patient_auto_id`,investi_patient_count_ipd.microbiology,investi_patient_count_ipd.ipd_opd,investi_patient_count_ipd.patient_name')
				->order_by('`investi_patient_count_ipd`.`patient_auto_id`')
				->get()
				->result();

			$this->db->select("
            SUM(LENGTH(REPLACE(hematology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(hematology, ' ', ''), '[,]+', '')) + 1) AS hematologyCount,
            SUM(LENGTH(REPLACE(serology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(serology, ' ', ''), '[,]+', '')) + 1) AS serologyCount,
            SUM(LENGTH(REPLACE(biochemistry, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(biochemistry, ' ', ''), '[,]+', '')) + 1) AS biochemistryCount,
            SUM(LENGTH(REPLACE(microbiology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(microbiology, ' ', ''), '[,]+', '')) + 1) AS microbiologyCount"
			);
			$this->db->where(['create_date >=' => $start_date2, 'create_date <=' => $end_date2, 'ipd_opd' => $section]);
			$query2 = $this->db->get('investi_patient_count_ipd');

			// print_r($this->db->last_query());
		}

		$investiResultCountTest = $query2->row();
		$data['investiResultCountTest'] = $investiResultCountTest;
		// print_r($this->db->last_query());
		//  print_r($haematology1);

		$data['content'] = $this->load->view('microbiology_report', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}




	public function update_patient_report($patient_auto_id = NULL)
	{

	}


	public function get_seriology_patient_profile($patient_auto_id = NULL, $section = NULL)
	{

		if ($section == 'opd') {
			$data['serology_profile'] = $this->db
				->select('investi_opd_report_result.test_name,investi_opd_report_result.report_type,investi_opd_report_result.report_section,investi_opd_report_result.unit,investi_opd_report_result.reference_range,investi_opd_report_result.result,investi_opd_report_result.patient_auto_id,patient.id,patient.sex,patient.date_of_birth')
				->from('investi_opd_report_result')
				->join('patient', 'patient.id = investi_opd_report_result.patient_auto_id')
				->where('investi_opd_report_result.patient_auto_id', $patient_auto_id)
				->get()
				->result();
			// print_r($this->db->last_query());

			$data['serology_pro'] = $this->db->select('distinct(investi_opd_report_result.report_type),investi_opd_report_result.*,patient.id,patient.sex,patient.date_of_birth')
				->from('investi_opd_report_result')
				->join('patient', 'patient.id = investi_opd_report_result.patient_auto_id')
				->where('investi_opd_report_result.patient_auto_id', $patient_auto_id)
				->limit(1)
				->get()
				->result();
			$data['patient_auto_id'] = $patient_auto_id;
		} else {
			$data['serology_profile'] = $this->db
				->select('investi_ipd_report_result.test_name,investi_ipd_report_result.report_type,investi_ipd_report_result.report_section,investi_ipd_report_result.unit,investi_ipd_report_result.reference_range,investi_ipd_report_result.result,investi_ipd_report_result.patient_auto_id,patient_ipd.id,patient_ipd.sex,patient_ipd.date_of_birth')
				->from('investi_ipd_report_result')
				->join('patient_ipd', 'patient_ipd.id = investi_ipd_report_result.patient_auto_id')
				->where('investi_ipd_report_result.patient_auto_id', $patient_auto_id)
				->get()
				->result();
			// print_r($this->db->last_query());
			$data['serology_pro'] = $this->db->select('distinct(investi_ipd_report_result.report_type),investi_ipd_report_result.*,patient_ipd.id,patient_ipd.sex,patient_ipd.date_of_birth')
				->from('investi_ipd_report_result')
				->join('patient_ipd', 'patient_ipd.id = investi_ipd_report_result.patient_auto_id')
				->where('investi_ipd_report_result.patient_auto_id', $patient_auto_id)
				->limit(1)
				->get()
				->result();
			$data['patient_auto_id'] = $patient_auto_id;
		}
		// print_r($this->db->last_query());
		$data['section'] = $section;

		$data['content'] = $this->load->view('seriology_profile', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}

	public function get_microbiology_patient_profile($patient_auto_id = NULL, $section = NULL)
	{

		if ($section == 'opd') {
			$data['microbiology_profile'] = $this->db
				->select('investi_opd_report_result.test_name,investi_opd_report_result.report_type,investi_opd_report_result.report_section,investi_opd_report_result.unit,investi_opd_report_result.reference_range,investi_opd_report_result.result,investi_opd_report_result.patient_auto_id,patient.id,patient.sex,patient.date_of_birth')
				->from('investi_opd_report_result')
				->join('patient', 'patient.id = investi_opd_report_result.patient_auto_id')
				->where('investi_opd_report_result.patient_auto_id', $patient_auto_id)
				->get()
				->result();
			// print_r($this->db->last_query());

			$data['microbiology_pro'] = $this->db->select('distinct(investi_opd_report_result.report_type),investi_opd_report_result.*,patient.id,patient.sex,patient.date_of_birth')
				->from('investi_opd_report_result')
				->join('patient', 'patient.id = investi_opd_report_result.patient_auto_id')
				->where('investi_opd_report_result.patient_auto_id', $patient_auto_id)
				->limit(1)
				->get()
				->result();
			$data['patient_auto_id'] = $patient_auto_id;
		} else {
			$data['microbiology_profile'] = $this->db
				->select('investi_ipd_report_result.test_name,investi_ipd_report_result.report_type,investi_ipd_report_result.report_section,investi_ipd_report_result.unit,investi_ipd_report_result.reference_range,investi_ipd_report_result.result,investi_ipd_report_result.patient_auto_id,patient_ipd.id,patient_ipd.sex,patient_ipd.date_of_birth')
				->from('investi_ipd_report_result')
				->join('patient_ipd', 'patient_ipd.id = investi_ipd_report_result.patient_auto_id')
				->where('investi_ipd_report_result.patient_auto_id', $patient_auto_id)
				->get()
				->result();
			// print_r($this->db->last_query());
			$data['microbiology_pro'] = $this->db->select('distinct(investi_ipd_report_result.report_type),investi_ipd_report_result.*,patient_ipd.id,patient_ipd.sex,patient_ipd.date_of_birth')
				->from('investi_ipd_report_result')
				->join('patient_ipd', 'patient_ipd.id = investi_ipd_report_result.patient_auto_id')
				->where('investi_ipd_report_result.patient_auto_id', $patient_auto_id)
				->limit(1)
				->get()
				->result();
			echo $data['patient_auto_id'] = $patient_auto_id;
		}
		// print_r($this->db->last_query());
		$data['section'] = $section;

		$data['content'] = $this->load->view('microbiology_profile', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}


	public function get_biochemistry_patient_profile($patient_auto_id = NULL, $section = NULL)
	{

		if ($section == 'opd') {
			$data['biochemistry_profile'] = $this->db
				->select('investi_opd_report_result.test_name,investi_opd_report_result.report_type,investi_opd_report_result.report_section,investi_opd_report_result.unit,investi_opd_report_result.reference_range,investi_opd_report_result.result,investi_opd_report_result.patient_auto_id,patient.id,patient.sex,patient.date_of_birth')
				->from('investi_opd_report_result')
				->join('patient', 'patient.id = investi_opd_report_result.patient_auto_id')
				->where('investi_opd_report_result.patient_auto_id', $patient_auto_id)
				->get()
				->result();
			// print_r($this->db->last_query());

			$data['biochemistry_pro'] = $this->db->select('distinct(investi_opd_report_result.report_type),investi_opd_report_result.*,patient.id,patient.sex,patient.date_of_birth')
				->from('investi_opd_report_result')
				->join('patient', 'patient.id = investi_opd_report_result.patient_auto_id')
				->where('investi_opd_report_result.patient_auto_id', $patient_auto_id)
				->limit(1)
				->get()
				->result();
			$data['patient_auto_id'] = $patient_auto_id;
		} else {
			$data['biochemistry_profile'] = $this->db
				->select('investi_ipd_report_result.test_name,investi_ipd_report_result.report_type,investi_ipd_report_result.report_section,investi_ipd_report_result.unit,investi_ipd_report_result.reference_range,investi_ipd_report_result.result,investi_ipd_report_result.patient_auto_id,patient_ipd.id,patient_ipd.sex,patient_ipd.date_of_birth')
				->from('investi_ipd_report_result')
				->join('patient_ipd', 'patient_ipd.id = investi_ipd_report_result.patient_auto_id')
				->where('investi_ipd_report_result.patient_auto_id', $patient_auto_id)
				->get()
				->result();
			// print_r($this->db->last_query());
			$data['biochemistry_pro'] = $this->db->select('distinct(investi_ipd_report_result.report_type),investi_ipd_report_result.*,patient_ipd.id,patient_ipd.sex,patient_ipd.date_of_birth')
				->from('investi_ipd_report_result')
				->join('patient_ipd', 'patient_ipd.id = investi_ipd_report_result.patient_auto_id')
				->where('investi_ipd_report_result.patient_auto_id', $patient_auto_id)
				->limit(1)
				->get()
				->result();
			$data['patient_auto_id'] = $patient_auto_id;
		}
		// print_r($this->db->last_query());
		$data['section'] = $section;

		$data['content'] = $this->load->view('biochemistry_profile', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}



	public function shekhar()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);
		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);

		$start_date = $start_date2;
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;

		if ($section == 'opd') {
			$data['haematology'] = $this->db->select('patient.firstname,patient.department_id,patient.yearly_reg_no,patient.old_reg_no,patient.date_of_birth,patient.sex,patient.dignosis, patient.id')
				->from('patient')
				->join('treatments1', 'treatments1.dignosis = patient.dignosis')
				->where('patient.create_date >=', $start_date2)
				->where('patient.create_date <=', $end_date2)
				->where('patient.ipd_opd', $section)
				//->where('treatments1.HEMATOLOGICAL!=', '')
				// ->or_where('treatments1.SEROLOGYCAL!=', '')
				// ->or_where('treatments1.BIOCHEMICAL!=', '')
				// ->or_where('treatments1.MICROBIOLOGICAL!=', '')
				->group_by('patient.firstname,patient.department_id,patient.yearly_reg_no,patient.old_reg_no,patient.date_of_birth,patient.sex,patient.dignosis,patient.id')
				->get()
				->result();
			//print_r($this->db->last_query());
		} else {
			$data['haematology'] = $this->db->select('*')
				->from('patient_ipd')
				->join('treatments1', 'treatments1.dignosis = patient_ipd.dignosis')
				->where('patient_ipd.create_date >=', $start_date2)
				->where('patient_ipd.create_date <=', $end_date2)
				->where('patient_ipd.ipd_opd', $section)
				->get()
				->result();
			//print_r($this->db->last_query());
		}

		$data['content'] = $this->load->view('hemeto_view', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}




	public function hemeto_form($id = NULL, $section = NULL, $name = NULL, $date = NULL, $dignosis = NULL)
	{

		if ($section == 'opd') {

			$data['haematology_profile_opd'] = $this->db->select('*')
				->from('patient')
				->join('treatments1', 'treatments1.dignosis = patient.dignosis')
				->where('patient.id', $id)
				->limit(1)
				->get()
				->result();


			$data['haematology_pro'] = $this->db->select('*')
				->from('patient')
				->join('treatments1', 'treatments1.dignosis = patient.dignosis')
				->where('patient.id', $id)
				->limit(1)
				->get()
				->result();
			//print_r($this->db->last_query());
		} else {
			$data['haematology_profile_ipd'] = $this->db
				->select('*')
				->from('patient_ipd')
				->join('treatments1', 'treatments1.dignosis = patient_ipd.dignosis')
				->where('patient_ipd.id', $id)
				->get()
				->result();
			// print_r($this->db->last_query());

			$data['haematology_pro'] = $this->db->select('*')
				->from('patient_ipd')
				->join('treatments1', 'treatments1.dignosis = patient_ipd.dignosis')
				->where('patient_ipd.id', $id)
				->limit(1)
				->get()
				->result();

		}

		$data['patient_id'] = $id;
		$data['section'] = $section;
		$data['date'] = $date;
		$data['name'] = $name;
		$data['dignosis'] = $dignosis;

		$data['content'] = $this->load->view('all_report_form', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}


	public function checkhemetoform()
	{
		$section = $this->input->get('section');
		$id = $this->input->get('id');
		$test_type = $this->input->get('test_type');
		$name = $this->input->get('name');
		$date_start = $this->input->get('date');
		$date = date("Y-m-d", strtotime($date_start));

		//$test_type = array($this->input->get('test_type'));
		// print_r($name);

		if ($section == 'opd') {
			$data['haematology_profile_opd'] = $this->db->select('*')
				->from('patient')
				->join('treatments1', 'treatments1.dignosis = patient.dignosis')
				->where('patient.id', $id)
				->limit(1)
				->get()
				->result();


			$data['haematology_pro'] = $this->db->select('*')
				->from('patient')
				->join('treatments1', 'treatments1.dignosis = patient.dignosis')
				->where('patient.id', $id)
				->limit(1)
				->get()
				->result();
			//print_r($this->db->last_query());
		} else {
			$data['haematology_profile_ipd'] = $this->db
				->select('*')
				->from('patient_ipd')
				->join('treatments1', 'treatments1.dignosis = patient_ipd.dignosis')
				->where('patient_ipd.id', $id)
				->get()
				->result();
			// print_r($this->db->last_query());

			$data['haematology_pro'] = $this->db->select('*')
				->from('patient_ipd')
				->join('treatments1', 'treatments1.dignosis = patient_ipd.dignosis')
				->where('patient_ipd.id', $id)
				->limit(1)
				->get()
				->result();
		}

		$data['patient_id'] = $id;
		$data['section'] = $section;
		$data['test_type'] = $test_type;
		$data['name'] = $name;
		$data['date'] = $date;

		$data['content'] = $this->load->view('check_hemoto_form', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}


	public function insert_hemeto_patient()
	{
		$data['title'] = display('add_hemto_patient_result');

		// $aaray = $this->input->post('result',true);

		//print_r($aaray);

		$result = $this->input->post('result', true);
		$count = sizeof($result);

		for ($i = 0; $i < $count; $i++) {


			$section = $this->input->post('section', true);
			$patient_auto_id = $this->input->post('patient_auto_id', true);
			$test_type = $this->input->post('test_type', true);
			$name = $this->input->post('name', true);
			$create_date = $this->input->post('date', true);
			$report_section = $this->input->post('report_section', true);
			$result = $this->input->post('result', true);
			$unit = $this->input->post('unit', true);
			$reference_range = $this->input->post('normal_value', true);
			$dignosis = $this->input->post('dignosis', true);
			$report_type = $this->input->post('report_type', true);
			$test_name = $this->input->post('test_name', true);

			$this->db->set('patient_auto_id', $patient_auto_id[$i]);
			$this->db->set('name', $name[$i]);
			$this->db->set('dignosis', $dignosis[$i]);
			$this->db->set('test_name', $test_name[$i]);
			$this->db->set('test_type', $test_type[$i]);
			$this->db->set('report_type', $report_type[$i]);
			$this->db->set('report_section', $report_section[$i]);
			$this->db->set('unit', $unit[$i]);
			$this->db->set('reference_range', $reference_range[$i]);
			$this->db->set('result', $result[$i]);
			$this->db->set('ipd_opd', $section[$i]);
			$this->db->set('create_date', $create_date[$i]);

			$updateRes = $this->db->insert('investi_opd_report_result');

			// print_r($this->db->last_query());
		}
		if ($updateRes) {
			$this->session->set_flashdata('message', display('save_successfully'));
			redirect('dashboard/home');
		} else {
			$this->session->set_flashdata('exception', display('Something Wents Wrong!'));
			// redirect('patients/physiotheropy_add');
		}
	}


	public function get_haematology_patient_profile($patient_auto_id = NULL, $section = NULL)
	{

		if ($section == 'opd') {
			$data['haematology_profile_opd'] = $this->db
				->select('investi_opd_report_result.patient_auto_id,investi_opd_report_result.test_name,investi_opd_report_result.report_type,investi_opd_report_result.report_section,investi_opd_report_result.unit,investi_opd_report_result.reference_range,investi_opd_report_result.result,patient.id,patient.sex,patient.date_of_birth')
				->from('investi_opd_report_result')
				->join('patient', 'patient.id = investi_opd_report_result.patient_auto_id')
				->where('investi_opd_report_result.patient_auto_id', $patient_auto_id)
				->get()
				->result();
			// print_r($this->db->last_query());

			$data['haematology_pro'] = $this->db->select('distinct(investi_opd_report_result.report_type),investi_opd_report_result.*,patient.id,patient.sex,patient.date_of_birth')
				->from('investi_opd_report_result')
				->join('patient', 'patient.id = investi_opd_report_result.patient_auto_id')
				->where('investi_opd_report_result.patient_auto_id', $patient_auto_id)
				->limit(1)
				->get()
				->row();
			//  print_r($this->db->last_query());
		} else {
			$data['haematology_profile_ipd'] = $this->db
				->select('investi_ipd_report_result.patient_auto_id,investi_ipd_report_result.test_name,investi_ipd_report_result.report_type,investi_ipd_report_result.report_section,investi_ipd_report_result.unit,investi_ipd_report_result.reference_range,investi_ipd_report_result.result,patient_ipd.id,patient_ipd.sex,patient_ipd.date_of_birth')
				->from('investi_ipd_report_result')
				->join('patient_ipd', 'patient_ipd.id = investi_ipd_report_result.patient_auto_id')
				->where('investi_ipd_report_result.patient_auto_id', $patient_auto_id)
				//->group_by('investi_ipd_report_result.patient_auto_id')
				->get()
				->result();
			// print_r($this->db->last_query());
			$data['haematology_pro'] = $this->db->select('distinct(investi_ipd_report_result.report_type),investi_ipd_report_result.*,patient_ipd.id,patient_ipd.sex,patient_ipd.date_of_birth')
				->from('investi_ipd_report_result')
				->join('patient_ipd', 'patient_ipd.id = investi_ipd_report_result.patient_auto_id')
				->where('investi_ipd_report_result.patient_auto_id', $patient_auto_id)
				->limit(1)
				->get()
				->row();

		}

		$data['id'] = $patient_auto_id;
		$id = $patient_auto_id;
		$data['patient_id'] = $id;

		$data['section'] = $section;
		$data['content'] = $this->load->view('haematology_profile', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}






	public function all_form($patient_auto_id = NULL, $section = NULL)
	{

		if ($section == 'opd') {
			$data['haematology_report_opd'] = $this->db
				->select('investi_opd_report_result.patient_auto_id,investi_opd_report_result.test_name,investi_opd_report_result.report_type,investi_opd_report_result.report_section,investi_opd_report_result.unit,investi_opd_report_result.reference_range,investi_opd_report_result.result,patient.id,patient.sex,patient.date_of_birth')
				->from('investi_opd_report_result')
				->join('patient', 'patient.id = investi_opd_report_result.patient_auto_id')
				->where('investi_opd_report_result.patient_auto_id', $patient_auto_id)
				->get()
				->result();
			// print_r($this->db->last_query());

			$data['haematology_pro'] = $this->db->select('distinct(investi_opd_report_result.report_type),investi_opd_report_result.*,patient.id,patient.sex,patient.date_of_birth')
				->from('investi_opd_report_result')
				->join('patient', 'patient.id = investi_opd_report_result.patient_auto_id')
				->where('investi_opd_report_result.patient_auto_id', $patient_auto_id)
				->limit(1)
				->get()
				->result();
		} else {
			$data['haematology_report_ipd'] = $this->db
				->select('investi_ipd_report_result.patient_auto_id,investi_ipd_report_result.test_name,investi_ipd_report_result.report_type,investi_ipd_report_result.report_section,investi_ipd_report_result.unit,investi_ipd_report_result.reference_range,investi_ipd_report_result.result,patient_ipd.id,patient_ipd.sex,patient_ipd.date_of_birth')
				->from('investi_ipd_report_result')
				->join('patient_ipd', 'patient_ipd.id = investi_ipd_report_result.patient_auto_id')
				->where('investi_ipd_report_result.patient_auto_id', $patient_auto_id)
				//->group_by('investi_ipd_report_result.patient_auto_id')
				->get()
				->result();
			// print_r($this->db->last_query());
			$data['haematology_pro'] = $this->db->select('distinct(investi_ipd_report_result.report_type),investi_ipd_report_result.*,patient_ipd.id,patient_ipd.sex,patient_ipd.date_of_birth')
				->from('investi_ipd_report_result')
				->join('patient_ipd', 'patient_ipd.id = investi_ipd_report_result.patient_auto_id')
				->where('investi_ipd_report_result.patient_auto_id', $patient_auto_id)
				->limit(1)
				->get()
				->result();

		}


		$id = $patient_auto_id;
		//print_r($id);
		$data['patient_id'] = $id;

		$data['section'] = $section;
		// $data['test']='1';
		$data['content'] = $this->load->view('all_report_form', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}


	public function checkform($patient_auto_id = NULL, $section = NULL, $test_type = NULL)
	{
		$section = $this->input->get('section');
		$patient_auto_id = $this->input->get('patient_auto_id');
		$test_type = $this->input->get('test_type');

		if ($section == 'opd') {
			$data['hm_report_opd'] = $this->db
				->select('investi_opd_report_result.patient_auto_id,investi_opd_report_result.test_name,investi_opd_report_result.report_type,investi_opd_report_result.report_section,investi_opd_report_result.unit,investi_opd_report_result.reference_range,investi_opd_report_result.result,patient.id,patient.sex,patient.date_of_birth')
				->from('investi_opd_report_result')
				->join('patient', 'patient.id = investi_opd_report_result.patient_auto_id')
				->where('investi_opd_report_result.patient_auto_id', $patient_auto_id)
				->where('investi_opd_report_result.report_type', $test_type)
				->get()
				->result();
			// print_r($this->db->last_query());

			$data['haematology_pro'] = $this->db->select('distinct(investi_opd_report_result.report_type),investi_opd_report_result.*,patient.id,patient.sex,patient.date_of_birth')
				->from('investi_opd_report_result')
				->join('patient', 'patient.id = investi_opd_report_result.patient_auto_id')
				->where('investi_opd_report_result.patient_auto_id', $patient_auto_id)
				->limit(1)
				->get()
				->result();
		} else {
			$data['haematology_report_ipd'] = $this->db
				->select('investi_ipd_report_result.patient_auto_id,investi_ipd_report_result.test_name,investi_ipd_report_result.report_type,investi_ipd_report_result.report_section,investi_ipd_report_result.unit,investi_ipd_report_result.reference_range,investi_ipd_report_result.result,patient_ipd.id,patient_ipd.sex,patient_ipd.date_of_birth')
				->from('investi_ipd_report_result')
				->join('patient_ipd', 'patient_ipd.id = investi_ipd_report_result.patient_auto_id')
				->where('investi_ipd_report_result.patient_auto_id', $patient_auto_id)
				//->group_by('investi_ipd_report_result.patient_auto_id')
				->get()
				->result();
			// print_r($this->db->last_query());
			$data['haematology_pro'] = $this->db->select('distinct(investi_ipd_report_result.report_type),investi_ipd_report_result.*,patient_ipd.id,patient_ipd.sex,patient_ipd.date_of_birth')
				->from('investi_ipd_report_result')
				->join('patient_ipd', 'patient_ipd.id = investi_ipd_report_result.patient_auto_id')
				->where('investi_ipd_report_result.patient_auto_id', $patient_auto_id)
				->limit(1)
				->get()
				->result();
		}

		$id = $patient_auto_id;
		//print_r($id);
		$data['patient_id'] = $id;
		$data['test_type'] = $test_type;

		$data['section'] = $section;

		$data['content'] = $this->load->view('form_check', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}




	public function test()
	{
		$data['data'] = '';
		$data['content'] = $this->load->view('opd_panchkarma', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function test7()
	{
		$data['data'] = '';
		$data['content'] = $this->load->view('opd_panchkarma', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}


	public function get_panchkarma_patient()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		//	$end_date1   = $this->input->get('end_date', TRUE);
		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = $start_date2;
		$section = $this->input->get('section', TRUE);
		$start_date = $start_date2;
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;

		if ($section == 'opd') {
			$data['patients'] = $this->db->select('*')
				->from('patient')
				->where('create_date >=', $start_date2)
				->where('create_date <=', $end_date2)
				->where('ipd_opd', $section)
				->get()
				->result();
			//print_r($this->db->last_query());
		} else {
			$data['patients'] = $this->db->select('*')
				->from('patient_ipd')
				->where('create_date >=', $start_date2)
				->where('create_date <=', $end_date2)
				->where('ipd_opd', $section)
				->get()
				->result();
		}


		//$data['data']=  '';
		$data['content'] = $this->load->view('panchkarma_patient', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}


	public function insert_panch_patient()
	{
		$data['title'] = display('add_panch_patient_result');

		$ipd_opd = $this->input->post('section', true);
		if ($ipd_opd['0'] == 'opd') {
			$snehan = $this->input->post('snehan', true);
			$swedan = $this->input->post('swedan', true);
			$vaman = $this->input->post('vaman', true);
			$virechan = $this->input->post('virechan', true);
			$basti = $this->input->post('basti', true);
			$nasya = $this->input->post('nasya', true);
			$raktmokshan = $this->input->post('raktmokshan', true);
			$shirodhara = $this->input->post('shirodhara', true);
			$shrirobasti = $this->input->post('shrirobasti', true);
			$other = $this->input->post('other', true);
			$yonidhavan = $this->input->post('yonidhavan', true);
			$yonipichu = $this->input->post('yonipichu', true);
			$uttarbasti = $this->input->post('uttarbasti', true);
			if ($snehan || $swedan || $vaman || $virechan || $basti || $nasya || $raktmokshan || $shirodhara || $shrirobasti || $other || $yonidhavan || $yonipichu || $uttarbasti) {
				$result = $this->input->post('snehan', true);
				$count = sizeof($result);
				for ($i = 0; $i < $count; $i++) {
					$section = $this->input->post('section', true);
					$patient_auto_id = $this->input->post('patient_auto_id', true);
					// $new_patient = $this->input->post('new_patient',true);
					// $old_patient = $this->input->post('old_patient',true);
					$name = $this->input->post('name', true);
					$create_date = $this->input->post('create_date', true);
					$snehan = $this->input->post('snehan', true);
					$swedan = $this->input->post('swedan', true);
					$vaman = $this->input->post('vaman', true);
					$virechan = $this->input->post('virechan', true);
					$basti = $this->input->post('basti', true);
					$nasya = $this->input->post('nasya', true);
					$raktmokshan = $this->input->post('raktmokshan', true);
					$shirodhara = $this->input->post('shirodhara', true);
					$shrirobasti = $this->input->post('shrirobasti', true);
					$other = $this->input->post('other', true);
					$yonidhavan = $this->input->post('yonidhavan', true);
					$yonipichu = $this->input->post('yonipichu', true);
					$uttarbasti = $this->input->post('uttarbasti', true);

					$this->db->set('patient_auto_id', $patient_auto_id[$i]);
					$this->db->set('patient_name', $name[$i]);
					$this->db->set('ipd_opd', $section[$i]);
					$this->db->set('create_date', $create_date[$i]);
					$this->db->set('snehan', $snehan[$i]);
					$this->db->set('swedan', $swedan[$i]);
					$this->db->set('vaman', $vaman[$i]);
					$this->db->set('virechan', $virechan[$i]);
					$this->db->set('nasya', $nasya[$i]);
					$this->db->set('raktmokshan', $raktmokshan[$i]);
					$this->db->set('shirodhara', $shirodhara[$i]);
					$this->db->set('shirobasti', $shrirobasti[$i]);
					$this->db->set('uttarbasti', $uttarbasti[$i]);
					$this->db->set('basti', $basti[$i]);
					$this->db->set('others', $other[$i]);
					$this->db->set('yonidhavan', $yonidhavan[$i]);
					$this->db->set('yonipichu', $yonipichu[$i]);

					$updateRes = $this->db->insert('investi_panch_opd_patient_count');
					if ($updateRes) {
						$this->session->set_flashdata('message', display('save_successfully'));
						redirect('patients/get_panchkarma_patient');
					} else {
						$this->session->set_flashdata('exception', display('Something Wents Wrong!'));
						// redirect('patients/physiotheropy_add');
					}
					// print_r($this->db->last_query());
				}
			}

		} else {
			$snehan = $this->input->post('snehan', true);
			$swedan = $this->input->post('swedan', true);
			$vaman = $this->input->post('vaman', true);
			$virechan = $this->input->post('virechan', true);
			$basti = $this->input->post('basti', true);
			$nasya = $this->input->post('nasya', true);
			$raktmokshan = $this->input->post('raktmokshan', true);
			$shirodhara = $this->input->post('shirodhara', true);
			$shrirobasti = $this->input->post('shrirobasti', true);
			$other = $this->input->post('other', true);
			$yonidhavan = $this->input->post('yonidhavan', true);
			$yonipichu = $this->input->post('yonipichu', true);
			$uttarbasti = $this->input->post('uttarbasti', true);

			if ($snehan || $swedan || $vaman || $virechan || $basti || $nasya || $raktmokshan || $shirodhara || $shrirobasti || $other || $yonidhavan || $yonipichu || $uttarbasti) {
				$result = $this->input->post('snehan', true);
				$count = sizeof($result);
				for ($i = 0; $i < $count; $i++) {
					$section = $this->input->post('section', true);
					$patient_auto_id = $this->input->post('patient_auto_id', true);
					// $new_patient = $this->input->post('new_patient',true);
					// $old_patient = $this->input->post('old_patient',true);
					$name = $this->input->post('name', true);
					$create_date = $this->input->post('create_date', true);
					$snehan = $this->input->post('snehan', true);
					$swedan = $this->input->post('swedan', true);
					$vaman = $this->input->post('vaman', true);
					$virechan = $this->input->post('virechan', true);
					$basti = $this->input->post('basti', true);
					$nasya = $this->input->post('nasya', true);
					$raktmokshan = $this->input->post('raktmokshan', true);
					$shirodhara = $this->input->post('shirodhara', true);
					$shrirobasti = $this->input->post('shrirobasti', true);
					$other = $this->input->post('other', true);
					$yonidhavan = $this->input->post('yonidhavan', true);
					$yonipichu = $this->input->post('yonipichu', true);
					$uttarbasti = $this->input->post('uttarbasti', true);

					$this->db->set('patient_auto_id', $patient_auto_id[$i]);
					$this->db->set('patient_name', $name[$i]);
					$this->db->set('ipd_opd', $section[$i]);
					$this->db->set('create_date', $create_date[$i]);
					$this->db->set('snehan', $snehan[$i]);
					$this->db->set('swedan', $swedan[$i]);
					$this->db->set('vaman', $vaman[$i]);
					$this->db->set('virechan', $virechan[$i]);
					$this->db->set('nasya', $nasya[$i]);
					$this->db->set('raktmokshan', $raktmokshan[$i]);
					$this->db->set('shirodhara', $shirodhara[$i]);
					$this->db->set('shirobasti', $shrirobasti[$i]);
					$this->db->set('uttarbasti', $uttarbasti[$i]);
					$this->db->set('basti', $basti[$i]);
					$this->db->set('others', $other[$i]);
					$this->db->set('yonidhavan', $yonidhavan[$i]);
					$this->db->set('yonipichu', $yonipichu[$i]);

					$updateRes = $this->db->insert('investi_panch_ipd_patient_count');
					if ($updateRes) {
						$this->session->set_flashdata('message', display('save_successfully'));
						redirect('patients/get_panchkarma_patient');
					} else {
						$this->session->set_flashdata('exception', display('Something Wents Wrong!'));
						// redirect('patients/physiotheropy_add');
					}

				}
			}
		}

	}

	public function insert_investi_patient()
	{
		$data['title'] = display('add_panch_patient_result');

		$ipd_opd = $this->input->post('section', true);
		if ($ipd_opd['0'] == 'opd') {
			$hematology = $this->input->post('hematology', true);
			$serology = $this->input->post('serology', true);
			$biochemical = $this->input->post('biochemical', true);
			$microbiology = $this->input->post('microbiology', true);

			if ($hematology || $serology || $biochemical || $microbiology) {
				$hematology = $this->input->post('hematology', true);
				$serology = $this->input->post('serology', true);
				$biochemical = $this->input->post('biochemical', true);
				$microbiology = $this->input->post('microbiology', true);

				$count = sizeof($result);
				for ($i = 0; $i < $count; $i++) {
					$section = $this->input->post('section', true);
					$patient_auto_id = $this->input->post('patient_auto_id', true);
					// $new_patient = $this->input->post('new_patient',true);
					// $old_patient = $this->input->post('old_patient',true);
					$name = $this->input->post('name', true);
					$create_date = $this->input->post('create_date', true);
					$hematology = $this->input->post('hematology', true);
					$serology = $this->input->post('serology', true);
					$biochemical = $this->input->post('biochemical', true);
					$microbiology = $this->input->post('microbiology', true);


					$this->db->set('patient_auto_id', $patient_auto_id[$i]);
					$this->db->set('patient_name', $name[$i]);
					$this->db->set('ipd_opd', $section[$i]);
					$this->db->set('create_date', $create_date[$i]);
					$this->db->set('hematology', $hematology[$i]);
					$this->db->set('serology', $serology[$i]);
					$this->db->set('biochemical', $biochemical[$i]);
					$this->db->set('microbiology', $microbiology[$i]);


					$updateRes = $this->db->insert('investi_panch_opd_patient_count');
					if ($updateRes) {
						$this->session->set_flashdata('message', display('save_successfully'));
						redirect('patients/get_panchkarma_patient');
					} else {
						$this->session->set_flashdata('exception', display('Something Wents Wrong!'));
						// redirect('patients/physiotheropy_add');
					}
					// print_r($this->db->last_query());
				}
			}

		} else {
			$hematology = $this->input->post('hematology', true);
			$serology = $this->input->post('serology', true);
			$biochemical = $this->input->post('biochemical', true);
			$microbiology = $this->input->post('microbiology', true);


			if ($hematology || $serology || $biochemical || $microbiology) {
				$result = $this->input->post('snehan', true);
				$count = sizeof($result);
				for ($i = 0; $i < $count; $i++) {
					$section = $this->input->post('section', true);
					$patient_auto_id = $this->input->post('patient_auto_id', true);
					// $new_patient = $this->input->post('new_patient',true);
					// $old_patient = $this->input->post('old_patient',true);
					$name = $this->input->post('name', true);
					$create_date = $this->input->post('create_date', true);
					$hematology = $this->input->post('hematology', true);
					$serology = $this->input->post('serology', true);
					$biochemical = $this->input->post('biochemical', true);
					$microbiology = $this->input->post('microbiology', true);


					$this->db->set('patient_auto_id', $patient_auto_id[$i]);
					$this->db->set('patient_name', $name[$i]);
					$this->db->set('ipd_opd', $section[$i]);
					$this->db->set('create_date', $create_date[$i]);
					$this->db->set('hematology', $hematology[$i]);
					$this->db->set('serology', $serology[$i]);
					$this->db->set('biochemical', $biochemical[$i]);
					$this->db->set('microbiology', $microbiology[$i]);
					$updateRes = $this->db->insert('investi_panch_ipd_patient_count');
					if ($updateRes) {
						$this->session->set_flashdata('message', display('save_successfully'));
						redirect('patients/get_panchkarma_patient');
					} else {
						$this->session->set_flashdata('exception', display('Something Wents Wrong!'));
						// redirect('patients/physiotheropy_add');
					}

				}
			}
		}

	}


	public function add_pharma()
	{
		$data['pharma_tab'] = $this->patient_model->get_tablet_pharma();
		$data['content'] = $this->load->view('add_pharma', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function edit_pharma($id)
	{
		$data['pharma_tab'] = $this->patient_model->get_tablet_pharma();
		$data['pharma_stock'] = $this->patient_model->edit_pharma($id);
		$data['content'] = $this->load->view('edit_pharma', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}
	public function update_stock_details()
	{
		$id = $this->input->post('id', true);
		$manufacturing_date = $this->input->post('manufacturing_date', true);

		$old_date_M = strpos($manufacturing_date, "-");
		//die(); 
		if ($old_date_M) {
			$manufacturing_date_final = $manufacturing_date;
		} else {
			$a = explode(' ', $manufacturing_date);
			//  echo $a['0'];
			// die();
			if ($a['0'] == 'January') {
				$month = '01';
			} elseif ($a['0'] == 'February') {
				$month = '02';
			} elseif ($a['0'] == 'March') {
				$month = '03';
			} elseif ($a['0'] == 'April') {
				$month = '04';
			} elseif ($a['0'] == 'May') {
				$month = '05';
			} elseif ($a['0'] == 'June') {
				$month = '06';
			} elseif ($a['0'] == 'July') {
				$month = '07';
			} elseif ($a['0'] == 'August') {
				$month = '08';
			} elseif ($a['0'] == 'September') {
				$month = '09';
			} elseif ($a['0'] == 'October') {
				$month = '10';
			} elseif ($a['0'] == 'November') {
				$month = '11';
			} elseif ($a['0'] == 'December') {
				$month = '12';
			}
			$manufacturing_date_final = $month . '-' . $a['1'];
		}

		$expiry_date = $this->input->post('expiry_date', true);
		$old_date_M = strpos($expiry_date, "-");


		if ($old_date_M) {
			$expiry_date_final = $expiry_date;
		} else {
			$b = explode(' ', $expiry_date);
			// print_r($a);
			if ($b['0'] == 'January') {
				$month = '01';
			} elseif ($b['0'] == 'February') {
				$month = '02';
			} elseif ($b['0'] == 'March') {
				$month = '03';
			} elseif ($b['0'] == 'April') {
				$month = '04';
			} elseif ($b['0'] == 'May') {
				$month = '05';
			} elseif ($b['0'] == 'June') {
				$month = '06';
			} elseif ($b['0'] == 'July') {
				$month = '07';
			} elseif ($b['0'] == 'August') {
				$month = '08';
			} elseif ($b['0'] == 'September') {
				$month = '09';
			} elseif ($b['0'] == 'October') {
				$month = '10';
			} elseif ($b['0'] == 'November') {
				$month = '11';
			} elseif ($b['0'] == 'December') {
				$month = '12';
			}
			$expiry_date_final = $month . '-' . $b['1'];

		}
		$old_date = $this->db->select('*')->from('pharma_original_stock')->where('id', $id)->get()->row();
		// print_r($this->db->last_query());

		//  if($expiry_date1)
		//  {
		//    $expiry_date_final = $expiry_date1;
		//  }
		//  else
		//  {
		// echo   $expiry_date_final = $old_date->expiry_date;
		//  }
		//  
		//  
		//  	if($manufacturing_date1)
		//     {
		//     $manufacturing_date_final = $manufacturing_date1;
		//     }else
		//     {
		//    echo   $manufacturing_date_final = $old_date->manufacturing_date;
		//     }



		$update_stk = array(

			'tab_name' => $this->input->post('tab_name', true),
			'batch_number' => $this->input->post('batch_number', true),
			'create_date' => date("Y-m-d", strtotime($this->input->post('create_date', true))),
			'tablet_company_name' => $this->input->post('tablet_company_name', true),
			'manufacturing_date' => $manufacturing_date_final,
			'expiry_date' => $expiry_date_final,
			'mrp' => $this->input->post('mrp', true),
			'rate' => $this->input->post('rate', true),
			'discount' => $this->input->post('discount', true),
			'gst' => $this->input->post('gst', true),
			'gst_amount' => $this->input->post('gst_amount', true),
			'total_amount' => $this->input->post('total_amount', true),
			'closing_stock' => $this->input->post('closing_stock', true),
			'quantity' => $this->input->post('quantity', true),
			'opening_stock' => $this->input->post('quantity', true),
		);
		// print_r($update_stk);
		// die(); 
		$this->db->where('id', $id);
		$this->db->update('pharma_original_stock', $update_stk);

		$this->session->set_flashdata('message', display('Update successfully'));
		redirect('patients/pharma_list');

	}
	public function save_pharma_patient()
	{
		$data['title'] = display('add_pharma_patient_result');



		$tab_name = $this->input->post('tab_name', true);
		$batch_number = $this->input->post('batch_number', true);
		$create_date = $this->input->post('create_date', true);
		$create_date = date("Y-m-d", strtotime($create_date));
		$tablet_company_name = $this->input->post('tablet_company_name', true);

		$mrp = $this->input->post('mrp', true);
		$rate = $this->input->post('rate', true);
		$discount = $this->input->post('discount', true);
		$gst = $this->input->post('gst', true);
		$gst_amount = $this->input->post('gst_amount', true);
		$total_amount = $this->input->post('total_amount', true);







		$manufacturing_date = $this->input->post('manufacturing_date', true);
		$a = explode(' ', $manufacturing_date);
		// print_r($a);
		if ($a['0'] == 'January') {
			$month = '01';
		} elseif ($a['0'] == 'February') {
			$month = '02';
		} elseif ($a['0'] == 'March') {
			$month = '03';
		} elseif ($a['0'] == 'April') {
			$month = '04';
		} elseif ($a['0'] == 'May') {
			$month = '05';
		} elseif ($a['0'] == 'June') {
			$month = '06';
		} elseif ($a['0'] == 'July') {
			$month = '07';
		} elseif ($a['0'] == 'August') {
			$month = '08';
		} elseif ($a['0'] == 'September') {
			$month = '09';
		} elseif ($a['0'] == 'October') {
			$month = '10';
		} elseif ($a['0'] == 'November') {
			$month = '11';
		} elseif ($a['0'] == 'December') {
			$month = '12';
		}

		$manufacturing_date_final = $month . '-' . $a['1'];
		//echo"<br>";

		$manufacturing_date = $manufacturing_date_final;
		$expiry_date = $this->input->post('expiry_date', true);
		$b = explode(' ', $expiry_date);
		// print_r($a);
		if ($b['0'] == 'January') {
			$month = '01';
		} elseif ($b['0'] == 'February') {
			$month = '02';
		} elseif ($b['0'] == 'March') {
			$month = '03';
		} elseif ($b['0'] == 'April') {
			$month = '04';
		} elseif ($b['0'] == 'May') {
			$month = '05';
		} elseif ($b['0'] == 'June') {
			$month = '06';
		} elseif ($b['0'] == 'July') {
			$month = '07';
		} elseif ($b['0'] == 'August') {
			$month = '08';
		} elseif ($b['0'] == 'September') {
			$month = '09';
		} elseif ($b['0'] == 'October') {
			$month = '10';
		} elseif ($b['0'] == 'November') {
			$month = '11';
		} elseif ($b['0'] == 'December') {
			$month = '12';
		}

		$expiry_date_final = $month . '-' . $b['1'];
		//die();
		$expiry_date = $expiry_date_final;
		$quantity = $this->input->post('quantity', true);
		$agency_name = $this->input->post('agency_name', true);


		$this->db->set('tab_name', $tab_name);
		$this->db->set('batch_number', $batch_number);
		$this->db->set('create_date', $create_date);

		$this->db->set('mrp', $mrp);
		$this->db->set('rate', $rate);
		$this->db->set('discount', $discount);
		$this->db->set('gst', $gst);
		$this->db->set('gst_amount', $gst_amount);
		$this->db->set('total_amount', $total_amount);

		$this->db->set('tablet_company_name', $tablet_company_name);
		$this->db->set('manufacturing_date', $manufacturing_date);
		$this->db->set('expiry_date', $expiry_date);
		$this->db->set('quantity', $quantity);
		$this->db->set('opening_stock', $quantity);
		$this->db->set('closing_stock', $quantity);
		$this->db->set('agency_name', $agency_name);

		$updateRes = $this->db->insert('pharma_original_stock');
		if ($updateRes) {
			$this->session->set_flashdata('message', display('save_successfully'));
			redirect('patients/pharma_list');
		} else {
			$this->session->set_flashdata('exception', display('Something Wents Wrong!'));
			// redirect('patients/physiotheropy_add');
		}
	}

	public function pharma_list()
	{
		$data['pharma'] = $this->patient_model->get_pharma();
		// print_r($this->db->last_query());
		$data['content'] = $this->load->view('pharma_list', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}
	public function opening_closing()
	{
		$data['pharma'] = $this->patient_model->opening_closing();
		//print_r($this->db->last_query());
		$data['content'] = $this->load->view('opening_closing', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function get_pharma_patient()
	{
		$data['pharma'] = $this->patient_model->opening_closing();
		$data['pharma_tab'] = $this->patient_model->get_tablet();
		//print_r($this->db->last_query());
		$data['content'] = $this->load->view('get_pharma_patient', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}
	public function save_pharma_patient_count()
	{
		$data['title'] = display('save_pharma_patient');
		// $patient_array_pharma = array(
		//     'patient_auto_id' => $this->input->post('id',true),
		//     'yearly_reg_no' => $this->input->post('opd_no',true),
		//     'name' => $this->input->post('name',true),
		//     'age' => $this->input->post('age',true),
		//     'sex' => $this->input->post('sex',true),
		//     'dignosis' => $this->input->post('dignosis',true),
		//     'tab_name1' => ($this->input->post('tab_name1',true))?$this->input->post('tab_name1',true):NULL,
		//     'tab_quantity1' => ($this->input->post('tab1_quantity',true))?$this->input->post('tab1_quantity',true):NULL,
		//     'tab_name2' => ($this->input->post('tab_name2',true))?$this->input->post('tab_name2',true):NULL,
		//     'tab_quantity2' => ($this->input->post('tab2_quantity',true))?$this->input->post('tab2_quantity',true):NULL,
		//     'tab_name3' => ($this->input->post('tab_name3',true))?$this->input->post('tab_name3',true):NULL,
		//     'tab_quantity3' => ($this->input->post('tab3_quantity',true))?$this->input->post('tab3_quantity',true):NULL,
		//     'tab_name4' => ($this->input->post('tab_name4',true))?$this->input->post('tab_name4',true):NULL,
		//     'tab_quantity4' => ($this->input->post('tab4_quantity',true))?$this->input->post('tab4_quantity',true):NULL,
		//     'tab_name5' => ($this->input->post('tab_name5',true))?$this->input->post('tab_name5',true):NULL,
		//     'tab_quantity5' => ($this->input->post('tab5_quantity',true))?$this->input->post('tab5_quantity',true):NULL
		//     );




		$patient_auto_id = ($this->input->post('id', true)) ? $this->input->post('id', true) : NULL;
		$yearly_reg_no = ($this->input->post('opd_no', true)) ? $this->input->post('opd_no', true) : NULL;
		$name = ($this->input->post('name', true)) ? $this->input->post('name', true) : NULL;
		$age = ($this->input->post('age', true)) ? $this->input->post('age', true) : NULL;
		$sex = ($this->input->post('sex', true)) ? $this->input->post('sex', true) : NULL;
		$date = date("Y-m-d", strtotime($this->input->post('create_date', true)));
		$weight = ($this->input->post('weight', true)) ? $this->input->post('weight', true) : NULL;
		$section = ($this->input->post('section', true)) ? $this->input->post('section', true) : NULL;
		$dignosis = ($this->input->post('dignosis', true)) ? $this->input->post('dignosis', true) : NULL;



		$tab_name1 = ($this->input->post('tab_name1', true)) ? $this->input->post('tab_name1', true) : NULL;
		$tab_quantity1 = ($this->input->post('tab1_quantity', true)) ? $this->input->post('tab1_quantity', true) : NULL;
		$price_tab1 = ($this->input->post('price_tab1', true)) ? $this->input->post('price_tab1', true) : NULL;
		$tab_name2 = ($this->input->post('tab_name2', true)) ? $this->input->post('tab_name2', true) : NULL;
		$tab_quantity2 = ($this->input->post('tab2_quantity', true)) ? $this->input->post('tab2_quantity', true) : NULL;
		$price_tab2 = ($this->input->post('price_tab2', true)) ? $this->input->post('price_tab2', true) : NULL;
		$tab_name3 = ($this->input->post('tab_name3', true)) ? $this->input->post('tab_name3', true) : NULL;
		$tab_quantity3 = ($this->input->post('tab3_quantity', true)) ? $this->input->post('tab3_quantity', true) : NULL;
		$price_tab3 = ($this->input->post('price_tab3', true)) ? $this->input->post('price_tab3', true) : NULL;
		$tab_name4 = ($this->input->post('tab_name4', true)) ? $this->input->post('tab_name4', true) : NULL;
		$tab_quantity4 = ($this->input->post('tab4_quantity', true)) ? $this->input->post('tab4_quantity', true) : NULL;
		$price_tab4 = ($this->input->post('price_tab4', true)) ? $this->input->post('price_tab4', true) : NULL;
		$tab_name5 = ($this->input->post('tab_name5', true)) ? $this->input->post('tab_name5', true) : NULL;
		$tab_quantity5 = ($this->input->post('tab5_quantity', true)) ? $this->input->post('tab5_quantity', true) : NULL;
		$price_tab5 = ($this->input->post('price_tab5', true)) ? $this->input->post('price_tab5', true) : NULL;
		$tab_name6 = ($this->input->post('tab_name6', true)) ? $this->input->post('tab_name6', true) : NULL;
		$tab_quantity6 = ($this->input->post('tab6_quantity', true)) ? $this->input->post('tab6_quantity', true) : NULL;
		$price_tab6 = ($this->input->post('price_tab6', true)) ? $this->input->post('price_tab6', true) : NULL;
		$tab_name7 = ($this->input->post('tab_name7', true)) ? $this->input->post('tab_name7', true) : NULL;
		$tab_quantity7 = ($this->input->post('tab7_quantity', true)) ? $this->input->post('tab7_quantity', true) : NULL;
		$price_tab7 = ($this->input->post('price_tab7', true)) ? $this->input->post('price_tab7', true) : NULL;
		$tab_name8 = ($this->input->post('tab_name8', true)) ? $this->input->post('tab_name8', true) : NULL;
		$tab_quantity8 = ($this->input->post('tab8_quantity', true)) ? $this->input->post('tab8_quantity', true) : NULL;
		$price_tab8 = ($this->input->post('price_tab8', true)) ? $this->input->post('price_tab8', true) : NULL;
		$tab_name9 = ($this->input->post('tab_name9', true)) ? $this->input->post('tab_name9', true) : NULL;
		$tab_quantity9 = ($this->input->post('tab9_quantity', true)) ? $this->input->post('tab9_quantity', true) : NULL;
		$price_tab9 = ($this->input->post('price_tab9', true)) ? $this->input->post('price_tab9', true) : NULL;
		$tab_name10 = ($this->input->post('tab_name10', true)) ? $this->input->post('tab_name10', true) : NULL;
		$tab_quantity10 = ($this->input->post('tab10_quantity', true)) ? $this->input->post('tab10_quantity', true) : NULL;
		$price_tab10 = ($this->input->post('price_tab10', true)) ? $this->input->post('price_tab10', true) : NULL;
		$tab_name11 = ($this->input->post('tab_name11', true)) ? $this->input->post('tab_name11', true) : NULL;
		$tab_quantity11 = ($this->input->post('tab11_quantity', true)) ? $this->input->post('tab11_quantity', true) : NULL;
		$price_tab11 = ($this->input->post('price_tab11', true)) ? $this->input->post('price_tab11', true) : NULL;
		$tab_name12 = ($this->input->post('tab_name12', true)) ? $this->input->post('tab_name12', true) : NULL;
		$tab_quantity12 = ($this->input->post('tab12_quantity', true)) ? $this->input->post('tab12_quantity', true) : NULL;
		$price_tab12 = ($this->input->post('price_tab12', true)) ? $this->input->post('price_tab12', true) : NULL;
		$tab_name13 = ($this->input->post('tab_name13', true)) ? $this->input->post('tab_name13', true) : NULL;
		$tab_quantity13 = ($this->input->post('tab13_quantity', true)) ? $this->input->post('tab13_quantity', true) : NULL;
		$price_tab13 = ($this->input->post('price_tab13', true)) ? $this->input->post('price_tab13', true) : NULL;
		$tab_name14 = ($this->input->post('tab_name14', true)) ? $this->input->post('tab_name14', true) : NULL;
		$tab_quantity14 = ($this->input->post('tab14_quantity', true)) ? $this->input->post('tab14_quantity', true) : NULL;
		$price_tab14 = ($this->input->post('price_tab14', true)) ? $this->input->post('price_tab14', true) : NULL;
		$tab_name15 = ($this->input->post('tab_name15', true)) ? $this->input->post('tab_name15', true) : NULL;
		$tab_quantity15 = ($this->input->post('tab15_quantity', true)) ? $this->input->post('tab15_quantity', true) : NULL;
		$price_tab15 = ($this->input->post('price_tab15', true)) ? $this->input->post('price_tab15', true) : NULL;
		$tab_name5 = ($this->input->post('tab_name5', true)) ? $this->input->post('tab_name5', true) : NULL;
		$tab_quantity5 = ($this->input->post('tab5_quantity', true)) ? $this->input->post('tab5_quantity', true) : NULL;
		$price_tab5 = ($this->input->post('price_tab5', true)) ? $this->input->post('price_tab5', true) : NULL;
		$tab_name16 = ($this->input->post('tab_name16', true)) ? $this->input->post('tab_name16', true) : NULL;
		$tab_quantity16 = ($this->input->post('tab16_quantity', true)) ? $this->input->post('tab16_quantity', true) : NULL;
		$price_tab16 = ($this->input->post('price_tab16', true)) ? $this->input->post('price_tab16', true) : NULL;
		$tab_name17 = ($this->input->post('tab_name17', true)) ? $this->input->post('tab_name17', true) : NULL;
		$tab_quantity17 = ($this->input->post('tab17_quantity', true)) ? $this->input->post('tab17_quantity', true) : NULL;
		$price_tab17 = ($this->input->post('price_tab17', true)) ? $this->input->post('price_tab17', true) : NULL;
		$tab_name18 = ($this->input->post('tab_name18', true)) ? $this->input->post('tab_name18', true) : NULL;
		$tab_quantity18 = ($this->input->post('tab18_quantity', true)) ? $this->input->post('tab18_quantity', true) : NULL;
		$price_tab18 = ($this->input->post('price_tab18', true)) ? $this->input->post('price_tab18', true) : NULL;
		$tab_name19 = ($this->input->post('tab_name19', true)) ? $this->input->post('tab_name19', true) : NULL;
		$tab_quantity19 = ($this->input->post('tab19_quantity', true)) ? $this->input->post('tab19_quantity', true) : NULL;
		$price_tab19 = ($this->input->post('price_tab19', true)) ? $this->input->post('price_tab19', true) : NULL;
		$tab_name20 = ($this->input->post('tab_name20', true)) ? $this->input->post('tab_name20', true) : NULL;
		$tab_quantity20 = ($this->input->post('tab20_quantity', true)) ? $this->input->post('tab20_quantity', true) : NULL;
		$price_tab20 = ($this->input->post('price_tab20', true)) ? $this->input->post('price_tab20', true) : NULL;
		$tab_name21 = ($this->input->post('tab_name21', true)) ? $this->input->post('tab_name21', true) : NULL;
		$tab_quantity21 = ($this->input->post('tab21_quantity', true)) ? $this->input->post('tab21_quantity', true) : NULL;
		$price_tab21 = ($this->input->post('price_tab21', true)) ? $this->input->post('price_tab21', true) : NULL;
		$tab_name22 = ($this->input->post('tab_name22', true)) ? $this->input->post('tab_name22', true) : NULL;
		$tab_quantity22 = ($this->input->post('tab22_quantity', true)) ? $this->input->post('tab22_quantity', true) : NULL;
		$price_tab22 = ($this->input->post('price_tab22', true)) ? $this->input->post('price_tab22', true) : NULL;
		$tab_name23 = ($this->input->post('tab_name23', true)) ? $this->input->post('tab_name23', true) : NULL;
		$tab_quantity23 = ($this->input->post('tab23_quantity', true)) ? $this->input->post('tab23_quantity', true) : NULL;
		$price_tab23 = ($this->input->post('price_tab23', true)) ? $this->input->post('price_tab23', true) : NULL;
		$tab_name24 = ($this->input->post('tab_name24', true)) ? $this->input->post('tab_name24', true) : NULL;
		$tab_quantity24 = ($this->input->post('tab24_quantity', true)) ? $this->input->post('tab24_quantity', true) : NULL;
		$price_tab24 = ($this->input->post('price_tab24', true)) ? $this->input->post('price_tab24', true) : NULL;
		$tab_name25 = ($this->input->post('tab_name25', true)) ? $this->input->post('tab_name25', true) : NULL;
		$tab_quantity25 = ($this->input->post('tab25_quantity', true)) ? $this->input->post('tab25_quantity', true) : NULL;
		$price_tab25 = ($this->input->post('price_tab25', true)) ? $this->input->post('price_tab25', true) : NULL;



		// $last_id = $this->db->select('*')->from('pharma_original_patient')->where('patient_auto_id',$patient_auto_id)->get()->row();
		// $count_last_id = count($last_id);
		// if($count_last_id > 0)
		// {
		//     echo "<script>alert('Patient Is Already Added!'); 
		//             location.href='get_pharma_patient';</script>";
		//     //$this->session->set_flashdata('exception', display('Something Wents Wrong!'));
		//     //redirect('patients/get_pharma_patient');
		// }
		// else
		//  {





		if ($tab_quantity1 && $tab_quantity2 && $tab_quantity3 && $tab_quantity4 && $tab_quantity5 && $tab_quantity6 && $tab_quantity7 && $tab_quantity8 && $tab_quantity9 && $tab_quantity10 && $tab_quantity11 && $tab_quantity12 && $tab_quantity13 && $tab_quantity14 && $tab_quantity15 && $tab_quantity16 && $tab_quantity17 && $tab_quantity18 && $tab_quantity19 && $tab_quantity20 && $tab_quantity21 && $tab_quantity22 && $tab_quantity23 && $tab_quantity24 && $tab_quantity25) {
			$tab_quantity_array = array($tab_quantity1, $tab_quantity2, $tab_quantity3, $tab_quantity4, $tab_quantity5, $tab_quantity6, $tab_quantity7, $tab_quantity8, $tab_quantity9, $tab_quantity10, $tab_quantity11, $tab_quantity12, $tab_quantity13, $tab_quantity14, $tab_quantity15, $tab_quantity16, $tab_quantity17, $tab_quantity18, $tab_quantity19, $tab_quantity20, $tab_quantity21, $tab_quantity22, $tab_quantity23, $tab_quantity24, $tab_quantity25);
		} elseif ($tab_quantity1 && $tab_quantity2 && $tab_quantity3 && $tab_quantity4 && $tab_quantity5 && $tab_quantity6 && $tab_quantity7 && $tab_quantity8 && $tab_quantity9 && $tab_quantity10 && $tab_quantity11 && $tab_quantity12 && $tab_quantity13 && $tab_quantity14 && $tab_quantity15 && $tab_quantity16 && $tab_quantity17 && $tab_quantity18 && $tab_quantity19 && $tab_quantity20 && $tab_quantity21 && $tab_quantity22 && $tab_quantity23 && $tab_quantity24) {
			$tab_quantity_array = array($tab_quantity1, $tab_quantity2, $tab_quantity3, $tab_quantity4, $tab_quantity5, $tab_quantity6, $tab_quantity7, $tab_quantity8, $tab_quantity9, $tab_quantity10, $tab_quantity11, $tab_quantity12, $tab_quantity13, $tab_quantity14, $tab_quantity15, $tab_quantity16, $tab_quantity17, $tab_quantity18, $tab_quantity19, $tab_quantity20, $tab_quantity21, $tab_quantity22, $tab_quantity23, $tab_quantity24);
		} elseif ($tab_quantity1 && $tab_quantity2 && $tab_quantity3 && $tab_quantity4 && $tab_quantity5 && $tab_quantity6 && $tab_quantity7 && $tab_quantity8 && $tab_quantity9 && $tab_quantity10 && $tab_quantity11 && $tab_quantity12 && $tab_quantity13 && $tab_quantity14 && $tab_quantity15 && $tab_quantity16 && $tab_quantity17 && $tab_quantity18 && $tab_quantity19 && $tab_quantity20 && $tab_quantity21 && $tab_quantity22 && $tab_quantity23) {
			$tab_quantity_array = array($tab_quantity1, $tab_quantity2, $tab_quantity3, $tab_quantity4, $tab_quantity5, $tab_quantity6, $tab_quantity7, $tab_quantity8, $tab_quantity9, $tab_quantity10, $tab_quantity11, $tab_quantity12, $tab_quantity13, $tab_quantity14, $tab_quantity15, $tab_quantity16, $tab_quantity17, $tab_quantity18, $tab_quantity19, $tab_quantity20, $tab_quantity21, $tab_quantity22, $tab_quantity23);
		} elseif ($tab_quantity1 && $tab_quantity2 && $tab_quantity3 && $tab_quantity4 && $tab_quantity5 && $tab_quantity6 && $tab_quantity7 && $tab_quantity8 && $tab_quantity9 && $tab_quantity10 && $tab_quantity11 && $tab_quantity12 && $tab_quantity13 && $tab_quantity14 && $tab_quantity15 && $tab_quantity16 && $tab_quantity17 && $tab_quantity18 && $tab_quantity19 && $tab_quantity20 && $tab_quantity21 && $tab_quantity22) {
			$tab_quantity_array = array($tab_quantity1, $tab_quantity2, $tab_quantity3, $tab_quantity4, $tab_quantity5, $tab_quantity6, $tab_quantity7, $tab_quantity8, $tab_quantity9, $tab_quantity10, $tab_quantity11, $tab_quantity12, $tab_quantity13, $tab_quantity14, $tab_quantity15, $tab_quantity16, $tab_quantity17, $tab_quantity18, $tab_quantity19, $tab_quantity20, $tab_quantity21, $tab_quantity22);
		} elseif ($tab_quantity1 && $tab_quantity2 && $tab_quantity3 && $tab_quantity4 && $tab_quantity5 && $tab_quantity6 && $tab_quantity7 && $tab_quantity8 && $tab_quantity9 && $tab_quantity10 && $tab_quantity11 && $tab_quantity12 && $tab_quantity13 && $tab_quantity14 && $tab_quantity15 && $tab_quantity16 && $tab_quantity17 && $tab_quantity18 && $tab_quantity19 && $tab_quantity20 && $tab_quantity21) {
			$tab_quantity_array = array($tab_quantity1, $tab_quantity2, $tab_quantity3, $tab_quantity4, $tab_quantity5, $tab_quantity6, $tab_quantity7, $tab_quantity8, $tab_quantity9, $tab_quantity10, $tab_quantity11, $tab_quantity12, $tab_quantity13, $tab_quantity14, $tab_quantity15, $tab_quantity16, $tab_quantity17, $tab_quantity18, $tab_quantity19, $tab_quantity20, $tab_quantity21);
		} elseif ($tab_quantity1 && $tab_quantity2 && $tab_quantity3 && $tab_quantity4 && $tab_quantity5 && $tab_quantity6 && $tab_quantity7 && $tab_quantity8 && $tab_quantity9 && $tab_quantity10 && $tab_quantity11 && $tab_quantity12 && $tab_quantity13 && $tab_quantity14 && $tab_quantity15 && $tab_quantity16 && $tab_quantity17 && $tab_quantity18 && $tab_quantity19 && $tab_quantity20) {
			$tab_quantity_array = array($tab_quantity1, $tab_quantity2, $tab_quantity3, $tab_quantity4, $tab_quantity5, $tab_quantity6, $tab_quantity7, $tab_quantity8, $tab_quantity9, $tab_quantity10, $tab_quantity11, $tab_quantity12, $tab_quantity13, $tab_quantity14, $tab_quantity15, $tab_quantity16, $tab_quantity17, $tab_quantity18, $tab_quantity19, $tab_quantity20);
		} elseif ($tab_quantity1 && $tab_quantity2 && $tab_quantity3 && $tab_quantity4 && $tab_quantity5 && $tab_quantity6 && $tab_quantity7 && $tab_quantity8 && $tab_quantity9 && $tab_quantity10 && $tab_quantity11 && $tab_quantity12 && $tab_quantity13 && $tab_quantity14 && $tab_quantity15 && $tab_quantity16 && $tab_quantity17 && $tab_quantity18 && $tab_quantity19) {
			$tab_quantity_array = array($tab_quantity1, $tab_quantity2, $tab_quantity3, $tab_quantity4, $tab_quantity5, $tab_quantity6, $tab_quantity7, $tab_quantity8, $tab_quantity9, $tab_quantity10, $tab_quantity11, $tab_quantity12, $tab_quantity13, $tab_quantity14, $tab_quantity15, $tab_quantity16, $tab_quantity17, $tab_quantity18, $tab_quantity19);
		} elseif ($tab_quantity1 && $tab_quantity2 && $tab_quantity3 && $tab_quantity4 && $tab_quantity5 && $tab_quantity6 && $tab_quantity7 && $tab_quantity8 && $tab_quantity9 && $tab_quantity10 && $tab_quantity11 && $tab_quantity12 && $tab_quantity13 && $tab_quantity14 && $tab_quantity15 && $tab_quantity16 && $tab_quantity17 && $tab_quantity18) {
			$tab_quantity_array = array($tab_quantity1, $tab_quantity2, $tab_quantity3, $tab_quantity4, $tab_quantity5, $tab_quantity6, $tab_quantity7, $tab_quantity8, $tab_quantity9, $tab_quantity10, $tab_quantity11, $tab_quantity12, $tab_quantity13, $tab_quantity14, $tab_quantity15, $tab_quantity16, $tab_quantity17, $tab_quantity18);
		} elseif ($tab_quantity1 && $tab_quantity2 && $tab_quantity3 && $tab_quantity4 && $tab_quantity5 && $tab_quantity6 && $tab_quantity7 && $tab_quantity8 && $tab_quantity9 && $tab_quantity10 && $tab_quantity11 && $tab_quantity12 && $tab_quantity13 && $tab_quantity14 && $tab_quantity15 && $tab_quantity16 && $tab_quantity17) {
			$tab_quantity_array = array($tab_quantity1, $tab_quantity2, $tab_quantity3, $tab_quantity4, $tab_quantity5, $tab_quantity6, $tab_quantity7, $tab_quantity8, $tab_quantity9, $tab_quantity10, $tab_quantity11, $tab_quantity12, $tab_quantity13, $tab_quantity14, $tab_quantity15, $tab_quantity16, $tab_quantity17);
		} elseif ($tab_quantity1 && $tab_quantity2 && $tab_quantity3 && $tab_quantity4 && $tab_quantity5 && $tab_quantity6 && $tab_quantity7 && $tab_quantity8 && $tab_quantity9 && $tab_quantity10 && $tab_quantity11 && $tab_quantity12 && $tab_quantity13 && $tab_quantity14 && $tab_quantity15 && $tab_quantity16) {
			$tab_quantity_array = array($tab_quantity1, $tab_quantity2, $tab_quantity3, $tab_quantity4, $tab_quantity5, $tab_quantity6, $tab_quantity7, $tab_quantity8, $tab_quantity9, $tab_quantity10, $tab_quantity11, $tab_quantity12, $tab_quantity13, $tab_quantity14, $tab_quantity15, $tab_quantity16);
		} elseif ($tab_quantity1 && $tab_quantity2 && $tab_quantity3 && $tab_quantity4 && $tab_quantity5 && $tab_quantity6 && $tab_quantity7 && $tab_quantity8 && $tab_quantity9 && $tab_quantity10 && $tab_quantity11 && $tab_quantity12 && $tab_quantity13 && $tab_quantity14 && $tab_quantity15) {
			$tab_quantity_array = array($tab_quantity1, $tab_quantity2, $tab_quantity3, $tab_quantity4, $tab_quantity5, $tab_quantity6, $tab_quantity7, $tab_quantity8, $tab_quantity9, $tab_quantity10, $tab_quantity11, $tab_quantity12, $tab_quantity13, $tab_quantity14, $tab_quantity15);
		} elseif ($tab_quantity1 && $tab_quantity2 && $tab_quantity3 && $tab_quantity4 && $tab_quantity5 && $tab_quantity6 && $tab_quantity7 && $tab_quantity8 && $tab_quantity9 && $tab_quantity10 && $tab_quantity11 && $tab_quantity12 && $tab_quantity13 && $tab_quantity14) {
			$tab_quantity_array = array($tab_quantity1, $tab_quantity2, $tab_quantity3, $tab_quantity4, $tab_quantity5, $tab_quantity6, $tab_quantity7, $tab_quantity8, $tab_quantity9, $tab_quantity10, $tab_quantity11, $tab_quantity12, $tab_quantity13, $tab_quantity14);
		} elseif ($tab_quantity1 && $tab_quantity2 && $tab_quantity3 && $tab_quantity4 && $tab_quantity5 && $tab_quantity6 && $tab_quantity7 && $tab_quantity8 && $tab_quantity9 && $tab_quantity10 && $tab_quantity11 && $tab_quantity12 && $tab_quantity13) {
			$tab_quantity_array = array($tab_quantity1, $tab_quantity2, $tab_quantity3, $tab_quantity4, $tab_quantity5, $tab_quantity6, $tab_quantity7, $tab_quantity8, $tab_quantity9, $tab_quantity10, $tab_quantity11, $tab_quantity12, $tab_quantity13);
		} elseif ($tab_quantity1 && $tab_quantity2 && $tab_quantity3 && $tab_quantity4 && $tab_quantity5 && $tab_quantity6 && $tab_quantity7 && $tab_quantity8 && $tab_quantity9 && $tab_quantity10 && $tab_quantity11 && $tab_quantity12) {
			$tab_quantity_array = array($tab_quantity1, $tab_quantity2, $tab_quantity3, $tab_quantity4, $tab_quantity5, $tab_quantity6, $tab_quantity7, $tab_quantity8, $tab_quantity9, $tab_quantity10, $tab_quantity11, $tab_quantity12);
		} elseif ($tab_quantity1 && $tab_quantity2 && $tab_quantity3 && $tab_quantity4 && $tab_quantity5 && $tab_quantity6 && $tab_quantity7 && $tab_quantity8 && $tab_quantity9 && $tab_quantity10 && $tab_quantity11) {
			$tab_quantity_array = array($tab_quantity1, $tab_quantity2, $tab_quantity3, $tab_quantity4, $tab_quantity5, $tab_quantity6, $tab_quantity7, $tab_quantity8, $tab_quantity9, $tab_quantity10, $tab_quantity11);
		} elseif ($tab_quantity1 && $tab_quantity2 && $tab_quantity3 && $tab_quantity4 && $tab_quantity5 && $tab_quantity6 && $tab_quantity7 && $tab_quantity8 && $tab_quantity9 && $tab_quantity10) {
			$tab_quantity_array = array($tab_quantity1, $tab_quantity2, $tab_quantity3, $tab_quantity4, $tab_quantity5, $tab_quantity6, $tab_quantity7, $tab_quantity8, $tab_quantity9, $tab_quantity10);
		} elseif ($tab_quantity1 && $tab_quantity2 && $tab_quantity3 && $tab_quantity4 && $tab_quantity5 && $tab_quantity6 && $tab_quantity7 && $tab_quantity8 && $tab_quantity9) {
			$tab_quantity_array = array($tab_quantity1, $tab_quantity2, $tab_quantity3, $tab_quantity4, $tab_quantity5, $tab_quantity6, $tab_quantity7, $tab_quantity8, $tab_quantity9);
		} elseif ($tab_quantity1 && $tab_quantity2 && $tab_quantity3 && $tab_quantity4 && $tab_quantity5 && $tab_quantity6 && $tab_quantity7 && $tab_quantity8) {
			$tab_quantity_array = array($tab_quantity1, $tab_quantity2, $tab_quantity3, $tab_quantity4, $tab_quantity5, $tab_quantity6, $tab_quantity7, $tab_quantity8);
		} elseif ($tab_quantity1 && $tab_quantity2 && $tab_quantity3 && $tab_quantity4 && $tab_quantity5 && $tab_quantity6 && $tab_quantity7) {
			$tab_quantity_array = array($tab_quantity1, $tab_quantity2, $tab_quantity3, $tab_quantity4, $tab_quantity5, $tab_quantity6, $tab_quantity7);
		} elseif ($tab_quantity1 && $tab_quantity2 && $tab_quantity3 && $tab_quantity4 && $tab_quantity5 && $tab_quantity6) {
			$tab_quantity_array = array($tab_quantity1, $tab_quantity2, $tab_quantity3, $tab_quantity4, $tab_quantity5, $tab_quantity6);
		} elseif ($tab_quantity1 && $tab_quantity2 && $tab_quantity3 && $tab_quantity4 && $tab_quantity5) {
			$tab_quantity_array = array($tab_quantity1, $tab_quantity2, $tab_quantity3, $tab_quantity4, $tab_quantity5);
		} elseif ($tab_quantity1 && $tab_quantity2 && $tab_quantity3 && $tab_quantity4) {
			$tab_quantity_array = array($tab_quantity1, $tab_quantity2, $tab_quantity3, $tab_quantity4);
		} elseif ($tab_quantity1 && $tab_quantity2 && $tab_quantity3) {
			$tab_quantity_array = array($tab_quantity1, $tab_quantity2, $tab_quantity3);
		} elseif ($tab_quantity1 && $tab_quantity2) {
			$tab_quantity_array = array($tab_quantity1, $tab_quantity2);
		} elseif ($tab_quantity1) {
			$tab_quantity_array = array($tab_quantity1);
		}

		// print_r($tab_quantity_array);
		// die();

		$this->db->set('patient_auto_id', $patient_auto_id);
		$this->db->set('yearly_reg_no', $yearly_reg_no);
		$this->db->set('name', $name);
		$this->db->set('age', $age);
		$this->db->set('sex', $sex);
		$this->db->set('weight', $weight);
		$this->db->set('created_at', $date);
		$this->db->set('dignosis', $dignosis);
		$this->db->set('section', $section);
		$this->db->set('tab_name1', $tab_name1);
		$this->db->set('tab_quantity1', $tab_quantity1);
		$this->db->set('price_tab1', $price_tab1);
		$this->db->set('tab_name2', $tab_name2);
		$this->db->set('tab_quantity2', $tab_quantity2);
		$this->db->set('price_tab2', $price_tab2);
		$this->db->set('tab_name3', $tab_name3);
		$this->db->set('tab_quantity3', $tab_quantity3);
		$this->db->set('price_tab3', $price_tab3);
		$this->db->set('tab_name4', $tab_name4);
		$this->db->set('tab_quantity4', $tab_quantity4);
		$this->db->set('price_tab4', $price_tab4);
		$this->db->set('tab_name5', $tab_name5);
		$this->db->set('tab_quantity5', $tab_quantity5);
		$this->db->set('price_tab5', $price_tab5);
		$this->db->set('tab_name6', $tab_name6);
		$this->db->set('tab_quantity6', $tab_quantity6);
		$this->db->set('price_tab6', $price_tab6);
		$this->db->set('tab_name7', $tab_name7);
		$this->db->set('tab_quantity7', $tab_quantity7);
		$this->db->set('price_tab7', $price_tab7);
		$this->db->set('tab_name8', $tab_name8);
		$this->db->set('tab_quantity8', $tab_quantity8);
		$this->db->set('price_tab8', $price_tab8);
		$this->db->set('tab_name9', $tab_name9);
		$this->db->set('tab_quantity9', $tab_quantity9);
		$this->db->set('price_tab9', $price_tab9);
		$this->db->set('tab_name10', $tab_name10);
		$this->db->set('tab_quantity10', $tab_quantity10);
		$this->db->set('price_tab10', $price_tab10);
		$this->db->set('tab_name11', $tab_name11);
		$this->db->set('tab_quantity11', $tab_quantity11);
		$this->db->set('price_tab11', $price_tab11);
		$this->db->set('tab_name12', $tab_name12);
		$this->db->set('tab_quantity12', $tab_quantity12);
		$this->db->set('price_tab12', $price_tab12);
		$this->db->set('tab_name5', $tab_name5);
		$this->db->set('tab_quantity5', $tab_quantity5);
		$this->db->set('price_tab5', $price_tab5);
		$this->db->set('tab_name13', $tab_name13);
		$this->db->set('tab_quantity13', $tab_quantity13);
		$this->db->set('price_tab13', $price_tab13);
		$this->db->set('tab_name14', $tab_name14);
		$this->db->set('tab_quantity14', $tab_quantity14);
		$this->db->set('price_tab14', $price_tab14);
		$this->db->set('tab_name5', $tab_name5);
		$this->db->set('tab_quantity5', $tab_quantity5);
		$this->db->set('price_tab5', $price_tab5);
		$this->db->set('tab_name15', $tab_name15);
		$this->db->set('tab_quantity15', $tab_quantity15);
		$this->db->set('price_tab15', $price_tab15);
		$this->db->set('tab_name5', $tab_name5);
		$this->db->set('tab_quantity5', $tab_quantity5);
		$this->db->set('price_tab5', $price_tab5);
		$this->db->set('tab_name16', $tab_name16);
		$this->db->set('tab_quantity16', $tab_quantity16);
		$this->db->set('price_tab16', $price_tab16);
		$this->db->set('tab_name17', $tab_name17);
		$this->db->set('tab_quantity17', $tab_quantity17);
		$this->db->set('price_tab17', $price_tab17);
		$this->db->set('tab_name18', $tab_name18);
		$this->db->set('tab_quantity18', $tab_quantity18);
		$this->db->set('price_tab18', $price_tab18);
		$this->db->set('tab_name19', $tab_name19);
		$this->db->set('tab_quantity19', $tab_quantity19);
		$this->db->set('price_tab19', $price_tab19);
		$this->db->set('tab_name20', $tab_name20);
		$this->db->set('tab_quantity20', $tab_quantity20);
		$this->db->set('price_tab20', $price_tab20);
		$this->db->set('tab_name21', $tab_name21);
		$this->db->set('tab_quantity21', $tab_quantity21);
		$this->db->set('price_tab21', $price_tab21);
		$this->db->set('tab_name22', $tab_name22);
		$this->db->set('tab_quantity22', $tab_quantity22);
		$this->db->set('price_tab22', $price_tab22);
		$this->db->set('tab_name23', $tab_name23);
		$this->db->set('tab_quantity23', $tab_quantity23);
		$this->db->set('price_tab23', $price_tab23);
		$this->db->set('tab_name24', $tab_name24);
		$this->db->set('tab_quantity24', $tab_quantity24);
		$this->db->set('price_tab24', $price_tab24);
		$this->db->set('tab_name25', $tab_name25);
		$this->db->set('tab_quantity25', $tab_quantity25);
		$this->db->set('price_tab25', $price_tab25);
		$updateRes = $this->db->insert('pharma_original_patient');


		if ($tab_name1 && $tab_name2 && $tab_name3 && $tab_name4 && $tab_name5 && $tab_name6 && $tab_name7 && $tab_name8 && $tab_name9 && $tab_name10 && $tab_name11 && $tab_name12 && $tab_name13 && $tab_name14 && $tab_name15 && $tab_name16 && $tab_name17 && $tab_name18 && $tab_name19 && $tab_name20 && $tab_name21 && $tab_name22 && $tab_name23 && $tab_name24 && $tab_name25) {
			$tab_name_array = array($tab_name1, $tab_name2, $tab_name3, $tab_name4, $tab_name5, $tab_name6, $tab_name7, $tab_name8, $tab_name9, $tab_name10, $tab_name11, $tab_name12, $tab_name13, $tab_name14, $tab_name15, $tab_name16, $tab_name17, $tab_name18, $tab_name19, $tab_name20, $tab_name21, $tab_name22, $tab_name23, $tab_name24, $tab_name25);
		} elseif ($tab_name1 && $tab_name2 && $tab_name3 && $tab_name4 && $tab_name5 && $tab_name6 && $tab_name7 && $tab_name8 && $tab_name9 && $tab_name10 && $tab_name11 && $tab_name12 && $tab_name13 && $tab_name14 && $tab_name15 && $tab_name16 && $tab_name17 && $tab_name18 && $tab_name19 && $tab_name20 && $tab_name21 && $tab_name22 && $tab_name23 && $tab_name24) {
			$tab_name_array = array($tab_name1, $tab_name2, $tab_name3, $tab_name4, $tab_name5, $tab_name6, $tab_name7, $tab_name8, $tab_name9, $tab_name10, $tab_name11, $tab_name12, $tab_name13, $tab_name14, $tab_name15, $tab_name16, $tab_name17, $tab_name18, $tab_name19, $tab_name20, $tab_name21, $tab_name22, $tab_name23, $tab_name24);
		} elseif ($tab_name1 && $tab_name2 && $tab_name3 && $tab_name4 && $tab_name5 && $tab_name6 && $tab_name7 && $tab_name8 && $tab_name9 && $tab_name10 && $tab_name11 && $tab_name12 && $tab_name13 && $tab_name14 && $tab_name15 && $tab_name16 && $tab_name17 && $tab_name18 && $tab_name19 && $tab_name20 && $tab_name21 && $tab_name22 && $tab_name23) {
			$tab_name_array = array($tab_name1, $tab_name2, $tab_name3, $tab_name4, $tab_name5, $tab_name6, $tab_name7, $tab_name8, $tab_name9, $tab_name10, $tab_name11, $tab_name12, $tab_name13, $tab_name14, $tab_name15, $tab_name16, $tab_name17, $tab_name18, $tab_name19, $tab_name20, $tab_name21, $tab_name22, $tab_name23);
		} elseif ($tab_name1 && $tab_name2 && $tab_name3 && $tab_name4 && $tab_name5 && $tab_name6 && $tab_name7 && $tab_name8 && $tab_name9 && $tab_name10 && $tab_name11 && $tab_name12 && $tab_name13 && $tab_name14 && $tab_name15 && $tab_name16 && $tab_name17 && $tab_name18 && $tab_name19 && $tab_name20 && $tab_name21 && $tab_name22) {
			$tab_name_array = array($tab_name1, $tab_name2, $tab_name3, $tab_name4, $tab_name5, $tab_name6, $tab_name7, $tab_name8, $tab_name9, $tab_name10, $tab_name11, $tab_name12, $tab_name13, $tab_name14, $tab_name15, $tab_name16, $tab_name17, $tab_name18, $tab_name19, $tab_name20, $tab_name21, $tab_name22);
		} elseif ($tab_name1 && $tab_name2 && $tab_name3 && $tab_name4 && $tab_name5 && $tab_name6 && $tab_name7 && $tab_name8 && $tab_name9 && $tab_name10 && $tab_name11 && $tab_name12 && $tab_name13 && $tab_name14 && $tab_name15 && $tab_name16 && $tab_name17 && $tab_name18 && $tab_name19 && $tab_name20 && $tab_name21) {
			$tab_name_array = array($tab_name1, $tab_name2, $tab_name3, $tab_name4, $tab_name5, $tab_name6, $tab_name7, $tab_name8, $tab_name9, $tab_name10, $tab_name11, $tab_name12, $tab_name13, $tab_name14, $tab_name15, $tab_name16, $tab_name17, $tab_name18, $tab_name19, $tab_name20, $tab_name21);
		} elseif ($tab_name1 && $tab_name2 && $tab_name3 && $tab_name4 && $tab_name5 && $tab_name6 && $tab_name7 && $tab_name8 && $tab_name9 && $tab_name10 && $tab_name11 && $tab_name12 && $tab_name13 && $tab_name14 && $tab_name15 && $tab_name16 && $tab_name17 && $tab_name18 && $tab_name19 && $tab_name20) {
			$tab_name_array = array($tab_name1, $tab_name2, $tab_name3, $tab_name4, $tab_name5, $tab_name6, $tab_name7, $tab_name8, $tab_name9, $tab_name10, $tab_name11, $tab_name12, $tab_name13, $tab_name14, $tab_name15, $tab_name16, $tab_name17, $tab_name18, $tab_name19, $tab_name20);
		} elseif ($tab_name1 && $tab_name2 && $tab_name3 && $tab_name4 && $tab_name5 && $tab_name6 && $tab_name7 && $tab_name8 && $tab_name9 && $tab_name10 && $tab_name11 && $tab_name12 && $tab_name13 && $tab_name14 && $tab_name15 && $tab_name16 && $tab_name17 && $tab_name18 && $tab_name19) {
			$tab_name_array = array($tab_name1, $tab_name2, $tab_name3, $tab_name4, $tab_name5, $tab_name6, $tab_name7, $tab_name8, $tab_name9, $tab_name10, $tab_name11, $tab_name12, $tab_name13, $tab_name14, $tab_name15, $tab_name16, $tab_name17, $tab_name18, $tab_name19);
		}
		if ($tab_name1 && $tab_name2 && $tab_name3 && $tab_name4 && $tab_name5 && $tab_name6 && $tab_name7 && $tab_name8 && $tab_name9 && $tab_name10 && $tab_name11 && $tab_name12 && $tab_name13 && $tab_name14 && $tab_name15 && $tab_name16 && $tab_name17 && $tab_name18) {
			$tab_name_array = array($tab_name1, $tab_name2, $tab_name3, $tab_name4, $tab_name5, $tab_name6, $tab_name7, $tab_name8, $tab_name9, $tab_name10, $tab_name11, $tab_name12, $tab_name13, $tab_name14, $tab_name15, $tab_name16, $tab_name17, $tab_name18);
		} elseif ($tab_name1 && $tab_name2 && $tab_name3 && $tab_name4 && $tab_name5 && $tab_name6 && $tab_name7 && $tab_name8 && $tab_name9 && $tab_name10 && $tab_name11 && $tab_name12 && $tab_name13 && $tab_name14 && $tab_name15 && $tab_name16 && $tab_name17) {
			$tab_name_array = array($tab_name1, $tab_name2, $tab_name3, $tab_name4, $tab_name5, $tab_name6, $tab_name7, $tab_name8, $tab_name9, $tab_name10, $tab_name11, $tab_name12, $tab_name13, $tab_name14, $tab_name15, $tab_name16, $tab_name17);
		} elseif ($tab_name1 && $tab_name2 && $tab_name3 && $tab_name4 && $tab_name5 && $tab_name6 && $tab_name7 && $tab_name8 && $tab_name9 && $tab_name10 && $tab_name11 && $tab_name12 && $tab_name13 && $tab_name14 && $tab_name15 && $tab_name16) {
			$tab_name_array = array($tab_name1, $tab_name2, $tab_name3, $tab_name4, $tab_name5, $tab_name6, $tab_name7, $tab_name8, $tab_name9, $tab_name10, $tab_name11, $tab_name12, $tab_name13, $tab_name14, $tab_name15, $tab_name16);
		} elseif ($tab_name1 && $tab_name2 && $tab_name3 && $tab_name4 && $tab_name5 && $tab_name6 && $tab_name7 && $tab_name8 && $tab_name9 && $tab_name10 && $tab_name11 && $tab_name12 && $tab_name13 && $tab_name14 && $tab_name15) {
			$tab_name_array = array($tab_name1, $tab_name2, $tab_name3, $tab_name4, $tab_name5, $tab_name6, $tab_name7, $tab_name8, $tab_name9, $tab_name10, $tab_name11, $tab_name12, $tab_name13, $tab_name14, $tab_name15);
		} elseif ($tab_name1 && $tab_name2 && $tab_name3 && $tab_name4 && $tab_name5 && $tab_name6 && $tab_name7 && $tab_name8 && $tab_name9 && $tab_name10 && $tab_name11 && $tab_name12 && $tab_name13 && $tab_name14) {
			$tab_name_array = array($tab_name1, $tab_name2, $tab_name3, $tab_name4, $tab_name5, $tab_name6, $tab_name7, $tab_name8, $tab_name9, $tab_name10, $tab_name11, $tab_name12, $tab_name13, $tab_name14);
		} elseif ($tab_name1 && $tab_name2 && $tab_name3 && $tab_name4 && $tab_name5 && $tab_name6 && $tab_name7 && $tab_name8 && $tab_name9 && $tab_name10 && $tab_name11 && $tab_name12 && $tab_name13) {
			$tab_name_array = array($tab_name1, $tab_name2, $tab_name3, $tab_name4, $tab_name5, $tab_name6, $tab_name7, $tab_name8, $tab_name9, $tab_name10, $tab_name11, $tab_name12, $tab_name13);
		} elseif ($tab_name1 && $tab_name2 && $tab_name3 && $tab_name4 && $tab_name5 && $tab_name6 && $tab_name7 && $tab_name8 && $tab_name9 && $tab_name10 && $tab_name11 && $tab_name12) {
			$tab_name_array = array($tab_name1, $tab_name2, $tab_name3, $tab_name4, $tab_name5, $tab_name6, $tab_name7, $tab_name8, $tab_name9, $tab_name10, $tab_name11, $tab_name12);
		} elseif ($tab_name1 && $tab_name2 && $tab_name3 && $tab_name4 && $tab_name5 && $tab_name6 && $tab_name7 && $tab_name8 && $tab_name9 && $tab_name10 && $tab_name11) {
			$tab_name_array = array($tab_name1, $tab_name2, $tab_name3, $tab_name4, $tab_name5, $tab_name6, $tab_name7, $tab_name8, $tab_name9, $tab_name10, $tab_name11);
		} elseif ($tab_name1 && $tab_name2 && $tab_name3 && $tab_name4 && $tab_name5 && $tab_name6 && $tab_name7 && $tab_name8 && $tab_name9 && $tab_name10) {
			$tab_name_array = array($tab_name1, $tab_name2, $tab_name3, $tab_name4, $tab_name5, $tab_name6, $tab_name7, $tab_name8, $tab_name9, $tab_name10);
		} elseif ($tab_name1 && $tab_name2 && $tab_name3 && $tab_name4 && $tab_name5 && $tab_name6 && $tab_name7 && $tab_name8 && $tab_name9) {
			$tab_name_array = array($tab_name1, $tab_name2, $tab_name3, $tab_name4, $tab_name5, $tab_name6, $tab_name7, $tab_name8, $tab_name9);
		} elseif ($tab_name1 && $tab_name2 && $tab_name3 && $tab_name4 && $tab_name5 && $tab_name6 && $tab_name7 && $tab_name8) {
			$tab_name_array = array($tab_name1, $tab_name2, $tab_name3, $tab_name4, $tab_name5, $tab_name6, $tab_name7, $tab_name8);
		} elseif ($tab_name1 && $tab_name2 && $tab_name3 && $tab_name4 && $tab_name5 && $tab_name6 && $tab_name7) {
			$tab_name_array = array($tab_name1, $tab_name2, $tab_name3, $tab_name4, $tab_name5, $tab_name6, $tab_name7);
		} elseif ($tab_name1 && $tab_name2 && $tab_name3 && $tab_name4 && $tab_name5 && $tab_name6) {
			$tab_name_array = array($tab_name1, $tab_name2, $tab_name3, $tab_name4, $tab_name5, $tab_name6);
		} elseif ($tab_name1 && $tab_name2 && $tab_name3 && $tab_name4 && $tab_name5) {
			$tab_name_array = array($tab_name1, $tab_name2, $tab_name3, $tab_name4, $tab_name5);
		} elseif ($tab_name1 && $tab_name2 && $tab_name3 && $tab_name4) {
			$tab_name_array = array($tab_name1, $tab_name2, $tab_name3, $tab_name4);
		} elseif ($tab_name1 && $tab_name2 && $tab_name3) {
			$tab_name_array = array($tab_name1, $tab_name2, $tab_name3);
		} elseif ($tab_name1 && $tab_name2) {
			$tab_name_array = array($tab_name1, $tab_name2);
		} elseif ($tab_name1) {
			$tab_name_array = array($tab_name1);
		}



		for ($i = 0; $i < count($tab_name_array); $i++) {
			$opening_closing = $this->db->select('id,opening_stock,closing_stock')
				->from('pharma_original_stock')
				->where('id', $tab_name_array[$i])
				->get()
				->result();

			//if(closing-stock)

			$id = $opening_closing['0']->id;
			$opening = $opening_closing['0']->opening_stock;
			$closing = $opening_closing['0']->closing_stock;



			if ($closing == '0') {
				$opening_stock = $opening;
			} else {
				$opening_stock = $closing;
			}

			$closing_stock = $opening_stock - $tab_quantity_array[$i];

			$daily_closing = $closing_stock;

			$daily_opening = $opening_stock;

			$a = $this->db->select('*')
				->from('daily_pharma_patient_stock')
				->where('id', $tab_name_array[$i])
				->where('cretate_date', $date)
				->get()
				->row();
			if ($a) {
				$daily_closing_bal = $a->daily_closing_bal;
				$daily_despensing_bal = $a->daily_despensing_bal;
				$despensing_bal = $daily_despensing_bal + $tab_quantity_array[$i];
				$closing_bal = $daily_closing_bal - $tab_quantity_array[$i];

				$this->db->set('daily_despensing_bal', $despensing_bal);
				$this->db->set('daily_closing_bal', $closing_bal);
				$update = $this->db->where('id', $tab_name_array[$i])->where('id', $a->id)->where('cretate_date', $date)->update('daily_pharma_patient_stock');
				//print_r($this->db->last_query());
				//$update =  $this->patient_model->save_pharma_patient_bal($opening_closing_daily_update);

			} else {
				$opening_closing_daily = array
				(
					'tab_name' => $tab_name_array[$i],
					'daily_opening_bal' => $daily_opening,
					'daily_despensing_bal' => $tab_quantity_array[$i],
					'daily_closing_bal' => $daily_closing,
					'cretate_date' => $date,
				);
				$update = $this->patient_model->save_pharma_patient_bal($opening_closing_daily);
			}

			if ($daily_closing == '0') {
				$stock_end_flag = 1;
			} else {
				$stock_end_flag = 0;
			}
			$closing_daily = array
			(
				'closing_stock' => $daily_closing,
				'stock_end_flag' => $stock_end_flag
			);

			$this->db->where('id', $tab_name_array[$i]);
			$this->db->where('id', $id);
			$this->db->update('pharma_original_stock', $closing_daily);

		}

		//die();
		if ($updateRes) {
			$this->session->set_flashdata('message', display('save_successfully'));
			redirect('patients/get_pharma_patient');
		} else {
			$this->session->set_flashdata('exception', display('Something Wents Wrong!'));
			redirect('patients/get_pharma_patient');
		}
		//   }
	}
	public function pharma_patient_count_list()
	{
		$section = $this->input->get('section');
		$date = date('Y-m-d', strtotime($this->input->get('start_date')));
		$data['pharma_patient'] = $this->db->select('*')
			->from('pharma_original_patient')
			->where('created_at >=', date('Y-m-d', strtotime($this->input->get('start_date'))))
			->where('created_at <=', date('Y-m-d', strtotime($this->input->get('start_date'))))
			->where('section', $section)
			->get()
			->result();
		$data['section'] = $section;
		$data['start_date'] = $date;
		//print_r($this->db->last_query());
		$data['content'] = $this->load->view('pharma_patient_count_list', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}


	public function add_pharma_tab()
	{
		//$data['pharma_tab'] = $this->patient_model->get_tablet();
		$data['pharma_tab'] = $this->patient_model->get_tablet_pharma();
		//print_r($this->db->last_query());
		$data['content'] = $this->load->view('add_pharma_tab', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}
	public function save_pharma_tab()
	{
		$data['title'] = display('add_pharma_tab_result');



		$tab_name = $this->input->post('tab_name', true);
		$type_of_medicine = $this->input->post('type_of_medicine', true);
		$quantity_in = $this->input->post('quantity_in', true);

		if ($type_of_medicine == 'churn') {
			$type = '1';
		} elseif ($type_of_medicine == 'tablet') {
			$type = '2';
		} elseif ($type_of_medicine == 'syrup') {
			$type = '3';
		} elseif ($type_of_medicine == 'oil') {
			$type = '4';
		} elseif ($type_of_medicine == 'inj') {
			$type = '5';
		} else {
			$type = '6';
		}

		$this->db->set('tab_name', $tab_name);
		$this->db->set('type_of_medicine', $type_of_medicine);
		$this->db->set('quantity_in', $quantity_in);
		$this->db->set('type', $type);

		$updateRes = $this->db->insert('pharma_original_tab');
		if ($updateRes) {
			$this->session->set_flashdata('message', display('save_successfully'));
			redirect('patients/add_pharma_tab');
		} else {
			$this->session->set_flashdata('exception', display('Something Wents Wrong!'));
			// redirect('patients/physiotheropy_add');
		}
	}



	public function fetch_patient()
	{
		$patient = $this->patient_model->fetch_patient();
		if ($patient) {
			$data['status'] = true;
			$data['patient_name'] = $patient;
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}

	public function fetch_treatment()
	{
		$section = $this->input->post('section');
		$patient = $this->patient_model->fetch_treatment();
		// print_r($patient);
		if ($patient) {
			$data['status'] = true;
			// $data['dignosis'] = $patient->dignosis;
			// $data['section'] = $patient->ipd_opd;


			if ($section == 'ipd') {
				$che = trim($patient->dignosis);
				$section_tret = 'ipd';
				$len = strlen($che);
				$dd = substr($che, $len - 1);
				$str = $patient->dignosis;
				$arry = explode("-", $str);
				$t_c = count($arry);
				if ($t_c == '2') {
					$dd1 = substr($che, 0, -1);
					$new_str = trim($arry[0]);
					$p_dignosis = '%' . $new_str . '%';
					$p_dignosis_name = $patient->dignosis;
				} else {
					$p_dignosis = '%' . $che . '%';
					$p_dignosis_name = $patient->dignosis;
				}
			} else {
				$section_tret = 'opd';
				$che = trim($patient->dignosis);
				$section_tret = 'opd';
				$len = strlen($che);
				$dd = substr($che, $len - 1);
				$str = $patient->dignosis;
				$arry = explode("-", $str);
				$t_c = count($arry);
				if ($t_c == '2') {
					$dd1 = substr($che, 0, -1);
					$new_str = trim($arry[0]);
					$p_dignosis = '%' . $new_str . '%';
					$p_dignosis_name = $patient->dignosis;
				} else {
					$p_dignosis = '%' . $che . '%';
					$p_dignosis_name = $patient->dignosis;
				}
			}

			if ($patient->manual_status == 0) {
				if ($patient->proxy_id) {
					$tretment = $this->db->select("*")
						->from('treatments1')
						->where('dignosis LIKE', $p_dignosis)
						->where('proxy_id', $patient->proxy_id)
						->where('department_id', $patient->department_id)
						->where('ipd_opd ', $section_tret)
						->get()
						->row();

				} else {
					$tretment = $this->db->select("*")
						->from('treatments1')
						->where('dignosis LIKE', $p_dignosis)
						->where('department_id', $patient->department_id)
						->where('ipd_opd ', $section_tret)
						->get()
						->row();

				}
			} else {
				$tretment = $this->db->select("*")
					->from('manual_treatments')
					->where('patient_id_auto', $patient->id)
					->where('dignosis LIKE', $p_dignosis)
					->where('ipd_opd ', $section_tret)
					->get()
					->row();
				// print_r($this->db->last_query());
			}
			if ($patient->manual_status == '1' || $patient->created_by == '1' || $patient->created_by == '2') {
				$tretment = $this->db->select("*")
					->from('manual_treatments')
					->where('patient_id_auto', $patient->id)
					->where('dignosis LIKE', $p_dignosis)
					->where('ipd_opd ', $section_tret)
					->get()
					->row();
			}

			$data['RX1_tab'] = $tretment->RX1;
			$data['RX2_tab'] = $tretment->RX2;
			$data['RX3_tab'] = $tretment->RX3;
			$data['RX4_tab'] = $tretment->RX4;
			$data['RX5_tab'] = $tretment->RX5;
			$data['patients'] = $patient;
			if ($patient->manual_status == 1) {
				$data['RX_other_tab'] = $tretment->RX_other;
				$data['RX_other1_tab'] = $tretment->RX_other1;
				$data['other_equipment_tab'] = $tretment->other_equipment;
			}
			$data['name'] = $patient->firstname;
			$data['yearly_reg_no'] = $patient->yearly_reg_no;
			$data['old_reg_no'] = $patient->old_reg_no;
			$data['id'] = $patient->id;
			$data['dignosis'] = $patient->dignosis;
			$data['ipd_opd'] = $patient->ipd_opd;
			$data['firstname'] = $patient->firstname;
			$data['date_of_birth'] = $patient->date_of_birth;
			$data['sex'] = $patient->sex;
			$data['address'] = $patient->address;
			$data['weight'] = $patient->wieght;
			$data['create_date'] = date("Y-m-d", strtotime($patient->create_date));
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}

	public function fetch_closing_tab1()
	{
		$tab1 = $this->patient_model->fetch_closing_tab1();
		if ($tab1) {
			$data['status'] = true;
			$closing = $tab1->closing_stock;
			$stock_end_flag = $tab1->stock_end_flag;
			if ($stock_end_flag == '1' && $closing = '0') {
				$data['closing_stock'] = $tab1->closing_stock;
			} else {
				if ($closing = '0') {
					$data['closing_stock'] = $tab1->opening_stock;
				} else {
					$data['closing_stock'] = $tab1->closing_stock;
				}
			}
			$data['batch_number'] = $tab1->batch_number;
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_closing_tab2()
	{
		$tab2 = $this->patient_model->fetch_closing_tab2();
		if ($tab2) {
			$data['status'] = true;
			$closing = $tab2->closing_stock;
			$stock_end_flag = $tab2->stock_end_flag;
			if ($stock_end_flag == '1' && $closing = '0') {
				$data['closing_stock'] = $tab2->closing_stock;
			} else {
				if ($closing = '0') {
					$data['closing_stock'] = $tab2->opening_stock;
				} else {
					$data['closing_stock'] = $tab2->closing_stock;
				}
			}
			$data['batch_number'] = $tab2->batch_number;
			//$data['patient_name'] = $tab1; 
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_closing_tab3()
	{
		$tab3 = $this->patient_model->fetch_closing_tab3();
		if ($tab3) {
			$data['status'] = true;
			$closing = $tab3->closing_stock;
			$stock_end_flag = $tab3->stock_end_flag;
			if ($stock_end_flag == '1' && $closing = '0') {
				$data['closing_stock'] = $tab3->closing_stock;
			} else {
				if ($closing = '0') {
					$data['closing_stock'] = $tab3->opening_stock;
				} else {
					$data['closing_stock'] = $tab3->closing_stock;
				}
			}
			$data['batch_number'] = $tab3->batch_number;
			//$data['patient_name'] = $tab1; 
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_closing_tab4()
	{
		$tab4 = $this->patient_model->fetch_closing_tab4();
		if ($tab4) {
			$data['status'] = true;
			$closing = $tab4->closing_stock;
			$stock_end_flag = $tab4->stock_end_flag;
			if ($stock_end_flag == '1' && $closing = '0') {
				$data['closing_stock'] = $tab4->closing_stock;
			} else {
				if ($closing = '0') {
					$data['closing_stock'] = $tab4->opening_stock;
				} else {
					$data['closing_stock'] = $tab4->closing_stock;
				}
			}
			$data['batch_number'] = $tab4->batch_number;
			//$data['patient_name'] = $tab1; 
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_closing_tab5()
	{
		$tab5 = $this->patient_model->fetch_closing_tab5();
		if ($tab5) {
			$data['status'] = true;
			$closing = $tab5->closing_stock;
			$stock_end_flag = $tab5->stock_end_flag;
			if ($stock_end_flag == '1' && $closing = '0') {
				$data['closing_stock'] = $tab5->closing_stock;
			} else {
				if ($closing = '0') {
					$data['closing_stock'] = $tab5->opening_stock;
				} else {
					$data['closing_stock'] = $tab5->closing_stock;
				}
			}
			$data['batch_number'] = $tab5->batch_number;
			//$data['patient_name'] = $tab1; 
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}

	public function fetch_closing_tab6()
	{
		$tab6 = $this->patient_model->fetch_closing_tab6();
		if ($tab6) {
			$data['status'] = true;
			$closing = $tab6->closing_stock;
			$stock_end_flag = $tab6->stock_end_flag;
			if ($stock_end_flag == '1' && $closing = '0') {
				$data['closing_stock'] = $tab6->closing_stock;
			} else {
				if ($closing = '0') {
					$data['closing_stock'] = $tab6->opening_stock;
				} else {
					$data['closing_stock'] = $tab6->closing_stock;
				}
			}
			$data['batch_number'] = $tab6->batch_number;
			//$data['patient_name'] = $tab1; 
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_closing_tab7()
	{
		$tab7 = $this->patient_model->fetch_closing_tab7();
		if ($tab7) {
			$data['status'] = true;
			$closing = $tab7->closing_stock;
			$stock_end_flag = $tab7->stock_end_flag;
			if ($stock_end_flag == '1' && $closing = '0') {
				$data['closing_stock'] = $tab7->closing_stock;
			} else {
				if ($closing = '0') {
					$data['closing_stock'] = $tab7->opening_stock;
				} else {
					$data['closing_stock'] = $tab7->closing_stock;
				}
			}
			$data['batch_number'] = $tab7->batch_number;
			//$data['patient_name'] = $tab1; 
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_closing_tab8()
	{
		$tab8 = $this->patient_model->fetch_closing_tab8();
		if ($tab8) {
			$data['status'] = true;
			$closing = $tab8->closing_stock;
			$stock_end_flag = $tab8->stock_end_flag;
			if ($stock_end_flag == '1' && $closing = '0') {
				$data['closing_stock'] = $tab8->closing_stock;
			} else {
				if ($closing = '0') {
					$data['closing_stock'] = $tab8->opening_stock;
				} else {
					$data['closing_stock'] = $tab8->closing_stock;
				}
			}
			$data['batch_number'] = $tab8->batch_number;
			//$data['patient_name'] = $tab1; 
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_closing_tab9()
	{
		$tab9 = $this->patient_model->fetch_closing_tab9();
		if ($tab9) {
			$data['status'] = true;
			$closing = $tab9->closing_stock;
			$stock_end_flag = $tab9->stock_end_flag;
			if ($stock_end_flag == '1' && $closing = '0') {
				$data['closing_stock'] = $tab9->closing_stock;
			} else {
				if ($closing = '0') {
					$data['closing_stock'] = $tab9->opening_stock;
				} else {
					$data['closing_stock'] = $tab9->closing_stock;
				}
			}
			$data['batch_number'] = $tab9->batch_number;
			//$data['patient_name'] = $tab1; 
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_closing_tab10()
	{
		$tab10 = $this->patient_model->fetch_closing_tab10();
		if ($tab10) {
			$data['status'] = true;
			$closing = $tab10->closing_stock;
			$stock_end_flag = $tab10->stock_end_flag;
			if ($stock_end_flag == '1' && $closing = '0') {
				$data['closing_stock'] = $tab10->closing_stock;
			} else {
				if ($closing = '0') {
					$data['closing_stock'] = $tab10->opening_stock;
				} else {
					$data['closing_stock'] = $tab10->closing_stock;
				}
			}
			$data['batch_number'] = $tab10->batch_number;
			//$data['patient_name'] = $tab1; 
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_closing_tab11()
	{
		$tab11 = $this->patient_model->fetch_closing_tab11();
		if ($tab11) {
			$data['status'] = true;
			$closing = $tab11->closing_stock;
			$stock_end_flag = $tab11->stock_end_flag;
			if ($stock_end_flag == '1' && $closing = '0') {
				$data['closing_stock'] = $tab11->closing_stock;
			} else {
				if ($closing = '0') {
					$data['closing_stock'] = $tab11->opening_stock;
				} else {
					$data['closing_stock'] = $tab11->closing_stock;
				}
			}
			$data['batch_number'] = $tab11->batch_number;
			//$data['patient_name'] = $tab1; 
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_closing_tab12()
	{
		$tab12 = $this->patient_model->fetch_closing_tab12();
		if ($tab12) {
			$data['status'] = true;
			$closing = $tab12->closing_stock;
			$stock_end_flag = $tab12->stock_end_flag;
			if ($stock_end_flag == '1' && $closing = '0') {
				$data['closing_stock'] = $tab12->closing_stock;
			} else {
				if ($closing = '0') {
					$data['closing_stock'] = $tab12->opening_stock;
				} else {
					$data['closing_stock'] = $tab12->closing_stock;
				}
			}
			$data['batch_number'] = $tab12->batch_number;
			//$data['patient_name'] = $tab1; 
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_closing_tab13()
	{
		$tab13 = $this->patient_model->fetch_closing_tab13();
		if ($tab13) {
			$data['status'] = true;
			$closing = $tab13->closing_stock;
			$stock_end_flag = $tab13->stock_end_flag;
			if ($stock_end_flag == '1' && $closing = '0') {
				$data['closing_stock'] = $tab13->closing_stock;
			} else {
				if ($closing = '0') {
					$data['closing_stock'] = $tab13->opening_stock;
				} else {
					$data['closing_stock'] = $tab13->closing_stock;
				}
			}
			$data['batch_number'] = $tab13->batch_number;
			//$data['patient_name'] = $tab1; 
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_closing_tab14()
	{
		$tab14 = $this->patient_model->fetch_closing_tab14();
		if ($tab14) {
			$data['status'] = true;
			$closing = $tab14->closing_stock;
			$stock_end_flag = $tab14->stock_end_flag;
			if ($stock_end_flag == '1' && $closing = '0') {
				$data['closing_stock'] = $tab14->closing_stock;
			} else {
				if ($closing = '0') {
					$data['closing_stock'] = $tab14->opening_stock;
				} else {
					$data['closing_stock'] = $tab14->closing_stock;
				}
			}
			$data['batch_number'] = $tab14->batch_number;
			//$data['patient_name'] = $tab1; 
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_closing_tab15()
	{
		$tab15 = $this->patient_model->fetch_closing_tab15();
		if ($tab15) {
			$data['status'] = true;
			$closing = $tab15->closing_stock;
			$stock_end_flag = $tab15->stock_end_flag;
			if ($stock_end_flag == '1' && $closing = '0') {
				$data['closing_stock'] = $tab15->closing_stock;
			} else {
				if ($closing = '0') {
					$data['closing_stock'] = $tab15->opening_stock;
				} else {
					$data['closing_stock'] = $tab15->closing_stock;
				}
			}
			$data['batch_number'] = $tab15->batch_number;
			//$data['patient_name'] = $tab1; 
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_closing_tab16()
	{
		$tab16 = $this->patient_model->fetch_closing_tab16();
		if ($tab16) {
			$data['status'] = true;
			$closing = $tab16->closing_stock;
			$stock_end_flag = $tab16->stock_end_flag;
			if ($stock_end_flag == '1' && $closing = '0') {
				$data['closing_stock'] = $tab16->closing_stock;
			} else {
				if ($closing = '0') {
					$data['closing_stock'] = $tab16->opening_stock;
				} else {
					$data['closing_stock'] = $tab16->closing_stock;
				}
			}
			$data['batch_number'] = $tab16->batch_number;
			//$data['patient_name'] = $tab1; 
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_closing_tab17()
	{
		$tab17 = $this->patient_model->fetch_closing_tab17();
		if ($tab17) {
			$data['status'] = true;
			$closing = $tab17->closing_stock;
			$stock_end_flag = $tab17->stock_end_flag;
			if ($stock_end_flag == '1' && $closing = '0') {
				$data['closing_stock'] = $tab17->closing_stock;
			} else {
				if ($closing = '0') {
					$data['closing_stock'] = $tab17->opening_stock;
				} else {
					$data['closing_stock'] = $tab17->closing_stock;
				}
			}
			$data['batch_number'] = $tab17->batch_number;
			//$data['patient_name'] = $tab1; 
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_closing_tab18()
	{
		$tab18 = $this->patient_model->fetch_closing_tab18();
		if ($tab18) {
			$data['status'] = true;
			$closing = $tab18->closing_stock;
			if ($closing == '0') {
				$data['closing_stock'] = $tab18->opening_stock;
			} else {
				$data['closing_stock'] = $tab18->closing_stock;
			}
			$data['batch_number'] = $tab18->batch_number;
			//$data['patient_name'] = $tab1; 
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_closing_tab19()
	{
		$tab19 = $this->patient_model->fetch_closing_tab19();
		if ($tab19) {
			$data['status'] = true;
			$closing = $tab19->closing_stock;
			$stock_end_flag = $tab19->stock_end_flag;
			if ($stock_end_flag == '1' && $closing = '0') {
				$data['closing_stock'] = $tab19->closing_stock;
			} else {
				if ($closing = '0') {
					$data['closing_stock'] = $tab19->opening_stock;
				} else {
					$data['closing_stock'] = $tab19->closing_stock;
				}
			}
			$data['batch_number'] = $tab19->batch_number;
			//$data['patient_name'] = $tab1; 
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_closing_tab20()
	{
		$tab20 = $this->patient_model->fetch_closing_tab20();
		if ($tab20) {
			$data['status'] = true;
			$closing = $tab20->closing_stock;
			$stock_end_flag = $tab20->stock_end_flag;
			if ($stock_end_flag == '1' && $closing = '0') {
				$data['closing_stock'] = $tab20->closing_stock;
			} else {
				if ($closing = '0') {
					$data['closing_stock'] = $tab20->opening_stock;
				} else {
					$data['closing_stock'] = $tab20->closing_stock;
				}
			}
			$data['batch_number'] = $tab20->batch_number;
			//$data['patient_name'] = $tab1; 
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_closing_tab21()
	{
		$tab21 = $this->patient_model->fetch_closing_tab21();
		if ($tab21) {
			$data['status'] = true;
			$closing = $tab21->closing_stock;
			$stock_end_flag = $tab21->stock_end_flag;
			if ($stock_end_flag == '1' && $closing = '0') {
				$data['closing_stock'] = $tab21->closing_stock;
			} else {
				if ($closing = '0') {
					$data['closing_stock'] = $tab21->opening_stock;
				} else {
					$data['closing_stock'] = $tab21->closing_stock;
				}
			}
			$data['batch_number'] = $tab21->batch_number;
			//$data['patient_name'] = $tab1; 
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_closing_tab22()
	{
		$tab22 = $this->patient_model->fetch_closing_tab22();
		if ($tab22) {
			$data['status'] = true;
			$closing = $tab22->closing_stock;
			$stock_end_flag = $tab22->stock_end_flag;
			if ($stock_end_flag == '1' && $closing = '0') {
				$data['closing_stock'] = $tab22->closing_stock;
			} else {
				if ($closing = '0') {
					$data['closing_stock'] = $tab22->opening_stock;
				} else {
					$data['closing_stock'] = $tab22->closing_stock;
				}
			}
			$data['batch_number'] = $tab22->batch_number;
			//$data['patient_name'] = $tab1; 
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_closing_tab23()
	{
		$tab23 = $this->patient_model->fetch_closing_tab23();
		if ($tab23) {
			$data['status'] = true;
			$closing = $tab23->closing_stock;
			$stock_end_flag = $tab23->stock_end_flag;
			if ($stock_end_flag == '1' && $closing = '0') {
				$data['closing_stock'] = $tab23->closing_stock;
			} else {
				if ($closing = '0') {
					$data['closing_stock'] = $tab23->opening_stock;
				} else {
					$data['closing_stock'] = $tab23->closing_stock;
				}
			}
			$data['batch_number'] = $tab23->batch_number;
			//$data['patient_name'] = $tab1; 
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_closing_tab24()
	{
		$tab24 = $this->patient_model->fetch_closing_tab24();
		if ($tab24) {
			$data['status'] = true;
			$closing = $tab24->closing_stock;
			$stock_end_flag = $tab24->stock_end_flag;
			if ($stock_end_flag == '1' && $closing = '0') {
				$data['closing_stock'] = $tab24->closing_stock;
			} else {
				if ($closing = '0') {
					$data['closing_stock'] = $tab24->opening_stock;
				} else {
					$data['closing_stock'] = $tab24->closing_stock;
				}
			}
			$data['batch_number'] = $tab24->batch_number;
			//$data['patient_name'] = $tab1; 
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_closing_tab25()
	{
		$tab25 = $this->patient_model->fetch_closing_tab25();
		if ($tab25) {
			$data['status'] = true;
			$closing = $tab25->closing_stock;
			$stock_end_flag = $tab25->stock_end_flag;
			if ($stock_end_flag == '1' && $closing = '0') {
				$data['closing_stock'] = $tab25->closing_stock;
			} else {
				if ($closing = '0') {
					$data['closing_stock'] = $tab25->opening_stock;
				} else {
					$data['closing_stock'] = $tab25->closing_stock;
				}
			}
			$data['batch_number'] = $tab25->batch_number;
			//$data['patient_name'] = $tab1; 
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}


	public function get_daily_report()
	{
		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = $start_date2;
		// $section = $this->input->get('section', TRUE);
		$data['datefrom'] = $start_date2;
		$data['dateto'] = $end_date2;
		// $data['section'] =$section;

		$data['daily_count'] = $this->db->select('distinct(tab_name),cretate_date,')
			->from('daily_pharma_patient_stock')
			->where('cretate_date', $start_date2)
			//->where('cretate_date <=',$end_date2)
			->get()
			->result();

		$data['content'] = $this->load->view('get_daily_report', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function view_bill($id = null)
	{
		$data['patients'] = $this->db->select('*')->from('pharma_original_patient')->where('id', $id)->get()->row();
		$data['content'] = $this->load->view('view_pharma_bill', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function get_investi_patient_profile($patient_auto_id = NULL, $section = NULL)
	{

		if ($section == 'opd') {
			$data['investi_profile'] = $this->db
				->select('original_investi_opd_report_result.patient_auto_id,original_investi_opd_report_result.test_name,original_investi_opd_report_result.report_type,original_investi_opd_report_result.report_section,original_investi_opd_report_result.unit,original_investi_opd_report_result.reference_range,original_investi_opd_report_result.result,patient.id,patient.sex,patient.date_of_birth,patient.firstname,patient.create_date')
				->from('original_investi_opd_report_result')
				->join('patient', 'patient.id = original_investi_opd_report_result.patient_auto_id')
				->where('original_investi_opd_report_result.patient_auto_id', $patient_auto_id)
				->get()
				->result();
			// print_r($this->db->last_query());

		} else {
			$data['investi_profile'] = $this->db
				->select('original_investi_opd_report_result.patient_auto_id,original_investi_opd_report_result.test_name,original_investi_opd_report_result.report_type,original_investi_opd_report_result.report_section,original_investi_opd_report_result.unit,original_investi_opd_report_result.reference_range,original_investi_opd_report_result.result,patient_ipd.id,patient_ipd.sex,patient_ipd.date_of_birth,patient_ipd.firstname,patient_ipd.create_date')
				->from('original_investi_opd_report_result')
				->join('patient_ipd', 'patient_ipd.id = original_investi_opd_report_result.patient_auto_id')
				->where('original_investi_opd_report_result.patient_auto_id', $patient_auto_id)
				//->group_by('investi_ipd_report_result.patient_auto_id')
				->get()
				->result();
			// print_r($this->db->last_query());


		}

		$id = $patient_auto_id;
		$data['patient_id'] = $id;

		$data['section'] = $section;
		$data['content'] = $this->load->view('investi_profile', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}
	public function get_investi_p()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);
		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = date('Y-m-d', strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
		$start_date = $start_date2;
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;

		if ($section == 'opd') {
			$data['investigation_report'] = $this->db->select('DISTINCT(original_investi_opd_report_result.report_type),original_investi_opd_report_result.*,patient.yearly_reg_no,patient.old_reg_no,patient.sex,patient.date_of_birth,patient.dignosis,patient.department_id,patient.firstname,patient.id')
				->from('original_investi_opd_report_result')
				->join('patient', 'patient.id = original_investi_opd_report_result.patient_auto_id')
				->where('original_investi_opd_report_result.create_date >=', $start_date2)
				->where('original_investi_opd_report_result.create_date <=', $end_date2)
				->where('original_investi_opd_report_result.ipd_opd', $section)
				->limit(1)
				->get()
				->result();
			//print_r($this->db->last_query());
		} else {

			$data['investigation_report'] = $this->db->select('original_investi_opd_report_result.*,patient_ipd.yearly_reg_no,patient_ipd.old_reg_no,patient_ipd.sex,patient_ipd.date_of_birth,patient_ipd.dignosis,patient_ipd.department_id')
				->from('original_investi_opd_report_result')
				->join('patient_ipd', 'patient_ipd.id = original_investi_opd_report_result.patient_auto_id')
				->where('original_investi_opd_report_result.create_date >=', $start_date2)
				->where('original_investi_opd_report_result.create_date <=', $end_date2)
				->where('original_investi_opd_report_result.ipd_opd', $section)
				->limit(1)
				->get()
				->result();
			//print_r($this->db->last_query());
		}
		$data['content'] = $this->load->view('invesstigation_report', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function add_investigation_original()
	{
		$data['data'] = '0';
		$data['content'] = $this->load->view('add_investigation_original', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function get_investigation_patient()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		//	$end_date1   = $this->input->get('end_date', TRUE);
		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = $start_date2;
		$section = $this->input->get('section', TRUE);
		$start_date = $start_date2;
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;

		if ($section == 'opd') {
			$data['patients'] = $this->db->select('*')
				->from('patient')
				->where('create_date >=', $start_date2)
				->where('create_date <=', $end_date2)
				->where('ipd_opd', $section)
				->get()
				->result();
			//print_r($this->db->last_query());
		} else {
			$data['patients'] = $this->db->select('*')
				->from('patient_ipd')
				->where('create_date >=', $start_date2)
				->where('create_date <=', $end_date2)
				->where('ipd_opd', $section)
				->get()
				->result();
		}


		//$data['data']=  '';
		$data['content'] = $this->load->view('investigation_patient', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}
	public function fetch_patient_investi_hm()
	{
		$patient_investi = $this->patient_model->fetch_patient_investi_hm();
		//  print_r($this->db->last_query());
		$section = $this->input->post('section');
		$name = $this->input->post('name');
		$patient_auto_id = $this->input->post('patient_auto_id');
		$patient = $this->input->post('new_patient');
		$dignosis = $this->input->post('dignosis');
		$create_date = $this->input->post('create_date');

		if ($patient_investi) {
			$data['status'] = true;
			$data['patient_investi'] = $patient_investi;
			$data['name'] = $name;
			$data['patient_auto_id'] = $patient_auto_id;
			$data['new_patient'] = $patient;
			$data['dignosis'] = $dignosis;
			$data['create_date'] = $create_date;
			$data['section'] = $section;
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}


	public function fetch_invetigation_patient()
	{
		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		//	$end_date1   = $this->input->get('end_date', TRUE);
		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = $start_date2;
		$section = $this->input->get('section', TRUE);
		$start_date = $start_date2;
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;



		if ($section == 'opd') {
			$data['patients'] = $this->db->select('*')
				->from('patient')
				->where('create_date >=', $start_date2)
				->where('create_date <=', $end_date2)
				->where('ipd_opd', $section)
				->get()
				->result();
		} else {
			$data['patients'] = $this->db->select('*')
				->from('patient_ipd')
				->where('create_date >=', $start_date2)
				->where('create_date <=', $end_date2)
				->where('ipd_opd', $section)
				->get()
				->result();
		}


		$data['content'] = $this->load->view('fetch_invetigation_patient', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}



	public function investigation_patient_original()
	{
		$treatment_list_HEMATOLOGICAL = array('NULL' => 'None', 'CBC' => 'CBC', 'ESR' => 'ESR', 'PS FOR MP' => 'PS FOR MP', 'BLOOD GROUP' => 'BLOOD GROUP', 'HB' => 'HB');
		$treatment_list_SEROLOGYCAL = array('NULL' => 'None', 'WIDAL TEST' => 'WIDAL TEST', 'RA TEST' => 'RA TEST', 'ASO TEST' => 'ASO TEST', 'HIV TRIDOT' => 'HIV TRIDOT', 'HBsAG' => 'HBsAG', 'DENGUE' => 'DENGUE');
		$treatment_list_BIOCHEMICAL = array(
			'NULL' => 'None',
			'SR.BILIRUBIN' => 'SR.BILIRUBIN',
			'SR.CREATINE' => 'SR.CREATINE',
			'SR.URIC ACID' => 'SR.URIC ACID',
			'SR.CALCIUM' => 'SR.CALCIUM',
			'LIPID PROFILE' => 'LIPID PROFILE',
			'LFT' => 'LFT',
			'SGOT' => 'SGOT',
			'SGPT' => 'SGPT',
			'RANDOM BLOOD SUGAR' => 'RANDOM BLOOD SUGAR',
			'FASTING - POSTMEAL' => 'FASTING - POSTMEAL',
			'CHOLESTEROL' => 'CHOLESTEROL',
			'TRIGLYCERIDE' => 'TRIGLYCERIDE',
			'HDL' => 'HDL',
			'SR.UREA' => 'SR.UREA',
			'CRP' => 'CRP',
			'SR.ALKALINE PHOSPHOT' => 'SR.ALKALINE PHOSPHOT'
		);
		$treatment_list_MICROBIOLOGICAL = array('NULL' => 'None', 'URINE ROTINE' => 'URINE ROTINE', 'URINE MICRO' => 'URINE MICRO', 'UPT' => 'UPT');

		$data['treatment_list_SEROLOGYCAL'] = $treatment_list_SEROLOGYCAL;
		$data['treatment_list_MICROBIOLOGICAL'] = $treatment_list_MICROBIOLOGICAL;
		$data['treatment_list_BIOCHEMICAL'] = $treatment_list_BIOCHEMICAL;
		$data['treatment_list_HEMATOLOGICAL'] = $treatment_list_HEMATOLOGICAL;

		$data['content'] = $this->load->view('invest_o_patient', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}
	public function fetch_patient_investi()
	{
		$patient = $this->patient_model->fetch_patient_investi();
		//print_r($this->db->last_query());
		if ($patient) {
			$data['status'] = true;
			$data['patient_name'] = $patient;
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_treatment_investi()
	{
		$section = $this->input->post('section');
		$patient = $this->patient_model->fetch_treatment_investi();
		//print_r($this->db->last_query());

		//print_r($patient);

		if ($patient) {
			$data['status'] = true;
			// $data['dignosis'] = $patient->dignosis;
			// $data['section'] = $patient->ipd_opd;


			if ($section == 'ipd') {
				$che = trim($patient->dignosis);
				$section_tret = 'ipd';
				$len = strlen($che);
				$dd = substr($che, $len - 1);
				$str = $patient->dignosis;
				$arry = explode("-", $str);
				$t_c = count($arry);
				if ($t_c == '2') {
					$dd1 = substr($che, 0, -1);
					$new_str = trim($arry[0]);
					$p_dignosis = '%' . $new_str . '%';
					$p_dignosis_name = $patient->dignosis;
				} else {
					$p_dignosis = '%' . $che . '%';
					$p_dignosis_name = $patient->dignosis;
				}
			} else {
				$section_tret = 'opd';
				$che = trim($patient->dignosis);
				$section_tret = 'opd';
				$len = strlen($che);
				$dd = substr($che, $len - 1);
				$str = $patient->dignosis;
				$arry = explode("-", $str);
				$t_c = count($arry);
				if ($t_c == '2') {
					$dd1 = substr($che, 0, -1);
					$new_str = trim($arry[0]);
					$p_dignosis = '%' . $new_str . '%';
					$p_dignosis_name = $patient->dignosis;
				} else {
					$p_dignosis = '%' . $che . '%';
					$p_dignosis_name = $patient->dignosis;
				}
			}

			if ($patient->manual_status == 0) {
				if ($patient->proxy_id) {
					$tretment = $this->db->select("*")
						->from('treatments1')
						->where('dignosis LIKE', $p_dignosis)
						->where('proxy_id', $patient->proxy_id)
						->where('department_id', $patient->department_id)
						->where('ipd_opd ', $section_tret)
						->get()
						->row();
				} else {
					$tretment = $this->db->select("*")
						->from('treatments1')
						->where('dignosis LIKE', $p_dignosis)
						->where('department_id', $patient->department_id)
						->where('ipd_opd ', $section_tret)
						->get()
						->row();
				}
			} else {
				$tretment = $this->db->select("*")
					->from('manual_treatments')
					->where('patient_id_auto', $patient->id)
					->where('dignosis LIKE', $p_dignosis)
					->where('ipd_opd ', $section_tret)
					->get()
					->row();
				//print_r($this->db->last_query());
				// print_r($this->db->last_query());
			}
			// if($patient->manual_status=='1' || $patient->created_by =='1' || $patient->created_by =='2')
			//                     {
			//                         $tretment_m=$this->db->select("*")
			//                             ->from('manual_treatments')
			//                             ->where('patient_id_auto',$patient->id)
			//                             ->where('dignosis LIKE',$p_dignosis)
			//                             ->where('ipd_opd ',$section_tret)
			//                             ->get()
			//                             ->row();
			//                             print_r($this->db->last_query());
			//                             $data['HEMATOLOGICAL'] = $tretment_m->HEMATOLOGICAL;
			//             	            $data['SEROLOGYCAL'] = $tretment_m->SEROLOGYCAL;
			//             	            $data['BIOCHEMICAL'] = $tretment_m->BIOCHEMICAL;
			//             	            $data['MICROBIOLOGICAL'] = $tretment_m->MICROBIOLOGICAL;
			//                     }
			$data['HEMATOLOGICAL'] = $tretment->HEMATOLOGICAL;
			$data['SEROLOGYCAL'] = $tretment->SEROLOGYCAL;
			$data['BIOCHEMICAL'] = $tretment->BIOCHEMICAL;
			$data['MICROBIOLOGICAL'] = $tretment->MICROBIOLOGICAL;
			$data['name'] = $patient->firstname;
			$data['yearly_reg_no'] = $patient->yearly_reg_no;
			$data['old_reg_no'] = $patient->old_reg_no;
			$data['id'] = $patient->id;
			$data['dignosis'] = $patient->dignosis;
			$data['ipd_opd'] = $patient->ipd_opd;
			$data['firstname'] = $patient->firstname;
			$data['date_of_birth'] = $patient->date_of_birth;
			$data['sex'] = $patient->sex;
			$data['address'] = $patient->address;
			$data['weight'] = $patient->wieght;
			$data['create_date'] = date("Y-m-d", strtotime($patient->create_date));
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function save_investi_data()
	{
		$section = $this->input->post('section');
		$name = $this->input->post('name');
		$patient_auto_id = $this->input->post('patient_auto_id');
		$dignosis = $this->input->post('dignosis');
		$create_date = $this->input->post('create_date');
		$time = $this->input->post('time');
		$testname = $this->input->post('testname');
		$result1 = ($this->input->post('result1')) ? $this->input->post('result1') : NULL;
		$wd20d1 = ($this->input->post('wd20d1')) ? $this->input->post('wd20d1') : NULL;
		$wd40d1 = ($this->input->post('wd40d1')) ? $this->input->post('wd40d1') : NULL;
		$wd80d1 = ($this->input->post('wd80d1')) ? $this->input->post('wd80d1') : NULL;
		$wd160d1 = ($this->input->post('wd160d1')) ? $this->input->post('wd160d1') : NULL;
		$wd320d1 = ($this->input->post('wd320d1')) ? $this->input->post('wd320d1') : NULL;
		$unit = $this->input->post('unit');
		$referencerange = $this->input->post('referencerange');
		$report_type = $this->input->post('report_type');
		$report_section = $this->input->post('report_section');
		$test_type = $this->input->post('test_type');
		$count_test = count($testname);

		//print_r($report_section);
		//echo $report_section[0];
		//die();
		if ($report_section[0] == 'HAEMATOLOGY') {
			$hm_report_type = $report_type[0];
		} else {
			$hm_report_type = NULL;
		}
		if ($report_section[0] == 'BIOCHEMISTRY') {
			$bi_report_type = $report_type[0];
		} else {
			$bi_report_type = NULL;
		}
		if ($report_section[0] == 'SEROLOGY') {
			$se_report_type = $report_type[0];
		} else {
			$se_report_type = NULL;
		}
		if ($report_section[0] == 'Urine Routine') {
			$mi_report_type = $report_type[0];
		} else {
			$mi_report_type = NULL;
		}
		if ($report_section[0] == 'Report on Blood Sugar Estimation') {
			$mi_report_type = $report_type[0];
		} else {
			$mi_report_type = NULL;
		}
		if ($report_section[0] == 'STOOL') {
			$mi_report_type = $report_type[0];
		} else {
			$mi_report_type = NULL;
		}

		// echo $report_section[0];
		// echo $se_report_type;


		if ($report_section[0] == 'HAEMATOLOGY') {
			$HAEMATOLOGY = '1';
		} else {
			$HAEMATOLOGY = '0';
		}
		if ($report_section[0] == 'BIOCHEMISTRY') {
			$BIOCHEMISTRY = '1';
		} else {
			$BIOCHEMISTRY = '0';
		}
		if ($report_section[0] == 'SEROLOGY') {
			$SEROLOGY = '1';
		} else {
			$SEROLOGY = '0';
		}
		if ($report_section[0] == 'Urine Routine') {
			$MICROBIOLOGICAL = '1';
		} else {
			$MICROBIOLOGICAL = '0';
		}
		if ($report_section[0] == 'Report on Blood Sugar Estimation') {
			$MICROBIOLOGICAL = '1';
		} else {
			$MICROBIOLOGICAL = '0';
		}
		if ($report_section[0] == 'STOOL') {
			$MICROBIOLOGICAL = '1';
		} else {
			$MICROBIOLOGICAL = '0';
		}


		if ($section == 'opd') {
			$patient_name_table = 'investi_patient_count_opd';
		} else {
			$patient_name_table = 'investi_patient_count_ipd';
		}

		$last_patient = $this->db->select('*')
			->from($patient_name_table)
			->where('patient_auto_id', $patient_auto_id)
			->where('create_date', $create_date)
			->get()
			->row();
		// print_r($this->db->last_query());

		//     $last_patient_count = count($last_patient);
		if ($last_patient) {
			$id = $last_patient->id;
			$last_hematology_count = $last_patient->hematology;
			$last_serology_count = $last_patient->serology;
			$last_biochemistry_count = $last_patient->biochemistry;
			$last_microbiology_count = $last_patient->microbiology;

			if ($last_hematology_count) {
				$final_hematology = $last_hematology_count . ',' . $hm_report_type;
			} else {
				$final_hematology = $hm_report_type;
			}
			if ($last_serology_count) {
				$final_serology = $last_serology_count . ',' . $se_report_type;
			} else {
				$final_serology = $se_report_type;
			}
			if ($last_biochemistry_count) {
				$final_biochemistry = $last_biochemistry_count . ',' . $bi_report_type;
			} else {
				$final_biochemistry = $bi_report_type;
			}
			if ($last_microbiology_count) {
				$final_microbiology = $last_microbiology_count . ',' . $mi_report_type;
			} else {
				$final_microbiology = $mi_report_type;
			}

			$test_array = array
			(
				'hematology' => $final_hematology,
				'serology' => $final_serology,
				'biochemistry' => $final_biochemistry,
				'microbiology' => $final_microbiology,
			);
			$this->db->where('create_date', $create_date);
			$this->db->where('id', $id);
			$this->db->where('patient_auto_id', $patient_auto_id);
			$this->db->update($patient_name_table, $test_array);
			//   print_r($this->db->last_query());
		} else {
			$this->db->set('patient_auto_id', $patient_auto_id);
			$this->db->set('patient_name', $name);
			$this->db->set('ipd_opd', $section);
			$this->db->set('create_date', $create_date);
			$this->db->set('hematology', $hm_report_type);
			$this->db->set('serology', $se_report_type);
			$this->db->set('biochemistry', $bi_report_type);
			$this->db->set('microbiology', $mi_report_type);
			$this->db->set('manual_status', '1');
			$updateRes = $this->db->insert($patient_name_table);
		}
		//die();

		if ($section == 'opd') {
			$tbl_count = 'investi_test_total_count_opd';
		} else {
			$tbl_count = 'investi_test_total_count_ipd';
		}
		$data_last_date = $this->db->select('*')
			->from($tbl_count)
			->where('create_date', $create_date)
			->get()
			->row();

		//    $data_count = count($data_last_date);
		if ($data_last_date) {

			$id = $data_last_date->id;
			$last_hm_count = $data_last_date->hematology_count;
			$last_se_count = $data_last_date->serology_count;
			$last_bi_count = $data_last_date->biochemistry_count;
			$last_mi_count = $data_last_date->microbiology_count;

			$final_hm_count = $last_hm_count + $HAEMATOLOGY;
			$final_se_count = $last_se_count + $SEROLOGY;
			$final_bi_count = $last_bi_count + $BIOCHEMISTRY;
			$final_mi_count = $last_mi_count + $MICROBIOLOGICAL;


			$update_count = array(
				'hematology_count' => $final_hm_count,
				'serology_count' => $final_se_count,
				'biochemistry_count' => $final_bi_count,
				'microbiology_count' => $final_mi_count,
			);
			$this->db->where('create_date', $create_date);
			$this->db->where('id', $id);
			$this->db->update($tbl_count, $update_count);




		} else {
			$this->db->set('ipd_opd', $section);
			$this->db->set('create_date', $create_date);
			$this->db->set('hematology_count', $HAEMATOLOGY);
			$this->db->set('serology_count', $SEROLOGY);
			$this->db->set('biochemistry_count', $BIOCHEMISTRY);
			$this->db->set('microbiology_count', $MICROBIOLOGICAL);
			$this->db->set('manual_status', '1');
			$updateRes = $this->db->insert($tbl_count);
		}


		if ($section == 'opd') {
			$tble_result = 'investi_opd_report_result';
		} else {
			$tble_result = 'investi_ipd_report_result';
		}
		for ($i = 0; $i < $count_test; $i++) {
			$this->db->set('patient_auto_id', $patient_auto_id);
			$this->db->set('name', $name);
			$this->db->set('dignosis', $dignosis);
			$this->db->set('test_name', $testname[$i]);
			$this->db->set('test_type', $test_type[$i]);
			$this->db->set('report_type', $report_type[$i]);
			$this->db->set('report_section', $report_section[$i]);
			$this->db->set('unit', $unit[$i]);
			$this->db->set('reference_range', $referencerange[$i]);
			$this->db->set('result', $result1[$i]);
			$this->db->set('wd_20_result', $wd20d1[$i]);
			$this->db->set('wd_40_result', $wd40d1[$i]);
			$this->db->set('wd_80_result', $wd80d1[$i]);
			$this->db->set('wd_160_result', $wd160d1[$i]);
			$this->db->set('wd_320_result', $wd320d1[$i]);
			$this->db->set('ipd_opd', $section);
			$this->db->set('create_date', $create_date);
			$this->db->set('manual_status', '1');
			$this->db->set('create_time', $time);
			$updateRes1 = $this->db->insert($tble_result);
			$data['result'] = $updateRes1;
			// print_r($this->db->last_query());
		}

		if ($updateRes) {
			$data['status'] = true;
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}

	public function panchkarma_patient_original()
	{

		$data['test'] = '1';
		$data['content'] = $this->load->view('panch_o_patient', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}
	public function fetch_patient_panch()
	{
		$patient = $this->patient_model->fetch_patient_panch();
		if ($patient) {
			$data['status'] = true;
			$data['patient_name'] = $patient;
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_treatment_panch()
	{
		$section = $this->input->post('section');
		$patient = $this->patient_model->fetch_treatment_panch();



		if ($patient) {
			$data['status'] = true;
			// $data['dignosis'] = $patient->dignosis;
			// $data['section'] = $patient->ipd_opd;


			if ($section == 'ipd') {
				$che = trim($patient->dignosis);
				$section_tret = 'ipd';
				$len = strlen($che);
				$dd = substr($che, $len - 1);
				$str = $patient->dignosis;
				$arry = explode("-", $str);
				$t_c = count($arry);
				if ($t_c == '2') {
					$dd1 = substr($che, 0, -1);
					$new_str = trim($arry[0]);
					$p_dignosis = '%' . $new_str . '%';
					$p_dignosis_name = $patient->dignosis;
				} else {
					$p_dignosis = '%' . $che . '%';
					$p_dignosis_name = $patient->dignosis;
				}
			} else {
				$section_tret = 'opd';
				$che = trim($patient->dignosis);
				$section_tret = 'opd';
				$len = strlen($che);
				$dd = substr($che, $len - 1);
				$str = $patient->dignosis;
				$arry = explode("-", $str);
				$t_c = count($arry);
				if ($t_c == '2') {
					$dd1 = substr($che, 0, -1);
					$new_str = trim($arry[0]);
					$p_dignosis = '%' . $new_str . '%';
					$p_dignosis_name = $patient->dignosis;
				} else {
					$p_dignosis = '%' . $che . '%';
					$p_dignosis_name = $patient->dignosis;
				}
			}

			if ($patient->manual_status == 0) {
				if ($patient->proxy_id) {
					$tretment = $this->db->select("*")
						->from('treatments1')
						->where('dignosis LIKE', $p_dignosis)
						->where('proxy_id', $patient->proxy_id)
						->where('department_id', $patient->department_id)
						->where('ipd_opd ', $section_tret)
						->get()
						->row();
				} else {
					$tretment = $this->db->select("*")
						->from('treatments1')
						->where('dignosis LIKE', $p_dignosis)
						->where('department_id', $patient->department_id)
						->where('ipd_opd ', $section_tret)
						->get()
						->row();
				}
			} else {
				$tretment = $this->db->select("*")
					->from('manual_treatments')
					->where('patient_id_auto', $patient->id)
					->where('dignosis LIKE', $p_dignosis)
					->where('ipd_opd ', $section_tret)
					->get()
					->row();
				//print_r($this->db->last_query());
				// print_r($this->db->last_query());
			}
			if ($patient->manual_status == 0) {
				$data['SNEHAN'] = $tretment->SNEHAN;
				$data['SWEDAN'] = $tretment->SWEDAN;
				$data['VAMAN'] = $tretment->VAMAN;
				$data['VIRECHAN'] = $tretment->VIRECHAN;
				$data['BASTI'] = $tretment->BASTI;
				$data['NASYA'] = $tretment->NASYA;
				$data['RAKTAMOKSHAN'] = $tretment->RAKTAMOKSHAN;
				$data['SHIRODHARA_SHIROBASTI'] = $tretment->SHIRODHARA_SHIROBASTI;
				$data['YONIDHAVAN'] = $tretment->YONIDHAVAN;
				$data['YONIPICHU'] = $tretment->YONIPICHU;
				$data['UTTARBASTI'] = $tretment->UTTARBASTI;
			}
			if ($patient->manual_status == 1) {
				$data['SNEHAN'] = $tretment->SNEHAN;
				$data['SWEDAN'] = $tretment->SWEDAN;
				$data['VAMAN'] = $tretment->VAMAN;
				$data['VIRECHAN'] = $tretment->VIRECHAN;
				$data['BASTI'] = $tretment->BASTI;
				$data['NASYA'] = $tretment->NASYA;
				$data['RAKTAMOKSHAN'] = $tretment->RAKTAMOKSHAN;
				$data['SHIRODHARA_SHIROBASTI'] = $tretment->SHIRODHARA_SHIROBASTI;
				$data['SHIROBASTI'] = $tretment->SHIROBASTI;

			}

			$data['name'] = $patient->firstname;
			$data['yearly_reg_no'] = $patient->yearly_reg_no;
			$data['old_reg_no'] = $patient->old_reg_no;
			$data['id'] = $patient->id;
			$data['dignosis'] = $patient->dignosis;
			$data['ipd_opd'] = $patient->ipd_opd;
			$data['firstname'] = $patient->firstname;
			$data['date_of_birth'] = $patient->date_of_birth;
			$data['sex'] = $patient->sex;
			$data['address'] = $patient->address;
			$data['weight'] = $patient->wieght;
			$data['create_date'] = date("Y-m-d", strtotime($patient->create_date));
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function save_panch_data()
	{
		$patient_auto_id = $this->input->post('patient_auto_id');
		$name = $this->input->post('name');
		$dignosis = $this->input->post('dignosis');
		$section = $this->input->post('section');
		$create_date = ($this->input->post('create_date')) ? $this->input->post('create_date') : NULL;
		$SNEHAN = ($this->input->post('SNEHAN')) ? $this->input->post('SNEHAN') : NULL;
		$SWEDAN = ($this->input->post('SWEDAN')) ? $this->input->post('SWEDAN') : NULL;
		$VAMAN = ($this->input->post('VAMAN')) ? $this->input->post('VAMAN') : NULL;
		$VIRECHAN = ($this->input->post('VIRECHAN')) ? $this->input->post('VIRECHAN') : NULL;
		$BASTI = ($this->input->post('BASTI')) ? $this->input->post('BASTI') : NULL;
		$NASYA = ($this->input->post('NASYA')) ? $this->input->post('NASYA') : NULL;
		$RAKTAMOKSHAN = ($this->input->post('RAKTAMOKSHAN')) ? $this->input->post('RAKTAMOKSHAN') : NULL;
		$SHIRODHARA_SHIROBASTI = ($this->input->post('SHIRODHARA_SHIROBASTI')) ? $this->input->post('SHIRODHARA_SHIROBASTI') : NULL;
		$YONIDHAVAN = ($this->input->post('YONIDHAVAN')) ? $this->input->post('YONIDHAVAN') : NULL;
		$YONIPICHU = ($this->input->post('YONIPICHU')) ? $this->input->post('YONIPICHU') : NULL;
		$UTTARBASTI = ($this->input->post('UTTARBASTI')) ? $this->input->post('UTTARBASTI') : NULL;
		$SHIROBASTI = ($this->input->post('SHIROBASTI')) ? $this->input->post('SHIROBASTI') : NULL;
		$OTHER = ($this->input->post('OTHER')) ? $this->input->post('OTHER') : NULL;






		if ($section == 'opd') {
			$patient_name_table = 'investi_panch_opd_patient_count';
		} else {
			$patient_name_table = 'investi_panch_ipd_patient_count';
		}

		$last_patient = $this->db->select('*')
			->from($patient_name_table)
			->where('patient_auto_id', $patient_auto_id)
			->where('create_date', $create_date)
			->get()
			->row();

		$last_date_patient = count($last_patient);
		if ($last_date_patient == '1') {
			$id = $last_date_patient->id;
			$last_patient_snehan = $last_date_patient->snehan;
			$last_patient_swadan = $last_date_patient->swedan;
			$last_patient_vaman = $last_date_patient->vaman;
			$last_patient_virechan = $last_date_patient->virechan;
			$last_patients_basti = $last_date_patient->basti;
			$last_patient_nasya = $last_date_patient->nasya;
			$last_patient_raktmokshan = $last_date_patient->raktmokshan;
			$last_patient_shirodhara = $last_date_patient->shirodhara;
			$last_patient_yonidhavan = $last_date_patient->yonidhavan;
			$last_patient_yonipichu = $last_date_patient->yonipichu;
			$last_patient_uttarbasti = $last_date_patient->uttarbasti;
			$last_patient_shirobasti = $last_date_patient->shirobasti;
			$last_patient_other = $last_date_patient->others;

			if ($last_patient_snehan) {
				$final_patient_shehan = $last_patient_snehan;
			} else {
				$final_patient_shehan = $SNEHAN;
			}
			if ($last_patient_swadan) {
				$final_patient_swdan = $last_patient_swadan;
			} else {
				$final_patient_swdan = $SWEDAN;
			}
			if ($last_patient_vaman) {
				$final_patient_vaman = $last_patient_vaman;
			} else {
				$final_patient_vaman = $VAMAN;
			}
			if ($last_patient_virechan) {
				$final_patient_virechan = $last_patient_virechan;
			} else {
				$final_patient_virechan = $SNEHAN;
			}
			if ($last_patients_basti) {
				$final_patient_basti = $last_patients_basti;
			} else {
				$final_patient_basti = $SNEHAN;
			}
			if ($last_patient_nasya) {
				$final_patient_nasya = $last_patient_nasya;
			} else {
				$final_patient_nasya = $SNEHAN;
			}
			if ($last_patient_raktmokshan) {
				$final_patient_raktmokshan = $last_patient_raktmokshan;
			} else {
				$final_patient_raktmokshan = $SNEHAN;
			}
			if ($last_patient_shirodhara) {
				$final_patient_shirodhara = $last_patient_shirodhara;
			} else {
				$final_patient_shirodhara = $SNEHAN;
			}
			if ($last_patient_yonidhavan) {
				$final_patient_yonidhavan = $last_patient_yonidhavan;
			} else {
				$final_patient_yonidhavan = $SNEHAN;
			}
			if ($last_patient_yonipichu) {
				$final_patient_yonipichu = $last_patient_yonipichu;
			} else {
				$final_patient_yonipichu = $SNEHAN;
			}
			if ($last_patient_uttarbasti) {
				$final_patient_uttarbasti = $last_patient_uttarbasti;
			} else {
				$final_patient_uttarbasti = $SNEHAN;
			}
			if ($last_patient_shirobasti) {
				$final_patient_shirobsti = $last_patient_shirobasti;
			} else {
				$final_patient_shirobsti = $SNEHAN;
			}
			if ($last_patient_other) {
				$final_patient_other = $last_patient_other;
			} else {
				$final_patient_other = $SNEHAN;
			}

			$update_count_patient = array(
				'snehan' => $final_patient_shehan,
				'swedan' => $final_patient_swdan,
				'vaman' => $final_patient_vaman,
				'virechan' => $final_patient_virechan,
				'basti' => $final_patient_basti,
				'nasya' => $final_patient_nasya,
				'raktmokshan' => $final_patient_raktmokshan,
				'shirodhara' => $final_patient_shirodhara,
				'yonidhavan' => $final_patient_yonidhavan,
				'yonipichu' => $final_patient_yonipichu,
				'uttarbasti' => $final_patient_uttarbasti,
				'shirobasti' => $final_patient_shirobsti,
				'others' => $final_patient_other,
			);
			$this->db->where('create_date', $create_date);
			$this->db->where('id', $id);
			$this->db->where('patient_auto_id', $patient_auto_id);
			$this->db->update($patient_name_table, $test_array);


		} else {
			$this->db->set('patient_auto_id', $patient_auto_id);
			$this->db->set('patient_name', $name);
			//$this->db->set('dignosis',$dignosis);
			$this->db->set('ipd_opd', $section);
			$this->db->set('create_date', $create_date);
			$this->db->set('snehan', $SNEHAN);
			$this->db->set('swedan', $SWEDAN);
			$this->db->set('vaman', $VAMAN);
			$this->db->set('virechan', $VIRECHAN);
			$this->db->set('basti', $BASTI);
			$this->db->set('nasya', $NASYA);
			$this->db->set('raktmokshan', $RAKTAMOKSHAN);
			$this->db->set('shirodhara', $SHIRODHARA_SHIROBASTI);
			$this->db->set('yonidhavan', $YONIDHAVAN);
			$this->db->set('yonipichu', $YONIPICHU);
			$this->db->set('uttarbasti', $UTTARBASTI);
			$this->db->set('shirobasti', $SHIROBASTI);
			$this->db->set('others', $OTHER);
			$this->db->set('manual_status', '1');
			$updateRes = $this->db->insert($patient_name_table);
		}

		if ($SNEHAN) {
			$SNEHAN_COUNT = count($SNEHAN);
		} else {
			$SNEHAN_COUNT = '0';
		}
		if ($SWEDAN) {
			$SWEDAN_COUNT = count($SWEDAN);
		} else {
			$SWEDAN_COUNT = '0';
		}
		if ($VAMAN) {
			$VAMAN_COUNT = count($VAMAN);
		} else {
			$VAMAN_COUNT = '0';
		}
		if ($VIRECHAN) {
			$VIRECHAN_COUNT = count($VIRECHAN);
		} else {
			$VIRECHAN_COUNT = '0';
		}
		if ($BASTI) {
			$BASTI_COUNT = count($BASTI);
		} else {
			$BASTI_COUNT = '0';
		}
		if ($NASYA) {
			$NASYA_COUNT = count($NASYA);
		} else {
			$NASYA_COUNT = '0';
		}
		if ($RAKTAMOKSHAN) {
			$RAKTAMOKSHAN_COUNT = count($RAKTAMOKSHAN);
		} else {
			$RAKTAMOKSHAN_COUNT = '0';
		}
		if ($SHIRODHARA_SHIROBASTI) {
			$SHIRODHARA_SHIROBASTI_COUNT = count($SHIRODHARA_SHIROBASTI);
		} else {
			$SHIRODHARA_SHIROBASTI_COUNT = '0';
		}
		if ($YONIDHAVAN) {
			$YONIDHAVAN_COUNT = count($YONIDHAVAN);
		} else {
			$YONIDHAVAN_COUNT = '0';
		}
		if ($YONIPICHU) {
			$YONIPICHU_COUNT = count($YONIPICHU);
		} else {
			$YONIPICHU_COUNT = '0';
		}
		if ($UTTARBASTI) {
			$UTTARBASTI_COUNT = count($UTTARBASTI);
		} else {
			$UTTARBASTI_COUNT = '0';
		}
		if ($SHIROBASTI) {
			$SHIROBASTI_COUNT = count($SHIROBASTI);
		} else {
			$SHIROBASTI_COUNT = '0';
		}
		if ($OTHER) {
			$OTHER_COUNT = count($OTHER);
		} else {
			$OTHER_COUNT = '0';
		}

		// $SNEHAN_COUNT = count($SNEHAN);
		// $SWEDAN_COUNT = count($SWEDAN);
		// $VAMAN_COUNT = count($VAMAN);
		// $VIRECHAN_COUNT = count($VIRECHAN);
		// $BASTI_COUNT = count($BASTI);
		// $NASYA_COUNT = count($NASYA);
		// $RAKTAMOKSHAN_COUNT = count($RAKTAMOKSHAN);
		// $SHIRODHARA_SHIROBASTI_COUNT = count($SHIRODHARA_SHIROBASTI);
		// $YONIDHAVAN_COUNT = count($YONIDHAVAN);
		// $YONIPICHU_COUNT = count($YONIPICHU);
		// $UTTARBASTI_COUNT = count($UTTARBASTI);
		// $SHIROBASTI_COUNT = count($SHIROBASTI);
		// $OTHER_COUNT = count($OTHER);



		if ($section == 'opd') {
			$tbl_count_last = 'investi_panch_opd_total_count';
		} else {
			$tbl_count_last = 'investi_panch_ipd_total_count';
		}

		$last_date_count_final = $this->db->select('*')
			->from($tbl_count_last)
			->where('create_date', $create_date)
			->get()
			->row();

		$last_date_patient_count_last = count($last_date_count_final);

		if ($last_date_patient_count_last == '1') {
			$id = $last_date_count_final->id;
			$last_snehan_count = $last_date_count_final->snehan_count;
			$last_swedan_count = $last_date_count_final->swedan_count;
			$last_vaman_count = $last_date_count_final->vaman_count;
			$last_virechan_count = $last_date_count_final->virechan_count;
			$last_basti_count = $last_date_count_final->basti_count;
			$last_nasya_count = $last_date_count_final->nasya_count;
			$last_raktamokshan_count = $last_date_count_final->raktmokshan_count;
			$last_shirodhara_shirobasti_count = $last_date_count_final->shirodhara_count;
			$last_yonidhavan_count = $last_date_count_final->yonidhavan_count;
			$last_yonipichu_count = $last_date_count_final->yonipichu_count;
			$last_uttarbasti_count = $last_date_count_final->uttarbasti_count;
			$last_shirobasti_count = $last_date_count_final->shirobasti_count;
			$last_other_count = $last_date_count_final->others_count;

			$final_snehan_count = $last_snehan_count + $SNEHAN_COUNT;
			$final_swedan_count = $last_swedan_count + $SWEDAN_COUNT;
			$final_vaman_count = $last_vaman_count + $VAMAN_COUNT;
			$final_virechan_count = $last_virechan_count + $VIRECHAN_COUNT;
			$final_basti_count = $last_basti_count + $BASTI_COUNT;
			$final_nasya_count = $last_nasya_count + $NASYA_COUNT;
			$final_raktamokshan_count = $last_raktamokshan_count + $RAKTAMOKSHAN_COUNT;
			$final_shirodhara_shirobasti_count = $last_shirodhara_shirobasti_count + $SHIRODHARA_SHIROBASTI_COUNT;
			$final_yonidhavan_count = $last_yonidhavan_count + $YONIDHAVAN_COUNT;
			$final_yonipichu_count = $last_yonipichu_count + $YONIPICHU_COUNT;
			$final_uttarbasti_count = $last_uttarbasti_count + $UTTARBASTI_COUNT;
			$final_shirobasti_count = $last_shirobasti_count + $SHIROBASTI_COUNT;
			$final_other_count = $last_other_count + $OTHER_COUNT;

			$update_count = array(

				'snehan_count' => $final_snehan_count,
				'swedan_count' => $final_swedan_count,
				'vaman_count' => $final_vaman_count,
				'virechan_count' => $final_virechan_count,
				'basti_count' => $final_basti_count,
				'nasya_count' => $final_nasya_count,
				'raktmokshan_count' => $final_raktamokshan_count,
				'shirodhara_count' => $final_shirodhara_shirobasti_count,
				'yonidhavan_count' => $final_yonidhavan_count,
				'yonipichu_count' => $final_yonipichu_count,
				'uttarbasti_count' => $final_uttarbasti_count,
				'shirobasti_count' => $final_shirobasti_count,
				'others_count' => $final_other_count,

			);
			$this->db->where('create_date', $create_date);
			$this->db->where('id', $id);
			$this->db->update($tbl_count_last, $update_count);

		} else {

			$update_count = array(

				'ipd_opd' => $section,
				'create_date' => $create_date,
				'snehan_count' => $SNEHAN_COUNT,
				'swedan_count' => $SWEDAN_COUNT,
				'vaman_count' => $VAMAN_COUNT,
				'virechan_count' => $VIRECHAN_COUNT,
				'basti_count' => $BASTI_COUNT,
				'nasya_count' => $NASYA_COUNT,
				'raktmokshan_count' => $RAKTAMOKSHAN_COUNT,
				'shirodhara_count' => $SHIRODHARA_SHIROBASTI_COUNT,
				'yonidhavan_count' => $YONIDHAVAN_COUNT,
				'yonipichu_count' => $YONIPICHU_COUNT,
				'uttarbasti_count' => $UTTARBASTI_COUNT,
				'shirobasti_count' => $SHIROBASTI_COUNT,
				'others_count' => $OTHER_COUNT,
				'manual_status' => '1',

			);
			$count_data = $this->db->insert($tbl_count_last, $update_count);
			// $count_data = $this->patient_model->save_panch_data_count($all_count);

		}

		if ($section == 'opd') {
			$tbl_count = 'investi_panch_opd_test_total_count';
		} else {
			$tbl_count = 'investi_panch_ipd_test_total_count';
		}

		$last_date_count = $this->db->select('*')
			->from($tbl_count)
			->where('create_date', $create_date)
			->get()
			->row();

		$last_date_patient_count = count($last_date_count);

		if ($last_date_patient_count == '1') {
			$id = $last_date_count->id;
			$last_snehan_count = $last_date_count->snehan_count;
			$last_swedan_count = $last_date_count->swedan_count;
			$last_vaman_count = $last_date_count->vaman_count;
			$last_virechan_count = $last_date_count->virechan_count;
			$last_basti_count = $last_date_count->basti_count;
			$last_nasya_count = $last_date_count->nasya_count;
			$last_raktamokshan_count = $last_date_count->raktmokshan_count;
			$last_shirodhara_shirobasti_count = $last_date_count->shirodhara_count;
			$last_yonidhavan_count = $last_date_count->yonidhavan_count;
			$last_yonipichu_count = $last_date_count->yonipichu_count;
			$last_uttarbasti_count = $last_date_count->uttarbasti_count;
			$last_shirobasti_count = $last_date_count->shirobasti_count;
			$last_other_count = $last_date_count->others_count;

			$final_snehan_count = $last_snehan_count + $SNEHAN_COUNT;
			$final_swedan_count = $last_swedan_count + $SWEDAN_COUNT;
			$final_vaman_count = $last_vaman_count + $VAMAN_COUNT;
			$final_virechan_count = $last_virechan_count + $VIRECHAN_COUNT;
			$final_basti_count = $last_basti_count + $BASTI_COUNT;
			$final_nasya_count = $last_nasya_count + $NASYA_COUNT;
			$final_raktamokshan_count = $last_raktamokshan_count + $RAKTAMOKSHAN_COUNT;
			$final_shirodhara_shirobasti_count = $last_shirodhara_shirobasti_count + $SHIRODHARA_SHIROBASTI_COUNT;
			$final_yonidhavan_count = $last_yonidhavan_count + $YONIDHAVAN_COUNT;
			$final_yonipichu_count = $last_yonipichu_count + $YONIPICHU_COUNT;
			$final_uttarbasti_count = $last_uttarbasti_count + $UTTARBASTI_COUNT;
			$final_shirobasti_count = $last_shirobasti_count + $SHIROBASTI_COUNT;
			$final_other_count = $last_other_count + $OTHER_COUNT;

			$update_count = array(

				'snehan_count' => $final_snehan_count,
				'swedan_count' => $final_swedan_count,
				'vaman_count' => $final_vaman_count,
				'virechan_count' => $final_virechan_count,
				'basti_count' => $final_basti_count,
				'nasya_count' => $final_nasya_count,
				'raktmokshan_count' => $final_raktamokshan_count,
				'shirodhara_count' => $final_shirodhara_shirobasti_count,
				'yonidhavan_count' => $final_yonidhavan_count,
				'yonipichu_count' => $final_yonipichu_count,
				'uttarbasti_count' => $final_uttarbasti_count,
				'shirobasti_count' => $final_shirobasti_count,
				'others_count' => $final_other_count,

			);
			$this->db->where('create_date', $create_date);
			$this->db->where('id', $id);
			$this->db->update($tbl_count, $update_count);

		} else {

			$update_count = array(

				'ipd_opd' => $section,
				'create_date' => $create_date,
				'snehan_count' => $SNEHAN_COUNT,
				'swedan_count' => $SWEDAN_COUNT,
				'vaman_count' => $VAMAN_COUNT,
				'virechan_count' => $VIRECHAN_COUNT,
				'basti_count' => $BASTI_COUNT,
				'nasya_count' => $NASYA_COUNT,
				'raktmokshan_count' => $RAKTAMOKSHAN_COUNT,
				'shirodhara_count' => $SHIRODHARA_SHIROBASTI_COUNT,
				'yonidhavan_count' => $YONIDHAVAN_COUNT,
				'yonipichu_count' => $YONIPICHU_COUNT,
				'uttarbasti_count' => $UTTARBASTI_COUNT,
				'shirobasti_count' => $SHIROBASTI_COUNT,
				'others_count' => $OTHER_COUNT,
				'manual_status' => '1',

			);
			$count_data = $this->db->insert($tbl_count, $update_count);
			// $count_data = $this->patient_model->save_panch_data_count($all_count);

		}





		if ($updateRes) {
			$data['status'] = true;
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}


	public function xray_patient_original()
	{

		$data['test'] = '1';
		$data['content'] = $this->load->view('xray_o_patient', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}
	public function fetch_patient_xray()
	{
		$patient = $this->patient_model->fetch_patient_xray();
		if ($patient) {
			$data['status'] = true;
			$data['patient_name'] = $patient;
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_treatment_xray()
	{
		$section = $this->input->post('section');
		$patient = $this->patient_model->fetch_treatment_xray();



		if ($patient) {
			$data['status'] = true;
			// $data['dignosis'] = $patient->dignosis;
			// $data['section'] = $patient->ipd_opd;


			if ($section == 'ipd') {
				$che = trim($patient->dignosis);
				$section_tret = 'ipd';
				$len = strlen($che);
				$dd = substr($che, $len - 1);
				$str = $patient->dignosis;
				$arry = explode("-", $str);
				$t_c = count($arry);
				if ($t_c == '2') {
					$dd1 = substr($che, 0, -1);
					$new_str = trim($arry[0]);
					$p_dignosis = '%' . $new_str . '%';
					$p_dignosis_name = $patient->dignosis;
				} else {
					$p_dignosis = '%' . $che . '%';
					$p_dignosis_name = $patient->dignosis;
				}
			} else {
				$section_tret = 'opd';
				$che = trim($patient->dignosis);
				$section_tret = 'opd';
				$len = strlen($che);
				$dd = substr($che, $len - 1);
				$str = $patient->dignosis;
				$arry = explode("-", $str);
				$t_c = count($arry);
				if ($t_c == '2') {
					$dd1 = substr($che, 0, -1);
					$new_str = trim($arry[0]);
					$p_dignosis = '%' . $new_str . '%';
					$p_dignosis_name = $patient->dignosis;
				} else {
					$p_dignosis = '%' . $che . '%';
					$p_dignosis_name = $patient->dignosis;
				}
			}

			if ($patient->manual_status == 0) {
				if ($patient->proxy_id) {
					$tretment = $this->db->select("*")
						->from('treatments1')
						->where('dignosis LIKE', $p_dignosis)
						->where('proxy_id', $patient->proxy_id)
						->where('department_id', $patient->department_id)
						->where('ipd_opd ', $section_tret)
						->get()
						->row();
				} else {
					$tretment = $this->db->select("*")
						->from('treatments1')
						->where('dignosis LIKE', $p_dignosis)
						->where('department_id', $patient->department_id)
						->where('ipd_opd ', $section_tret)
						->get()
						->row();
				}
			} else {
				$tretment = $this->db->select("*")
					->from('manual_treatments')
					->where('patient_id_auto', $patient->id)
					->where('dignosis LIKE', $p_dignosis)
					->where('ipd_opd ', $section_tret)
					->get()
					->row();
				//print_r($this->db->last_query());
				// print_r($this->db->last_query());
			}

			$data['X_RAY'] = $tretment->X_RAY;
			$data['name'] = $patient->firstname;
			$data['yearly_reg_no'] = $patient->yearly_reg_no;
			$data['old_reg_no'] = $patient->old_reg_no;
			$data['id'] = $patient->id;
			$data['dignosis'] = $patient->dignosis;
			$data['ipd_opd'] = $patient->ipd_opd;
			$data['firstname'] = $patient->firstname;
			$data['date_of_birth'] = $patient->date_of_birth;
			$data['sex'] = $patient->sex;
			$data['address'] = $patient->address;
			$data['weight'] = $patient->wieght;
			$data['create_date'] = date("Y-m-d", strtotime($patient->create_date));
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function save_xray_data()
	{
		$patient_auto_id = $this->input->post('patient_auto_id');
		$name = $this->input->post('name');
		$dignosis = $this->input->post('dignosis');
		$section = $this->input->post('section');
		$create_date = ($this->input->post('create_date')) ? $this->input->post('create_date') : NULL;
		$X_RAY = ($this->input->post('X_RAY')) ? $this->input->post('X_RAY') : NULL;
		$xray_result = ($this->input->post('xray_result')) ? $this->input->post('xray_result') : NULL;

		$count_xray = count($X_RAY);



		if ($section == 'opd') {
			$patient_name_table = 'investi_panch_opd_patient_count';
		} else {
			$patient_name_table = 'investi_panch_ipd_patient_count';
		}

		$last_patient = $this->db->select('*')
			->from($patient_name_table)
			->where('patient_auto_id', $patient_auto_id)
			->where('create_date', $create_date)
			->get()
			->row();
		//   print_r($this->db->last_query());

		$last_patient_count = count($last_patient);
		if ($last_patient_count == '1') {
			$id = $last_patient->id;

			// $last_xray_count = $last_patient->xray;
			if ($X_RAY) {
				$last_xray_count = $X_RAY;
			} else {
				$last_xray_count = $last_patient->xray;
			}

			$test_array = array
			(
				'xray' => $last_xray_count,
			);
			$this->db->where('create_date', $create_date);
			$this->db->where('id', $id);
			$this->db->where('patient_auto_id', $patient_auto_id);
			$this->db->update($patient_name_table, $test_array);
			//  print_r($this->db->last_query());
		} else {
			$this->db->set('patient_auto_id', $patient_auto_id);
			$this->db->set('patient_name', $name);
			$this->db->set('ipd_opd', $section);
			$this->db->set('create_date', $create_date);
			$this->db->set('xray', $X_RAY);
			$this->db->set('manual_status', '1');
			$updateRes = $this->db->insert($patient_name_table);
		}

		if ($section == 'opd') {
			$tbl_count_last = 'investi_panch_opd_total_count';
		} else {
			$tbl_count_last = 'investi_panch_ipd_total_count';
		}

		$last_date_count_final = $this->db->select('*')
			->from($tbl_count_last)
			->where('create_date', $create_date)
			->get()
			->row();

		$last_date_patient_count_last = count($last_date_count_final);

		if ($last_date_patient_count_last == '1') {
			$id = $last_date_count_final->id;

			if ($X_RAY) {
				$last_xray_count = $count_xray;
			} else {
				$last_xray_count = $last_date_count_final->xray_count;
			}

			$update_count = array(
				'xray_count' => $last_xray_count,
			);
			$this->db->where('create_date', $create_date);
			$this->db->where('id', $id);
			$updateRes = $this->db->update($tbl_count_last, $update_count);

		} else {

			$update_count = array(

				'ipd_opd' => $section,
				'create_date' => $create_date,
				'xray_count' => $count_xray,
				'manual_status' => '1',
			);
			$updateRes = $this->db->insert($tbl_count_last, $update_count);
			// $count_data = $this->patient_model->save_panch_data_count($all_count);

		}

		if ($section == 'opd') {
			$tbl_count = 'investi_panch_opd_test_total_count';
		} else {
			$tbl_count = 'investi_panch_ipd_test_total_count';
		}
		$data_last_date = $this->db->select('*')
			->from($tbl_count)
			->where('create_date', $create_date)
			->get()
			->row();
		$data_count = count($data_last_date);
		if ($data_count == 1) {

			$id = $data_last_date->id;
			if ($X_RAY) {
				$last_xray_count = $count_xray;
			} else {
				$last_xray_count = $data_last_date->xray_count;
			}
			$update_count = array(
				'xray_count' => $last_xray_count,
			);
			$this->db->where('create_date', $create_date);
			$this->db->where('id', $id);
			$this->db->update($tbl_count, $update_count);
		} else {
			$this->db->set('ipd_opd', $section);
			$this->db->set('create_date', $create_date);
			$this->db->set('xray_count', $count_xray);
			$this->db->set('manual_status', '1');
			$updateRes = $this->db->insert($tbl_count);
		}

		if ($section == 'opd') {
			$tble_result = 'investi_opd_report_result';
		} else {
			$tble_result = 'investi_ipd_report_result';
		}

		$result_last_date = $this->db->select('*')
			->from($tble_result)
			->where('create_date', $create_date)
			->where('patient_auto_id', $patient_auto_id)
			->get()
			->row();
		$result_count = count($result_last_date);
		if ($result_count == '1') {

			$update_count = array(
				'result' => $xray_result,
			);
			$this->db->where('create_date', $create_date);
			$this->db->where('id', $id);
			$this->db->where('patient_auto_id', $patient_auto_id);
			$this->db->update($tbl_count, $update_count);

		} else {

			$this->db->set('patient_auto_id', $patient_auto_id);
			$this->db->set('name', $name);
			$this->db->set('dignosis', $dignosis);
			$this->db->set('test_name', $X_RAY);
			$this->db->set('test_type', $X_RAY);
			$this->db->set('report_type', 'X_RAY');
			$this->db->set('report_section', 'X_RAY');
			$this->db->set('result', $xray_result);
			$this->db->set('ipd_opd', $section);
			$this->db->set('create_date', $create_date);
			$this->db->set('manual_status', '1');
			$updateRes1 = $this->db->insert($tble_result);
		}
		if ($updateRes) {
			$data['status'] = true;
		} else {
			$data['status'] = false;
		}

		echo json_encode($data);

	}

	public function ecg_patient_original()
	{

		$data['test'] = '1';
		$data['content'] = $this->load->view('ecg_o_patient', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}
	public function fetch_patient_ecg()
	{
		$patient = $this->patient_model->fetch_patient_ecg();
		if ($patient) {
			$data['status'] = true;
			$data['patient_name'] = $patient;
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}


	public function fetch_treatment_ecg()
	{
		$section = $this->input->post('section');
		$patient = $this->patient_model->fetch_treatment_ecg();



		if ($patient) {
			$data['status'] = true;
			// $data['dignosis'] = $patient->dignosis;
			// $data['section'] = $patient->ipd_opd;


			if ($section == 'ipd') {
				$che = trim($patient->dignosis);
				$section_tret = 'ipd';
				$len = strlen($che);
				$dd = substr($che, $len - 1);
				$str = $patient->dignosis;
				$arry = explode("-", $str);
				$t_c = count($arry);
				if ($t_c == '2') {
					$dd1 = substr($che, 0, -1);
					$new_str = trim($arry[0]);
					$p_dignosis = '%' . $new_str . '%';
					$p_dignosis_name = $patient->dignosis;
				} else {
					$p_dignosis = '%' . $che . '%';
					$p_dignosis_name = $patient->dignosis;
				}
			} else {
				$section_tret = 'opd';
				$che = trim($patient->dignosis);
				$section_tret = 'opd';
				$len = strlen($che);
				$dd = substr($che, $len - 1);
				$str = $patient->dignosis;
				$arry = explode("-", $str);
				$t_c = count($arry);
				if ($t_c == '2') {
					$dd1 = substr($che, 0, -1);
					$new_str = trim($arry[0]);
					$p_dignosis = '%' . $new_str . '%';
					$p_dignosis_name = $patient->dignosis;
				} else {
					$p_dignosis = '%' . $che . '%';
					$p_dignosis_name = $patient->dignosis;
				}
			}

			if ($patient->manual_status == 0) {
				if ($patient->proxy_id) {
					$tretment = $this->db->select("*")
						->from('treatments1')
						->where('dignosis LIKE', $p_dignosis)
						->where('proxy_id', $patient->proxy_id)
						->where('department_id', $patient->department_id)
						->where('ipd_opd ', $section_tret)
						->get()
						->row();
				} else {
					$tretment = $this->db->select("*")
						->from('treatments1')
						->where('dignosis LIKE', $p_dignosis)
						->where('department_id', $patient->department_id)
						->where('ipd_opd ', $section_tret)
						->get()
						->row();
				}
			} else {
				$tretment = $this->db->select("*")
					->from('manual_treatments')
					->where('patient_id_auto', $patient->id)
					->where('dignosis LIKE', $p_dignosis)
					->where('ipd_opd ', $section_tret)
					->get()
					->row();
				//print_r($this->db->last_query());
				// print_r($this->db->last_query());
			}

			$data['ECG'] = $tretment->ECG;
			$data['name'] = $patient->firstname;
			$data['yearly_reg_no'] = $patient->yearly_reg_no;
			$data['old_reg_no'] = $patient->old_reg_no;
			$data['id'] = $patient->id;
			$data['dignosis'] = $patient->dignosis;
			$data['ipd_opd'] = $patient->ipd_opd;
			$data['firstname'] = $patient->firstname;
			$data['date_of_birth'] = $patient->date_of_birth;
			$data['sex'] = $patient->sex;
			$data['address'] = $patient->address;
			$data['weight'] = $patient->wieght;
			$data['create_date'] = date("Y-m-d", strtotime($patient->create_date));
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function save_ecg_data()
	{
		$patient_auto_id = $this->input->post('patient_auto_id');
		$name = $this->input->post('name');
		$dignosis = $this->input->post('dignosis');
		$section = $this->input->post('section');
		$create_date = ($this->input->post('create_date')) ? $this->input->post('create_date') : NULL;
		$ECG = ($this->input->post('ECG')) ? $this->input->post('ECG') : NULL;
		$ecg_result = ($this->input->post('ecg_result')) ? $this->input->post('ecg_result') : NULL;

		$count_ecg = count($ECG);



		if ($section == 'opd') {
			$patient_name_table = 'investi_panch_opd_patient_count';
		} else {
			$patient_name_table = 'investi_panch_ipd_patient_count';
		}

		$last_patient = $this->db->select('*')
			->from($patient_name_table)
			->where('patient_auto_id', $patient_auto_id)
			->where('create_date', $create_date)
			->get()
			->row();
		//   print_r($this->db->last_query());

		$last_patient_count = count($last_patient);
		if ($last_patient_count == '1') {
			$id = $last_patient->id;

			// $last_xray_count = $last_patient->xray;
			if ($ECG) {
				$last_ecg_count = $ECG;
			} else {
				$last_ecg_count = $last_patient->xray;
			}

			$test_array = array
			(
				'ecg' => $last_ecg_count,
			);
			$this->db->where('create_date', $create_date);
			$this->db->where('id', $id);
			$this->db->where('patient_auto_id', $patient_auto_id);
			$this->db->update($patient_name_table, $test_array);
			//  print_r($this->db->last_query());
		} else {
			$this->db->set('patient_auto_id', $patient_auto_id);
			$this->db->set('patient_name', $name);
			$this->db->set('ipd_opd', $section);
			$this->db->set('create_date', $create_date);
			$this->db->set('ecg', $ECG);
			$this->db->set('manual_status', '1');
			$updateRes = $this->db->insert($patient_name_table);
		}

		if ($section == 'opd') {
			$tbl_count_last = 'investi_panch_opd_total_count';
		} else {
			$tbl_count_last = 'investi_panch_opd_total_count';
		}

		$last_date_count_final = $this->db->select('*')
			->from($tbl_count_last)
			->where('create_date', $create_date)
			->get()
			->row();

		$last_date_patient_count_last = count($last_date_count_final);

		if ($last_date_patient_count_last == '1') {
			$id = $last_date_count_final->id;

			if ($ECG) {
				$last_ecg_count = $count_ecg;
			} else {
				$last_ecg_count = $last_date_count_final->ecg_count;
			}

			$update_count = array(
				'ecg_count' => $last_ecg_count,
			);
			$this->db->where('create_date', $create_date);
			$this->db->where('id', $id);
			$updateRes = $this->db->update($tbl_count_last, $update_count);

		} else {

			$update_count = array(

				'ipd_opd' => $section,
				'create_date' => $create_date,
				'ecg_count' => $count_ecg,
				'manual_status' => '1',
			);
			$updateRes = $this->db->insert($tbl_count_last, $update_count);
			// $count_data = $this->patient_model->save_panch_data_count($all_count);

		}

		if ($section == 'opd') {
			$tbl_count = 'investi_panch_opd_test_total_count';
		} else {
			$tbl_count = 'investi_panch_ipd_test_total_count';
		}
		$data_last_date = $this->db->select('*')
			->from($tbl_count)
			->where('create_date', $create_date)
			->get()
			->row();
		$data_count = count($data_last_date);
		if ($data_count == 1) {

			$id = $data_last_date->id;
			if ($ECG) {
				$last_ecg_count = $count_ecg;
			} else {
				$last_ecg_count = $data_last_date->ecg_count;
			}
			$update_count = array(
				'xray_count' => $last_xray_count,
			);
			$this->db->where('create_date', $create_date);
			$this->db->where('id', $id);
			$this->db->update($tbl_count, $update_count);
		} else {
			$this->db->set('ipd_opd', $section);
			$this->db->set('create_date', $create_date);
			$this->db->set('ecg_count', $count_ecg);
			$this->db->set('manual_status', '1');
			$updateRes = $this->db->insert($tbl_count);
		}

		if ($section == 'opd') {
			$tble_result = 'investi_opd_report_result';
		} else {
			$tble_result = 'investi_ipd_report_result';
		}

		$result_last_date = $this->db->select('*')
			->from($tble_result)
			->where('create_date', $create_date)
			->where('patient_auto_id', $patient_auto_id)
			->get()
			->row();
		$result_count = count($result_last_date);
		if ($result_count == '1') {

			$update_count = array(
				'result' => $ecg_result,
			);
			$this->db->where('create_date', $create_date);
			$this->db->where('id', $id);
			$this->db->where('patient_auto_id', $patient_auto_id);
			$this->db->update($tbl_count, $update_count);

		} else {

			$this->db->set('patient_auto_id', $patient_auto_id);
			$this->db->set('name', $name);
			$this->db->set('dignosis', $dignosis);
			$this->db->set('test_name', $ECG);
			$this->db->set('test_type', $ECG);
			$this->db->set('report_type', $ECG);
			$this->db->set('report_section', $ECG);
			$this->db->set('result', $ecg_result);
			$this->db->set('ipd_opd', $section);
			$this->db->set('create_date', $create_date);
			$this->db->set('manual_status', '1');
			$updateRes1 = $this->db->insert($tble_result);
		}
		if ($updateRes) {
			$data['status'] = true;
		} else {
			$data['status'] = false;
		}

		echo json_encode($data);

	}

	public function usg_patient_original()
	{

		$data['test'] = '1';
		$data['content'] = $this->load->view('usg_o_patient', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}
	public function fetch_patient_usg()
	{
		$patient = $this->patient_model->fetch_patient_usg();
		if ($patient) {
			$data['status'] = true;
			$data['patient_name'] = $patient;
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_treatment_usg()
	{
		$section = $this->input->post('section');
		$patient = $this->patient_model->fetch_treatment_usg();



		if ($patient) {
			$data['status'] = true;
			// $data['dignosis'] = $patient->dignosis;
			// $data['section'] = $patient->ipd_opd;


			if ($section == 'ipd') {
				$che = trim($patient->dignosis);
				$section_tret = 'ipd';
				$len = strlen($che);
				$dd = substr($che, $len - 1);
				$str = $patient->dignosis;
				$arry = explode("-", $str);
				$t_c = count($arry);
				if ($t_c == '2') {
					$dd1 = substr($che, 0, -1);
					$new_str = trim($arry[0]);
					$p_dignosis = '%' . $new_str . '%';
					$p_dignosis_name = $patient->dignosis;
				} else {
					$p_dignosis = '%' . $che . '%';
					$p_dignosis_name = $patient->dignosis;
				}
			} else {
				$section_tret = 'opd';
				$che = trim($patient->dignosis);
				$section_tret = 'opd';
				$len = strlen($che);
				$dd = substr($che, $len - 1);
				$str = $patient->dignosis;
				$arry = explode("-", $str);
				$t_c = count($arry);
				if ($t_c == '2') {
					$dd1 = substr($che, 0, -1);
					$new_str = trim($arry[0]);
					$p_dignosis = '%' . $new_str . '%';
					$p_dignosis_name = $patient->dignosis;
				} else {
					$p_dignosis = '%' . $che . '%';
					$p_dignosis_name = $patient->dignosis;
				}
			}

			if ($patient->manual_status == 0) {
				if ($patient->proxy_id) {
					$tretment = $this->db->select("*")
						->from('treatments1')
						->where('dignosis LIKE', $p_dignosis)
						->where('proxy_id', $patient->proxy_id)
						->where('department_id', $patient->department_id)
						->where('ipd_opd ', $section_tret)
						->get()
						->row();
				} else {
					$tretment = $this->db->select("*")
						->from('treatments1')
						->where('dignosis LIKE', $p_dignosis)
						->where('department_id', $patient->department_id)
						->where('ipd_opd ', $section_tret)
						->get()
						->row();
				}
			} else {
				$tretment = $this->db->select("*")
					->from('manual_treatments')
					->where('patient_id_auto', $patient->id)
					->where('dignosis LIKE', $p_dignosis)
					->where('ipd_opd ', $section_tret)
					->get()
					->row();
				//print_r($this->db->last_query());
				// print_r($this->db->last_query());
			}

			$data['USG'] = $tretment->USG;
			$data['name'] = $patient->firstname;
			$data['yearly_reg_no'] = $patient->yearly_reg_no;
			$data['old_reg_no'] = $patient->old_reg_no;
			$data['id'] = $patient->id;
			$data['dignosis'] = $patient->dignosis;
			$data['ipd_opd'] = $patient->ipd_opd;
			$data['firstname'] = $patient->firstname;
			$data['date_of_birth'] = $patient->date_of_birth;
			$data['sex'] = $patient->sex;
			$data['address'] = $patient->address;
			$data['weight'] = $patient->wieght;
			$data['create_date'] = date("Y-m-d", strtotime($patient->create_date));
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function save_usg_data()
	{
		$patient_auto_id = $this->input->post('patient_auto_id');
		$name = $this->input->post('name');
		$dignosis = $this->input->post('dignosis');
		$section = $this->input->post('section');
		$create_date = ($this->input->post('create_date')) ? $this->input->post('create_date') : NULL;
		$USG = ($this->input->post('USG')) ? $this->input->post('USG') : NULL;
		$usg_result = ($this->input->post('usg_result')) ? $this->input->post('usg_result') : NULL;

		$count_usg = count($USG);



		if ($section == 'opd') {
			$patient_name_table = 'investi_panch_opd_patient_count';
		} else {
			$patient_name_table = 'investi_panch_ipd_patient_count';
		}

		$last_patient = $this->db->select('*')
			->from($patient_name_table)
			->where('patient_auto_id', $patient_auto_id)
			->where('create_date', $create_date)
			->get()
			->row();
		//   print_r($this->db->last_query());

		$last_patient_count = count($last_patient);
		if ($last_patient_count == '1') {
			$id = $last_patient->id;

			// $last_xray_count = $last_patient->xray;
			if ($USG) {
				$last_usg_count = $USG;
			} else {
				$last_usg_count = $last_patient->usg;
			}

			$test_array = array
			(
				'usg' => $last_usg_count,
			);
			$this->db->where('create_date', $create_date);
			$this->db->where('id', $id);
			$this->db->where('patient_auto_id', $patient_auto_id);
			$this->db->update($patient_name_table, $test_array);
			//  print_r($this->db->last_query());
		} else {
			$this->db->set('patient_auto_id', $patient_auto_id);
			$this->db->set('patient_name', $name);
			$this->db->set('ipd_opd', $section);
			$this->db->set('create_date', $create_date);
			$this->db->set('usg', $USG);
			$this->db->set('manual_status', '1');
			$updateRes = $this->db->insert($patient_name_table);
		}

		if ($section == 'opd') {
			$tbl_count_last = 'investi_panch_opd_total_count';
		} else {
			$tbl_count_last = 'investi_panch_ipd_total_count';
		}

		$last_date_count_final = $this->db->select('*')
			->from($tbl_count_last)
			->where('create_date', $create_date)
			->get()
			->row();

		$last_date_patient_count_last = count($last_date_count_final);

		if ($last_date_patient_count_last == '1') {
			$id = $last_date_count_final->id;

			if ($USG) {
				$last_usg_count = $count_usg;
			} else {
				$last_usg_count = $last_date_count_final->usg_count;
			}

			$update_count = array(
				'usg_count' => $last_usg_count,
			);
			$this->db->where('create_date', $create_date);
			$this->db->where('id', $id);
			$updateRes = $this->db->update($tbl_count_last, $update_count);

		} else {

			$update_count = array(

				'ipd_opd' => $section,
				'create_date' => $create_date,
				'usg_count' => $count_ecg,
				'manual_status' => '1',
			);
			$updateRes = $this->db->insert($tbl_count_last, $update_count);
			// $count_data = $this->patient_model->save_panch_data_count($all_count);

		}

		if ($section == 'opd') {
			$tbl_count = 'investi_panch_opd_test_total_count';
		} else {
			$tbl_count = 'investi_panch_ipd_test_total_count';
		}
		$data_last_date = $this->db->select('*')
			->from($tbl_count)
			->where('create_date', $create_date)
			->get()
			->row();
		$data_count = count($data_last_date);
		if ($data_count == 1) {

			$id = $data_last_date->id;
			if ($USG) {
				$last_usg_count = $count_usg;
			} else {
				$last_usg_count = $data_last_date->usg_count;
			}
			$update_count = array(
				'usg_count' => $last_usg_count,
			);
			$this->db->where('create_date', $create_date);
			$this->db->where('id', $id);
			$this->db->update($tbl_count, $update_count);
		} else {
			$this->db->set('ipd_opd', $section);
			$this->db->set('create_date', $create_date);
			$this->db->set('usg_count', $count_usg);
			$this->db->set('manual_status', '1');
			$updateRes = $this->db->insert($tbl_count);
		}

		if ($section == 'opd') {
			$tble_result = 'investi_opd_report_result';
		} else {
			$tble_result = 'investi_ipd_report_result';
		}

		$result_last_date = $this->db->select('*')
			->from($tble_result)
			->where('create_date', $create_date)
			->where('patient_auto_id', $patient_auto_id)
			->get()
			->row();
		$result_count = count($result_last_date);
		if ($result_count == '1') {

			$update_count = array(
				'result' => $ecg_result,
			);
			$this->db->where('create_date', $create_date);
			$this->db->where('id', $id);
			$this->db->where('patient_auto_id', $patient_auto_id);
			$this->db->update($tbl_count, $update_count);

		} else {

			$this->db->set('patient_auto_id', $patient_auto_id);
			$this->db->set('name', $name);
			$this->db->set('dignosis', $dignosis);
			$this->db->set('test_name', $USG);
			$this->db->set('test_type', $USG);
			$this->db->set('report_type', $USG);
			$this->db->set('report_section', $USG);
			$this->db->set('result', $usg_result);
			$this->db->set('ipd_opd', $section);
			$this->db->set('create_date', $create_date);
			$this->db->set('manual_status', '1');
			$updateRes1 = $this->db->insert($tble_result);
		}
		if ($updateRes) {
			$data['status'] = true;
		} else {
			$data['status'] = false;
		}

		echo json_encode($data);

	}





	public function phisiotheropy_patient_original()
	{

		$data['test'] = '1';
		$data['content'] = $this->load->view('phisiotheropy_o_patient', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}
	public function fetch_patient_phisiotheropy()
	{
		$patient = $this->patient_model->fetch_patient_phisiotheropy();
		if ($patient) {
			$data['status'] = true;
			$data['patient_name'] = $patient;
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function fetch_treatment_phisiotheropy()
	{
		$section = $this->input->post('section');
		$patient = $this->patient_model->fetch_treatment_phisiotheropy();



		if ($patient) {
			$data['status'] = true;
			// $data['dignosis'] = $patient->dignosis;
			// $data['section'] = $patient->ipd_opd;


			if ($section == 'ipd') {
				$che = trim($patient->dignosis);
				$section_tret = 'ipd';
				$len = strlen($che);
				$dd = substr($che, $len - 1);
				$str = $patient->dignosis;
				$arry = explode("-", $str);
				$t_c = count($arry);
				if ($t_c == '2') {
					$dd1 = substr($che, 0, -1);
					$new_str = trim($arry[0]);
					$p_dignosis = '%' . $new_str . '%';
					$p_dignosis_name = $patient->dignosis;
				} else {
					$p_dignosis = '%' . $che . '%';
					$p_dignosis_name = $patient->dignosis;
				}
			} else {
				$section_tret = 'opd';
				$che = trim($patient->dignosis);
				$section_tret = 'opd';
				$len = strlen($che);
				$dd = substr($che, $len - 1);
				$str = $patient->dignosis;
				$arry = explode("-", $str);
				$t_c = count($arry);
				if ($t_c == '2') {
					$dd1 = substr($che, 0, -1);
					$new_str = trim($arry[0]);
					$p_dignosis = '%' . $new_str . '%';
					$p_dignosis_name = $patient->dignosis;
				} else {
					$p_dignosis = '%' . $che . '%';
					$p_dignosis_name = $patient->dignosis;
				}
			}

			if ($patient->manual_status == 0) {
				if ($patient->proxy_id) {
					$tretment = $this->db->select("*")
						->from('treatments1')
						->where('dignosis LIKE', $p_dignosis)
						->where('proxy_id', $patient->proxy_id)
						->where('department_id', $patient->department_id)
						->where('ipd_opd ', $section_tret)
						->get()
						->row();
				} else {
					$tretment = $this->db->select("*")
						->from('treatments1')
						->where('dignosis LIKE', $p_dignosis)
						->where('department_id', $patient->department_id)
						->where('ipd_opd ', $section_tret)
						->get()
						->row();
				}
			} else {
				$tretment = $this->db->select("*")
					->from('manual_treatments')
					->where('patient_id_auto', $patient->id)
					->where('dignosis LIKE', $p_dignosis)
					->where('ipd_opd ', $section_tret)
					->get()
					->row();
				//print_r($this->db->last_query());
				// print_r($this->db->last_query());
			}

			$data['PHYSIOTHERAPY'] = $tretment->PHYSIOTHERAPY;
			$data['name'] = $patient->firstname;
			$data['yearly_reg_no'] = $patient->yearly_reg_no;
			$data['old_reg_no'] = $patient->old_reg_no;
			$data['id'] = $patient->id;
			$data['dignosis'] = $patient->dignosis;
			$data['ipd_opd'] = $patient->ipd_opd;
			$data['firstname'] = $patient->firstname;
			$data['date_of_birth'] = $patient->date_of_birth;
			$data['sex'] = $patient->sex;
			$data['address'] = $patient->address;
			$data['weight'] = $patient->wieght;
			$data['create_date'] = date("Y-m-d", strtotime($patient->create_date));
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
	public function save_phisiotheropy_data()
	{
		$patient_auto_id = $this->input->post('patient_auto_id');
		$name = $this->input->post('name');
		$dignosis = $this->input->post('dignosis');
		$section = $this->input->post('section');
		$create_date = ($this->input->post('create_date')) ? $this->input->post('create_date') : NULL;
		$PHYSIOTHERAPY = ($this->input->post('PHYSIOTHERAPY')) ? $this->input->post('PHYSIOTHERAPY') : NULL;
		$PHYSIOTHERAPY_result = ($this->input->post('PHYSIOTHERAPY_result')) ? $this->input->post('PHYSIOTHERAPY_result') : NULL;

		$count_PHYSIOTHERAPY = count($PHYSIOTHERAPY);



		if ($section == 'opd') {
			$patient_name_table = 'investi_panch_opd_patient_count';
		} else {
			$patient_name_table = 'investi_panch_ipd_patient_count';
		}

		$last_patient = $this->db->select('*')
			->from($patient_name_table)
			->where('patient_auto_id', $patient_auto_id)
			->where('create_date', $create_date)
			->get()
			->row();
		//   print_r($this->db->last_query());

		$last_patient_count = count($last_patient);
		if ($last_patient_count == '1') {
			$id = $last_patient->id;

			// $last_xray_count = $last_patient->xray;
			if ($PHYSIOTHERAPY) {
				$last_PHYSIOTHERAPY_count = $PHYSIOTHERAPY;
			} else {
				$last_PHYSIOTHERAPY_count = $last_patient->PHYSIOTHERAPY;
			}

			$test_array = array
			(
				'PHYSIOTHERAPY' => $last_PHYSIOTHERAPY_count,
			);
			$this->db->where('create_date', $create_date);
			$this->db->where('id', $id);
			$this->db->where('patient_auto_id', $patient_auto_id);
			$this->db->update($patient_name_table, $test_array);
			//  print_r($this->db->last_query());
		} else {
			$this->db->set('patient_auto_id', $patient_auto_id);
			$this->db->set('patient_name', $name);
			$this->db->set('ipd_opd', $section);
			$this->db->set('create_date', $create_date);
			$this->db->set('PHYSIOTHERAPY', $PHYSIOTHERAPY);
			$this->db->set('manual_status', '1');
			$updateRes = $this->db->insert($patient_name_table);
		}

		if ($section == 'opd') {
			$tbl_count_last = 'investi_panch_opd_total_count';
		} else {
			$tbl_count_last = 'investi_panch_ipd_total_count';
		}

		$last_date_count_final = $this->db->select('*')
			->from($tbl_count_last)
			->where('create_date', $create_date)
			->get()
			->row();

		$last_date_patient_count_last = count($last_date_count_final);

		if ($last_date_patient_count_last == '1') {
			$id = $last_date_count_final->id;

			if ($PHYSIOTHERAPY) {
				$last_PHYSIOTHERAPY_count = $count_PHYSIOTHERAPY;
			} else {
				$last_PHYSIOTHERAPY_count = $last_date_count_final->PHYSIOTHERAPY_count;
			}

			$update_count = array(
				'PHYSIOTHERAPY_count' => $last_PHYSIOTHERAPY_count,
			);
			$this->db->where('create_date', $create_date);
			$this->db->where('id', $id);
			$updateRes = $this->db->update($tbl_count_last, $update_count);

		} else {

			$update_count = array(

				'ipd_opd' => $section,
				'create_date' => $create_date,
				'PHYSIOTHERAPY_count' => $count_PHYSIOTHERAPY,
				'manual_status' => '1',
			);
			$updateRes = $this->db->insert($tbl_count_last, $update_count);
			// $count_data = $this->patient_model->save_panch_data_count($all_count);

		}

		if ($section == 'opd') {
			$tbl_count = 'investi_panch_opd_test_total_count';
		} else {
			$tbl_count = 'investi_panch_ipd_test_total_count';
		}
		$data_last_date = $this->db->select('*')
			->from($tbl_count)
			->where('create_date', $create_date)
			->get()
			->row();
		$data_count = count($data_last_date);
		if ($data_count == 1) {

			$id = $data_last_date->id;
			if ($PHYSIOTHERAPY) {
				$last_PHYSIOTHERAPY_count = $count_PHYSIOTHERAPY;
			} else {
				$last_PHYSIOTHERAPY_count = $data_last_date->PHYSIOTHERAPY_count;
			}
			$update_count = array(
				'PHYSIOTHERAPY_count' => $last_PHYSIOTHERAPY_count,
			);
			$this->db->where('create_date', $create_date);
			$this->db->where('id', $id);
			$this->db->update($tbl_count, $update_count);
		} else {
			$this->db->set('ipd_opd', $section);
			$this->db->set('create_date', $create_date);
			$this->db->set('PHYSIOTHERAPY_count', $count_PHYSIOTHERAPY);
			$this->db->set('manual_status', '1');
			$updateRes = $this->db->insert($tbl_count);
		}

		if ($section == 'opd') {
			$tble_result = 'investi_opd_report_result';
		} else {
			$tble_result = 'investi_ipd_report_result';
		}

		$result_last_date = $this->db->select('*')
			->from($tble_result)
			->where('create_date', $create_date)
			->where('patient_auto_id', $patient_auto_id)
			->get()
			->row();
		$result_count = count($result_last_date);
		if ($result_count == '1') {

			$update_count = array(
				'result' => $PHYSIOTHERAPY_result,
			);
			$this->db->where('create_date', $create_date);
			$this->db->where('id', $id);
			$this->db->where('patient_auto_id', $patient_auto_id);
			$this->db->update($tble_result, $update_count);

		} else {

			$this->db->set('patient_auto_id', $patient_auto_id);
			$this->db->set('name', $name);
			$this->db->set('dignosis', $dignosis);
			$this->db->set('test_name', $PHYSIOTHERAPY);
			$this->db->set('test_type', $PHYSIOTHERAPY);
			$this->db->set('report_type', $PHYSIOTHERAPY);
			$this->db->set('report_section', $PHYSIOTHERAPY);
			$this->db->set('result', $PHYSIOTHERAPY_result);
			$this->db->set('ipd_opd', $section);
			$this->db->set('create_date', $create_date);
			$this->db->set('manual_status', '1');
			$updateRes1 = $this->db->insert($tble_result);
		}
		if ($updateRes) {
			$data['status'] = true;
		} else {
			$data['status'] = false;
		}

		echo json_encode($data);

	}


	public function profile_sky($patient_id = null)
	{
		$data['title'] = display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->patient_model->read_by_id($patient_id);
		//	print_r($this->db->last_query());
		$data['documents'] = $this->document_model->read_by_patient($patient_id);
		//	print_r($this->db->last_query());
		$data['content'] = $this->load->view('patient_profile_sky', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function closing_stock_tab()
	{
		$data['pharma'] = $this->patient_model->closing_stock_tab();
		$data['pharma_tab'] = $this->patient_model->get_tablet_activated();
		$data['content'] = $this->load->view('closing_stock_tab', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}


	public function fetch_closing_stock()
	{
		$tab21 = $this->patient_model->fetch_closing_stock();
		//print_r($this->db->last_query())    
		if ($tab21) {
			$data['status'] = true;
			$data['unit'] = $tab21->quantity_in;
			$data['agency_name'] = $tab21->agency_name;
			$data['batch_number'] = $tab21->batch_number;
			$data['manufacturing_date'] = $tab21->manufacturing_date;
			$data['expiry_date'] = $tab21->expiry_date;
			$data['stock_added_date'] = $tab21->create_date;

			$closing = $tab21->closing_stock;
			if ($closing == '0') {
				$data['closing_stock'] = $tab21->opening_stock;
			} else {
				$data['closing_stock'] = $tab21->closing_stock;
			}
			//$data['patient_name'] = $tab1; 
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}

	public function midnight()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);

		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);
		$data['section'] = $section;

		$start_date = $start_date2;
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";

		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$date1 = date_create($start_date2);
		$date2 = date_create($end_date2);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");

		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '1';
		}

		if ($section == 'opd') {
			$data['patients'] = $this->db->select("*")
				->from('patient')
				->join('department', 'department.dprt_id =  patient.department_id')
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)
				->where('create_date <=', $end_date)
				->where('create_date LIKE', $year)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {
			$data['patients1'] = $this->db->select("*")
				->from('patient_ipd')
				->join('department', 'department.dprt_id = patient_ipd.department_id')
				->where('discharge_date >=', $start_date_f)
				->where('create_date <=', $start_date_f)
				->where('ipd_opd', 'ipd')
				->or_where('discharge_date', $start_date)
				->where('ipd_opd', 'ipd')
				->get()
				->result();

			//Array 2
			$data['patients2'] = $this->db->select("*")
				->from('patient_ipd')
				->join('department', 'department.dprt_id = patient_ipd.department_id')
				->where('create_date <=', $start_date)
				->where('discharge_date LIKE', '%0000-00-00%')
				->where('ipd_opd', 'ipd')
				->get()
				->result();

			$data['patients'] = array_merge($data['patients1'], $data['patients2']);

			$data['department_by_section'] = 'ipd';

		}

		if ($data == null) {
			$data['content'] = $this->load->view('midnight_register', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		} else {
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('midnight_register', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}


	}

	public function check_patient_new($mode = null)
	{
		//$year = '%'.$this->session->userdata['acyear'].'%';
		$patient_name = $this->input->post('patient_name');
		$acyear = $this->session->userdata('acyear');
		$patient_name_like = '%' . $this->input->post('patient_name') . '%';

		if (!empty($patient_name_like)) {
			$query = $this->db->select('*')
				->from('patient')
				->where('year(create_date)', $acyear)
				//->where('yearly_reg_no', $old_reg_no)
				->where('firstname Like', $patient_name_like)
				->where('status', 1)
				->order_by('create_date', 'DESC')
				->get();
			// ->result();

			// ->result();
			//print_r(get());	
			$result = $query->row();
			/// $result->status;

			//   print_r($this->db->last_query());

			if ($result) {
				//$data['patient1'] = $result->status;
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


	public function get_expiry_tablets()
	{
		$currentdate = date('Y-m-d');
		// $currentdate;
		$tablets = $this->db->select('*')->from('pharma_original_stock')->get()->result();

		foreach ($tablets as $tab) {
			$tab_expiry = $tab->expiry_date;
			// echo '<br>';
			$data['1'] = '1';


			$date = "2012-09-12";

			if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $tab->expiry_date)) {
				$date1 = date("Y-m-d", strtotime($tab_expiry));
				$date2 = date("Y-m-d");
				$date3 = date_create($date1);
				$date4 = date_create($date2);
				$diff = date_diff($date3, $date4);
				$moth = $diff->format("%a");
				$monthDays = $moth + 1;
			}
			if (preg_match("/(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", date('Y-m', strtotime($tab->expiry_date)))) {
				$date1 = date("Y-m", strtotime($tab->expiry_date));
				$date2 = date("Y-m");
				$date3 = date_create($date1);
				$date4 = date_create($date2);
				$diff = date_diff($date4, $date3);
				$moth = $diff->format("%a");
			}
		}
		//$data['content'] = $this->load->view('pharma_list',$data,true);
		// $this->load->view('layout/main_wrapper',$data);
	}


	public function get_monthly_report()
	{
		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);
		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = date('Y-m-d', strtotime($end_date1));
		// $end_date2   = $start_date2;
		// $section = $this->input->get('section', TRUE);
		$data['datefrom'] = $start_date2;
		$data['dateto'] = $end_date2;
		// $data['section'] =$section;

		$data['daily_opening'] = $this->db->select('daily_pharma_patient_stock.tab_name,daily_pharma_patient_stock.daily_opening_bal,daily_pharma_patient_stock.cretate_date,pharma_original_stock.batch_number')
			->from('daily_pharma_patient_stock')
			->join('pharma_original_stock', 'pharma_original_stock.id = daily_pharma_patient_stock.tab_name')
			->where('daily_pharma_patient_stock.cretate_date', $start_date2)
			// ->order_by('id','ASC')
			->get()
			->result();
		//print_r($this->db->last_query());






		$data['content'] = $this->load->view('monthly_original_stock', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}


	public function patient_wise_despense()
	{
		$section = $this->input->get('section');
		$date = date('Y-m-d', strtotime($this->input->get('start_date')));
		$data['pharma_patient'] = $this->db->select('*')
			->from('pharma_original_patient')
			->where('created_at >=', $date)
			->where('created_at <=', $date)
			->where('section', $section)
			->get()
			->result();
		$data['section'] = $section;
		$data['start_date'] = $date;
		//print_r($this->db->last_query());
		$data['pharma'] = $this->patient_model->closing_stock_tab();
		$data['pharma_tab'] = $this->patient_model->get_tablet_activated();
		$data['content'] = $this->load->view('patient_wise_despense', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function fetch_datewise_despense()
	{
		$tab21 = $this->patient_model->fetch_datewise_despense();
		//$tab22   =  $this->patient_model->fetch_datewise_despense_quantity();
		//print_r($this->db->last_query());
		$tab_name_old = $this->input->post('tab_name');

		if ($tab21) {
			$data['status'] = true;
			$data['tab_name_old'] = $tab_name_old;
			$data['patient_with_despense'] = $tab21;
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);


		//$data['all_data'] = $tab21;
		//$data['content'] = $this->load->view('patient_wise_despense',$data,true);
		// $this->load->view('layout/main_wrapper',$data);
	}

	public function get_gob_patient_new()
	{
		$section = 'ipd';
		//$department_id_decode = rawurldecode($department_id);
		$start_date1 = date('Y-m-d');

		//$end_date1   = date('Y-m-d');

		$end_date1 = $start_date1;

		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id_gob($section, $start_date, $end_date);

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$section = $section;
		$data['section'] = $section;

		$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
			->from('patient_ipd')
			->join('department', 'patient_ipd.department_id = department.dprt_id')
			->where('create_date LIKE', $year)
			//->where('department_id', $id)
			->where('ipd_opd', $section)
			->where('discharge_date LIKE', '0000-00-00')
			//	->where('create_date >=', $end_date)

			->where('create_date <=', $end_date)
			->group_by('department.name, patient_ipd.sex')
			->get()
			->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
			->from('patient_ipd')
			->where('create_date LIKE', $year)
			//->where('department_id', $id)
			->where('ipd_opd', $section)
			->where('discharge_date LIKE', '0000-00-00')
			//->where('create_date >=', $end_date)

			->where('create_date <=', $end_date)
			->get()
			->result();
		$data['department_by_section'] = 'ipd';


		$data['department_by'] = 'dpt';
		$data['department_id'] = '';
		$data['flag'] = '1';
		$data['gob'] = 'gob';
		$data['content'] = $this->load->view('patient_gob_new', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function get_gob_patient_new_date()
	{
		// $section='ipd';
		//$department_id_decode = rawurldecode($department_id);

		$start_date1 = $this->input->get('start_date', TRUE);

		//$end_date1   = $this->input->get('end_date', TRUE);
		$end_date1 = $start_date1;
		$id = $this->input->get('dept_id', TRUE);


		$start_date1 = date('Y-m-d', strtotime($start_date1));

		$end_date1 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);
		$data['section'] = $section;

		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['title'] = display('patient_list');
		$year = '%' . $this->session->userdata['acyear'] . '%';
		if ($id) {

			$data['patients'] = $this->patient_model->read_by_gob_dept_date($id, $section, $start_date, $end_date);

			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '%0000-00-00%')
				//	->where('create_date >=', $end_date)

				->where('create_date <=', $end_date)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '0000-00-00')
				//->where('create_date >=', $end_date)

				->where('create_date <=', $end_date)
				->get()
				->result();
			$data['dept_id'] = $id;
		} else {
			$data['patients'] = $this->patient_model->read_by_dept_id_gob($section, $start_date, $end_date);

			$data['patients_new'] = $this->patient_model->read_by_dept_id_gob_new($section, $start_date, $end_date);
			//  print_r($this->db->last_query());

		}

		$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';



		$data['department_by'] = 'dpt';
		$data['department_by_section'] = 'ipd';
		$data['flag'] = '1';
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
		$data['gob'] = 'gob';

		$data['content'] = $this->load->view('patient_gob_new', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}




	public function widal_test_report()
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);
		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = date('Y-m-d', strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
		$start_date = $start_date2;
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;

		if ($section == 'opd') {
			$data['seriology'] = $this->db->select('investi_patient_count_opd.patient_auto_id,
        investi_patient_count_opd.patient_name,
        investi_patient_count_opd.hematology,
        investi_patient_count_opd.ipd_opd,
        patient.date_of_birth,
        patient.yearly_reg_no,
        patient.old_reg_no,
        patient.sex,
        patient.department_id,
        patient.dignosis,
        patient.firstname')
				->from('investi_patient_count_opd')
				->join('investi_opd_report_result', 'investi_opd_report_result.patient_auto_id = investi_patient_count_opd.patient_auto_id')
				->join('patient', 'patient.id = investi_opd_report_result.patient_auto_id')
				->where('investi_opd_report_result.create_date >=', $start_date2)
				->where('investi_opd_report_result.create_date <=', $end_date2)
				->where('investi_patient_count_opd.serology LIKE', '%WIDAL%')
				->where('investi_patient_count_opd.ipd_opd', $section)
				->group_by('investi_patient_count_opd.patient_auto_id,
        investi_patient_count_opd.hematology,
        investi_patient_count_opd.ipd_opd,
        investi_patient_count_opd.patient_name')
				->order_by('investi_patient_count_opd.patient_auto_id')
				->get()
				->result();
			// print_r($this->db->last_query());

		} else {
			$data['seriology'] = $this->db->select('`investi_panch_ipd_patient_count`.`patient_auto_id`,investi_panch_ipd_patient_count.hematology,investi_panch_ipd_patient_count.ipd_opd,investi_panch_ipd_patient_count.patient_name, `patient_ipd`.`date_of_birth`,patient_ipd.yearly_reg_no,patient_ipd.old_reg_no,patient_ipd.sex,patient_ipd.department_id,patient_ipd.dignosis,patient_ipd.firstname')
				->from('investi_ipd_report_result')
				->join('investi_panch_ipd_patient_count', 'investi_panch_ipd_patient_count.patient_auto_id = investi_ipd_report_result.patient_auto_id')
				->join('patient_ipd', 'patient_ipd.id = investi_ipd_report_result.patient_auto_id')
				->where('investi_ipd_report_result.create_date >=', $start_date2)
				->where('investi_ipd_report_result.create_date <=', $end_date2)
				->where('investi_panch_ipd_patient_count.ipd_opd', $section)
				->where('investi_panch_ipd_patient_count.serology LIKE', '%WIDAL%')
				->group_by('`investi_panch_ipd_patient_count`.`patient_auto_id`,investi_panch_ipd_patient_count.hematology,investi_panch_ipd_patient_count.ipd_opd,investi_panch_ipd_patient_count.patient_name')
				->order_by('`investi_panch_ipd_patient_count`.`patient_auto_id`')
				->get()
				->result();


		}


		$data['content'] = $this->load->view('widal_test_report', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}



	public function get_seriology_patient_profile_widal($patient_auto_id = NULL, $section = NULL)
	{

		if ($section == 'opd') {
			$data['serology_profile'] = $this->db
				->select('investi_opd_report_result.test_name,investi_opd_report_result.report_type,investi_opd_report_result.report_section,investi_opd_report_result.unit,investi_opd_report_result.reference_range,investi_opd_report_result.WD_20_RESULT,investi_opd_report_result.WD_40_RESULT,investi_opd_report_result.WD_80_RESULT,investi_opd_report_result.WD_160_RESULT,investi_opd_report_result.WD_320_RESULT,investi_opd_report_result.patient_auto_id,patient.id,patient.sex,patient.date_of_birth')
				->from('investi_opd_report_result')
				->join('patient', 'patient.id = investi_opd_report_result.patient_auto_id')
				->where('investi_opd_report_result.patient_auto_id', $patient_auto_id)
				->get()
				->result();
			// print_r($this->db->last_query());

			$data['serology_pro'] = $this->db->select('distinct(investi_opd_report_result.report_type),investi_opd_report_result.*,patient.id,patient.sex,patient.date_of_birth')
				->from('investi_opd_report_result')
				->join('patient', 'patient.id = investi_opd_report_result.patient_auto_id')
				->where('investi_opd_report_result.patient_auto_id', $patient_auto_id)
				->limit(1)
				->get()
				->result();
			$data['patient_auto_id'] = $patient_auto_id;
		} else {
			$data['serology_profile'] = $this->db
				->select('investi_ipd_report_result.test_name,investi_ipd_report_result.report_type,investi_ipd_report_result.report_section,investi_ipd_report_result.unit,investi_ipd_report_result.reference_range,investi_ipd_report_result.result,investi_ipd_report_result.patient_auto_id,patient_ipd.id,patient_ipd.sex,patient_ipd.date_of_birth')
				->from('investi_ipd_report_result')
				->join('patient_ipd', 'patient_ipd.id = investi_ipd_report_result.patient_auto_id')
				->where('investi_ipd_report_result.patient_auto_id', $patient_auto_id)
				->get()
				->result();
			// print_r($this->db->last_query());
			$data['serology_pro'] = $this->db->select('distinct(investi_ipd_report_result.report_type),investi_ipd_report_result.*,patient_ipd.id,patient_ipd.sex,patient_ipd.date_of_birth')
				->from('investi_ipd_report_result')
				->join('patient_ipd', 'patient_ipd.id = investi_ipd_report_result.patient_auto_id')
				->where('investi_ipd_report_result.patient_auto_id', $patient_auto_id)
				->limit(1)
				->get()
				->result();
			$data['patient_auto_id'] = $patient_auto_id;
		}
		// print_r($this->db->last_query());
		$data['section'] = $section;

		$data['content'] = $this->load->view('seriology_profile_widal', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}







	public function save_ksharsutra()
	{
		$patient_auto_id = $this->input->post('patient_auto_id');
		$kstatus = $this->input->post('kstatus');
		$section = $this->input->post('section');


		$test_array = array
		(
			'kstatus' => $kstatus,
		);
		$this->db->where('id', $patient_auto_id);
		$this->db->where('ipd_opd', $section);
		$updateRes = $this->db->update('patient', $test_array);

		if ($updateRes) {
			$data['status'] = true;
		} else {
			$data['status'] = false;
		}

		echo json_encode($data);
	}

	public function update_ipd_ksharsutra()
	{
		$patient_auto_id = $this->input->post('patient_auto_id');
		$kstatus = $this->input->post('kstatus');
		$k_create_date = date('Y-m-d', strtotime($this->input->post('k_create_date')));
		$section = $this->input->post('section');


		$test_array = array
		(
			'kstatus' => $kstatus,
			'k_create_date' => $k_create_date
		);
		$this->db->where('id', $patient_auto_id);
		$this->db->where('ipd_opd', $section);
		$updateRes = $this->db->update('patient_ipd', $test_array);

		if ($updateRes) {
			$data['status'] = true;
		} else {
			$data['status'] = false;
		}

		echo json_encode($data);
	}




	public function getpatientbydepartment_sky1_netra($department_id = '', $section = '', $netra)
	{

		$department_id_decode = rawurldecode($department_id);
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id($department_id_decode, $section);

		// 		$section = $section;
		//         $data['section'] = $section;
		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {
			$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
				->from('patient')
				->join('department', 'patient.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
				->from('patient')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {

			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 5 days"));
		$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 5 days"));
		$data['department_by'] = 'dpt';
		$data['department_id'] = $department_id_decode;
		$data['netra'] = $netra;

		$data['content'] = $this->load->view('patient_sky1_netra', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}



	public function getpatientbydepartment_sky1_netra_ipd($department_id = '', $section = '', $netra)
	{

		$department_id_decode = rawurldecode($department_id);
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id($department_id_decode, $section);

		// 		$section = $section;
		//         $data['section'] = $section;
		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'ipd') {
			$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
				->from('patient')
				->join('department', 'patient.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
				->from('patient')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		} else {

			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 5 days"));
		$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 5 days"));
		$data['department_by'] = 'dpt';
		$data['department_id'] = $department_id_decode;
		$data['netra'] = $netra;

		$data['content'] = $this->load->view('patient_sky1_netra_ipd', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}



	public function ot_register_stri($section)
	{
		$data['title'] = display('patient_list');

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);
		if (empty($end_date1)) {
			$start_date1 = $this->session->userdata['acyear'] . '-01-01';
			$end_date1 = $this->session->userdata['acyear'] . '-12-31';
		}

		$start_date3 = date('Y-m-d', strtotime($start_date1));
		$end_date3 = date('Y-m-d', strtotime($end_date1));


		$data['patients'] = $this->patient_model->ot_register_stri($section, $start_date3, $end_date3);
		//print_r($this->db->last_query());
		//$data['patients2'] = $this->patient_model->read_by_dept_investi($section='ipd');
		//$data['patients'] =array_merge($data['patients1'],$data['patients2']);
		$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {
			$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
				->from('patient')
				->join('department', 'patient.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('yearly_reg_no!=', '')
				->where('ipd_opd', $section)
				->group_by('department.name, patient.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
				->from('patient')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->where('yearly_reg_no!=', '')
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {

			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = '2019';
		$data['dateto'] = '2019';
		$data['department_by'] = 'dpt';
		//   $data['department_id'] = $department_id_decode;
		$data['content'] = $this->load->view('ot_register_stri', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}


	public function ot_register_stri_new_111()
	{
		$data['title'] = display('patient_list');

		$section = $this->input->get('section', TRUE);

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);
		if (empty($end_date1)) {
			$start_date1 = $this->session->userdata['acyear'] . '-01-01';
			$end_date1 = $this->session->userdata['acyear'] . '-12-31';
		}

		$start_date3 = date('Y-m-d', strtotime($start_date1));
		$end_date3 = date('Y-m-d', strtotime($end_date1));


		$data['patients'] = $this->patient_model->ot_register_stri($section, $start_date3, $end_date3);
		//  print_r($this->db->last_query());
		//$data['patients2'] = $this->patient_model->read_by_dept_investi($section='ipd');
		//$data['patients'] =array_merge($data['patients1'],$data['patients2']);
		$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {
			$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
				->from('patient')
				->join('department', 'patient.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('yearly_reg_no!=', '')
				->where('ipd_opd', $section)
				->group_by('department.name, patient.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
				->from('patient')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->where('yearly_reg_no!=', '')
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {

			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = '2019';
		$data['dateto'] = '2019';
		$data['department_by'] = 'dpt';
		//   $data['department_id'] = $department_id_decode;
		$data['content'] = $this->load->view('ot_register_stri', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}





	public function diet_sheet()
	{
		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('start_date', TRUE);
		$section = $this->input->get('section', TRUE);
		$start_date1 = date('Y-m-d', strtotime($start_date1));
		$end_date1 = date('Y-m-d', strtotime($end_date1));

		$start_date = $start_date1 . " 00:00:00";
		$end_date = $start_date;
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;

		$patient = $this->db->select('*')->from('patient_ipd')
			->where('create_date <=', $start_date)
			->group_start()
			->where('discharge_date >=', $start_date)
			->or_where('discharge_date LIKE', '%0000-00-00%')
			->group_end()
			->where('ipd_opd', $section)
			->get()
			->result();

		$data['patients'] = $patient;
		$data['content'] = $this->load->view('diet_sheet', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}



	public function diet_sheet_new()
	{
		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('start_date', TRUE);
		$section = $this->input->get('section', TRUE);
		$start_date1 = date('Y-m-d', strtotime($start_date1));
		$end_date1 = date('Y-m-d', strtotime($end_date1));

		$start_date = $start_date1 . " 00:00:00";
		$end_date = $start_date;
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;

		$data['department'] = $this->db->select('*')->from('department')->where('dprt_id !=', '35')->where('dprt_id !=', '28')->where('dprt_id !=', '27')->get()->result();



		// $data['patients'] = $patient;
		$data['content'] = $this->load->view('diet_sheet_new', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}



	public function view_diet_sheet($id)
	{

		$patient = $this->db->select('*')->from('patient_ipd')
			->where('id', $id)
			->where('ipd_opd', 'ipd')
			->get()
			->row();

		$data['patients'] = $patient;
		$data['content'] = $this->load->view('view_diet_sheet', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}



	public function getpatientbydepartment_date_sky1_netra_ipd()
	{


		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);

		$netra = $this->input->get('netra', TRUE);
		//$end_date1 = $start_date1;
		$id = $this->input->get('dept_id', TRUE);


		$start_date1 = date('Y-m-d', strtotime($start_date1));

		$end_date1 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);


		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['netra'] = $netra;

		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id_date($id, $section, $start_date, $end_date);



		$section = $section;
		//$data['section'] = $section;
		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'ipd') {
			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();


			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {

			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '0000-00-00')
				//	->where('create_date >=', $end_date)

				->where('create_date <=', $end_date)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '0000-00-00')
				//->where('create_date >=', $end_date)

				->where('create_date <=', $end_date)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
		$data['department_by'] = 'dpt';
		$data['department_id'] = $id;

		$data['content'] = $this->load->view('patient_sky1_netra_ipd', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}




	public function getpatientbydepartment_date_sky1_netra()
	{


		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);

		$netra = $this->input->get('netra', TRUE);
		//$end_date1 = $start_date1;
		$id = $this->input->get('dept_id', TRUE);


		$start_date1 = date('Y-m-d', strtotime($start_date1));

		$end_date1 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);


		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['netra'] = $netra;

		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id_date($id, $section, $start_date, $end_date);



		$section = $section;
		//$data['section'] = $section;
		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {
			$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
				->from('patient')
				->join('department', 'patient.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)
				->group_by('department.name, patient.sex')
				->get()
				->result();


			$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
				->from('patient')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)

				->where('create_date <=', $end_date)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {

			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '0000-00-00')
				//	->where('create_date >=', $end_date)

				->where('create_date <=', $end_date)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '0000-00-00')
				//->where('create_date >=', $end_date)

				->where('create_date <=', $end_date)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
		$data['department_by'] = 'dpt';
		$data['department_id'] = $id;

		$data['content'] = $this->load->view('patient_sky1_netra', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}

	public function patient_summery_d($section = '')
	{

		$year = '%' . $this->session->userdata['acyear'] . '%';

		$start_date1 = $this->input->get('start_date', TRUE);

		//$end_date1   = $this->input->get('end_date', TRUE);
		$end_date1 = $start_date1;
		//$data['section'] = $section;

		$start_date2 = date('Y-m-d', strtotime($start_date1));

		$end_date2 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);
		$data['section'] = $section;
		$start_date = $start_date2;
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";

		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$date1 = date_create($start_date2);
		$date2 = date_create($end_date2);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '1';
		}

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$Cyear = $this->session->userdata['acyear'];

		// Determine the department table based on the academic year
		if ($Cyear == '2025') {
			$departmentTable = 'department_new';
		} else {
			$departmentTable = 'department';
		}


		if ($section == 'opd') {
			$data['patients'] = $this->db->select("*")
				->from('patient')
				->where('ipd_patient_flag', '0')
				->join($departmentTable, "$departmentTable.dprt_id = patient.department_id")
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)
				->where('create_date <=', $end_date)
				->where('create_date LIKE', $year)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		}


		if ($data == null) {
			$data['content'] = $this->load->view('patient_summery_D', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		} else {
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patient_summery_D', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}


	}

	public function getpatientbydepartment_gob1_d()
	{
		$section = 'ipd';
		//$department_id_decode = rawurldecode($department_id);
		$start_date1 = date('Y-m-d');

		//$end_date1   = date('Y-m-d');

		$end_date1 = $start_date1;

		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id_gob($section, $start_date, $end_date);

		$year = '%' . $this->session->userdata['acyear'] . '%';
		$section = $section;
		$data['section'] = $section;

		$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
			->from('patient_ipd')
			->join('department', 'patient_ipd.department_id = department.dprt_id')
			->where('create_date LIKE', $year)
			//->where('department_id', $id)
			->where('ipd_opd', $section)
			->where('discharge_date LIKE', '0000-00-00')
			//	->where('create_date >=', $end_date)

			->where('create_date <=', $end_date)
			->group_by('department.name, patient_ipd.sex')
			->get()
			->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
			->from('patient_ipd')
			->where('create_date LIKE', $year)
			//->where('department_id', $id)
			->where('ipd_opd', $section)
			->where('discharge_date LIKE', '0000-00-00')
			//->where('create_date >=', $end_date)

			->where('create_date <=', $end_date)
			->get()
			->result();
		$data['department_by_section'] = 'ipd';


		$data['department_by'] = 'dpt';
		$data['department_id'] = '';
		$data['flag'] = '1';
		$data['gob'] = 'gob';
		$data['content'] = $this->load->view('patientgob_new_D', $data, true);

		$this->load->view('layout/main_wrapper', $data);
	}



	public function getpatientbydepartment_gob_date1_d()
	{
		// $section='ipd';
		//$department_id_decode = rawurldecode($department_id);

		$start_date1 = $this->input->get('start_date', TRUE);

		//$end_date1   = $this->input->get('end_date', TRUE);
		$end_date1 = $start_date1;
		$id = $this->input->get('dept_id', TRUE);


		$start_date1 = date('Y-m-d', strtotime($start_date1));

		$end_date1 = date('Y-m-d', strtotime($end_date1));

		$section = $this->input->get('section', TRUE);
		$data['section'] = $section;

		$start_date = $start_date1 . " 00:00:00";
		$end_date = $end_date1 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['title'] = display('patient_list');
		$year = '%' . $this->session->userdata['acyear'] . '%';
		if ($id) {

			$data['patients'] = $this->patient_model->read_by_gob_dept_date($id, $section, $start_date, $end_date);

			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '%0000-00-00%')
				//	->where('create_date >=', $end_date)

				->where('create_date <=', $end_date)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('department_id', $id)
				->where('ipd_opd', $section)
				->where('discharge_date LIKE', '0000-00-00')
				//->where('create_date >=', $end_date)

				->where('create_date <=', $end_date)
				->get()
				->result();
			$data['dept_id'] = $id;
		} else {
			$data['patients'] = $this->patient_model->read_by_dept_id_gob($section, $start_date, $end_date);

		}

		$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';



		$data['department_by'] = 'dpt';
		$data['department_by_section'] = 'ipd';
		$data['flag'] = '1';
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
		$data['gob'] = 'gob';

		$data['content'] = $this->load->view('patientgob_new_D', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}


	public function new_occupancy_report_new()
	{
		$Cyear = $this->session->userdata['acyear'];
		$currentYear = date('Y');

		// Handle Start Date
		$start_date1 = $this->input->get('start_date', TRUE);
		$start_date = empty($start_date1) ? "$Cyear-01-01" : date('Y-m-d', strtotime($start_date1));

		// Handle End Date
		$end_date1 = $this->input->get('end_date', TRUE);
		if (empty($end_date1)) {
			$end_date = ($Cyear == $currentYear) ? date("Y-m-d") : "$Cyear-12-31";
		} else {
			$end_date = date('Y-m-d', strtotime($end_date1));
		}

		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		// Generate Date Sequence
		$dateArray = [];
		for ($currentDate = strtotime($start_date); $currentDate <= strtotime($end_date); $currentDate += 86400) {
			$dateArray[] = date('Y-m-d', $currentDate);
		}
		$data['dateseq'] = $dateArray;

		// Select appropriate department table
		$departmentTable = ($Cyear >= '2025') ? 'department_new' : 'department';

		// Define excluded department IDs based on the year
		$excludedIds = ['28', '35', '37'];
		if ($Cyear == '2022' || $Cyear == '2023') {
			$excludedIds[] = '27';
		}

		// Fetch department data
		$data['department'] = $this->db->select('*')
			->from($departmentTable)
			->where_not_in('dprt_id', $excludedIds)
			->get()
			->result();

		// Load the view
		$data['content'] = $this->load->view('new_occupancy_report_new', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}



	public function netra_mukh_report($netra)
	{
		if (empty($netra)) {
			$netra = $this->input->get('netra');
		} else {
			$netra = $netra;
		}

		if (empty($this->input->get('start_date'))) {
			$start_date = date("Y-m-d");
		} else {
			$start_date = date('Y-m-d', strtotime($this->input->get('start_date')));
		}

		if (empty($this->input->get('end_date'))) {
			$end_date = date("Y-m-d");
		} else {
			$end_date = date('Y-m-d', strtotime($this->input->get('end_date')));
		}

		if ($netra == 'netra') {
			$nm = 'N';
		} else {
			$nm = 'M';
		}

		$data['netra'] = $nm;
		$data['department_id'] = '30';
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['patients'] = $this->db->select('*')
			->from('patient')
			->where('ipd_opd', 'opd')
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('department_id', '30')
			->get()
			->result();

		$data['content'] = $this->load->view('netra_mukh_report', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}

	public function netra_mukh_report_report()
	{

		$netra = $this->input->get('netra');
		$year = $this->session->userdata['acyear'];

		if (empty($this->input->get('start_date'))) {
			$start_date11 = date("Y-m-d");
		} else {
			$start_date11 = date('Y-m-d', strtotime("-1day" . $this->input->get('start_date')));
		}


		if (empty($this->input->get('start_date'))) {
			$start_date = date("Y-m-d");
		} else {
			$start_date = date('Y-m-d', strtotime($this->input->get('start_date')));
		}

		if (empty($this->input->get('end_date'))) {
			$end_date = date("Y-m-d");
		} else {
			$end_date = date('Y-m-d', strtotime($this->input->get('end_date')));
		}

		if ($netra == 'N') {
			$nm = 'N';
		} else {
			$nm = 'M';
		}
		#print_r($nm);die();
		$data['netra'] = $nm;
		$data['department_id'] = '30';
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['ipd'] = 'opd';
		$data['patients'] = $this->db->select('*')
			->from('patient')
			->where('ipd_opd', 'opd')
			->where('create_date >=', $start_date)
			->where('create_date <=', $end_date)
			->where('department_id', '30')
			->get()
			->result();


		$patients_yearly = $this->db->select('*')
			->from('patient')
			->where('ipd_opd', 'opd')
			->where('create_date <=', $start_date11)
			->where('year(create_date)', $year)
			->where('department_id', '30')
			->get()
			->result();

		// print_r($this->db->last_query());
		$mukha_netra_cnt_old_y = 0;

		foreach ($patients_yearly as $patient) {

			$year = $this->session->userdata['acyear'];

			$start_date_new = $year . '-01-01';

			$datefrom1 = date('Y-m-d', strtotime($start_date));
			$year1 = $this->session->userdata['acyear'];
			$year2 = '%' . $year1 . '%';
			$ddd = date('Y-m-d', strtotime("-1day" . $datefrom1));


			$section_tret = 'opd';
			$che = trim($patient->dignosis);
			$section_tret = 'opd';
			$len = strlen($che);
			$dd = substr($che, $len - 1);

			$str = $patient->dignosis;
			$arry = explode("-", $str);
			$t_c = count($arry);
			if ($t_c == '2') {
				$dd1 = substr($che, 0, -1);

				$p_dignosis = '%' . $arry[0] . '%';
				trim($p_dignosis);
				$p_dignosis_name = $patient->dignosis;
			} else {
				//echo $dd;

				$p_dignosis = '%' . $che . '%';
				$p_dignosis_name = $patient->dignosis;


			}



			if ($patient->manual_status == 0) {
				if ($patient->proxy_id) {


					$tretment = $this->db->select("*")

						->from('treatments1')
						->where('dignosis LIKE', $p_dignosis)
						->where('proxy_id', $patient->proxy_id)
						->where('department_id', $patient->department_id)
						->where('ipd_opd ', $section_tret)
						->where('skya', $nm)
						->get()
						->row();
				} else {

					$tretment = $this->db->select("*")

						->from('treatments1')
						->where('dignosis LIKE', $p_dignosis)
						->where('department_id', $patient->department_id)
						->where('ipd_opd ', $section_tret)
						->where('skya', $nm)
						->get()
						->row();

					if (empty($tretment)) {
						$tretment = $this->db->select("*")
							->from('treatments1')
							->where('department_id', $patient->department_id)
							->where('ipd_opd', $patient->department_id)
							->where('skya', $nm)
							->get()
							->row();

					}
				}
			} else {
				$tretment = $this->db->select("*")

					->from('manual_treatments')
					->where('patient_id_auto', $patient->id)
					//  ->where('dignosis LIKE',$p_dignosis)
					//  ->where('ipd_opd ',$section_tret)
					->where('skya', $nm)
					->get()
					->row();
			}


			//    $skya= $tretment->skya;

			###
			if ($tretment !== null) {
				if ($tretment->skya) {

					$mukha_netra_cnt_old_y += 1;

				} else {
					$mukha_netra_cnt_old_y += 0;
				}


			}
			##


		}
		$data['mukha_netra_cnt_old_y'] = $mukha_netra_cnt_old_y;







		$monthOF_DATE = date("m", strtotime($start_date));
		$new_date_for_month = $year . '-' . $monthOF_DATE . '-01';
		$patients_monthly = $this->db->select('*')
			->from('patient')
			->where('ipd_opd', 'opd')
			->where('create_date >=', $new_date_for_month)
			->where('create_date <=', $start_date11)
			->where('year(create_date)', $year)
			->where('department_id', '30')
			->get()
			->result();
		// print_r($this->db->last_query());
		$mukha_netra_cnt_old_m = 0;

		foreach ($patients_monthly as $patient) {

			$year = $this->session->userdata['acyear'];

			$start_date_new = $year . '-01-01';

			$datefrom1 = date('Y-m-d', strtotime($start_date));
			$year1 = $this->session->userdata['acyear'];
			$year2 = '%' . $year1 . '%';
			$ddd = date('Y-m-d', strtotime("-1day" . $datefrom1));


			$section_tret = 'opd';
			$che = trim($patient->dignosis);
			$section_tret = 'opd';
			$len = strlen($che);
			$dd = substr($che, $len - 1);

			$str = $patient->dignosis;
			$arry = explode("-", $str);
			$t_c = count($arry);
			if ($t_c == '2') {
				$dd1 = substr($che, 0, -1);

				$p_dignosis = '%' . $arry[0] . '%';
				trim($p_dignosis);
				$p_dignosis_name = $patient->dignosis;
			} else {
				//echo $dd;

				$p_dignosis = '%' . $che . '%';
				$p_dignosis_name = $patient->dignosis;


			}



			if ($patient->manual_status == 0) {
				if ($patient->proxy_id) {


					$tretment = $this->db->select("*")

						->from('treatments1')
						->where('dignosis LIKE', $p_dignosis)
						->where('proxy_id', $patient->proxy_id)
						->where('department_id', $patient->department_id)
						->where('ipd_opd ', $section_tret)
						->where('skya', $nm)
						->get()
						->row();
				} else {

					$tretment = $this->db->select("*")

						->from('treatments1')
						->where('dignosis LIKE', $p_dignosis)
						->where('department_id', $patient->department_id)
						->where('ipd_opd ', $section_tret)
						->where('skya', $nm)
						->get()
						->row();

					if (empty($tretment)) {
						$tretment = $this->db->select("*")
							->from('treatments1')
							->where('department_id', $patient->department_id)
							->where('ipd_opd', $patient->department_id)
							->where('skya', $nm)
							->get()
							->row();

					}
				}
			} else {
				$tretment = $this->db->select("*")

					->from('manual_treatments')
					->where('patient_id_auto', $patient->id)
					//  ->where('dignosis LIKE',$p_dignosis)
					//  ->where('ipd_opd ',$section_tret)
					->where('skya', $nm)
					->get()
					->row();
			}


			//    $skya= $tretment->skya;

			###
			if ($tretment !== null) {
				if ($tretment->skya) {

					$mukha_netra_cnt_old_m += 1;

				} else {
					$mukha_netra_cnt_old_m += 0;
				}


			}
			##


		}
		$data['mukha_netra_cnt_old_m'] = $mukha_netra_cnt_old_m;



		$data['content'] = $this->load->view('netra_mukh_report', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}


	public function getpatientby_month_new($section = '')
	{
		error_reporting(0);
		ini_set('memory_limit', '-1');

		$data['title'] = 'Monthly Report';

		$month_start = $this->input->get('start_month', TRUE);
		$month_end = $this->input->get('end_month', TRUE);
		$year_start = $this->input->get('start_year', TRUE);
		$year_end = $this->input->get('end_year', TRUE);
		$year = '%' . $this->session->userdata['acyear'] . '%';

		if (empty($month_start) && empty($month_end)) {
			$patients = $this->patient_model->read_by_dept_month($section, $year);
		} else {
			$start_date = $year_start . '-' . $month_start . '-01';
			$end_date = date('Y-m-t', strtotime($year_end . '-' . $month_end . '-01')); // Get last day of the month
			$patients = $this->patient_model->read_by_dept_month_new($section, $start_date, $end_date);
		}

		// echo "<pre>";
		// print_r($patients);
		// echo "</pre>";
		// die();

		if ($section == 'opd') {
			$departments = $this->patient_model->get_all_dept();
		} else {
			$departments = $this->db->select("*")->from("department")->where_not_in('dprt_id', [28, 35])->get()->result();
		}

		//print_r($this->db->last_query()); die();

		$department_data = [];
		foreach ($departments as $dept) {
			$department_data[$dept->dprt_id] = [
				'name' => $dept->name,
				'data' => []
			];
		}

		//print_r($department_data); die();

		foreach ($patients as $patient) {
			$month = date('Y-m', strtotime($patient->create_date));
			$dept_id = $patient->department_id;

			if (!isset($department_data[$dept_id]['data'][$month])) {
				$department_data[$dept_id]['data'][$month] = 0;
			}
			$department_data[$dept_id]['data'][$month]++;
		}

		$data['date_from'] = $start_date ?? null;
		$data['date_to'] = $end_date ?? null;
		$data['section'] = $section;
		$data['department_data'] = $department_data;
		$data['start_year'] = $year_start;
		$data['start_month'] = $month_start;
		$data['end_year'] = $year_end;
		$data['end_month'] = $month_end;

		$data['content'] = $this->load->view('patient_month_report_new', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}
	public function new_occupancy_report_new_report()
	{
		// Retrieve input parameters
		$month_start = $this->input->get('start_month', TRUE);
		$month_end = $this->input->get('end_month', TRUE);
		$year_start = $this->input->get('start_year', TRUE);
		$year_end = $this->input->get('end_year', TRUE);

		// Default to current date if parameters are empty
		if (empty($month_start) || empty($month_end) || empty($year_start) || empty($year_end)) {
			$start_date = date('Y-m-01');
			$end_date = date('Y-m-t');
		} else {
			$start_date = $year_start . '-' . $month_start . '-01';
			$end_date = date('Y-m-t', strtotime($year_end . '-' . $month_end . '-01'));
		}

		// Initialize date range
		$startDate = new DateTime($start_date);
		$endDate = new DateTime($end_date);
		$endDate->modify('last day of this month');

		$dates = [];
		$currentDate = $startDate;

		// Generate list of months from startDate to endDate
		while ($currentDate <= $endDate) {
			$dates[] = $currentDate->format('Y-m'); // Format date as 'Y-m'
			$currentDate->modify('first day of next month');
		}

		// Retrieve department data
		$departments = $this->db->select('*')
			->from('department')
			->where('dprt_id !=', '28')
			->where('dprt_id !=', '35')
			->get()
			->result();

		// Prepare data for view
		$data['dates'] = $dates;
		$data['departments'] = $departments;
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		// Load view with data
		$data['content'] = $this->load->view('new_occupancy_report_new_report', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}



	public function anesthesia_register()
	{
		$data['title'] = display('patient_information');
		#-------------------------------#
		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);

		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = date('Y-m-d', strtotime($end_date1));
		$section = $this->input->get('section', TRUE);


		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";

		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;


		if ($section == 'opd') {
			$data['patients'] = $this->db->select('*')
				->from('patient')
				->where('create_date >=', $start_date2)
				->where('create_date <=', $end_date2)
				->where('department_id', '31')
				->where('ipd_opd', $section)
				->get()
				->result();
		} else {
			$data['patients'] = $this->db->select('*')
				->from('patient_ipd')
				->where('create_date >=', $start_date2)
				->where('create_date <=', $end_date2)
				->where('department_id', '31')
				->where('ipd_opd', $section)
				->get()
				->result();
		}


		$data['content'] = $this->load->view('anesthesia', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}



	public function case_paper_print_opd_blank($section = '')
	{
		$data['title'] = display('patient_list');

		$data['date'] = (object) $getData = array(
			'start_date' => date('Y-m-d', strtotime(($this->input->post('start_date', true) != null) ? $this->input->post('start_date', true) : date('Y-m-d'))),
			'end_date' => date('Y-m-d', strtotime(($this->input->post('end_date', true) != null) ? $this->input->post('end_date', true) : date('Y-m-d'))),

		);
		$date_c = date('Y-m-d', strtotime("+ 5 days"));
		$data['patients'] = $this->patient_model->read_by_section($section);
		$data['check_data'] = $this->patient_model->read_by_check_data($section, $date_c);

		//	echo count($data['patients'] );exit;
		$section = $section;
		$data['section'] = $section;
		// $end_date= $start_date;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'ipd') {

			date_default_timezone_set('Asia/kolkata');
			$data['department_by_section'] = 'ipd';
			$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
			$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
			$data['gobs'] = 'gobs';

			$data['content'] = $this->load->view('case_paper_print_blank', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		} else {

			date_default_timezone_set('Asia/kolkata');
			$data['department_by_section'] = 'opd';
			$data['datefrom'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));
			$data['dateto'] = $ADV_DAY = date('Y-m-d', strtotime("+ 0 days"));


			$data['content'] = $this->load->view('case_paper_print_blank', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}
	}



	public function case_paper_print_date_blank()
	{



		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		//$end_date1   = $this->input->get('end_date', TRUE);
		$end_date1 = $start_date1;
		$start_date2 = date('Y-m-d', strtotime($start_date1));
		$end_date2 = date('Y-m-d', strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
		$data['section'] = $section;

		$start_date = $start_date2 . " 00:00:00";
		$start_date_f = $start_date2 . " 23:59:00";
		$end_date = $end_date2 . " 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$date1 = date_create($start_date2);
		$date2 = date_create($end_date2);
		$diff = date_diff($date1, $date2);
		$diff = $diff->format("%a");
		if ($diff == 0) {
			$data['summery_report'] = '0';
		} else {
			$data['summery_report'] = '1';
		}

		//echo $section;

		if ($section == 'opd') {
			$data['patients'] = $this->db->select("*")
				->from('patient')
				->join('department', 'department.dprt_id =  patient.department_id')
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)
				->where('create_date <=', $end_date)
				->where('yearly_reg_no !=', '')
				->where('create_date LIKE', $year)
				->get()
				->result();

			$data['department_by_section'] = 'opd';
		} else {

			$data['patients'] = $this->db->select("*")
				->from('patient_ipd')
				->join('department', 'department.dprt_id =  patient_ipd.department_id')
				->where('ipd_opd', $section)
				->where('create_date >=', $start_date)
				->where('create_date <=', $end_date)
				->where('create_date LIKE', $year)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}


		if ($data == null) {
			if ($section == 'opd') {
				$data['content'] = $this->load->view('case_paper_print_opd_blank', $data, true);
				$this->load->view('layout/main_wrapper', $data);
			} else {
				$data['content'] = $this->load->view('case_paper_print_ipd_blank', $data, true);
				$this->load->view('layout/main_wrapper', $data);
			}
		} else {
			if ($section == 'opd') {
				$data['content'] = $this->load->view('case_paper_print_opd_blank', $data, true);
				$this->load->view('layout/main_wrapper', $data);

			} else {
				$data['content'] = $this->load->view('case_paper_print_ipd_blank', $data, true);
				$this->load->view('layout/main_wrapper', $data);
			}
		}

	}



	public function xray_count_monthwise($section = '')
	{
		if (empty($this->input->get('section', TRUE))) {
			$section = $section;
		} else {
			$section = $this->input->get('section', TRUE);
		}
		$Cyear = $this->session->userdata['acyear'];
		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1 = $this->input->get('end_date', TRUE);

		if (empty($start_date1)) {
			$start_date = $Cyear . '-01-01';
		} else {
			$start_date = date('Y-m-d', strtotime($start_date1));
		}

		if (empty($end_date1)) {
			$CURRENT_YEAR = date('Y');
			if ($Cyear == $CURRENT_YEAR) {
				$end_date = date("Y-m-d");
			} else {
				$end_date = $Cyear . '-12-31';
			}
		} else {
			$end_date = date('Y-m-d', strtotime($end_date1));
		}

		$data['Cyear'] = $Cyear;

		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		// Determine table based on the section
		$table = ($section === 'ipd') ? 'xray_patient_count_ipd' : 'xray_patient_count_opd';

		// Pass section to the view
		$data['section'] = $section;
		$data['table'] = $table;

		// Fetch the academic year
		$year = $this->session->userdata('acyear');

		// Ensure $year is valid before proceeding
		// Fetch distinct X-ray data for the selected year
		$data['XrayData'] = $this->db->select('DISTINCT(xray) as Xray_data')
			->from($table) // Use dynamic table name
			->where('YEAR(create_date)', $year)
			->get()
			->result();

		// Load the view with the data
		$data['content'] = $this->load->view('xray_count_monthwise', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function bed_occupancy_new()
	{
		$year = '%' . $this->session->userdata['acyear'] . '%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('start_date', TRUE);
		$section = $this->input->get('section', TRUE);
		$start_date1 = date('Y-m-d', strtotime($start_date1));
		$end_date1 = date('Y-m-d', strtotime($end_date1));

		$start_date = $start_date1 . " 00:00:00";
		$end_date = $start_date;
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;

		$data['department'] = $this->db->select('*')->from('department')->where('dprt_id !=', '35')->where('dprt_id !=', '28')->where('dprt_id !=', '27')->get()->result();



		// $data['patients'] = $patient;
		$data['content'] = $this->load->view('bed_occupancy', $data, true);
		$this->load->view('layout/main_wrapper', $data);

	}



	public function suvarna_prashana($section)
	{

		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dignosis_suvarn($section);
		$section = $section;
		$year = '%' . $this->session->userdata['acyear'] . '%';
		if ($section == 'opd') {
			$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
				->from('patient')
				->join('department', 'patient.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient.sex')
				->get()
				->result();
			$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
				->from('patient')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'opd';
		} else {
			$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
				->from('patient_ipd')
				->join('department', 'patient_ipd.department_id = department.dprt_id')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->group_by('department.name, patient_ipd.sex')
				->get()
				->result();

			$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
				->from('patient_ipd')
				->where('create_date LIKE', $year)
				->where('ipd_opd', $section)
				->get()
				->result();
			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = '2019';
		$data['dateto'] = '2019';
		$data['department_by'] = 'dpt';
		if ($section == 'opd') {
			$data['content'] = $this->load->view('suvarna_prashan', $data, true);
		}
		$this->load->view('layout/main_wrapper', $data);
	}


	public function suvarna_prashana_camp($section)
	{

		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dignosis_suvarn($section);

		$section = $section;

		$year = '%' . $this->session->userdata['acyear'] . '%';

		if ($section == 'opd') {
			$data['department_by_section'] = 'opd';
		} else {
			$data['department_by_section'] = 'ipd';
		}
		$data['datefrom'] = '2019';
		$data['dateto'] = '2019';
		$data['department_by'] = 'dpt';
		if ($section == 'opd') {
			$data['content'] = $this->load->view('suvarna_prashan', $data, true);
		}
		$this->load->view('layout/main_wrapper', $data);
	}



	public function patient_despensing_2025_new()
	{
		// Retrieve the start date from the input
		$start_date = $this->input->get('start_date', TRUE)
			? date('Y-m-d', strtotime($this->input->get('start_date', TRUE)))
			: '';
		$end_date = $this->input->get('end_date', TRUE)
			? date('Y-m-d', strtotime($this->input->get('end_date', TRUE)))
			: '';

		$section = $this->input->get('section', TRUE)
			? $this->input->get('section', TRUE)
			: 'opd';

		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;

		$patients = $this->patient_model->patient_despensing_2025($start_date, $end_date, $section);
		// print_r($this->db->last_query());

		$patientData = array();

		foreach ($patients as $pt) {
			$symptoms = '';

			if ($pt->manual_status == 0) {
				$treatment = $this->db->select('*')
					->from('treatments1')
					->where('department_id', $pt->department_id)
					->where('proxy_id', $pt->proxy_id)
					->where('ipd_opd', 'opd')
					// ->where('m_f', $pt->sex)
					->where('dignosis', $pt->dignosis)
					->get()
					->row();
				// print_r($this->db->last_query());
				$symptoms = isset($treatment->sym_name) ? $treatment->sym_name : '';
			} else {
				$treatment = $this->db->select('*')
					->from('manual_treatments')
					->where('ipd_opd', 'opd')
					->where('patient_id_auto', $pt->id)
					->get()
					->row();

				$symptoms = isset($pt->sys_name) ? $pt->sys_name : '';
			}

			$patientData[] = array(
				'patient_id' => $pt->id,
				'symptoms' => $symptoms
			);
		}

		$data['patients'] = $patients;
		$data['patientData'] = $patientData;

		$data['content'] = $this->load->view('patient_despensing_2025_new', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}












	public function patho_count_monthwise($section = '')
	{
		error_reporting(0);
		$data = [];

		if ($this->input->get('section', TRUE)) {
			$section = $this->input->get('section', TRUE);
		}
		$data['section'] = $section;

		$Cyear = $this->session->userdata('acyear');
		$data['Cyear'] = $Cyear;

		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $this->input->get('end_date', TRUE);

		if (empty($start_date1)) {
			$start_date = $Cyear . '-01-01';
		} else {
			$start_date = date('Y-m-d', strtotime($start_date1));
		}

		if (empty($end_date1)) {
			$CURRENT_YEAR = date('Y');
			if ($Cyear == $CURRENT_YEAR) {
				$end_date = date("Y-m-d");
			} else {
				$end_date = $Cyear . '-12-31';
			}
		} else {
			$end_date = date('Y-m-d', strtotime($end_date1));
		}

		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$data['table'] = ($section === 'ipd') ? 'investi_patient_count_ipd' : 'investi_patient_count_opd';

		$table = $data['table'];
		$year = $Cyear;

		$data['content'] = $this->load->view('patho_count_monthwise', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}



	public function update_ipd_number()
	{
		echo $Cyear = $this->session->userdata('acyear');
		echo "<br>";
		$patients = $this->db->select('*')->from('patient_ipd')->where('year(create_date)', $Cyear)->order_by('id', 'asc')->get()->result();
		$n = 1;
		for ($i = 0; $i < count($patients); $i++) {
			echo $patients[$i]->id . '=>' . $n;
			echo "<br>";

			$array = array(
				'ipd_no_new' => $n,

			);

			$this->db->where('id', $patients[$i]->id);
			$this->db->update('patient_ipd', $array);
			$n++;
		}

	}

}
