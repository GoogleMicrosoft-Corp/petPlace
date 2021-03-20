<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Pet Place</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
    
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="images/img-01.png" alt="IMG">                    
                </div>
                <?php
                    
                    $login = "123";
                    $senha = "123";

                    if(isset($_POST["login"])){

                        if($_POST["login"] == $login and $_POST["senha"] == $senha){
                            header("Location: pages/master.php");
                            exit();
                        }else{
                            echo "Login ou senha inválido";
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

                    <div class="text-center">
                        <span class="txt1">
                            Esqueceu
                        </span>
                        <a class="txt2" href="#">
                            login ou senha?
                        </a>
                    </div>

                    <div class="text-center padding-50">
                        <a class="txt2" href="#">
                            Nova conta                            
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>