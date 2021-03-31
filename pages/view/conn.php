<?php
    class conexao {

    public function SelectReturn($select)  
    {  
        try  
        {  
            //$select = "select * from usuarios";
            $serverName = "DESKTOP-4L8OM6D";
			$connectionInfo = array("Database"=>"PETPLACE");
			$conn = sqlsrv_connect( $serverName, $connectionInfo);
           
            $getUSR = sqlsrv_query($conn, $select);  
            $obj[] = [];
            while($row = sqlsrv_fetch_array($getUSR, SQLSRV_FETCH_NUMERIC))
            {                         
                $obj[] = $row;
            }
            return $obj;
              
        }  
        catch(Exception $e)  
        {              
        }
    }

    public function Insert($select)  
    {  
        try  
        {  
            //$select = "select * from usuarios";
            $serverName = "DESKTOP-4L8OM6D";
            $connectionInfo = array("Database"=>"PETPLACE");
            $conn = sqlsrv_connect( $serverName, $connectionInfo);
           
            $getUSR = sqlsrv_query($conn, $select);  
            $obj[] = [];
            while($row = sqlsrv_fetch_array($getUSR, SQLSRV_FETCH_NUMERIC))
            {                         
                $obj[] = $row;
            }
            return $obj;
              
        }  
        catch(Exception $e)  
        {              
        }
    }


} 


?>