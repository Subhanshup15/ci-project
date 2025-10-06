<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Bed_model extends CI_Model {




	private $table;

	public function __construct()
	{
		parent::__construct(); // Ensure to call the parent's constructor if this is a model or controller
		$this->table = ($this->session->userdata('acyear') >= '2025') ? 'beds' : 'beds_2024';
	}



	public function create($data = [])

	{	 

		return $this->db->insert($this->table,$data);

	}

 

	public function read()

	{

		return $this->db->select("*")

			->from($this->table)

			->order_by('id','asc')

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



	public function bed_list()

	{

		$result = $this->db->select("*")

			->from($this->table)

			->where('status',1)

			->get()

			->result();



		$list[''] = display('select_bed');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->id] = $value->type; 

			}

			return $list;

		} else {

			return false;

		}

	}
	
public function getBedDataByDeptGen($department_id, $sex)
    {

            // 		return $this->db->select("*")

            // 			->from($this->table)

            // 			->order_by('id','asc')

            // 			->get()

            // 			->result();
        // if($department_id != null  && $sex != null)
        //     $this->db->where(['department_id'=>$department_id, 'gender'=> $sex]);
        // elseif($sex == null)
        //     $this->db->where(['department_id'=>$department_id]);
        // elseif($department_id == null)
        //     $this->db->where(['gender'=> $sex]);
        
        // $this->db->order_by('id','asc');
        // return $this->db->get($this->table)->result();
        if($this->session->userdata('acyear')>='2025')
        {
            $this->db->select(['beds.*, department_new.name']);
            $this->db->from('beds');
            $this->db->join('department_new', 'beds.department_id = department_new.dprt_id');
            if($department_id != null  && $sex != null)
                $this->db->where(['beds.department_id'=>$department_id, 'beds.gender'=> $sex]);
            elseif($sex == null)
                $this->db->where(['beds.department_id'=>$department_id]);
            elseif($department_id == null)
                $this->db->where(['beds.gender'=> $sex]);
                
            $this->db->order_by('beds.id','asc');
            return $this->db->get()->result();
        }
        else
        {
            $this->db->select(['beds_2024.*, department_new.name']);
            $this->db->from('beds_2024');
            $this->db->join('department_new', 'beds_2024.department_id = department_new.dprt_id');
            if($department_id != null  && $sex != null)
                $this->db->where(['beds_2024.department_id'=>$department_id, 'beds_2024.gender'=> $sex]);
            elseif($sex == null)
                $this->db->where(['beds_2024.department_id'=>$department_id]);
            elseif($department_id == null)
                $this->db->where(['beds_2024.gender'=> $sex]);
                
            $this->db->order_by('beds_2024.id','asc');
            return $this->db->get()->result();
        }
        
	} 
	public function updateBedSelection($id, $status)
	{
	    $data = array( 
            'status'  =>  $status
        );
	    return  $this->db->where('id',$id)
			->update($this->table,$data); 
	}
	
	public function updateOldBedSelection($oldBedId)
	{
	    $d1 = array('status' => '0');
	     return $this->db->where('id', $oldBedId)->update($this->table,$d1); 
	}

	

 }

