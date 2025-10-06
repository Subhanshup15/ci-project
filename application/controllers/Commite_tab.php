<?php defined('BASEPATH') or exit('No direct script access allowed');

class Commite_tab extends CI_Controller
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


    public function opd_patient()
    {
        // Get dates with simpler null coalescing
        $start_date = date('Y-m-d', strtotime($this->input->get('start_date') ?? 'today'));
        $end_date = date('Y-m-d', strtotime($this->input->get('end_date') ?? 'today'));

        $data = [
            'datefrom' => $start_date,
            'dateto' => $end_date,
            'patients' => $this->db->select('yearly_reg_no,old_reg_no,firstname,sex,date_of_birth,department_id,id,create_date,address')
                ->from('patient')
                ->where('create_date >=', $start_date)
                ->where('create_date <=', $end_date)
                ->where('ipd_opd', 'opd')
                ->get()
                ->result()
        ];

        // Load views directly without intermediate variable
        $this->load->view('layout/main_wrapper', ['content' => $this->load->view('commite_tab/opd_patient', $data, true)]);
    }

    public function ipd_patient()
    {
        // Get date range or default to today
        $start_date = $this->input->get('start_date') ? date('Y-m-d', strtotime($this->input->get('start_date'))) : date('Y-m-d');
        $end_date = $this->input->get('end_date') ? date('Y-m-d', strtotime($this->input->get('end_date'))) : date('Y-m-d');

        $data['datefrom'] = $start_date;
        $data['dateto'] = $end_date;

        $this->db->select('*');
        $this->db->from('patient_ipd');
        $this->db->where('ipd_opd', 'ipd');

        // Group conditions properly
        $this->db->group_start()
            ->where('discharge_date >=', $start_date)
            ->where('create_date <=', $start_date)
            ->group_end();

        $this->db->or_group_start()
            ->where('discharge_date', $start_date)
            ->where('ipd_opd', 'ipd')
            ->group_end();

        $this->db->or_group_start()
            ->where('create_date <=', $start_date)
            ->where('discharge_date', '0000-00-00')
            ->where('ipd_opd', 'ipd')
            ->group_end();

        $this->db->order_by('id', 'ASC');

        $data['patients'] = $this->db->get()->result();

        // Load views
        $data['content'] = $this->load->view('commite_tab/ipd_patient', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }



    public function admit_patient()
    {
        // Get dates with simpler null coalescing
        $start_date = date('Y-m-d', strtotime($this->input->get('start_date') ?? 'today'));
        $end_date = date('Y-m-d', strtotime($this->input->get('end_date') ?? 'today'));

        $data = [
            'datefrom' => $start_date,
            'dateto' => $end_date,
            'patients' => $this->db->select('discharge_date,ipd_no_new,bedNo,yearly_reg_no,old_reg_no,firstname,sex,date_of_birth,department_id,id,create_date,address,dignosis')
                ->from('patient_ipd')
                ->where('create_date >=', $start_date)
                ->where('create_date <=', $end_date)
                ->where('ipd_opd', 'ipd')
                ->get()
                ->result()

        ];
        // print_r($this->db->last_query());

        // Load views directly without intermediate variable
        $this->load->view('layout/main_wrapper', ['content' => $this->load->view('commite_tab/admit_patient', $data, true)]);
    }


    public function discharge_patient()
    {
        // Get dates with simpler null coalescing
        $start_date = date('Y-m-d', strtotime($this->input->get('start_date') ?? 'today'));
        $end_date = date('Y-m-d', strtotime($this->input->get('end_date') ?? 'today'));

        $data = [
            'datefrom' => $start_date,
            'dateto' => $end_date,
            'patients' => $this->db->select('discharge_date,ipd_no_new,bedNo,yearly_reg_no,old_reg_no,firstname,sex,date_of_birth,department_id,id,create_date,address,dignosis')
                ->from('patient_ipd')
                ->where('discharge_date >=', $start_date)
                ->where('discharge_date <=', $end_date)
                ->where('ipd_opd', 'ipd')
                ->get()
                ->result()

        ];
        // print_r($this->db->last_query());

        // Load views directly without intermediate variable
        $this->load->view('layout/main_wrapper', ['content' => $this->load->view('commite_tab/discharge_patient', $data, true)]);
    }


    public function investigation_opd()
    {
        // Get dates with simpler null coalescing
        $start_date = date('Y-m-d', strtotime($this->input->get('start_date') ?? 'today'));
        $end_date = date('Y-m-d', strtotime($this->input->get('end_date') ?? 'today'));

        $data = [
            'datefrom' => $start_date,
            'dateto' => $end_date,
            'patients' => $this->db
                ->select('
            p.yearly_reg_no,
            p.old_reg_no,
            p.firstname,
            p.sex,
            p.date_of_birth,
            p.department_id,
            p.id,
            p.create_date,
             p.dignosis,
            p.address,
            i.patient_auto_id,
            i.patient_name,
            i.hematology,
            i.serology,
            i.biochemistry,
            i.microbiology
        ')
                ->from('investi_patient_count_opd i')
                ->join('patient p', 'p.id = i.patient_auto_id', 'left') // or 'inner' if all must match
                ->where('p.create_date >=', $start_date)
                ->where('p.create_date <=', $end_date)
                ->where('i.ipd_opd', 'opd')
                ->get()
                ->result()
        ];

        // print_r($this->db->last_query());

        // Load views directly without intermediate variable
        $this->load->view('layout/main_wrapper', ['content' => $this->load->view('commite_tab/investigation_opd', $data, true)]);
    }


    public function investigation_ipd()
    {
        // Get dates with simpler null coalescing
        $start_date = date('Y-m-d', strtotime($this->input->get('start_date') ?? 'today'));
        $end_date = date('Y-m-d', strtotime($this->input->get('end_date') ?? 'today'));

        $data = [
            'datefrom' => $start_date,
            'dateto' => $end_date,
            'patients' => $this->db
                ->select('
            p.yearly_reg_no,
            p.old_reg_no,
            p.firstname,
            p.sex,
            p.date_of_birth,
            p.department_id,
            p.id,
            p.create_date,
             p.dignosis,
            p.address,
            i.patient_auto_id,
            i.patient_name,
            i.hematology,
            i.serology,
            i.biochemistry,
            i.microbiology
        ')
                ->from('investi_patient_count_ipd i')
                ->join('patient_ipd p', 'p.id = i.patient_auto_id', 'left') // or 'inner' if all must match
                ->where('p.create_date >=', $start_date)
                ->where('p.create_date <=', $end_date)
                ->where('i.ipd_opd', 'ipd')
                ->get()
                ->result()
        ];

        // print_r($this->db->last_query());

        // Load views directly without intermediate variable
        $this->load->view('layout/main_wrapper', ['content' => $this->load->view('commite_tab/investigation_ipd', $data, true)]);
    }

    public function investi_patient_count_opd()
    {
        // If GET start_date is passed, use it; otherwise, use first day of the year
        $start_date = $this->input->get('start_date');
        if (!empty($start_date)) {
            $start_date = date('Y-m-d', strtotime($start_date));
        } else {
            $start_date = date('Y') . '-01-01';
        }

        // If GET end_date is passed, use it; otherwise, use today's date
        $end_date = $this->input->get('end_date');
        if (!empty($end_date)) {
            $end_date = date('Y-m-d', strtotime($end_date));
        } else {
            $end_date = date('Y-m-d');
        }

        // Prepare data for the view
        $data = [
            'datefrom' => $start_date,
            'dateto'   => $end_date,
        ];

        // Load view
        $this->load->view(
            'layout/main_wrapper',
            ['content' => $this->load->view('commite_tab/investi_patient_count_opd', $data, true)]
        );
    }



    public function investi_patient_count_ipd()
    {
        // If GET start_date is passed, use it; otherwise, use first day of the year
        $start_date = $this->input->get('start_date');
        if (!empty($start_date)) {
            $start_date = date('Y-m-d', strtotime($start_date));
        } else {
            $start_date = date('Y') . '-01-01';
        }

        // If GET end_date is passed, use it; otherwise, use today's date
        $end_date = $this->input->get('end_date');
        if (!empty($end_date)) {
            $end_date = date('Y-m-d', strtotime($end_date));
        } else {
            $end_date = date('Y-m-d');
        }

        // Prepare data for the view
        $data = [
            'datefrom' => $start_date,
            'dateto'   => $end_date,
        ];

        // Load view
        $this->load->view(
            'layout/main_wrapper',
            ['content' => $this->load->view('commite_tab/investi_patient_count_ipd', $data, true)]
        );
    }



    public function xray_ecg_usg_patient_count_opd()
    {
        // If GET start_date is passed, use it; otherwise, use first day of the year
        $start_date = $this->input->get('start_date');
        if (!empty($start_date)) {
            $start_date = date('Y-m-d', strtotime($start_date));
        } else {
            $start_date = date('Y') . '-01-01';
        }

        // If GET end_date is passed, use it; otherwise, use today's date
        $end_date = $this->input->get('end_date');
        if (!empty($end_date)) {
            $end_date = date('Y-m-d', strtotime($end_date));
        } else {
            $end_date = date('Y-m-d');
        }

        // Prepare data for the view
        $data = [
            'datefrom' => $start_date,
            'dateto'   => $end_date,
        ];

        // Load view
        $this->load->view(
            'layout/main_wrapper',
            ['content' => $this->load->view('commite_tab/xray_ecg_usg_patient_count_opd', $data, true)]
        );
    }


    public function xray_ecg_usg_patient_count_ipd()
    {
        // If GET start_date is passed, use it; otherwise, use first day of the year
        $start_date = $this->input->get('start_date');
        if (!empty($start_date)) {
            $start_date = date('Y-m-d', strtotime($start_date));
        } else {
            $start_date = date('Y') . '-01-01';
        }

        // If GET end_date is passed, use it; otherwise, use today's date
        $end_date = $this->input->get('end_date');
        if (!empty($end_date)) {
            $end_date = date('Y-m-d', strtotime($end_date));
        } else {
            $end_date = date('Y-m-d');
        }

        // Prepare data for the view
        $data = [
            'datefrom' => $start_date,
            'dateto'   => $end_date,
        ];

        // Load view
        $this->load->view(
            'layout/main_wrapper',
            ['content' => $this->load->view('commite_tab/xray_ecg_usg_patient_count_ipd', $data, true)]
        );
    }





    public function pankarma_patient_count($section = null)
    {
        // If GET start_date is passed, use it; otherwise, use first day of the year
        $start_date = $this->input->get('start_date');
        if (!empty($start_date)) {
            $start_date = date('Y-m-d', strtotime($start_date));
        } else {
            $start_date = date('Y') . '-01-01';
        }

        // If GET end_date is passed, use it; otherwise, use today's date
        $end_date = $this->input->get('end_date');
        if (!empty($end_date)) {
            $end_date = date('Y-m-d', strtotime($end_date));
        } else {
            $end_date = date('Y-m-d');
        }

        // Start building the query
        $this->db->select('
        p.yearly_reg_no,
        p.old_reg_no,
        p.firstname,
        p.sex,
        p.date_of_birth,
        p.department_id,
        p.id,
        p.create_date,
        p.dignosis,
        p.address,
        i.patient_auto_id,
        i.patient_name,
        i.snehan,
        i.swedan,
        i.vaman,
        i.virechan,
        i.nasya,
        i.raktmokshan,
        i.shirodhara,
        i.shirobasti,
        i.uttarbasti,
        i.basti,
        i.others,
        i.yonidhavan,
        i.yonipichu
    ');

        // Table source based on $section
        if ($section === 'opd') {
            $this->db->from('panchkarma_patient_count_opd i');
            $this->db->join('patient p', 'p.id = i.patient_auto_id', 'left');
        } else {
            $this->db->from('panchkarma_patient_count_ipd i');
            $this->db->join('patient_ipd p', 'p.id = i.patient_auto_id', 'left');
        }

        // Common filters
        $this->db->where('p.create_date >=', $start_date);
        $this->db->where('p.create_date <=', $end_date);

        // For IPD filter (based on original code)
        if ($section !== 'opd') {
            $this->db->where('i.ipd_opd', 'ipd');
        }

        // Execute query
        $patients = $this->db->get()->result();

        // Prepare data for the view
        $data = [
            'section' => $section,
            'datefrom' => $start_date,
            'dateto'   => $end_date,
            'patients' => $patients
        ];

        // Load view
        $this->load->view(
            'layout/main_wrapper',
            ['content' => $this->load->view('commite_tab/pankarma_patient_count', $data, true)]
        );
    }
}
