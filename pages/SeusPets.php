<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Seus Pets</title>
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
            <legend>Seus Pets</legend>

            <div style="display: -webkit-box;display: -webkit-flex;
                        display: -moz-box;display: -ms-flexbox;display: flex;
                        flex-wrap: wrap;justify-content: center;align-items: center; width: 100%; margin: 20px; margin-bottom: -28px">
                <button  onclick="redirpage();" class="btn_" style="width: 20%;" type="button">Novo Pet</button>
            </div>
            <hr>
            <div style="display: -webkit-box;display: -webkit-flex;
                        display: -moz-box;display: -ms-flexbox;display: flex;
                        flex-wrap: wrap;justify-content: center;align-items: center; width: 100%">

                <?php
                    if(!isset($_SESSION['id'])){
                        header("Location: ../index.php");
                    }

                    //include('view/conn.php');
                    //$conn = new conexao;
                    $pet = $conn -> SelectReturn("SELECT * FROM PETS WHERE DOADOR_ID = " . $_SESSION['id'] );                        
                        
                    if (count($pet) > 1)
                    { 
                        for ($i = 1; $i < count($pet); $i++)
                        {
                            $especie ='';
                            if($pet[$i ][2] == '1'){$especie = 'CACHORRO';}
                            else if($pet[$i ][2] == '2'){$especie = 'GATO';}
                            else if($pet[$i ][2] == '3'){$especie = 'PAPAGAIO';}
                            else if($pet[$i ][2] == '4'){$especie = 'PERIQUITO';}
                            else if($pet[$i ][2] == '5'){$especie = 'CAMUNDONGO';}

                            $idpet = "CadastrarPet.php?idpet=" . $pet[$i][0];

                            $petperfil = $conn -> SelectReturn("SELECT * FROM IMAGEM_PET WHERE ATUAL = 'S' AND PET_ID = " . $pet[$i][0] );
                               
                            if (count($petperfil) > 1)
                            {
                                echo '<div class="card" onclick="window.location.href = \''. $idpet .' \' ">
                                        <img 
                                        src="data:image/jpg;base64,' . $petperfil[1][2] . '"
                                        alt="Avatar" style="width: 100%; height: 230px; border-radius:  10px;
                                        object-fit: cover; object-position: center;">
                                        <hr>
                                        <div class="container" style="text-align: center;">
                                            <h4><b>'. $pet[$i][1] . '</b></h4>
                                            <p>'. $especie .'</p>
                                        </div>
                                    </div>';
                            }
                            else
                            {
                                echo '<div class="card" onclick="window.location.href = \''. $idpet .' \' ">
                                <img src="../images/doge.jpg" alt="Avatar" style="width: 100%; height: 230px; border-radius: 10px;
                                object-fit: cover; object-position: center;">
                                <hr>
                                <div class="container" style="text-align: center;">
                                    <h4><b>'. $pet[$i][1] . '</b></h4>
                                    <p>'. $especie .'</p>
                                </div>
                            </div>';
                            }
                        }
                    }
                    else{ 
                        echo '<div class="card">
                                <div class="container" style="text-align: center;">
                                    <h4><b>Não possui Pets cadastrados</b></h4>
                                </div>
                            </div>';
                    }
                ?>
            </div>
        </fieldset>
    </form>
</body>

</html>