var reportGenerator = document.getElementById('reportGenerator');

reportGenerator.addEventListener('click', function(){
    let reportDpto = document.getElementById('reportDpto').value;
    let reportType = document.getElementById('reportType').value;
    let reportTime = document.getElementById('reportTime').value;
    let msg = '';
    
    if(reportDpto==='S' || reportType==='S' || reportTime==='S'){
       alert('Verifique se todos os campos foram seleccionados!');
    }else{
        if(reportType ==='tarefas'){
            window.open('http://localhost/portal_de_desempenho/ca/ca_relatorio?reportDpto='+reportDpto+'&reportType='+reportType+'&reportTime='+reportTime , '_blank');
            
            /*$.ajax({
                url:'localhost/portal_de_desempenho/ca/ca_relatorio',
                method:'post',
                data:{reportDpto:reportDpto, reportType:reportType},
                success:function(data){
                    window.open('http://localhost/portal_de_desempenho/ca/ca_relatorio.php?teste=teste' , '_blank');
                }
            })*/
        }
    }
    
});