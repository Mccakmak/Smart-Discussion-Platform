   <?php 

        include "common.php";
        include "../connect_db/connection.php";
    ?>

    <?php
        $sql = "SELECT * FROM topic";
        $result = mysqli_query($connection, $sql);
        $topics = mysqli_fetch_all($result, MYSQLI_ASSOC);  

        $chart_name = array();
        $all_dataPoints = array();
        $chart_index = 0;
        foreach($topics as $topic)
        {
            $tpc = $topic['topic_name'];
            $sql = "SELECT * FROM trend WHERE topic_title = '$tpc' ";
            $result = mysqli_query($connection, $sql);
            $trend_topics = mysqli_fetch_all($result, MYSQLI_ASSOC);  

            $dataPoints = array();
            $index = 0;
            
            foreach($trend_topics as $trend_topic)
            {
                $dataPoints[$index++] = array("y" => $trend_topic['ema'], "label" => $trend_topic['trend_date']);
            }

            array_push($chart_name, "chartContainer". $chart_index);
            //array_push($all_dataPoints[$chart_index], $dataPoints);
            $all_dataPoints[$chart_index] = &$dataPoints;

            unset($dataPoints);
            $chart_index++;
        }

        
        
        


/*        $dataPoints2 = array(
        	array("y" => 25, "label" => "Sunday"),
        	array("y" => 15, "label" => "Monday"),
        	array("y" => 25, "label" => "Tuesday"),
        	array("y" => 5, "label" => "Wednesday"),
        	array("y" => 10, "label" => "Thursday"),
        	array("y" => 0, "label" => "Friday"),
        	array("y" => 20, "label" => "Saturday")
        );*/
     
    ?>

    <script>
    window.onload = function () {

    var charts = new Array(<?php echo $chart_index ?>);        
     <?php 
        
        for ($i=0; $i < $chart_index; $i++) 
        { ?> 
            charts[<?php echo $i ?>] = new CanvasJS.Chart("chartContainer" + <?php echo $i ?> , {
                title: {
                    text: ""
                },
                axisY: {
                    title: "EMA Score"
                },
                data: [{
                    type: "line",
                    dataPoints: <?php echo json_encode( $all_dataPoints[$i], JSON_NUMERIC_CHECK); ?>
                }]
            });
            
            charts[<?php echo $i ?>].render();
       
<?php   } ?>   

}

    </script>

    
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                            
        <!-- MAIN -->
        <div class="main">

            <!-- MAIN CONTENT -->
            <div class="main-content">

                <div class="container-fluid">
                    
                    <h3 class="page-title" style="font-weight: bold;">Topic Trend Graphs</h3>
                    <?php
                        $sql = "SELECT * FROM topic";
                        $result = mysqli_query($connection, $sql);
                        $topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        
                        $file_no = 1;
                        foreach($topics as $topic)
                        {   
                            $add_end_div = 'false';
                            $chart = $chart_name[$file_no-1];
                            if($file_no % 2 == 0)
                            {
                                $add_end_div = 'true';
                                ?>

                                <div class="row">
                            <?php }?>

                                    <div class="col-md-6">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><?php echo htmlspecialchars($topic['topic_name']); ?></h3>
                                            </div>
                                            <div class="panel-body">
                                                <div id="<?php echo $chart; ?>" style="height: 370px; width: 100%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php 
                                    if($add_end_div == 'true')
                                    {?>
                                        </div>
                                    <?php } 

                            $file_no++;
                        }
                      
                    ?>

                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT -->
        </div>
        <!-- END MAIN -->
        <div class="clearfix"></div>

    </div>
    <!-- END WRAPPER -->
    <!-- Javascript -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/scripts/klorofil-common.js"></script>
</body>

</html>
