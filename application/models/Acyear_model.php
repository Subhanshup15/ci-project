<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Acyear_model extends CI_Model {



	private $table = "acyear";

 

	public function create($data = [])

	{	 

		return $this->db->insert($this->table, $data);

	}

    
	public function read()

	{

		return $this->db->select("*")

			->from($this->table)

			->get()

			->result();

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