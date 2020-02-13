
<script src="<?= base_url("assets/vendor/chart.js/Chart.min.js"); ?>"></script>
<script src="<?= base_url("assets/vendor/chart.js/utils.js"); ?>"></script>
<script type="text/javascript">
    function createConfig(label, data, legend){
        //console.log(legend);
        return {
                    type: 'pie',
                    data: {
                        datasets: [{
                            data: data.value,
                            backgroundColor: [
                                window.chartColors.red,
                                window.chartColors.green,
                            ],
                            label: 'Dataset 1'
                        }],
                        labels: data.label
                    },
                    options: {
                        responsive: true,
                        legend: legend,
                        title: {
                            display: true,
                            text: label,
                            fontSize: 20,
                        },
                        layout: {
                            padding: {
                                left: 0,
                                right: 0,
                                top: 0,
                                bottom: 0
                            }
                        }
                    }
                };

    }
    function createConfig2(label, data, legend){
        //console.log(legend);
        return {
                    type: 'pie',
                    data: {
                        datasets: [{
                            data: data.value,
                            backgroundColor: [
                                window.chartColors.orange,
                                window.chartColors.purple,
                            ],
                            label: 'Dataset 1'
                        }],
                        labels: data.label
                    },
                    options: {
                        responsive: true,
                        legend: legend,
                        title: {
                            display: true,
                            text: label,
                            fontSize: 20,
                        },
                        layout: {
                            padding: {
                                left: 0,
                                right: 0,
                                top: 0,
                                bottom: 0
                            }
                        }
                    }
                };

    }
</script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-xs-12" >
        <div class="panel panel-primary panel-awal">
            <div class="panel-heading">
                <h3 class="panel-title">Sentimen Smartphone</h3>
            </div>
            <div class="panel-body">
                
                <div class="row">
                <?php
                    $i=0;
                    foreach ($sentimen_chart as $key => $value):
                ?>
                    <div class="col-xs-4">
                        <div class="canvas-holder">
                            <canvas id="chart-sentimen-<?= $key; ?>"></canvas>
                        </div>
                    </div>
                    <script type="text/javascript">
                        var ext = {display: false, position:'bottom', fullWidth:false};
                        <?php 
                            if($i==0){
                                echo  "ext = {display: false, position:'bottom'};";
                            } 
                        ?>
                        //console.log(ext);
                        var data_sentimen_<?= $key; ?> = {value: [<?= $value['Negatif']; ?>, <?= $value['Positif']; ?>], label:["Negatif", "Positif"]};
                        var ctx_sentimen_<?= $key; ?> = document.getElementById('chart-sentimen-<?= $key; ?>').getContext('2d');
                        var config_chart_sentimen_<?= $key; ?> = createConfig('<?= ucfirst($key); ?>', data_sentimen_<?= $key; ?>, ext);
                        var chart = new Chart(ctx_sentimen_<?= $key; ?>, config_chart_sentimen_<?= $key; ?>);
                        //chart.canvas.parentNode.style.height = '228px';
                        //ctx_sentimen_<?= $key; ?>.height = 500;
                    </script>
                <?php
                    $i++;
                    endforeach;
                ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-6" >
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Klasifikasi Topik</h3>
            </div>
            <div class="panel-body">
                
                <div class="row">
               
                    <div class="col-xs-12">
                        <div class="canvas-holder">
                            <canvas id="chart-topik"></canvas>
                        </div>
                    </div>
                    <script type="text/javascript">
                        var ext_topik = {display: true, position:'bottom', fullWidth:false};
                       
                        var data_topik = {value: [<?= $topik_chart['Non Elektronik']; ?>, <?= $topik_chart['Elektronik']; ?>], label:["Non Elektronik", "Elektronik"]};
                        var ctx_topik = document.getElementById('chart-topik').getContext('2d');
                        var config_chart_topik = createConfig2('Topik', data_topik, ext_topik);
                        var chart_topik = new Chart(ctx_topik, config_chart_topik);
                        //chart.canvas.parentNode.style.height = '228px';
                        //ctx_sentimen_<?= $key; ?>.height = 500;
                    </script>
                 
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-4 text-center" style="padding-top:100px;">
    </div>
    <div class="col-xs-8" style="padding-top:120px;">
    </div>
</div>

<script type="text/javascript">
    var randomScalingFactor = function() {
        return Math.round(Math.random() * 100);
    };
    
    /*var randomScalingFactor = function() {
        return Math.round(Math.random() * 100);
    };

    var config = {
            type: 'pie',
            data: {
                datasets: [{
                    data: [
                        randomScalingFactor(),
                        randomScalingFactor(),
                    ],
                    backgroundColor: [
                        window.chartColors.red,
                        window.chartColors.green,
                    ],
                    label: 'Dataset 1'
                }],
                labels: [
                    'Negatif',
                    'Positif'
                ]
            },
            options: {
                responsive: true,
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Samsung '
                }
            }
    };

    window.onload = function() {
        var ctx = document.getElementById('chart-sentimen-1').getContext('2d');
        window.myPie = new Chart(ctx, config);
    };*/

    $(document).ready(function(){
        
    });
</script>
