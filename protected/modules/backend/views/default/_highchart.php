<script type="text/javascript" src="<?php echo $this->vars['assetsUrl']; ?>js/jquery.min.1.7.1.js"></script>
<script type="text/javascript" src="<?php echo $this->vars['assetsUrl']; ?>js/highcharts.js"></script>
<script type="text/javascript" src="<?php echo $this->vars['assetsUrl']; ?>js/exporting.js"></script>

<script type="text/javascript">
    // On document ready, call visualize on the datatable.
    $(document).ready(function() {
        /**
         * Visualize an HTML table using Highcharts. The top (horizontal) header
         * is used for series names, and the left (vertical) header is used
         * for category names. This function is based on jQuery.
         * @param {Object} table The reference to the HTML table to visualize
         * @param {Object} options Highcharts options
         */
        Highcharts.visualize = function(table, options) {
            // the categories
            options.xAxis.categories = [];
            $('tbody th', table).each( function(i) {
                options.xAxis.categories.push(this.innerHTML);
            });

            // the data series
            options.series = [];
            $('tr', table).each( function(i) {
                var tr = this;
                $('th, td', tr).each( function(j) {
                    if (j > 0) { // skip first column
                        if (i == 0) { // get the name and init the series
                            options.series[j - 1] = {
                                name: this.innerHTML,
                                data: []
                            };
                        } else { // add values
                            options.series[j - 1].data.push(parseFloat(this.innerHTML));
                        }
                    }
                });
            });

            var chart = new Highcharts.Chart(options);
        }

        var table = document.getElementById('datatable'),
        options = {
            chart: {
                renderTo: 'container',
                defaultSeriesType: 'column'
            },
            title: {
                text: 'Data Transaksi Swift'
            },
            xAxis: {
            },
            yAxis: {
                title: {
                    text: 'Units'
                }
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.y +' '+ this.x.toLowerCase();
                }
            }
        };

        Highcharts.visualize(table, options);
    });

</script>

<table id="datatable" style="display: none;">
    <thead>
        <tr>
            <th></th>
            <th>Swift Incoming</th>
            <th>Swift Outgoing</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>Senin</th>
            <td>3</td>
            <td>4</td>
        </tr>
        <tr>
            <th>Selasa</th>
            <td>2</td>
            <td>0</td>
        </tr>
        <tr>
            <th>Rabu</th>
            <td>5</td>
            <td>11</td>
        </tr>
        <tr>
            <th>Kamis</th>
            <td>1</td>
            <td>1</td>
        </tr>
        <tr>
            <th>Jumat</th>
            <td>2</td>
            <td>4</td>
        </tr>
        <tr>
            <th>Sabtu</th>
            <td>16</td>
            <td>5</td>
        </tr>
        <tr>
            <th>Minggu</th>
            <td>13</td>
            <td>6</td>
        </tr>
    </tbody>
</table>