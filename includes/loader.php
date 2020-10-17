
<style>
    html, body{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    #loader{
        display: none;
    }
    
    .loader__container{
        width: 100%;
        height: 100%;
        position: fixed;        
        background-color: rgba(255,255,255,.8);
        z-index: 4;
    }

    .loading{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        height: 40px;
        display: flex;
        align-items: center;
        z-index: 4;
    }

    .obj{
        width: 6px;
        height: 40px;
        background-color: #2C7FBD;
        margin: 0 3px;
        border-radius: 10px;
        animation: loading 1s ease-in-out infinite;
    }
    
    .obj:nth-child(2){
        animation-delay: .1s;
    }
    .obj:nth-child(3){
        animation-delay: .2s;
    }
    .obj:nth-child(4){
        animation-delay: .3s;
    }
    .obj:nth-child(5){
        animation-delay: .4s;
    }
    .obj:nth-child(6){
        animation-delay: .5s;
    }
    .obj:nth-child(7){
        animation-delay: .6s;
    }
    .obj:nth-child(8){
        animation-delay: .7s;
    }
    
    @keyframes loading{
        0%{
            height: 0;
        }
        50%{
            height: 40px;
        }
        100%{
            height: 40px;
        }
    }
</style>

    
<?php echo '
<div class="loader__container" id="loader">
    <div class="loading">
        <div class="obj"></div>
        <div class="obj"></div>
        <div class="obj"></div>
        <div class="obj"></div>
        <div class="obj"></div>
        <div class="obj"></div>
        <div class="obj"></div>
        <div class="obj"></div>
    </div>
</div>';

?>



