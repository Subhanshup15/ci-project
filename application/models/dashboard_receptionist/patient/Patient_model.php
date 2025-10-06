<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Patient_model extends CI_Model {



	private $table = "patient";

 

	public function create($data = [])

	{	 

		return $this->db->insert($this->table,$data);

	}

 

	public function read()

	{
		$year = '%'.$this->session->userdata['acyear'].'%';

		return $this->db->select("*")

			->from($this->table)
			
			->join('department','department.dprt_id = patient.department_id')

			->where('create_date', $year) 

			->order_by("yearly_no", "desc")

			->get()

			->result();

	} 

 

	public function read_by_id($id = null)

	{

		$year = '%'.$this->session->userdata['acyear'].'%';

		return $this->db->select("*")

			->from($this->table)

			->where('id',$id)

			->where('create_date LIKE', $year)

			->get()

			->row();

	} 


	public function read_by_dept_id($department_id = null, $section = null)
	{
		$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table)
		
		->join('department','department.dprt_id = patient.department_id')

		->where('department_id', $department_id)

		->where ('ipd_opd', $section)

		->order_by("yearly_no", "desc")

		->where('create_date LIKE', $year)

		->get()

		->result();

			
	}


	public function read_by_section($section = null)
	{

		$year = '%'.$this->session->userdata['acyear'].'%';
		//print_r($year);

		//$year = '%2019%';		

		return $this->db->select("*")

		->from($this->table)
		
		->join('department','department.dprt_id = patient.department_id')

		->where('ipd_opd', $section)

		->where('create_date LIKE', $year)

		//->order_by("yearly_no", "desc")

		
		->limit(5000)

		->get()

		->result();
	}


	public function read_by_section_date($data = null)

	{ 

		$start_date = date('Y-m-d',strtotime($data['start_date']));

		$end_date   = date('Y-m-d',strtotime($data['end_date']));

		$year = '%'.$this->session->userdata['acyear'].'%';

		

		print_r($data);
		die();

		$section = 'opd';

		return  $this->db->select("*")

		->from($this->table)
		
		->join('department','department.dprt_id = patient.department_id')

		->where('ipd_opd', $section)
	
		->where('create_date >=', $start_date)

	//->where('create_date <=', $end_date)

		
	//->where('create_date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"')


	//->where('create_date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"')


		->where('create_date LIKE', $year)

		
		//->order_by("yearly_no", "desc")

		
		->limit(5000)

	

	->get()

	->result();

		
		//die();


		//print_r(get());
		//die();
		

	}




}

