const senha_visible = document.querySelector("#visible_senha");
const senha_visible2 = document.querySelector("#visible_senha2");

senha_visible.addEventListener('click', e=>{
    const senha = document.querySelector("#senha");
    if(senha.type == 'password'){
        senha.innerText = senha.type = 'text';
        senha_visible.src = "../img/tela Login/search_visible.png";
    }else{
        senha.innerText = senha.type = 'password';
        senha_visible.src = "../img/tela Login/search_invisible.png";
    }
})

senha_visible2.addEventListener('click', e=>{
    const confirma = document.querySelector("#confirm");
    if(confirma.type == 'password'){
        confirma.innerText = confirma.type = 'text';
        senha_visible2.src = "../img/tela Login/search_visible.png";
    }else{
        confirma.innerText = confirma.type = 'password';
        senha_visible2.src = "../img/tela Login/search_invisible.png";
    }
})