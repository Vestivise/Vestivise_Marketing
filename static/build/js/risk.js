
    
// The speed gauge
$('#riskMod').highcharts({

    chart: {
            renderTo: 'riskMod',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false,
            backgroundColor: "#9C27B0",
        },
        title: {
            text: 'Your risk is characterized as moderate.',
            align: 'center',
            style: {
                color : 'white'
            },
        },
        tooltip: {
            enabled : false            
        },
        pane: {
            center: ['50%', '88%'],
            startAngle: -90,
            endAngle: 90,
            background: {
                borderWidth: 0,
                backgroundColor: 'none',
                innerRadius: '60%',
                outerRadius: '100%',
                shape: 'arc'
            }
        },
        yAxis: [{
            lineWidth: 0,
            min: 0,
            max: 90,
            minorTickLength: 0,
            tickLength: 0,
            tickWidth: 0,
            labels: {
                enabled: false
            },
            title: {
                text: '', //'<div class="gaugeFooter">46% Rate</div>',
                useHTML: true,
                y: 80
            },
            pane: 0,

        }],
        credits: {
            enabled: false
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: true,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white',
                        textShadow: '0px 1px 2px black'
                    }
                },
                startAngle: -90,
                endAngle: 90,
                center: ['50%', '95%'],
                size: "140%"
            },
            gauge: {
                dataLabels: {
                    enabled: false
                },
                dial: {
                    radius: '100%'
                },
            }
        },

        series: [{
            type: 'pie',
            name: 'Risk',
            data: [
                {
                    name: 'Safe',
                    y : 33,
                    color: "#2cc36b"
                },
                {
                    name: 'Moderate',
                    y : 33,
                    color: "#f1c40f"
                },
                {
                    name: 'Risky',
                    y : 33,
                    color: "#c0392b"
                },
            ]
        },{
            type: 'gauge',
            data: [40],
            dial: {
                rearLength: 0,
                baseWidth : 1
            }
        }],
    });    