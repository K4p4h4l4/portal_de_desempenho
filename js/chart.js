let myChart = document.getElementById('myChart').getContext('2d');

let deviceChart = new Chart(myChart, {
    type:'doughnut', //bar, horizontalBar, pie, line, doughnut, radar, polarArea
    data:{
        labels:['Desktop', 'Tablets', 'Mobile'],
        datasets:[{
            label:'Dispositivos',
            data:[
                60.0,
                15.0,
                "<?php echo 25; ?>"
            ],
            backgroundColor:[
                '#007bff', 
                '#4c84ff', 
                '#13cae1'
            ]
        }]
    },
    options:{}
});