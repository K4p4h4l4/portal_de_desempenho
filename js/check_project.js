    function check_project(){
        $.ajax({
            url:"../includes/update_data",
            method:"POST",
            data:{check:'chegou'},
            dataType:"text",
            success:function(data){
                
            }
        });
    }
    
    function check_task(){
        $.ajax({
            url:"../includes/update_data",
            method:"post",
            data:{check_task:'activo'},
            dataType:"text",
            success:function(data){
                
            }
        });
    }
    
    check_project();