<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Olper Motors</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .card-login {
            padding: 30px 0 0 0;
            width: 350px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="https://pngimg.com/d/mercedes_PNG80199.png" width="30" height="30" class="d-inline-block align-top" alt="">
            Olper Motors
        </a>
    </nav>
    <div class="container">    
        <div class="row">
            <div class="card-login">
                <div class="card">
                    <div class="card-header">Registrar-se</div>
                    <div class="card-body">
                        <form action="registra_usuarios.php" method="post">
                            <div class="form-group">
                                <input name="nome" type="text" class="form-control" placeholder="Nome" required>
                            </div>
                            <div class="form-group">
                                <input name="email" type="email" class="form-control" placeholder="E-mail" required>
                            </div>
                            <div class="form-group">
                                <input name="senha" type="password" class="form-control" placeholder="Senha" required>
                            </div>
                            <button class="btn btn-lg btn-info btn-block" type="submit">Registrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        $servername = "localhost";
        $username = "root"; 
        $password = "";  
        $db_name = "registra_usuarios"; // Atualizar o nome do banco de dados
        
        // Conectando ao banco de dados
        $conn = new mysqli($servername, $username, $password, $db_name);
        
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }
        
        // Verificando se os dados do formulário estão definidos
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $senha = isset($_POST['senha']) ? password_hash($_POST['senha'], PASSWORD_DEFAULT) : '';
        
        // Verificando se os campos estão preenchidos
        if ($nome && $email && $senha) {
            // Inserindo dados na tabela
            $sql = "INSERT INTO registra_usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
            $stmt = $conn->prepare("INSERT INTO registra_usuarios (nome, email, senha) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nome, $email, $senha);
            $stmt->execute();
            $stmt->close();

        
            if ($conn->query($sql) === TRUE) {
                echo "Usuário cadastrado com sucesso!";
            } else {
                echo "Erro: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Por favor, preencha todos os campos.";
        }
        
        // Fechando a conexão com o banco de dados
        $conn->close();
    ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
