<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="utf-8" />
    <title>Olper Motors</title>
</head>
<body> 
    <?php
        
        $servername = "localhost";
        $username = "root"; 
        $password = "";  
        $dbname = "registra_usuarios"; 
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }
        
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $senha = isset($_POST['senha']) ? $_POST['senha'] : '';
        
        $sql = "SELECT senha FROM registra_usuarios WHERE email='$email'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($senha, $row['senha'])) {
                echo "Usuário Autenticado";
                $_SESSION['autenticado'] = 'SIM';
                header('Location: tela_inicial.php');
            } else {
                $_SESSION['autenticado'] = 'NAO';
                header('Location: login.php?login=erro');
            }
        } else {
            $_SESSION['autenticado'] = 'NAO';
            header('Location: login.php?login=erro');
        }
        
        $conn->close();
    ?>
</body>
</html>
