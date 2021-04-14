<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Pet Place</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <script type="text/javascript">
        function alerta(text){
            alert(text);
        }
    </script>
</head>
<body>    
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="images/img-01.png" alt="IMG" style="border-radius: 20%;">                    
                </div>
                <?php
                    session_start();
                    session_destroy();


                    if(isset($_POST["login"]))
                    {
                        include('pages/view/conn.php');
                        $conn = new conexao;
                        $nome = $conn -> SelectReturn("select * from usuarios where email='". $_POST["login"] ."' and usr_hash = '".$_POST["senha"]. "' ");                        
                        
                        if (count($nome) > 1)
                        { 
                            session_start();
                            $_SESSION['id'] = $nome[1][0];
                            $_SESSION['nome'] = strtoupper($nome[1][1]);
                            $_SESSION['email'] = $nome[1][2];

                            header("Location: pages/Publicacoes.php");
                            exit();
                        }//echo  "id: " . $nome[1][0] . "  Nome: " . $nome[1][1] ; 
                        else{
                            $_POST["login"] = null;
                            echo "<script> alerta('Email ou senha incorretos'); </script>";
                        }
                    }
                ?>
                <form method="post" class="login100-form validate-form">
                    <span class="login100-form-title">
                        Conectar ao seu amor aninal
                    </span>

                    <div class="wrap-input100 validate-input" data-validate = "Insira um Email válido: teste@testes.com">
                        <input class="input100" type="text" name="login" placeholder="Email">
                        <span class="focus-input100"></span>
                       
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Insira a senha">
                        <input class="input100" type="password" name="senha" placeholder="Senha">
                        <span class="focus-input100"></span>
                       
                    </div>
                    
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>
                    
                    <div class="text-center padding-50">
                        <a class="txt2" href="pages/CadastroUsuarios.php">
                            Nova conta                            
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>