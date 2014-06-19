<script>
x4.analytics = Ext.extend(Ext.Panel,{
	layout			: 'border',
	defaults	: {
		frame	: false,
		border	: false,
		paddin	: 5
	},
	initComponent	: function(){
		var store = new Ext.data.JsonStore({
	        fields:['name', 'visits', 'views'],
	        data: {$data}
	    });
  
    	// more complex with a custom look
	    var chart = new Ext.Panel({
	        region	: 'center',
	        title	: '{$HTTP_HOST} Visits and Pageviews',
	        frame	: false,
	        layout	: 'fit',
			id		: 'stats-chart',
	        items: {
	            xtype: 'columnchart',
	            store: store,
	            xField: 'name',
	            yAxis: new Ext.chart.NumericAxis({
	                displayName: 'Visits',
	                labelRenderer : Ext.util.Format.numberRenderer('0,0')
	            }),
	            tipRenderer : function(chart, record, index, series){
	                if(series.yField == 'visits'){
	                    return Ext.util.Format.number(record.data.visits, '0,0') + ' visits on ' + record.data.name;
	                }else{
	                    return Ext.util.Format.number(record.data.views, '0,0') + ' page views on ' + record.data.name;
	                }
	            },
	            chartStyle: {
	                padding: 20,
	                animationEnabled: true,
	                font: {
	                    name: 'Tahoma',
	                    color: 0x444444,
	                    size: 12
	                },
	                dataTip: {
	                    padding: 5,
	                    border: {
	                        color: 0x000000,
	                        size:2
	                    },
	                    background: {
	                        color: 0x222222,
	                        alpha: .5
	                    },
	                    font: {
	                        name: 'Tahoma',
	                        color: 0xFFFFFF,
	                        size: 14,
	                        bold: true
	                    }
	                },
	                xAxis: {
	                    color: 0x69aBc8,
	                    majorTicks: {
	                    color: 0x69aBc8, length: 4},
	                    minorTicks: {
	                        color: 0x69aBc8, length: 2},
	                        labelRotation: -25,
	                    majorGridLines: {
	                        size: 1, color: 0xeeeeee}
	                },
	                yAxis: {
	                    color: 0x69aBc8,
	                  
	                    majorTicks: {
	                    color: 0x69aBc8, length: 4},
	                    minorTicks: {
	                        color: 0x69aBc8, length: 2},
	                    majorGridLines: {
	                        size: 1, color: 0xdfe8f6}
	                },
	                     
	            },
	            series: [{
	                type: 'column',
	                displayName: 'Visits',
	                yField: 'visits',
	                style: {
	                    image:'http://bin.xtiv.net/js/ext-3.2.1/examples/chart/bar.gif',
	                    mode: 'stretch',
	                    color:0xbbbbbb
	                }
	            },{
	                type:'line',
	                displayName: 'Page Views',
	                yField: 'views',
	                style: {
	                    color: 0x000000
	                }
	            }]
	        }
	    });

		this.stats = {
			region	: 'south',
			height	: 135,
			title	: 'Totals',
			width	: 125,
			contentEl	: 'analytics-stats',
		};
	    
	    this.items = [chart,this.stats];
	    x4.analytics.superclass.initComponent.call(this);
	}
});
Ext.onReady(function(){
	Ext.chart.Chart.CHART_URL = 'http://bin.xtiv.net/js/ext-3.2.1/resources/charts.swf';
});
</script>