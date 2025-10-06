<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Department_model extends CI_Model {



	private $table = 'department';



	public function create($data = [])

	{	 

		return $this->db->insert($this->table,$data);

	}
	
	 public function read_by_holiday()

	{
         
		    	
		
		return $this->db->select("*")

			->from('holiday')

			->where('status',1)

			->get()

			->result();

	} 
	
		public function set_time()

	{

		return $this->db->select("*")

			->from('opd_ipd_time')

			//->order_by('dprt_id','desc')

			->get()

			->result();

	} 
	public function set_auto()

	{

		return $this->db->select("*")

			->from('auto_on_off')

			//->order_by('dprt_id','desc')

			->get()

			->result();

	} 

    public function update_opd_ipd_time($data = [])

	{

		return $this->db->where('id',$data['id'])

			   ->update('opd_ipd_time',$data); 

	} 
	
	 public function update_auto($data = [])

	{

		return $this->db->where('id',$data['id'])

			   ->update('auto_on_off',$data); 

	} 
	
	

  public function read_by_data($table)

	{
         if($table == "admit"){
			$table1 = 'admit_patient_limit';
		} else if($table == "discharge"){
			$table1 = 'discharge_patient_limit';
		} else if($table == "data_limit"){
			$table1='data_limit';
		}
		 else if($table == "deprt_kaya"){
			$table1 = 'deprt_kaya';
		} else if($table == "deprt_panch"){
			$table1 = 'deprt_panch';
		} else if($table == "deprt_bal"){
			$table1='deprt_bal';
		}
		else if($table == "deprt_shalya"){
			$table1 = 'deprt_shalya';
		} else if($table == "deprt_shalakya"){
			$table1 = 'deprt_shalakya';
		} else if($table == "deprt_stri"){
			$table1='deprt_stri';
		}
		else if($table == "deprt_swasth"){
			$table1='deprt_swasth';
		} 
		else if($table == "occupancy_limit"){
			$table1='occupancy_limit';
		} 
		else {
		    
		    	$table1='deprt_aatya';
		}
		return $this->db->select("*")

			->from($table1)

			->where('status',1)

			->get()

			->row();

	} 
	
	 public function read_by_dept_ipd()

	{
         
		  $table1='data_lmit_dept_ipd';
		
		return $this->db->select("*")

			->from($table1)

			->where('status',1)

			->get()

			->result();

	} 
	
		 public function read_by_dept_opd()

	{
         
		  $table1='data_lmit_dept_opd';
		
		return $this->db->select("*")

			->from($table1)

			->where('status',1)

			->get()

			->result();

	} 
	
	public function read_by_data_ipd($table,$gender1)

	{
         if($table == "admit"){
			$table1 = 'admit_patient_limit';
		} else if($table == "discharge"){
			$table1 = 'discharge_patient_limit';
		} else if($table == "data_limit"){
			$table1='data_limit';
		}
		 else if($table == "deprt_kaya"){
			$table1 = 'deprt_kaya_ipd';
		} else if($table == "deprt_panch"){
			$table1 = 'deprt_panch_ipd';
		} else if($table == "deprt_bal"){
			$table1='deprt_bal_ipd';
		}
		else if($table == "deprt_shalya"){
			$table1 = 'deprt_shalya_ipd';
		} else if($table == "deprt_shalakya"){
			$table1 = 'deprt_shalakya_ipd';
		} else if($table == "deprt_stri"){
			$table1='deprt_stri_ipd';
		}
		else if($table == "deprt_swasth"){
			$table1='deprt_swasth_ipd';
		} 
		else {
		    
		    	$table1='deprt_aatya_ipd';
		}
		return $this->db->select("*")

			->from($table1)

			->where('status',1)

			->get()

			->row();

	} 
	public function update_limit($data = [],$table)

	{
        if($table == "admit"){
			$table1 = 'admit_patient_limit';
		} else if($table == "discharge"){
			$table1 = 'discharge_patient_limit';
		} else if($table == "data_limit"){
			$table1='data_limit';
		}
		 else if($table == "deprt_kaya"){
			$table1 = 'deprt_kaya';
		} else if($table == "deprt_panch"){
			$table1 = 'deprt_panch';
		} else if($table == "deprt_bal"){
			$table1='deprt_bal';
		}
		else if($table == "deprt_shalya"){
			$table1 = 'deprt_shalya';
		} else if($table == "deprt_shalakya"){
			$table1 = 'deprt_shalakya';
		} else if($table == "deprt_stri"){
			$table1='deprt_stri';
		}
		else if($table == "deprt_swasth"){
			$table1='deprt_swasth';
		}
		else if($table == "occupancy_limit"){
			$table1='occupancy_limit';
		}  
		else {
		    
		    	$table1='deprt_aatya';
		}
		
		return $this->db->where('id',$data['id'])

			->update($table1,$data); 
		
	} 

   	public function data_limit_dept_ipd_update($data = [])

	{
         
		 $table1='data_lmit_dept_ipd';
		 return $this->db->where('dept_id',$data['id'])
         ->update($table1,$data); 
		
	} 
	
	 public function data_limit_dept_opd_update($data = [])

	{
        
		 $table1='data_lmit_dept_opd';
		 return $this->db->where('dept_id',$data['id'])
         ->update($table1,$data); 
		
	} 
	
	public function update_limit_ipd($data = [],$table)

	{
        if($table == "admit"){
			$table1 = 'admit_patient_limit';
		} else if($table == "discharge"){
			$table1 = 'discharge_patient_limit';
		} else if($table == "data_limit"){
			$table1='data_limit';
		}
		 else if($table == "deprt_kaya"){
			$table1 = 'deprt_kaya_ipd';
		} else if($table == "deprt_panch"){
			$table1 = 'deprt_panch_ipd';
		} else if($table == "deprt_bal"){
			$table1='deprt_bal_ipd';
		}
		else if($table == "deprt_shalya"){
			$table1 = 'deprt_shalya_ipd';
		} else if($table == "deprt_shalakya"){
			$table1 = 'deprt_shalakya_ipd';
		} else if($table == "deprt_stri"){
			$table1='deprt_stri_ipd';
		}
		else if($table == "deprt_swasth"){
			$table1='deprt_swasth_ipd';
		} 
		else {
		    
		    	$table1='deprt_aatya_ipd';
		}
		return $this->db->where('id',$data['id'])

			->update($table1,$data); 
		
	} 


	public function save_holiday($data = [])

	{
        	return $this->db->insert('holiday', $data);
        
		} 

	public function read()

	{

		return $this->db->select("*")

			->from($this->table)

			->order_by('dprt_id','desc')

			->get()

			->result();

	} 

 

	public function read_by_id($dprt_id = null)

	{

		return $this->db->select("*")

			->from($this->table)

			->where('dprt_id',$dprt_id)

			->get()

			->row();

	} 

 

	public function update($data = [])

	{

		return $this->db->where('dprt_id',$data['dprt_id'])

			->update($this->table,$data); 

	} 

 

	public function delete($dprt_id = null)

	{

		$this->db->where('dprt_id',$dprt_id)

			->delete($this->table);



		if ($this->db->affected_rows()) {

			return true;

		} else {

			return false;

		}

	} 



	// public function department_list()

	// {

	// 	$result = $this->db->select("*")

	// 		->from($this->table)

	// 		->where('status',1)

	// 		->get()

	// 		->result();



	// 	$list[''] = display('select_department');

	// 	if (!empty($result)) {

	// 		foreach ($result as $value) {

	// 			$list[$value->dprt_id] = $value->name; 

	// 		}

	// 		return $list;

	// 	} else {

	// 		return false;

	// 	}

	// }

    public function department_list()
 {
    $year = '%' . $this->session->userdata['acyear'] . '%';
    $Cyear = $this->session->userdata['acyear'];

    if ($Cyear == '2025') {
        $departmentTable = 'department_new'; 
    } else {
        $departmentTable = 'department'; 
    }

    $result = $this->db->select("*")
        ->from($departmentTable)  
        ->where('status', 1) 
        ->get()
        ->result(); 
    $list[''] = display('select_department');

    if (!empty($result)) {
        foreach ($result as $value) {
            $list[$value->dprt_id] = $value->name;  
        }
        return $list; 
    } else {
        return false; 
    }
}

	public function address_list()

	{

		$result = $this->db->select("*")

			->from('address')

			->where('status',0)

			->get()

			->result();



		$list[''] = display('select_address');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->id] = $value->name; 

			}

			return $list;

		} else {

			return false;

		}

	}


	public function dignosis_list()

	{

		$result = $this->db->select("*")

			->from('dignosis')

			->where('status',1)

			->get()

			->result();



		$list[''] = display('select_dignosis');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->id_digno] = $value->name; 

			}

			return $list;

		} else {

			return false;

		}

	}

		public function treatment_list($dignosis =null,$section)

	{
         $dignosis1 = '%'.$dignosis.'%';
		$result = $this->db->select("*")

			->from('treatments')

			->where('dignosis like',$dignosis1)
            ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->RX1] = $value->RX1; 

			}

			return $list;

		} else {

			return false;

		}

	}
		public function treatment_list_rx1($dignosis =null,$section)

	{
	    $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
            
		     $result = $this->db->select("*")

			->from('treatments1')

			//->where('dignosis like',$dignosis1)
            //->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {
              
			foreach ($result as $value) {
                  
				   $arr1=explode("/",$value->RX1);
                   if($len >0){
				   $list[$arr1[0]] = $arr1[0]; 
				  
                   }else{
                     $list[''] = $arr1[''];   
                       
                   }
			}

			return $list;

		} else {

			return false;

		}

	}
		public function treatment_list_rx11($dignosis =null,$section)

	{
	    $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		     $result = $this->db->select("*")

			->from('treatments')

			->where('dignosis like',$dignosis1)
            ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {
                 $arr1=explode("/",$value->RX1);
                
				  if($len >0){
				   $list[$arr1[1]] = $arr1[1]; 
                   }else{
                     $list[''] = $arr1[''];   
                       
                   }

			}

			return $list;

		} else {

			return false;

		}

	}
		public function treatment_list_rx2($dignosis =null,$section)

	{
          $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		 $result = $this->db->select("*")

			->from('treatments1')

			//->where('dignosis like',$dignosis1)
           // ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$arr1=explode("/",$value->RX2);
            
				if($len >0){
				   $list[$arr1[0]] = $arr1[0]; 
                   }else{
                     $list[''] = $arr1[''];   
                       
                   }
			}

			return $list;

		} else {

			return false;

		}

	}
		public function treatment_list_rx22($dignosis =null,$section)

	{
	    $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		     $result = $this->db->select("*")

			->from('treatments')

			->where('dignosis like',$dignosis1)
            ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {
                 $arr1=explode("/",$value->RX2);
            
			   if($len >0){
				   $list[$arr1[1]] = $arr1[1]; 
                   }else{
                     $list[''] = $arr1[''];   
                       
                   }

			}

			return $list;

		} else {

			return false;

		}

	}
		public function treatment_list_rx3($dignosis =null,$section)

	{
         $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

			//->where('dignosis like',$dignosis1)
           // ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

			$arr1=explode("/",$value->RX3);
            
			   if($len >0){
				   $list[$arr1[0]] = $arr1[0]; 
                   }else{
                     $list[''] = $arr1[''];   
                       
                   } 

			}

			return $list;

		} else {

			return false;

		}

	}
	
	
	public function treatment_list_rx4($dignosis =null,$section)

	{
         $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

			//->where('dignosis like',$dignosis1)
           // ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

			$arr1=explode("/",$value->RX4);
            
			   if($len >0){
				   $list[$arr1[0]] = $arr1[0]; 
                   }else{
                     $list[''] = $arr1[''];   
                       
                   } 

			}

			return $list;

		} else {

			return false;

		}

	}
	
	
	public function treatment_list_rx5($dignosis =null,$section)

	{
         $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

			//->where('dignosis like',$dignosis1)
           // ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

			$arr1=explode("/",$value->RX5);
            
			   if($len >0){
				   $list[$arr1[0]] = $arr1[0]; 
                   }else{
                     $list[''] = $arr1[''];   
                       
                   } 

			}

			return $list;

		} else {

			return false;

		}

	}
	
	
	public function treatment_list_rx6($dignosis =null,$section)

	{
         $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I')
         {
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

			//->where('dignosis like',$dignosis1)
           // ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) 
		{

			foreach ($result as $value) 
			{

			   $arr1=explode("/",$value->RX5);
            
			   if($len >0)
			   {
				   $list[$arr1[0]] = $arr1[0]; 
               }
               else
               {
                 $list[''] = $arr1[''];   
                   
               } 

			}

			return $list;

		} 
		else 
		{

			return false;

		}

	}
	
	public function treatment_list_rx7($dignosis =null,$section)

	{
         $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I')
         {
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

			//->where('dignosis like',$dignosis1)
           // ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) 
		{

			foreach ($result as $value) 
			{

			   $arr1=explode("/",$value->RX5);
            
			   if($len >0)
			   {
				   $list[$arr1[0]] = $arr1[0]; 
               }
               else
               {
                 $list[''] = $arr1[''];   
                   
               } 

			}

			return $list;

		} 
		else 
		{

			return false;

		}

	}
	
	public function treatment_list_rx8($dignosis =null,$section)

	{
         $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I')
         {
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

			//->where('dignosis like',$dignosis1)
           // ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) 
		{

			foreach ($result as $value) 
			{

			   $arr1=explode("/",$value->RX5);
            
			   if($len >0)
			   {
				   $list[$arr1[0]] = $arr1[0]; 
               }
               else
               {
                 $list[''] = $arr1[''];   
                   
               } 

			}

			return $list;

		} 
		else 
		{

			return false;

		}

	}
	
	public function treatment_list_rx9($dignosis =null,$section)

	{
         $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I')
         {
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

			//->where('dignosis like',$dignosis1)
           // ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) 
		{

			foreach ($result as $value) 
			{

			   $arr1=explode("/",$value->RX5);
            
			   if($len >0)
			   {
				   $list[$arr1[0]] = $arr1[0]; 
               }
               else
               {
                 $list[''] = $arr1[''];   
                   
               } 

			}

			return $list;

		} 
		else 
		{

			return false;

		}

	}
	
	public function treatment_list_rx10($dignosis =null,$section)

	{
         $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I')
         {
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

			//->where('dignosis like',$dignosis1)
           // ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) 
		{

			foreach ($result as $value) 
			{

			   $arr1=explode("/",$value->RX5);
            
			   if($len >0)
			   {
				   $list[$arr1[0]] = $arr1[0]; 
               }
               else
               {
                 $list[''] = $arr1[''];   
                   
               } 

			}

			return $list;

		} 
		else 
		{

			return false;

		}

	}
	
	
	public function treatment_list_rx_other($dignosis =null,$section)

	{
         $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I')
         {
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

			//->where('dignosis like',$dignosis1)
           // ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) 
		{

			foreach ($result as $value) 
			{

			   $arr1=explode("/",$value->RX_other);
            
			   if($len >0)
			   {
				   $list[$arr1[0]] = $arr1[0]; 
               }
               else
               {
                 $list[''] = $arr1[''];   
                   
               } 

			}

			return $list;

		} 
		else 
		{

			return false;

		}

	}
	
	
	public function treatment_list_rx_other1($dignosis =null,$section)

	{
        $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I')
         {
            $dignosis1 = '%'.$dignosis.'%';
           
         }
         else
         {
            $dignosis1 = '%'.$dignosis.'I%';
          
          }
       
		$result = $this->db->select("*")

			->from('treatments1')
			//->where('dignosis like',$dignosis1)
           // ->where('ipd_opd',$section)
			->get()
			->result();

		$list[''] = display('select_treatment');

		if (!empty($result)) 
		{

			foreach ($result as $value) 
			{

			   $arr1=explode("/",$value->RX_other1);
            
			   if($len >0)
			   {
				   $list[$arr1[0]] = $arr1[0]; 
               }
               else
               {
                 $list[''] = $arr1[''];   
               } 

			}

			return $list;

		} 
		else 
		{

			return false;

		}

	}
	
	
	
	
	public function treatment_list_rx33($dignosis =null,$section)

	{
	    $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		     $result = $this->db->select("*")

			->from('treatments')

			->where('dignosis like',$dignosis1)
            ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {
              
			foreach ($result as $value) {
                 $arr1=explode("/",$value->RX3);
                 
                 if($len >0){
				   $list[$arr1[1]] = $arr1[1]; 
                   }else{
                     $list[''] = $arr1[''];   
                       
                   }
			}

			return $list;

		} else {

			return false;

		}

	}
	
	public function treatment_list_pk1($dignosis =null,$section)

	{
         $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

			//->where('dignosis like',$dignosis1)
            //->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->SWEDAN] = $value->SWEDAN; 

			}

			return $list;

		} else {

			return false;

		}

	}
	
	public function treatment_list_pk2($dignosis =null,$section)

	{
         $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

			//->where('dignosis like',$dignosis1)
            //->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->VAMAN] = $value->VAMAN; 

			}

			return $list;

		} else {

			return false;

		}

	}
		public function treatment_list_karma($dignosis =null,$section)

	{
         $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

		//	->where('dignosis like',$dignosis1)
           // ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->SNEHAN] = $value->SNEHAN; 

			}

			return $list;

		} else {

			return false;

		}

	}
	
		public function treatment_list_swa1($dignosis =null,$section)

	{
       $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments')

		//	->where('dignosis like',$dignosis1)
           // ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->VIRECHAN] = $value->VIRECHAN; 

			}

			return $list;

		} else {

			return false;

		}

	}
	public function treatment_list_swa11($dignosis =null,$section)

	{
       $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments')

		//	->where('dignosis like',$dignosis1)
            ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->SWA1] = $value->SWA1; 

			}

			return $list;

		} else {

			return false;

		}

	}
	
	
	
	public function treatment_list_YONIDHAVAN($dignosis =null,$section)

	{
       $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

		//	->where('dignosis like',$dignosis1)
            ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->YONIDHAVAN] = $value->YONIDHAVAN; 

			}

			return $list;

		} else {

			return false;

		}

	}
	
	
	public function treatment_list_YONIPICHU($dignosis =null,$section)

	{
       $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

		//	->where('dignosis like',$dignosis1)
            ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->YONIPICHU] = $value->YONIPICHU; 

			}

			return $list;

		} else {

			return false;

		}

	}
	
	
	public function treatment_list_UTTARBASTI($dignosis =null,$section)

	{
      $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
          }
       
		$result = $this->db->select("*")

			->from('treatments1')

		//	->where('dignosis like',$dignosis1)
            ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->UTTARBASTI] = $value->UTTARBASTI; 

			}

			return $list;

		} else {

			return false;

		}

	}
	
	public function treatment_list_swa12($dignosis =null,$section)

	{
       $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments')

		//	->where('dignosis like',$dignosis1)
            //->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->SWA2] = $value->SWA2; 

			}

			return $list;

		} else {

			return false;

		}

	}
	
	
		public function treatment_list_swa2($dignosis =null,$section)

	{
         $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

			//->where('dignosis like',$dignosis1)
            //->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->BASTI] = $value->BASTI; 

			}

			return $list;

		} else {

			return false;

		}

	}
	public function treatment_list_patho($dignosis =null,$section)

	{
         $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

			//->where('dignosis like',$dignosis1)
          //  ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->NASYA] = $value->NASYA; 

			}

			return $list;

		} else {

			return false;

		}

	}
	
		public function treatment_list_patho2($dignosis =null,$section)

	{
          $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

		//	->where('dignosis like',$dignosis1)
            //->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->RAKTAMOKSHAN] = $value->RAKTAMOKSHAN; 

			}

			return $list;

		} else {

			return false;

		}

	}
	
		public function treatment_list_x_ray($dignosis =null,$section)

	{
          $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

			//->where('dignosis like',$dignosis1)
            //->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->X_RAY] = $value->X_RAY; 

			}

			return $list;

		} else {

			return false;

		}

	}
	
		public function treatment_list_ecg($dignosis =null,$section)

	{
        $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

			//->where('dignosis like',$dignosis1)
           // ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->ECG] = $value->ECG; 

			}

			return $list;

		} else {

			return false;

		}

	}
	
	
	public function treatment_list_usg($dignosis =null,$section)

	{
        $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

			//->where('dignosis like',$dignosis1)
           // ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->USG] = $value->USG; 

			}

			return $list;

		} else {

			return false;

		}

	}
		public function treatment_list_patho3($dignosis =null,$section)

	{
         $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments')

			//->where('dignosis like',$dignosis1)
          //  ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->SHIRODHARA_SHIROBASTI] = $value->SHIRODHARA_SHIROBASTI; 
				

			}

			return $list;

		} else {

			return false;

		}

	}
	
		public function treatment_list_OTHER($dignosis =null,$section)

	{
         $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

			//->where('dignosis like',$dignosis1)
           // ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->OTHER] = $value->OTHER; 
				

			}

			return $list;

		} else {

			return false;

		}

	}
		public function treatment_list_SEROLOGYCAL($dignosis =null,$section)

	{
         $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

			//->where('dignosis like',$dignosis1)
           // ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->SEROLOGYCAL] = $value->SEROLOGYCAL; 
				

			}

			return $list;

		} else {

			return false;

		}

	}
	
	public function treatment_list_MICROBIOLOGICAL($dignosis =null,$section)

	{
         $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

			//->where('dignosis like',$dignosis1)
           // ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->MICROBIOLOGICAL] = $value->MICROBIOLOGICAL; 
				

			}

			return $list;

		} else {

			return false;

		}

	}
		public function treatment_list_HEMATOLOGICAL($dignosis =null,$section)

	{
         $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

			//->where('dignosis like',$dignosis1)
           // ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->HEMATOLOGICAL] = $value->HEMATOLOGICAL; 
				

			}

			return $list;

		} else {

			return false;

		}

	}
	
		public function treatment_list_BIOCHEMICAL($dignosis =null,$section)

	{
         $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

			//->where('dignosis like',$dignosis1)
           // ->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->BIOCHEMICAL] = $value->BIOCHEMICAL; 
				

			}

			return $list;

		} else {

			return false;

		}

	}
		public function digno_sub_list()

	{

		$result = $this->db->select("*")

			->from('digno_sub_cat')

			->where('status',1)

			->get()

			->result();



		$list[''] = display('select_dignosis_sub(Category)');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->id_digno_sub] = $value->name; 

			}

			return $list;

		} else {

			return false;

		}

	}
	
	public function treatment_power_list()

	{

		$result = $this->db->select("*")

			->from('treatment_power')

			->where('status',1)

			->get()

			->result();



		$list[''] = display('select_treatment_power');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->power_id] = $value->name; 

			}

			return $list;

		} else {

			return false;

		}

	}
	
	public function treatment_list_skarma($dignosis=null, $section)
	{
	    $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

			//->where('dignosis like',$dignosis1)
            //->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->skarma] = $value->skarma; 

			}

			return $list;

		} else {

			return false;

		}
	}
	
    public function treatment_list_vkarma($dignosis=null, $section)
    {
        $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

			//->where('dignosis like',$dignosis1)
            //->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->vkarma] = $value->vkarma; 

			}

			return $list;

		} else {

			return false;

		}
    }
    
    public function treatment_list_pconcent($dignosis =null,$section)
    {
          $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

		//	->where('dignosis like',$dignosis1)
            //->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->pconcent] = $value->pconcent; 

			}

			return $list;

		} else {

			return false;

		}

	}
	
	public function treatment_list_srotas($dignosis =null,$section)
    {
          $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

		//	->where('dignosis like',$dignosis1)
            //->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->SROTAS] = $value->SROTAS; 

			}

			return $list;

		} else {

			return false;

		}

	}
	
	public function treatment_list_dosha($dignosis =null,$section)
    {
          $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

		//	->where('dignosis like',$dignosis1)
            //->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->DOSHA] = $value->DOSHA; 

			}

			return $list;

		} else {

			return false;

		}

	}
	
	public function treatment_list_dushya($dignosis =null,$section)
    {
          $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

		//	->where('dignosis like',$dignosis1)
            //->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->DUSHYA] = $value->DUSHYA; 

			}

			return $list;

		} else {

			return false;

		}

	}
	
	public function treatment_list_shirobasti($dignosis =null,$section)
    {
          $len= strlen($dignosis);
	    $dd= substr($dignosis,$len - 1);
         if($dd=='I'){
            $dignosis1 = '%'.$dignosis.'%';
           
          }
          else
          {
            $dignosis1 = '%'.$dignosis.'I%';
          
           }
       
		$result = $this->db->select("*")

			->from('treatments1')

		//	->where('dignosis like',$dignosis1)
            //->where('ipd_opd',$section)
			->get()

			->result();



		$list[''] = display('select_treatment');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->SHIROBASTI] = $value->SHIROBASTI; 

			}

			return $list;

		} else {

			return false;

		}

	}
	


public function department_list_new()
	{
		$result = $this->db->select("*")
			->from('department_new')
			->where('status',1)
			->get()
			->result();
		$list[''] = display('select_department');
		if (!empty($result)) {
			foreach ($result as $value) {
				$list[$value->dprt_id] = $value->name; 
			}
			return $list;
		} else {
			return false;
		}
	}


    
	public function department_list_2025()

	{

		$result = $this->db->select("*")

			->from('department_new')

			->where('status',1)

			->get()

			->result();



		$list[''] = display('select_department');

		if (!empty($result)) {

			foreach ($result as $value) {

				$list[$value->dprt_id] = $value->name; 

			}

			return $list;

		} else {

			return false;

		}

	}

 }

