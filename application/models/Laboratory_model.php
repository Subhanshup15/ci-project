<?php defined('BASEPATH') OR exit('No direct script access allowed');





class Laboratory_model extends CI_Model {



	private $table = "laboratory";
	private $table2 = "haemogram";
	private $table3 = "seological";
	
	private $table4 = "biochemicaltest2";
	private $table5 = "stool";
	private $table6 = "semen";
	private $table7 = "urinexamination2";
    private $table8 = "sputum";
 

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
		
//Hemogram CRUD
		public function createhaemogram($data = []){

			return $this->db->insert($this->table2, $data);
			
		}

		
    public function readhaemogram()

	{
		$year = '2019';

		return $this->db->select("*")

			->from($this->table2)
			
		//	->where('create_date', $year) 

			->get()

			->result();

    }
    
    public function read_by_idhaemogram($id = null)

	{

		return $this->db->select("*")

			->from($this->table2)

			->where('id',$id)

			->get()

			->row();

    } 
    

    public function updatehaemogram($data = [])

	{

		return $this->db->where('id',$data['id'])

		->update($this->table2,$data); 

	} 

 

	public function deletehaemogram($id = null)

	{

		$this->db->where('id',$id)

			->delete($this->table2);



		if ($this->db->affected_rows()) {

			return true;

		} else {

			return false;

		}

		}

//List secologic
public function createseological($data = [])
{	 

	return $this->db->insert($this->table3, $data);

}

public function createseological1($data = [])
{	 
     //echo "create test";
	return $this->db->insert($this->table8, $data);

}
	

	public function readseological()

{
	$year = '2019';

	return $this->db->select("*")

		->from($this->table3)
		
	//	->where('create_date', $year) 

		->get()

		->result();

	}
	
public function readseological1()
{
	$year = '2019';

	return $this->db->select("*")

		->from($this->table8)
		
	//	->where('create_date', $year) 

		->get()

		->result();

	}
	
public function read_by_idseological($id = null)
{

	return $this->db->select("*")

		->from($this->table3)

		->where('id',$id)

		->get()

		->row();

	}

public function read_by_idseological1($id = null)
{

	return $this->db->select("*")

		->from($this->table8)

		->where('id',$id)

		->get()

		->row();

	}
	

	public function updateseological($data = [])
    {
      
	return $this->db->where('id',$data['id'])

	->update($this->table3,$data); 
   } 
   
   public function updateseological1($data = [])
    {
     //echo $data['id'];
     // exit;
	return $this->db->where('id',$data['id'])

	->update($this->table8,$data); 
   } 



public function deleteseological($id = null)

{

	$this->db->where('id',$id)

		->delete($this->table3);



	if ($this->db->affected_rows()) {

		return true;

	} else {

		return false;

	}

	}


//Biochemeical

public function createbiochemical($data = [])

{	 

	return $this->db->insert($this->table4, $data);

}
	

	public function readbiochemical()

{
	$year = '2019';

	return $this->db->select("*")

		->from($this->table4)
		
	//	->where('create_date', $year) 

		->get()

		->result();

	}
	
	public function read_by_idbiochemical($id = null)

{

	return $this->db->select("*")

		->from($this->table4)

		->where('id',$id)

		->get()

		->row();

	} 
	

	public function updatebiochemical($data = [])

{

	return $this->db->where('id',$data['id'])

	->update($this->table4,$data); 

} 



public function deletebiochemical($id = null)

{

	$this->db->where('id',$id)

		->delete($this->table4);



	if ($this->db->affected_rows()) {

		return true;

	} else {

		return false;

	}

	}

//Stool Model

public function createstool($data = [])

{	 

	return $this->db->insert($this->table5, $data);

}
	

public function readstool()

{
	$year = '2019';

	return $this->db->select("*")

		->from($this->table5)
		
	//	->where('create_date', $year) 

		->get()

		->result();

}

public function read_by_idstool($id = null)

{

	return $this->db->select("*")

		->from($this->table5)

		->where('id',$id)

		->get()

		->row();

} 


public function updatestool($data = [])

{

	return $this->db->where('id',$data['id'])

	->update($this->table5,$data); 

} 



public function deletestool($id = null)

{

	$this->db->where('id',$id)

		->delete($this->table5);



	if ($this->db->affected_rows()) {

		return true;

	} else {

		return false;

	}

	}

//semen Examination Reports
public function createsemen($data = [])

	{	 

		return $this->db->insert($this->table6, $data);

  }
		
	
    public function readsemen()

	{
		$year = '2019';

		return $this->db->select("*")

			->from($this->table6)
			
		//	->where('create_date', $year) 

			->get()

			->result();

    }
    
    public function read_by_idsemen($id = null)

	{

		return $this->db->select("*")

			->from($this->table6)

			->where('id',$id)

			->get()

			->row();

    } 
    

    public function updatesemen($data = [])

	{

		return $this->db->where('id',$data['id'])

		->update($this->table6,$data); 

	} 

 

	public function deletesemen($id = null)

	{

		$this->db->where('id',$id)

			->delete($this->table6);



		if ($this->db->affected_rows()) {

			return true;

		} else {

			return false;

		}

		}

//Urin Examination Second report

public function createurinexamination($data = [])

{	 

	return $this->db->insert($this->table7, $data);

}
	

public function readurinexamination()

{
	$year = '2019';

	return $this->db->select("*")

		->from($this->table7)
		
	//	->where('create_date', $year) 

		->get()

		->result();

}

public function read_by_idurinexamination($id = null)

{

	return $this->db->select("*")

		->from($this->table7)

		->where('id',$id)

		->get()

		->row();

} 


public function updateurinexamination($data = [])

{

	return $this->db->where('id',$data['id'])

	->update($this->table7,$data); 

} 



public function deleteurinexamination($id = null)

{

	$this->db->where('id',$id)

		->delete($this->table7);



	if ($this->db->affected_rows()) {

		return true;

	} else {

		return false;

	}

}


	
//End main function	
} 
