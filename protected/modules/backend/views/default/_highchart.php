<script type="text/javascript" src="<?php echo $this->vars['assetsUrl']; ?>js/jquery.min.1.7.1.js"></script>
<script type="text/javascript" src="<?php echo $this->vars['assetsUrl']; ?>js/highcharts.js"></script>
<script type="text/javascript" src="<?php echo $this->vars['assetsUrl']; ?>js/exporting.js"></script>

<script type="text/javascript">
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                defaultSeriesType: 'column'
            },
            title: {
                text: 'Data Transaksi Swift'
            },
            xAxis: {
                categories: ['<?php echo Yii::app()->dateFormatter->format('EEEE, d MMMM yyyy', date('Y-m-d')); ?>']
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Transaksi'
                }
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.series.name +': '+ this.y + ' Transaksi';
                }
            },
            credits: {
                enabled: false
            },
            series: <?php echo $jsItems; ?>
        });
    });

</script>
