<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Urineexamination_model extends CI_Model {



	private $table = "urineexamination";

 

	public function create($data = [])

	{	 

		return $this->db->insert($this->table, $data);

  }
		
	
    public function read()

	{
		$year = '2019';

		return $this->db->select("*")

			->from($this->table)
			
		//	->where('create_date', $year) 

			->get()

			->result();

    }
    
    public function read_by_id($id = null)

	{

		return $this->db->select("*")

			->from($this->table)

			->where('id',$id)

			->get()

			->row();

    } 
    

    public function update($data = [])

	{

		return $this->db->where('id',$data['id'])

		->update($this->table,$data); 

	} 

 

	public function delete($id = null)

	{

		$this->db->where('id',$id)

			->delete($this->table);



		if ($this->db->affected_rows()) {

			return true;

		} else {

			return false;

		}

    }
    
} 