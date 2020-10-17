/**********************************************************
                    Modal Editar Avaliação
**********************************************************/
var modal = document.querySelector(".modal-ipDetails");
var trigger = document.querySelectorAll(".btn-view");
var closeButton = document.querySelector(".close-button");

function toggleModal() {
    modal.classList.toggle("show-modal");
    var ip_id = this.id;
    $.ajax({
        url:"../includes/load_modal.php",
        method: "post",
        data:{ip_id:ip_id},
        dataType:"json",
        success:function(data){
            $('#usr_ip').val(data.usr_ip);
            $('#usr_so').val(data.usr_so);
            $('#usr_dispositivo').val(data.usr_dispositivo);
            $('#usr_navegador').val(data.usr_navegador);
            $('#usr_pais').val(data.usr_pais);
            $('#usr_pais_codigo').val(data.usr_pais_codigo);
            $('#usr_regiao').val(data.usr_regiao);
            $('#usr_cidade').val(data.usr_cidade);
            $('#usr_latitude').val(data.usr_latitude);
            $('#usr_longitude').val(data.usr_longitude);
            $('#usr_timezone').val(data.usr_timezone);
            $('#usr_isp').val(data.usr_isp);
            $('#usr_org').val(data.usr_org);
            $('#usr_as').val(data.usr_as);
            $('#usr_data').val(data.usr_data);
            $('#usr_hora').val(data.usr_hora);
            $('#usr_page').val(data.usr_page);
        }
    });
}

function windowOnClick(event) {
    if (event.target === modal) {
        toggleModal();
    }
}

for(var i=0; i< trigger.length; i++){
    trigger[i].addEventListener("click", toggleModal);
}

closeButton.addEventListener("click", toggleModal);
window.addEventListener("click", windowOnClick);