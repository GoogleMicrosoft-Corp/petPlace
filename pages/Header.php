<header class="header-master">
    <nav class="nav-master">
		<div class="div-1-master" style="display: inline; float: left;">		  		
	  			<img class="img-header-logo" src="../images/doge.jpg">
		</div>

		<div class="div-1-master" style="display: inline; float: left;">		  		
	  			<p style="color: white;"> Olá, <?php
	  			session_start();  
	  			echo  $_SESSION['nome'];
	  			?></p>
		</div>

        <ul style="display: inline;">		  
		  <li><a href="#">Publicações</a></li>
		  <li><a href="#">Adotar</a></li>		  
		  <li><a href="#">Conversas</a></li>
		  <li><a href="CadastroUsuarios.php">Seu Perfil</a></li>
		  <li><a href="CadastrarPet.php">Seus Pets</a></li>
		  <li><a href="CadastroAnimais.php">Cadastro de Animais</a></li>		  
		  <li><a href="../index.php">Sair</a></li>		
		</ul>
    </nav>
</header>