<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Publicações</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="../css/master.css">
    <link rel="stylesheet" type="text/css" href="../css/layout.css">
    <script type="text/javascript">
        function redirpage(){
            window.location.href ='CadastroPublicacoes.php';
        }
    </script>

</head>

<body>
    <div><?php include('header.php'); ?></div>


    <form method="post" enctype="multipart/form-data">
        <fieldset class="fieldset-center lheigth">
            <legend>Publicações</legend>

            <div style="display: -webkit-box;display: -webkit-flex;
                        display: -moz-box;display: -ms-flexbox;display: flex;
                        flex-wrap: wrap;justify-content: center;align-items: center; width: 100%; margin: 20px; margin-bottom: -28px">
                <button  onclick="redirpage();" class="btn_" style="width: 20%;" type="button">Publicar</button>
            </div>
            <hr>
            
        </fieldset>
    </form>
</body>

</html>