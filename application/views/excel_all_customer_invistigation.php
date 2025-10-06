<?php
//$this->load->helper('custom');
error_reporting(0);

		$filename1 = "Patient_Investigation_report.csv";
		$exists = file_exists('Patient_Investigation_report.csv');
			if($exists)
			{
				unlink($filename1);
			}
 
		//$filename1 = "All_Customer_Detail_report.csv";
		$filename1 = "Patient_Investigation_report".date('Y-m-d').".csv";
		
		$fp = fopen($filename1, "wb");
			
		//$insert_rows.= 'Id' . "\t".'Customer Name' . "\t" . 'Contact' . "\t" . 'Email ' . "\t" . 'Company' . "\t" . 'Address-1' . "\t" . 'Address-2' . "\t" . 'City' . "\t" . 'Pincode'. "\t" . 'Dealer Name'. "\t" .'Balance' . "\t" .'Balance Bottles' . "\t" .'Deposit Bottles' . "\t" .'Deposit Amount' . "\t" .'Payment Type' . "\t" . 'Birthday' . "\t" .'Anniverssary' . "\t" .'Register Date' . "\t" .'Status' ."\n\n";
		$insert_rows.= 'Sr No' . "\t".'New No' . "\t" . 'Old No' . "\t" . 'Name' . "\t" . 'Sex' . "\t" . 'Age' . "\t" . 'Department' . "\t" . 'Diagnosis' . "\t" . 'HEMATOLOGICAL'. "\t" . 'SEROLOGYCAL'. "\t" . 'BIOCHEMICAL'."\t" . 'MICROBIOLOGICAL'."\t" . 'X-RAY'."\t" . 'ECG'."\t" . 'USG'."\n\n";

		   fwrite($fp, $insert_rows);
			
		   /* Insert Data */
		   $cnt=1;
		 //print_r($patients);exit;
		   for($i=0;$i<count($patients);$i++){
		       
		      echo  $ipd = ($patients[0]->ipd_opd);
		        if($ipd == 'ipd'){ 
                                        $section_tret='ipd';
                                        $len=strlen($patients[$i]->dignosis);
                                        $dd= substr($patients[$i]->dignosis,$len - 1);
                                      if($dd=='I'){
                                           $p_dignosis = '%'.$patients[$i]->dignosis.'%';
                                           $p_dignosis_name=$patients[$i]->dignosis;
                                      }else{
                                          
                                           $p_dignosis = '%'.$patients[$i]->dignosis.'I%';
                                           $p_dignosis_name=$patients[$i]->dignosis.'I';
                                      }
                                       
                                    }
                                    else{
                                         $section_tret='opd';
                                         $len=strlen($patients[$i]->dignosis);
                                         $dd= substr($patients[$i]->dignosis,$len - 1);
                                          if($dd=='I'){
                                               // echo $dd;
                                                $dd1=substr($patients[$i]->dignosis, 0, -1);
                                           $p_dignosis = '%'.$dd1.'%';
                                             $p_dignosis_name=$dd1;
                                      }else{
                                           //echo $dd;
                                           $p_dignosis = '%'.$patients[$i]->dignosis.'%';
                                            $p_dignosis_name=$patients[$i]->dignosis;
                                      }
                                    }
                                    
                                      $doctor_name= $this->db->select("*")
                                      ->from('user')
			                          ->where('department_id', $patients[$i]->department_id) 
                                      ->get()
                                      ->row();
									  
									  
								  $tretment=$this->db->select("*")

			                       ->from('treatments')

			                       ->where('dignosis LIKE',$p_dignosis)
			                       ->where('ipd_opd ',$section_tret)
                                   ->get()

			                      ->row();
			               
			                    
			                      $HEMATOLOGICAL= $tretment->HEMATOLOGICAL;
			                      $SEROLOGYCAL= $tretment->SEROLOGYCAL;
			                      $BIOCHEMICAL= $tretment->BIOCHEMICAL;
			                      $MICROBIOLOGICAL =$tretment->MICROBIOLOGICAL;
			                      $X_RAY= $tretment->X_RAY;
								  $ECG= $tretment->ECG;
								  $USG= $tretment->USG;
			 // echo $patients[$i]->department_id;
				$id= $patients[$i]->id;
				$yearly_reg_no= $patients[$i]->yearly_reg_no;
				$old_reg_no= $patients[$i]->old_reg_no;
				$firstname= $patients[$i]->firstname;
				
				$sex= $patients[$i]->sex;
				$date_of_birth= $patients[$i]->date_of_birth;
			
				$depart= $patients[$i]->name;
				$diagnosis=$patients[$i]->dignosis;
				$doctor_name= $doctor_name->firstname;
				$date= $patients[$i]->create_date;
				$Disdate= $patients[$i]->discharge_date;
			
			

				$insertb =$cnt++. "\t". $yearly_reg_no. "\t" .$old_reg_no. "\t" .$firstname. "\t".$sex. "\t" .$date_of_birth. "\t" .$depart. "\t" .$diagnosis. "\t".$HEMATOLOGICAL."\t" .$SEROLOGYCAL."\t" .$BIOCHEMICAL."\t" .$MICROBIOLOGICAL."\t" .$X_RAY."\t" .$ECG."\t" .$USG."\n";
				 //  $insertb =$cnt++. "\t". $cust_name."\n";
				fwrite($fp, $insertb);
				 
		}
			 
		// exit;
		   if (!is_resource($fp))
		   {
					 echo "cannot open excel file";
		   }
		   //echo "success full export";
		   fclose($fp);
		   
	header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header("Content-Disposition: attachment; filename=\"" . basename($filename1) . "\";");
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename1));
    ob_clean();
    flush();
    readfile($filename1); //showing the path to the server where the file is to be download
    exit;


?>