<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Postagem de animais perdidos</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="../css/master.css">
    <link rel="stylesheet" type="text/css" href="../css/layout.css">
</head>

<body>
    <div><?php include('header.php'); ?></div>
    <?php
    //$var = $_SESSION['nome'];
    //include('view/conn.php');
    //$conn = new conexao;
    include('view/binarios.php');

    function inserefoto($id){
        $conn2 = new conexao;
        if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0)
        {
            $filename = $_FILES["photo"]["tmp_name"];  
            $out = ImgParaBase64($filename);
            
            $conn2->UPDATERETURN("UPDATE IMAGEM_PET SET ATUAL='N' WHERE PET_ID = " . $id  );
            $conn2->UPDATERETURN("INSERT INTO IMAGEM_PET_PERDIDO (PET_ID, DADOS , TIPO, ATUAL) values (". $id .
            " , '" . $out . "' , 'jpg' , 'S')");            
        }
    }
    if (isset($_POST["Cadastro"])) 
    {      
        $fil= $_FILES["photo"]["tmp_name"];
        $out2 = ImgParaBase64($fil);  

        if (!($_POST["NomePet"] == ''
            || $_POST["TipoPet"] == ''
            || $_POST["txtSexoPet"] == ''
            || $_POST["IdadePet"] == ''
            || $_POST["DescPet"] == '') &&  $out2 != 'null' ) 
        {  
            $conn->UPDATERETURN("insert into PETS_PERDIDOS values ('" . $_POST["NomePet"] . "', '" . $_POST["TipoPet"] . "', '" . $_POST["txtSexoPet"] . "', '" . $_POST["IdadePet"] . "', '" . $_POST["DescPet"] . "', '" . $_SESSION['id'] . "')");
            $max = $conn -> SelectReturn("SELECT MAX(PET_ID) AS ID from PETS_PERDIDOS");            
            if (isset($_FILES["photo"]))
            { 
                inserefoto($max[1][0]);
            }
            header("Location: Publicacoes.php");
        }
        else{
            echo "<script> alert('Preencha todos os campos e insira uma foto!'); </script>";
        } 

    } 
    ?>
    <form method="post" enctype="multipart/form-data">
        <fieldset class="fieldset-center lheigth">
            <legend>Postagem de Animais desaparecidos</legend>
            <div style="width: 45%; display: inline-block;">
                <div>
                    <label for="txtNomePet">Nome do Seu Pet: </label>
                    <input id="txtNomePet" name="NomePet" type="text" class="normalizadorlayout">
                </div>

                <div>
                    <label for="ddlTipoPet">Esp??cie:</label>
                    <select class="normalizadorlayout" id="ddlTipoPet" name="TipoPet">
                        <?php
                            $pet = $conn -> SelectReturn("SELECT * from ESPECIE");   
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
                    <label for="txtSexoPet">Sexo: </label>
                    <input id="txtSexoPet1" name="txtSexoPet" type="radio" value="M">
                    <label for="txtSexoPet1">Macho</label>
                    <input id="txtSexoPet2" name="txtSexoPet" type="radio" value="F">
                    <label for="txtSexoPet2">F??mea</label>
                </div>
                <div>
                    <label for="txtIdadePet">Idade:</label>
                    <input class="normalizadorlayout" id="txtIdadePet" name="IdadePet" type="number" min="0">
                </div>
                <div>
                    <label for="DescPet">Descri????o:</label><br>
                    <textarea class="normalizadorlayout" id="DescPet" name="DescPet" rows="3" cols="33"></textarea>
                </div>
                <div>
                    <label for="imgPet">Cadastre Aqui a Foto de Perfil do seu PET</label><br>
                    <input id="imgPet" class="normalizadorlayout" name="photo" type="file" accept="image/*">
                </div>
                <br>
                <div>
                    <button name="Cadastro" class="btn_" type="submit">Cadastrar</button>
                </div>
            </div>
            <div style="width: 45%; display: inline-block;  min-height: 300px !important" class="fieldset-center">
                <div style="margin: 0 10px;">
                    <h4>Descri????o</h4>
                    <p>Busque informar dados para facilitar a localiza????o de seu pet</p>
                    <hr />
                    <p>Busque informar sobre o comportamente e os cuidados para tomar com seu pet</p>
                </div>
            </div>

        </fieldset>
    </form>
</body>

</html>