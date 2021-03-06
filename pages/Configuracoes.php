<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>PreferĂȘcias</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="../css/master.css">
    <link rel="stylesheet" type="text/css" href="../css/layout.css">

    <script type="text/javascript">
        function BGCOLOR(){
            console.log(document.getElementById('cor1').value);

            var cor1 = document.getElementById('cor1').value;
            var cor2 = document.getElementById('cor2').value;
            document.getElementById('divcor').style.background='linear-gradient(-135deg, '+cor2+', '+cor1+')';
        }

    </script>

</head>

<body onload="BGCOLOR()">
    <div><?php include('header.php'); ?></div>

    <?php
        $value1 ='';
        $value2 ='';
        if(isset($_SESSION['id'])){
            $pref = $conn -> SelectReturn("SELECT * FROM CONFIGURACOES WHERE USUARIO_ID = " . $_SESSION['id'] );	
            if (count($pref) > 1)
            {
                $value1 = $pref[1][1];
                $value2 = $pref[1][2];
            }
        }
    ?>


    <?php
        if(!isset($_SESSION['id'])){
            header("Location: ../index.php");
        }

        if (isset($_POST["Cadastropublicidades"])) {
            if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
                include('view/binarios.php');
                $filename = $_FILES["photo"]["tmp_name"];  
                $out = ImgParaBase64($filename);
                
                $conn -> UPDATERETURN("INSERT INTO PUBLICIDADE (IMAGEM) values ('" . $out . "')");     
                //header("Location: Publicacoes.php");  
                
            }
        }

        if (isset($_POST["Cadastroespecie"])) {
            if(isset($_POST['especie'])){
                if ($_POST['especie'] != ''){
                    $conn->UPDATERETURN("INSERT INTO ESPECIE VALUES ('".strtoupper($_POST['especie'])."')");
                    header("Location: Publicacoes.php");  
                }
            }
        }

        if (isset($_POST["Cadastro"])) {
                $conn->UPDATERETURN("DELETE CONFIGURACOES WHERE USUARIO_ID = ".$_SESSION['id']);
                $conn->UPDATERETURN("INSERT INTO CONFIGURACOES VALUES ('".$_POST['cor1']."','".$_POST['cor2']."', ". $_SESSION['id'] .")");
                header("Location: Publicacoes.php");        
        }
    ?>
    <form method="post" enctype="multipart/form-data">
        <fieldset class="fieldset-center lheigth">
            <legend>PreferĂȘncias</legend>
            <div>
                <div style="display: inline-block;">
                    <label for="cor1">Cor 1</label><br>
                    <input type="color" id="cor1" onchange="BGCOLOR();"  name="cor1" 
                    value="<?php
                    if ($value1 == ''){
                        echo '#03A865';
                    }
                    else{
                        echo $value1;
                    }
                    ?>">
                </div>
                <div style="display: inline-block;">
                    <label for="cor2">Cor 2</label><br>
                    <input type="color" id="cor2" onchange="BGCOLOR();" name="cor2" 
                    value="<?php
                    if ($value2 == ''){
                        echo '#066355';
                    }
                    else{
                        echo $value2;
                    }
                    ?>"
                    >
                </div>
            </div>
            <br/>
            <div id="divcor" style="display: inline-block; width: 100%; height: 50px ; border: 1px solid black">
                <p style="color: #fff" >Cor Selecionada</p>
            </div>
            <br/><br/>
            <div>
                <button name="Cadastro" class="btn_" type="submit">Salvar</button>
            </div>
            <hr>
            <div>
                <label for="txtNomePet">Cadastrar Nova Especie: </label>
                <input id="txtNomePet" name="especie" type="text" class="normalizadorlayout">
            </div>
           
            <div>
                <button name="Cadastroespecie" class="btn_" type="submit">Cadastar</button>
            </div>
            <hr>
            <br/>
            <div>
                    <label for="imgPet">Cadastre aqui as marcas e publicidades: </label><br>
                    <input id="imgPet" class="normalizadorlayout" name="photo" type="file" accept="image/*">
                </div>
           
            <div>
                <button name="Cadastropublicidades" class="btn_" type="submit">Cadastar</button>
            </div>
            <hr>
            <br/>

        </fieldset>
    </form>
</body>

</html>