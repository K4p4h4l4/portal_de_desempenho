    $.ajax({
        url:'../includes/read_data',
        method:'post',
        data:{inacom_desempenho_stats_ca:"activado"},
        dataType:'json',
        success:function(data){
            console.log(data);
            var desempenho = document.getElementById('graph').getContext('2d');
            desempenho.beginPath();
            desempenho.setLineDash([5,15]);
            desempenho.stroke();

            var desempenhoChart = new Chart(desempenho, {
                type: 'line',
                data:{
                    labels: [data[0].datas[0], data[0].datas[1], data[0].datas[2], data[0].datas[3], data[0].datas[4], data[0].datas[5], data[0].datas[6], data[0].datas[7], data[0].datas[8], data[0].datas[9], data[0].datas[10], data[0].datas[11]],
                    datasets: data
                },
                options:{
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    },tooltips:{
                        mode:'index'
                    },
                    animation:{

                        //Duration
                        duration: 2000,

                        // Animation easing to use
                        easing: 'easeInCirc'
                    }
                }
            });
        }
    });
    
    
    
    $.ajax({
        url:'../includes/read_data',
        method:'post',
        data:{project_stats_ca:"activado"},
        dataType:'json',
        success:function(data){      
            $('#inProgress_projects').html(data[0].projectos_emProgresso_stats+'.0%');
            $('#toStart_projects').html(data[0].projectos_porIniciar_stats+'.0%');
            $('#delayed_projects').html(data[0].projectos_emAtraso_stats+'.0%');
            $('#concluded_projects').html(data[0].projectos_concluidos_stats+'.0%');
            $('#stopped_projects').html(data[0].projectos_parados_stats+'.0%');

            var donutDptoProjects = document.getElementById('donutDptoProjects').getContext('2d');
            var dptoProjects = new Chart(donutDptoProjects, {
                type:'doughnut', //bar, horizontalBar, pie, line, doughnut, radar, polarArea
                data:{
                    labels:['Atrasado', 'Por iniciar', 'Concluidos', 'Em curso', 'Parado'],
                    datasets:[{
                        data:[
                            data[0].projectos_emAtraso_stats,
                            data[0].projectos_porIniciar_stats,
                            data[0].projectos_concluidos_stats,
                            data[0].projectos_emProgresso_stats,
                            data[0].projectos_parados_stats
                        ],
                        backgroundColor:[
                            '#1D4F91', 
                            '#7BCAED', 
                            '#11295D',
                            '#3EA5DE',
                            '#ABCBF4'
                        ]
                    }]
                },
                options:{
                    responsive:true,
                    title:{
                        text:data[0].projectos_dpto,
                        display:true
                    },
                    plugins:{
                        datalabels:{
                            color:'#fff',
                            anchor:'end',
                            align:'start',
                            offset:0,
                            font:{
                                weight:'bold',
                                size:'12'
                            },
                            formatter: (value) => {
                                return value + ' %';
                            }
                        }
                    }
                }
            });
        }
    });
    
    //recolha dos dados do departamento para o segundo gráfico isso na
    //área reservada para os administradores
    $.ajax({
        url:'../includes/read_data',
        method:'post',
        data:{project_stats_ca2:"activado"},
        dataType:'json',
        success:function(data){      
            $('#inProgress_projects2').html(data[0].projectos_emProgresso_stats+'.0%');
            $('#toStart_projects2').html(data[0].projectos_porIniciar_stats+'.0%');
            $('#delayed_projects2').html(data[0].projectos_emAtraso_stats+'.0%');
            $('#concluded_projects2').html(data[0].projectos_concluidos_stats+'.0%');
            $('#stopped_projects2').html(data[0].projectos_parados_stats+'.0%');

            var donutDptoProjects2 = document.getElementById('donutDptoProjects2').getContext('2d');
            var dptoProjects2 = new Chart(donutDptoProjects2, {
                type:'doughnut', //bar, horizontalBar, pie, line, doughnut, radar, polarArea
                data:{
                    labels:['Atrasado', 'Por iniciar', 'Concluidos', 'Em curso', 'Parado'],
                    datasets:[{
                        data:[
                            data[0].projectos_emAtraso_stats,
                            data[0].projectos_porIniciar_stats,
                            data[0].projectos_concluidos_stats,
                            data[0].projectos_emProgresso_stats,
                            data[0].projectos_parados_stats
                        ],
                        backgroundColor:[
                            '#1D4F91', 
                            '#7BCAED', 
                            '#11295D',
                            '#3EA5DE',
                            '#ABCBF4'
                        ]
                    }]
                },
                options:{
                    responsive:true,
                    title:{
                        text:data[0].projectos_dpto,
                        display:true
                    },
                    plugins:{
                        datalabels:{
                            color:'#fff',
                            anchor:'end',
                            align:'start',
                            offset:0,
                            font:{
                                weight:'bold',
                                size:'12'
                            },
                            formatter: (value) => {
                                return value + ' %';
                            }
                        }
                    }
                }
            });
        }
    });
    
    //Recolha estatística das tarefas de um determinado departamento isso apenas
    //para a área reservada do conselho administrativo
    $.ajax({
        url:'../includes/read_data',
        method:'post',
        data:{tasks_stats_ca:"activado"},
        dataType:'json',
        success:function(data){
            $('#tasks_inAnalysis').html(data[0].tarefas_emAnalise+'.0%');
            $('#tasks_inProgress').html(data[0].tarefas_emCurso+'.0%');
            $('#tasks_inRevision').html(data[0].tarefas_emRevisao+'.0%');
            $('#tasks_concluded').html(data[0].tarefas_concluidas+'.0%');

            var donutDptoTasks = document.getElementById('donutDptoTasks').getContext('2d');
            var dptoTasks = new Chart(donutDptoTasks, {
                type:'doughnut', //bar, horizontalBar, pie, line, doughnut, radar, polarArea
                data:{
                    labels:['Em revisão', 'Por iniciar', 'Concluidas', 'Em curso'],
                    datasets:[{
                        label:'Dispositivos',
                        data:[
                            data[0].tarefas_emRevisao,
                            data[0].tarefas_emAnalise,
                            data[0].tarefas_concluidas,
                            data[0].tarefas_emCurso
                        ],
                        backgroundColor:[
                            '#CC5803', 
                            '#FF8360', 
                            '#FFCA4B',
                            '#F1BF98'
                        ]
                    }]
                },
                options:{
                    responsive:true,
                    title:{
                        text:data[0].tarefas_dpto,
                        display:true
                    },
                    plugins:{
                        datalabels:{
                            color:'#fff',
                            anchor:'end',
                            align:'start',
                            offset:0,
                            font:{
                                weight:'bold',
                                size:'12'
                            },
                            formatter:(value) => {
                                return value + ' %';
                            }
                        }                        
                    }
                }
            });
        }
    });
    
    //Recolha estatística para o segundo gráfico das tarefas de um determinado 
    //departamento isso apenas para a área reservada do conselho administrativo
    $.ajax({
        url:'../includes/read_data',
        method:'post',
        data:{tasks_stats_ca2:"activado"},
        dataType:'json',
        success:function(data){
            $('#tasks_inAnalysis2').html(data[0].tarefas_emAnalise+'.0%');
            $('#tasks_inProgress2').html(data[0].tarefas_emCurso+'.0%');
            $('#tasks_inRevision2').html(data[0].tarefas_emRevisao+'.0%');
            $('#tasks_concluded2').html(data[0].tarefas_concluidas+'.0%');

            var donutDptoTasks2 = document.getElementById('donutDptoTasks2').getContext('2d');
            var dptoTasks2 = new Chart(donutDptoTasks2, {
                type:'doughnut', //bar, horizontalBar, pie, line, doughnut, radar, polarArea
                data:{
                    labels:['Em revisão', 'Por iniciar', 'Concluidas', 'Em curso'],
                    datasets:[{
                        label:'Dispositivos',
                        data:[
                            data[0].tarefas_emRevisao,
                            data[0].tarefas_emAnalise,
                            data[0].tarefas_concluidas,
                            data[0].tarefas_emCurso
                        ],
                        backgroundColor:[
                            '#CC5803', 
                            '#FF8360', 
                            '#FFCA4B',
                            '#F1BF98'
                        ]
                    }]
                },
                options:{
                    responsive:true,
                    title:{
                        text:data[0].tarefas_dpto,
                        display:true,
                    },
                    plugins:{
                        datalabels:{
                            color:'#fff',
                            anchor:'end',
                            align:'start',
                            offset:0,
                            font:{
                                weight:'bold',
                                size:'12'
                            },
                            formatter:(value) => {
                                return value + ' %';
                            }
                        }                        
                    }
                }
            });
        }
    });