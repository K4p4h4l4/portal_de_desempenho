/*window.addEventListener('load', function(){
    document.getElementById('output').setAttribute('contenteditable', 'true');
    /*document.getElementById('ideia_descricao2').setAttribute('contenteditable', 'true');
});*/

let ideia_descricao = document.getElementById('ideia_descricao');
let buttons = document.getElementsByClassName('tool--btn');

/*function format(command, value) {
    document.execCommand(command, false, value);
}*/

for(let btn of buttons){
    btn.addEventListener('click', function(){
        let cmd = btn.dataset['command'];
        console.log(cmd);
        if(cmd === 'createLink'){
           let url = prompt("Insira o link aqui: ", " http:\/\/");
            document.execCommand(cmd, false, url);
        }else{
            document.execCommand(cmd, false, null);
        }
    });
}