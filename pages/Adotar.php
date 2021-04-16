<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Notificações</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="../css/master.css">
    <link rel="stylesheet" type="text/css" href="../css/layout.css">
    <script type="text/javascript">
        function redirpage(){
            window.location.href ='CadastrarPet.php';
        }
    </script>

</head>

<body>
    <div><?php include('header.php'); ?></div>

    <?php
        if (isset($_POST["aceitar"]))
        {                          
            $USER = $conn -> SelectReturn("SELECT * FROM ADOTAR WHERE ADOTAR_ID = " . $_POST["aceitar"]); 
            $interessado3 = $conn -> SelectReturn("SELECT * FROM USUARIOS WHERE  USUARIOS_ID = " . $USER [1][3] );
            $interessado4 = $conn -> SelectReturn("SELECT * FROM USUARIOS WHERE  USUARIOS_ID = " . $USER [1][4] );

            $POST_SELECT = $conn -> SelectReturn("SELECT * FROM POST WHERE POST_ID = " . $USER[1][2]);
            $conn -> UPDATERETURN("UPDATE ADOTAR SET STATUS_PET = 'S' WHERE ADOTAR_ID = " .$_POST["aceitar"]); 
            $conn -> UPDATERETURN("DELETE POST  WHERE POST_ID = " .$POST_SELECT[1][0]);             

            $conn -> UPDATERETURN("INSERT INTO CONTRATO (POST_ID, PET_ID, USUARIO_ANTIGO_ID, USUARIO_NOVO_ID, 
            DESCRICAO, IMAGEM, DATA_CONTRATO, NOME, NOME1, CPF, CPF1) 
            VALUES(
            ".$POST_SELECT[1][0].",".$POST_SELECT[1][1].",".$USER [1][3].",".$USER [1][4].",
            '".$POST_SELECT[1][3]."','".$POST_SELECT[1][5]."',GETDATE(),'".$interessado3[1][1]."',
            '".$interessado4[1][1]."','".$interessado3[1][4]."','".$interessado4[1][4]."')");

            $conn -> UPDATERETURN("UPDATE PETS SET DOADOR_ID = " . $USER[1][4] ."  WHERE PET_ID = " .$USER[1][1]);
        }  
        else if (isset($_POST["negar"]))
        {       
            $conn -> UPDATERETURN("DELETE ADOTAR WHERE  ADOTAR_ID = ".$_POST["negar"]);  
            header("Location: Adotar.php");  
            exit();
        }            
    ?>

    <form method="post" enctype="multipart/form-data">
        <fieldset class="fieldset-center lheigth">
            <legend>Últimas Interações</legend>
            
            <div style="display: -webkit-box;display: -webkit-flex;
                        display: -moz-box;display: -ms-flexbox;display: flex;
                        flex-wrap: wrap;justify-content: center;align-items: center; width: 100%">

                <?php
                    if(!isset($_SESSION['id'])){
                        header("Location: ../index.php");
                    }

                    $adot = $conn -> SelectReturn("SELECT * FROM ADOTAR WHERE STATUS_PET = 'N' AND DONO_ID = " . $_SESSION['id'] );                        
                        
                    if (count($adot) > 1)
                    { 
                        for ($i = 1; $i < count($adot); $i++)
                        {
                            $petperfil = $conn -> SelectReturn("SELECT * FROM IMAGEM_PET WHERE ATUAL = 'S' AND PET_ID = " . $adot[$i][1] );
                            $petperfil2 = $conn -> SelectReturn("SELECT * FROM PETS WHERE PET_ID = " . $adot[$i][1] );
                            $interessado = $conn -> SelectReturn("SELECT * FROM IMAGEM_USUARIO WHERE  USUARIOS_ID = " . $adot[$i][4] );
                            $interessado2 = $conn -> SelectReturn("SELECT * FROM USUARIOS WHERE  USUARIOS_ID = " . $adot[$i][4] );

                            if (  (count($petperfil) > 1) && (count($interessado) > 1) )
                            {
                                echo '<div style="width: 100%;  height: 70px;padding: 0;
                                    display: -webkit-box;display: -webkit-flex;
                                    display: -moz-box;display: -ms-flexbox;display: flex;
                                    flex-wrap: wrap;justify-content: center;align-items: center; width: 100%;"> 
                                
                                    <img style="height: 60px; width: 60px;border-radius: 
                                                50%;object-fit: cover;object-position: center;" 
                                    src="data:image/jpg;base64,' . $interessado[1][2] . '" /> 
                                    <img style="height: 60px; width: 60px;border-radius: 
                                                50%;object-fit: cover;object-position: center;" 
                                    src="data:image/jpg;base64,' . $petperfil[1][2] . '" /> 
                                    <p>'.$interessado2[1][1].' deseja adotar '.$petperfil2[1][1].'<p/>
                                    <button name="aceitar" class="btnA_" type="submit" 
                                    value="'.$adot[$i][0].'">Aceitar</button>
                                    <button name="negar" class="btnA_" style="background: red;" type="submit" 
                                    value="'.$adot[$i][0].'">Negar</button>

                                    </div>
                                    <hr>
                                    <br/>';
                            }
                            
                        }
                    }
                    else{ 
                        echo '<div class="card">
                                <div class="container" style="text-align: center;">
                                    <h4><b>Não possui solicitações pendentes</b></h4>
                                </div>
                            </div>';
                    }
                ?>
            </div>
        </fieldset>
    </form>
</body>

</html>