<div class="row">



    <div class="col-sm-12" id="PrintMe">



        <div  class="panel panel-default thumbnail">

 

            <div class="panel-heading no-print">

                <div class="btn-group"> 
                    <h4>Laboratory Count</h4>
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 

                </div>

            </div> 



            <div class="panel-body">

                    <div class="col-md-12 col-lg-12 "> 

                        <table class="table">
                            <thead>
                                <th>Month</th>
                                <th>Patient</th>
                                <th>Hemato</th>
                                <th>Bichem</th>
                                <th>Serio</th>
                                <th>Urine</th>
                                <th>Stool</th>
                                <!-- <th>Total</th> -->
                            </thead>
                            <tbody>
                                <?php $j = 0; foreach($monthcounts as $month) {    ?>
                                <tr>                                
                                    <td><?php echo $month->month; ?></td>
                                    <td><?php echo $month->patient; ?></td>
                                    <td><?php echo $haemogram[$j]->haemogram ?></td>
                                    <td><?php echo $biochemicaltest2[$j]->biochemicaltest2 ?></td>
                                    <td><?php echo $seological[$j]->seological ?></td>
                                    <td><?php echo $urinexamination2counts[$j]->urinexam ?></td>
                                    <td><?php echo $stool[$j]->stool ?></td>
                                    <!-- <td class="sum"></td> -->
                                </tr>
                                <?php $j++; } ?>
                            </tbody>
                                <tr class="sum">
                                    <td class="sum">Total</td>
                                    <?php $i = 0; foreach($totalsum as $total){ ?>
                                        <td><?php echo $total->haemogram; ?></td>                                        
                                    <?php } ?>
                                </tr>    
                        </table>
                    </div>
                </div>
            </div> 

        </div>

    </div>

<script>

$(document).ready(function(table, columnIndex) {
    var tot = 0;
    table.find("tr").children("td:nth-child(" + columnIndex + ")")
    .each(function() {
        $this = $(this);
        if (!$this.hasClass("sum") && $this.html() != "") {
            tot += parseInt($this.html());
        }
    });
    return tot;
})

$(document).ready(function() {
    $("tr.sum").each(function(i, tr) {
        $tr = $(tr);
        $tr.children().each(function(i, td) {
            $td = $(td);
            var table = $td.parent().parent().parent();
            if ($td.hasClass("sum")) {
                $td.html(sumOfColumns(table, i+1));
            }
        })
    });
}

</script>
 

</div>
