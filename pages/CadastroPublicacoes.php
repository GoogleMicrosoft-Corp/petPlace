<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Nova Publicação</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="../css/master.css">
    <link rel="stylesheet" type="text/css" href="../css/layout.css">
</head>

<body>
    <div><?php include('header.php'); ?></div>

    <?php

    //include('view/conn.php');
    //$conn = new conexao;
    include('view/binarios.php');


    function inserefoto(){
        if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0)
        {
            $filename = $_FILES["photo"]["tmp_name"];  
            $out = ImgParaBase64($filename);            
            return "'".$out."'";
        }
        return "null";
    }


    if (isset($_POST["Cadastro"])) {
        $fil= $_FILES["photo"]["tmp_name"];
        $out2 = ImgParaBase64($fil);  
        if (!($_POST["TipoPet"] == ''
        || $_POST["DescPet"] == '') &&  $out2 != 'null' ) 
        { 
            $conn->UPDATERETURN(@"INSERT INTO POST(PET_ID, USUARIO_ID, DESCRICAO, STATUS_PUBLICACAO, IMAGEM , TIPO_IMAGEM 
            , DATA) VALUES(".$_POST["TipoPet"]."  , ".$_SESSION['id']." ,'".$_POST["DescPet"]."','PENDENTE',".inserefoto().",'jpg',GETDATE())");
            header("Location: Publicacoes.php");
        }
        else{
            echo "<script> alert('Preencha todos os campos e insira uma foto!'); </script>";
        } 
    }
    
    
    ?>



    <form method="post" enctype="multipart/form-data">
        <fieldset class="fieldset-center lheigth">
            <legend>Publicar</legend>
            <div style="width: 95%; display: inline-block;">
                <div>
                    <label for="ddlTipoPet">Selecione seu Pet:</label>
                    <select class="normalizadorlayout" id="ddlTipoPet" name="TipoPet">
                        <?php
                            $pet = $conn -> SelectReturn("SELECT * FROM PETS WHERE DOADOR_ID = " . $_SESSION['id'] );                        
                            
                            echo '<option value="">Selecione</option>';

                            if (count($pet) > 1)
                            { 
                                for ($i = 1; $i < count($pet); $i++)
                                {
                                    echo '<option value="'. $pet[$i][0] .'">'.$pet[$i][1].'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>

                <div>
                    <label for="DescPet">Motivo para doá-lo:</label><br>
                    <textarea class="normalizadorlayout" id="DescPet" name="DescPet" rows="3" cols="33"></textarea>
                </div>
                <div>
                    <label for="imgPet">Insira uma imagem para esta publicação:</label><br>
                    <input id="imgPet" class="normalizadorlayout" name="photo" type="file" accept="image/*">
                </div>
                <br>
                <div>
                    <button name="Cadastro" class="btn_" type="submit">Publicar</button>
                </div>
            </div>
        </fieldset>
    </form>
</body>

</html>