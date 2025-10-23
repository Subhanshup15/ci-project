<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PatientNew extends CI_Controller 
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

   

        if ($this->session->userdata('isLogIn') == false)
        redirect('login'); 
	}


    public function new_monthwise_opd()
    {
        $session_year = $this->session->userdata('acyear');
        $current_year = date('Y');

        // Handle start_date
        if (empty($this->input->get('start_date', TRUE))) {
            $start_date = $session_year . '-01-01';
        } else {
            $start_date = date('Y-m-d', strtotime($this->input->get('start_date', TRUE)));
        }

        // Handle end_date
        if (empty($this->input->get('end_date', TRUE))) {
            if ($session_year == $current_year) {
                $end_date = date('Y-m-d');
            } else {
                $end_date = $session_year . '-12-31';
            }
        } else {
            $end_date = date('Y-m-d', strtotime($this->input->get('end_date', TRUE)));
        }

        // Fetch department data
        $departments = $this->db->select('*')->from('department_new')->get()->result();

        // Fetch month-wise OPD patient counts
        $monthwise_data = $this->db->select('department_id, MONTH(create_date) as month, COUNT(*) as count')
            ->from('patient')
            ->where('create_date >=', $start_date)
            ->where('create_date <=', $end_date)
            ->where('ipd_opd','opd')
            ->group_by(['department_id', 'MONTH(create_date)'])
            ->get()
            ->result();
            // print_r($this->db->last_query());

        // Process month-wise data into an associative array
        $data['monthwise_data'] = [];
        foreach ($monthwise_data as $row) {
            $data['monthwise_data'][$row->department_id][$row->month] = $row->count;
        }

        // Pass data to view
        $data['datefrom'] = $start_date;
        $data['dateto'] = $end_date;
        $data['department'] = $departments;
        $data['content'] = $this->load->view('new_monthwise_opd', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function new_monthwise_ipd()
    {
        $session_year = $this->session->userdata('acyear');
        $current_year = date('Y');

        // Handle start_date
        if (empty($this->input->get('start_date', TRUE))) {
            $start_date = $session_year . '-01-01';
        } else {
            $start_date = date('Y-m-d', strtotime($this->input->get('start_date', TRUE)));
        }

        // Handle end_date
        if (empty($this->input->get('end_date', TRUE))) {
            if ($session_year == $current_year) {
                $end_date = date('Y-m-d');
            } else {
                $end_date = $session_year . '-12-31';
            }
        } else {
            $end_date = date('Y-m-d', strtotime($this->input->get('end_date', TRUE)));
        }

        // Fetch department data
        $departments = $this->db->select('*')->from('department_new')->get()->result();

        // Fetch month-wise OPD patient counts
        $monthwise_data = $this->db->select('department_id, MONTH(create_date) as month, COUNT(*) as count')
            ->from('patient_ipd')
            ->where('create_date >=', $start_date)
            ->where('create_date <=', $end_date)
            ->where('ipd_opd','ipd')
            ->group_by(['department_id', 'MONTH(create_date)'])
            ->get()
            ->result();
            // print_r($this->db->last_query());

        // Process month-wise data into an associative array
        $data['monthwise_data'] = [];
        foreach ($monthwise_data as $row) {
            $data['monthwise_data'][$row->department_id][$row->month] = $row->count;
        }

        // Pass data to view
        $data['datefrom'] = $start_date;
        $data['dateto'] = $end_date;
        $data['department'] = $departments;
        $data['content'] = $this->load->view('new_monthwise_ipd', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function new_monthwise_occupancy()
    {
        $session_year = $this->session->userdata('acyear');
        $current_year = date('Y');

        // Handle start_date
        if (empty($this->input->get('start_date', TRUE))) {
            $start_date = $session_year . '-01-01';
        } else {
            $start_date = date('Y-m-d', strtotime($this->input->get('start_date', TRUE)));
        }

        // Handle end_date
        if (empty($this->input->get('end_date', TRUE))) {
            if ($session_year == $current_year) {
                $end_date = date('Y-m-d');
            } else {
                $end_date = $session_year . '-12-31';
            }
        } else {
            $end_date = date('Y-m-d', strtotime($this->input->get('end_date', TRUE)));
        }
        // Fetch department data
        $departments = $this->db->select('*')->from('department_new')->get()->result();
        // Fetch datewise OPD patient counts
        // Pass data to view
        $data['datefrom'] = $start_date;
        $data['dateto'] = $end_date;
        $data['department'] = $departments;
        $data['content'] = $this->load->view('new_monthwise_occupancy', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }


    public function deptopd()
    {
        $session_year = $this->session->userdata('acyear');
        $current_year = date('Y');

        // Handle start_date
        if (empty($this->input->get('start_date', TRUE))) {
            $start_date = $session_year . '-01-01';
        } else {
            $start_date = date('Y-m-d', strtotime($this->input->get('start_date', TRUE)));
        }

        // Handle end_date
        if (empty($this->input->get('end_date', TRUE))) {
            if ($session_year == $current_year) {
                $end_date = date('Y-m-d');
            } else {
                $end_date = $session_year . '-12-31';
            }
        } else {
            $end_date = date('Y-m-d', strtotime($this->input->get('end_date', TRUE)));
        }

        // Fetch department data
        $departments = $this->db->select('*')->from('department_new')->get()->result();
        // Pass data to view
        $data['datefrom'] = $start_date;
        $data['dateto'] = $end_date;
        $data['department'] = $departments;
        $data['content'] = $this->load->view('deptopd', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function deptipd()
    {
        $session_year = $this->session->userdata('acyear');
        $current_year = date('Y');

        // Handle start_date
        if (empty($this->input->get('start_date', TRUE))) {
            $start_date = $session_year . '-01-01';
        } else {
            $start_date = date('Y-m-d', strtotime($this->input->get('start_date', TRUE)));
        }

        // Handle end_date
        if (empty($this->input->get('end_date', TRUE))) 
        {
            if ($session_year == $current_year) 
            {
                $end_date = date('Y-m-d');
            } else 
            {
                $end_date = $session_year . '-12-31';
            }
        } else {
            $end_date = date('Y-m-d', strtotime($this->input->get('end_date', TRUE)));
        }

        // Fetch department data
        $departments = $this->db->select('*')->from('department')->get()->result();
        // Pass data to view
        $data['datefrom'] = $start_date;
        $data['dateto'] = $end_date;
        $data['department'] = $departments;
        $data['content'] = $this->load->view('deptipd', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }


    public function deptopdgender()
    {
        $session_year = $this->session->userdata('acyear');
        $current_year = date('Y');

        // Handle start_date
        if (empty($this->input->get('start_date', TRUE))) {
            $start_date = $session_year . '-01-01';
        } else {
            $start_date = date('Y-m-d', strtotime($this->input->get('start_date', TRUE)));
        }

        // Handle end_date
        if (empty($this->input->get('end_date', TRUE))) 
        {
            if ($session_year == $current_year) 
            {
                $end_date = date('Y-m-d');
            } else 
            {
                $end_date = $session_year . '-12-31';
            }
        } else {
            $end_date = date('Y-m-d', strtotime($this->input->get('end_date', TRUE)));
        }

        $startDate = $start_date;
        $endDate = $end_date;
        $dates = [];
        $currentDate = strtotime($startDate);
        $endDate = strtotime($endDate);

        while ($currentDate <= $endDate) {
            $dates[] = date('Y-m-d', $currentDate);
            $currentDate = strtotime('+1 day', $currentDate);
        }
        $data['dates'] = $dates;

        // Fetch department data
        $departments = $this->db->select('*')->from('department_new')->get()->result();
        // Pass data to view
        $data['datefrom'] = $start_date;
        $data['dateto'] = $end_date;
        $data['department'] = $departments;
        $data['content'] = $this->load->view('deptopdgender', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }



    public function gendercount()
    {
        $session_year = $this->session->userdata('acyear');
        $current_year = date('Y');

        // Handle start_date
        if (empty($this->input->get('start_date', TRUE))) {
            $start_date = $session_year . '-01-01';
        } else {
            $start_date = date('Y-m-d', strtotime($this->input->get('start_date', TRUE)));
        }

        // Handle end_date
        if (empty($this->input->get('end_date', TRUE))) 
        {
            if ($session_year == $current_year) 
            {
                $end_date = date('Y-m-d');
            } else 
            {
                $end_date = $session_year . '-12-31';
            }
        } else {
            $end_date = date('Y-m-d', strtotime($this->input->get('end_date', TRUE)));
        }

        $startDate = $start_date;
        $endDate = $end_date;
        $dates = [];
        $currentDate = strtotime($startDate);
        $endDate = strtotime($endDate);

        while ($currentDate <= $endDate) {
            $dates[] = date('Y-m-d', $currentDate);
            $currentDate = strtotime('+1 day', $currentDate);
        }
        $data['dates'] = $dates;

        // Fetch department data
        $departments = $this->db->select('*')->from('department_new')->get()->result();
        // Pass data to view
        $data['datefrom'] = $start_date;
        $data['dateto'] = $end_date;
        $data['department'] = $departments;
        $data['content'] = $this->load->view('gendercount', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function deptopddate()
    {
        $session_year = $this->session->userdata('acyear');
        $current_year = date('Y');

        // Handle start_date
        if (empty($this->input->get('start_date', TRUE))) {
            $start_date = $session_year . '-01-01';
        } else {
            $start_date = date('Y-m-d', strtotime($this->input->get('start_date', TRUE)));
        }

        // Handle end_date
        if (empty($this->input->get('end_date', TRUE))) 
        {
            if ($session_year == $current_year) 
            {
                $end_date = date('Y-m-d');
            } else 
            {
                $end_date = $session_year . '-12-31';
            }
        } else {
            $end_date = date('Y-m-d', strtotime($this->input->get('end_date', TRUE)));
        }

        $startDate = $start_date;
        $endDate = $end_date;
        $dates = [];
        $currentDate = strtotime($startDate);
        $endDate = strtotime($endDate);

        while ($currentDate <= $endDate) {
            $dates[] = date('Y-m-d', $currentDate);
            $currentDate = strtotime('+1 day', $currentDate);
        }
        $data['dates'] = $dates;

        // Fetch department data
        $departments = $this->db->select('*')->from('department_new')->get()->result();
        // Pass data to view
        $data['datefrom'] = $start_date;
        $data['dateto'] = $end_date;
        $data['department'] = $departments;
        $data['content'] = $this->load->view('deptopddate', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }


    public function deptipddate()
    {
        $session_year = $this->session->userdata('acyear');
        $current_year = date('Y');

        // Handle start_date
        if (empty($this->input->get('start_date', TRUE))) {
            $start_date = $session_year . '-01-01';
        } else {
            $start_date = date('Y-m-d', strtotime($this->input->get('start_date', TRUE)));
        }

        // Handle end_date
        if (empty($this->input->get('end_date', TRUE))) 
        {
            if ($session_year == $current_year) 
            {
                $end_date = date('Y-m-d');
            } else 
            {
                $end_date = $session_year . '-12-31';
            }
        } else {
            $end_date = date('Y-m-d', strtotime($this->input->get('end_date', TRUE)));
        }

        $startDate = $start_date;
        $endDate = $end_date;
        $dates = [];
        $currentDate = strtotime($startDate);
        $endDate = strtotime($endDate);

        while ($currentDate <= $endDate) {
            $dates[] = date('Y-m-d', $currentDate);
            $currentDate = strtotime('+1 day', $currentDate);
        }
        $data['dates'] = $dates;

        // Fetch department data
        $departments = $this->db->select('*')->from('department_new')->get()->result();
        // Pass data to view
        $data['datefrom'] = $start_date;
        $data['dateto'] = $end_date;
        $data['department'] = $departments;
        $data['content'] = $this->load->view('deptipddate', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }


    public function genderwisereport()
    {
        $session_year = $this->session->userdata('acyear');
        $current_year = date('Y');

        // Handle start_date
        if (empty($this->input->get('start_date', TRUE))) {
            $start_date = $session_year . '-01-01';
        } else {
            $start_date = date('Y-m-d', strtotime($this->input->get('start_date', TRUE)));
        }

        // Handle end_date
        if (empty($this->input->get('end_date', TRUE))) {
            if ($session_year == $current_year) {
                $end_date = date('Y-m-d');
            } else {
                $end_date = $session_year . '-12-31';
            }
        } else {
            $end_date = date('Y-m-d', strtotime($this->input->get('end_date', TRUE)));
        }

        // Fetch department data
        $departments = $this->db->select('*')->from('department_new')->get()->result();
        // Pass data to view
        $data['datefrom'] = $start_date;
        $data['dateto'] = $end_date;
        $data['department'] = $departments;
        $data['content'] = $this->load->view('genderwisereport', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

public function new_monthwise_opd_shalaky_n_m()
{
    $session_year = $this->session->userdata('acyear');
    $current_year = date('Y');

    // Handle start_date
    if (empty($this->input->get('start_date', TRUE))) {
        $start_date = $session_year . '-01-01';
    } else {
        $start_date = date('Y-m-d', strtotime($this->input->get('start_date', TRUE)));
    }

    // Handle end_date
    if (empty($this->input->get('end_date', TRUE))) {
        if ($session_year == $current_year) {
            $end_date = date('Y-m-d');
        } else {
            $end_date = $session_year . '-12-31';
        }
    } else {
        $end_date = date('Y-m-d', strtotime($this->input->get('end_date', TRUE)));
    }

    // Fetch department data (Only departments 30 and 36)
    $departments = $this->db->select('*')
        ->from('department_new')
        ->where_in('dprt_id', [30, 36])
        ->get()
        ->result();

    // Fetch month-wise OPD patient counts for department 30 and 36
    $monthwise_data = $this->db->select('department_id, MONTH(create_date) as month, COUNT(*) as count')
        ->from('patient')
        ->where('create_date >=', $start_date)
        ->where('create_date <=', $end_date)
        ->where('ipd_opd', 'opd')
        ->where_in('department_id', [30, 36]) // Filter by department ID
        ->group_by(['department_id', 'MONTH(create_date)'])
        ->get()
        ->result();

    // Process month-wise data into an associative array
    $data['monthwise_data'] = [];
    foreach ($monthwise_data as $row) {
        $data['monthwise_data'][$row->department_id][$row->month] = $row->count;
    }

    // Pass data to view
    $data['datefrom'] = $start_date;
    $data['dateto'] = $end_date;
    $data['department'] = $departments;
    $data['content'] = $this->load->view('new_monthwise_opd_shalaky_n_m', $data, true);
    $this->load->view('layout/main_wrapper', $data);
}




}
?>
