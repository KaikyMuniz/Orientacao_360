const voltarBtn = document.getElementById('voltar');
const excluirBtn = document.getElementById('excluir');

voltarBtn.addEventListener('click', e => {
    history. back();
})

excluirBtn.addEventListener('click', e => {
    window.location.href = "excluir_definitivo.php";
});