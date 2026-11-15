const senhaVisible = document.querySelector("#visible_senha");

senhaVisible.addEventListener('click', e=>{
    const senha = document.querySelector("#senha");
    if(senha.type == 'password'){
        senha.innerText = senha.type = 'text';
        senhaVisible.src = "../img/tela Cadastro/search_visible.png";
    }else{
        senha.innerText = senha.type = 'password';
        senhaVisible.src = "../img/tela Cadastro/search_invisible.png";
    }
});

let userErro = document.getElementById('user_aviso');
var inputUser = document.getElementById('user');

if(userErro != null){
    inputUser.addEventListener('input', e=>{
        userErro.innerText = "";
    });
}


let nascErro = document.getElementById('nasc_aviso');
var inputNasc = document.getElementById('nasc');

if(nascErro != null){
    inputNasc.addEventListener('input', e=>{
        nascErro.innerText = "";
    });
}

let recuperarErro = document.getElementById('recuperar_aviso');
var inputRecuperar = document.getElementById('recuperar');

if(recuperarErro != null){
    inputRecuperar.addEventListener('input', e=>{
        recuperarErro.innerText = "";
    });
}


let senhaErro = document.getElementById('senha_aviso');
var inputSenha = document.getElementById('senha');

if(senhaErro != null){
    inputSenha.addEventListener('input', e=>{
        senhaErro.innerText = "";
    });
}