   $.ajax({
        url:'../includes/read_data',
        method:'post',
        data:{inacom_desempenho_stats:"activado"},
        dataType:'json',
        success:function(data){
            console.log(data);
            var desempenho = document.getElementById('graph').getContext('2d');
            desempenho.beginPath();
            desempenho.setLineDash([5,15]);
            desempenho.stroke();//#1261ff  verde 20BF55 laranja FB8B24

            var desempenhoChart = new Chart(desempenho, {
                type: 'line',
                data:{
                    labels: [data[0].inacom_data, data[1].inacom_data, data[2].inacom_data, data[3].inacom_data, data[4].inacom_data, data[5].inacom_data, data[6].inacom_data, data[7].inacom_data, data[8].inacom_data, data[9].inacom_data, data[10].inacom_data, data[11].inacom_data],
                    datasets:[{
                        label: ["INACOM"],
                        lineTension: 0,
                        pointRadius: 5,        
                        data: [data[0].inacom_media, data[1].inacom_media, data[2].inacom_media, data[3].inacom_media, data[4].inacom_media, data[5].inacom_media, data[6].inacom_media, data[7].inacom_media, data[8].inacom_media, data[9].inacom_media, data[10].inacom_media, data[11].inacom_media],
                        borderColor: ['#002060'],
                        boderDash: [10, 10],
                        backgroundColor:'#002060',
                        hoverBackgroundColor:'#002060',
                        fill: false
                    },{
                        label: ["Departamento"],
                        lineTension: 0,
                        pointRadius: 5,        
                        data: [data[12].dpto_media, data[13].dpto_media, data[14].dpto_media, data[15].dpto_media, data[16].dpto_media, data[17].dpto_media, data[18].dpto_media, data[19].dpto_media, data[20].dpto_media, data[21].dpto_media, data[22].dpto_media, data[23].dpto_media],
                        borderColor: ['#34a853'],
                        backgroundColor:'#34a853',
                        hoverBackgroundColor:'#34a853',
                        fill: false
                    },{
                        label: ["Eu"],
                        lineTension: 0,
                        pointRadius: 5,        
                        data: [data[24].usuario_media, data[25].usuario_media, data[26].usuario_media, data[27].usuario_media, data[28].usuario_media, data[29].usuario_media, data[30].usuario_media, data[31].usuario_media, data[32].usuario_media, data[33].usuario_media, data[34].usuario_media, data[35].usuario_media],
                        borderColor: ['#FB8B24'],
                        backgroundColor:'#FB8B24',
                        hoverBackgroundColor:'#FB8B24',
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
        data:{project_stats:"activado"},
        dataType:'json',
        success:function(data){      
            $('#inProgress_projects').html(data[0].projectos_emProgresso_stats+'.0%');
            $('#toStart_projects').html(data[0].projectos_porIniciar_stats+'.0%');
            $('#delayed_projects').html(data[0].projectos_emAtraso_stats+'.0%');
            $('#concluded_projects').html(data[0].projectos_concluidos_stats+'.0%');
            $('#stopped_projects').html(data[0].projectos_parados_stats+'.0%');
            $('#myInProgress_projects').html(data[0].meusProjectos_emProgresso_stats+'.0%');
            $('#myToStart_projects').html(data[0].meusProjectos_porIniciar_stats+'.0%');
            $('#myDelayed_projects').html(data[0].meusProjectos_emAtraso_stats+'.0%');
            $('#myConcluded_projects').html(data[0].meusProjectos_concluidos_stats+'.0%');
            $('#myStopped_projects').html(data[0].meusProjectos_parados_stats+'.0%');

            var donutDptoProjects = document.getElementById('donutDptoProjects').getContext('2d');
            var dptoProjects = new Chart(donutDptoProjects, {
                type:'doughnut', //bar, horizontalBar, pie, line, doughnut, radar, polarArea
                data:{
                    labels:['Atrasado', 'Por iniciar', 'Concluidos', 'Em curso', 'Parado'],
                    datasets:[{
                        label:'Dispositivos',
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

            var donutMyProjects = document.getElementById('donutMyProjects').getContext('2d');
            var myProjects = new Chart(donutMyProjects, {
                type:'doughnut', //bar, horizontalBar, pie, line, doughnut, radar, polarArea
                data:{
                    labels:['Atrasado', 'Por iniciar', 'Concluidos', 'Em curso', 'Parado'],
                    datasets:[{
                        label:'Dispositivos',
                        data:[
                            data[0].meusProjectos_emAtraso_stats,
                            data[0].meusProjectos_porIniciar_stats,
                            data[0].meusProjectos_concluidos_stats,
                            data[0].meusProjectos_emProgresso_stats,
                            data[0].meusProjectos_parados_stats
                        ],
                        backgroundColor:[
                            '#F03812', 
                            '#FEB914', 
                            '#B21236',
                            '#FE8826',
                            '#FBBA72'
                        ]
                    }]
                },
                options:{
                    responsive:true,
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

    $.ajax({
        url:'../includes/read_data',
        method:'post',
        data:{tasks_stats:"activado"},
        dataType:'json',
        success:function(data){
            $('#tasks_inAnalysis').html(data[0].tarefas_emAnalise+'.0%');
            $('#tasks_inProgress').html(data[0].tarefas_emCurso+'.0%');
            $('#tasks_inRevision').html(data[0].tarefas_emRevisao+'.0%');
            $('#tasks_concluded').html(data[0].tarefas_concluidas+'.0%');
            $('#myTasks_inAnalysis').html(data[0].minhasTarefas_emAnalise+'.0%');
            $('#myTasks_inProgress').html(data[0].minhasTarefas_emCurso+'.0%');
            $('#myTasks_inRevision').html(data[0].minhasTarefas_emRevisao+'.0%');
            $('#myTasks_concluded').html(data[0].minhasTarefas_concluidas+'.0%');

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

            var donutMyTasks = document.getElementById('donutMyTasks').getContext('2d');
            var myTasks = new Chart(donutMyTasks, {
                type:'doughnut', //bar, horizontalBar, pie, line, doughnut, radar, polarArea
                data:{
                    labels:['Em revisão', 'Por iniciar', 'Concluidas', 'Em curso'],
                    datasets:[{
                        label:'Dispositivos',
                        data:[
                            data[0].minhasTarefas_emRevisao,
                            data[0].minhasTarefas_emAnalise,
                            data[0].minhasTarefas_concluidas,
                            data[0].minhasTarefas_emCurso
                        ],
                        backgroundColor:[
                            '#748CAB', 
                            '#6B6D76', 
                            '#0D1321',
                            '#224870'
                        ]
                    }]
                },
                options:{
                    responsive:true,
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