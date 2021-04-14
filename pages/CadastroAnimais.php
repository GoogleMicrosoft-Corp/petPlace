<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Cadastro de Animais</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="../css/master.css">
    <link rel="stylesheet" type="text/css" href="../css/layout.css">
</head>

<body>
    <div><?php include('header.php'); ?></div>


    <?php

    $var = $_SESSION['nome'];
    include('view/conn.php');
    $conn = new conexao;
    include('view/binarios.php');

    if (isset($_POST["Cadastro"])) {
        if ($_POST["Cadastro"] == 2) {
            $conn->UPDATERETURN(" UPDATE USUARIOS SET NOME = '" . $_POST["Nome"] . "'  WHERE USUARIOS_ID = " . $_SESSION['id']);
            $_SESSION['nome'] = $_POST["Cadastro"];
            header("Location: CadastroUsuarios.php");
        } else {
            $conn->UPDATERETURN("insert into PetsPerdidos values ('" . utf8_decode($_POST["NomePet"]) . "', '" . $_POST["TipoPet"] . "', '" . $_POST["txtSexoPet"] . "', '" . $_POST["IdadePet"] . "', '" . utf8_decode($_POST["DescPet"]) . "', '" . $_SESSION['id'] . "', GETDATE())");

            $_SESSION['nome'] = $_POST["Cadastro"];
            header("Location: CadastroAnimais.php");
        }
    }
    ?>

    <form method="post" enctype="multipart/form-data">
        <fieldset class="fieldset-center lheigth">
            <legend>Cadastro de Animais Perdidos</legend>
            <div style="width: 45%; display: inline-block;">
                <label for="txtNomePet">Nome do Pet</label><br>
                <input id="txtNomePet" name="NomePet" type="text" class="normalizadorlayout">
            </div>

            <div>
                <label for="ddlTipoPet">Tipo de Pet</label><br>
                <select class="normalizadorlayout" id="ddlTipoPet" name="TipoPet">
                    <option value="">Selecione</option>
                    <option value="1">Gato</option>
                    <option value="2">Cachorro</option>
                    <option value="3">Tartaruga</option>
                    <option value="4">Peixe</option>
                </select>
            </div>

            <div>
                <label for="txtSexoPet">Sexo</label><br>
                <input id="txtSexoPet1" name="txtSexoPet" type="radio" value="M">
                <label for="txtSexoPet1">Macho</label>
                <input id="txtSexoPet2" name="txtSexoPet" type="radio" value="F">
                <label for="txtSexoPet2">Fêmea</label>
            </div>

            <div>
                <label for="txtIdadePet">Idade</label><br>
                <input class="normalizadorlayout" id="txtIdadePet" name="IdadePet" type="number" min="0">
            </div>

            <div>
                <label for="DescPet">Descrição</label><br>
                <textarea class="normalizadorlayout" id="DescPet" name="DescPet" rows="3" cols="33"></textarea>
            </div>
            <div>
                <label for="imgPet">Cadastre Aqui uma foto do seu PET</label><br>
                <input id="imgPet" name="imgPet" type="file">
            </div>

            <div>
                <button name="Cadastro" class="btn_" type="submit">Cadastrar</button>
            </div>

        </fieldset>
    </form>
</body>

</html>