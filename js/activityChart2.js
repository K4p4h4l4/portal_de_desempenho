let user = document.getElementById('usersActivity').getContext('2d');

let users= new Chart(user, {
    type: 'line',
    data:{
        labels: ['23 Dez','24 Dez', '25 Dez', '26 Dez', '27 Dez', '28 Dez', '29 Dez'],
        datasets:[{
            label: ["Teste"],
            lineTension: 0,
            pointRadius: 5,        
            data: [88,65,77,33,49,100,100],
            borderColor: ['#fec400'],
            fill: false
        }],
    },
    options:{}
});
