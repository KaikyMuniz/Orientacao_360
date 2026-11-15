const senha_visible = document.querySelector("#visible_senha");

senha_visible.addEventListener('click', e=>{
    const senha = document.querySelector("#senha");
    if(senha.type == 'password'){
        senha.innerText = senha.type = 'text';
        senha_visible.src = "../img/tela Login/search_visible.png";
    }else{
        senha.innerText = senha.type = 'password';
        senha_visible.src = "../img/tela Login/search_invisible.png";
    }
});