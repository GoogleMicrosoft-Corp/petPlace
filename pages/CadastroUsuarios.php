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
    </script>
</head>

<body>
    <div><?php include('header.php'); ?></div>
    <?php

    //if(!isset($_SESSION['id'])){
    //    header("Location: ../index.php");
    //}

    //$var = $_SESSION['nome'];
    //include('view/conn.php');
    include('view/binarios.php');
    //$conn = new conexao;

    function inserefoto(){
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        $filename = $_FILES["photo"]["tmp_name"];  
        $out = ImgParaBase64($filename);
        $conn2 = new conexao;

        if (isset($_SESSION['id']))
        {
            $conn2->UPDATERETURN("DELETE IMAGEM_USUARIO WHERE USUARIOS_ID = " . $_SESSION['id']  );
            $conn2->UPDATERETURN("INSERT INTO IMAGEM_USUARIO (USUARIOS_ID, DADOS , TIPO) values (". $_SESSION['id'] ." , '" . $out . "' , 'jpg' )");
        }
        else {
            $max = $conn2 -> SelectReturn("SELECT MAX(USUARIOS_ID) AS ID from USUARIOS");
            $idnovo = '';
            if (count($max) > 1)
            {
                $idnovo = $max[1][0];
            }
            else {
                $idnovo = 1;
            }
            //$conn->UPDATERETURN("DELETE IMAGEM_USUARIO WHERE USUARIOS_ID = " . $idnovo  );
            $conn2->UPDATERETURN("INSERT INTO IMAGEM_USUARIO (USUARIOS_ID, DADOS , TIPO) values (". $idnovo ." , '" . $out . "' , 'jpg' )");
     

        }

    }
}

    if (isset($_POST["Cadastro"])) {
        if ($_POST["Cadastro"] == 2) {
            $conn->UPDATERETURN(" UPDATE USUARIOS SET NOME = '" . $_POST["Nome"] . "'  WHERE USUARIOS_ID = " . $_SESSION['id']);
            if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
                inserefoto();
            }
            header("Location: CadastroUsuarios.php");
        } else {
            $conn->UPDATERETURN("insert into usuarios values ('" . utf8_decode($_POST["Nome"]) . "', '" . $_POST["Email"] . "', '" . $_POST["Senha"] . "', '" . $_POST["cpf"] . "', '" . $_POST["Telefone"] . "', '" . utf8_decode($_POST["Desc"]) . "', '" . $_POST["Endereço"] . "')");
            inserefoto();
            $maxid = $conn -> SelectReturn("SELECT MAX(USUARIOS_ID) AS ID from USUARIOS");
            $_SESSION['id'] = $maxid[1][0];
            header("Location: CadastroUsuarios.php");
        }
    } 
    
    ?>

    <?php  
    if (isset($_SESSION['id'])){
        $userperfil = $conn -> SelectReturn("SELECT * FROM IMAGEM_USUARIO WHERE USUARIOS_ID = " . $_SESSION['id'] );   

        if (count($userperfil) > 1){
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
                value="<?php if (isset($_SESSION['nome'])){echo $_SESSION['nome'];}else{echo '';}?>">
            </div>

            <div>
                <label for="txtEmail">E-mail</label><br>
                <input id="txtEmail" name="Email" type="text" class="normalizadorlayout width95porcem"
                value="<?php if (isset($_SESSION['email'])){echo $_SESSION['email'];}else{echo '';}?>">
            </div>

            <div style="display: inline-block;">
                <label for="txtCPF">CPF</label><br>
                <input id="txtCPF" type="text" name="cpf" onkeydown="javascript: Masc( this, CPF );" class="normalizadorlayout">
            </div>

            <div style="display: inline-block;">
                <label for="txtTelefone">Telefone</label><br>
                <input id="txtTelefone" name="Telefone" type="txt" onkeydown="javascript: Masc( this, Tel );" class="normalizadorlayout">
            </div>

            <div style="display: inline-block;">
                <label for="txtSenha">Senha</label><br>
                <input id="txtSenha" name="Senha" type="password" class="normalizadorlayout">
            </div>

            <div>
                <label for="txtEnd">Endereço</label><br>
                <input id="txtEnd" name="Endereço" type="txt" class="normalizadorlayout width95porcem">
            </div>

            <div>
                <label for="DescPet">Descrição</label><br>
                <textarea class="normalizadorlayout width95porcem" id="Desc" name="Desc" rows="3" cols="33"></textarea>
            </div>
            <div>
                <label for="imgPet">Insira sua foto</label><br>
                <input id="imgPet" class="normalizadorlayout" name="photo" type="file" accept="image/*">
            </div>

            <div>
                <button name="Cadastro" class="btn_" type="submit" 
                value="<?php if ($_SESSION['id'] == "") 
                {
                    echo 1;
                } else {
                    echo 2;
                } ?>">Cadastrar</button>
            </div>
        </fieldset>
    </form>
</body>

</html>