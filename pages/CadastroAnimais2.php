<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastro de Animais</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="../css/CadastroAnimais.css">    
</head>    
   </head>
   <body>
    <div><?php include('header.php');?></div>
    <form>
        <fieldset>
            <legend>Cadastro de Animais Perdidos</legend>
        <div>
            <label for="txtNomePet">Nome do Pet</label><br>
            <input id="txtNomePet" name="NomePet" type="text">
        </div>
		</br>
        <div>
            <label for="ddlTipoPet">Tipo de Pet</label><br>
            <select id="ddlTipoPet" name="TipoPet">
                <option value="">Selecione</option>
                <option value="1">Gato</option>
                <option value="2">Cachorro</option>
                <option value="3">Tartaruga</option>
                <option value="4">Peixe</option>
              </select>
        </div>
		</br>
        <div>
            <label for="txtSexoPet">Sexo</label><br>
            <input id="txtSexoPet1" name="txtSexoPet" type="radio" value="M">
            <label for="txtSexoPet1">Macho</label>
            <input id="txtSexoPet2" name="txtSexoPet" type="radio" value="F">
            <label for="txtSexoPet2">Fêmea</label>            
        </div>
		</br>
        <div>
            <label for="txtIdadePet">Idade</label><br>
            <input id="txtIdadePet" name="IdadePet" type="number" min="0">
        </div>
		</br>
        <div>
            <label for="DescPet">Descrição</label><br>
            <textarea id="DescPet" name="DescPet" rows="5" cols="33"></textarea>
        </div>
        <div>
            <label for="imgPet">Cadastre Aqui uma foto do seu PET</label><br>
            <input id="imgPet" name="imgPet" type="file">
        </div>
        <br>
        <div>
            <button type="submit">Cadastrar</button>
        </div>
    </fieldset>
    </form>
    <div><?php include('footer.php');?></div>
   </body>
</html>

