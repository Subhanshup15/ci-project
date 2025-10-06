<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Import extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // load model
        $this->load->model('Import_model', 'import');
        $this->load->helper(array('url','html','form'));
    }    
 
    public function index() {
        //$this->load->view('import');
        $this->load->view('Import');
    }
 
    public function importFile(){
       echo error_reporting(0);
      if ($this->input->post('submit')) {
                 
                $path = 'assets/uploads/';
                require_once APPPATH . "/third_party/PHPExcel.php";
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'xlsx|xls|csv';
                $config['remove_spaces'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);            
                if (!$this->upload->do_upload('uploadFile')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                }
                if(empty($error)){
                  if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                } else {
                    $import_xls_file = 0;
                }
                $inputFileName = $path . $import_xls_file;
                 
                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    $flag = true;
                    $i=0;
                    foreach ($allDataInSheet as $value) {
                      if($flag){
                        $flag =false;
                        continue;
                      }
                      /*$inserdata[$i]['patient_id'] = $value['A'];
                      $inserdata[$i]['yearly_no'] = $value['B'];
                      $inserdata[$i]['yearly_reg_no'] = $value['C'];
                      $inserdata[$i]['daily_reg_no'] = $value['D'];
                      
                      $inserdata[$i]['monthly_reg_no'] = $value['E'];
                     $inserdata[$i]['old_reg_no'] = $value['F'];
                      $inserdata[$i]['create_date'] =date('Y-m-d',strtotime($value['G']));
                      $inserdata[$i]['firstname'] = $value['H'];
                      
                      $inserdata[$i]['sex'] = $value['I'];
                      $inserdata[$i]['date_of_birth'] = $value['J'];
                      $inserdata[$i]['address'] = $value['K'];
                      $inserdata[$i]['department_id'] = $value['L'];
                      
                      $inserdata[$i]['dignosis'] = $value['M'];
                      $inserdata[$i]['ipd_opd'] = $value['N'];
                      $inserdata[$i]['ipd_no'] = $value['O'];
                      $inserdata[$i]['discharge_date'] = date('Y-m-d',strtotime($value['P']));
                      $inserdata[$i]['bedNo'] = $value['Q'];
                      */
                      $inserdata[$i]['Sno'] = $value['A'];
                      $inserdata[$i]['yealry_number	'] = $value['B'];
                      $inserdata[$i]['CopddD_New'] = $value['C'];
                      $inserdata[$i]['Daily'] = $value['D'];
                      
                      $inserdata[$i]['Monthly'] = $value['E'];
                      $inserdata[$i]['Copdd_Old'] = $value['F'];
                      $inserdata[$i]['Date'] =$value['G'];
                      $inserdata[$i]['NAME'] = $value['H'];
                      
                      $inserdata[$i]['SEX'] = $value['I'];
                      $inserdata[$i]['AGE'] = $value['J'];
                      $inserdata[$i]['Address'] = $value['K'];
                      $inserdata[$i]['VIBHAG'] = $value['L'];
                      
                      $inserdata[$i]['NIDAN'] = $value['M'];
                      $inserdata[$i]['proxy_id'] = $value['N'];
                      $inserdata[$i]['Weight'] = $value['O'];
                      $inserdata[$i]['ipd_opd'] = $value['P'];
                    //  $inserdata[$i]['ipd_no'] = $value['O'];
                     // $inserdata[$i]['Dischargedate'] = $value['P'];
                      
                      $i++;
                    }               
                    $result = $this->import->importData($inserdata);   
                    if($result){
                      echo "Imported successfully";
                    }else{
                      echo "ERROR !";
                    }             
      
              } catch (Exception $e) {
                   die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                            . '": ' .$e->getMessage());
                }
              }else{
                  echo $error['error'];
                }
                 
                 
        }
        $this->load->view('Import');
    }
     
}
?>