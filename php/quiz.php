<?php
  include('conexao.php');
  include("protect.php");

  if(!isset($_SESSION)){
    session_start();
  }

  $nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : null;
  $nome = $mysqli->real_escape_string($nome);

  $sql_code_avatar = "SELECT avatar FROM usuarios WHERE user = '$nome'";
  $result_avatar = mysqli_query($mysqli, $sql_code_avatar);
  $row_avatar = mysqli_fetch_assoc($result_avatar);

  $sql_code_nome_personagem = "SELECT nome_personagem FROM usuarios WHERE user = '$nome'";
  $result_nome_personagem = mysqli_query($mysqli, $sql_code_nome_personagem);
  $row_nome_personagem = mysqli_fetch_assoc($result_nome_personagem);


  if(isset($_GET['quiz'])) {
    $id_quiz = $_GET['quiz'];

  }
  $id = $id_quiz; // ID que você deseja selecionar

// Prepare e execute a consulta SQL usando MySQLi
  $sql = "SELECT * FROM pergunta WHERE pergunta_id = ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();

  // Fetch o resultado em um objeto
  $object = $result->fetch_object();

  $titulo = json_decode($object->titulo);
  $alternativas = json_decode($object->alternativas, true);
  $corretas = json_decode($object->correto);

  $perguntasObj = new stdClass();
  $alternativasObj = new stdClass();
  $corretasObj = new stdClass();

  foreach ($titulo as $indice => $pergunta) {
    $propriedade = "pergunta" . ($indice + 1);
    $perguntasObj->$propriedade = $pergunta->$propriedade;
  }

  foreach ($corretas as $indice3 => $correta) {
      $propriedade_correta = "correta" . ($indice3 + 1);
      $corretasObj->$propriedade_correta = $correta->$propriedade_correta;
  }
  $questions = [];

  for ($numeroPerguntas = 0; $numeroPerguntas < $object->quantidadePerguntas; $numeroPerguntas++) {
      switch($corretasObj->{"correta".($numeroPerguntas + 1)}){
        case 1:
          $resposta1 = true;
          $resposta2 = false;
          $resposta3 = false;
          $resposta4 = false;
          $resposta5 = false;
        break;

        case 2:
          $resposta1 = false;
          $resposta2 = true;
          $resposta3 = false;
          $resposta4 = false;
          $resposta5 = false;
        break;

        case 3:
          $resposta1 = false;
          $resposta2 = false;
          $resposta3 = true;
          $resposta4 = false;
          $resposta5 = false;
        break;

        case 4:
          $resposta1 = false;
          $resposta2 = false;
          $resposta3 = false;
          $resposta4 = true;
          $resposta5 = false;
        break;

        case 5:
          $resposta1 = false;
          $resposta2 = false;
          $resposta3 = false;
          $resposta4 = false;
          $resposta5 = true;
        break;
      }

      $questions[] = [
          "question" => $perguntasObj->{"pergunta" . ($numeroPerguntas + 1)},
          "answers" => [
              ["option" => $alternativas['alternativa 1 da pergunta '. ($numeroPerguntas + 1)], "correct" => $resposta1],
              ["option" => $alternativas['alternativa 2 da pergunta '. ($numeroPerguntas + 1)], "correct" => $resposta2],
              ["option" => $alternativas['alternativa 3 da pergunta '. ($numeroPerguntas + 1)], "correct" => $resposta3],
              ["option" => $alternativas['alternativa 4 da pergunta '. ($numeroPerguntas + 1)], "correct" => $resposta4],
              ["option" => $alternativas['alternativa 5 da pergunta '. ($numeroPerguntas + 1)], "correct" => $resposta5],
          ],
      ];
  }
  $currentIndex = 0;
  $questionsCorrect = 0;
  $sql_code_quizzesFeitos = "SELECT quizzes_feitos FROM usuarios WHERE user = '$nome'";
  $result_quizzesFeitos = mysqli_query($mysqli, $sql_code_quizzesFeitos);
  $row_quizzesFeitos = mysqli_fetch_assoc($result_quizzesFeitos);
  $quizzes_feitos = $row_quizzesFeitos['quizzes_feitos'];

  $array_numero_quizzes = explode(", ", $quizzes_feitos);
  $array_numero_quizzes = array_filter($array_numero_quizzes);
  $total_feitos = count($array_numero_quizzes);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="icon" href="https://static.vecteezy.com/system/resources/previews/010/157/483/original/house-symbol-and-home-icon-sign-design-free-png.png">
      <link rel="stylesheet" type="text/css" href="../css/quiz.css">
      <!-- GOOGLE FONTS -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600&family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
        <!-- GOOGLE FONTS -->
      <title>Quiz Orientação 360</title>
</head>
<body>
  <h1>
    <?php
        $sql_code = "SELECT titulo FROM quizzes_cards WHERE id = $id";
        $result = mysqli_query($mysqli, $sql_code);
        $row = mysqli_fetch_assoc($result);
        echo $row['titulo'];
    ?>
  </h1>
  <br>
  <div class="container">
    <div class="content">
      <span class="spnQtd"></span>
      <div class="question"></div>
      <div class="answers"></div>
    </div>
    <div class="finish">
      <span></span>
      <button class="finish-button">Reiniciar</button>
      <p></p>
      <button class="sair">Sair</button>
      <p></p>
    </div>
  </div>
  <div class="container_finish">
    <label>Você completou uma conquista por ter realizado <?php echo $total_feitos + 1; ?> quizzes!<br>+30 de XP</label>
    <br>
    <a href="perfil.php">Clique aqui e confira como está<br> seu personagem <b><?php echo $row_nome_personagem['nome_personagem']; ?></b></a>
    <br>
    <button id="conquistaBtn">Continuar</button>
  </div>
  <input type="hidden" id="total" value="<?php echo $total_feitos; ?>">

  <script>
    const questionElement = document.querySelector(".question");
    const answersElement = document.querySelector(".answers");
    const spnQtdElement = document.querySelector(".spnQtd");
    const finishElement = document.querySelector(".finish span");
    const contentElement = document.querySelector(".content");
    const contentFinishElement = document.querySelector(".finish");
    const btnRestartElement = document.querySelector(".finish-button");
    const btnSair = document.querySelector(".sair");
    const btnConquista =document.querySelector("#conquistaBtn");
  
    const questions = <?php echo json_encode($questions); ?>;
    let currentIndex = <?php echo $currentIndex; ?>;
    let questionsCorrect = <?php echo $questionsCorrect; ?>;

    btnRestartElement.onclick = () => {
      /**
      contentElement.style.display = "flex";
      contentFinishElement.style.display = "none";
      currentIndex = 0;
      questionsCorrect = 0;
      loadQuestion();
      */
      location.reload();
    };

    btnSair.onclick = () => {
      history.back();
    }

    btnConquista.onclick = () => {
      const conquista_container = document.querySelector(".container_finish");
      conquista_container.style.visibility = 'hidden';
    }

    function nextQuestion(e) {
      if (e.target.getAttribute("data-correct") === "true") {
        questionsCorrect++;
      }

      if (currentIndex < questions.length - 1) {
        currentIndex++;
        loadQuestion();
      } else {
        finish();
      }
    }

    function finish() {
      finishElement.innerHTML = 
      `<h2 class='pontuacao'>Você acertou ${questionsCorrect} de 
      ${questions.length}</h2>
      <p></p>
      <?php echo $object->descricaoFinal; ?>`;
      contentElement.style.display = "none";
      contentFinishElement.style.display = "flex";
      const conquista_container = document.querySelector(".container_finish");

      if(total == 1 || total == 3 || total == 5 || total == 10 || total == 15 || 
      total == 25 || total == 35 || total == 50){
        conquista_container.style.visibility = 'visible';
      }

  var xhr = new XMLHttpRequest();
  var formData = new FormData();
  formData.append('corretas', questionsCorrect);
  formData.append('idQuiz', <?php echo $id; ?>);
  xhr.open('POST', 'quiz_xp.php', true);

  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var totalFeitos = parseInt(xhr.responseText); // Converter a resposta para um número

      if (
        totalFeitos == 1 ||
        totalFeitos == 3 ||
        totalFeitos == 5 ||
        totalFeitos == 10 ||
        totalFeitos == 15 ||
        totalFeitos == 25 ||
        totalFeitos == 35 ||
        totalFeitos == 50
      ) {
        conquista_container.style.visibility = 'visible';
      }
    }
  };
  xhr.send(formData);
}


    function loadQuestion() {
      spnQtdElement.innerHTML = `${currentIndex + 1}/${questions.length}`;
      const item = questions[currentIndex];
      answersElement.innerHTML = "";
      questionElement.innerHTML = item.question;

      item.answers.forEach((answer) => {
        const div = document.createElement("div");
        div.innerHTML = `
          <button class="answer" data-correct="${answer.correct}">
            ${answer.option}
          </button>
        `;
        answersElement.appendChild(div);
      });

      document.querySelectorAll(".answer").forEach((item) => {
        item.addEventListener("click", nextQuestion);
      });
    }
    loadQuestion();
  </script>
</body>
</html>