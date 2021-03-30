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
            <legend>Cadastro de Pets</legend>
            <div style="width: 45%; display: inline-block;">
                <div>
                    <label for="txtNomePet">Nome do Seu Pet: </label>
                    <input id="txtNomePet" name="NomePet" type="text" class="normalizadorlayout">
                </div>
            
                <div>
                    <label for="ddlTipoPet">Espécie:</label>
                    <select class="normalizadorlayout" id="ddlTipoPet" name="TipoPet">
                        <option value="">Selecione</option>
                        <option value="1">Cachorro</option>
                        <option value="2">Gato</option>
                        <option value="3">Papagaio</option>
                        <option value="4">Periquito</option>
                        <option value="5">Camundongo</option>
                      </select>
                </div>  
                <div>
                    <label for="txtSexoPet">Sexo: </label>
                    <input id="txtSexoPet1" name="txtSexoPet" type="radio" value="M">
                    <label for="txtSexoPet1">Macho</label>
                    <input id="txtSexoPet2" name="txtSexoPet" type="radio" value="F">
                    <label for="txtSexoPet2">Fêmea</label>            
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
                    <label for="imgPet">Cadastre Aqui a Foto de Perfil do seu PET</label><br>
                    <input id="imgPet" name="imgPet" type="file">
                </div>
                <br>
                <div>
                    <button class="btn_" type="submit">Cadastrar PET</button>
                </div>
            </div>
            <div style="width: 45%; display: inline-block;  min-height: 300px !important" class="fieldset-center">
                <div style="margin: 0 10px;">
                   <h4>Exemplos de descrição:</h4>
                   <p>1 - O meu pet tem problemas nas patas da esquerda e requer cuidado especial</p>   
                   <hr/>
                   <p>2 - O meu pet gosta muito de carinho</p>   
                </div>
            </div>

        </fieldset>
    </form>
    <!--<div><?php include('footer.php');?></div>-->
   </body>
</html>

