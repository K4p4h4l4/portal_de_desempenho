<div class="container_brevemente">
    <div class="container--box">
        <div class="shadow">
            <div class="countdown">
                <div class="countdown--title">
                    <i class="material-icons">locker</i><span>Bloqueado</span>
                </div>
                <hr>
                <p class="message">Caro utilizador esta secção de avaliação encontra-se bloqueada de momento, no entanto a mesma será desbloqueada no dia 20 do mês corrente, voltando a bloquear no dia 6 do mês seguinte.</p>
                <p class="message">Obrigado</p>
                <div class="data">
                    <div class="time">
                        <div class="time--data" id="d"><span>0</span></div>
                        <span class="time--text">Dias</span>
                    </div>
                    <div class="time">
                        <div class="time--data" id="h"><span>0</span></div>
                        <span class="time--text">Horas</span>
                    </div>
                    <div class="time">
                        <div class="time--data" id="m"><span>0</span></div>
                        <span class="time--text">Minutos</span>
                    </div>
                    <div class="time">
                        <div class="time--data" id="s"><span>0</span></div>
                        <span class="time--text">Segundos</span>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<?php 
    $mes = date('m');
    $ano = date('Y');

    $data = "{$mes}-20-{$ano} 00:00:00";
?>
<script>
    var comingdate = new Date("<?php echo $data; ?>");
    var d = document.getElementById("d");
    var h = document.getElementById("h");
    var m = document.getElementById("m");
    var s = document.getElementById("s");
    
    var x = setInterval(function(){
        var now = new Date();
        var des = comingdate.getTime() - now.getTime();
        var days = Math.floor(des/(1000 * 60 * 60 * 24));
        var hours = Math.floor(des%(1000 * 60 * 60 * 24) / (1000 * 60 * 60));
        var mins = Math.floor(des%(1000 * 60 * 60) / (1000 * 60));
        var secs = Math.floor(des%(1000 * 60) / (1000));
        
        d.innerHTML = days;
        h.innerHTML = hours;
        m.innerHTML = mins;
        s.innerHTML = secs;
        
        if(des <= 0)clearInterval(x);
    },1000);
    
    function getTrueNumber(x){
        if(x<10) return '0'+x;
        else return x;
    }
</script>