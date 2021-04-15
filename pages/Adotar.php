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

                    $adot = $conn -> SelectReturn("SELECT * FROM ADOTAR WHERE DONO_ID = " . $_SESSION['id'] );                        
                        
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
                                    <button name="Aceitar" class="btnA_" type="submit" 
                                    value="">Aceitar</button>
                                    <button name="Negar" class="btnA_" style="background: red;" type="submit" 
                                    value="">Negar</button>

                                    </div>
                                    <hr>
                                    <br/>';
                            }
                            
                        }
                    }
                ?>
            </div>
        </fieldset>
    </form>
</body>

</html>