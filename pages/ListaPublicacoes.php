    <?php
        if (isset($_POST["PostId"]))
        {   
            $POST_SELECT = $conn -> SelectReturn("SELECT * FROM POST WHERE POST_ID = " . $_POST["PostId"]);           
            $conn -> UPDATERETURN("INSERT INTO ADOTAR (PET_ID, POST_ID, DONO_ID, INTERESSADO_ID, STATUS_PET, VISTO)
            VALUES ( ".$POST_SELECT[1][1]." , ".$_POST["PostId"]." , 
            ".$POST_SELECT[1][2]." , ". $_SESSION['id']." , 'N', 'N')"); 
        }  
        else if (isset($_POST["CancelarId"]))
        {       
            $conn -> UPDATERETURN("DELETE ADOTAR WHERE  POST_ID = ".$_POST["CancelarId"]. " AND INTERESSADO_ID = " . $_SESSION['id']);    
        }    
        else if (isset($_POST["ExcluirId"]))
        {       
            $conn -> UPDATERETURN("DELETE ADOTAR WHERE  POST_ID = ".$_POST["ExcluirId"]. " AND DONO_ID = " . $_SESSION['id']);
            $conn -> UPDATERETURN("DELETE POST WHERE  POST_ID = ".$_POST["ExcluirId"] );
        }  
    ?>

    <form method="post" enctype="multipart/form-data">


            <div style="display: -webkit-box;display: -webkit-flex;
                        display: -moz-box;display: -ms-flexbox;display: flex;
                        flex-wrap: wrap;justify-content: center;align-items: center; width: 100%">

                <?php
                    if(!isset($_SESSION['id'])){
                        header("Location: ../index.php");
                    }

                    
                    $POSTS = $conn -> SelectReturn("SELECT * FROM POST WHERE STATUS_PUBLICACAO ='PENDENTE' ORDER BY POST_ID DESC");                        
                        
                    if (count($POSTS) > 1)
                    { 
                        for ($i = 1; $i < count($POSTS); $i++)
                        {   
                            $P  = $conn -> SelectReturn("SELECT * FROM USUARIOS WHERE USUARIOS_ID = ". $POSTS[$i][2]);
                            $P2 = $conn -> SelectReturn("SELECT * FROM PETS WHERE PET_ID = ". $POSTS[$i][1] );
                            
                            $texto = '';
                            
                            $interesse = $conn -> SelectReturn("SELECT * FROM ADOTAR WHERE PET_ID = ". $POSTS[$i][1] . " AND INTERESSADO_ID = ". $_SESSION['id']);
                            if (count($interesse) > 1){
                                $texto = '<button style="background-color: red;" type="submit" value="'.$POSTS[$i][0].'" class="a_" name="CancelarId">
                                            Cancelar Solicitação
                                          </button>';
                            }
                            else if ($POSTS[$i][2] ==  $_SESSION['id'] ){
                                $texto = '<button style="background-color: black; color: white;" type="submit" value="'.$POSTS[$i][0].'" class="a_" name="ExcluirId">
                                                    Apagar Publicação
                                           </button>';
                            }
                            else{
                                $texto = '<button type="submit" value="'.$POSTS[$i][0].'" class="a_" name="PostId">
                                                   Solicitar Adoção
                                           </button>';
                            }


                            echo '<div class="container">
                                    <div class="cardb"> 
                                        <div class="caixa">
                                            <div class="conteudo">
                                                <p>Conversar com: '. $P[1][1] .'</p>
                                                <h5>Pet: '. $P2[1][1] .'. Idade: '.$P2[1][4].'.</h5>
                                                <p>'.$POSTS[$i][3].'</p>
                                                <img 
                                                src="data:image/jpg;base64,' . $POSTS[$i][5] . '"
                                                alt="Avatar" style="width: 100%; height: 230px; border-radius:  10px;
                                                object-fit: cover; object-position: center;">

                                                '. $texto .'
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>';                          
                        }
                    }
                    else {
                        echo '<br><div style="display: -webkit-box;display: -webkit-flex;
                            display: -moz-box;display: -ms-flexbox;display: flex;flex-wrap: wrap;justify-content: center;align-items: 
                            center; text-align: center">
                                <div class="card">
                                    <h4><b>Sem novas publicações no momento</b></h4>
                                </div>
                            </div>';
                    }
                ?>



    </form>
</body>

</html>