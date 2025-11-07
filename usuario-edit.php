<?php 
session_start();
require "conexao.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Criar usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <?php include"navbar.php"?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Usuário
                            <a href="index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php 
                            if( isset($_GET['id'])){
                                $usuario_id = mysqli_real_escape_string($mysqli, $_GET['id']);
                                $sql = "SELECT * FROM usuarios where id=" . $usuario_id;
                                $query = mysqli_query($mysqli, $sql);

                                if (mysqli_num_rows($query) > 0){
                                    $usuario = mysqli_fetch_array($query);
                        ?>
                        <form action="acoes.php" method="post">

                            <input type="hidden" name="usuario_id" value="<?=$usuario['id']?>">

                            <div class="mb-3">
                                <label for="idnome">Nome</label>
                                <input type="text" name="nome" value="<?=$usuario['nome']?>" id="idnome" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="idnome">Email</label>
                                <input type="text" name="email" value="<?=$usuario['email']?>" id="idemail" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="iddata">Data de nascimento</label>
                                <input type="date" name="data_nascimento" value="<?=$usuario['data_nascimento']?>" id="iddata" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="idsenha">Senha</label>
                                <input type="password" name="senha" id="idsenha" class="form-control">
                            </div>

                            <div class="mb-3">
                                <input type="submit" value="Salvar" name="update_usuario" class="btn btn-primary">
                            </div>
                        </form>
                        <?php 
                                
                            }else{
                                echo "<h5>Usuário não encontrado</h5>";
                            }  }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>