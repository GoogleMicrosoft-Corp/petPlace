<?php
function OpenConnection()  
    {  
        try  
        {  
            $serverName = "DESKTOP-4L8OM6D";
			$connectionInfo = array("Database"=>"PETPLACE");
			$conn = sqlsrv_connect( $serverName, $connectionInfo);
            
            $tsql = "SELECT NOME  FROM USUARIOS";           
            $getUSR = sqlsrv_query($conn, $tsql);  
            if ($getUSR == FALSE)  
               	die(FormatErrors(sqlsrv_errors()));  

            while($row = sqlsrv_fetch_array($getUSR, SQLSRV_FETCH_ASSOC))  
            {  
                echo($row['NOME']);  
                echo("<br/>");  
            }  
            sqlsrv_free_stmt($getUSR);  
            sqlsrv_close($conn);
            
        }  
        catch(Exception $e)  
        {  
            echo("Error!");  
        }  
} 

OpenConnection();





/*Realizando conexao com banco de dados, por meio de autenticação windows
$serverName = "DESKTOP-4L8OM6D";
$connectionInfo = array("Database"=>"PETPLACE");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if($conn)
{
	echo("Conectado");
}
else
{
	echo("Não Conectado");
	die(print_r(sqlsrv_errors(), true));
}
*/
?>