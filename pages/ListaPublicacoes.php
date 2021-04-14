    <form method="post" enctype="multipart/form-data">


            <div style="display: -webkit-box;display: -webkit-flex;
                        display: -moz-box;display: -ms-flexbox;display: flex;
                        flex-wrap: wrap;justify-content: center;align-items: center; width: 100%">

                <?php
                    if(!isset($_SESSION['id'])){
                        header("Location: ../index.php");
                    }

                    
                    $POSTS = $conn -> SelectReturn("SELECT * FROM POST ORDER BY POST_ID DESC");                        
                        
                    if (count($POSTS) > 1)
                    { 
                        for ($i = 1; $i < count($POSTS); $i++)
                        {   
                            $P  = $conn -> SelectReturn("SELECT * FROM USUARIOS WHERE USUARIOS_ID = ". $POSTS[$i][2]);
                            $P2 = $conn -> SelectReturn("SELECT * FROM PETS WHERE PET_ID = ". $POSTS[$i][1] );
                          
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

                                                <a href="#">Conversar Para Adotar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>';                          
                        }
                    }
                    else{ 
                        echo '';
                    }
                ?>

    </form>
</body>

</html>