<?php
    class conexao {

    public function SelectReturn($select)  
    {  
        try  
        {  
            $serverName = "DESKTOP-4L8OM6D";
			$connectionInfo = array("Database"=>"PETPLACE");
			$conn = sqlsrv_connect( $serverName, $connectionInfo);
           
            $getUSR = sqlsrv_query($conn, $select);  
            $nome ="";

            while($row = sqlsrv_fetch_array($getUSR, SQLSRV_FETCH_ASSOC))  
            {  
                $nome = $row['NOME'];                 
            }  
            sqlsrv_free_stmt($getUSR);  
            sqlsrv_close($conn);
            return $nome;
              
        }  
        catch(Exception $e)  
        {              
        }  
    }
} 


?>