    /**********************************************************
    Modal editar Objectivo da semana 
    **********************************************************/
    var modal = document.querySelector(".modal-run-goal");
    var trigger = document.querySelector("#runGoal");
    var closeButton = document.querySelector(".close-button");

    function toggleModal() {
        modal.classList.toggle("show-modal");
        var runGoalIDInfo = document.getElementById('runGoalID').value;
        $.ajax({
            url:"../includes/update_data.php",
            method: "post",
            data:{runGoalIDInfo:runGoalIDInfo},
            dataType:"json",
            success:function(data){
                $('#input_RunGoal').val(data.corrida_goal);
                $('#input_curRunState').val(data.corrida_state);
            }
        });
    }

    function windowOnClick(event) {
        if (event.target === modal) {
            toggleModal();
        }
    }

    trigger.addEventListener("click", toggleModal);

    closeButton.addEventListener("click", toggleModal);
    window.addEventListener("click", windowOnClick);

    /**********************************************************
    Modal criar objetivo da semana para corrida 
    **********************************************************/
    var modal2 = document.querySelector(".modal-create-run-goal");
    var trigger2 = document.querySelector("#addRunGoal");
    var closeButton2 = document.querySelector(".close-button2");

    function toggleModal2() {
        modal2.classList.toggle("show-modal2");
    }

    function windowOnClick2(event) {
        if (event.target === modal2) {
            toggleModal2();
        }
    }

    trigger2.addEventListener("click", toggleModal2);

    closeButton2.addEventListener("click", toggleModal2);
    window.addEventListener("click", windowOnClick2);

    var create_runGoal = document.getElementById('create_runGoal');

    create_runGoal.addEventListener('click', function(){
        var create_input_RunGoal = Number(document.getElementById('create_input_RunGoal').value);
        var run_creatorID = document.getElementById('run_creatorID').value;
        $.ajax({
            url:"../includes/insert_data.php",
            method:"post",
            data:{run_creatorID:run_creatorID, create_input_RunGoal:create_input_RunGoal},
            dataType:"html",
            success:function(data){
                alert("Obejctivo criado com sucesso");
            }
        });
    });

    /*************************************************
    Actualizar o Objectivo da Semana para corrida
    **************************************************/

    var update_runGoal = document.getElementById('update_runGoal');

    update_runGoal.addEventListener('click', function(){
        var input_curRunState = Number(document.getElementById('input_curRunState').value);
        var input_RunGoal = Number(document.getElementById('input_RunGoal').value);
        var runGoalID = document.getElementById('runGoalID').value;
        
        console.log('State: '+typeof(input_curRunState)+' '+'Goal: '+typeof(input_curRunState));
        if(input_curRunState > input_RunGoal){
           alert("Meta inválida "+input_curRunState+" maior que "+ input_RunGoal);
        }else{
            $.ajax({
                url:"../includes/update_data.php",
                method:"post",
                data:{runGoalID:runGoalID, input_RunGoal:input_RunGoal, input_curRunState:input_curRunState},
                dataType:"json",
                success:function(data){

                }
            });
        }


    });



    /**********************************************************
    Modal criar objetivo da semana para exercícios 
    **********************************************************/
    var modal3 = document.querySelector(".modal-create-ex-goal");
    var trigger3 = document.querySelector("#addExGoal");
    var closeButton3 = document.querySelector(".close-button3");

    function toggleModal3() {
        modal3.classList.toggle("show-modal3");
    }

    function windowOnClick3(event) {
        if (event.target === modal3) {
            toggleModal3();
        }
    }

    trigger3.addEventListener("click", toggleModal3);

    closeButton3.addEventListener("click", toggleModal3);
    window.addEventListener("click", windowOnClick3);

    var create_exGoal = document.getElementById('create_exGoal');

    create_exGoal.addEventListener('click', function(){
        var create_input_ExGoal = Number(document.getElementById('create_input_ExGoal').value);
        var ex_creatorID = document.getElementById('ex_creatorID').value;

        $.ajax({
            url:"../includes/insert_data.php",
            method:"post",
            data:{ex_creatorID:ex_creatorID, create_input_ExGoal:create_input_ExGoal},
            dataType:"json",
            success:function(data){
                alert("Obejctivo criado com sucesso");
            }
        });
    });

    /**********************************************************
    Modal editar Objectivo da semana para exercícios
    **********************************************************/
    var modal4 = document.querySelector(".modal-ex-goal");
    var trigger4 = document.querySelector("#exGoal");
    var closeButton4 = document.querySelector(".close-button4");

    function toggleModal4() {
        modal4.classList.toggle("show-modal4");
        var exGoalIDInfo = document.getElementById('exGoalID').value;
        $.ajax({
            url:"../includes/update_data.php",
            method: "post",
            data:{exGoalIDInfo:exGoalIDInfo},
            dataType:"json",
            success:function(data){
                $('#input_ExGoal').val(data.exercicio_goal);
                $('#input_curExState').val(data.exercicio_state);
            }
        });
    }

    function windowOnClick4(event) {
        if (event.target === modal4) {
            toggleModal4();
        }
    }

    trigger4.addEventListener("click", toggleModal4);

    closeButton4.addEventListener("click", toggleModal4);
    window.addEventListener("click", windowOnClick4);

    /*************************************************
    Actualizar o Objectivo da Semana para exercicios
    **************************************************/

    var update_exGoal = document.getElementById('update_exGoal');

    update_exGoal.addEventListener('click', function(){
        var input_curExState = Number(document.getElementById('input_curExState').value);
        var input_ExGoal = Number(document.getElementById('input_ExGoal').value);
        var exGoalID = document.getElementById('exGoalID').value;

        if(input_curExState > input_ExGoal){
           alert("Meta inválida "+input_curExState+" maior que "+ input_ExGoal);
        }else{
            $.ajax({
                url:"../includes/update_data.php",
                method:"post",
                data:{exGoalID:exGoalID, input_ExGoal:input_ExGoal, input_curExState:input_curExState},
                dataType:"json",
                success:function(data){

                }
            });
        }


    });



    /**********************************************************
    Modal criar objetivo da semana para desporto
    **********************************************************/
    var modal5 = document.querySelector(".modal-create-desp-goal");
    var trigger5 = document.querySelector("#addDespGoal");
    var closeButton5 = document.querySelector(".close-button5");

    function toggleModal5() {
        modal5.classList.toggle("show-modal5");
    }

    function windowOnClick5(event) {
        if (event.target === modal5) {
            toggleModal5();
        }
    }

    trigger5.addEventListener("click", toggleModal5);

    closeButton5.addEventListener("click", toggleModal5);
    window.addEventListener("click", windowOnClick5);

    var create_despGoal = document.getElementById('create_despGoal');

    create_despGoal.addEventListener('click', function(){
        var create_input_DespGoal = Number(document.getElementById('create_input_DespGoal').value);
        var desp_creatorID = document.getElementById('desp_creatorID').value;

        $.ajax({
            url:"../includes/insert_data.php",
            method:"post",
            data:{desp_creatorID:desp_creatorID, create_input_DespGoal:create_input_DespGoal},
            dataType:"json",
            success:function(data){
                alert("Obejctivo criado com sucesso");
            }
        });
    });

    /**********************************************************
    Modal editar Objectivo da semana para Desporto
    **********************************************************/
    var modal6 = document.querySelector(".modal-desp-goal");
    var trigger6 = document.querySelector("#despGoal");
    var closeButton6 = document.querySelector(".close-button6");

    function toggleModal6() {
        modal6.classList.toggle("show-modal6");
        var despGoalIDInfo = document.getElementById('despGoalID').value;
        $.ajax({
            url:"../includes/update_data.php",
            method: "post",
            data:{despGoalIDInfo:despGoalIDInfo},
            dataType:"json",
            success:function(data){
                $('#input_DespGoal').val(data.desporto_goal);
                $('#input_curDespState').val(data.desporto_state);
            }
        });
    }

    function windowOnClick6(event) {
        if (event.target === modal6) {
            toggleModal6();
        }
    }

    trigger6.addEventListener("click", toggleModal6);

    closeButton6.addEventListener("click", toggleModal6);
    window.addEventListener("click", windowOnClick6);

    /*************************************************
    Actualizar o Objectivo da Semana para exercicios
    **************************************************/

    var update_despGoal = document.getElementById('update_despGoal');

    update_despGoal.addEventListener('click', function(){
        var input_curDespState = Number(document.getElementById('input_curDespState').value);
        var input_DespGoal = Number(document.getElementById('input_DespGoal').value);
        var despGoalID = document.getElementById('despGoalID').value;

        if(input_curDespState > input_DespGoal){
           alert("Meta inválida "+input_curDespState+" maior que "+ input_DespGoal);
        }else{
            $.ajax({
                url:"../includes/update_data.php",
                method:"post",
                data:{despGoalID:despGoalID, input_DespGoal:input_DespGoal, input_curDespState:input_curDespState},
                dataType:"json",
                success:function(data){

                }
            });
        }


    });


    /**********************************************************
    Modal criar objetivo da semana para ciclismo
    **********************************************************/
    var modal7 = document.querySelector(".modal-create-cic-goal");
    var trigger7 = document.querySelector("#addCicGoal");
    var closeButton7 = document.querySelector(".close-button7");

    function toggleModal7() {
        modal7.classList.toggle("show-modal7");
    }

    function windowOnClick7(event) {
        if (event.target === modal7) {
            toggleModal7();
        }
    }

    trigger7.addEventListener("click", toggleModal7);

    closeButton7.addEventListener("click", toggleModal7);
    window.addEventListener("click", windowOnClick7);

    var create_cicGoal = document.getElementById('create_cicGoal');

    create_cicGoal.addEventListener('click', function(){
        var create_input_CicGoal = Number(document.getElementById('create_input_CicGoal').value);
        var cic_creatorID = document.getElementById('cic_creatorID').value;

        $.ajax({
            url:"../includes/insert_data.php",
            method:"post",
            data:{cic_creatorID:cic_creatorID, create_input_CicGoal:create_input_CicGoal},
            dataType:"json",
            success:function(data){
                alert("Obejctivo criado com sucesso");
            }
        });
    });

    /**********************************************************
    Modal editar Objectivo da semana para Desporto
    **********************************************************/
    var modal8 = document.querySelector(".modal-cic-goal");
    var trigger8 = document.querySelector("#cicGoal");
    var closeButton8 = document.querySelector(".close-button8");

    function toggleModal8() {
        modal8.classList.toggle("show-modal8");
        var cicGoalIDInfo = document.getElementById('cicGoalID').value;
        $.ajax({
            url:"../includes/update_data.php",
            method: "post",
            data:{cicGoalIDInfo:cicGoalIDInfo},
            dataType:"json",
            success:function(data){
                $('#input_CicGoal').val(data.ciclismo_goal);
                $('#input_curCicState').val(data.ciclismo_state);
            }
        });
    }

    function windowOnClick8(event) {
        if (event.target === modal8) {
            toggleModal8();
        }
    }

    trigger8.addEventListener("click", toggleModal8);

    closeButton8.addEventListener("click", toggleModal8);
    window.addEventListener("click", windowOnClick8);

    /*************************************************
    Actualizar o Objectivo da Semana para ciclismo
    **************************************************/

    var update_cicGoal = document.getElementById('update_cicGoal');

    update_cicGoal.addEventListener('click', function(){
        var input_curCicState = Number(document.getElementById('input_curCicState').value);
        var input_CicGoal = Number(document.getElementById('input_CicGoal').value);
        var cicGoalID = document.getElementById('cicGoalID').value;

        if(input_curCicState > input_CicGoal){
           alert("Meta inválida "+input_curCicState+" maior que "+ input_CicGoal);
        }else{
            $.ajax({
                url:"../includes/update_data.php",
                method:"post",
                data:{cicGoalID:cicGoalID, input_CicGoal:input_CicGoal, input_curCicState:input_curCicState},
                dataType:"json",
                success:function(data){

                }
            });
        }


    });