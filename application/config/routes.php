<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//$route['default_controller']      = 'home';
$route['default_controller']      = 'dashboard'; 
$route['login']                   = 'dashboard';
$route['logout']                  = 'dashboard/logout';

$route['slider/(:num)']           = 'home/slider/$1';
$route['slider/(:num)/(:any)']    = 'home/slider/$1';

$route['details/(:num)']          = 'home/details/$1';
$route['details/(:num)/(:any)']   = 'home/details/$1'; 

$route['patient/profile/(:any)']     = 'patients/profile/$1';
$route['patient/ipdprofile/(:any)']     = 'patients/ipdprofile/$1';
$route['appointment_info/(:any)'] = 'website/appointment/preview/$1';

$route['patient/delete/(:any)'] = 'patients/delete/$1';
//$route['patient/ipd/delete/(:any)'] = 'patient/delete/$1';


$route['patient/edit/(:any)'] = 'patients/edit/$1';
$route['patient/create'] = 'patients/create';
$route['patient/create1'] = 'patients/create1';
//$route['patient/ipd/edit/(:any)'] = 'patient/edit/$1';
$route['dashboard_laboratorist/lab/laboratory/create'] = 'dashboard_laboratorist/lab/laboratory/create';



$route['patient/dischargedate/(:any)/(:any)'] = 'patients/dischargedate/$1/$2';


$route['patientList/patient_by_date/(:any)/(:any)/(:any)'] = 'patients/patient_by_date/$1/$2/$3';

$route['dashboard_doctor/patient/patientList/(:any)'] = 'dashboard_doctor/patient/patient/getrecordnysection/$1';


$route['setting/acyear/(:any)'] = 'language/acyear/$1';


$route['patient/getpatientbydepartment/(:any)/(:any)'] = "patients/getpatientbydepartment/$1/$2";

$route['patientList/(:any)'] = "patients/getrecordnysection/$1";
$route['bedList/(:any)'] = "patients/getbedlist/$1";

//$route['department/deprt_kaya_ipd/(:any)'] = "department/deprt_kaya_ipd/$1";
//$route['department/deprt_panch_ipd/(:any)'] = "department/deprt_panch_ipd/$1";
/*$route['department/(:any)/(:any)'] = "department/deprt_bal_ipd/$1";
$route['department/(:any)/(:any)'] = "department/deprt_shalya_ipd_ipd/$1";
$route['department/(:any)/(:any)'] = "department/deprt_shalakya_ipd/$1";
$route['department/(:any)/(:any)'] = "department/deprt_stri_ipd/$1";
$route['department/(:any)/(:any)'] = "department/deprt_swasth_ipd/$1";
$route['department/(:any)/(:any)'] = "department/deprt_aatya_ipd/$1";
*/
$route['patient/check_patient/(:any)'] = "patients/check_patient/$1";

$route['dashboard_receptionist/patient/patientList/(:any)'] = "dashboard_receptionist/patient/patient/getrecordnysection/$1";

$route['dashboard_receptionist/patient/patient/patient_by_date/(:any)/(:any)/(:any)'] = 'dashboard_receptionist/patient/patient/patient_by_date/$1/$2/$3';


// $route['patient/check_patient'] = "patient/check_patient";
// $route['patient/(:any)/(:any)'] = "department"; 

//$route['acyear'] = "acyear";
//Reports
$route['report/deptopd'] = "report/deptopdcount";
$route['report/deptipd'] = "report/deptipdcount";

$route['report/deptopddate'] = "report/deptopdcountbydate";
$route['report/deptipddate'] = "report/deptipdcountbydate";

$route['report/deptopdcountdate'] ="report/deptopdcountdate";
$route['report/deptipdcountdate'] ="report/deptipdcountdate";

$route['report/genderwisereport'] = "report/genderwisereport";


$route['404_override']            = '';
$route['translate_uri_dashes']    = FALSE;


//Lab reports
// $route['laboratory/haemogram'] = "laboratory/haemogram";
$route['laboratory/urineexamination'] = "laboratory/urineexamination";