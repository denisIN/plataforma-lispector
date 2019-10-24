<?php
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$confirmaSenha = $_POST["confirmaSenha"];
session_start();
if ($senha != $confirmaSenha) {    
    $erro = "SENHAS NÃO COINCIDENTES";        
    $_SESSION["erro"] = $erro;
    header("Location: formCadastrodeFuncionário.php");
    exit();
}
# password hash
$hash = password_hash($senha, PASSWORD_DEFAULT);

$connection = mysqli_connect("localhost", "root", "", "plataforma_lispector");

// Check connection
if($connection === false){
    die("Deu ruim, mano!" . mysqli_connect_error());
}

$sql = "SELECT id FROM funcionário WHERE email='$email'";
$result = mysqli_query($connection, $sql);
$erro = "";
 
if (mysqli_num_rows($result) > 0) {
    $erro = "E-mail indisponível.";        
    $_SESSION["erro"] = $erro;
    header("Location: ../PHP/formCadastrodeFuncionário.php");
    exit();
}
// Attempt insert query execution
$sql = "INSERT INTO funcionário (nome, email, senha) VALUES ('$nome', '$email', '$senha' '$hash')";
if(mysqli_query($connection, $sql)){
    echo "DADOS INSERIDOS COM SUCESSO.";
 
} else{
    echo "ERRO: NÃO FOI POSSÍVEL CONECTAR AO $sql.";
}
mysqli_close($connection);
?>
