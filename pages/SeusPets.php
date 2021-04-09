<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Seus Pets</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="../css/master.css">
    <link rel="stylesheet" type="text/css" href="../css/layout.css">
</head>

<body>
    <div><?php include('header.php'); ?></div>


    <form method="post" enctype="multipart/form-data">
        <fieldset class="fieldset-center lheigth">
            <legend>Seus Pets</legend>

            <div style="display: -webkit-box;display: -webkit-flex;
                        display: -moz-box;display: -ms-flexbox;display: flex;
                        flex-wrap: wrap;justify-content: center;align-items: center; width: 100%; margin: 20px; margin-bottom: -28px">
                <button name="Cadastro" class="btn_" style="width: 20%;" type="submit">Novo Pet</button>
            </div>

            <hr>

            <div style="display: -webkit-box;display: -webkit-flex;
                        display: -moz-box;display: -ms-flexbox;display: flex;
                        flex-wrap: wrap;justify-content: center;align-items: center; width: 100%">



                <div class="card">
                    <img src="../images/doge.jpg" alt="Avatar" style="width:100%; border-radius: 50%;
                	object-fit: cover; object-position: center;">
                    <hr>
                    <div class="container" style="text-align: center;">
                        <h4><b>Doge</b></h4>
                        <p>Espécie: Cachorro</p>
                    </div>
                </div>
            </div>

            
            <hr>

            



        </fieldset>
    </form>
</body>

</html>