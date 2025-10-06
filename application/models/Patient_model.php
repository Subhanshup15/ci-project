<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Patient_model extends CI_Model {



	public $table = "patient";

 	public $table1 = "patient_ipd";

	public function create($data = [])

	{	 
        $this->db->insert('patient', $data);
        return $this->db->insert_id();
	}
	
// 		public function insert_manual_check_up($data = [])

// 	{	 

// 		 $this->db->insert('manual_treatments', $data);
// 		 return $this->db->insert_id();

// 	}
	 
	 public function insert_manual_check_up($data = [])

	{	 

		 $this->db->insert('manual_treatments', $data);
		 return $this->db->insert_id();

	}
	
	public function read_by_phrama_list1_daily($pharma,$date,$section)
	{
	    
	   if($section=='ipd'){
	       
	       $pharma1_tabe='pharma1_daily_ipd';
	   }
	   else{
	        $pharma1_tabe='pharma1_daily';
	   }
	    
	    $date_like='%'.$date.'%';
	    
	    if($pharma =='churna'){
		$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($pharma1_tabe)
		->where ('daily_date like', $date_like)
	//	->where ('ipd_opd', $section)
		->order_by('name')
	//	->where ('status', '1')
		
        ->get()
        ->result();
        
	    }else{
	        
	    $year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($pharma1_tabe)
		->where ('daily_date like', $date_like)
	//	->where ('ipd_opd', $section)
	//	->where ('status', '2')
		->order_by('name')
        ->get()
    	->result();
    	
	    }
			
	}
	
		public function update_dis($data = [])

	{
       
          return 	$this->db->where('id',$data['id'])
           ->update($this->table1,$data); 
           
            
	} 
	
	 public function update_beds($data = [])

	{
       
          return 	$this->db->where('id',$data['id'])
           ->update('beds',$data); 
           
            
	} 
		public function create_medicine($data = [])

	{	 

		return $this->db->insert('treatments', $data);

	}
	
	
	
	public function create_manual_treatment($data = [],$section)

	{	 
        if($section=='ipd'){
		return $this->db->insert('manual_treatments', $data);
        } else{
          return $this->db->insert('manual_treatments', $data);
        }
	}
	
	public function edit_manual_treatment($data = [],$section, $id)
    {	 
        if($section=='ipd'){
    		return $this->db->where('id',$id)
    		        ->update('manual_treatments',$data);
        } else {
        	return $this->db->where('id',$id)
    		        ->update('manual_treatments',$data);
        }
	}
	
	public function update_manual_treatment($data = [],$section)

	{	 
        if($section=='ipd'){
		return $this->db->where('id',$data['id'])

		->update($this->table1,$data);
        } else {
    	return $this->db->where('id',$data['id'])
		->update($this->table,$data);
		print_r($this->db->last_query());
		exit();
        }

	}
	
	
	
// 	public function create_manual_treatment($data = [],$section)

// 	{	 
//         if($section=='ipd'){
// 		return $this->db->insert('manual_treatments', $data);
//         } else{
//           return $this->db->insert('manual_treatments', $data);
//         }
// 	}
	
// 	public function edit_manual_treatment($data = [],$section, $id)
//     {	 
//         if($section=='ipd'){
//     		return $this->db->where('id',$id)
//     		        ->update('manual_treatments',$data);
//         } else {
//         	return $this->db->where('id',$id)
//     		        ->update('manual_treatments',$data);
//         }
// 	}
	
	
		public function check_data_create($data = [],$section)

	{	 
       
		return $this->db->insert('check_data', $data);
       
	}
	
// 	public function update_manual_treatment($data = [],$section)

// 	{	 
//         if($section=='ipd'){
// 		return $this->db->where('id',$data['id'])

// 		->update($this->table1,$data);
//         } else {
            
//     	return $this->db->where('id',$data['id'])

// 		->update($this->table,$data);
//         }

// 	}
	
		public function check_data_update($data = [],$section)

	{	 
        
		return $this->db->where('id',$data['id'])

		->update(' check_data',$data);
        
    
       

	}
	
// 		public function update_manual_check_up_forround($data = [],$section)
// 	{	 
//         if($section=='ipd'){
// 		return $this->db->where('id',$data['id'])

// 		->update('manual_treatments',$data);
//         } else {
            
//     	return $this->db->where('id',$data['id'])

// 		->update('manual_treatments',$data);
//         }

// 	}

	public function update_manual_check_up_forround($data = [],$section)
	{	 
        if($section=='ipd'){
		return $this->db->where('id',$data['id'])

		->update('manual_treatments',$data);
        } else {
            
    	return $this->db->where('id',$data['id'])

		->update('manual_treatments',$data);
        }

	}
	
	
	
		public function update_manual_check_up_lib($data = [],$section)
	{	 
        if($section=='ipd'){
		return $this->db->where('id',$data['id'])

		->update($this->table1,$data);
        } else {
            
    	return $this->db->where('id',$data['id'])

		->update($this->table,$data);
        }

	}
		public function update_manual_check_up($data = [],$section)

	{	 
        if($section=='ipd'){
		return $this->db->where('id',$data['id'])

		->update($this->table1,$data);
        } else {
            
    	return $this->db->where('id',$data['id'])

		->update($this->table,$data);
        }

	}
	public function create11($data = [])

	{	 

		return $this->db->insert('items', $data);

	}
	public function create_ipd($data = [])

	{	 

		$this->db->insert('patient_ipd', $data);
		return $this->db->insert_id();

	}
	public function insertExcel($data = [])

	{	 

		return $this->db->insert('patient', $data);

	}

 

	public function read()

	{
		$year = '%'.$this->session->userdata['acyear'].'%';

		return $this->db->select("*")

			->from($this->table)
			
			->join('department','department.dprt_id = patient.department_id')

			->where('create_date', $year) 

			->order_by("id", "desc")

			->get()

			->result();

	} 

 

	public function read_by_id($id = null)

	{

	//	$year = '%'.$this->session->userdata['acyear'].'%';

		return $this->db->select("*")

			->from($this->table)

			->where('id',$id)

			//->join('department','department.dprt_id = patient.department_id')

			// ->where('department_id', $department_id)

//			->where('create_date LIKE', $year)

            //->limit(1)
//
			->get()

			->row();

	} 

	public function read_by_id_ipd11($id = null)

	{

	//	$year = '%'.$this->session->userdata['acyear'].'%';

		return $this->db->select("*")

			->from($this->table1)

			->where('id',$id)

			->join('department','department.dprt_id = patient_ipd.department_id')

			// ->where('department_id', $department_id)

//			->where('create_date LIKE', $year)
//
			->get()

			->row();

	} 


public function read_by_id_ipd($id = null)

	{

        //	$year = '%'.$this->session->userdata['acyear'].'%';

        $year = '%' . $this->session->userdata['acyear'] . '%';
        $Cyear = $this->session->userdata['acyear'];

        // Determine the department table based on the academic year
        if ($Cyear == '2025') {
        $departmentTable = 'department_new';
        } else {
        $departmentTable = 'department';
        }

        return $this->db->select("*")

        ->from($this->table1)

        ->where('id',$id)

        ->join($departmentTable, "$departmentTable.dprt_id = patient_ipd.department_id") // Use proper variable parsing

        // ->where('department_id', $department_id)

        //			->where('create_date LIKE', $year)
        //
        ->get()

        ->row();

	} 


	// public function read_by_id_treatment($id = null,$section = null)

	// {


    //         if($section == 'ipd')

    //         {
    //         return $this->db->select("*")

    //         ->from($this->table1)

    //         ->where('id',$id)

    //         ->join('department','department.dprt_id = patient_ipd.department_id')



    //         ->get()

    //         ->row();

    //         } 
    //         else
    //         {
    //         return $this->db->select("*")

    //         ->from($this->table)

    //         ->where('id',$id)

    //         ->join('department','department.dprt_id = patient.department_id')


    //         ->get()

    //         ->row();

    //         }
	// }

    	public function read_by_id_treatment($id = null, $section = null)
{
    if($section == 'ipd')
    {
        $year = '%' . $this->session->userdata['acyear'] . '%';
        $Cyear = $this->session->userdata['acyear'];

        // Determine the department table based on the academic year
        if ($Cyear == '2025') {
            $departmentTable = 'department_new';
        } else {
            $departmentTable = 'department';
        }

        // Correct the join query by using proper variable interpolation
        return $this->db->select("*")
            ->from($this->table1)
            ->where('id', $id)
            ->join($departmentTable, "$departmentTable.dprt_id = patient_ipd.department_id") // Use proper variable parsing
            ->get()
            ->row();
    }
    else
    {
        $year = '%' . $this->session->userdata['acyear'] . '%';
        $Cyear = $this->session->userdata['acyear'];

        // Determine the department table based on the academic year
        if ($Cyear == '2025') {
            $departmentTable = 'department_new';
        } else {
            $departmentTable = 'department';
        }

        // Correct the join query by using proper variable interpolation
        return $this->db->select("*")
            ->from($this->table)
            ->where('id', $id)
            ->join($departmentTable, "$departmentTable.dprt_id = patient.department_id") // Use proper variable parsing
            ->get()
            ->row();
    }
}

	public function read_by_dept_id($department_id = null, $section = null)
	{
	    
	    
	    if($section =='opd'){
		$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table)
		
		->join('department','department.dprt_id = patient.department_id')

		->where('department_id', $department_id)

		->where ('ipd_opd', $section)

		->where('create_date LIKE', $year)

		//->order_by("id", "desc")
        ->limit(5)
		->get()

		->result();
	    }else{
	        
	    $year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table1)
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('department_id', $department_id)

		->where ('ipd_opd', $section)

		->where('create_date LIKE', $year)

	    ->limit(5)

		->get()

		->result();
	    }
			
	}
	
		public function read_by_phrama($section = null, $limit= null, $start= null)
	{
	    
	    $ddd=date('Y-m-d');
	    $ddd1='%'.$ddd.'%';
	    if($section =='opd'){
		$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table)
		
		->join('department','department.dprt_id = patient.department_id')

		//->where('department_id', $department_id)

		->where ('ipd_opd', $section)
        ->where ('create_date LIKE', $ddd1)
		->where('create_date LIKE', $year)

		//->order_by("id", "desc")
        ->limit(5)
		->get()

		->result();
	    }else{
	        
	    $year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table1)
		
		->join('department','department.dprt_id = patient_ipd.department_id')
	    ->where ('ipd_opd', $section)
        ->where ('create_date LIKE', $ddd1)
		->where('create_date LIKE', $year)
         ->limit(5)
		->get()

		->result();
	    }
			
	}
	
	
		public function read_by_phrama_get_count($section = null)
	{
	    
	    $ddd=date('Y-m-d');
	    $ddd1=$ddd." 23:59:00";
	    $ddd1='%'.$ddd.'%';
	    if($section =='opd'){
		$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table)
		
		->join('department','department.dprt_id = patient.department_id')

		//->where('department_id', $department_id)

		->where ('ipd_opd', $section)
        ->where ('create_date LIKE', $ddd1)
		->where('create_date LIKE', $year)

		//->order_by("id", "desc")
       // ->limit(50)
		->get()

		->num_rows();
	    }else{
	        
	    $year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table1)
		
		->join('department','department.dprt_id = patient_ipd.department_id')

	//	->where('department_id', $department_id)

		->where ('ipd_opd', $section)
		->where ('create_date <=', $ddd1)
        
	//	->where('create_date LIKE', $year)

		//->order_by("id", "desc")
        // ->limit(50)
		->get()

		->num_rows();
	    }
			
	}
	
	public function check_round($section,$id,$round)
	{
	    
	    
	    $year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from('manual_treatments')
		

		->where ('ipd_opd', $section)
		->where ('patient_id_auto =', $id)
		->where ('rounds =', $round)
        
		->get()

		->num_rows();
	    
			
	}
	
		public function read_by_phrama_get_count1($section = null,$start_date,$end_date)
	{
	    
	    $ddd=date('Y-m-d');
	    $ddd1=$ddd." 23:59:00";
	    $ddd1='%'.$ddd.'%';
	    if($section =='opd'){
		$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table)
		
		->join('department','department.dprt_id = patient.department_id')

		//->where('department_id', $department_id)

		->where ('ipd_opd', $section)
        ->where ('create_date >=', $start_date)
		->where('create_date <=', $end_date)

		//->order_by("id", "desc")
       // ->limit(50)
		->get()

		->num_rows();
	    }else{
	        
	    $year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table1)
		
		->join('department','department.dprt_id = patient_ipd.department_id')

	//	->where('department_id', $department_id)

		->where ('ipd_opd', $section)
	   ->where ('create_date <=', $end_date)
        
	//	->where('create_date LIKE', $year)

		//->order_by("id", "desc")
        // ->limit(50)
		->get()

		->num_rows();
	    }
			
	}
	
			public function read_by_phrama_date($section = null,$start_date,$end_date,$limit= null, $start= null)
	{
	    
	    $ddd=date('Y-m-d');
	    $ddd1='%'.$ddd.'%';
	    if($section =='opd'){
		$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table)
		
		->join('department','department.dprt_id = patient.department_id')

		//->where('department_id', $department_id)

		->where ('ipd_opd', $section)
        ->where ('create_date >=', $start_date)
		->where('create_date <=', $end_date)

		//->order_by("id", "desc")
        ->limit($limit,$start)
		->get()

		->result();
	    }else{
	        
	    $year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table1)
		
		->join('department','department.dprt_id = patient_ipd.department_id')

	//	->where('department_id', $department_id)

		->where ('ipd_opd', $section)
        ->where ('create_date <=', $end_date)
	//	->where('create_date LIKE', $year)

	//	->order_by("id", "desc")
        ->limit($limit,$start)
		->get()

		->result();
	    }
			
	}
	
	
	
		public function read_by_phrama_date_summary($section = null,$start_date,$end_date)
	{
	    
	    $ddd=date('Y-m-d');
	    $ddd1='%'.$ddd.'%';
	    if($section =='opd'){
		$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table)
		
		->join('department','department.dprt_id = patient.department_id')

		//->where('department_id', $department_id)

		->where ('ipd_opd', $section)
        ->where ('create_date >=', $start_date)
		->where('create_date <=', $end_date)

		//->order_by("id", "desc")
       // ->limit($limit,$start)
		->get()

		->result();
	    }else{
	        
	    $start_date1=date('Y-m-d',strtotime($start_date));
		$start_date2 ='%'.$start_date1.'%';      
		
	    $year = '%'.$this->session->userdata['acyear'].'%';
		
		
		
		 $data['patients1'] = $this->db->select("*")

		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')
			
	    // ->where('department_id =', $department_id)

		->where('discharge_date >=', $end_date)

		->where('create_date <=', $end_date)

		->where('ipd_opd', $section)
		->or_where('discharge_date like', $start_date2)

	//	->where('create_date LIKE', $year)

		->get()

		->result();     	
	        	
		
		$data['patients2']=$this->db->select("*")

		->from($this->table1)
		
		->join('department','department.dprt_id = patient_ipd.department_id')

	//	->where('department_id =', $department_id)

		->where ('ipd_opd', $section)
	    ->where('discharge_date LIKE', '%0000-00-00%')
		
	//	->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

       ->get()

		->result();
	   return	array_merge($data['patients1'], $data['patients2']);
		
		
		
	    }
			
	}
	
		public function read_by_phrama_date_summary_despencing($section,$start_date,$end_date,$limit,$start)
	{
	    
	    $ddd=date('Y-m-d');
	    $ddd1='%'.$ddd.'%';
	    if($section =='opd'){
		$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table)
		
		->join('department','department.dprt_id = patient.department_id')

		//->where('department_id', $department_id)

		->where ('ipd_opd', $section)
        ->where ('create_date >=', $start_date)
		->where('create_date <=', $end_date)

		//->order_by("id", "desc")
        ->limit($limit,$start)
		->get()

		->result();
	    }else{
	        
	    $start_date1=date('Y-m-d',strtotime($start_date));
		$start_date2 ='%'.$start_date1.'%';      
		
	    $year = '%'.$this->session->userdata['acyear'].'%';
		
		
		
		 $data['patients1'] = $this->db->select("*")

		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')
			
	    // ->where('department_id =', $department_id)

		->where('discharge_date >=', $end_date)

		->where('create_date <=', $end_date)

		->where('ipd_opd', $section)
		->or_where('discharge_date like', $start_date2)

	//	->where('create_date LIKE', $year)

		->get()

		->result();     	
	        	
		
		$data['patients2']=$this->db->select("*")

		->from($this->table1)
		
		->join('department','department.dprt_id = patient_ipd.department_id')

	//	->where('department_id =', $department_id)

		->where ('ipd_opd', $section)
	    ->where('discharge_date LIKE', '%0000-00-00%')
		
	//	->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

       ->get()

		->result();
	   return	array_merge($data['patients1'], $data['patients2']);
		
		
		
	    }
			
	}
	
		public function read_by_phrama_date_summary_month($section = null,$start_date,$end_date)
	{
	    
	    $ddd=date('Y-m-d');
	    $ddd1='%'.$ddd.'%';
	    if($section =='opd'){
		$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("daily_date")

		->from('pharma1_daily')
		
        ->where ('daily_date >=', $start_date)
		->where('daily_date <=', $end_date)

		//->order_by("id", "desc")
       // ->limit($limit,$start)
        ->group_by('daily_date')
		->get()

		->result();
	    }else{
	        
	    $start_date1=date('Y-m-d',strtotime($start_date));
		$start_date2 ='%'.$start_date1.'%';      
		
	    $year = '%'.$this->session->userdata['acyear'].'%';
		
		
		
		 	
	   return $this->db->select("daily_date")

		->from('pharma1_daily_ipd')
		
        ->where ('daily_date >=', $start_date)
		->where('daily_date <=', $end_date)

		//->order_by("id", "desc")
       // ->limit($limit,$start)
        ->group_by('daily_date')
		->get()

		->result();	
		
	
		
		
		
	    }
			
	}
	
	
	public function read_by_phrama_date_summary_year($section = null,$start_date,$end_date)
	{
	    
	    $ddd=date('Y-m-d');
	    $ddd1='%'.$ddd.'%';
	    if($section =='opd'){
		$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("COUNT(*)")

		->from('pharma1_daily')
		
        ->where ('daily_date >=', $start_date)
		->where('daily_date <=', $end_date)

		//->order_by("id", "desc")
       // ->limit($limit,$start)
        ->group_by('month_flag')
		->get()

		->result();
	    }else{
	        
	    $start_date1=date('Y-m-d',strtotime($start_date));
		$start_date2 ='%'.$start_date1.'%';      
		
	    $year = '%'.$this->session->userdata['acyear'].'%';
		
		
		
		 	
	   return $this->db->select("COUNT(*)")

		->from('pharma1_daily_ipd')
		
        ->where ('daily_date >=', $start_date)
		->where('daily_date <=', $end_date)

		//->order_by("id", "desc")
       // ->limit($limit,$start)
        ->group_by('month_flag')
		->get()

		->result();	
		
	
		
		
		
	    }
			
	}
	
	
	public function read_by_phrama_date_summary_month_name($section = null,$start_date,$end_date)
	{
	    
	    $ddd=date('Y-m-d');
	    $ddd1='%'.$ddd.'%';
	    if($section =='opd'){
		$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("name")

		->from('pharma1_daily')
		
        ->where ('daily_date >=', $start_date)
		->where('daily_date <=', $end_date)

		//->order_by("id", "desc")
       // ->limit($limit,$start)
        ->group_by('name')
		->get()

		->result();
	    }else{
	        
	    $start_date1=date('Y-m-d',strtotime($start_date));
		$start_date2 ='%'.$start_date1.'%';      
		
	    $year = '%'.$this->session->userdata['acyear'].'%';
		
		
		
		 	
	   return $this->db->select("name")

		->from('pharma1_daily_ipd')
		
        ->where ('daily_date >=', $start_date)
		->where('daily_date <=', $end_date)

		//->order_by("id", "desc")
       // ->limit($limit,$start)
        ->group_by('name')
		->get()

		->result();	
		
	
		
		
		
	    }
			
	}
	
	
	public function pharma_req($section = null,$start_date,$end_date)
	{
	    
	    $ddd=date('Y-m-d');
	    $ddd1='%'.$ddd.'%';
	    if($section =='opd'){
		$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("name,sum(daily_use) as req")

		->from('pharma1_daily')
		
        ->where ('daily_date >=', $start_date)
		->where('daily_date <=', $end_date)

		//->order_by("id", "desc")
       // ->limit($limit,$start)
        ->group_by('name')
		->get()

		->result();
	    }else{
	        
	    $start_date1=date('Y-m-d',strtotime($start_date));
		$start_date2 ='%'.$start_date1.'%';      
		
	    $year = '%'.$this->session->userdata['acyear'].'%';
		
		
		
		 	
	   return $this->db->select("name,sum(daily_use) as req")

		->from('pharma1_daily_ipd')
		
        ->where ('daily_date >=', $start_date)
		->where('daily_date <=', $end_date)

		//->order_by("id", "desc")
       // ->limit($limit,$start)
        ->group_by('name')
		->get()

		->result();	
		
	
		
		
		
	    }
			
	}
	
	
	public function pharma_close($section = null,$start_date,$end_date)
	{
	    
	    $ddd=date('Y-m-d');
	    $ddd1='%'.$ddd.'%';
	    if($section =='opd'){
		$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from('pharma1_daily')
		
        ->where ('daily_date >=', $start_date)
		->where('daily_date <=', $end_date)

		->order_by("name", "asc")
       // ->limit($limit,$start)
       // ->group_by('name')
		->get()

		->result();
	    }else{
	        
	    $start_date1=date('Y-m-d',strtotime($start_date));
		$start_date2 ='%'.$start_date1.'%';      
		
	    $year = '%'.$this->session->userdata['acyear'].'%';
		
		
		
		 	
	   return $this->db->select("*")

		->from('pharma1_daily_ipd')
		
        ->where ('daily_date >=', $start_date)
		->where('daily_date <=', $end_date)

		->order_by("name", "asc")
       // ->limit($limit,$start)
       // ->group_by('name')
		->get()

		->result();	
		
	
		
		
		
	    }
			
	}
	
	
	
	public function read_by_phrama_list($pharma = null)
	{
	    
	    
	    if($pharma =='churna'){
		$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from('pharma1')
		
		//->join('department','department.dprt_id = patient.department_id')

	//	->where('department_id', $department_id)

	//	->where ('status', '1')

		//->where('create_date LIKE', $year)

		//->order_by("id", "desc")
        //->limit(50)
		->get()

		->result();
	    }else{
	        
	    $year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from('pharma1')
		
	//	->join('department','department.dprt_id = patient_ipd.department_id')

		//->where('department_id', $department_id)

	  //  ->where ('status', '2')

	//	->where('create_date LIKE', $year)

		//->order_by("id", "desc")

		->get()

		->result();
	    }
			
	}
		public function read_by_phrama_list1($pharma = null)
	{
	    
	    
	    if($pharma =='churna'){
		$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from('pharma1')
		->order_by('name')
	//	->where ('status', '1')
        ->get()
        ->result();
        
	    }else{
	        
	    $year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from('pharma1')
		->order_by('name')
	//	->where ('status', '2')
        ->get()
    	->result();
    	
	    }
			
	}
	
	public function read_by_phrama_list1_ipd($pharma = null)
	{
	    
	    
	    if($pharma =='churna'){
		$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from('pharma1_ipd')
		->order_by('name')
	//	->where ('status', '1')
        ->get()
        ->result();
        
	    }else{
	        
	    $year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from('pharma1_ipd')
		->order_by('name')
	//	->where ('status', '2')
        ->get()
    	->result();
    	
	    }
			
	}


	public function read_by_dept_id_karma($section = null)
	{
	    
	    
	    if($section =='opd'){
		$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table)
		
		->join('department','department.dprt_id = patient.department_id')

		//->where('department_id', $department_id)

		->where ('ipd_opd', $section)

		->where('create_date LIKE', $year)

		->order_by("id", "desc")
        ->limit(50)
		->get()

		->result();
	    }else{
	        
	        	$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table1)
		
		->join('department','department.dprt_id = patient_ipd.department_id')

	//	->where('department_id', $department_id)
        ->where('discharge_date LIKE', '%0000-00-00%')
		->where ('ipd_opd', $section)

		//->where('create_date LIKE', $year)

		//->order_by("id", "desc")

		->get()

		->result();
	    }
			
	}


	public function read_by_dept_id_date($department_id = null, $section = null,$start_date,$end_date)
	{
	    
	    
	    if($section =='opd'){
	        
		$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table)
		
		->join('department','department.dprt_id = patient.department_id')

		->where('department_id', $department_id)

		->where ('ipd_opd', $section)
		
        
       ->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		->where('create_date LIKE', $year)
	//	->order_by("id", "desc")

		->get()

		->result();
	    }else{
	        
	           $start_date1=date('Y-m-d',strtotime($start_date));
	           $year = '%'.$this->session->userdata['acyear'].'%';
	    
	        	
// 	    $data['patients1'] = $this->db->select("*")

// 		->from('patient_ipd')
		
// 		->join('department','department.dprt_id = patient_ipd.department_id')
			
// 	     ->where('department_id =', $department_id)

// 		->where('discharge_date >=', $end_date)

// 		->where('create_date <=', $end_date)

// 		->where('ipd_opd', $section)
// 		->or_where('discharge_date like', $start_date1)
//       ->where('department_id =', $department_id)

// 		->where('discharge_date >=', $end_date)

// 		->where('create_date <=', $end_date)

// 		->where('ipd_opd', $section)
// 	//	->where('create_date LIKE', $year)

// 		->get()

// 		->result();     
		
// 		//print_r($this->db->last_query());
	        	
		
// 		$data['patients2']=$this->db->select("*")

// 		->from($this->table1)
		
// 		->join('department','department.dprt_id = patient_ipd.department_id')

// 		->where('department_id =', $department_id)

// 		->where ('ipd_opd', $section)
// 	    ->where('discharge_date LIKE', '%0000-00-00%')
		
// 	//	->where('create_date >=', $start_date)

// 		->where('create_date <=', $end_date)


// 		//->where('create_date LIKE', $year)

// 	//	->order_by("id", "desc")

// 		->get()

// 		->result();


        $data['patients1'] = $this->db->select("*")

		->from('patient_ipd')
		
		->where('department_id =', $department_id)

		->where('discharge_date >=', $start_date)

		->where('create_date <=', $start_date)

		->where('ipd_opd', 'ipd')
		->or_where('discharge_date', $start_date1)
		->where('department_id =', $department_id)

		->where('ipd_opd', 'ipd')

		->get()

		->result();
		
	

		//Array 2
		$data['patients2'] = $this->db->select("*")
		
		->from('patient_ipd')
		
		->where('department_id =', $department_id)

		->where('create_date <=', $start_date)

		->where('discharge_date LIKE', '%0000-00-00%')

	    ->where('ipd_opd', 'ipd')

		->get()

		->result();
		
		//print_r($this->db->last_query());
		
	return	array_merge($data['patients1'], $data['patients2']);
		
	    }
			 
	}
	
	public function read_by_dept_id_admit_register_date($department_id = null, $section = null,$start_date,$end_date)
	{
	    
	    
	    if($section =='opd'){
	        
		$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table)
		
		->join('department','department.dprt_id = patient.department_id')

		->where('department_id', $department_id)

		->where ('ipd_opd', $section)
		
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		->where('create_date LIKE', $year)
	//	->order_by("id", "desc")

		->get()

		->result();
	    }else{
	        
	           $start_date1=date('Y-m-d',strtotime($start_date));
	           $year = '%'.$this->session->userdata['acyear'].'%';
	        	
	    return $this->db->select("*")

		->from('patient_ipd')
		
			->join('department','department.dprt_id = patient_ipd.department_id')

		->where('department_id', $department_id)

		->where ('ipd_opd', $section)
		
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		->where('create_date LIKE', $year)
	//	->order_by("id", "desc")

		->get()

		->result(); 	
	        	
	    }
			 
	}
	
	public function read_by_dept_id_date_karma( $section = null,$start_date,$end_date)
	{
	    
	    
	    if($section =='opd'){
	        
		$year = '%'.$this->session->userdata['acyear'].'%';
		
// 		return $this->db->select("*")

// 		->from($this->table)
		
// 		->join('department','department.dprt_id = patient.department_id')

// 		//->where('department_id', $department_id)

// 		->where ('ipd_opd', $section)
		
//         ->where('yearly_reg_no !=', '')
        
//      ->where('create_date >=', $start_date)

// 		->where('create_date <=', $end_date)

// 		->where('create_date LIKE', $year)
// 		//->order_by("id", "desc")

// 		->get()

// 		->result();
        
            $this->db->select('yearly_reg_no');
                $this->db->from('patient_ipd');
                $this->db->where('create_date like', '%'.$start_date.'%');
                $this->db->where('ipd_opd', 'ipd');
                $subQuery =  $this->db->get_compiled_select();
                
                $this->db->where('create_date like', '%'.$start_date.'%');
                $this->db->where("yearly_reg_no NOT IN ($subQuery)", NULL, FALSE);
                $this->db->where('ipd_opd', 'opd');
            $patientList =  $this->db->get('patient')->result();
            
            return $patientList;
	    }else{
	        
	   	$ss=date('Y-m-d',strtotime($start_date));
		$start_date_f=$ss." 23:59:00";
	    $year = '%'.$this->session->userdata['acyear'].'%';
		
		/*return $this->db->select("*")

		->from($this->table1)
		
		->join('department','department.dprt_id = patient_ipd.department_id')

	//	->where('department_id =', $department_id)

		->where ('ipd_opd', $section)
	  // ->where('discharge_date LIKE', '%0000-00-00%')
		
		->or_where('create_date >=', $start_date_f)
        ->or_where('discharge_date LIKE', '%0000-00-00%')
		->where('create_date <=', $end_date)


	//	->where('create_date LIKE', $year)

 	//->order_by("id", "desc")

		->get()

		->result();*/
		
		$ss=date('Y-m-d',strtotime($start_date));
		$start_date_f=$ss." 23:59:00";
		
	$data['patients1']= $this->db->select("*")

		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('discharge_date >=', $start_date_f)
	   // ->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)

		->where('ipd_opd', $section)
		//->or_where('discharge_date', $start_date)

	//	->where('create_date LIKE', $year)

		->get()

		->result();
		
	

		//Array 2
		$data['patients2'] = $this->db->select("*")
		
		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('create_date <=', $start_date_f)

		->where('discharge_date LIKE', '%0000-00-00%')

		->where('ipd_opd', $section)

		->get()

		->result();

	
     return array_merge($data['patients1'], $data['patients2']);
		
		
		
	    }
			
	}
	
	public function read_by_dignosis_garbhini($section = null)
	{
	    
	    
	    if($section =='opd'){
		$year = '%'.$this->session->userdata['acyear'].'%';
		$dignosis = '%GARBHINI-SR%';
		return $this->db->select("*")

		->from($this->table)
		
		->join('department','department.dprt_id = patient.department_id')

     	->where('yearly_reg_no !=', '')

		->where ('ipd_opd', $section)
        ->where('dignosis LIKE', $dignosis)
		->where('create_date LIKE', $year)
		->or_where('followup_date', 'YES')
	    ->where('create_date LIKE', $year)
	//	->order_by("id", "desc")
        //->limit(50)
		->get()

		->result();
	    }else{
	        	$year = '%'.$this->session->userdata['acyear'].'%';
		$dignosis = '%GARBHINI-SR%';
	        	$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table1)
		
		->join('department','department.dprt_id = patient_ipd.department_id')

	//	->where('department_id', $department_id)

		->where ('ipd_opd', $section)
        ->where('dignosis LIKE', $dignosis)
		->where('create_date LIKE', $year)

		->order_by("id", "desc")

		->get()

		->result();
	    }
			
	}
	
	/*public function read_by_dept_investi($section = null)
	{
	    
	    
	    if($section =='opd'){
		$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table)
		
		->join('department','department.dprt_id = patient.department_id')

	//	->where('department_id', $department_id)

		->where ('ipd_opd', $section)

		->where('create_date LIKE', $year)

		->order_by("id", "desc")
        ->limit(50)
		->get()

		->result();
	    }else{
	        
	        	$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table1)
		
		->join('department','department.dprt_id = patient_ipd.department_id')

	//	->where('department_id', $department_id)

		->where ('ipd_opd', $section)

		->where('create_date LIKE', $year)

		->order_by("id", "desc")

		->get()

		->result();
	    }
			
	}

	public function read_by_investi_date($section = null,$start_date,$end_date)
	{
	    
	    
	    if($section =='opd'){
	        
		$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table)
		
		->join('department','department.dprt_id = patient.department_id')

	    ->where('yearly_reg_no !=', '')

		->where ('ipd_opd', $section)
		
        
     ->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		->where('create_date LIKE', $year)
	//	->order_by("id", "desc")

		->get()

		->result();
	    }else{
	        
	        
	        	$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table1)
		
		->join('department','department.dprt_id = patient_ipd.department_id')

	//	->where('department_id =', $department_id)

		->where ('ipd_opd', $section)
	    ->where('discharge_date LIKE', '0000-00-00')
		
	//	->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)


		->where('create_date LIKE', $year)

		//->order_by("id", "desc")

		->get()

		->result();
	    }
			
	}*/
	
	public function read_by_dept_investi($section = null)
	{
	    
	    
	    if($section =='opd'){
		$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table)
		
		->join('department','department.dprt_id = patient.department_id')

	//	->where('department_id', $department_id)

		->where ('ipd_opd', $section)

		->where('create_date LIKE', $year)

		->order_by("id", "desc")
        ->limit(50)
		->get()

		->result();
	    }else{
	        
	        	$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table1)
		
		->join('department','department.dprt_id = patient_ipd.department_id')

	//	->where('department_id', $department_id)

		->where ('ipd_opd', $section)

		->where('create_date LIKE', $year)

		->order_by("id", "desc")

		->get()

		->result();
	    }
			
	}

	public function read_by_investi_date($section = null,$start_date,$end_date)
	{
	    
	    
	    if($section =='opd'){
	        
		$year = '%'.$this->session->userdata['acyear'].'%';
		
// 		return $this->db->select("*")

// 		->from($this->table)
		
// 		->join('department','department.dprt_id = patient.department_id')

// 	//	->where('department_id', $department_id)

// 		->where ('ipd_opd', $section)
		
        
//      ->where('create_date >=', $start_date)

// 		->where('create_date <=', $end_date)

// 		->where('create_date LIKE', $year)
// 	//	->order_by("id", "desc")

// 		->get()

// 		->result();


            $this->db->select('yearly_reg_no');
            $this->db->from('patient_ipd');
            $this->db->where('create_date like', '%'.$start_date.'%');
            $this->db->where('create_date LIKE', $year);
            $this->db->where('ipd_opd', 'ipd');
            $subQuery =  $this->db->get_compiled_select();
            
            $this->db->where('create_date like', '%'.$start_date.'%');
            $this->db->where("yearly_reg_no NOT IN ($subQuery)", NULL, FALSE);
            $this->db->where('ipd_opd', 'opd');
            $this->db->where('create_date LIKE', $year);
            $patientList =  $this->db->get('patient')->result();
            
            return $patientList;

	    }else{
	        
	        
	        	$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table1)
		
		->join('department','department.dprt_id = patient_ipd.department_id')

	//	->where('department_id =', $department_id)

		->where ('ipd_opd', $section)
	    ->where('discharge_date LIKE', '0000-00-00')
		
	//	->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)


		->where('create_date LIKE', $year)

		//->order_by("id", "desc")

		->get()

		->result();
	    }
			
	}
	
	public function read_by_gob_dept($id='',$section = null,$start_date,$end_date)
	{
	    
	    
	    if($section =='opd'){
	        
		$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table)
		
		->join('department','department.dprt_id = patient.department_id')

        //	->where('department_id', $department_id)

            ->where ('ipd_opd', $section)
            
            
        ->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		->where('create_date LIKE', $year)
		->order_by("id", "desc")

		->get()

		->result();
	    }else{
	        
	        
	        	$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table1)
		
		->join('department','department.dprt_id = patient_ipd.department_id')

     	->where('department_id =', $id)

		->where ('ipd_opd', $section)
	    ->where('discharge_date LIKE', '%0000-00-00%')
		
        //	->where('create_date >=', $start_date)

            ->where('create_date <=', $end_date)


            //->where('create_date LIKE', $year)

        //	->order_by("id", "desc")

            ->get()

            ->result();
            }
                
	}
	
	
	public function read_by_gob_dept_date($id='',$section = null,$start_date,$end_date)
	{
	    
	    
	    if($section =='opd'){
	        
		$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table)
		
		->join('department','department.dprt_id = patient.department_id')

	//	->where('department_id', $department_id)

		->where ('ipd_opd', $section)
		
        
     ->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		->where('create_date LIKE', $year)
		->order_by("id", "desc")

		->get()

		->result();
	    }else{
	        
	        
	    /*	$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table1)
		
		->join('department','department.dprt_id = patient_ipd.department_id')

     	->where('department_id =', $id)

		->where ('ipd_opd', $section)
	    ->where('discharge_date LIKE', '%0000-00-00%')
		
	//	->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)


	//	->where('create_date LIKE', $year)

	//	->order_by("id", "desc")

		->get()

		->result();*/
		
		
		 $start_date1=date('Y-m-d',strtotime($start_date));
	     $year = '%'.$this->session->userdata['acyear'].'%';
	        	
	    $data['patients1'] = $this->db->select("*")

		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')
			
	     ->where('department_id =', $id)

		->where('discharge_date >=', $end_date)

		->where('create_date <=', $end_date)

		->where('ipd_opd', $section)
		->or_where('discharge_date like', $start_date1)
         ->where('department_id =', $id)
         ->where('ipd_opd', $section)
	//	->where('create_date LIKE', $year)

		->get()

		->result();     	
	        	
		
		$data['patients2']=$this->db->select("*")

		->from($this->table1)
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('department_id =', $id)

		->where ('ipd_opd', $section)
	    ->where('discharge_date LIKE', '%0000-00-00%')
		
	//	->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)


		//->where('create_date LIKE', $year)

	//	->order_by("id", "desc")

		->get()

		->result();
		
	return	array_merge($data['patients1'], $data['patients2']);
		
		
	    }
			
	}
	
    // 24-01-25
	// public function read_by_dept_id_gob($section = null,$start_date,$end_date)
	// {
	     
	        
	//     /*$year = '%'.$this->session->userdata['acyear'].'%';
		
	// 	return $this->db->select("*")

	// 	->from($this->table1)
		
	// 	->join('department','department.dprt_id = patient_ipd.department_id')

	// 	->where ('ipd_opd', $section)
	//     ->where('discharge_date LIKE', '%0000-00-00%')
		
    //     //	->where('create_date >=', $start_date)

    //         ->where('create_date <=', $end_date)


    //     //	->where('create_date LIKE', $year)

    //     //	->order_by("id", "desc")
    //     //	->limit(100)

	// 	->get()

	// 	->result();*/
		
		
	// 	$start_date1=date('Y-m-d',strtotime($start_date));
	// 	$start_date2 ='%'.$start_date1.'%';
	//     $year = '%'.$this->session->userdata['acyear'].'%';
	        	
	//     $data['patients1'] = $this->db->select("*")

	// 	->from('patient_ipd')

    //     if ($year == 2025) {
    //     $this->db->join('department_new', 'department_new.dprt_id = patient_ipd.department_id');
    //     } else {
    //         $this->db->join('department', 'department.dprt_id = patient_ipd.department_id');
    //     }
		
	// 	// ->join('department_new','department_new.dprt_id = patient_ipd.department_id')
			
	//     // ->where('department_id =', $department_id)

	// 	->where('discharge_date >=', $end_date)

	// 	->where('create_date <=', $end_date)

	// 	->where('ipd_opd', $section)
	// 	->or_where('discharge_date like', $start_date2)

	//     //	->where('create_date LIKE', $year)

	// 	->get()

	// 	->result();     	
	        	
		
	// 	$data['patients2']=$this->db->select("*")

	// 	->from($this->table1)

    //     if ($year == 2025) 
    //     {
    //     $this->db->join('department_new', 'department_new.dprt_id = patient_ipd.department_id');
    //     } else {
    //         $this->db->join('department', 'department.dprt_id = patient_ipd.department_id');
    //     }
            
	// 	// ->join('department_new','department_new.dprt_id = patient_ipd.department_id')

	//     //	->where('department_id =', $department_id)

	// 	->where ('ipd_opd', $section)
	//     ->where('discharge_date LIKE', '%0000-00-00%')
		
	//     //	->where('create_date >=', $start_date)

	// 	->where('create_date <=', $end_date)


	// 	//->where('create_date LIKE', $year)

	//     //	->order_by("id", "desc")

	// 	->get()

	// 	->result();
	//    return	array_merge($data['patients1'], $data['patients2']);
			
	// }


    public function read_by_dept_id_gob($section = null, $start_date, $end_date)
{
    $start_date1 = date('Y-m-d', strtotime($start_date));
    $start_date2 = '%' . $start_date1 . '%';
    $year = '%' . $this->session->userdata['acyear'] . '%';
    
    // Building the first query
    $this->db->select("*")
        ->from('patient_ipd');

    if ($year == '%2025%') {
        $this->db->join('department_new', 'department_new.dprt_id = patient_ipd.department_id');
    } else {
        $this->db->join('department', 'department.dprt_id = patient_ipd.department_id');
    }

    $this->db->where('discharge_date >=', $end_date)
        ->where('create_date <=', $end_date)
        ->where('ipd_opd', $section)
        ->or_where('discharge_date like', $start_date2);

    $data['patients1'] = $this->db->get()->result();

    // Building the second query
    $this->db->select("*")
        ->from($this->table1);

    if ($year == '%2025%') {
        $this->db->join('department_new', 'department_new.dprt_id = patient_ipd.department_id');
    } else {
        $this->db->join('department', 'department.dprt_id = patient_ipd.department_id');
    }

    $this->db->where('ipd_opd', $section)
        ->where('discharge_date LIKE', '%0000-00-00%')
        ->where('create_date <=', $end_date);

    $data['patients2'] = $this->db->get()->result();

    // Merging the results
    return array_merge($data['patients1'], $data['patients2']);
}


/*	public function read_by_section($section = null)
	{

		$year = '%'.$this->session->userdata['acyear'].'%';

		return $this->db->select("*")

		->from($this->table)
		
		->join('department','department.dprt_id = patient.department_id')

		->where('ipd_opd', $section)

		->where('create_date LIKE', $year)

		->order_by("id", "DESC")

		
		->limit(50)

		->get()

		->result();
	}*/
    
    public function read_by_section($section = null)
	{
	 if($section == 'opd'){
		$year = '%'.$this->session->userdata['acyear'].'%';

		return $this->db->select("*")

		->from('patient')
		
		->join('department','department.dprt_id =  patient.department_id')

		->where('ipd_opd', $section)

		->where('create_date LIKE', $year)

            //	->order_by("id", "DESC")

                
                ->limit(5)

                ->get()

                ->result();
            
            }
            
            else{
            $year = '%'.$this->session->userdata['acyear'].'%';

                return $this->db->select("*")

                ->from('patient_ipd')
                
                ->join('department','department.dprt_id = patient_ipd.department_id')
                //->join('beds','beds.id = patient_ipd.bedNo')

                ->where('ipd_opd', $section)
                ->where('discharge_date LIKE', '%0000-00-00%')
            //	->where('create_date LIKE', $year)

            //	->order_by("id", "DESC")

                
            ->limit(5)

                ->get()

                ->result();
            
        }

}

	public function read_by_check_data($section = null,$date_c)
	{
	 if($section == 'opd'){
		$year = '%'.$this->session->userdata['acyear'].'%';
        $date_c1 ='%'.$date_c.'%';
		return $this->db->select("*")

		->from('check_data')
		
		//->join('department','department.dprt_id =  patient.department_id')

		->where('section', $section)

	  	->where('c_date LIKE', $date_c1)

            //	->order_by("id", "DESC")

                
                ->limit(5)

                ->get()

                ->result();
            
            }
            
            else{
            $year = '%'.$this->session->userdata['acyear'].'%';
            $date_c1 ='%'.$date_c.'%';
                return $this->db->select("*")

                ->from('check_data')
                
            //	->join('department','department.dprt_id = patient_ipd.department_id')
                //->join('beds','beds.id = patient_ipd.bedNo')

                ->where('section', $section)
                ->where('c_date LIKE', $date_c1)
            //	->where('create_date LIKE', $year)

            //	->order_by("id", "DESC")

                
                ->limit(5)

                ->get()

                ->result();
            
        }

}


	public function read_by_bed($section = null)
	{
	 
   
      $year = '%'.$this->session->userdata['acyear'].'%';

		return $this->db->select("*")

		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')
	//	->join('beds','beds.id = patient_ipd.bedNo')

		->where('ipd_opd', 'ipd')
        ->where('bed_status', '1')
		//->where('create_date LIKE', $year)
        ->where('discharge_date LIKE', '%0000-00-00%')
		->order_by("patient_ipd.id", "DESC")

		
	//	->limit(50)

		->get()

		->result();
      
   

}

	public function read_by_bed_date($section = null,$start_date,$end_date)
	{
	 
   
      $year = '%'.$this->session->userdata['acyear'].'%';

		return $this->db->select("*")

		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')
		->join('beds','beds.id = patient_ipd.bedNo')

		->where('ipd_opd', 'ipd')
        ->where('beds.status', '1')
         ->where('create_date <=', $end_date)
    	->where('create_date LIKE', $year)

		->order_by("patient_ipd.id", "DESC")

		
		->limit(50)

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

		
		->limit(50)

	

	->get()

	->result();

		
		//die();


		//print_r(get());
		//die();
		

	}

	/*public function update($data = [])
    {
       if($data['ipd_opd']=='opd'){
	           $this->db->where('id',$data['id'])
               ->update($this->table,$data); 
       return $this->db->where('yearly_reg_no',$data['yearly_reg_no'])
              ->or_where('old_reg_no',$data['old_reg_no'])
              ->update($this->table1,$data); 
       } else{
           	$this->db->where('id',$data['id'])
           ->update($this->table1,$data); 
           
            return $this->db->where('yearly_reg_no',$data['yearly_reg_no'])
              ->or_where('old_reg_no',$data['old_reg_no'])
              ->update($this->table,$data); 
       }
	} */
	
	public function update($data = [])
    {
	   // print_r($data['ipd_opd']);
	   //exit;
	    
       if($data['ipd_opd']=='opd'){
	       return $this->db->where('id',$data['id'])
               ->update($this->table,$data); 
    //   return $this->db->where('yearly_reg_no',$data['yearly_reg_no'])
    //           ->or_where('old_reg_no',$data['old_reg_no'])
    //           ->update($this->table1,$data); 
       } else{
           	return $this->db->where('id',$data['id'])
                ->update($this->table1,$data); 
           
            // return $this->db->where('yearly_reg_no',$data['yearly_reg_no'])
            //   ->or_where('old_reg_no',$data['old_reg_no'])
            //   ->update($this->table,$data); 
       }
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

	public function delete_ipd($id = null)
    {

		$this->db->where('id',$id)

			->delete($this->table1);



		if ($this->db->affected_rows()) {

			return true;

		} else {

			return false;

		}

	} 


	public function read_by_dept_month($section = null,$year_no)
	{
	    
	    $year = '%'.$this->session->userdata['acyear'].'%';
	    if($section =='opd'){
	
		
		return $this->db->select("*")

		->from($this->table)
		
		->join('department','department.dprt_id = patient.department_id')

	//	->where('department_id', $department_id)

		->where ('ipd_opd', $section)
	   
		->where('create_date LIKE', $year_no)

		->order_by("id", "desc")
        //->limit(50)
		->get()

		->result();
	    }else{
	        
	        //	$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table1)
		
		->join('department','department.dprt_id = patient_ipd.department_id')

	//	->where('department_id', $department_id)
	   //->where('create_date >=', '2020-01-01 00:00:00')
	   // ->where('create_date <=','2020-01-02 23:59:00')

		->where ('ipd_opd', $section)

		->where('create_date LIKE', $year_no)

		->order_by("id", "desc")

		->get()

		->result();
	    }
			
	}

    public function get_all_dept()

	{

	//	$year = '%'.$this->session->userdata['acyear'].'%';

		return $this->db->select("*")

			->from("department")

			->get()

			->result();

	} 
	
		public function delivery_registerM($section = null)
	{
	
	    if($section =='opd'){
		$year = '%'.$this->session->userdata['acyear'].'%';
		$dignosis = '%UPASTHIT PRASVA-SR%';
		return $this->db->select("*")

		->from($this->table)
		
		->join('department','department.dprt_id = patient.department_id')

     	->where('yearly_reg_no !=', '')

		->where ('ipd_opd', $section)
        ->where('dignosis LIKE', $dignosis)
		->where('create_date LIKE', $year)
	
		->get()

		->result();
	    }else{
	        	$year = '%'.$this->session->userdata['acyear'].'%';
		$dignosis = '%UPASTHIT PRASVA-SR%';
	        	$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from($this->table1)
		
		->join('department','department.dprt_id = patient_ipd.department_id')

	//	->where('department_id', $department_id)

		->where ('ipd_opd', $section)
        ->where('dignosis LIKE', $dignosis)
		->where('create_date LIKE', $year)

		->order_by("id", "desc")

		->get()

		->result();
	    }
			
	}

    
    public function get_pharma()
    {
        
        return $this->db->select('*')->from('pharma_original_stock')->get()->result();
    }
    
    
    public function opening_closing()
    {
        
        return $this->db->select('*')->from('pharma_original_stock')->get()->result();
    }
    /*public function get_tablet()
    {
        return $this->db->select('tab_name')->from('pharma_original_stock')->get()->result();
    }*/
    public function get_tablet()

	{

	return	$result = $this->db->select("*")

			->from('pharma_original_stock')

			->get()

			->result();
	}
	
	public function save_pharma_patient_bal($data = [])
	{
	    $this->db->insert('daily_pharma_patient_stock', $data);
	}
//public function save_pharma_patient_count($data = [])
// 	{
// 	    $this->db->insert('pharma_original_patient', $data);
// 	}
	
	
	public function get_tablet_pharma()

	{

	return	$result = $this->db->select("*")

			->from('pharma_original_tab')

			->get()

			->result();
	}
	
	
	public function fetch_patient()

	{
        
        $year = $this->session->userdata('acyear'); 
        $section = $this->input->post('section');
        if($this->input->post('section')=='opd'){
            $table_name = 'patient';
        }else{
            $table_name = 'patient_ipd';
        }

		return $this->db->select('firstname,yearly_reg_no,old_reg_no')
			->from($table_name)
			->where('create_date >=',date('Y-m-d',strtotime($this->input->post('create_date'))))
			->where('create_date <=',date('Y-m-d',strtotime($this->input->post('create_date'))))
			->where('ipd_opd',$section)
			->get()
			->result();
	}
	
	public function pharma_patient_count_list()
	{
        $section = $this->input->post('section');
		return $this->db->select('*')
			->from('pharma_original_patient')
			->where('created_at >=',date('Y-m-d',strtotime($this->input->post('start_date'))))
			->where('created_at <=',date('Y-m-d',strtotime($this->input->post('start_date'))))
			->where('section',$section)
			->get()
			->result();
	}
	
	
	public function fetch_treatment()
	{
	    $year = $this->session->userdata('acyear'); 
        $name = $this->input->post('patient_name');
        $section = $this->input->post('section');
        if($this->input->post('section')=='opd'){
            $table_name = 'patient';
        }else{
            $table_name = 'patient_ipd';
        }

		return $this->db->select('*')
			->from($table_name)
			->where('create_date',date('Y-m-d',strtotime($this->input->post('create_date'))))
// 			->where('create_date <=',date('Y-m-d',strtotime($this->input->post('create_date'))))
			->where('ipd_opd',$section)
			->where('firstname LIKE','%'.$name.'%')
			->get()
			->row();
		//	print_r($this->db->last_query());
	}
	
	public function fetch_closing_tab1()
	{
	    
		return $this->db->select('*')
			->from('pharma_original_stock')
			->where('tab_name',$this->input->post('tab_name1'))
			->get()
			->row();
	}
	public function fetch_closing_tab2()
	{
	    
		return $this->db->select('*')
			->from('pharma_original_stock')
			->where('tab_name',$this->input->post('tab_name2'))
			->get()
			->row();
	}
	public function fetch_closing_tab3()
	{
	    
		return $this->db->select('*')
			->from('pharma_original_stock')
			->where('tab_name',$this->input->post('tab_name3'))
			->get()
			->row();
	}
	public function fetch_closing_tab4()
	{
	    
		return $this->db->select('*')
			->from('pharma_original_stock')
			->where('tab_name',$this->input->post('tab_name4'))
			->get()
			->row();
	}
	public function fetch_closing_tab5()
	{
	    
		return $this->db->select('*')
			->from('pharma_original_stock')
			->where('tab_name',$this->input->post('tab_name5'))
			->get()
			->row();
	}
	public function fetch_closing_tab6()
	{
	    
		return $this->db->select('*')
			->from('pharma_original_stock')
			->where('tab_name',$this->input->post('tab_name6'))
			->get()
			->row();
	}
	public function fetch_closing_tab7()
	{
	    
		return $this->db->select('*')
			->from('pharma_original_stock')
			->where('tab_name',$this->input->post('tab_name7'))
			->get()
			->row();
	}
	public function fetch_closing_tab8()
	{
	    
		return $this->db->select('*')
			->from('pharma_original_stock')
			->where('tab_name',$this->input->post('tab_name8'))
			->get()
			->row();
	}
	public function fetch_closing_tab9()
	{
	    
		return $this->db->select('*')
			->from('pharma_original_stock')
			->where('tab_name',$this->input->post('tab_name9'))
			->get()
			->row();
	}
	public function fetch_closing_tab10()
	{
	    
		return $this->db->select('*')
			->from('pharma_original_stock')
			->where('tab_name',$this->input->post('tab_name10'))
			->get()
			->row();
	}
	public function fetch_closing_tab11()
	{
	    
		return $this->db->select('*')
			->from('pharma_original_stock')
			->where('tab_name',$this->input->post('tab_name11'))
			->get()
			->row();
	}
	public function fetch_closing_tab12()
	{
	    
		return $this->db->select('*')
			->from('pharma_original_stock')
			->where('tab_name',$this->input->post('tab_name12'))
			->get()
			->row();
	}
	public function fetch_closing_tab13()
	{
	    
		return $this->db->select('*')
			->from('pharma_original_stock')
			->where('tab_name',$this->input->post('tab_name13'))
			->get()
			->row();
	}
	public function fetch_closing_tab14()
	{
	    
		return $this->db->select('*')
			->from('pharma_original_stock')
			->where('tab_name',$this->input->post('tab_name14'))
			->get()
			->row();
	}
	public function fetch_closing_tab15()
	{
	    
		return $this->db->select('*')
			->from('pharma_original_stock')
			->where('tab_name',$this->input->post('tab_name15'))
			->get()
			->row();
	}
	public function fetch_closing_tab16()
	{
	    
		return $this->db->select('*')
			->from('pharma_original_stock')
			->where('tab_name',$this->input->post('tab_name16'))
			->get()
			->row();
	}
	public function fetch_closing_tab17()
	{
	    
		return $this->db->select('*')
			->from('pharma_original_stock')
			->where('tab_name',$this->input->post('tab_name17'))
			->get()
			->row();
	}
	public function fetch_closing_tab18()
	{
	    
		return $this->db->select('*')
			->from('pharma_original_stock')
			->where('tab_name',$this->input->post('tab_name18'))
			->get()
			->row();
	}
	public function fetch_closing_tab19()
	{
	    
		return $this->db->select('*')
			->from('pharma_original_stock')
			->where('tab_name',$this->input->post('tab_name19'))
			->get()
			->row();
	}
	public function fetch_closing_tab20()
	{
	    
		return $this->db->select('*')
			->from('pharma_original_stock')
			->where('tab_name',$this->input->post('tab_name20'))
			->get()
			->row();
	}
	public function fetch_closing_tab21()
	{
	    
		return $this->db->select('*')
			->from('pharma_original_stock')
			->where('tab_name',$this->input->post('tab_name21'))
			->get()
			->row();
	}
	public function fetch_closing_tab22()
	{
	    
		return $this->db->select('*')
			->from('pharma_original_stock')
			->where('tab_name',$this->input->post('tab_name22'))
			->get()
			->row();
	}
	public function fetch_closing_tab23()
	{
	    
		return $this->db->select('*')
			->from('pharma_original_stock')
			->where('tab_name',$this->input->post('tab_name23'))
			->get()
			->row();
	}
	public function fetch_closing_tab24()
	{
	    
		return $this->db->select('*')
			->from('pharma_original_stock')
			->where('tab_name',$this->input->post('tab_name24'))
			->get()
			->row();
	}
	public function fetch_closing_tab25()
	{
	    
		return $this->db->select('*')
			->from('pharma_original_stock')
			->where('tab_name',$this->input->post('tab_name25'))
			->get()
			->row();
	}
	

	public function fetch_patient_investi_hm()

	{
        $year = $this->session->userdata('acyear'); 
        $test_type = $this->input->post('test_type');
        $section = $this->input->post('section');
        
        for($i=0;$i<count($test_type);$i++)
        {
		return $this->db->select('DISTINCT(investigation_test_master.test_name),investigation_test_master.unit,investigation_test_master.reference_range,investigation_test_master.report_type,
		investigation_test_master.report_section,investigation_test_master.test_type,investigation_test_master.min_range,investigation_test_master.max_range')
			->from('investigation_test_master')
			->where('report_type',$test_type[$i])
			->where('ipd_opd',$section)
			->get()
			->result();
        }
		
	}
		public function save_panch_data_count($data = [])
	{
	    $this->db->insert('original_panch_report_count', $data);
	}
	
	public function save_panch_data_test_count($data = [])
	{
	    $this->db->insert('save_panch_data_test_count', $data);
	}
		public function edit_pharma($id)
	{

	return	$result = $this->db->select("*")

			->from('pharma_original_stock')
			
			->where('id',$id)

			->get()

			->row();
	}
	

    public function fetch_patient_investi()
	{
        
        $year = $this->session->userdata('acyear'); 
        $section = $this->input->post('section');
        // if($this->input->post('section')=='opd'){
        //     $table_name = 'patient';
        // }else{
        //     $table_name = 'patient_ipd';
        // }
        
        $start_date = date('Y-m-d',strtotime($this->input->post('create_date')));
        $end_date = date('Y-m-d',strtotime($this->input->post('create_date')));
        
        if($section=='opd'){
		return $this->db->select('*')
			->from('patient')
			->where('create_date >=',$start_date)
			->where('create_date <=',$end_date)
			->where('ipd_opd',$section)
			->get()
			->result();
        }
        else
        {
    		return $this->db->select("*")
    		->from('patient_ipd')
    		->join('department','department.dprt_id = patient_ipd.department_id')
    		->where('create_date <=', $start_date)
    		->where('discharge_date LIKE', '%0000-00-00%')
    	    ->where('ipd_opd', 'ipd')
    		->get()
    		->result();
        }	
			
	
	}
	public function fetch_treatment_investi()
	{
	    $year = $this->session->userdata('acyear'); 
        $name = $this->input->post('patient_name');
        $section = $this->input->post('section');
        $start_date = date('Y-m-d',strtotime($this->input->post('create_date')));
        $end_date = date('Y-m-d',strtotime($this->input->post('create_date')));

        if($section=='opd'){
		return $this->db->select('*')
			->from('patient')
			->where('create_date',$start_date)
			->where('ipd_opd',$section)
			->where('firstname LIKE','%'.$name.'%')
			->get()
			->row();
        }
        else
        {
    		return $this->db->select("*")
    		->from('patient_ipd')
    		->join('department','department.dprt_id = patient_ipd.department_id')
    		->where('create_date <=', $start_date)
    		->where('firstname LIKE','%'.$name.'%')
    		->where('discharge_date LIKE', '%0000-00-00%')
    	    ->where('ipd_opd', 'ipd')
    		->get()
    		->row();
        }	

	}
	
	public function fetch_patient_panch()
	{
        
        $year = $this->session->userdata('acyear'); 
        $section = $this->input->post('section');
        if($this->input->post('section')=='opd'){
            $table_name = 'patient';
        }else{
            $table_name = 'patient_ipd';
        }

		return $this->db->select('*')
			->from($table_name)
			->where('create_date >=',date('Y-m-d',strtotime($this->input->post('create_date'))))
			->where('create_date <=',date('Y-m-d',strtotime($this->input->post('create_date'))))
			->where('ipd_opd',$section)
			->get()
			->result();
	
	}
	public function fetch_treatment_panch()
	{
	    $year = $this->session->userdata('acyear'); 
        $name = $this->input->post('patient_name');
        $section = $this->input->post('section');
        if($this->input->post('section')=='opd'){
            $table_name = 'patient';
        }else{
            $table_name = 'patient_ipd';
        }

		return $this->db->select('*')
			->from($table_name)
			->where('create_date',date('Y-m-d',strtotime($this->input->post('create_date'))))
// 			->where('create_date <=',date('Y-m-d',strtotime($this->input->post('create_date'))))
			->where('ipd_opd',$section)
			->where('firstname LIKE','%'.$name.'%')
			->get()
			->row();
		//	print_r($this->db->last_query());
	}
	

	public function fetch_patient_xray()
	{
        
        $year = $this->session->userdata('acyear'); 
        $section = $this->input->post('section');
// 		return $this->db->select('*')
// 			->from($table_name)
// 			->where('create_date >=',date('Y-m-d',strtotime($this->input->post('create_date'))))
// 			->where('create_date <=',date('Y-m-d',strtotime($this->input->post('create_date'))))
// 			->where('ipd_opd',$section)
// 			->get()
// 			->result();
        $start_date = date('Y-m-d',strtotime($this->input->post('create_date')));
        $end_date = date('Y-m-d',strtotime($this->input->post('create_date')));
        
        if($section=='opd'){
		return $this->db->select('*')
			->from('patient')
			->where('create_date >=',$start_date)
			->where('create_date <=',$end_date)
			->where('ipd_opd',$section)
			->get()
			->result();
        }
        else
        {
    		return $this->db->select("*")
    		->from('patient_ipd')
    		->join('department','department.dprt_id = patient_ipd.department_id')
    		->where('create_date <=', $start_date)
    		->where('discharge_date LIKE', '%0000-00-00%')
    	    ->where('ipd_opd', 'ipd')
    		->get()
    		->result();
        }	
	
	}
	public function fetch_treatment_xray()
	{
	    $year = $this->session->userdata('acyear'); 
        $name = $this->input->post('patient_name');
        $section = $this->input->post('section');
        if($this->input->post('section')=='opd'){
            $table_name = 'patient';
        }else{
            $table_name = 'patient_ipd';
        }

		return $this->db->select('*')
			->from($table_name)
			->where('create_date',date('Y-m-d',strtotime($this->input->post('create_date'))))
// 			->where('create_date <=',date('Y-m-d',strtotime($this->input->post('create_date'))))
			->where('ipd_opd',$section)
			->where('firstname LIKE','%'.$name.'%')
			->get()
			->row();
		//	print_r($this->db->last_query());
	}
	
	public function fetch_patient_ecg()
	{
        
        $year = $this->session->userdata('acyear'); 
        $section = $this->input->post('section');
// 		return $this->db->select('*')
// 			->from($table_name)
// 			->where('create_date >=',date('Y-m-d',strtotime($this->input->post('create_date'))))
// 			->where('create_date <=',date('Y-m-d',strtotime($this->input->post('create_date'))))
// 			->where('ipd_opd',$section)
// 			->get()
// 			->result();
        $start_date = date('Y-m-d',strtotime($this->input->post('create_date')));
        $end_date = date('Y-m-d',strtotime($this->input->post('create_date')));
        
        if($section=='opd'){
		return $this->db->select('*')
			->from('patient')
			->where('create_date >=',$start_date)
			->where('create_date <=',$end_date)
			->where('ipd_opd',$section)
			->get()
			->result();
        }
        else
        {
    		return $this->db->select("*")
    		->from('patient_ipd')
    		->join('department','department.dprt_id = patient_ipd.department_id')
    		->where('create_date <=', $start_date)
    		->where('discharge_date LIKE', '%0000-00-00%')
    	    ->where('ipd_opd', 'ipd')
    		->get()
    		->result();
        }	
	
	}
	public function fetch_treatment_ecg()
	{
	    $year = $this->session->userdata('acyear'); 
        $name = $this->input->post('patient_name');
        $section = $this->input->post('section');
        $start_date = date('Y-m-d',strtotime($this->input->post('create_date')));
        $end_date = date('Y-m-d',strtotime($this->input->post('create_date')));

        if($section=='opd'){
		return $this->db->select('*')
			->from('patient')
			->where('create_date',$start_date)
			->where('ipd_opd',$section)
			->where('firstname LIKE','%'.$name.'%')
			->get()
			->row();
        }
        else
        {
    		return $this->db->select("*")
    		->from('patient_ipd')
    		->join('department','department.dprt_id = patient_ipd.department_id')
    		->where('create_date <=', $start_date)
    		->where('firstname LIKE','%'.$name.'%')
    		->where('discharge_date LIKE', '%0000-00-00%')
    	    ->where('ipd_opd', 'ipd')
    		->get()
    		->row();
        }	

	}
	
	public function fetch_patient_usg()
	{
        
        $year = $this->session->userdata('acyear'); 
        $section = $this->input->post('section');
// 		return $this->db->select('*')
// 			->from($table_name)
// 			->where('create_date >=',date('Y-m-d',strtotime($this->input->post('create_date'))))
// 			->where('create_date <=',date('Y-m-d',strtotime($this->input->post('create_date'))))
// 			->where('ipd_opd',$section)
// 			->get()
// 			->result();
        $start_date = date('Y-m-d',strtotime($this->input->post('create_date')));
        $end_date = date('Y-m-d',strtotime($this->input->post('create_date')));
        
        if($section=='opd'){
		return $this->db->select('*')
			->from('patient')
			->where('create_date >=',$start_date)
			->where('create_date <=',$end_date)
			->where('ipd_opd',$section)
			->get()
			->result();
        }
        else
        {
    		return $this->db->select("*")
    		->from('patient_ipd')
    		->join('department','department.dprt_id = patient_ipd.department_id')
    		->where('create_date <=', $start_date)
    		->where('discharge_date LIKE', '%0000-00-00%')
    	    ->where('ipd_opd', 'ipd')
    		->get()
    		->result();
        }	
	
	}
	public function fetch_treatment_usg()
	{
	    $year = $this->session->userdata('acyear'); 
        $name = $this->input->post('patient_name');
        $section = $this->input->post('section');
        $start_date = date('Y-m-d',strtotime($this->input->post('create_date')));
        $end_date = date('Y-m-d',strtotime($this->input->post('create_date')));

        if($section=='opd'){
		return $this->db->select('*')
			->from('patient')
			->where('create_date',$start_date)
			->where('ipd_opd',$section)
			->where('firstname LIKE','%'.$name.'%')
			->get()
			->row();
        }
        else
        {
    		return $this->db->select("*")
    		->from('patient_ipd')
    		->join('department','department.dprt_id = patient_ipd.department_id')
    		->where('create_date <=', $start_date)
    		->where('firstname LIKE','%'.$name.'%')
    		->where('discharge_date LIKE', '%0000-00-00%')
    	    ->where('ipd_opd', 'ipd')
    		->get()
    		->row();
        }	

	}
	
	
	
	public function fetch_patient_phisiotheropy()
	{
        
        $year = $this->session->userdata('acyear'); 
        $section = $this->input->post('section');
        $start_date = date('Y-m-d',strtotime($this->input->post('create_date')));
        $end_date = date('Y-m-d',strtotime($this->input->post('create_date')));
        
        if($section=='opd'){
		return $this->db->select('*')
			->from('patient')
			->where('create_date >=',$start_date)
			->where('create_date <=',$end_date)
			->where('ipd_opd',$section)
			->get()
			->result();
        }
        else
        {
    		return $this->db->select("*")
    		->from('patient_ipd')
    		->join('department','department.dprt_id = patient_ipd.department_id')
    		->where('create_date <=', $start_date)
    		->where('discharge_date LIKE', '%0000-00-00%')
    	    ->where('ipd_opd', 'ipd')
    		->get()
    		->result();
        }	
	
	}
	
	public function fetch_treatment_phisiotheropy()
	{
	    $year = $this->session->userdata('acyear'); 
        $name = $this->input->post('patient_name');
        $section = $this->input->post('section');
        $start_date = date('Y-m-d',strtotime($this->input->post('create_date')));
        $end_date = date('Y-m-d',strtotime($this->input->post('create_date')));

        if($section=='opd'){
		return $this->db->select('*')
			->from('patient')
			->where('create_date',$start_date)
			->where('ipd_opd',$section)
			->where('firstname LIKE','%'.$name.'%')
			->get()
			->row();
        }
        else
        {
    		return $this->db->select("*")
    		->from('patient_ipd')
    		->join('department','department.dprt_id = patient_ipd.department_id')
    		->where('create_date <=', $start_date)
    		->where('firstname LIKE','%'.$name.'%')
    		->where('discharge_date LIKE', '%0000-00-00%')
    	    ->where('ipd_opd', 'ipd')
    		->get()
    		->row();
        }	

	}
	

     public function read_by_dept_month_new($section = null,$start_date,$end_date)
	{
	    $year = '%'.$this->session->userdata['acyear'].'%';
	    if($section =='opd'){
		return $this->db->select("*")

		->from($this->table)
		->join('department','department.dprt_id = patient.department_id')
	//	->where('department_id', $department_id)
		->where ('ipd_opd', $section)

		->where('create_date >=', $start_date)
        ->where('create_date <=', $end_date)
       
        
		->order_by("id", "desc")
        //->limit(50)
		->get()
		->result();
	    }else{
	        
	        //	$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")
		->from($this->table1)
		->join('department','department.dprt_id = patient_ipd.department_id')
	    //	->where('department_id', $department_id)
	    //->where('create_date >=', '2020-01-01 00:00:00')
	    // ->where('create_date <=','2020-01-02 23:59:00')
		->where ('ipd_opd', $section)

		->where('create_date >=', $start_date)
        ->where('create_date <=', $end_date)

		->order_by("id", "desc")
		->get()
		->result();
	    }
			
	}


    
///////////////2025//////////
    public function gob_2025($section = null,$start_date,$end_date)
	{
	     
		$start_date1=date('Y-m-d',strtotime($start_date));
		$start_date2 ='%'.$start_date1.'%';
	     $year = '%'.$this->session->userdata['acyear'].'%';
	    $data['patients1'] = $this->db->select("*")
		->from('patient_ipd')
		->join('department_new','department_new.dprt_id = patient_ipd.department_id')
		->where('discharge_date >=', $end_date)
		->where('create_date <=', $end_date)
		->where('ipd_opd', $section)
		->or_where('discharge_date like', $start_date2)
		->get()
		->result();     	
	        	
		
		$data['patients2']=$this->db->select("*")
		->from($this->table1)
		->join('department_new','department_new.dprt_id = patient_ipd.department_id')
		->where ('ipd_opd', $section)
	    ->where('discharge_date LIKE', '%0000-00-00%')
		->where('create_date <=', $end_date)
		->get()

		->result();
	   return	array_merge($data['patients1'], $data['patients2']);
			
	}
    public function gob_dept_date_2025($id='',$section = null,$start_date,$end_date)
	{
	    if($section =='opd'){     
		$year = '%'.$this->session->userdata['acyear'].'%';
		return $this->db->select("*")
		->from($this->table)
		->join('department_new','department_new.dprt_id = patient.department_id')
		->where ('ipd_opd', $section)
        ->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('create_date LIKE', $year)
        ->where('department_id', $id)
		->order_by("id", "asc")
		->get()
		->result();
	    }else{
	        
		 $start_date1=date('Y-m-d',strtotime($start_date));
	     $year = '%'.$this->session->userdata['acyear'].'%';
	    $data['patients1'] = $this->db->select("*")
		->from('patient_ipd')
		->join('department_new','department_new.dprt_id = patient_ipd.department_id')
	     ->where('department_id =', $id)
		->where('discharge_date >=', $end_date)
		->where('create_date <=', $end_date)
		->where('ipd_opd', $section)
		->or_where('discharge_date like', $start_date1)
         ->where('department_id =', $id)
         ->where('ipd_opd', $section)
		->get()
		->result();     	
		$data['patients2']=$this->db->select("*")
		->from($this->table1)
		->join('department_new','department_new.dprt_id = patient_ipd.department_id')
		->where('department_id =', $id)
		->where ('ipd_opd', $section)
	    ->where('discharge_date LIKE', '%0000-00-00%')
		->where('create_date <=', $end_date)
		->get()
		->result();
        return	array_merge($data['patients1'], $data['patients2']);
            }	
	}


	public function read_by_dept_id_2025($department_id_decode = null, $section = null)
	{
	    if($section =='opd'){
		$year = '%'.$this->session->userdata['acyear'].'%';
		return $this->db->select("*")
		->from($this->table)
		->join('department','department.dprt_id = patient.department_id')
		->where('department_id', $department_id_decode)
		->where ('ipd_opd', $section)
		->where('create_date LIKE', $year)
        ->limit(5)
		->get()

		->result();
	    }else{ 
	    $year = '%'.$this->session->userdata['acyear'].'%';
		return $this->db->select("*")
		->from($this->table1)
		->join('department','department.dprt_id = patient_ipd.department_id')
		->where('department_id', $department_id_decode)
		->where ('ipd_opd', $section)
		->where('create_date LIKE', $year)
	    ->limit(5)
		->get()
		->result();
	    }
			
	}

    public function admit_register_ipd_date($department_id = null, $section = null,$start_date,$end_date)
	{
	    if($section =='opd'){
		$year = '%'.$this->session->userdata['acyear'].'%';
		return $this->db->select("*")
		->from($this->table)
		->join('department_new','department_new.dprt_id = patient.department_id')
		->where('department_id', $department_id)
		->where ('ipd_opd', $section)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('create_date LIKE', $year)
            ->get()
            ->result();
	    }else{
	           $start_date1=date('Y-m-d',strtotime($start_date));
	           $year = '%'.$this->session->userdata['acyear'].'%';
	    return $this->db->select("*")
		->from('patient_ipd')
			->join('department_new','department_new.dprt_id = patient_ipd.department_id')
		->where('department_id', $department_id)
		->where ('ipd_opd', $section)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('create_date LIKE', $year)
            ->get()
            ->result(); 	       
            }	 
	}


     public function read_by_dignosis_suvarn($section = null)
	{
	    
	    
	    if($section =='opd'){
		$year = '%'.$this->session->userdata['acyear'].'%';
		$dignosis = '%FOR SUVARNA PRASHAN%';
		return $this->db->select("*")

		->from('camp')
		
		->join('department','department.dprt_id = camp.department_id')

     	->where('yearly_reg_no !=', '')

		->where ('ipd_opd', $section)
      //  ->where('dignosis LIKE', $dignosis)
		->where('create_date LIKE', $year)
		->or_where('followup_date', 'YES')
	    ->where('create_date LIKE', $year)
	
		->get()

		->result();
	    }else{
	        	$year = '%'.$this->session->userdata['acyear'].'%';
		$dignosis = '%FOR SUVARNA PRASHAN%';
	        	$year = '%'.$this->session->userdata['acyear'].'%';
		
		return $this->db->select("*")

		->from('camp')
		
		->join('department','department.dprt_id = camp.department_id')


		->where ('ipd_opd', $section)
        ->where('dignosis LIKE', $dignosis)
		->where('create_date LIKE', $year)

		->order_by("id", "desc")

		->get()

		->result();
	    }
			
	}

    	public function d_opd_dept_id($department_id_decode = null, $section = null)
	{
	    if($section =='opd'){
		$year = '%'.$this->session->userdata['acyear'].'%';
		return $this->db->select("*")
		->from($this->table)
		->join('department_new','department_new.dprt_id = patient.department_id')
		->where('department_id', $department_id_decode)
		->where ('ipd_opd', $section)
		->where('create_date LIKE', $year)
        ->limit(1)
		->get()
		->result();
	    }else{ 
	    $year = '%'.$this->session->userdata['acyear'].'%';
		return $this->db->select("*")
		->from($this->table1)
		->join('department_new','department_new.dprt_id = patient_ipd.department_id')
		->where('department_id', $department_id_decode)
		->where ('ipd_opd', $section)
		->where('create_date LIKE', $year)
	    ->limit(1)
		->get()
		->result();
	    }
			
	}
    



    	public function patient_despensing_2025($start_date,$end_date,$section)
    {
        if($section == 'ipd')
        {
            return $this->db->select('id, yearly_reg_no, old_reg_no, address, sex, date_of_birth ,dignosis ,firstname, department_id, create_date, name, proxy_id,manual_status')
            ->from('patient_ipd')
            ->join('department', 'department.dprt_id = patient_ipd.department_id')
            ->where('create_date <=', $date)
            ->group_start()
            ->where('discharge_date >=',$date)
            ->or_where('discharge_date',$date)
            ->or_where('discharge_date LIKE','%0000-00-00%')
            ->group_end()
            ->where('ipd_opd', $section)
            ->get()
            ->result();
        }
        else
        {
            return $this->db->select('id, yearly_reg_no, old_reg_no, address, sex, date_of_birth ,dignosis ,firstname, department_id, create_date, name, proxy_id,manual_status')
            ->from('patient')
            ->join('department', 'department.dprt_id = patient.department_id')
            ->where('create_date>=', $start_date)
             ->where('create_date<=', $end_date)
            ->where('ipd_opd', $section)
            ->get()
            ->result();
        }
        
    }
   public function get_tretment($manual_status,$department_id,$proxy_id,$che,$id,$section_tret)
                                {
                                    if($patient->manual_status == 0)
                                                {
                                                    return $this->db->select("*")
                                                        ->from('treatments1')
                                                        ->where('dignosis',$che)
                                                        ->where('department_id',$department_id)
                                                        // ->where('m_f',$sex)
                                                        ->where('proxy_id',$proxy_id)
                                                        ->where('ipd_opd',$section_tret)
                                                        ->get()
                                                        ->row();
                                                //  print_r($this->db->last_query());
                                                    if(empty($tretment_new))
                                                    {
                                                      return $this->db->select("*")
                                                            ->from('treatments1')
                                                            ->where('dignosis',$che)
                                                            ->where('department_id',$department_id)
                                                            // ->where('m_f',$sex)
                                                            ->where('proxy_id',$proxy_id)
                                                            ->where('ipd_opd','ipd')
                                                            ->get()
                                                            ->row();
                                                    }
                                                }
                                                else 
                                                {
                                                    if($section == 'ipd')
                                                    {
                                                        return  $this->db->select("*")
                                                        ->from('manual_treatments')
                                                        ->where('patient_id_auto',$id)
                                                        ->where('ipd_round_date',$datefrom)
                                                        ->where('ipd_opd',$section_tret)
                                                        ->order_by("id", "desc")
                                                        ->get()
                                                        ->row();
                                                    }
                                                    else
                                                    {
                                                    	return $this->db->select("*")
                                                        ->from('manual_treatments')
                                                        ->where('patient_id_auto',$id)
                                                        ->where('ipd_opd',$section_tret)
                                                        ->order_by("id", "desc")
                                                        ->get()
                                                        ->row();
                                                    }
                                                }
                                                  

}
}

