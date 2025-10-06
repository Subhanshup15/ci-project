<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  
    error_reporting(0);
    //echo error_reporting(0);
?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/get_panchkarma_patient'); ?>">
                                      
 
        <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; ?>">       -->


<div class="form-group">

    <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>

    <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
     

</div>  

<!--<div class="form-group">-->

<!--    <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>-->

<!--    <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">-->
  
<!--</div>  -->


<div class="form-group">
    <select class="form-control" name="section" id="section">
        <option value="opd">opd</option>
        <option value="ipd">ipd</option>
    </select>
   <!-- <input type="text" name="section" class="form-control" id="section" value="<?php echo $section; ?>" readonly>-->
</div>



<button type="submit" name="filter" class="btn btn-primary" id="filter" >Submit</button>



</form>
</div>
<div class="col-sm-12" id="PrintMe">

        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print row">

                <div class="btn-group"> 
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>

                <div class="btn-group col-md-2"> 
                    <a class="btn btn-success" href="<?php echo base_url("patients/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_patient') ?> </a>  
                </div>              

                
                <div class="btn-group">
                    <input id="myInput" class="form-control" type="text" placeholder="Search..">
                </div>                    

            </div>


            <div class="panel-body" style="font-size: 11px;">
            
	          	 <div class="col-sm-12">
	          	     <div class="row">
	          	     <div class="col-xs-2" align="left">
                 <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:120px; width:120px;border: 0.5px solid #0003;" />
	          	 </div> 
	          	 <div class="col-xs-8" align="center">
               <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
             <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
 
 
 
                    <?php if($section == 'opd') {?>
                    <h3 style="margin-top: 0px; margin-bottom: 15px;">OPD Panchkarma Patient List</h3>
                    <h4 style="margin-top: 0px; margin-bottom: 15px;"> Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?></h4>     
                    <?php } else {?>
                    <h3 style="margin-top: 0px; margin-bottom: 15px;">IPD Panchkarma Patient List</h3>
                    <h4 style="margin-top: 0px; margin-bottom: 15px;"> Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?></h4>
                    <?php } ?>
                        
                         
                         
                          
                </div><br><br>
                <div class="table-responsive" style="width: 100%;"> 
                <table width="100%" id="patientdata"  class="table table-striped table-bordered table-hover table-responsive" >
                    <thead >
                        <tr>
                            <th rowspan="2">Sr. No</th>
                            <th colspan="2">COPD No.</th>
                            <th rowspan="2">Name</th>
                            <!--<th rowspan="2">Age</th>
                            <th rowspan="2">Sex</th>-->
                            <th rowspan="2">Dignosis</th>
                            <!--<th rowspan="2">Date</th>-->
                            <th rowspan="2">SNEHAN</th>
                            <th rowspan="2">SWADAN</th>
                            <th rowspan="2">WAMAN</th>
                            <th rowspan="2">VIRECHAN</th>
                            <th rowspan="2">BASTI</th>
                            <th rowspan="2">NASYA</th>
                            <th rowspan="2">RAKTMOKSHAN</th>
                            <th rowspan="2">SHIRODHARA</th>
                            <th rowspan="2">SHIROBASTI</th>
                            <!--<th rowspan="2">SHIROBASTI</th>-->
                            <th rowspan="2">OTHER</th>
                            <th rowspan="2">YONIDHAVAN</th>
                            <th rowspan="2">YONIPICHU</th>
                            <th rowspan="2">UTTARBASTI</th>
                          </tr>
                          <tr>
                              <th>new</th>
                              <th>old</th>
                          </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach($patients as $patient){
                            //echo 'hiiii';
                            //echo $section;
                            if($section == 'ipd')
                                            {
                                                $che=trim($patient->dignosis);////kusta-KCI
                                                $section_tret='ipd';
                                                $len=strlen($che);//9
                                                $dd= substr($che,$len - 1);
                                                print_r($che);
                                                $str = $patient->dignosis;
                                                $arry=explode("-",$str);
                                                $t_c=count($arry);
                                                if($t_c=='2'){
                                                    $dd1=substr($che, 0, -1);
                                                    $new_str = trim($arry[0]);
                                                    $p_dignosis = '%'.$new_str.'%';
                                                    $p_dignosis_name=$patient->dignosis;
                                                }else{
                                                    $p_dignosis = '%'.$che.'%';
                                                    $p_dignosis_name=$patient->dignosis;
                                                }
                                            }
                                        else
                                            {
                                                $section_tret='opd';
                                                $che=trim($patient->dignosis);
                                                $section_tret='opd';
                                                $len=strlen($che);
                                                $dd= substr($che,$len - 1);
                                                $str = $patient->dignosis;
                                                $arry=explode("-",$str);
                                                $t_c=count($arry);
                                                if($t_c=='2'){
                                                    $dd1=substr($che, 0, -1);
                                                    $new_str = trim($arry[0]);
                                                    $p_dignosis = '%'.$new_str.'%';
                                                    $p_dignosis_name=$patient->dignosis;
                                                }else{
                                                    $p_dignosis = '%'.$che.'%';
                                                    $p_dignosis_name=$patient->dignosis;
                                                }
                                            }
                                    
                                    
                                    
                                 if($patient->manual_status==0){
                                      if($patient->proxy_id){
			                          
			                         
                                     $tretment=$this->db->select("*")

			                         ->from('treatments1')
                                     ->where('dignosis LIKE',$p_dignosis)
                                     ->where('proxy_id',$patient->proxy_id)
                                     ->where('department_id',$patient->department_id)
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
                                      }
                                      else{
                                          
                                       $tretment=$this->db->select("*")

			                         ->from('treatments1')
                                     ->where('dignosis LIKE',$p_dignosis)
                                      ->where('department_id',$patient->department_id)
                                     ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();  
                                      }
                                  }else{
                                      $tretment=$this->db->select("*")
                                      ->from('manual_treatments')
                                     ->where('patient_id_auto',$patient->id)
			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
                                   }
                        
                        



                            $SNEHAN= $tretment->SNEHAN;
                            $SWEDAN= $tretment->SWEDAN;
                            $VAMAN= $tretment->VAMAN;
                            $VIRECHAN= $tretment->VIRECHAN;
                            $BASTI= $tretment->BASTI;
                            $NASYA= $tretment->NASYA;
                            $RAKTAMOKSHAN= $tretment->RAKTAMOKSHAN;
                            $SHIRODHARA_SHIROBASTI= $tretment->SHIRODHARA_SHIROBASTI;
                            $SHIROBASTI= $tretment->SHIROBASTI;
                           // print_r($SHIRODHARA_SHIROBASTI);
                            $OTHER= $tretment->OTHER;
                            $YONIDHAVAN= $tretment->YONIDHAVAN;
                            $YONIPICHU= $tretment->YONIPICHU;
                            $UTTARBASTI= $tretment->UTTARBASTI;

                        
                        ?>
                        <?php if($SNEHAN || $SWEDAN || $VAMAN || $VIRECHAN || $BASTI || $NASYA || $RAKTAMOKSHAN || $SHIRODHARA_SHIROBASTI || $OTHER || $SHIROBASTI || $YONIDHAVAN || $YONIPICHU || $UTTARBASTI) { ?>
                        <tr>
                            <?php echo form_open_multipart('Patients/insert_panch_patient','class="form-inner"') ?>
                            <!--<form action="<?//php echo base_url('patients/insert_panch_patient'); ?>" method="post" enctype="multipart/form-data">-->
                            <td><?php echo $i++; ?></td>
                            <td>
                                <input type="text" name="section[]" value="<?php echo $section; ?>" hidden>
                                <input type="text" name="patient_auto_id[]" value="<?php echo $patient->id; ?>" hidden>
                                <input type="text" name="new_patient[]" value="<?php echo $patient->yearly_reg_no; ?>" hidden>
                                <?php echo $patient->yearly_reg_no; ?></td>
                            <td>
                                <input type="text" name="old_patient[]" value="<?php echo $patient->old_reg_no; ?>" hidden>
                                <?php echo $patient->old_reg_no; ?></td>
                            <td>
                                <input type="text" name="name[]" value="<?php echo $patient->firstname; ?>" hidden>
                                <?php echo $patient->firstname; ?></td>
                            <!--<td>
                                <input type="text" name="age[]" value="<?php echo $patient->date_of_birth; ?>" hidden>
                                <?php echo $patient->date_of_birth; ?></td>
                            <td>
                                <input type="text" name="sex[]" value="<?php echo $patient->sex; ?>" hidden>
                                <?php echo $patient->sex; ?></td>-->
                            <td>
                                <input type="text" name="dignosis[]" value="<?php echo $patient->dignosis; ?>" hidden>
                                <?php echo $patient->dignosis; ?></td>
                            
                                <input type="text" name="create_date[]" value="<?php echo date("d-m-Y",strtotime($patient->create_date)); ?>" hidden>
                                <?//php echo date("d-m-Y",strtotime($patient->create_date)); ?>
                                
                                <td>
                                <?php if($SNEHAN !=''){ ?>
                                <input type="checkbox" name="snehan[]" value="<?php echo $SNEHAN; ?>"><br>
                                <?php } ?>
                                <?php echo $SNEHAN; ?></td>
                            <td>
                                <?php if($SWEDAN !=''){ ?>
                                <input type="checkbox" name="swedan[]" value="<?php echo $SWEDAN; ?>"><br>
                                <?php } ?>
                                <?php echo $SWEDAN; ?></td>
                            <td>
                                <?php if($VAMAN !=''){ ?>
                                <input type="checkbox" name="vaman[]" value="<?php echo $VAMAN; ?>"><br>
                                <?php } ?>
                                <?php echo $VAMAN; ?></td>
                            <td>
                                <?php if($VIRECHAN !=''){ ?>
                                <input type="checkbox" name="virechan[]" value="<?php echo $VIRECHAN; ?>"><br>
                                <?php } ?>
                                <?php echo $VIRECHAN; ?></td>
                            <td>
                                <?php if($BASTI !=''){ ?>
                                <input type="checkbox" name="basti[]" value="<?php echo $BASTI; ?>"><br>
                                <?php } ?>
                                <?php echo $BASTI; ?></td>
                            <td>
                                <?php if($NASYA !=''){ ?>
                                <input type="checkbox" name="nasya[]" value="<?php echo $NASYA; ?>"><br>
                                <?php } ?>
                                <?php echo $NASYA; ?></td>
                            <td>
                                <?php if($RAKTAMOKSHAN !=''){ ?>
                                <input type="checkbox" name="raktmokshan[]" value="<?php echo $RAKTAMOKSHAN; ?>"><br>
                                 <?php } ?>
                                <?php echo $RAKTAMOKSHAN; ?></td>
                            <td>
                                <?php if($SHIRODHARA_SHIROBASTI !=''){ ?>
                                <input type="checkbox" name="shirodhara[]" value="<?php echo $SHIRODHARA_SHIROBASTI; ?>"><br>
                                 <?php } ?>
                                <?php echo $SHIRODHARA_SHIROBASTI; ?>
                            </td>
                            <td>
                                <?php if($SHIROBASTI !=''){ ?>
                                <input type="checkbox" name="shrirobasti[]" value="<?php echo $SHIROBASTI; ?>"><br>
                                 <?php } ?>
                                <?php echo $SHIROBASTI; ?>
                            </td>
                            <td>
                                <?php if($OTHER !=''){ ?>
                                <input type="checkbox" name="other[]" value="<?php echo $OTHER; ?>"><br>
                                <?php } ?>
                                <?php echo $OTHER; ?>
                            </td>
                            <td>
                                <?php if($YONIDHAVAN !=''){ ?>
                                <input type="checkbox" name="yonidhavan[]" value="<?php echo $YONIDHAVAN; ?>"><br>
                                <?php } ?>
                                <?php echo $YONIDHAVAN; ?>
                            </td>
                            <td>
                                <?php if($YONIPICHU !=''){ ?>
                                <input type="checkbox" name="yonipichu[]" value="<?php echo $YONIPICHU; ?>"><br>
                                <?php } ?>
                                <?php echo $YONIPICHU; ?>
                            </td>
                            <td>
                                <?php if($UTTARBASTI !=''){ ?>
                                <input type="checkbox" name="uttarbasti[]" value="<?php echo $UTTARBASTI; ?>"><br>
                                <?php } ?>
                                <?php echo $UTTARBASTI; ?>
                            </td>
                           
                        </tr>
                        <?php } ?>
                        <?php } $i++; ?>
                    </tbody>
                </table>
                </div>
                
                          <div class="form-group row">
                    <div class="col-sm-offset-5 col-sm-6">
                        <div class="ui buttons">
                            <button type="reset" class="ui button"><?php echo display('reset') ?></button>
                            <div class="or"></div>
                            <button class="ui positive button"><?php echo display('save') ?></button>
                        </div>
                    </div>
                </div>
                <!--</form>-->
                <?php echo form_close() ?> 
       
            </div>
        </div>
    </div>
</div>



