var config = {};

config.title = {
  text: '',
  style: {
    color : "#434778"
  }
};
  
config.xAxis = {
    categories: [
        "One Month Return",
        "Three Month Return",
        "One Year Return",
        "Three Year Return"
    ],
    labels: {
    style: {
      color : '#434778'
    } 
  }
};

config.yAxis = {
  title: {
    text: 'Return Amount',
    style: {
      color : "#434778"
    }
  },
  gridLineColor: 'transparent',
  labels: {
    style: {
      color : '#434778'
    } 
  }
};

config.plotOptions = {
    line: {
      dataLabels: {
          enabled: true
      },   
      enableMouseTracking: true
    },
};

config.chart = {
    backgroundColor: null,
    type: 'column'
};

config.series= [{
        name: '<p style="color : #434778">My Returns</p>',
        data: [1, 1, 1, 1],
        color: "#F24258",
        dataLabels:{
            enabled : false,
        }
    },
    {
        name: '<p style="color : #434778">Benchmark - S&P 500</p>',
        data: [0.48,4.06,4.70,8.94],
        color: "rgb(66,153,210)",
        dataLabels:{
            enabled : false,
        },
        useHTML : true
    }
];

config.credits = {
    enabled: false
};
   

$('#returnPerYearMod').highcharts(config);