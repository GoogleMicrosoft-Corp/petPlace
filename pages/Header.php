<?php
	session_start(); 
	include('view/conn.php');
    $conn = new conexao;

?>		
<header class="header-master" style="<?php
	if(isset($_SESSION['id'])){
		$pref = $conn -> SelectReturn("SELECT * FROM CONFIGURACOES WHERE USUARIO_ID = " . $_SESSION['id'] );	
		if (count($pref) > 1)
		{
			echo 'background: -webkit-linear-gradient(-135deg, '. $pref[1][2].','.$pref[1][1].');
			background: -o-linear-gradient(-135deg, '. $pref[1][2].','.$pref[1][1].');
			background: -moz-linear-gradient(-135deg,'. $pref[1][2].','.$pref[1][1].');
			background: linear-gradient(-135deg, '. $pref[1][2].','.$pref[1][1].');';
		}
	}


	?>">
    <nav class="nav-master">
		<!--
		<div class="div-1-master" style="display: inline; float: left;">		  		
	  			<img class="img-header-logo" src="../images/doge.jpg">
		</div>

		<div class="div-1-master" style="display: inline; float: left;">		  		
	  			<p style="color: white;"> Olá, <?php
	  			session_start();  
	  			echo  $_SESSION['nome'];
	  			?></p>
		</div>-->

        <ul style="display: inline;">		  
		  <li><a href="Publicacoes.php">Publicações</a></li>
		  <li><a href="Adotar.php">Adotar</a></li>		  
		  <li><a href="Configuracoes.php">Configurações</a></li>
		  <li><a href="CadastroUsuarios.php">Seu Perfil</a></li>
		  <li><a href="SeusPets.php">Seus Pets</a></li>
		  <li><a href="CadastroAnimais.php" title="Ajude outras pessoas a reencontrarem seus amores">Pets Desaparecidos</a></li>		  
		  <li><a href="../index.php" title="Desconectar">Sair</a></li>		
		</ul>
    </nav>
</header>
