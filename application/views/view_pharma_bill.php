<!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
<!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->


<div class="row">
    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail">
            <div class="panel-heading no-print row">

                <div class="btn-group"> 
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>
                <div class="btn-group">
                    <input id="myInput" class="form-control" type="text" placeholder="Search..">
                </div>                    

            </div>
            <?php $count = 2;
            for($i=0;$i<$count;$i++)
            {
            ?>
            <div class="panel-body" >
                <!--<div class="row" style="page-break-after: always;border: groove;">-->
                <div class="row">
                <div class="row">
                        <center>
                        <table style='width:100%;'>
                            <tr>
                                <td class='text-right' style="width:20%;"><img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:120px; width:120px;border: 0.5px solid #0003;" /></td>
                                <td class='text-center' style="width:90%;">
                                    <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
                                    <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
                                    <h2>Medical Bill Paper</h2>
                                </td>
                            </tr>
                        </table>
                        </center>
                        <br>
                    <div class="col-md-12 col-lg-12"> 

                        <table class="table" style="border: 1px solid #333;">
                        
                            <tr>
                                <td style="border-bottom: 1px solid;border-top: 1px solid;">O.P.D.:</td>
                                <td style="border-bottom: 1px solid;border-top: 1px solid;">
                                <?php echo $patients->yearly_reg_no; ?>
                                </td>
                                <td style="border-bottom: 1px solid;border-top: 1px solid;">Invoice No. :</td>
                                <td style="border-bottom: 1px solid;border-top: 1px solid;"><?php echo $patients->id; ?></td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid;">Name :</td>
                                <td style="border-bottom: 1px solid;"><?php echo $patients->name; ?></td>
                                <td style="border-bottom: 1px solid;border-top: 1px solid;"> Date:</td>
                                <td style="border-bottom: 1px solid;border-top: 1px solid;"><?php echo $patients->created_at; ?></td>
                                
                            </tr>
                            <tr>
                            <td style="border-bottom: 1px solid;">Age :</td>
                                <td style="border-bottom: 1px solid;"><?php echo $patients->age; ?> Yr.</td>
                                <td style="border-bottom: 1px solid;">Gender :</td>
                                <td style="border-bottom: 1px solid;"><?php echo $patients->sex; ?></td>
                                
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid;">Weight  :</td>
                                <td style="border-bottom: 1px solid;"> <?php echo $patients->weight; ?>  kg.</td>
                                <td style="border-bottom: 1px solid;">Dignosis :</td>
                                <td style="border-bottom: 1px solid;"><?php echo $patients->dignosis; ?></td>
                            </tr>
                        </table>

                    </div>

                </div>
                  
               <div class="row">
                           
                <div class="col-md-12">
                        <table class="table table-bordered table-striped table-hover">
                             <thead>
                                 <tr>
                                     <th>Sr. No.</th>
                                     <th>Tab Name</th>
                                     <th>Quantity</th>
                                     <th>Price</th>
                                 </tr>
                            </thead>
                            <tbody>
                                <?php if($patients->tab_name1){ ?>
                                <tr>
                                    <td><?php echo "1" ; ?></td>
                                    <td><?php
                                    $name1 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name1)->get()->row();
                                    if($name1)
                                    {
                                        echo $name1->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name1; 
                                    }
                                    
                                    
                                   // echo $patients->tab_name1 ; ?></td>
                                    <td><?php echo $patients->tab_quantity1 ; ?></td>
                                    <td><?php echo $patients->price_tab1 ; ?></td>
                                </tr>
                                <?php } ?>
                                <?php if($patients->tab_name2){ ?>
                                <tr>
                                    <td><?php echo "2" ; ?></td>
                                    <td><?php
                                    $name2 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name2)->get()->row();
                                    if($name2)
                                    {
                                        echo $name2->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name2; 
                                    }
                                    
                                    
                                    //echo $patients->tab_name2 ; ?></td>
                                    <td><?php echo $patients->tab_quantity2 ; ?></td>
                                    <td><?php echo $patients->price_tab2 ; ?></td>
                                </tr>
                                <?php } ?>
                                <?php if($patients->tab_name3){ ?>
                                <tr>
                                    <td><?php echo "3" ; ?></td>
                                    <td><?php
                                    $name3 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name3)->get()->row();
                                    if($name3)
                                    {
                                        echo $name3->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name3; 
                                    }
                                    
                                    //echo $patients->tab_name3 ; ?></td>
                                    <td><?php echo $patients->tab_quantity3 ; ?></td>
                                    <td><?php echo $patients->price_tab3 ; ?></td>
                                </tr>
                                <?php } ?>
                                <?php if($patients->tab_name4){ ?>
                                <tr>
                                    <td><?php echo "4" ; ?></td>
                                    <td><?php //
                                    $name4 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name4)->get()->row();
                                    if($name4)
                                    {
                                        echo $name4->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name4; 
                                    }
                                    
                                    
                                    //echo $patients->tab_name4 ; ?></td>
                                    <td><?php echo $patients->tab_quantity4 ; ?></td>
                                    <td><?php echo $patients->price_tab4 ; ?></td>
                                </tr>
                                <?php } ?>
                                <?php if($patients->tab_name5){ ?>
                                <tr>
                                    <td><?php echo "5" ; ?></td>
                                    <td><?php 
                                    $name5 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name5)->get()->row();
                                    if($name5)
                                    {
                                        echo $name5->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name5; 
                                    }
                                    
                                    //echo $patients->tab_name5 ; ?></td>
                                    <td><?php echo $patients->tab_quantity5 ; ?></td>
                                    <td><?php echo $patients->price_tab5 ; ?></td>
                                </tr>
                                <?php } ?>
                                
                                <?php if($patients->tab_name6){ ?>
                                <tr>
                                    <td><?php echo "6" ; ?></td>
                                    <td><?php 
                                    $name6 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name6)->get()->row();
                                    if($name6)
                                    {
                                        echo $name6->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name6; 
                                    }
                                    
                                    //echo $patients->tab_name6 ; ?></td>
                                    <td><?php echo $patients->tab_quantity6 ; ?></td>
                                    <td><?php echo $patients->price_tab6 ; ?></td>
                                </tr>
                                <?php } ?>
                                
                                
                                
                                
                                <?php if($patients->tab_name7){ ?>
                                <tr>
                                    <td><?php echo "7" ; ?></td>
                                    <td><?php 
                                    $name7 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name7)->get()->row();
                                    if($name7)
                                    {
                                        echo $name7->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name7; 
                                    }
                                    
                                    //echo $patients->tab_name6 ; ?></td>
                                    <td><?php echo $patients->tab_quantity7 ; ?></td>
                                    <td><?php echo $patients->price_tab7 ; ?></td>
                                </tr>
                                <?php } ?>
                                
                                
                                
                                <?php if($patients->tab_name8){ ?>
                                <tr>
                                    <td><?php echo "8" ; ?></td>
                                    <td><?php 
                                    $name8 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name8)->get()->row();
                                    if($name8)
                                    {
                                        echo $name8->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name8; 
                                    }
                                    
                                    //echo $patients->tab_name6 ; ?></td>
                                    <td><?php echo $patients->tab_quantity8 ; ?></td>
                                    <td><?php echo $patients->price_tab8 ; ?></td>
                                </tr>
                                <?php } ?>
                                
                                
                                
                                <?php if($patients->tab_name9){ ?>
                                <tr>
                                    <td><?php echo "9" ; ?></td>
                                    <td><?php 
                                    $name9 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name9)->get()->row();
                                    if($name9)
                                    {
                                        echo $name9->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name9; 
                                    }
                                    
                                    //echo $patients->tab_name6 ; ?></td>
                                    <td><?php echo $patients->tab_quantity9 ; ?></td>
                                    <td><?php echo $patients->price_tab9 ; ?></td>
                                </tr>
                                <?php } ?>
                                
                                
                                
                                <?php if($patients->tab_name10){ ?>
                                <tr>
                                    <td><?php echo "10" ; ?></td>
                                    <td><?php 
                                    $name10 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name10)->get()->row();
                                    if($name10)
                                    {
                                        echo $name10->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name10; 
                                    }
                                    
                                    //echo $patients->tab_name6 ; ?></td>
                                    <td><?php echo $patients->tab_quantity10 ; ?></td>
                                    <td><?php echo $patients->price_tab10 ; ?></td>
                                </tr>
                                <?php } ?>
                                
                                
                                
                                 <?php if($patients->tab_name11){ ?>
                                <tr>
                                    <td><?php echo "11" ; ?></td>
                                    <td><?php 
                                    $name11 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name11)->get()->row();
                                    if($name11)
                                    {
                                        echo $name11->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name11; 
                                    }
                                    
                                    //echo $patients->tab_name6 ; ?></td>
                                    <td><?php echo $patients->tab_quantity11 ; ?></td>
                                    <td><?php echo $patients->price_tab11 ; ?></td>
                                </tr>
                                <?php } ?>
                                
                                
                                
                                 <?php if($patients->tab_name12){ ?>
                                <tr>
                                    <td><?php echo "12" ; ?></td>
                                    <td><?php 
                                    $name12 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name12)->get()->row();
                                    if($name12)
                                    {
                                        echo $name12->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name12; 
                                    }
                                    
                                    //echo $patients->tab_name6 ; ?></td>
                                    <td><?php echo $patients->tab_quantity12 ; ?></td>
                                    <td><?php echo $patients->price_tab12 ; ?></td>
                                </tr>
                                <?php } ?>
                                
                                
                                
                                 <?php if($patients->tab_name13){ ?>
                                <tr>
                                    <td><?php echo "13" ; ?></td>
                                    <td><?php 
                                    $name13 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name13)->get()->row();
                                    if($name13)
                                    {
                                        echo $name13->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name13; 
                                    }
                                    
                                    //echo $patients->tab_name6 ; ?></td>
                                    <td><?php echo $patients->tab_quantity13 ; ?></td>
                                    <td><?php echo $patients->price_tab13 ; ?></td>
                                </tr>
                                <?php } ?>
                                
                                
                                
                                 <?php if($patients->tab_name14){ ?>
                                <tr>
                                    <td><?php echo "14" ; ?></td>
                                    <td><?php 
                                    $name14 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name14)->get()->row();
                                    if($name14)
                                    {
                                        echo $name14->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name14; 
                                    }
                                    
                                    //echo $patients->tab_name6 ; ?></td>
                                    <td><?php echo $patients->tab_quantity14 ; ?></td>
                                    <td><?php echo $patients->price_tab14 ; ?></td>
                                </tr>
                                <?php } ?>
                                
                                
                                
                                 <?php if($patients->tab_name15){ ?>
                                <tr>
                                    <td><?php echo "15" ; ?></td>
                                    <td><?php 
                                    $name15 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name15)->get()->row();
                                    if($name15)
                                    {
                                        echo $name15->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name15; 
                                    }
                                    
                                    //echo $patients->tab_name6 ; ?></td>
                                    <td><?php echo $patients->tab_quantity15 ; ?></td>
                                    <td><?php echo $patients->price_tab15 ; ?></td>
                                </tr>
                                <?php } ?>
                                
                                
                                
                                
                                <?php if($patients->tab_name15){ ?>
                                <tr>
                                    <td><?php echo "15" ; ?></td>
                                    <td><?php 
                                    $name15 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name15)->get()->row();
                                    if($name15)
                                    {
                                        echo $name15->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name15; 
                                    }
                                    
                                    //echo $patients->tab_name6 ; ?></td>
                                    <td><?php echo $patients->tab_quantity15 ; ?></td>
                                    <td><?php echo $patients->price_tab15 ; ?></td>
                                </tr>
                                <?php } ?>
                                
                                
                                
                                <?php if($patients->tab_name16){ ?>
                                <tr>
                                    <td><?php echo "16" ; ?></td>
                                    <td><?php 
                                    $name16 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name16)->get()->row();
                                    if($name16)
                                    {
                                        echo $name16->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name16; 
                                    }
                                    
                                    //echo $patients->tab_name6 ; ?></td>
                                    <td><?php echo $patients->tab_quantity16 ; ?></td>
                                    <td><?php echo $patients->price_tab16 ; ?></td>
                                </tr>
                                <?php } ?>
                                
                                
                                
                                <?php if($patients->tab_name17){ ?>
                                <tr>
                                    <td><?php echo "17" ; ?></td>
                                    <td><?php 
                                    $name17 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name17)->get()->row();
                                    if($name17)
                                    {
                                        echo $name17->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name17; 
                                    }
                                    
                                    //echo $patients->tab_name6 ; ?></td>
                                    <td><?php echo $patients->tab_quantity17 ; ?></td>
                                    <td><?php echo $patients->price_tab17 ; ?></td>
                                </tr>
                                <?php } ?>
                                
                                
                                
                                <?php if($patients->tab_name18){ ?>
                                <tr>
                                    <td><?php echo "18" ; ?></td>
                                    <td><?php 
                                    $name18 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name18)->get()->row();
                                    if($name18)
                                    {
                                        echo $name18->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name18; 
                                    }
                                    
                                    //echo $patients->tab_name6 ; ?></td>
                                    <td><?php echo $patients->tab_quantity18 ; ?></td>
                                    <td><?php echo $patients->price_tab18 ; ?></td>
                                </tr>
                                <?php } ?>
                                
                                
                                
                                <?php if($patients->tab_name19){ ?>
                                <tr>
                                    <td><?php echo "19" ; ?></td>
                                    <td><?php 
                                    $name19 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name19)->get()->row();
                                    if($name19)
                                    {
                                        echo $name19->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name19; 
                                    }
                                    
                                    //echo $patients->tab_name6 ; ?></td>
                                    <td><?php echo $patients->tab_quantity19 ; ?></td>
                                    <td><?php echo $patients->price_tab19 ; ?></td>
                                </tr>
                                <?php } ?>
                                
                                
                                <?php if($patients->tab_name20){ ?>
                                <tr>
                                    <td><?php echo "20" ; ?></td>
                                    <td><?php 
                                    $name20 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name20)->get()->row();
                                    if($name20)
                                    {
                                        echo $name20->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name20; 
                                    }
                                    
                                    //echo $patients->tab_name6 ; ?></td>
                                    <td><?php echo $patients->tab_quantity20 ; ?></td>
                                    <td><?php echo $patients->price_tab20 ; ?></td>
                                </tr>
                                <?php } ?>
                                
                                <?php if($patients->tab_name21){ ?>
                                <tr>
                                    <td><?php echo "21" ; ?></td>
                                    <td><?php 
                                    $name21 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name21)->get()->row();
                                    if($name21)
                                    {
                                        echo $name21->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name21; 
                                    }
                                    
                                    //echo $patients->tab_name6 ; ?></td>
                                    <td><?php echo $patients->tab_quantity21 ; ?></td>
                                    <td><?php echo $patients->price_tab21 ; ?></td>
                                </tr>
                                <?php } ?>
                                
                                <?php if($patients->tab_name22){ ?>
                                <tr>
                                    <td><?php echo "22" ; ?></td>
                                    <td><?php 
                                    $name22 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name22)->get()->row();
                                    if($name22)
                                    {
                                        echo $name22->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name22; 
                                    }
                                    
                                    //echo $patients->tab_name6 ; ?></td>
                                    <td><?php echo $patients->tab_quantity22 ; ?></td>
                                    <td><?php echo $patients->price_tab22 ; ?></td>
                                </tr>
                                <?php } ?>
                                
                                <?php if($patients->tab_name23){ ?>
                                <tr>
                                    <td><?php echo "23" ; ?></td>
                                    <td><?php 
                                    $name23 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name23)->get()->row();
                                    if($name23)
                                    {
                                        echo $name23->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name23; 
                                    }
                                    
                                    //echo $patients->tab_name6 ; ?></td>
                                    <td><?php echo $patients->tab_quantity23 ; ?></td>
                                    <td><?php echo $patients->price_tab23 ; ?></td>
                                </tr>
                                <?php } ?>
                                
                                <?php if($patients->tab_name24){ ?>
                                <tr>
                                    <td><?php echo "24" ; ?></td>
                                    <td><?php 
                                    $name24 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name24)->get()->row();
                                    if($name24)
                                    {
                                        echo $name24->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name24; 
                                    }
                                    
                                    //echo $patients->tab_name6 ; ?></td>
                                    <td><?php echo $patients->tab_quantity24 ; ?></td>
                                    <td><?php echo $patients->price_tab24 ; ?></td>
                                </tr>
                                <?php } ?>
                                
                                <?php if($patients->tab_name25){ ?>
                                <tr>
                                    <td><?php echo "25" ; ?></td>
                                    <td><?php 
                                    $name25 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patients->tab_name25)->get()->row();
                                    if($name25)
                                    {
                                        echo $name25->tab_name;
                                    }else
                                    {
                                        echo $patients->tab_name25; 
                                    }
                                    
                                    //echo $patients->tab_name6 ; ?></td>
                                    <td><?php echo $patients->tab_quantity25 ; ?></td>
                                    <td><?php echo $patients->price_tab25 ; ?></td>
                                </tr>
                                <?php } ?>
                                
                                <tr>
                                    <td colspan="3">Grand Total</td>
                                    <td><?php echo $sum = $patients->price_tab1 + $patients->price_tab2 + $patients->price_tab3 + $patients->price_tab4 + $patients->price_tab5; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-lg-6">
                            <p>Date : </p>
                        </div>
                        <div class="col-lg-6">
                            <b style="float: right;">Signature <br>& Stamp</b>
                        </div>
                    </div>
                  </div>
                  </div>
            </div> 

            <?php } ?>

            <div class="panel-footer">

                <div class="text-center">

                   
                </div>

            </div>

        </div>

    </div>

 

</div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
