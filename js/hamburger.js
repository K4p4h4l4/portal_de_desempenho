$(document).ready(function(){
    var hamburger = document.querySelector(".hamburger");
    
    hamburger.addEventListener('click', function(){
        document.querySelector("#sidebarMenu").classList.toggle('show__fullDashboard');
        hamburger.classList.toggle('open');
    });
})