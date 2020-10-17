/**********************************
*Modal para adicionar notícias    *
**********************************/
let btn_opendAdd_noticiaModal = document.getElementById('openAddNoticiasModal');
let modal_addNoticia = document.querySelector('.modal-add-noticia');
let btn_closeAdd_noticiaModal = document.querySelector('.close-addNoticia');

function openAdd_noticiaModal(){
    modal_addNoticia.classList.toggle("show-modal");
}

function windowsOnClick(event){
    if(event.target === modal_addNoticia){
        openAdd_noticiaModal();
    }
    
    if(event.target === modal_editNoticia){
        openEdit_noticiaModal();
    }
    
    if(event.target === modal_viewNoticia){
        openView_noticiaModal();
    }
    
    if(event.target === modal_delete_noticia){
        openDelete_noticiaModal();
    }
}

btn_opendAdd_noticiaModal.addEventListener('click', openAdd_noticiaModal);
btn_closeAdd_noticiaModal.addEventListener('click', openAdd_noticiaModal);
window.addEventListener("click", windowsOnClick);


/****************************
*Modal para editar a notícia*
****************************/
let btn_editNoticia = document.querySelectorAll('.btn-edit-noticia');
let modal_editNoticia = document.querySelector('.modal-edit-noticia');
let close_editNoticia = document.querySelector('.close-editNoticia');

function openEdit_noticiaModal(){
    modal_editNoticia.classList.toggle("show-modal-edit");
    let noticia_id = this.id;
    
    $.ajax({
        url: "../includes/load_modal.php",
        method:"post",
        data:{noticia_id:noticia_id},
        dataType:"json",
        success:function(data){
            $("#noticiaTituloEdit").val(data.noticia_titulo);
            $("#noticia_id").val(data.noticia_id);
            CKEDITOR.instances.noticia__contextEdit.setData(data.noticia_contexto, function(){
                this.checkDirty();
            });
        }
    });
}

for(let i=0; i<btn_editNoticia.length; i++){
    btn_editNoticia[i].addEventListener('click',openEdit_noticiaModal);
}

close_editNoticia.addEventListener('click', openEdit_noticiaModal);

/*******************************
*Modal para visualizar notícia *
*******************************/
let btn_viewNoticia = document.querySelectorAll('.btn-view-noticia');
let modal_viewNoticia = document.querySelector('.modal-view-noticia');

function openView_noticiaModal(){
    modal_viewNoticia.classList.toggle('show-modal-view');
    let noticia_id = this.id;
    
    $.ajax({
       url: "../includes/load_modal.php",
        method:"post",
        data:{noticia_view: noticia_id},
        dataType:"json",
        success:function(data){
            let noticia_imagem = document.querySelector('.news__img');
            let noticia_titulo = document.querySelector('.news__titleHolder');
            let noticia_data = document.querySelector('.news__dateHolder');
            let noticia_contexto = document.querySelector('.news__contextHolder');
            
            noticia_imagem.src = "../imagens/noticias/"+data.noticia_imagem;
            noticia_titulo.innerHTML = data.noticia_titulo;
            noticia_data.innerHTML = data.noticia_data;
            noticia_contexto.innerHTML = data.noticia_contexto;
        }
    });
}

for(let i=0; i< btn_viewNoticia.length; i++){
    btn_viewNoticia[i].addEventListener("click", openView_noticiaModal);
}

/*******************************
*Modal para eliminar notícia   *
*******************************/
let btn_deleteNocitia = document.querySelectorAll('.btn-delete-noticia');
let modal_delete_noticia = document.querySelector('.modal-delete-noticia');
let close_delete_modal = document.querySelector('.close-delete-modal');

function openDelete_noticiaModal(){
    modal_delete_noticia.classList.toggle("show-modal-delete");
    let delNews = document.getElementById('delNews');
    delNews.value = this.id;
}

for(let i=0; i<btn_deleteNocitia.length; i++){
    btn_deleteNocitia[i].addEventListener("click", openDelete_noticiaModal);
}

close_delete_modal.addEventListener("click", openDelete_noticiaModal);

