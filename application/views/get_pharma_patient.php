<div class="row">
   <!--  form area -->
   <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
         <div class="panel-heading no-print">
            <div class="btn-group"> 
               <a class="btn btn-primary" href="<?//php echo base_url("biochemical") ?>"> <i class="fa fa-list"></i>  List </a>  
            </div>
         </div>
         <div class="panel-body panel-form">
             
           <?php echo form_open_multipart('patients/save_pharma_patient_count','class="form-inner"') ?>
            <div class="row">
                <div class="col-lg-4">
                    <lable>Section</lable>
                    <select class="form-control" name="section" id="section">
                        <option value="opd">OPD</option>
                        <option value="ipd">IPD</option>
                    </select>
                </div>
                <div class="col-lg-4">
                    <lable>Date</lable>
                    <input type="text" name="date" id="date" placeholder="Date" class="datepicker form-control">
                </div>
                <div class="col-lg-4">
                    <lable>Name</lable>
                    <select class="form-control" name="patient_name" id="patient_name">
                    </select>
                    <!--<input type="text" name="patient_name" placeholder="Patient_name" id="patient_name" class="form-control">-->
                </div>
            </div>
            
            <br>
            <!--<div class="row" style="padding: 20px;box-shadow: #307e43 1px 1px 5px 1px;margin: 10px;">-->
            <div class="row">
                <div class="col-md-6">
                    <lable>RX1</lable>
                    <input type="text" name="RX1_tab" id="RX1_tab" placeholder="RX1" class="form-control">
                </div>
                <div class="col-md-6">
                    <lable>RX2</lable>
                    <input type="text" name="RX2_tab" id="RX2_tab" placeholder="RX2" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <lable>RX3</lable>
                    <input type="text" name="RX3_tab" id="RX3_tab" placeholder="RX3" class="form-control">
                </div>
                <div class="col-md-6">
                    <lable>RX4</lable>
                    <input type="text" name="RX4_tab" id="RX4_tab" placeholder="RX4" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <lable>RX5</lable>
                    <input type="text" name="RX5_tab" id="RX5_tab" placeholder="RX5" class="form-control">
                </div>
                <div class="col-lg-6">
                    <lable>Other1</lable>
                    <input type="text" name="other1" id="other1" placeholder="other1" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <lable>Other2</lable>
                    <input type="text" name="other2" id="other2" placeholder="other2" class="form-control">
                </div>
                <div class="col-lg-6">
                    <lable>Other3</lable>
                    <textarea type="text" name="other3" rows="6" id="other3" placeholder="other3" class="form-control"></textarea>
                </div>
            </div>
            </div>
             <hr>
            <?php echo form_open_multipart('patients/save_pharma_patient_count','class="form-inner"') ?>
            <?//php echo form_hidden('id',$biochemical->id); ?>        
                  
               <div class="col-md-6 col-sm-12">   

                  
                  <div class="form-group row">
                     <label for="opd_no" class="col-xs-3 col-form-label">Opd No</label>
                     <div class="col-xs-9">
                        <input name="opd_no" autocomplete="off" type="text" class="form-control" id="opd_no" placeholder="opd_no" value="<?//php echo $biochemical->opd_no ?>">    
                        <input name="id" autocomplete="off" type="hidden" class="form-control" id="id" placeholder="id" value="<?//php echo $biochemical->opd_no ?>">    
                     </div>
                  </div>
                  
                  <div class="form-group row">
                     <label for="name" class="col-xs-3 col-form-label">Name</label>
                     <div class="col-xs-9">
                        <input name="name" autocomplete="off" type="text" class="form-control" id="firstname" placeholder="Name" value="<?//php echo $biochemical->name ?>">    
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="age" class="col-xs-3 col-form-label">Age</label>
                     <div class="col-xs-9">
                        <input name="age" autocomplete="off" type="text" class="form-control" id="age" placeholder="Age" value="<?//php echo $biochemical->age ?>">    
                     </div>
                  </div> 
                  <div class="form-group row">
                     <label for="address" class="col-xs-3 col-form-label">Address</label>
                     <div class="col-xs-9">
                        <input name="address" autocomplete="off" type="text" class="form-control" id="address" placeholder="Address" value="<?//php echo $biochemical->age ?>">    
                     </div>
                  </div> 
                  <div class="form-group row">
                  </div> 
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet1</label>
                        <div class="col-xs-4">
                            <select name="tab_name1" id="tab_name1" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
                               <?php if($tab->opening_stock > '0'){ ?>
                                <option  value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>                 
                        </div>
                         <div class="col-xs-3 col-form-label">
                         <input type="text" id="batch_no1" name="batch_no1" class="form-control" placeholder='Batch Number' readonly>
                        </div>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab1" name="closing_stock_tab1" class="form-control" placeholder='Available Stock' readonly>
                     </div>
                    </div>
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet2</label>
                        <div class="col-xs-4">
                            <select name="tab_name2" id="tab_name2" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
                              <?php if($tab->opening_stock > '0'){ ?>
                                <option  value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>
                              <?php } ?>
                            </select>                 
                        </div>
                        <div class="col-xs-3 col-form-label">
                         <input type="text" id="batch_no2" name="batch_no2" class="form-control" placeholder='Batch Number' readonly>
                        </div>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab2" name="closing_stock_tab2" class="form-control" placeholder='Available Stock' readonly>
                     </div>
                    </div>
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet3</label>
                        <div class="col-xs-4">
                            <select name="tab_name3" id="tab_name3" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
<?php if($tab->opening_stock > '0'){ ?>
                                <option  value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>                                <?php } ?>
                            </select>                 
                        </div>
                        <div class="col-xs-3 col-form-label">
                         <input type="text" id="batch_no3" name="batch_no3" class="form-control" placeholder='Batch Number' readonly>
                        </div>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab3" name="closing_stock_tab3" class="form-control" placeholder='Available Stock' readonly>
                     </div>
                    </div>
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet4</label>
                        <div class="col-xs-4">
                            <select name="tab_name4" id="tab_name4" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
<?php if($tab->opening_stock > '0'){ ?>
                                <option  value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>                                <?php } ?>
                            </select>                 
                        </div>
                        <div class="col-xs-3 col-form-label">
                         <input type="text" id="batch_no4" name="batch_no4" class="form-control" placeholder='Batch Number' readonly>
                        </div>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab4" name="closing_stock_tab4" class="form-control" placeholder='Available Stock' readonly>
                     </div>
                    </div>
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet5</label>
                        <div class="col-xs-4">
                            <select name="tab_name5" id="tab_name5" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
<?php if($tab->opening_stock > '0'){ ?>
                                <option  value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>                                <?php } ?>
                            </select>                 
                        </div>
                        <div class="col-xs-3 col-form-label">
                         <input type="text" id="batch_no5" name="batch_no5" class="form-control" placeholder='Batch Number' readonly>
                        </div>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab5" name="closing_stock_tab5" class="form-control" placeholder='Available Stock' readonly>
                     </div>
                    </div>
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet6</label>
                        <div class="col-xs-4">
                            <select name="tab_name6" id="tab_name6" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
<?php if($tab->opening_stock > '0'){ ?>
                                <option  value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>                                <?php } ?>
                            </select>                 
                        </div>
                        <div class="col-xs-3 col-form-label">
                         <input type="text" id="batch_no6" name="batch_no6" class="form-control" placeholder='Batch Number' readonly>
                        </div>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab6" name="closing_stock_tab6" class="form-control" placeholder='Available Stock' readonly>
                     </div>
                    </div>
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet7</label>
                        <div class="col-xs-4">
                            <select name="tab_name7" id="tab_name7" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
<?php if($tab->opening_stock > '0'){ ?>
                                <option  value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>                                <?php } ?>
                            </select>                 
                        </div>
                        <div class="col-xs-3 col-form-label">
                         <input type="text" id="batch_no7" name="batch_no7" class="form-control" placeholder='Batch Number' readonly>
                        </div>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab7" name="closing_stock_tab7" class="form-control" placeholder='Available Stock' readonly>
                     </div>
                    </div>
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet8</label>
                        <div class="col-xs-4">
                            <select name="tab_name8" id="tab_name8" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
<?php if($tab->opening_stock > '0'){ ?>
                                <option  value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>                                <?php } ?>
                            </select>                 
                        </div>
                        <div class="col-xs-3 col-form-label">
                         <input type="text" id="batch_no8" name="batch_no8" class="form-control" placeholder='Batch Number' readonly>
                        </div>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab8" name="closing_stock_tab8" class="form-control" placeholder='Available Stock' readonly>
                     </div>
                    </div>
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet9</label>
                        <div class="col-xs-4">
                            <select name="tab_name9" id="tab_name9" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
<?php if($tab->opening_stock > '0'){ ?>
                                <option  value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>                                <?php } ?>
                            </select>                 
                        </div>
                        <div class="col-xs-3 col-form-label">
                         <input type="text" id="batch_no9" name="batch_no9" class="form-control" placeholder='Batch Number' readonly>
                        </div>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab9" name="closing_stock_tab9" class="form-control" placeholder='Available Stock' readonly>
                     </div>
                    </div>
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet10</label>
                        <div class="col-xs-4">
                            <select name="tab_name10" id="tab_name10" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
<?php if($tab->opening_stock > '0'){ ?>
                                <option  value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>                                <?php } ?>
                            </select>                 
                        </div>
                        <div class="col-xs-3 col-form-label">
                         <input type="text" id="batch_no10" name="batch_no10" class="form-control" placeholder='Batch Number' readonly>
                        </div>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab10" name="closing_stock_tab10" class="form-control" placeholder='Available Stock' readonly>
                     </div>
                    </div>
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet11</label>
                        <div class="col-xs-4">
                            <select name="tab_name11" id="tab_name11" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
<?php if($tab->opening_stock > '0'){ ?>
                                <option  value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>                                <?php } ?>
                            </select>                 
                        </div>
                        <div class="col-xs-3 col-form-label">
                         <input type="text" id="batch_no11" name="batch_no11" class="form-control" placeholder='Batch Number' readonly>
                        </div>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab11" name="closing_stock_tab11" class="form-control" placeholder='Available Stock' readonly>
                     </div>
                    </div>
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet12</label>
                        <div class="col-xs-4">
                            <select name="tab_name12" id="tab_name12" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
<?php if($tab->opening_stock > '0'){ ?>
                                <option  value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>                                <?php } ?>
                            </select>                 
                        </div>
                        <div class="col-xs-3 col-form-label">
                         <input type="text" id="batch_no12" name="batch_no12" class="form-control" placeholder='Batch Number' readonly>
                        </div>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab12" name="closing_stock_tab12" class="form-control" placeholder='Available Stock' readonly>
                     </div>
                    </div>
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet13</label>
                        <div class="col-xs-4">
                            <select name="tab_name13" id="tab_name13" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
<?php if($tab->opening_stock > '0'){ ?>
                                <option  value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>                                <?php } ?>
                            </select>                 
                        </div>
                        <div class="col-xs-3 col-form-label">
                         <input type="text" id="batch_no13" name="batch_no13" class="form-control" placeholder='Batch Number' readonly>
                        </div>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab13" name="closing_stock_tab13" class="form-control" placeholder='Available Stock' readonly>
                     </div>
                    </div>
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet14</label>
                        <div class="col-xs-4">
                            <select name="tab_name14" id="tab_name14" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
<?php if($tab->opening_stock > '0'){ ?>
                                <option  value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>                                <?php } ?>
                            </select>                 
                        </div>
                        <div class="col-xs-3 col-form-label">
                         <input type="text" id="batch_no14" name="batch_no14" class="form-control" placeholder='Batch Number' readonly>
                        </div>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab14" name="closing_stock_tab14" class="form-control" placeholder='Available Stock' readonly>
                     </div>
                    </div>
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet15</label>
                        <div class="col-xs-4">
                            <select name="tab_name15" id="tab_name15" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
<?php if($tab->opening_stock > '0'){ ?>
                                <option  value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>                                <?php } ?>
                            </select>                 
                        </div>
                        <div class="col-xs-3 col-form-label">
                         <input type="text" id="batch_no15" name="batch_no15" class="form-control" placeholder='Batch Number' readonly>
                        </div>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab15" name="closing_stock_tab15" class="form-control" placeholder='Available Stock' readonly>
                     </div>
                    </div>
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet16</label>
                        <div class="col-xs-4">
                            <select name="tab_name16" id="tab_name16" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
								<?php if($tab->opening_stock > '0'){ ?>
                                <option  value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>                                <?php } ?>
                            </select>                 
                        </div>
                        <div class="col-xs-3 col-form-label">
                         <input type="text" id="batch_no16" name="batch_no16" class="form-control" placeholder='Batch Number' readonly>
                        </div>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab16" name="closing_stock_tab16" class="form-control" placeholder='Available Stock' readonly>
                     </div>
                    </div>
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet17</label>
                        <div class="col-xs-4">
                            <select name="tab_name17" id="tab_name17" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
								<?php if($tab->opening_stock > '0'){ ?>
                                <option  value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>                                <?php } ?>
                            </select>                 
                        </div>
                        <div class="col-xs-3 col-form-label">
                         <input type="text" id="batch_no17" name="batch_no17" class="form-control" placeholder='Batch Number' readonly>
                        </div>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab17" name="closing_stock_tab17" class="form-control" placeholder='Available Stock' readonly>
                     </div>
                    </div>
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet18</label>
                        <div class="col-xs-4">
                            <select name="tab_name18" id="tab_name18" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
<?php if($tab->opening_stock > '0'){ ?>
                                <option  value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>                                <?php } ?>
                            </select>                 
                        </div>
                        <div class="col-xs-3 col-form-label">
                         <input type="text" id="batch_no18" name="batch_no18" class="form-control" placeholder='Batch Number' readonly>
                        </div>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab18" name="closing_stock_tab18" class="form-control" placeholder='Available Stock' readonly>
                     </div>
                    </div>
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet19</label>
                        <div class="col-xs-4">
                            <select name="tab_name19" id="tab_name19" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
<?php if($tab->opening_stock > '0'){ ?>
                                <option  value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>                                <?php } ?>
                            </select>                 
                        </div>
                        <div class="col-xs-3 col-form-label">
                         <input type="text" id="batch_no19" name="batch_no19" class="form-control" placeholder='Batch Number' readonly>
                        </div>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab19" name="closing_stock_tab19" class="form-control" placeholder='Available Stock' readonly>
                     </div>
                    </div>
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet20</label>
                        <div class="col-xs-4">
                            <select name="tab_name20" id="tab_name20" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
<?php if($tab->opening_stock > '0'){ ?>
                                <option  value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>                                <?php } ?>
                            </select>                 
                        </div>
                        <div class="col-xs-3 col-form-label">
                         <input type="text" id="batch_no20" name="batch_no20" class="form-control" placeholder='Batch Number' readonly>
                        </div>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab20" name="closing_stock_tab20" class="form-control" placeholder='Available Stock' readonly>
                     </div>
                    </div>
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet21</label>
                        <div class="col-xs-4">
                            <select name="tab_name21" id="tab_name21" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
<?php if($tab->opening_stock > '0'){ ?>
                                <option  value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>                                <?php } ?>
                            </select>                 
                        </div>
                        <div class="col-xs-3 col-form-label">
                         <input type="text" id="batch_no21" name="batch_no21" class="form-control" placeholder='Batch Number' readonly>
                        </div>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab21" name="closing_stock_tab21" class="form-control" placeholder='Available Stock' readonly>
                     </div>
                    </div>
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet22</label>
                        <div class="col-xs-4">
                            <select name="tab_name22" id="tab_name22" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
<?php if($tab->opening_stock > '0'){ ?>
                                <option  value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>                                <?php } ?>
                            </select>                 
                        </div>
                        <div class="col-xs-3 col-form-label">
                         <input type="text" id="batch_no22" name="batch_no22" class="form-control" placeholder='Batch Number' readonly>
                        </div>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab22" name="closing_stock_tab22" class="form-control" placeholder='Available Stock' readonly>
                     </div>
                    </div>
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet23</label>
                        <div class="col-xs-4">
                            <select name="tab_name23" id="tab_name23" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
<?php if($tab->opening_stock > '0'){ ?>
                                <option  value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>                                <?php } ?>
                            </select>                 
                        </div>
                        <div class="col-xs-3 col-form-label">
                         <input type="text" id="batch_no23" name="batch_no23" class="form-control" placeholder='Batch Number' readonly>
                        </div>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab23" name="closing_stock_tab23" class="form-control" placeholder='Available Stock' readonly>
                     </div>
                    </div>
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet24</label>
                        <div class="col-xs-4">
                            <select name="tab_name24" id="tab_name24" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
<?php if($tab->opening_stock > '0'){ ?>
                                <option  value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>                                <?php } ?>
                            </select>                 
                        </div>
                        <div class="col-xs-3 col-form-label">
                         <input type="text" id="batch_no24" name="batch_no24" class="form-control" placeholder='Batch Number' readonly>
                        </div>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab24" name="closing_stock_tab24" class="form-control" placeholder='Available Stock' readonly>
                     </div>
                    </div>
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet25</label>
                        <div class="col-xs-4">
                            <select name="tab_name25" id="tab_name25" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
<?php if($tab->opening_stock > '0'){ ?>
                                <option  value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>                                <?php } ?>
                            </select>                 
                        </div>
                        <div class="col-xs-3 col-form-label">
                         <input type="text" id="batch_no25" name="batch_no25" class="form-control" placeholder='Batch Number' readonly>
                        </div>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab25" name="closing_stock_tab25" class="form-control" placeholder='Available Stock' readonly>
                     </div>
                    </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                     <label for="date" class="col-xs-3 col-form-label">Date</label>
                     <div class="col-xs-9">
                        <input name="create_date" autocomplete="off" type="text" class="datepicker form-control" id="create_date" placeholder="Date" value="<?php echo date('Y-m-d');?>">    
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="sex" class="col-xs-3 col-form-label">Sex</label>
                     <div class="col-xs-9">
                        <input name="sex" autocomplete="off" type="text" class="form-control" id="sex" placeholder="Sex" value="<?//php echo $biochemical->sex ?>">    
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="dignosis" class="col-xs-3 col-form-label">Dignosis</label>
                     <div class="col-xs-9">
                        <input name="dignosis" autocomplete="off" type="text" class="form-control" id="dignosis" placeholder="Dignosis" value="<?//php echo $biochemical->date ?>">    
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="weight" class="col-xs-3 col-form-label">Weight</label>
                     <div class="col-xs-9">
                        <input name="weight" autocomplete="off" type="text" class="form-control" id="weight" placeholder="Weight" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                  </div>
                   <br>
                   
                  <div class="form-group row">
                      <label for="weight" class="col-xs-3 col-form-label">Quantity</label>
                     <div class="col-xs-3">
                        <input name="tab1_quantity" autocomplete="off" type="text" class="form-control" id="tab1_quantity" placeholder="Quantity" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                      <label for="weight" class="col-xs-3 col-form-label">Price</label>
                     <div class="col-xs-3">
                         <input type="text" id="price_tab1" name="price_tab1" class="form-control" placeholder='Price'>
                     </div>
                     
                  </div>
                  <div class="form-group row">
                      <label for="weight" class="col-xs-3 col-form-label">Quantity</label>
                     <div class="col-xs-3">
                        <input name="tab2_quantity" autocomplete="off" type="text" class="form-control" id="tab2_quantity" placeholder="Quantity" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                      <label for="weight" class="col-xs-3 col-form-label">Price</label>
                     <div class="col-xs-3">
                         <input type="text" id="price_tab2" name="price_tab2" class="form-control" placeholder='Price'>
                     </div>
                     
                  </div>
                
                <div class="form-group row">
                    <label for="weight" class="col-xs-3 col-form-label">Quantity </label>
                     <div class="col-xs-3">
                        <input name="tab3_quantity" autocomplete="off" type="text" class="form-control" id="tab3_quantity" placeholder="Quantity" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                    <label for="weight" class="col-xs-3 col-form-label">Price</label>
                     <div class="col-xs-3">
                         <input type="text" id="price_tab3" name="price_tab3" class="form-control" placeholder='Price'>
                     </div>
                     
                  </div>
                  <div class="form-group row">
                      <label for="weight" class="col-xs-3 col-form-label">Quantity </label>
                     <div class="col-xs-3">
                        <input name="tab4_quantity" autocomplete="off" type="text" class="form-control" id="tab4_quantity" placeholder="Quantity" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                      <label for="weight" class="col-xs-3 col-form-label">Price</label>
                     <div class="col-xs-3">
                         <input type="text" id="price_tab4" name="price_tab4" class="form-control" placeholder="Price">
                     </div>
                     
                  </div>
                  <div class="form-group row">
                      <label for="weight" class="col-xs-3 col-form-label">Quantity </label>
                     <div class="col-xs-3">
                        <input name="tab5_quantity" autocomplete="off" type="text" class="form-control" id="tab5_quantity" placeholder="Quantity" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                      <label for="weight" class="col-xs-3 col-form-label">Price</label>
                     <div class="col-xs-3">
                         <input type="text" id="price_tab5" name="price_tab5" class="form-control" placeholder='Price'>
                     </div>
                  </div>
                  <div class="form-group row">
                      <label for="weight" class="col-xs-3 col-form-label">Quantity</label>
                     <div class="col-xs-3">
                        <input name="tab6_quantity" autocomplete="off" type="text" class="form-control" id="tab6_quantity" placeholder="Quantity" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                      <label for="weight" class="col-xs-3 col-form-label">Price</label>
                     <div class="col-xs-3">
                         <input type="text" id="price_tab6" name="price_tab6" class="form-control" placeholder='Price'>
                     </div>
                  </div>
                  <div class="form-group row">
                      <label for="weight" class="col-xs-3 col-form-label">Quantity</label>
                     <div class="col-xs-3">
                        <input name="tab7_quantity" autocomplete="off" type="text" class="form-control" id="tab7_quantity" placeholder="Quantity" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                      <label for="weight" class="col-xs-3 col-form-label">Price</label>
                     <div class="col-xs-3">
                         <input type="text" id="price_tab7" name="price_tab7" class="form-control" placeholder='Price'>
                     </div>
                  </div>
                  <div class="form-group row">
                      <label for="weight" class="col-xs-3 col-form-label">Quantity</label>
                     <div class="col-xs-3">
                        <input name="tab8_quantity" autocomplete="off" type="text" class="form-control" id="tab8_quantity" placeholder="Quantity" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                      <label for="weight" class="col-xs-3 col-form-label">Price</label>
                     <div class="col-xs-3">
                         <input type="text" id="price_tab8" name="price_tab8" class="form-control" placeholder='Price'>
                     </div>
                  </div>
                  <div class="form-group row">
                      <label for="weight" class="col-xs-3 col-form-label">Quantity</label>
                     <div class="col-xs-3">
                        <input name="tab9_quantity" autocomplete="off" type="text" class="form-control" id="tab9_quantity" placeholder="Quantity" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                      <label for="weight" class="col-xs-3 col-form-label">Price</label>
                     <div class="col-xs-3">
                         <input type="text" id="price_tab9" name="price_tab9" class="form-control" placeholder='Price'>
                     </div>
                  </div>
                  <div class="form-group row">
                      <label for="weight" class="col-xs-3 col-form-label">Quantity</label>
                     <div class="col-xs-3">
                        <input name="tab10_quantity" autocomplete="off" type="text" class="form-control" id="tab10_quantity" placeholder="Quantity" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                      <label for="weight" class="col-xs-3 col-form-label">Price</label>
                     <div class="col-xs-3">
                         <input type="text" id="price_tab10" name="price_tab10" class="form-control" placeholder='Price'>
                     </div>
                  </div>
                  <div class="form-group row">
                      <label for="weight" class="col-xs-3 col-form-label">Quantity</label>
                     <div class="col-xs-3">
                        <input name="tab11_quantity" autocomplete="off" type="text" class="form-control" id="tab11_quantity" placeholder="Quantity" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                      <label for="weight" class="col-xs-3 col-form-label">Price</label>
                     <div class="col-xs-3">
                         <input type="text" id="price_tab11" name="price_tab11" class="form-control" placeholder='Price'>
                     </div>
                  </div>
                  <div class="form-group row">
                      <label for="weight" class="col-xs-3 col-form-label">Quantity</label>
                     <div class="col-xs-3">
                        <input name="tab12_quantity" autocomplete="off" type="text" class="form-control" id="tab12_quantity" placeholder="Quantity" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                      <label for="weight" class="col-xs-3 col-form-label">Price</label>
                     <div class="col-xs-3">
                         <input type="text" id="price_tab12" name="price_tab12" class="form-control" placeholder='Price'>
                     </div>
                  </div>
                  <div class="form-group row">
                      <label for="weight" class="col-xs-3 col-form-label">Quantity</label>
                     <div class="col-xs-3">
                        <input name="tab13_quantity" autocomplete="off" type="text" class="form-control" id="tab13_quantity" placeholder="Quantity" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                      <label for="weight" class="col-xs-3 col-form-label">Price</label>
                     <div class="col-xs-3">
                         <input type="text" id="price_tab13" name="price_tab13" class="form-control" placeholder='Price'>
                     </div>
                  </div>
                  <div class="form-group row">
                      <label for="weight" class="col-xs-3 col-form-label">Quantity</label>
                     <div class="col-xs-3">
                        <input name="tab14_quantity" autocomplete="off" type="text" class="form-control" id="tab14_quantity" placeholder="Quantity" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                      <label for="weight" class="col-xs-3 col-form-label">Price</label>
                     <div class="col-xs-3">
                         <input type="text" id="price_tab14" name="price_tab14" class="form-control" placeholder='Price'>
                     </div>
                  </div>
                  <div class="form-group row">
                      <label for="weight" class="col-xs-3 col-form-label">Quantity</label>
                     <div class="col-xs-3">
                        <input name="tab15_quantity" autocomplete="off" type="text" class="form-control" id="tab15_quantity" placeholder="Quantity" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                      <label for="weight" class="col-xs-3 col-form-label">Price</label>
                     <div class="col-xs-3">
                         <input type="text" id="price_tab15" name="price_tab15" class="form-control" placeholder='Price'>
                     </div>
                  </div>
                  <div class="form-group row">
                      <label for="weight" class="col-xs-3 col-form-label">Quantity</label>
                     <div class="col-xs-3">
                        <input name="tab16_quantity" autocomplete="off" type="text" class="form-control" id="tab16_quantity" placeholder="Quantity" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                      <label for="weight" class="col-xs-3 col-form-label">Price</label>
                     <div class="col-xs-3">
                         <input type="text" id="price_tab16" name="price_tab16" class="form-control" placeholder='Price'>
                     </div>
                  </div>
                  <div class="form-group row">
                      <label for="weight" class="col-xs-3 col-form-label">Quantity</label>
                     <div class="col-xs-3">
                        <input name="tab17_quantity" autocomplete="off" type="text" class="form-control" id="tab17_quantity" placeholder="Quantity" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                      <label for="weight" class="col-xs-3 col-form-label">Price</label>
                     <div class="col-xs-3">
                         <input type="text" id="price_tab17" name="price_tab17" class="form-control" placeholder='Price'>
                     </div>
                  </div>
                  <div class="form-group row">
                      <label for="weight" class="col-xs-3 col-form-label">Quantity</label>
                     <div class="col-xs-3">
                        <input name="tab18_quantity" autocomplete="off" type="text" class="form-control" id="tab18_quantity" placeholder="Quantity" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                      <label for="weight" class="col-xs-3 col-form-label">Price</label>
                     <div class="col-xs-3">
                         <input type="text" id="price_tab18" name="price_tab18" class="form-control" placeholder='Price'>
                     </div>
                  </div>
                  <div class="form-group row">
                      <label for="weight" class="col-xs-3 col-form-label">Quantity</label>
                     <div class="col-xs-3">
                        <input name="tab19_quantity" autocomplete="off" type="text" class="form-control" id="tab19_quantity" placeholder="Quantity" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                      <label for="weight" class="col-xs-3 col-form-label">Price</label>
                     <div class="col-xs-3">
                         <input type="text" id="price_tab19" name="price_tab19" class="form-control" placeholder='Price'>
                     </div>
                  </div>
                  <div class="form-group row">
                      <label for="weight" class="col-xs-3 col-form-label">Quantity</label>
                     <div class="col-xs-3">
                        <input name="tab20_quantity" autocomplete="off" type="text" class="form-control" id="tab20_quantity" placeholder="Quantity" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                      <label for="weight" class="col-xs-3 col-form-label">Price</label>
                     <div class="col-xs-3">
                         <input type="text" id="price_tab20" name="price_tab20" class="form-control" placeholder='Price'>
                     </div>
                  </div>
                  <div class="form-group row">
                      <label for="weight" class="col-xs-3 col-form-label">Quantity</label>
                     <div class="col-xs-3">
                        <input name="tab21_quantity" autocomplete="off" type="text" class="form-control" id="tab21_quantity" placeholder="Quantity" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                      <label for="weight" class="col-xs-3 col-form-label">Price</label>
                     <div class="col-xs-3">
                         <input type="text" id="price_tab21" name="price_tab21" class="form-control" placeholder='Price'>
                     </div>
                  </div>
                  <div class="form-group row">
                      <label for="weight" class="col-xs-3 col-form-label">Quantity</label>
                     <div class="col-xs-3">
                        <input name="tab22_quantity" autocomplete="off" type="text" class="form-control" id="tab22_quantity" placeholder="Quantity" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                      <label for="weight" class="col-xs-3 col-form-label">Price</label>
                     <div class="col-xs-3">
                         <input type="text" id="price_tab22" name="price_tab22" class="form-control" placeholder='Price'>
                     </div>
                  </div>
                  <div class="form-group row">
                      <label for="weight" class="col-xs-3 col-form-label">Quantity</label>
                     <div class="col-xs-3">
                        <input name="tab23_quantity" autocomplete="off" type="text" class="form-control" id="tab23_quantity" placeholder="Quantity" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                      <label for="weight" class="col-xs-3 col-form-label">Price</label>
                     <div class="col-xs-3">
                         <input type="text" id="price_tab23" name="price_tab23" class="form-control" placeholder='Price'>
                     </div>
                  </div>
                  <div class="form-group row">
                      <label for="weight" class="col-xs-3 col-form-label">Quantity</label>
                     <div class="col-xs-3">
                        <input name="tab24_quantity" autocomplete="off" type="text" class="form-control" id="tab24_quantity" placeholder="Quantity" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                      <label for="weight" class="col-xs-3 col-form-label">Price</label>
                     <div class="col-xs-3">
                         <input type="text" id="price_tab24" name="price_tab24" class="form-control" placeholder='Price'>
                     </div>
                  </div>
                  <div class="form-group row">
                      <label for="weight" class="col-xs-3 col-form-label">Quantity</label>
                     <div class="col-xs-3">
                        <input name="tab25_quantity" autocomplete="off" type="text" class="form-control" id="tab25_quantity" placeholder="Quantity" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                      <label for="weight" class="col-xs-3 col-form-label">Price</label>
                     <div class="col-xs-3">
                         <input type="text" id="price_tab25" name="price_tab25" class="form-control" placeholder='Price'>
                     </div>
                  </div>
                  
                </div>
            </div>
                
                <div class="form-group row">
                  <div class="col-sm-offset-3 col-sm-6">
                     <div class="ui buttons">
                        <button type="reset" class="ui button"><?php echo display('reset') ?></button>
                        <div class="or"></div>
                        <button class="ui positive button"><?php echo display('save') ?></button>
                     </div>
                  </div>
               </div>
               <?php echo form_close() ?> 



            </div>
        </div> 
    </div>
</div>

<script>
$(document).ready(function() {
   
  $('#opd_no').keyup(function(){

      var pid = $(this);
       
      $.ajax({

          url  : '<?= base_url('patients/check_patient/') ?>',

          type : 'post',

          dataType : 'JSON',

          data : {

              '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',

              old_reg_no : pid.val()

          },

          success : function(data) 
           

          {
              //console.log(data);

              if (data.status == true) {
                 //$('#yearly_reg_no').val(data.patient.yearly_reg_no);
                 //$('#yearly_no').val(data.patient.yearly_no);
                 
                $('#firstname').val(data.patient.firstname);
                $('#age').val(data.patient.date_of_birth);
                $('#sex').val(data.patient.sex);
                $('#weight').val(data.patient.wieght);
                $('#dignosis').val(data.patient.dignosis);
                $('#id').val(data.patient.id);
                $('#address').val(data.patient.address);

              } else if (data.status == false) {

                  pid.next().text(data.message).addClass('text-danger').removeClass('text-success');

              } else {

                  pid.next().text(data.message).addClass('text-danger').removeClass('text-success');

              }

          }, 

          error : function()

          {

              alert('failed');

          }

      });

  });



    $('body').on('keyup change', '#date', function() {

        //var patient_id = $(this).val();
       /// var date = $(this).val();
        
        
        var date = $('#date').val();
        
        var section = $('#section').val();
        
         //alert(section);


        $.ajax({

            url     : '<?php echo base_url('patients/fetch_patient') ?>',

            method  : 'post',

            dataType: 'json', 

            data    : {

                'create_date' : date,
                
                'section' : section,
                

                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'

            },
               // alert(hiii);
              //  console.log(section)
            success : function(data) {
                // console.log(data);
                $('#patient_name').empty();
                if (data.status == true) { 
                    var newarray = data.patient_name;
                    for(var i=0;i<newarray.length;i++)
                    {
                        if(newarray[i])
                        {
                            if(newarray[i].yearly_reg_no)
                            {
                                var number = newarray[i].yearly_reg_no;
                            }
                            else
                            {
                                var number = newarray[i].old_reg_no;
                            }
                            $('#patient_name').append(
                                        '<option value="' + newarray[i].id + '" selected>' + newarray[i].firstname + '('+ number +')</option>'
                            );
                        }
                    }
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    
    
    
    $('body').on('keyup change', '#patient_name', function() {
        
        var patient_name = $('#patient_name').val();
        var date = $('#date').val();
        var section = $('#section').val();
        
        //  alert(section);
        //  alert(date);
        //  alert(patient_name);


        $.ajax({

            url     : '<?php echo base_url('patients/fetch_treatment') ?>',

            method  : 'post',

            dataType: 'json', 

            data    : {
                'patient_name' : patient_name,
                'create_date' : date,
                'section' : section,
                
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                $('#RX1_tab').empty();
                $('#RX2_tab').empty();
                $('#RX3_tab').empty();
                $('#RX4_tab').empty();
                $('#RX5_tab').empty();
                $('#other1').empty();
                $('#other2').empty();
                $('#other3').empty();
                if (data.status == true) { 
                    console.log(data);
                    $('#RX1_tab').val(data.RX1_tab);
                    $('#RX2_tab').val(data.RX2_tab);
                    $('#RX3_tab').val(data.RX3_tab);
                    $('#RX4_tab').val(data.RX4_tab);
                    $('#RX5_tab').val(data.RX5_tab);
                    var status_m = data.patients.manual_status;
                    //alert(status_m);
                    if(status_m == 1){
                    $('#other1').val(data.RX_other_tab);
                    $('#other2').val(data.RX_other1_tab);
                    $('#other3').val(data.other_equipment_tab);
                    }
                    $('#id').val(data.id);
                    $('#dignosis').val(data.dignosis);
                    
                    var newpatient = data.yearly_reg_no;
                    var oldpatient = data.old_reg_no;
                    
                    if(newpatient)
                    {
                        var number = newpatient;
                    }
                    else
                    {
                        var number = oldpatient;
                    }
               
                    $('#opd_no').val(number);
                    $('#firstname').val(data.firstname);
                    $('#age').val(data.date_of_birth);
                    $('#sex').val(data.sex);
                    $('#weight').val(data.weight);
                    $('#address').val(data.address);
                    $('#create_date').val(data.create_date);
                    
                    
                    
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                $('#RX1_tab').empty();
                $('#RX2_tab').empty();
                $('#RX3_tab').empty();
                $('#RX4_tab').empty();
                $('#RX5_tab').empty();
                $('#other1').empty();
                $('#other2').empty();
                $('#other3').empty();
                alert('Medicine Not Suggested!');
            } 
        });
    });
    
    
    $('body').on('keyup change', '#tab_name1', function() {
        
        var tab_name1 = $('#tab_name1').val();
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_tab1') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name1' : tab_name1,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab1').val(data.closing_stock);
                    $('#batch_no1').val(data.batch_number);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    $('body').on('keyup change', '#tab_name2', function() {
        
        var tab_name2 = $('#tab_name2').val();
        //alert(tab_name2);
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_tab2') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name2' : tab_name2,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab2').val(data.closing_stock);
                    $('#batch_no2').val(data.batch_number);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    $('body').on('keyup change', '#tab_name3', function() {
        
        var tab_name3 = $('#tab_name3').val();
        //alert(tab_name2);
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_tab3') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name3' : tab_name3,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab3').val(data.closing_stock);
                    $('#batch_no3').val(data.batch_number);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    $('body').on('keyup change', '#tab_name4', function() {
        
        var tab_name4 = $('#tab_name4').val();
        //alert(tab_name2);
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_tab4') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name4' : tab_name4,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab4').val(data.closing_stock);
                    $('#batch_no4').val(data.batch_number);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    $('body').on('keyup change', '#tab_name5', function() {
        
        var tab_name5 = $('#tab_name5').val();
        //alert(tab_name2);
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_tab5') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name5' : tab_name5,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab5').val(data.closing_stock);
                    $('#batch_no5').val(data.batch_number);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    $('body').on('keyup change', '#tab_name6', function() {
        
        var tab_name6 = $('#tab_name6').val();
        //alert(tab_name2);
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_tab6') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name6' : tab_name6,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab6').val(data.closing_stock);
                    $('#batch_no6').val(data.batch_number);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    $('body').on('keyup change', '#tab_name7', function() {
        
        var tab_name7 = $('#tab_name7').val();
        //alert(tab_name2);
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_tab7') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name7' : tab_name7,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab7').val(data.closing_stock);
                    $('#batch_no7').val(data.batch_number);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    $('body').on('keyup change', '#tab_name8', function() {
        
        var tab_name8 = $('#tab_name8').val();
        //alert(tab_name2);
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_tab8') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name8' : tab_name8,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab8').val(data.closing_stock);
                    $('#batch_no8').val(data.batch_number);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    $('body').on('keyup change', '#tab_name9', function() {
        
        var tab_name9 = $('#tab_name9').val();
        //alert(tab_name2);
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_tab9') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name9' : tab_name9,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab9').val(data.closing_stock);
                    $('#batch_no9').val(data.batch_number);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    $('body').on('keyup change', '#tab_name10', function() {
        
        var tab_name10 = $('#tab_name10').val();
        //alert(tab_name2);
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_tab10') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name10' : tab_name10,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab10').val(data.closing_stock);
                    $('#batch_no10').val(data.batch_number);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    $('body').on('keyup change', '#tab_name11', function() {
        
        var tab_name11 = $('#tab_name11').val();
        //alert(tab_name2);
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_tab11') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name11' : tab_name11,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab11').val(data.closing_stock);
                    $('#batch_no11').val(data.batch_number);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    $('body').on('keyup change', '#tab_name12', function() {
        
        var tab_name12 = $('#tab_name12').val();
        //alert(tab_name2);
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_tab12') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name12' : tab_name12,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab12').val(data.closing_stock);
                    $('#batch_no12').val(data.batch_number);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    $('body').on('keyup change', '#tab_name13', function() {
        
        var tab_name13 = $('#tab_name13').val();
        //alert(tab_name2);
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_tab13') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name13' : tab_name13,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab13').val(data.closing_stock);
                    $('#batch_no13').val(data.batch_number);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    $('body').on('keyup change', '#tab_name14', function() {
        
        var tab_name14 = $('#tab_name14').val();
        //alert(tab_name2);
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_tab14') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name14' : tab_name14,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab14').val(data.closing_stock);
                    $('#batch_no14').val(data.batch_number);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    $('body').on('keyup change', '#tab_name15', function() {
        
        var tab_name15 = $('#tab_name15').val();
        //alert(tab_name2);
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_tab15') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name15' : tab_name15,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab15').val(data.closing_stock);
                    $('#batch_no15').val(data.batch_number);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    $('body').on('keyup change', '#tab_name16', function() {
        
        var tab_name16 = $('#tab_name16').val();
        //alert(tab_name2);
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_tab16') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name16' : tab_name16,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab16').val(data.closing_stock);
                    $('#batch_no16').val(data.batch_number);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    $('body').on('keyup change', '#tab_name17', function() {
        
        var tab_name17 = $('#tab_name17').val();
        //alert(tab_name2);
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_tab17') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name17' : tab_name17,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab17').val(data.closing_stock);
                    $('#batch_no17').val(data.batch_number);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    $('body').on('keyup change', '#tab_name18', function() {
        
        var tab_name18 = $('#tab_name18').val();
        //alert(tab_name2);
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_tab18') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name18' : tab_name18,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab18').val(data.closing_stock);
                    $('#batch_no18').val(data.batch_number);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    $('body').on('keyup change', '#tab_name19', function() {
        
        var tab_name19 = $('#tab_name19').val();
        //alert(tab_name2);
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_tab19') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name19' : tab_name19,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab19').val(data.closing_stock);
                    $('#batch_no19').val(data.batch_number);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    $('body').on('keyup change', '#tab_name20', function() {
        
        var tab_name20 = $('#tab_name20').val();
        //alert(tab_name2);
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_tab20') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name20' : tab_name20,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab20').val(data.closing_stock);
                    $('#batch_no20').val(data.batch_number);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    $('body').on('keyup change', '#tab_name21', function() {
        
        var tab_name21 = $('#tab_name21').val();
        //alert(tab_name2);
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_tab21') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name21' : tab_name21,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab21').val(data.closing_stock);
                    $('#batch_no21').val(data.batch_number);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    $('body').on('keyup change', '#tab_name22', function() {
        
        var tab_name22 = $('#tab_name22').val();
        //alert(tab_name2);
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_tab22') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name22' : tab_name22,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab22').val(data.closing_stock);
                    $('#batch_no22').val(data.batch_number);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    $('body').on('keyup change', '#tab_name23', function() {
        
        var tab_name23 = $('#tab_name23').val();
        //alert(tab_name2);
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_tab23') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name23' : tab_name23,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab23').val(data.closing_stock);
                    $('#batch_no23').val(data.batch_number);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    $('body').on('keyup change', '#tab_name24', function() {
        
        var tab_name24 = $('#tab_name24').val();
        //alert(tab_name2);
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_tab24') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name24' : tab_name24,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab24').val(data.closing_stock);
                    $('#batch_no24').val(data.batch_number);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    $('body').on('keyup change', '#tab_name25', function() {
        
        var tab_name25 = $('#tab_name25').val();
        //alert(tab_name2);
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_tab25') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name25' : tab_name25,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab25').val(data.closing_stock);
                    $('#batch_no25').val(data.batch_number);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    
    
})
   </script>
   <script>
  $( function() {
    $( "#create_date" ).datepicker();
  } );
</script>