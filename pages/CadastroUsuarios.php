<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Cadastro de Usuários</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="../css/master.css">
    <link rel="stylesheet" type="text/css" href="../css/layout.css">
    <script type="text/javascript">
        function Masc(objeto, mascara) {
            obj = objeto
            masc = mascara
            setTimeout("fMascEx()", 1)
        }

        function fMascEx() {
            obj.value = masc(obj.value)
        }

        function Tel(tel) {
            tel = tel.replace(/\D/g, "")
            tel = tel.replace(/^(\d)/, "($1")
            tel = tel.replace(/(.{3})(\d)/, "$1)$2")
            if (tel.length == 9) {
                tel = tel.replace(/(.{1})$/, "-$1")
            } else if (tel.length == 10) {
                tel = tel.replace(/(.{2})$/, "-$1")
            } else if (tel.length == 11) {
                tel = tel.replace(/(.{3})$/, "-$1")
            } else if (tel.length == 12) {
                tel = tel.replace(/(.{4})$/, "-$1")
            } else if (tel.length > 12) {
                tel = tel.replace(/(.{4})$/, "-$1")
            }
            return tel;
        }

        function CPF(cpf) {
            cpf = cpf.replace(/\D/g, "")
            cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2")
            cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2")
            cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2")
            return cpf
        }

        function mCEP(cep) {
            cep = cep.replace(/\D/g, "")
            cep = cep.replace(/^(\d{2})(\d)/, "$1.$2")
            cep = cep.replace(/\.(\d{3})(\d)/, ".$1-$2")
            return cep
        }

        function mNum(num) {
            num = num.replace(/\D/g, "")
            return num
        }
    </script>
</head>
</head>

<body>
    <div><?php include('header.php'); ?></div>
    <?php
        
        if (isset($_POST["Cadastro"])){            
            include('view/conn.php');
            $conn = new conexao;
            //$conn -> UPDATERETURN(" UPDATE USUARIOS SET NOME = '" . $_POST["Nome"] . "'    " );
            $conn -> UPDATERETURN("insert into usuarios values ('" . $_POST["Nome"] . "', '" . $_POST["Email"] . "', '" . $_POST["Senha"] . "', '" . $_POST["cpf"] . "', '" . $_POST["Telefone"] . "', '" . $_POST["Desc"] . "', '" . $_POST["Endereço"] . "')");
        }
    ?>

    <form method="post">
        <fieldset class="fieldset-center lheigth">
            <legend>Cadastro de Usuários</legend>
            <div>
                <label for="txtNome">Nome</label><br>
                <input id="txtNome" name="Nome" type="text" class="normalizadorlayout">
            </div>
            </div>
            
            <div>
                <label for="txtCPF">CPF</label><br>
                <input id="txtCPF" type="text" name="cpf" onkeydown="javascript: Masc( this, CPF );" class="normalizadorlayout">
            </div>
            
            <div>
                <label for="txtEmail">E-mail</label><br>
                <input id="txtEmail" name="Email" type="text" class="normalizadorlayout">
            </div>
            
            <div>
                <label for="txtTelefone">Telefone</label><br>
                <input id="txtTelefone" name="Telefone" type="txt" onkeydown="javascript: Masc( this, Tel );" class="normalizadorlayout">
            </div>
            
            <div>
                <label for="txtSenha">Senha</label><br>
                <input id="txtSenha" name="Senha" type="password" class="normalizadorlayout">
            </div>
            
            <div>
                <label for="txtEnd">Endereço</label><br>
                <input id="txtEnd" name="Endereço" type="txt" class="normalizadorlayout">
            </div>
            
            <div>
                <label for="DescPet">Descrição</label><br>
                <textarea class="normalizadorlayout" id="Desc" name="Desc" rows="3" cols="33"></textarea>
            </div>
            <div>
                <button  name="Cadastro" class="btn_" type="submit">Cadastrar</button>
        </fieldset>
    </form>
    <div><?php include('footer.php'); ?></div>
</body>

</html>