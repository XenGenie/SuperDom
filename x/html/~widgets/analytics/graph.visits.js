function pageLoad(){
    nv.addGraph(function() {
        var chart = nv.models.lineChart()
            .margin({ top: 0, bottom: 25, left: 25, right: 0 })
            //.showLegend(false)
            .color([
                $orange, '#cf6d51'
                //'#618fb0', '#61b082'
            ]);

        chart.legend.margin({ top: 3 });

        chart.yAxis
            .showMaxMin(false)
            .tickFormat(d3.format(',.f'));

        chart.xAxis
            .showMaxMin(false)
            .tickFormat(function(d) { return d3.time.format('%b %d')(new Date(d)) });
        
            $.ajax({
                url : './analytics/index/30/.json',
                success:function(data, textStatus, jqXHR){
                    //data: return data from server
                    
                    data.data[0].area = true;
                    if(data.data){
                       d3.select('#visits-chart svg')
                        .datum(data.data)
                        .transition().duration(500)
                        .call(chart);
                    }else{
                         
                    }
                }
            });                

        PjaxApp.onResize(chart.update);

        return chart;
    });
}

pageLoad();

PjaxApp.onPageLoad(pageLoad);