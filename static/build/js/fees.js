var gaugeOptions = {

        chart: {
            type: 'solidgauge',
            backgroundColor: "#3A99D8",
        },

        title: {
            text : '<p style="margin-top: 0" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="This means that blah balh balh">Your fees are higher than the majority of investors</p>',
            style : {
                color : "white",
            },
            useHTML : true
        },

        pane: {
            startAngle: -90,
            endAngle: 90,
            background: {
                backgroundColor: null,
                innerRadius: '60%',
                outerRadius: '100%',
                shape: 'arc'
            },
            size : "130%",
            center: ['50%', '88%'],
        },

        tooltip: {
            enabled: false
        },

        // the value axis
        yAxis: {
            stops: [
                [0.1, '#55BF3B'], // green
                [0.5, '#DDDF0D'], // yellow
                [0.9, '#DF5353'] // red
            ],
            lineWidth: 0,
            minorTickInterval: null,
            tickPixelInterval: 400,
            tickWidth: 0,
            labels: {
                y: 16,
                style : {
                    color : "white"
                },
                format : "{value}%"
            },
        },

        plotOptions: {
            solidgauge: {
                dataLabels: {
                    y: 5,
                    borderWidth: 0,
                    useHTML: true
                },
            }
        }
    };

    // The speed gauge
    $('#feeMod').highcharts(Highcharts.merge(gaugeOptions, {
        yAxis: {
            min: 0,
            max: 2.5,

        },

        credits: {
            enabled: false
        },

        series: [{
            name: 'Fees',
            data: [2.2],
            dataLabels: {
                format: '<div style="text-align:center; margin-bottom: 15px;"><span style="font-size:25px;color:' +
                    ('white') + '">{y}%</span><br/>' +'</div>',
                y: 0
            },
        }]

    }));