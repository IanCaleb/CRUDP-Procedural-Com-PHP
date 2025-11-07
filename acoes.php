<?php 
//Cria uma sessão para poder armazenar a mensagem de sucesso ou de falha
session_start();

require 'conexao.php';

if(isset($_POST['create_usuario'])){
    
    //$atributo = mysqli_real_escape_string($variavel_de_conexao, trim($_POST['nome']));

    //trim é para remover os espaços do inicio e do fim de uma string
    $nome = mysqli_real_escape_string($mysqli, trim($_POST['nome'])); 

    $email = mysqli_real_escape_string($mysqli, trim($_POST['email'])); 

    $dataNascimento = mysqli_real_escape_string($mysqli, trim($_POST['data_nascimento'])); 

    $senha = isset($_POST['senha']) ? mysqli_real_escape_string($mysqli, password_hash(trim($_POST['senha']), PASSWORD_DEFAULT)) : '';
    //Em senha tem uma validação a mais que é "Se estiver setado vamos armazenar, se não, armazena vazio";
    //antes do trim ela também tem a função password_hash;
    //dentro do mysqli_real_escape_string ela tem um parametro a mais que é o PASSWORD_DEFAULT
    //mysqli_real_escape_string é uma proteção contra sql inject (é melhor que nada, mas tem formas melhor de se fazer)

    //define uma string com o comando sql de "salvar na tabela usuários nesses campos esses valores"
    $sql = "insert into usuarios (nome, email, data_nascimento, senha) values ('$nome', '$email', '$dataNascimento', '$senha')";

    //Manda executar mo banco de dados da conexeão esse comando definido na string
    mysqli_query($mysqli, $sql);


    //Se ouver alguma linha afetada no banco de dados 
    if (mysqli_affected_rows($mysqli) > 0){
        $_SESSION['mensagem'] = "Usuário criado com sucesso!";
        //Encaminha para a página index.php
        header('Location: index.php');
        exit;
    }
    else{
        $_SESSION['mensagem'] = "Usuário não foi criado...";
        header('Location: index.php');
        exit;
    }
}

if(isset($_POST['update_usuario'])){
    $usuario_id = mysqli_real_escape_string($mysqli, $_POST['usuario_id']);

    $nome = mysqli_real_escape_string($mysqli, trim($_POST['nome'])); 

    $email = mysqli_real_escape_string($mysqli, trim($_POST['email'])); 

    $dataNascimento = mysqli_real_escape_string($mysqli, trim($_POST['data_nascimento'])); 

    $senha = mysqli_real_escape_string($mysqli, trim($_POST['senha']));

    $sql = "UPDATE usuarios SET nome = '$nome', email = '$email', data_nascimento = '$dataNascimento'";

    if(!empty($senha)){
        $sql .= ", senha ='" . password_hash($senha, PASSWORD_DEFAULT) . "'"; 
    }

    $sql .= " WHERE id='$usuario_id'";

    mysqli_query($mysqli, $sql);

    if (mysqli_affected_rows($mysqli) > 0){
        $_SESSION['mensagem'] = "Usuário atualizado com sucesso!";
        //Encaminha para a página index.php
        header('Location: index.php');
        exit;
    }
    else{
        $_SESSION['mensagem'] = "Usuário não foi atualizado...";
        header('Location: index.php');
        exit;
    } 
}

if(isset($_POST['delete_usuario'])){
    $usuario_id = mysqli_real_escape_string($mysqli, $_POST['delete_usuario']);
    
    $sql = "DELETE FROM usuarios WHERE id='$usuario_id'";

    mysqli_query($mysqli, $sql);

    if (mysqli_affected_rows($mysqli) > 0){
        $_SESSION['mensagem'] = "Usuário deletado com sucesso!";
        //Encaminha para a página index.php
        header('Location: index.php');
        exit;
    }
    else{
        $_SESSION['mensagem'] = "Usuário não foi deletado...";
        header('Location: index.php');
        exit;
    } 
}

?>