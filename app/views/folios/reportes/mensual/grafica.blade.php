
<div id="container" style="width:100%; height:400px;"></div>


@section('javascript')
{{HTML::script('/js/highcharts/highcharts.js')}}
<script type="text/javascript">
	$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Reporte total por mes'
        },
        
        xAxis: {
            categories: {{$meses}},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Pesos'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>$ {point.y:,.2f} M.N.</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true 
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Urbano',
            data: {{$urbanos}}

        }, {
            name: 'Rustico',
            data: {{$rusticos}}

        }],
        credits: {
            enabled: false
        }
    });
});
</script>
@append