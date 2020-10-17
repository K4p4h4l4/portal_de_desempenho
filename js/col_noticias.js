
    let main_temp = document.getElementById("weather__temp");
    $.ajax({
       url:'http://api.openweathermap.org/data/2.5/forecast?q=Luanda,ao&units=metric&lang=pt&cnt=24&APPID=de7f9507c406211b3a219af4bc256696',
       method:"get",
       dataType:"json",
       success:function(data){
           $("#weather__temp").html(data.list[0].main.temp+"ºC");
           $("#weather__string").html(data.list[0].weather[0].description);
           $("#tmpt1").html(data.list[3].main.temp+"ºC");
           $("#tmpt2").html(data.list[6].main.temp+"ºC");
           $("#tmpt3").html(data.list[9].main.temp+"ºC");
           $("#tmpt4").html(data.list[12].main.temp+"ºC");
           $("#tmpt5").html(data.list[15].main.temp+"ºC");

           $("#weather__mainIcon").removeClass("fa-sun");
           $("#weather__mainIcon").removeClass("fa-moon");
           $("#weather__mainIcon").removeClass("fa-cloud-sun");
           $("#weather__mainIcon").removeClass("fa-cloud");
           $("#weather__mainIcon").removeClass("fa-cloud-showers-heavy");
           $("#weather__mainIcon").removeClass("fa-cloud-sun-rain");
           $("#weather__mainIcon").removeClass("fa-cloud-moon-rain");
           $("#weather__mainIcon").removeClass("fa-poo-storm");
           $("#weather__mainIcon").removeClass("fa-snowflake");
           $("#weather__mainIcon").removeClass("fa-wind");
           
           if(data.list[0].weather[0].icon=='01d') {
               $("#weather__mainIcon").addClass("fa-sun");
           }
           if(data.list[0].weather[0].icon=='01n'){
               $("#weather__mainIcon").addClass("fa-moon");
           }
           if(data.list[0].weather[0].icon=='02d') {
               $("#weather__mainIcon").addClass("fa-cloud-sun");
           }
           if(data.list[0].weather[0].icon=='02n'){
               $("#weather__mainIcon").addClass("fa-cloud-moon");
           }
           if((data.list[0].weather[0].icon=='03d') || (data.list[0].weather[0].icon=='03n')) {
               $("#weather__mainIcon").addClass("fa-cloud");
           }
           if((data.list[0].weather[0].icon=='04d') || (data.list[0].weather[0].icon=='04n')) {
               $("#weather__mainIcon").addClass("fa-cloud");
           }
           if((data.list[0].weather[0].icon=='09d') || (data.list[0].weather[0].icon=='09n')) {
               $("#weather__mainIcon").addClass("fa-cloud-showers-heavy");
           }
           if(data.list[0].weather[0].icon=='10d') {
               $("#weather__mainIcon").addClass("fa-cloud-sun-rain");
           }
           if(data.list[0].weather[0].icon=='10n'){
               $("#weather__mainIcon").addClass("fa-cloud-moon-rain");
           }
           if((data.list[0].weather[0].icon=='11d') || (data.list[0].weather[0].icon=='11n')) {
               $("#weather__mainIcon").addClass("fa-poo-storm");
           }
           if((data.list[0].weather[0].icon=='13d') || (data.list[0].weather[0].icon=='13n')) {
               $("#weather__mainIcon").addClass("fa-snowflake");
           }
           if((data.list[0].weather[0].icon=='50d') || (data.list[0].weather[0].icon=='50n')) {
               $("#weather__mainIcon").addClass("fa-wind");
           }
           
           $("#weather__icon1").removeClass("fa-sun");
           $("#weather__icon1").removeClass("fa-moon");
           $("#weather__icon1").removeClass("fa-cloud-sun");
           $("#weather__icon1").removeClass("fa-cloud");
           $("#weather__icon1").removeClass("fa-cloud-showers-heavy");
           $("#weather__icon1").removeClass("fa-cloud-sun-rain");
           $("#weather__icon1").removeClass("fa-cloud-moon-rain");
           $("#weather__icon1").removeClass("fa-poo-storm");
           $("#weather__icon1").removeClass("fa-snowflake");
           $("#weather__icon1").removeClass("fa-wind");
           
           if(data.list[3].weather[0].icon=='01d') {
               $("#weather__icon1").addClass("fa-sun");
           }
           if(data.list[3].weather[0].icon=='01n'){
               $("#weather__icon1").addClass("fa-moon");
           }
           if(data.list[3].weather[0].icon=='02d') {
               $("#weather__icon1").addClass("fa-cloud-sun");
           }
           if(data.list[3].weather[0].icon=='02n'){
               $("#weather__icon1").addClass("fa-cloud-moon");
           }
           if((data.list[3].weather[0].icon=='03d') || (data.list[3].weather[0].icon=='03n')) {
               $("#weather__icon1").addClass("fa-cloud");
           }
           if((data.list[3].weather[0].icon=='04d') || (data.list[3].weather[0].icon=='04n')) {
               $("#weather__icon1").addClass("fa-cloud");
           }
           if((data.list[3].weather[0].icon=='09d') || (data.list[3].weather[0].icon=='09n')) {
               $("#weather__icon1").addClass("fa-cloud-showers-heavy");
           }
           if(data.list[3].weather[0].icon=='10d') {
               $("#weather__icon1").addClass("fa-cloud-sun-rain");
           }
           if(data.list[3].weather[0].icon=='10n'){
               $("#weather__icon1").addClass("fa-cloud-moon-rain");
           }
           if((data.list[3].weather[0].icon=='11d') || (data.list[3].weather[0].icon=='11n')) {
               $("#weather__icon1").addClass("fa-poo-storm");
           }
           if((data.list[3].weather[0].icon=='13d') || (data.list[3].weather[0].icon=='13n')) {
               $("#weather__icon1").addClass("fa-snowflake");
           }
           if((data.list[3].weather[0].icon=='50d') || (data.list[3].weather[0].icon=='50n')) {
               $("#weather__icon1").addClass("fa-wind");
           }
           
           
           $("#weather__icon2").removeClass("fa-sun");
           $("#weather__icon2").removeClass("fa-moon");
           $("#weather__icon2").removeClass("fa-cloud-sun");
           $("#weather__icon2").removeClass("fa-cloud");
           $("#weather__icon2").removeClass("fa-cloud-showers-heavy");
           $("#weather__icon2").removeClass("fa-cloud-sun-rain");
           $("#weather__icon2").removeClass("fa-cloud-moon-rain");
           $("#weather__icon2").removeClass("fa-poo-storm");
           $("#weather__icon2").removeClass("fa-snowflake");
           $("#weather__icon2").removeClass("fa-wind");
           
           if(data.list[6].weather[0].icon=='01d') {
               $("#weather__icon2").addClass("fa-sun");
           }
           if(data.list[6].weather[0].icon=='01n'){
               $("#weather__icon2").addClass("fa-moon");
           }
           if(data.list[6].weather[0].icon=='02d') {
               $("#weather__icon2").addClass("fa-cloud-sun");
           }
           if(data.list[6].weather[0].icon=='02n'){
               $("#weather__icon2").addClass("fa-cloud-moon");
           }
           if((data.list[6].weather[0].icon=='03d') || (data.list[6].weather[0].icon=='03n')) {
               $("#weather__icon2").addClass("fa-cloud");
           }
           if((data.list[6].weather[0].icon=='04d') || (data.list[6].weather[0].icon=='04n')) {
               $("#weather__icon2").addClass("fa-cloud");
           }
           if((data.list[6].weather[0].icon=='09d') || (data.list[6].weather[0].icon=='09n')) {
               $("#weather__icon2").addClass("fa-cloud-showers-heavy");
           }
           if(data.list[6].weather[0].icon=='10d') {
               $("#weather__icon2").addClass("fa-cloud-sun-rain");
           }
           if(data.list[6].weather[0].icon=='10n'){
               $("#weather__icon2").addClass("fa-cloud-moon-rain");
           }
           if((data.list[6].weather[0].icon=='11d') || (data.list[6].weather[0].icon=='11n')) {
               $("#weather__icon2").addClass("fa-poo-storm");
           }
           if((data.list[6].weather[0].icon=='13d') || (data.list[6].weather[0].icon=='13n')) {
               $("#weather__icon2").addClass("fa-snowflake");
           }
           if((data.list[6].weather[0].icon=='50d') || (data.list[6].weather[0].icon=='50n')) {
               $("#weather__icon2").addClass("fa-wind");
           }
           
           
           $("#weather__icon3").removeClass("fa-sun");
           $("#weather__icon3").removeClass("fa-moon");
           $("#weather__icon3").removeClass("fa-cloud-sun");
           $("#weather__icon3").removeClass("fa-cloud");
           $("#weather__icon3").removeClass("fa-cloud-showers-heavy");
           $("#weather__icon3").removeClass("fa-cloud-sun-rain");
           $("#weather__icon3").removeClass("fa-cloud-moon-rain");
           $("#weather__icon3").removeClass("fa-poo-storm");
           $("#weather__icon3").removeClass("fa-snowflake");
           $("#weather__icon3").removeClass("fa-wind");
           
           if(data.list[9].weather[0].icon=='01d') {
               $("#weather__icon3").addClass("fa-sun");
           }
           if(data.list[9].weather[0].icon=='01n'){
               $("#weather__icon3").addClass("fa-moon");
           }
           if(data.list[9].weather[0].icon=='02d') {
               $("#weather__icon3").addClass("fa-cloud-sun");
           }
           if(data.list[9].weather[0].icon=='02n'){
               $("#weather__icon3").addClass("fa-cloud-moon");
           }
           if((data.list[9].weather[0].icon=='03d') || (data.list[9].weather[0].icon=='03n')) {
               $("#weather__icon3").addClass("fa-cloud");
           }
           if((data.list[9].weather[0].icon=='04d') || (data.list[9].weather[0].icon=='04n')) {
               $("#weather__icon3").addClass("fa-cloud");
           }
           if((data.list[9].weather[0].icon=='09d') || (data.list[9].weather[0].icon=='09n')) {
               $("#weather__icon3").addClass("fa-cloud-showers-heavy");
           }
           if(data.list[9].weather[0].icon=='10d') {
               $("#weather__icon3").addClass("fa-cloud-sun-rain");
           }
           if(data.list[9].weather[0].icon=='10n'){
               $("#weather__icon3").addClass("fa-cloud-moon-rain");
           }
           if((data.list[9].weather[0].icon=='11d') || (data.list[9].weather[0].icon=='11n')) {
               $("#weather__icon3").addClass("fa-poo-storm");
           }
           if((data.list[9].weather[0].icon=='13d') || (data.list[9].weather[0].icon=='13n')) {
               $("#weather__icon3").addClass("fa-snowflake");
           }
           if((data.list[9].weather[0].icon=='50d') || (data.list[9].weather[0].icon=='50n')) {
               $("#weather__icon3").addClass("fa-wind");
           }
           
           $("#weather__icon4").removeClass("fa-sun");
           $("#weather__icon4").removeClass("fa-moon");
           $("#weather__icon4").removeClass("fa-cloud-sun");
           $("#weather__icon4").removeClass("fa-cloud");
           $("#weather__icon4").removeClass("fa-cloud-showers-heavy");
           $("#weather__icon4").removeClass("fa-cloud-sun-rain");
           $("#weather__icon4").removeClass("fa-cloud-moon-rain");
           $("#weather__icon4").removeClass("fa-poo-storm");
           $("#weather__icon4").removeClass("fa-snowflake");
           $("#weather__icon4").removeClass("fa-wind");
           
           if(data.list[12].weather[0].icon=='01d') {
               $("#weather__icon4").addClass("fa-sun");
           }
           if(data.list[12].weather[0].icon=='01n'){
               $("#weather__icon4").addClass("fa-moon");
           }
           if(data.list[12].weather[0].icon=='02d') {
               $("#weather__icon4").addClass("fa-cloud-sun");
           }
           if(data.list[12].weather[0].icon=='02n'){
               $("#weather__icon4").addClass("fa-cloud-moon");
           }
           if((data.list[12].weather[0].icon=='03d') || (data.list[12].weather[0].icon=='03n')) {
               $("#weather__icon4").addClass("fa-cloud");
           }
           if((data.list[12].weather[0].icon=='04d') || (data.list[12].weather[0].icon=='04n')) {
               $("#weather__icon4").addClass("fa-cloud");
           }
           if((data.list[12].weather[0].icon=='09d') || (data.list[12].weather[0].icon=='09n')) {
               $("#weather__icon4").addClass("fa-cloud-showers-heavy");
           }
           if(data.list[12].weather[0].icon=='10d') {
               $("#weather__icon4").addClass("fa-cloud-sun-rain");
           }
           if(data.list[12].weather[0].icon=='10n'){
               $("#weather__icon4").addClass("fa-cloud-moon-rain");
           }
           if((data.list[12].weather[0].icon=='11d') || (data.list[12].weather[0].icon=='11n')) {
               $("#weather__icon4").addClass("fa-poo-storm");
           }
           if((data.list[12].weather[0].icon=='13d') || (data.list[12].weather[0].icon=='13n')) {
               $("#weather__icon4").addClass("fa-snowflake");
           }
           if((data.list[12].weather[0].icon=='50d') || (data.list[12].weather[0].icon=='50n')) {
               $("#weather__icon4").addClass("fa-wind");
           }
           
           $("#weather__icon5").removeClass("fa-sun");
           $("#weather__icon5").removeClass("fa-moon");
           $("#weather__icon5").removeClass("fa-cloud-sun");
           $("#weather__icon5").removeClass("fa-cloud");
           $("#weather__icon5").removeClass("fa-cloud-showers-heavy");
           $("#weather__icon5").removeClass("fa-cloud-sun-rain");
           $("#weather__icon5").removeClass("fa-cloud-moon-rain");
           $("#weather__icon5").removeClass("fa-poo-storm");
           $("#weather__icon5").removeClass("fa-snowflake");
           $("#weather__icon5").removeClass("fa-wind");
           
           if(data.list[15].weather[0].icon=='01d') {
               $("#weather__icon5").addClass("fa-sun");
           }
           if(data.list[15].weather[0].icon=='01n'){
               $("#weather__icon5").addClass("fa-moon");
           }
           if(data.list[15].weather[0].icon=='02d') {
               $("#weather__icon5").addClass("fa-cloud-sun");
           }
           if(data.list[15].weather[0].icon=='02n'){
               $("#weather__icon5").addClass("fa-cloud-moon");
           }
           if((data.list[15].weather[0].icon=='03d') || (data.list[15].weather[0].icon=='03n')) {
               $("#weather__icon5").addClass("fa-cloud");
           }
           if((data.list[15].weather[0].icon=='04d') || (data.list[15].weather[0].icon=='04n')) {
               $("#weather__icon5").addClass("fa-cloud");
           }
           if((data.list[15].weather[0].icon=='09d') || (data.list[15].weather[0].icon=='09n')) {
               $("#weather__icon5").addClass("fa-cloud-showers-heavy");
           }
           if(data.list[15].weather[0].icon=='10d') {
               $("#weather__icon5").addClass("fa-cloud-sun-rain");
           }
           if(data.list[15].weather[0].icon=='10n'){
               $("#weather__icon5").addClass("fa-cloud-moon-rain");
           }
           if((data.list[15].weather[0].icon=='11d') || (data.list[15].weather[0].icon=='11n')) {
               $("#weather__icon5").addClass("fa-poo-storm");
           }
           if((data.list[15].weather[0].icon=='13d') || (data.list[15].weather[0].icon=='13n')) {
               $("#weather__icon5").addClass("fa-snowflake");
           }
           if((data.list[15].weather[0].icon=='50d') || (data.list[15].weather[0].icon=='50n')) {
               $("#weather__icon5").addClass("fa-wind");
           }

       }
    });
    
    $.ajax({
        url:"../includes/read_data.php",
        method:"post",
        data:{noticia_principal:"activado"},
        dataType:"json",
        success:function(data){
            $(".news__main--card").attr("id", data.noticia_id);//
            let news__imgPrincipal = document.querySelector(".news__imgPrincipal");
            let news__mainTitle = document.querySelector(".news__main--title");
            news__imgPrincipal.src = "../imagens/noticias/"+data.noticia_imagem;
            news__mainTitle.innerHTML = data.noticia_titulo;
        }
    });

   /*******************************
    *Modal para visualizar notícia *
    *******************************/
    let btn_viewNoticia = document.getElementsByClassName('news__card');
    let btn_viewNoticiaPopular = document.getElementsByClassName('news__card--long');
    let btn_viewNoticiaPrincipal = document.querySelector('.news__main--card');
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
    
    function windowsOnClick(event){
        
        if(event.target === modal_viewNoticia){
            openView_noticiaModal();
        }

    }

    window.addEventListener('click', windowsOnClick);
    
    for(let i=0; i< btn_viewNoticia.length; i++){
        btn_viewNoticia[i].addEventListener('click', openView_noticiaModal);
    }

    for(let i=0; i< btn_viewNoticiaPopular.length; i++){
        btn_viewNoticiaPopular[i].addEventListener('click', openView_noticiaModal);
    }

    btn_viewNoticiaPrincipal.addEventListener('click', openView_noticiaModal); 