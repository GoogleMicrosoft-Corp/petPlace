<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Cadastro de Pet</title>  
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">  
        <link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="../css/master.css">     
        <link rel="stylesheet" type="text/css" href="../css/layout.css">   
   </head>
   <body>
    <div><?php include('header.php');?></div>
    <form>
        <fieldset class="fieldset-center lheigth">
            <legend>Perfil</legend>
            <div style="width: 45%; display: inline-block;">
                <div>
                    <label for="txtNomePet">Alterar seu nome: </label>
                    <input id="txtNomePet" name="NomePet" type="text" class="normalizadorlayout">
                </div>
            
                
                <div>
                    <label for="txtSexoPet">Gênero: </label>
                    <input id="txtSexoPet1" name="txtSexoPet" type="radio" value="M">
                    <label for="txtSexoPet1">Masc</label>
                    <input id="txtSexoPet2" name="txtSexoPet" type="radio" value="F">
                    <label for="txtSexoPet2">Fem</label>            
                </div>
                <div>
                    <label for="txtIdadePet">Idade:</label>
                    <input class="normalizadorlayout" id="txtIdadePet" name="IdadePet" type="number" min="0">
                </div>
                <div>
                    <label for="DescPet">Descrição:</label><br>
                    <textarea class="normalizadorlayout" id="DescPet" name="DescPet" rows="3" cols="33"></textarea>
                </div>
                <div>
                    <label for="imgPet">Insira aqui uma foto sua</label><br>
                    <input id="imgPet" name="imgPet" type="file">
                </div>
                <br>
                <div>
                    <button class="btn_" type="submit">Salvar seu perfil</button>
                </div>
            </div>           

        </fieldset>
    </form>
    <!--<div><?php include('footer.php');?></div>-->
   </body>
</html>

