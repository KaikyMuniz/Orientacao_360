document.addEventListener('DOMContentLoaded', function() {
    var input = document.querySelector("#imagem_file");
    input.addEventListener('change', function() {
        // Restante do código aqui (o mesmo código que forneci anteriormente)
        var fileName = this.value.split('\\').pop();
        var imagemBaseUrl = "../img/tela Card de Notícias/"; // Substitua pelo caminho do diretório onde as imagens são armazenadas
        var imagemPath = imagemBaseUrl + fileName;
        document.getElementById('imagem').value = imagemPath;
    });
});