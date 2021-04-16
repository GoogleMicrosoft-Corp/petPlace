<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Cadastro de Pet</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="../css/master.css">
    <link rel="stylesheet" type="text/css" href="../css/layout.css">
    <script type="text/javascript">
        function abremodal() {
            document.getElementById("myModal").style.display = "block";
        }
        function fechamodal() {
            document.getElementById("myModal").style.display = "none";
        }
    </script>
</head>

<body>
    <div><?php include('header.php'); ?></div>
    <?php
        
        if(isset($_GET["idpet"])){
            $dadospet = $conn -> SelectReturn("SELECT * FROM PETS WHERE PET_ID = " . $_GET["idpet"]); 
        }
    ?>

    <div id="myModal"  class="modal">
        <div onclick="fechamodal();" class="modal-content">
            <span onclick="fechamodal();" class="close">&times;</span>
            <p onclick="fechamodal();">Preencha todos os campos e insira uma foto!</p>
        </div>
    </div>
    <?php
        echo "<script> fechamodal(); </script>";
    ?>

    <?php
    include('view/binarios.php');
    function inserefoto($id)
    {
        $conn2 = new conexao;
        if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
            $filename = $_FILES["photo"]["tmp_name"];
            $out = ImgParaBase64($filename);

            $conn2->UPDATERETURN("UPDATE IMAGEM_PET SET ATUAL='N' WHERE PET_ID = " . $id);
            $conn2->UPDATERETURN("INSERT INTO IMAGEM_PET (PET_ID, DADOS , TIPO, ATUAL) values (" . $id .
                " , '" . $out . "' , 'jpg' , 'S')");
        }
    }
    if (isset($_POST["Cadastro"])) {
        if (isset($_GET["idpet"])) {
            if (!($_POST["NomePet"] == ''
            || $_POST["TipoPet"] == ''
            || $_POST["txtSexoPet"] == ''
            || $_POST["IdadePet"] == ''
            || $_POST["DescPet"] == ''           
            )) {
                $conn->UPDATERETURN("UPDATE PETS SET NOME_PET = '".$_POST["NomePet"]."' ,
                TIPO_PET = '".$_POST["TipoPet"]."',
                SEXO = '".$_POST["txtSexoPet"]."',
                IDADE = '".$_POST["IdadePet"]."',
                DESCRICAO = '".$_POST["DescPet"]."'                    
                WHERE PET_ID = " . $_GET["idpet"]);
                if (isset($_FILES["photo"])){
                    inserefoto($_GET["idpet"]);  
                }
                header("Location: SeusPets.php");
            }
        } else {
            if (!($_POST["NomePet"] == ''
            || $_POST["TipoPet"] == ''
            || $_POST["txtSexoPet"] == ''
            || $_POST["IdadePet"] == ''
            || $_POST["DescPet"] == ''
            || !isset($_FILES["photo"])
            )) {
                $conn->UPDATERETURN("insert into PETS values ('" . utf8_decode($_POST["NomePet"]) . "', '" 
                . $_POST["TipoPet"] . "', '" . $_POST["txtSexoPet"] . "', '" 
                . $_POST["IdadePet"] . "', '" . utf8_decode($_POST["DescPet"]) . "', '" 
                . $_SESSION['id'] . "')");
                $max = $conn->SelectReturn("SELECT MAX(PET_ID) AS ID from PETS");
                if (count($max) > 1) {
                    inserefoto($max[1][0]);
                }
                header("Location: SeusPets.php");
            } else {
                echo "<script> abremodal(); </script>";
            }
        }
    }
    ?>  
    
    <form method="post" enctype="multipart/form-data">
        <fieldset class="fieldset-center lheigth">
            <legend>Cadastro de Pets</legend>
            <div style="width: 45%; display: inline-block;">
                <div>
                    <label for="txtNomePet">Nome do Seu Pet: </label>
                    <input id="txtNomePet" name="NomePet" type="text" class="normalizadorlayout"
                    value="<?php 
                    if(isset($_GET["idpet"])){
                        echo $dadospet[1][1];
                    }?>"
                    >
                </div>

                <div>
                    <label for="ddlTipoPet">Espécie:</label>
                    <select class="normalizadorlayout" id="ddlTipoPet" name="TipoPet">
                        <?php
                        $pet = $conn->SelectReturn("SELECT * from ESPECIE");
                        
                        echo '<option value="">Selecione</option>';
                        if (count($pet) > 1) {
                            for ($i = 1; $i < count($pet); $i++) {                                
                                if(isset($_GET["idpet"])){
                                    if ($pet[$i][0] == $dadospet[1][2]){
                                        echo '<option selected value="' . $pet[$i][0] . '">' . $pet[$i][1] . '</option>';
                                    }
                                    else{
                                        echo '<option value="' . $pet[$i][0] . '">' . $pet[$i][1] . '</option>';
                                    }
                                }
                                else{
                                    echo '<option value="' . $pet[$i][0] . '">' . $pet[$i][1] . '</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="txtSexoPet">Sexo: </label>
                    <input id="txtSexoPet1" name="txtSexoPet" 
                    <?php

                    if(isset($_GET["idpet"])){
                        if($dadospet[1][3] =='M'){
                            echo  'CHECKED';
                        }
                    } ?> 
                    
                    type="radio" value="M">
                    <label for="txtSexoPet1">Macho</label>
                    <input id="txtSexoPet2" name="txtSexoPet" <?php
                    
                    if(isset($_GET["idpet"])){
                        if($dadospet[1][3] =='F'){
                            echo  'CHECKED';
                        }
                    } ?> type="radio" value="F">
                    <label for="txtSexoPet2">Fêmea</label>
                </div>
                <div>
                    <label for="txtIdadePet">Idade:</label>
                    <input class="normalizadorlayout" id="txtIdadePet" name="IdadePet" type="number" min="0"
                    value="<?php 
                    if(isset($_GET["idpet"])){
                        echo $dadospet[1][4];
                    }?>"
                    >
                </div>
                <div>
                    <label for="DescPet">Descrição:</label><br>
                    <textarea class="normalizadorlayout" id="DescPet" name="DescPet" rows="3" cols="33"
                    ><?php
                            if(isset($_GET["idpet"])){
                            echo $dadospet[1][5];}
                        ?></textarea>
                </div>
                <div>
                    <label for="imgPet">Cadastre Aqui a Foto de Perfil do seu PET</label><br>
                    <input id="imgPet" class="normalizadorlayout" name="photo" type="file" accept="image/*">
                </div>
                <br>
                <div>
                    <button name="Cadastro" class="btn_" type="submit" >Cadastrar</button>
                </div>
            </div>
            <div style="width: 45%; display: inline-block;  min-height: 300px !important" class="fieldset-center">
                <div style="margin: 0 10px;">
                    <h4>Exemplos de descrição:</h4>
                    <p>1 - O meu pet tem problemas nas patas da esquerda e requer cuidado especial</p>
                    <hr />
                    <p>2 - O meu pet gosta muito de carinho</p>
                </div>
            </div>
        </fieldset>
    </form>
</body>

</html>