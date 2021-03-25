<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Pet Place</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="../css/master.css">
</head>
<body>
    <div><?php include('header.php');?></div>
    <div><?php 
    	include( 'view/perfil.php');
    	$teste = new perfill;
    	$nome = $teste -> getNome();

    	$div_central =  "<div style='display: -webkit-box;
					  display: -webkit-flex;
					  display: -moz-box;
					  display: -ms-flexbox;
					  display: flex;
					  flex-wrap: wrap;
					  justify-content: center;
					  align-items: center;'>" 
					  . $nome  
					  ."</div>";
    	echo $div_central;
    	?>
    	
    </div>
    <div><?php include('footer.php');?></div>
</body>

