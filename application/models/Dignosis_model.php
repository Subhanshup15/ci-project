<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Dignosis_model extends CI_Model {



    private $table = 'dignosis';
    private $table2 = 'digno_sub_cat';
    private $table3 = 'treatment';
    
    private $table4 = 'treatments1';


    //Dignosis Create
	public function createdignosis($data = [])

	{	 

		return $this->db->insert($this->table,$data);

    }


    
    public function readdignosis()

	{

		//return $this->db->select("*")
            return $this->db->select('distinct(dignosis)')
			->from($this->table4)
            //->from('treatments1')
			->get()

			->result();

	} 

    public function read_by_id_dignosis($dprt_id = null)

	{

		return $this->db->select("*")

			->from($this->table4)

			->where('id_digno',$dprt_id)

			->get()

			->row();

	} 

 

	public function updatedignosis($data = [])

	{

		return $this->db->where('id_digno',$data['dprt_id'])

			->update($this->table4,$data); 

	} 

 

	public function deletedignosis($dprt_id = null)

	{

		$this->db->where('id_digno',$dprt_id)

			->delete($this->table4);



		if ($this->db->affected_rows()) {

			return true;

		} else {

			return false;

		}

	} 

    

    
    //Dignosis Sub Category Create
	public function createsubcat($data = [])

	{	 

		return $this->db->insert($this->table2,$data);

    }


    public function readsubcat()

	{

		return $this->db->select("*")

			->from($this->table2)

			->get()

			->result();

	} 

    
    public function read_by_id_subcat($dprt_id = null)

	{

		return $this->db->select("*")

			->from($this->table2)

			->where('id_digno_sub',$dprt_id)

			->get()

			->row();

	} 

 

	public function updatesubcat($data = [])

	{

		return $this->db->where('id_digno_sub',$data['dprt_id'])

			->update($this->table2,$data); 

	} 

 

	public function deletesubcat($dprt_id = null)

	{

		$this->db->where('id_digno_sub',$dprt_id)

			->delete($this->table2);



		if ($this->db->affected_rows()) {

			return true;

		} else {

			return false;

		}

	} 



    //Treatment Create
	public function createtreatment($data = [])

	{	 

		return $this->db->insert($this->table3,$data);

	}


    public function readtreatment()

	{

		return $this->db->select("*")
            
			//->from($this->table3)
            ->from($this->table4)
            ->where('ipd_opd','ipd')
            ->or_where('ipd_opd','opd')
			->get()

			->result();

	} 

 

	public function read_by_id_treatment($dprt_id = null)

	{

		return $this->db->select("*")

			//->from($this->table3)
            ->from($this->table4)

			->where('id_treatment',$dprt_id)

			->get()

			->row();

	} 

 

	public function update_treatment($data = [])

	{

		return $this->db->where('id_treatment',$data['dprt_id'])

			//->update($this->table3,$data); 
			->update($this->table4,$data); 

	} 

 

	public function delete_treatment($dprt_id = null)

	{

		$this->db->where('id_treatment',$dprt_id)

			//->delete($this->table3);
			->delete($this->table4);



		if ($this->db->affected_rows()) {

			return true;

		} else {

			return false;

		}

	} 

 

	


	public function dignosis_list()

	{

		$result = $this->db->select("*")

			->from($this->table4)

			->where('status',1)

			->get()

			->result();



		$list[''] = display('select_department');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->id_digno] = $value->name; 

			}

			return $list;

		} else {

			return false;

		}

	}



	//Sub Category List
	public function dignosis_sub_list()

	{

		$result = $this->db->select("*")

			->from($this->table2)

			->where('status',1)

			->get()

			->result();



		$list[''] = "Select Dgnosis Sub Category";

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->id_digno_sub] = $value->name; 

			}

			return $list;

		} else {

			return false;

		}

	}



	

 }

