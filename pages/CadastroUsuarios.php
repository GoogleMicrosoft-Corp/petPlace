<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Cadastro de Usuários</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="../css/master.css">
    <link rel="stylesheet" type="text/css" href="../css/layout.css">
    <script type="text/javascript">
        function Masc(objeto, mascara) {
            obj = objeto
            masc = mascara
            setTimeout("fMascEx()", 1)
        }

        function fMascEx() {
            obj.value = masc(obj.value)
        }

        function Tel(tel) {
            tel = tel.replace(/\D/g, "")
            tel = tel.replace(/^(\d)/, "($1")
            tel = tel.replace(/(.{3})(\d)/, "$1)$2")
            if (tel.length == 9) {
                tel = tel.replace(/(.{1})$/, "-$1")
            } else if (tel.length == 10) {
                tel = tel.replace(/(.{2})$/, "-$1")
            } else if (tel.length == 11) {
                tel = tel.replace(/(.{3})$/, "-$1")
            } else if (tel.length == 12) {
                tel = tel.replace(/(.{4})$/, "-$1")
            } else if (tel.length > 12) {
                tel = tel.replace(/(.{4})$/, "-$1")
            }
            return tel;
        }

        function CPF(cpf) {
            cpf = cpf.replace(/\D/g, "")
            cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2")
            cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2")
            cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2")
            return cpf
        }

        function mCEP(cep) {
            cep = cep.replace(/\D/g, "")
            cep = cep.replace(/^(\d{2})(\d)/, "$1.$2")
            cep = cep.replace(/\.(\d{3})(\d)/, ".$1-$2")
            return cep
        }

        function mNum(num) {
            num = num.replace(/\D/g, "")
            return num
        }

        function alerta(text) {
            alert(text);
        }
    </script>
</head>

<body>
    <div><?php include('header.php'); ?></div>
    <?php

    if (isset($_SESSION['id'])) {
        $dadosuser = $conn->SelectReturn("SELECT * FROM USUARIOS WHERE USUARIOS_ID = " . $_SESSION['id']);
    }

    include('view/binarios.php');


    function inserefoto()
    {
        if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
            $filename = $_FILES["photo"]["tmp_name"];
            $out = ImgParaBase64($filename);
            $conn2 = new conexao;

            if (isset($_SESSION['id'])) {
                $conn2->UPDATERETURN("DELETE IMAGEM_USUARIO WHERE USUARIOS_ID = " . $_SESSION['id']);
                $conn2->UPDATERETURN("INSERT INTO IMAGEM_USUARIO (USUARIOS_ID, DADOS , TIPO) values (" . $_SESSION['id'] . " , '" . $out . "' , 'jpg' )");
            } else {
                $max = $conn2->SelectReturn("SELECT MAX(USUARIOS_ID) AS ID from USUARIOS");
                $idnovo = '';
                if (count($max) > 1) {
                    $idnovo = $max[1][0];
                } else {
                    $idnovo = 1;
                }
                $conn2->UPDATERETURN("INSERT INTO IMAGEM_USUARIO (USUARIOS_ID, DADOS , TIPO) values (" . $idnovo . " , '" . $out . "' , 'jpg' )");
            }
        }
    }

    if (isset($_POST["Cadastro"])) {
        $qtd = $conn->SelectReturn("SELECT * from USUARIOS where email ='" . $_POST["Email"] . "' ");

        if ((count($qtd) > 1) && $_POST["Cadastro"] == '1') {
            echo "<script> alerta('Já existe um usuário cadastrado com esse e-mail em nosso banco de dados!'); </script>";
        } else {
            if ($_POST["Cadastro"] == 2) 
            {
                if (!($_POST["Nome"] == ''
                || $_POST["Email"] == ''
                || $_POST["Senha"] == ''
                || $_POST["cpf"] == ''
                || $_POST["Telefone"] == ''
                || $_POST["Desc"] == ''
                || $_POST["Endereço"] == ''
                ))
                {
                    $conn->UPDATERETURN(" UPDATE USUARIOS SET NOME = '" . $_POST["Nome"] . "' ,
                    EMAIL = '".$_POST["Email"]."',
                    USR_HASH = '".$_POST["Senha"]."',
                    CPF = '".$_POST["cpf"]."',
                    TELEFONE ='".$_POST["Telefone"]."',
                    ENDERECO = '".$_POST["Endereço"]."',
                    DESCRICAO = '".$_POST["Desc"]."'  
                     WHERE USUARIOS_ID = " . $_SESSION['id']);
                    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
                        inserefoto();
                    }
                    header("Location: CadastroUsuarios.php");
                }
                else{
                    echo "<script> alert('Preencha todos os campos!'); </script>";
                }
            } 
            else 
            {
                if (!($_POST["Nome"] == ''
                || $_POST["Email"] == ''
                || $_POST["Senha"] == ''
                || $_POST["cpf"] == ''
                || $_POST["Telefone"] == ''
                || $_POST["Desc"] == ''
                || $_POST["Endereço"] == ''
                || isset($_FILES["photo"])
                ))
                {
                    $conn->UPDATERETURN("INSERT INTO USUARIOS values ('" . $_POST["Nome"] . "', '" . $_POST["Email"] . "', '" . $_POST["Senha"] . "', '" . $_POST["cpf"] . "', '" . $_POST["Telefone"] . "', '" . $_POST["Desc"] . "', '" . $_POST["Endereço"] . "')");
                    inserefoto();
                    $maxid = $conn->SelectReturn("SELECT MAX(USUARIOS_ID) AS ID from USUARIOS");
                    $_SESSION['id'] = $maxid[1][0];
                    header("Location: CadastroUsuarios.php");
                }
                else{
                    echo "<script> alert('Preencha todos os campos e insira uma foto!'); </script>";
                }                
            }
        }
    }
    ?>

    <?php
    if (isset($_SESSION['id'])) {
        $userperfil = $conn->SelectReturn("SELECT * FROM IMAGEM_USUARIO WHERE USUARIOS_ID = " . $_SESSION['id']);
        if (count($userperfil) > 1) {
            echo '
                <div style="width: 100%;  height: 70px;padding: 0;
                            display: -webkit-box;display: -webkit-flex;
                            display: -moz-box;display: -ms-flexbox;display: flex;
                            flex-wrap: wrap;justify-content: center;align-items: center;"> 
                        
                            <img style="height: 60px; width: 60px;border-radius: 
                                        50%;object-fit: cover;object-position: center;" 
                            src="data:image/jpg;base64,' . $userperfil[1][2] . '" /> 
                </div>';
        }
    }
    ?>
    <form method="post" enctype="multipart/form-data">
        <fieldset class="fieldset-center lheigth">
            <legend>Cadastro de Usuários</legend>
            <div>
                <label for="txtNome">Nome</label><br>
                <input id="txtNome" name="Nome" type="text" class="normalizadorlayout width95porcem" 
                value="<?php                  
                if (isset($_SESSION['id'])) {
                    echo $dadosuser[1][1];
                } ?>">
            </div>

            <div>
                <label for="txtEmail">E-mail</label><br>
                <input id="txtEmail" name="Email" type="text" class="normalizadorlayout width95porcem" 
                value="<?php                  
                if (isset($_SESSION['id'])) {
                    echo $dadosuser[1][2];
                } ?>">
            </div>

            <div style="display: inline-block;">
                <label for="txtCPF">CPF</label><br>
                <input id="txtCPF" type="text" name="cpf" onkeydown="javascript: Masc( this, CPF );" 
                class="normalizadorlayout"
                value="<?php                  
                if (isset($_SESSION['id'])) {
                    echo $dadosuser[1][4];
                } ?>"
                >
            </div>

            <div style="display: inline-block;">
                <label for="txtTelefone">Telefone</label><br>
                <input id="txtTelefone" name="Telefone" type="txt" onkeydown="javascript: Masc( this, Tel );" 
                class="normalizadorlayout"
                value="<?php                  
                if (isset($_SESSION['id'])) {
                    echo $dadosuser[1][5];
                } ?>"
                >
            </div>

            <div style="display: inline-block;">
                <label for="txtSenha">Senha</label><br>
                <input id="txtSenha" name="Senha" type="password" 
                class="normalizadorlayout"
                value="<?php                  
                if (isset($_SESSION['id'])) {
                    echo $dadosuser[1][3];
                } ?>"
                >
            </div>

            <div>
                <label for="txtEnd">Endereço</label><br>
                <input id="txtEnd" name="Endereço" type="txt" class="normalizadorlayout width95porcem"
                value="<?php                  
                if (isset($_SESSION['id'])) {
                    echo $dadosuser[1][6];
                } ?>"
                >
            </div>

            <div>
                <label for="DescPet">Descrição</label><br>
                <textarea class="normalizadorlayout width95porcem" id="Desc" name="Desc" rows="3" cols="33"><?php                  
                if (isset($_SESSION['id'])) {
                    echo $dadosuser[1][7];
                } ?></textarea>
            </div>
            <div>
                <label for="imgPet">Insira sua foto</label><br>
                <input id="imgPet" class="normalizadorlayout" name="photo" type="file" accept="image/*">
            </div>

            <div>
                <button name="Cadastro" class="btn_" type="submit" value="<?php if ($_SESSION['id'] == "") {
                                                                                echo 1;
                                                                            } else {
                                                                                echo 2;
                                                                            } ?>">Cadastrar</button>
            </div>
        </fieldset>
    </form>
</body>

</html>