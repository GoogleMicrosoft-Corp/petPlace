<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastro de Usuários</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="../css/CadastroUsuario.css">
    <script type="text/javascript">
			function Masc(objeto,mascara) {
				obj=objeto
				masc=mascara
				setTimeout("fMascEx()",1)
			}
			function fMascEx() {
				obj.value=masc(obj.value)
			}
			function Tel(tel) {
				tel=tel.replace(/\D/g,"")
				tel=tel.replace(/^(\d)/,"($1")
				tel=tel.replace(/(.{3})(\d)/,"$1)$2")
				if(tel.length == 9) {
					tel=tel.replace(/(.{1})$/,"-$1")
				} else if (tel.length == 10) {
					tel=tel.replace(/(.{2})$/,"-$1")
				} else if (tel.length == 11) {
					tel=tel.replace(/(.{3})$/,"-$1")
				} else if (tel.length == 12) {
					tel=tel.replace(/(.{4})$/,"-$1")
				} else if (tel.length > 12) {
					tel=tel.replace(/(.{4})$/,"-$1")
				}
				return tel;
			}
			function CPF(cpf){
				cpf=cpf.replace(/\D/g,"")
				cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
				cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
				cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
				return cpf
			}
			function mCEP(cep){
				cep=cep.replace(/\D/g,"")
				cep=cep.replace(/^(\d{2})(\d)/,"$1.$2")
				cep=cep.replace(/\.(\d{3})(\d)/,".$1-$2")
				return cep
			}
			function mNum(num){
				num=num.replace(/\D/g,"")
				return num
			}
	</script>
</head>    
   </head>
   <body>
    <div><?php include('header.php');?></div>
    <form>
        <fieldset>
            <legend>Cadastro de Usuários</legend>
        <div>
            <label for="txtNomePet">Nome</label><br>
            <input id="txtNomeUsuario" name="Nome" type="text">
        </div>
		</br>
        <div>
            <label for="txtCPF">CPF</label><br>
            <input id="txtCPF" type="text" name="cpf" onkeydown="javascript: Masc( this, CPF );">
        </div>
        </br>
        <div>
            <label for="txtEmail">E-mail</label><br>
            <input id="txtEmail" name="Email" type="text">
        </div>
		</br>
        <div>
            <label for="txtTelefone">Telefone</label><br>
            <input id="txtTelefone" name="Telefone" type="txt" onkeydown="javascript: Masc( this, Tel );">
        </div>
		</br>
        <div>
            <label for="txtSenha">Senha</label><br>
            <input id="txtSenha" name="Senha" type="password">
        </div>
		</br>
        <div>
            <label for="txtEnd">Endereço</label><br>
            <input id="txtEnd" name="Endereço" type="txt">
        </div>
		</br>
        <div>
            <label for="DescPet">Descrição</label><br>
            <textarea id="DescPet" name="DescPet" rows="5" cols="33"></textarea>
        </div>
        <div>
            <button type="submit">Cadastrar</button>
        </div>
    </fieldset>
    </form>
    <div><?php include('footer.php');?></div>
   </body>
</html>

