/*
===============================================================

Hi! Welcome to my little playground!

My name is Tobias Bogliolo. 'Open source' by default and always 'responsive',
I'm a publicist, visual designer and frontend developer based in Barcelona. 

Here you will find some of my personal experiments. Sometimes usefull,
sometimes simply for fun. You are free to use them for whatever you want 
but I would appreciate an attribution from my work. I hope you enjoy it.

===============================================================
*/
//Global:
var survey = []; //Bidimensional array: [ [1,3], [2,4] ]

var script = document.createElement("SCRIPT");
script.src = 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js';
script.type = 'text/javascript';
document.getElementsByTagName("head")[0].appendChild(script);

//Switcher function:
$(".rb-tab").click(function(){
  //Spot switcher:
  $(this).parent().find(".rb-tab").removeClass("rb-tab-active");
  $(this).addClass("rb-tab-active");
});

//Save data:
$(".trigger").click(function(){
  //Empty array:
  survey = [];
  //Push data:
  for (i=1; i<=$(".rb").length; i++) {
    var rb = "rb" + i;
    var rbValue = parseInt($("#rb-"+i).find(".rb-tab-active").attr("data-value"));
    //Bidimensional array push:
    survey.push([i, rbValue]); //Bidimensional array: [ [1,3], [2,4] ]
  };
  //Debug:
  debug();
});

$(".activar").click(function(){
    //Empty array:
  survey = [];
  //Push data:
  for (i=1; i<=$(".rb").length; i++) {
    var rb = "rb" + i;
    var rbValue = parseInt($("#rb-"+i).find(".rb-tab-active").attr("data-value"));
    //Bidimensional array push:
    survey.push([i, rbValue]); //Bidimensional array: [ [1,3], [2,4] ]
  };
  //Pontualidade e Assiduidade:
  pont_assid();
})

//Debug:
function debug(){
  var debug = "";
  var obs = document.getElementById('obs').value;
  var compt_prof = document.getElementById('compt_prof').value;
  var din_inic = document.getElementById('din_ini').value;
  var cump_tarefas = document.getElementById('cump_tarefa').value;
  var rel_hum_trab = document.getElementById('rel_hum_trab').value;
  var adpt_func = document.getElementById('adapt_func').value;
  var disc = document.getElementById('disciplina').value;
  var uso_correcto_equip = document.getElementById('uso_correct_equip').value;
  var apr_comp = document.getElementById('apr_comp').value;
  var rm = document.getElementById('rm').value;
  var ro = document.getElementById('ro').value;
  var total = 0;
    
  total += (parseInt(compt_prof)+parseInt(din_inic)+parseInt(cump_tarefas)+parseInt(rel_hum_trab)+parseInt(adpt_func)+parseInt(disc)+parseInt(uso_correcto_equip)+parseInt(apr_comp)+parseInt(rm)+parseInt(ro))/10;
    
  debug += "Nº1 = " + compt_prof + "\n" + "Nº2 = " + din_inic + "\n" +
            "Nº3 = " + cump_tarefas + "\n" + "Nº4 = " + rel_hum_trab + "\n" +
            "Nº5 = " + adpt_func + "\n" + "Nº6 = " + disc + "\n" +
            "Nº7 = " + uso_correcto_equip + "\n" + "Nº8 = " + apr_comp + "\n" +
            "Nº9 = " + rm + "\n" + "Nº10 = " + ro + "\n" + 
            "Total: " + total + "\n" + "Observacao: " + obs;
    
    // Id do funcionário a ser avaliado
    var usuario_id = document.getElementById('funcionarios').value;
   /*debug +=  " Total: " + total + "\n" + "Observacao: " + obs;*/
  alert(debug);
    
    $.ajax({
        url:'../includes/av_funcionario.php',
        method:'POST',
        data:{funcionario:usuario_id,compt_prof:compt_prof,din_inic:din_inic,cump_tarefas:cump_tarefas,rel_hum_trab:rel_hum_trab,adpt_func:adpt_func,disc:disc,uso_correcto_equip:uso_correcto_equip,apr_comp:apr_comp,rm:rm,ro:ro,total:total,obs:obs},
        success:function(data){
            if(data == 1){
               alert("Este colaborador já foi avaliado !!!"); 
            }else{
                alert("Colaborador avaliado com sucesso!!!");
            }
            
        },
        error:function(req, status, error) {
            window.alert( req + "\n" + status + "\n" + error );
        }
    });

}

//Pontualidade e Assiduidade:
function pont_assid(){
  var debug = "";
  var ass = document.getElementById('assid').value;
  var pont = document.getElementById('pont').value;
  var total = 0;
    
  debug += "Nº1 = " + ass + "\n" + "Nº2 = " + pont + "\n";
    
    
    // Id do funcionário a ser avaliado
    var usuario_id = document.getElementById('colaboradores').value;
    var faltas_injustificadas = document.getElementById('faltas_injustificadas').value;
    var faltas_justificadas = document.getElementById('faltas_justificadas').value;
   /*debug +=  " Total: " + total + "\n" + "Observacao: " + obs;*/
  alert(debug);
    
    $.ajax({
        url:'../includes/av_funcionario.php',
        method:'GET',
        data:{usuario_id:usuario_id,assiduidade:ass,pontualidade:pont,faltas_injustificadas:faltas_injustificadas,faltas_justificadas:faltas_justificadas},
        success:function(data){
            if(data == 1){
               alert("Este colaborador já foi avaliado !!!");
            }else{
                alert("Colaborador avaliado com sucesso !!!");
            }
            
        },
        error:function(req, status, error) {
            window.alert( req + "\n" + status + "\n" + error );
        }
    });

}