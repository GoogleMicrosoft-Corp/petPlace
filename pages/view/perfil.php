<?php
	class perfill {
		public function getNome()
		{
			include('conn.php');
			$conn = new conexao;
			$nome = $conn -> SelectReturn("SELECT NOME FROM USUARIOS");
		    return $nome;
		}
	}
?>