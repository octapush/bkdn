<div id="p" class="easyui-panel" title="Dashboard" style="width:100%;height:100%;">
	<div class="easyui-layout" data-options="fit:true">
		<div data-options="region:'west'" style="width:50%;">
			<div id="p" class="easyui-panel" title="Data Customer" style="width:100%;height:450px;">
				<div id="chartDataCustomer" style="min-width: 310px; margin: 0 auto"></div>
			</div>
		</div>
		<div data-options="region:'center'">
			<div id="p" class="easyui-panel" title="Data Registration" style="width:100%;height:450px;padding:10px;">
				<div id="chartDataRegistration" style="min-width: 310px; margin: 0 auto"></div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function () {
    $('#chartDataCustomer').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Summary Data Customer, <?=date("Y")?>'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                name: 'Customer Active',
                y: <?=$loadDataCustomer->active?>
            }, {
                name: 'Customer No Active',
                y: <?=$loadDataCustomer->noactive?>
            }]
        }]
    });

    $('#chartDataRegistration').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Summary Data Customer, <?=date("Y")?>'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                name: 'Registration is Done',
                y: <?=$loadDataResgitration->done?>
            }, {
                name: 'Customer is Proses',
                y: <?=$loadDataResgitration->progress?>
            }]
        }]
    });
});
</script>
<script src="<?=base_url('public/highchart/js/highcharts.js')?>"></script>
<script src="<?=base_url('public/highchart/js/modules/exporting.js')?>"></script>