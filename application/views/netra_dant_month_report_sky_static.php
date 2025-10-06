<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  echo error_reporting(0);?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail">
            <div class="panel-heading no-print row">
                <div class="btn-group"> 
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>
                <div class="btn-group col-md-2"> 
                    <a class="btn btn-success" href="<?php echo base_url("patients/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_patient') ?> </a>  
                </div>              
                <?php   
                    $ipd = ($patients[0]->ipd_opd);
                    if($ipd == 'ipd'){
                ?>
                    <div class="btn-group col-md-2"> 
                        <a id="otpconfirm" name="Otp_Confirm" data-toggle="modal" data-target="#myModal" href="#" class="btn btn-primary pull-right"> Add Discharge Date </a>
                    </div> 
                <?php 
                    }
                ?>
                <div class="btn-group">
                    <input id="myInput" class="form-control" type="text" placeholder="Search..">
                </div>                    
            </div>
            <div class="panel-body" style="font-size: 11px;">
                <div class="col-sm-2" align="left">
                 <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:100%; width:100%;border: 0.5px solid #0003;" />
	          	 </div> 
            <div class="col-sm-8" align="center">  
                   <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
                    <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
                    
                    <h3 style="margin-top: 0px; margin-bottom: 15px;">Monthly Wise (Netra, Mukha Dant) <?php if($section == 'opd'){ echo "OPD"; }else{ echo "IPD";} ?> Shalakyatantra Report</h3>
                    <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>
                </div>
                 <div class="col-sm-2"></div>
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover" <?php  if($gob=='gob') { echo "style='font-size:10px;'";}?>>
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Month</th>
                            <th>Netra</th>
                            <th>Mukh Dant</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                 <!--   <tbody>
                        <?php
                            $month_array = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
                            $mukh_dant_count = array();
                            $m_count=0;
                            $netra_count = array();
                            $n_count=0;
                            $index =0;
                            for($i=1; $i<=12; $i++):
                                
                                if($i<10){$checkMonth = $this->session->userdata['acyear'].'-0'.$i;}else{$checkMonth = $this->session->userdata['acyear'].'-'.$i;}
                                for($j=0; $j<count($patients); $j++):
                                    $createDateYearMonth = date('Y-m', strtotime($patients[$j]->create_date));

                                    if($ipd == 'ipd'){ 
                                        $che=trim($patients[$j]->dignosis);
                                        $section_tret='ipd';
                                        $len=strlen($che);
                                        $dd= substr($che,$len - 1);
                                        
                                        $str = $patients[$j]->dignosis;
                                        $arry=explode("-",$str);
                                        $t_c=count($arry);
                                        
                                        if($t_c=='2'){
                                            $dd1=substr($che, 0, -1);
                                            $p_dignosis = '%'.$arry[0].'%';
                                            trim($p_dignosis);
                                            $p_dignosis_name=$patients[$j]->dignosis;
                                        }else{
                                            $p_dignosis = '%'.$che.'%';
                                            $p_dignosis_name=$patients[$j]->dignosis;
                                        }
                                    }
                                    else{
                                        $section_tret='opd';
                                        $che=trim($patients[$j]->dignosis);
                                        $section_tret='opd';
                                        $len=strlen($che);
                                        $dd= substr($che,$len - 1);
                                        
                                        $str = $patients[$j]->dignosis;
                                        $arry=explode("-",$str);
                                        $t_c=count($arry);
                                        if($t_c=='2'){
                                            $dd1=substr($che, 0, -1);
                                            $p_dignosis = '%'.$arry[0].'%';
                                            trim($p_dignosis);
                                            $p_dignosis_name=$patients[$j]->dignosis;
                                        }else{
                                            //echo $dd;
                                            $p_dignosis = '%'.$che.'%';
                                            $p_dignosis_name=$patients[$j]->dignosis;
                                        }
                                    }
                                    
                                    if($patients[$j]->manual_status==0){
                                        if($patients[$j]->proxy_id){
                                            $tretment=$this->db->select("*")
                                                ->from('treatments1')
                                                ->where('dignosis LIKE',$p_dignosis)
                                                ->where('proxy_id',$patients[$j]->proxy_id)
                                                ->where('department_id',$patients[$j]->department_id)
                                                ->where('ipd_opd ',$section_tret)
                                                ->get()
                                                ->row();
                                        }
                                        else{
                                            $tretment=$this->db->select("*")
                                                ->from('treatments1')
                                                ->where('dignosis LIKE',$p_dignosis)
                                                ->where('department_id',$patients[$j]->department_id)
                                                ->where('ipd_opd ',$section_tret)
                                                ->get()
                                                ->row();  
                                            
                                            if(empty($tretment)){
                                                $tretment=$this->db->select("*")
                                                    ->from('treatments1')
                                                    ->where('department_id',$patients[$j]->department_id)
                                                    ->where('ipd_opd',$patients[$j]->department_id)
                                                    ->get()
                                                    ->row();   
                                            }
                                        }
                                    }else{
                                        $tretment=$this->db->select("*")
                                            ->from('manual_treatments')
                                            ->where('patient_id_auto',$patients[$j]->id)
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('ipd_opd ',$section_tret)
                                            ->get()
                                            ->row();
                                    }
                                    $skya= $tretment->skya;
                                    if($checkMonth == $createDateYearMonth && $skya == 'M'){
                                        $m_count = $m_count +1;
                                    }
                                    if($checkMonth == $createDateYearMonth && $skya == 'N'){
                                        $n_count = $n_count +1;
                                    }
                                endfor;
                                $mukh_dant_count[$index] = $m_count;
                                $m_count=0;
                                $netra_count[$index] = $n_count;
                                $n_count=0;
                                $index = $index +1;
                            endfor;
                        ?>
                        <?php 
                            $grandTotal = 0;
                            for($month=0; $month<12; $month++):
                        ?>
                            <tr>
                                <td><?php echo $month+1;?></td>
                                <td><?php echo $month_array[$month];?></td>
                                <td><?php echo $netra_count[$month];?></td>
                                <td><?php echo $mukh_dant_count[$month];?></td>
                                <td><?php echo $tt = $mukh_dant_count[$month]+$netra_count[$month];?></td>
                                <?php $grandTotal = $grandTotal + $tt;?>
                            </tr>
                        <?php
                            endfor;
                        ?>
                            <tr>
                                <td colspan="4">Grand Total</td>
                                <td><?php echo $grandTotal; ?></td>
                            </tr>
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>
    
</div>