<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
            <?php echo form_open('account_manager/account/medical_rate_master') ?>
            <div class="panel-heading no-print row">
                <div class="col-md-2" style="font-size:18px; text-align:right; font-weight:bold;">Select Date</div>
                <div class="col-md-3"> 
                    <input type="text" name="create_date" class="form-control datepicker" id="create_date" placeholder="<?php echo "Date"; ?>" style="display: inline-block;">
                    <input type="hidden" name="updateFlag" id="updateFlag" class="form-control" value="<?php echo '0';?>" >
                </div>
            </div> 

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 table-responsive"> 
                        <table id="invoice" class="table table-striped"> 
                            <thead>
                                <tr class="bg-primary">
                                    <th width="4%">Sr. No</th>
                                    <th width="12%"><?php echo "Items"; ?></th>
                                    <th width="12%"><?php echo "Old Rate"; ?></th>
                                    <th width="18%"><?php echo "New Rate"; ?></th> 
                                    <th width="4%">Sr. No</th>
                                    <th width="12%"><?php echo "Items"; ?></th>
                                    <th width="12%"><?php echo "Old Rate"; ?></th>
                                    <th width="18%"><?php echo "New Rate"; ?></th>  
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th colspan="8" style="text-align:center;">OPD & IPD Charges</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>OPD Charge</td>
                                    <td></td>  
                                    <td><input type="text" name="opd_charge" id="opd_charge" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>2</td>
                                    <td>OPD Medicine Charge</td>
                                    <td></td>  
                                    <td><input type="text" name="opd_medicine_charge" id="opd_medicine_charge" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>IPD Bed Charge</td>
                                    <td></td>  
                                    <td><input type="text" name="ipd_bed_charge" id="ipd_bed_charge" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>4</td>
                                    <td>IPD Medicine Charge</td>
                                    <td></td>  
                                    <td><input type="text" name="ipd_medicine_charge" id="ipd_medicine_charge" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Nursing Charge</td>
                                    <td></td>  
                                    <td><input type="text" name="nursing_charge" id="nursing_charge" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>6</td>
                                    <td>Operative Charge-1</td>
                                    <td></td>  
                                    <td><input type="text" name="operative_charge_1" id="operative_charge_1" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>Assistant Surgeon Charge</td>
                                    <td></td>  
                                    <td><input type="text" name="assistant_surgeon_charge" id="assistant_surgeon_charge" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>8</td>
                                    <td>Anesthetic Charge</td>
                                    <td></td>  
                                    <td><input type="text" name="anesthetic_charge" id="anesthetic_charge" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td> 
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>Minor OT Charge</td>
                                    <td></td>  
                                    <td><input type="text" name="minor_ot_charge" id="minor_ot_charge" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>10</td>
                                    <td>Major OT Charge</td>
                                    <td></td>  
                                    <td><input type="text" name="major_ot_charge" id="major_ot_charge" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>IV Charges(With Medicine)</td>
                                    <td></td>  
                                    <td><input type="text" name="iv_charge_wi_medicine" id="iv_charge_wi_medicine" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>12</td>
                                    <td>Dressing Charge</td>
                                    <td></td>  
                                    <td><input type="text" name="dressing_charge" id="dressing_charge" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    
                                </tr>
                                <tr>
                                    <td>13</td>
                                    <td>Blood Transfusion Charge</td>
                                    <td></td>  
                                    <td><input type="text" name="blood_trans_charge" id="blood_trans_charge" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>14</td>
                                    <td>BMW Charge</td>
                                    <td></td>  
                                    <td><input type="text" name="bmw_charge" id="bmw_charge" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>15</td>
                                    <td>Documentation Charge</td>
                                    <td></td>  
                                    <td><input type="text" name="documentation_charge" id="documentation_charge" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th colspan="8" style="text-align:center;">Panchkarma Charges For OPD & IPD</th>
                                </tr>
                                <tr>
                                    <td>16</td>
                                    <td>Snehan+Swedan=Sthanik</td>
                                    <td></td>  
                                    <td><input type="text" name="sthanik_snehan_swedan" id="sthanik_snehan_swedan" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>17</td>
                                    <td>Snehan+Swedan=Sarwang</td>
                                    <td></td>  
                                    <td><input type="text" name="sarwang_snehan_swedan" id="sarwang_snehan_swedan" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>18</td>
                                    <td>Shirodhara</td>
                                    <td></td>  
                                    <td><input type="text" name="shirodhara" id="shirodhara" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>19</td>
                                    <td>Nasya</td>
                                    <td></td>  
                                    <td><input type="text" name="nasya" id="nasya" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>20</td>
                                    <td>Virachan With Snehan Swedan</td>
                                    <td></td>  
                                    <td><input type="text" name="virachan_wi_snehan_swedan" id="virachan_wi_snehan_swedan" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>21</td>
                                    <td>Virachan Without Snehan Swedan</td>
                                    <td></td>  
                                    <td><input type="text" name="virachan_wo_snehan_swedan" id="virachan_wo_snehan_swedan" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>22</td>
                                    <td>Janubasti</td>
                                    <td></td>  
                                    <td><input type="text" name="janubasti" id="janubasti" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>23</td>
                                    <td>Manyabasti/prushtabasti/Katibasti</td>
                                    <td></td>  
                                    <td><input type="text" name="manya_prushtha_kati_basti" id="manya_prushtha_kati_basti" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>24</td>
                                    <td>Hrudaybasti/hrudaydhara</td>
                                    <td></td>  
                                    <td><input type="text" name="hrudaydhara_hrudaybasti" id="hrudaydhara_hrudaybasti" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>25</td>
                                    <td>Netra Tarpan</td>
                                    <td></td>  
                                    <td><input type="text" name="netratarpan" id="netratarpan" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>26</td>
                                    <td>Raktamokshan Siraved</td>
                                    <td></td>  
                                    <td><input type="text" name="raktamokshan_siraved" id="raktamokshan_siraved" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>27</td>
                                    <td>Raktamokshan Jalokavachan</td>
                                    <td></td>  
                                    <td><input type="text" name="raktamokshan_jalokavachan" id="raktamokshan_jalokavachan" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>28</td>
                                    <td>Vaman</td>
                                    <td></td>  
                                    <td><input type="text" name="vaman" id="vaman" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>29</td>
                                    <td>Shirobasti</td>
                                    <td></td>  
                                    <td><input type="text" name="shirobasti" id="shirobasti" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>30</td>
                                    <td>Yonidhvan</td>
                                    <td></td>  
                                    <td><input type="text" name="yonidhvan" id="yonidhvan" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>31</td>
                                    <td>Udavartan</td>
                                    <td></td>  
                                    <td><input type="text" name="udavartan" id="udavartan" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <th colspan="8" style="text-align:center;">Path Test Charges For OPD & IPD</th>
                                </tr>
                                <tr>
                                    <td>32</td>
                                    <td>Urine Routine</td>
                                    <td></td>  
                                    <td><input type="text" name="urine_routine" id="urine_routine" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>33</td>
                                    <td>Pregnancy Test</td>
                                    <td></td>  
                                    <td><input type="text" name="pregnancy_test" id="pregnancy_test" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>34</td>
                                    <td>C.B.C</td>
                                    <td></td>  
                                    <td><input type="text" name="cbc" id="cbc" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>35</td>
                                    <td>M.P. Card</td>
                                    <td></td>  
                                    <td><input type="text" name="mp_card" id="mp_card" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>36</td>
                                    <td>Blood Group</td>
                                    <td></td>  
                                    <td><input type="text" name="blood_group" id="blood_group" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>37</td>
                                    <td>B.T/C.T. Test</td>
                                    <td></td>  
                                    <td><input type="text" name="bt_ct_test" id="bt_ct_test" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>38</td>
                                    <td>B.S.L.-R</td>
                                    <td></td>  
                                    <td><input type="text" name="bsl_r" id="bsl_r" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>39</td>
                                    <td>B.S.L. F/PP</td>
                                    <td></td>  
                                    <td><input type="text" name="bsl_f_pp" id="bsl_f_pp" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>40</td>
                                    <td>Blood Urea</td>
                                    <td></td>  
                                    <td><input type="text" name="blood_urea" id="blood_urea" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>41</td>
                                    <td>Sr. Creatinine</td>
                                    <td></td>  
                                    <td><input type="text" name="sr_creatinine" id="sr_creatinine" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>42</td>
                                    <td>Cholesetrol</td>
                                    <td></td>  
                                    <td><input type="text" name="cholesetrol" id="cholesetrol" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>43</td>
                                    <td>Sr. Uric Acid</td>
                                    <td></td>  
                                    <td><input type="text" name="sr_uric_acid" id="sr_uric_acid" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>44</td>
                                    <td>Protein</td>
                                    <td></td>  
                                    <td><input type="text" name="protein" id="protein" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>45</td>
                                    <td>Albumine</td>
                                    <td></td>  
                                    <td><input type="text" name="albumine" id="albumine" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>46</td>
                                    <td>Sr. SGPT</td>
                                    <td></td>  
                                    <td><input type="text" name="sr_sgpt" id="sr_sgpt" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>47</td>
                                    <td>Sr. SGOT</td>
                                    <td></td>  
                                    <td><input type="text" name="sr_sgot" id="sr_sgot" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>48</td>
                                    <td>Alk. Phosphate</td>
                                    <td></td>  
                                    <td><input type="text" name="alk_phosphate" id="alk_phosphate" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>49</td>
                                    <td>Acid Phosphate</td>
                                    <td></td>  
                                    <td><input type="text" name="acid_phosphate" id="acid_phosphate" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>50</td>
                                    <td>Triglyseride</td>
                                    <td></td>  
                                    <td><input type="text" name="triglyseride" id="triglyseride" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>51</td>
                                    <td>Sr. Calcium</td>
                                    <td></td>  
                                    <td><input type="text" name="sr_calcium" id="sr_calcium" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>52</td>
                                    <td>Phosphate</td>
                                    <td></td>  
                                    <td><input type="text" name="phosphate" id="phosphate" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>53</td>
                                    <td>Lipid Profile</td>
                                    <td></td>  
                                    <td><input type="text" name="lipid_profile" id="lipid_profile" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>54</td>
                                    <td>Sr. Bilirubin</td>
                                    <td></td>  
                                    <td><input type="text" name="sr_bilirubin" id="sr_bilirubin" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>55</td>
                                    <td>Widal Test</td>
                                    <td></td>  
                                    <td><input type="text" name="widal_test" id="widal_test" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>56</td>
                                    <td>V.D.R.L Test</td>
                                    <td></td>  
                                    <td><input type="text" name="vdrl_test" id="vdrl_test" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>57</td>
                                    <td>RA Test</td>
                                    <td></td>  
                                    <td><input type="text" name="ra_test" id="ra_test" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>58</td>
                                    <td>C.R.P Test</td>
                                    <td></td>  
                                    <td><input type="text" name="crp_test" id="crp_test" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>59</td>
                                    <td>HBSAG Test</td>
                                    <td></td>  
                                    <td><input type="text" name="hbsag_test" id="hbsag_test" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>60</td>
                                    <td>HIV Test</td>
                                    <td></td>  
                                    <td><input type="text" name="hiv_test" id="hiv_test" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>61</td>
                                    <td>Prothrombin Time ESR</td>
                                    <td></td>  
                                    <td><input type="text" name="prothrombin_time_esr" id="prothrombin_time_esr" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>62</td>
                                    <td>T3, T4, TSH</td>
                                    <td></td>  
                                    <td><input type="text" name="t3_t4_tsh" id="t3_t4_tsh" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>63</td>
                                    <td>L.F.T. Test</td>
                                    <td></td>  
                                    <td><input type="text" name="lft_test" id="lft_test" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                </tr>
                                <tr>
                                    <td>64</td>
                                    <td>R.F.T. Test</td>
                                    <td></td>  
                                    <td><input type="text" name="rft_test" id="rft_test" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>65</td>
                                    <td>Sr. Prolactin Test</td>
                                    <td></td>  
                                    <td><input type="text" name="prolactin" id="prolactin" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>
                                </tr>
                                <tr>
                                    <td>66</td>
                                    <td>X-RAY Test</td>
                                    <td></td>  
                                    <td><input type="text" name="x_ray_test" id="x_ray_test" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td>67</td>
                                    <td>ECG Test</td>
                                    <td></td>  
                                    <td><input type="text" name="ecg_test" id="ecg_test" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>
                                </tr>
                                <tr>
                                    <td>68</td>
                                    <td>USG Test</td>
                                    <td></td>  
                                    <td><input type="text" name="usg_test" id="usg_test" required autocomplete="off" class="totalCal form-control" placeholder="Rate" value="<?php echo '0';?>" ></td>  
                                    <td></td>
                                    <td></td>
                                    <td></td>  
                                    <td></td>
                                </tr>
                            </tbody>
                            <tfoot> 
                                <tr>  
                                    <td colspan="3"></td>  
                                    <td colspan="2"><button class="btn btn-success btn-block"><?php echo display('save') ?></button></td>  
                                    <td colspan="3"></td>
                                </tr>
                            </tfoot>
                        </table>  
                    </div>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
<script>
    $('#create_date').on('change keyup', function(){
        //console.log($('#create_date').val());
        var create_date = $('#create_date').val();
        $.ajax({
            url  : '<?= base_url('account_manager/account/getBillMasterDataDateWise') ?>',
            type : 'post',
            dataType : 'JSON',
            data : {
                '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                create_date : create_date,
            },
            success : function(data)
            {
                //console.log(data);
                if(data){
                    $('#updateFlag').val('1');
                    $('#opd_charge').val(data.opd_charge);
                    $('#opd_medicine_charge').val(data.opd_medicine_charge);
                    $('#ipd_bed_charge').val(data.ipd_bed_charge);
                    $('#ipd_medicine_charge').val(data.ipd_medicine_charge);
                    $('#nursing_charge').val(data.nursing_charge);
                    $('#operative_charge_1').val(data.operative_charge_1);
                    $('#assistant_surgeon_charge').val(data.assistant_surgeon_charge);
                    $('#anesthetic_charge').val(data.anesthetic_charge);
                    $('#iv_charge_wi_medicine').val(data.iv_charge_wi_medicine);
                    $('#minor_ot_charge').val(data.minor_ot_charge);
                    $('#major_ot_charge').val(data.major_ot_charge);
                    $('#blood_trans_charge').val(data.blood_trans_charge);
                    $('#dressing_charge').val(data.dressing_charge);
                    $('#documentation_charge').val(data.documentation_charge);
                    $('#bmw_charge').val(data.bmw_charge);
                    $('#sthanik_snehan_swedan').val(data.sthanik_snehan_swedan);
                    $('#sarwang_snehan_swedan').val(data.sarwang_snehan_swedan);
                    $('#shirodhara').val(data.shirodhara);
                    $('#nasya').val(data.nasya);
                    $('#virachan_wi_snehan_swedan').val(data.virachan_wi_snehan_swedan);
                    $('#virachan_wo_snehan_swedan').val(data.virachan_wo_snehan_swedan);
                    $('#janubasti').val(data.janubasti);
                    $('#manya_prushtha_kati_basti').val(data.manya_prushtha_kati_basti);
                    $('#hrudaydhara_hrudaybasti').val(data.hrudaydhara_hrudaybasti);
                    $('#netratarpan').val(data.netratarpan);
                    $('#raktamokshan_siraved').val(data.raktamokshan_siraved);
                    $('#raktamokshan_jalokavachan').val(data.raktamokshan_jalokavachan);
                    $('#vaman').val(data.vaman);
                    $('#shirobasti').val(data.shirobasti);
                    $('#yonidhvan').val(data.yonidhvan);
                    $('#udavartan').val(data.udavartan);
                    $('#urine_routine').val(data.urine_routine);
                    $('#pregnancy_test').val(data.pregnancy_test);
                    $('#cbc').val(data.cbc);
                    $('#mp_card').val(data.mp_card);
                    $('#blood_group').val(data.blood_group);
                    $('#bt_ct_test').val(data.bt_ct_test);
                    $('#bsl_r').val(data.bsl_r);
                    $('#bsl_f_pp').val(data.bsl_f_pp);
                    $('#blood_urea').val(data.blood_urea);
                    $('#sr_creatinine').val(data.sr_creatinine);
                    $('#cholesetrol').val(data.cholesetrol);
                    $('#sr_uric_acid').val(data.sr_uric_acid);
                    $('#protein').val(data.protein);
                    $('#albumine').val(data.albumine);
                    $('#sr_sgpt').val(data.sr_sgpt);
                    $('#sr_sgot').val(data.sr_sgot);
                    $('#alk_phosphate').val(data.alk_phosphate);
                    $('#acid_phosphate').val(data.acid_phosphate);
                    $('#triglyseride').val(data.triglyseride);
                    $('#sr_calcium').val(data.sr_calcium);
                    $('#phosphate').val(data.phosphate);
                    $('#lipid_profile').val(data.lipid_profile);
                    $('#sr_bilirubin').val(data.sr_bilirubin);
                    $('#widal_test').val(data.widal_test);
                    $('#vdrl_test').val(data.vdrl_test);
                    $('#ra_test').val(data.ra_test);
                    $('#crp_test').val(data.crp_test);
                    $('#hbsag_test').val(data.hbsag_test);
                    $('#hiv_test').val(data.hiv_test);
                    $('#prothrombin_time_esr').val(data.prothrombin_time_esr);
                    $('#t3_t4_tsh').val(data.t3_t4_tsh);
                    $('#prolactin').val(data.prolactin);
                    $('#lft_test').val(data.lft_test);
                    $('#rft_test').val(data.rft_test);
                    $('#x_ray_test').val(data.x_ray_test);
                    $('#ecg_test').val(data.ecg_test);
                    $('#usg_test').val(data.usg_test);
                }else{
                    $('#updateFlag').val('0');
                    $('#opd_charge').val('0');
                    $('#opd_medicine_charge').val('0');
                    $('#ipd_bed_charge').val('0');
                    $('#ipd_medicine_charge').val('0');
                    $('#nursing_charge').val('0');
                    $('#operative_charge_1').val('0');
                    $('#assistant_surgeon_charge').val('0');
                    $('#anesthetic_charge').val('0');
                    $('#iv_charge_wi_medicine').val('0');
                    $('#minor_ot_charge').val('0');
                    $('#major_ot_charge').val('0');
                    $('#blood_trans_charge').val('0');
                    $('#dressing_charge').val('0');
                    $('#documentation_charge').val('0');
                    $('#bmw_charge').val('0');
                    $('#sthanik_snehan_swedan').val('0');
                    $('#sarwang_snehan_swedan').val('0');
                    $('#shirodhara').val('0');
                    $('#nasya').val('0');
                    $('#virachan_wi_snehan_swedan').val('0');
                    $('#virachan_wo_snehan_swedan').val('0');
                    $('#janubasti').val('0');
                    $('#manya_prushtha_kati_basti').val('0');
                    $('#hrudaydhara_hrudaybasti').val('0');
                    $('#netratarpan').val('0');
                    $('#raktamokshan_siraved').val('0');
                    $('#raktamokshan_jalokavachan').val('0');
                    $('#vaman').val('0');
                    $('#shirobasti').val('0');
                    $('#yonidhvan').val('0');
                    $('#udavartan').val('0');
                    $('#urine_routine').val('0');
                    $('#pregnancy_test').val('0');
                    $('#cbc').val('0');
                    $('#mp_card').val('0');
                    $('#blood_group').val('0');
                    $('#bt_ct_test').val('0');
                    $('#bsl_r').val('0');
                    $('#bsl_f_pp').val('0');
                    $('#blood_urea').val('0');
                    $('#sr_creatinine').val('0');
                    $('#cholesetrol').val('0');
                    $('#sr_uric_acid').val('0');
                    $('#protein').val('0');
                    $('#albumine').val('0');
                    $('#sr_sgpt').val('0');
                    $('#sr_sgot').val('0');
                    $('#alk_phosphate').val('0');
                    $('#acid_phosphate').val('0');
                    $('#triglyseride').val('0');
                    $('#sr_calcium').val('0');
                    $('#phosphate').val('0');
                    $('#lipid_profile').val('0');
                    $('#sr_bilirubin').val('0');
                    $('#widal_test').val('0');
                    $('#vdrl_test').val('0');
                    $('#ra_test').val('0');
                    $('#crp_test').val('0');
                    $('#hbsag_test').val('0');
                    $('#hiv_test').val('0');
                    $('#prothrombin_time_esr').val('0');
                    $('#t3_t4_tsh').val('0');
                    $('#prolactin').val('0');
                    $('#lft_test').val('0');
                    $('#rft_test').val('0');
                    $('#x_ray_test').val('0');
                    $('#ecg_test').val('0');
                    $('#usg_test').val('0');
                }
            }, 
            error : function()
            {
                //alert('failed');
            }
        });
        
    });
</script>