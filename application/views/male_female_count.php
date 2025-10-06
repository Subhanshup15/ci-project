<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

    <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('report/male_female_count_panch')?>">
                                      
                                      <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; ?>">       -->
                              
                              
                              <div class="form-group">
                              
                                  <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>
                              
                                  <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
                              
                              </div>  
                              
                              <div class="form-group">
                              
                                  <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>
                              
                                  <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
                              
                              </div>  
                              
                            <div class="form-group">
                                <select class="form-control" name="section" id="section">
                                <option value="opd">opd</option>
                                <option value="ipd">ipd</option>
                                </select>
                            
                            </div>
                              
                              <button type="submit" name="filter" class="btn btn-primary" id="filter" >Submit</button>
                              
                              
                              
                              </form>   

        <div  class="panel panel-default thumbnail">
                <div class="btn-group"> 
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>
                <div class="btn-group">
                    <input id="myInput" class="form-control" type="text" placeholder="Search..">
                </div>    
            <div class="panel-heading  row" id="PrintMe">
                 <div class="col-sm-12" align="center">  
                <strong><?php echo $this->session->userdata('title') ?></strong>
                <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
                </div>
                
                
                <div class="col-lg-12" style="text-align:center;margin-top: 10px;margin-bottom: 10px;">
                    
                    <h2><?php  if($section=='opd'){ echo 'OPD'; }else{ echo 'IPD'; }?> Male/Female Panchkarma Total Count</h2>
                    
                </div>
                <div class="col-lg-12" style="text-align:center;margin-top: 10px;margin-bottom: 10px;">
                    <h4 style="margin-top: 0px; margin-bottom: 15px;"> Date:-  
                    <?php  
                    
                    if(date("d/m/Y", strtotime($datefrom))=='01/01/1970')
                    { 
                        echo date("d/m/Y");
                    }
                    else
                    { 
                        echo date("d/m/Y", strtotime($datefrom));
                    } 
                    ?> 
                    To 
                    <?php 
                     if(date("d/m/Y", strtotime($dateto)) == '01/01/1970')
                     {
                        echo date("d/m/Y");
                     }
                     else
                     {
                        echo date("d/m/Y", strtotime($dateto));
                     }  ?></h4>
                <?//php echo date("Y/m/d"); ?>
                </div>
            <div class="panel-body">
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <?php 
                                $panchkarma_item = array(
                                    'snehanCount' => 'SNEHAN',
                                    'swedanCount' => 'SWEDAN',
                                    'vamanCount' => 'VAMAN',
                                    'virechanCount' => 'VIRECHAN',
                                    'nasyaCount' => 'NASYA',
                                    'raktmokshanCount' => 'RAKTMOKSHAN',
                                    'shirodharaCount' => 'SHIRODHARA',
                                    'shirobastiCount' => 'SHIROBASTI',
                                    'bastiCount' => 'BASTI',
                                    'othersCount' => 'OTHER'); 
                                $i = 0;
                            ?>
                             <?php foreach($panchkarma_item as $item => $key){ ?>
                            <th colspan='2'><?php echo $key; ?></th>
                            <?php } ?>
                            <th>Total</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Male</td>
                            <td>Female</td>
                            <td>Male</td>
                            <td>Female</td>
                            <td>Male</td>
                            <td>Female</td>
                            <td>Male</td>
                            <td>Female</td>
                            <td>Male</td>
                            <td>Female</td>
                            <td>Male</td>
                            <td>Female</td>
                            <td>Male</td>
                            <td>Female</td>
                            <td>Male</td>
                            <td>Female</td>
                            <td>Male</td>
                            <td>Female</td>
                            <td>Male</td>
                            <td>Female</td>
                        </tr>
                    </thead>
                    <tbody>
                        
                       
                       
                            <tr>
                                <th><?//php echo $key; ?></th>
                                <td><?echo $snehanmale = $SnehanCount[0]->SnehanCount; ?></td>
                                <td><?echo $snehanfemale = $FSnehanCount[0]->FSnehanCount; ?></td>
                                <td><?echo $swedanmale = $SwedanCount[0]->SwedanCount; ?></td>
                                <td><?echo $swedanfemale = $FSwedanCount[0]->FSwedanCount; ?></td>
                                <td><?echo $vamanmale = $VamanCount[0]->VamanCount; ?></td>
                                <td><?echo $vamanfemale = $FVamanCount[0]->FVamanCount; ?></td>
                                <td><?echo $virechanmale = $VirechanCount[0]->VirechanCount; ?></td>
                                <td><?echo $virechanfemale = $FVirechanCount[0]->FVirechanCount; ?></td>
                                <td><?echo $nasyamale = $NasyaCount[0]->NasyaCount; ?></td>
                                <td><?echo $nasyafemale = $FNasyaCount[0]->FNasyaCount; ?></td>
                                <td><?echo $raktmokshanmale = $RaktmokshanCount[0]->RaktmokshanCount; ?></td>
                                <td><?echo $raktmokshanfemale = $FRaktmokshanCount[0]->FRaktmokshanCount; ?></td>
                                <td><?echo $shirodharamale = $ShirodharaCount[0]->ShirodharaCount; ?></td>
                                <td><?echo $shirodharafemale = $FShirodharaCount[0]->FShirodharaCount; ?></td>
                                <td><?echo $shirobastimale = $ShirobastiCount[0]->ShirobastiCount; ?></td>
                                <td><?echo $shirobastifemale = $FShirobastiCount[0]->FShirobastiCount; ?></td>
                                <td><?echo $bastimale = $BastiCount[0]->BastiCount; ?></td>
                                <td><?echo $bastifemale = $FBastiCount[0]->FBastiCount; ?></td>
                                <td><?echo $othermale = $OthersCount[0]->OthersCount; ?></td>
                                <td><?echo $otherfemale = $FOthersCount[0]->FOthersCount; ?></td>

                                
                            </tr>
                       
                            <tr>
                                <th>Grand Total</th>
                                <th colspan='2'><?php echo $totalsnehan = $snehanmale+$snehanfemale; ?></th>
                                <th colspan='2'><?php echo $totalswedan = $swedanfemale+$swedanmale; ?></th>
                                <th colspan='2'><?php echo $totalvaman = $vamanfemale+$vamanmale; ?></th>
                                <th colspan='2'><?php echo $totalvirechan = $virechanfemale+$virechanmale; ?></th>
                                <th colspan='2'><?php echo $totalnasya = $nasyafemale+$nasyamale; ?></th>
                                <th colspan='2'><?php echo $totalraktmokshan = $raktmokshanfemale+$raktmokshanmale; ?></th>
                                <th colspan='2'><?php echo $totalshirodhara = $shirodharafemale+$shirodharamale; ?></th>
                                <th colspan='2'><?php echo $totalshirobasti = $shirobastifemale+$shirobastimale; ?></th>
                                <th colspan='2'><?php echo $totalbasti = $bastifemale+$bastimale; ?></th>
                                <th colspan='2'><?php echo $totalother = $othermale+$otherfemale; ?></th> 
                                <th><?php echo $total = $totalbasti+$totalother+$totalshirobasti+$totalshirodhara+$totalraktmokshan+$totalnasya+$totalvirechan+$totalvaman+$totalswedan+$totalsnehan; ?></th>
                            </tr>
                    </tbody>
                </table>
            </div>
            </div> 
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#patientdata tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

function excel_all_customer(date1,date2,section){ 
	   //alert(date1+" "+date2);
		window.location='excel_all_customer?date1='+date1+'&date2='+date2+'&section='+section;
	//	 redirect('patients/excel_all_customer/'+date1+'/'+date2);
		// location.href='www.google.com';
	}
</script>