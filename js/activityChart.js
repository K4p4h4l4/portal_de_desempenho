let userActivity = document.getElementById('usersActivity').getContext('2d');
userActivity.beginPath();
userActivity.setLineDash([5,15]);
userActivity.stroke();

let usersChart = new Chart(userActivity, {
    type: 'line',
    data:{
        labels: ['23 Dez','24 Dez', '25 Dez', '26 Dez', '27 Dez', '28 Dez', '29 Dez'],
        datasets:[{
            label: ["Activos"],
            lineTension: 0,
            pointRadius: 5,        
            data: [0,65,77,33,49,100,100],
            borderColor: ['#4c84ff'],
            boderDash: [10, 10],
            fill: false
        },{
            label: ["Inactivos"],
            lineTension: 0,
            pointRadius: 5,        
            data: [88,33,20,44,111,140,77],
            borderColor: ['#fec400'],
            fill: false
        }],
    },
    options:{
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
