 <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">


<?php
//$this->load->helper('custom');
error_reporting(0);

		$filename1 = "All_Patient_Detail_report.xls";
		//chr(255) . chr(254);
		$exists = file_exists('All_Patient_Detail_report.xls');
			if($exists)
			{
				unlink($filename1);
			}
 
		//$filename1 = "All_Customer_Detail_report.csv";
		$filename1 = "All_Patient_Detail_report".date('Y-m-d').".xls";
		
		$fp = fopen($filename1, "wb");
			
		//$insert_rows.= 'Id' . "\t".'Customer Name' . "\t" . 'Contact' . "\t" . 'Email ' . "\t" . 'Company' . "\t" . 'Address-1' . "\t" . 'Address-2' . "\t" . 'City' . "\t" . 'Pincode'. "\t" . 'Dealer Name'. "\t" .'Balance' . "\t" .'Balance Bottles' . "\t" .'Deposit Bottles' . "\t" .'Deposit Amount' . "\t" .'Payment Type' . "\t" . 'Birthday' . "\t" .'Anniverssary' . "\t" .'Register Date' . "\t" .'Status' ."\n\n";
		$insert_rows.= 'Sr No' . "\t".'New No' . "\t" . 'Old No' . "\t" . 'Name' . "\t" . 'Sex' . "\t" .'Address' . "\t" . 'Age' . "\t" . 'Department' . "\t" . 'Diagnosis' . "\t" . 'Section' ."\t" . 'Doctor'. "\t" . 'Date'. "\t" . 'Medicine'. "\t" .'Panchkarma'. "\t". 'patho'. "\t".'Investigation'."\t".'Symptoms'. "\t".'Discharge Date'."\t".'B.P.'."\t".'Pulse'."\n\n";

		   fwrite($fp, $insert_rows);
			
		   /* Insert Data */
		   $cnt=1;
		 //print_r($patients);exit;
		 
		 
		  $datefrom=$patients[0]->create_date;
		  $datefrom1=date('Y-m-d',strtotime($datefrom));
                            $year1 = date('Y',strtotime($datefrom));
                            $year2='%'.$year1.'%';
                           
                        $ddd=date('Y-m-d',strtotime("-1day".$datefrom1)); 
					
						$this->db->select('*');
                        $this->db->where('ipd_opd', 'opd');
                        $this->db->where('yearly_reg_no !=','');
                        $this->db->where('create_date <=', $ddd);
                        $this->db->where('create_date LIKE', $year2);
                        $query = $this->db->get('patient');
                         $num = $query->num_rows();
                      
					    $this->db->select('*');
                        $this->db->where('ipd_opd', 'opd');
                        $this->db->where('old_reg_no !=','');
                        $this->db->where('create_date <=', $ddd);
                        $this->db->where('create_date LIKE', $year2);
                        $query = $this->db->get('patient');
                        $num1 = $query->num_rows();
                        
                        $tot_serial1=$num + $num1;
                        if($tot_serial1==0){
                             $tot_serial1=1;
                         }
                         else{
                             $tot_serial1 =$tot_serial1;
                         }
                        
                         //$tot_serial1++; 
                         
                         
		   for($i=0;$i<count($patients);$i++){
		       $tot_serial1++; 
		      echo  $ipd = ($patients[0]->ipd_opd);
		        if($ipd == 'ipd'){      $sr_no=$cnt++;
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
                                        $sr_no=$tot_serial1;
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
                                      
                                     $ss=date('Y-m-d',strtotime($datefrom));
                                    if($ss <= '2020-01-28'){
                                        $table='treatments';
                                    }else{
                                        
                                         $table='treatments1';
                                    }
                                    
                                    
                                 if($patients[$i]->manual_status==0){
                                     $tretment=$this->db->select("*")

			                         ->from('treatments1')

			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
                                  }else{
                                      $tretment=$this->db->select("*")

			                         ->from('manual_treatments')
                                     ->where('patient_id_auto',$patients[$i]->id)
			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
                                   }
                                    
			                      
			                      $RX1= $tretment->RX1;
			                      $RX2= $tretment->RX2;
			                      $RX3= $tretment->RX3;
			                      
			                      $medicine=$RX1.",".$RX2.",".$RX3;
			                      
			                      $KARMA= $tretment->KARMA;
			                      $PK1= $tretment->PK1;
			                      $PK2= $tretment->PK2;
			                      $SWA1= $tretment->SWA1;
			                      $SWA2= $tretment->SWA2;
			                       
			                      $s_s= $tretment->skarma;
			                      $s_v= $tretment->vkarma;
			                      
			                      
			                      $SNEHAN= $tretment->SNEHAN;
			                      $SWEDAN= $tretment->SWEDAN;
			                      $VAMAN= $tretment->VAMAN;
			                      
			                      $VIRECHAN= $tretment->VIRECHAN;
			                      $BASTI= $tretment->BASTI;
			                      $NASYA= $tretment->NASYA;
			                      
			                      $RAKTAMOKSHAN= $tretment->RAKTAMOKSHAN;
			                      $SHIRODHARA_SHIROBASTI= $tretment->SHIRODHARA_SHIROBASTI;
			                      $OTHER= $tretment->OTHER;
			                      
			                      $panch= $SNEHAN.",".$SWEDAN.",".$VAMAN.",".$VIRECHAN.",".$BASTI.",".$NASYA.",".$RAKTAMOKSHAN.",".$SHIRODHARA_SHIROBASTI.",".$OTHER;
			                     
			                      
			                      $HEMATOLOGICAL= $tretment->HEMATOLOGICAL;
			                      $SEROLOGYCAL= $tretment->SEROLOGYCAL;
			                      $BIOCHEMICAL= $tretment->BIOCHEMICAL;
			                      $MICROBIOLOGICAL= $tretment->MICROBIOLOGICAL;
			                      
			                      $path=$HEMATOLOGICAL.",".$SEROLOGYCAL.",".$BIOCHEMICAL.",".$MICROBIOLOGICAL;
			                      
			                      $X_RAY= $tretment->X_RAY;
			                      $ECG= $tretment->ECG; 
                                      
                                 $inves= $X_RAY.",".$ECG;
                                 
                                  $symptoms= $tretment->symptoms;
                                 
			                      $sym1= $tretment->sym1;
			                      $sym2= $tretment->sym2;
			                      $sym3= $tretment->sym3;
                                   
                                  $symptomss=$symptoms.",".$sym1.",".$sym2.",".$sym3;
                                   //$symptomss=icon($symptomss1, 'UTF-8', 'UTF-8');
                                      
			  // echo $patients[$i]->department_id;
			 
			  $y=date('Y',strtotime($patients[$i]->fol_up_date));
              if($y=='1970'){ $yy="18";} else{ $yy=substr($y,2,2);
                               }
                            
                               if($patients[$i]->yearly_reg_no){
                                  	$yearly_reg_no= $patients[$i]->yearly_reg_no.".".$yy;
                                } else {
                                  	$yearly_reg_no= '';
                                } 
                                
                                if($patients[$i]->old_reg_no){
                                  	$old_reg_no= $patients[$i]->old_reg_no.".".$yy;
                                } else {
                                  	$old_reg_no= '';
                                } 
			 
				$id= $patients[$i]->id;
			
			
				$firstname= $patients[$i]->firstname;
				
				$sex= $patients[$i]->sex;
				$date_of_birth= $patients[$i]->date_of_birth;
			    $address= $patients[$i]->address;
				$depart= $patients[$i]->name;
				$diagnosis=$patients[$i]->dignosis;
				$doctor_name= $doctor_name->firstname;
				$date= $patients[$i]->create_date;
				$Disdate= $patients[$i]->discharge_date;
			
			   $new_no=$patients[$i]->yearly_reg_no;
			   if($new_no){
			       $bp=$patients[$i]->bp;
			       $pulse=$patients[$i]->pulse;
			   } else {
			       	$year = '%'.$this->session->userdata['acyear'].'%';
			       if($ipd=='opd'){
			           $table='patient';
			       }else{
			           $table='patient';
			       }
			       
			       $bp_old=$this->db->select("*")

			                         ->from($table)
                                     ->where('yearly_reg_no',$patients[$i]->old_reg_no)
			                       	->where('create_date LIKE', $year)
			                         //->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
			       $bp=$bp_old->bp;
			       $pulse=$bp_old->pulse;
			   }
			    

				$insertb =$sr_no. "\t". $yearly_reg_no. "\t" .$old_reg_no. "\t" .$firstname. "\t".$sex. "\t".$address."\t" .$date_of_birth. "\t" .$depart. "\t" .$diagnosis. "\t".$ipd ."\t".$doctor_name. "\t" .$date."\t" .$medicine."\t" .$panch."\t" .$path."\t" .$inves."\t" .$symptomss. "\t" .$Disdate."\t" .$bp."\t" .$pulse."\n";
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
	  header('Content-type: text/csv; charset=UTF-8');
    //header('Content-Type: application/octet-stream');
    header("Content-Disposition: attachment; filename=\"" . basename($filename1) . "\";");
     header('Content-Encoding: UTF-8');
    //header('Content-Transfer-Encoding: binary');
    
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename1));
    echo "\xEF\xBB\xBF"; // UTF-8 BOM
     echo chr(255).chr(254).iconv("UTF-8", "UTF-16LE//IGNORE", $filename1); 
    ob_clean();
    flush();
    readfile($filename1); //showing the path to the server where the file is to be download
    exit;


?>