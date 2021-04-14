<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Publicações</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="../css/master.css">
    <link rel="stylesheet" type="text/css" href="../css/layout.css">
    <link rel="stylesheet" type="text/css" href="../css/layoutpublic.css">
    <script type="text/javascript">
        function redirpage(){
            window.location.href ='CadastroPublicacoes.php';
        }

        function sliderAnt(prev, atual, prox){
            if (prev != ""){
                document.getElementById(atual).style.display='none';
                document.getElementById(prev).style.display='block';
            }
        }

        function sliderProx(prev, atual, prox){
            if (prox != ""){
                document.getElementById(atual).style.display='none';
                document.getElementById(prox).style.display='block';
            }
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

            
            <div style="display: -webkit-box;display: -webkit-flex;
                        display: -moz-box;display: -ms-flexbox;display: flex;
                        flex-wrap: wrap;justify-content: center;align-items: center; width: 100%; margin: 20px;
                         ">
                Pets Desaparecidos
                    
                <div style="float: right ;display: -webkit-box;display: -webkit-flex;
                        display: -moz-box;display: -ms-flexbox;display: flex;
                        flex-wrap: wrap;justify-content: center;align-items: center; width: 100%; margin: 20px;">
                    
                    
                    <div id="slider1">  
                    
                        <?php include('ListaAnimaisPerdidos.php'); ?>                                               
                    </div>                    
                </div>
                
                

                
            </div>
            <br/>
            
            <hr>
            <div style="display: -webkit-box;display: -webkit-flex;
                        display: -moz-box;display: -ms-flexbox;display: flex;
                        flex-wrap: wrap;justify-content: center;align-items: center; width: 100%; margin: 20px;
                         margin-bottom: -28px">
                Adote <br/>
            </div>

            <?php include('ListaPublicacoes.php'); ?>
            

        </fieldset>
    </form>
</body>

</html>