<?php
    //include('view/conn.php');
    //$conn = new conexao;

    $pet = $conn -> SelectReturn("SELECT * FROM PETS_PERDIDOS" );
    if (count($pet) > 1)
    { 
        for ($i = 1; $i < count($pet); $i++)
        {
            $especies = $conn -> SelectReturn("SELECT * from ESPECIE WHERE ESPECIE_ID = ".$pet[$i ][2]);
            $especie = $especies[1][1];              

            $petperfil = $conn -> SelectReturn("SELECT * FROM IMAGEM_PET_PERDIDO WHERE ATUAL = 'S' AND PET_ID = " . $pet[$i][0] );
            
            $style = '';
            if ($i == 1){
                $style = 'style="display: block;"';
            }
            else{
                $style = 'style="display: none;"';
            }

            $idant = '';
            $idatual = '';
            $idprox= '';

            if ($i == 1){
                if (count($pet) > 2){
                    $idant = '';
                    $idatual = 'idcard'. $i;
                    $idprox= 'idcard'. ($i + 1);
                }
                else{
                    $idant = '';
                    $idatual = 'idcard'. $i;
                    $idprox= '';
                }
            }
            else if ( $i > 1 && $i < (count($pet)-1) ){
                $idant = 'idcard'. ($i - 1);
                $idatual = 'idcard'. $i;
                $idprox= 'idcard'. ($i + 1);
            }
            else{
                $idant = 'idcard'. ($i - 1);;
                $idatual = 'idcard'. $i;
                $idprox= '';
            }


            if (count($petperfil) > 1)
            {      
                echo '<div id="'.$idatual.'" class="cardmin" '.$style.'>                        
                        <img 
                        src="data:image/jpg;base64,' . $petperfil[1][2] . '"
                        alt="Avatar" style="width: 100%; height: 100px; border-radius:  10px;
                        object-fit: cover; object-position: center;">
                        <hr>
                        <div style="text-align: center;">
                            <b>'. $pet[$i][1] . '</b>
                            <p>'. $especie .'</p>
                            <hr>
                            <span>
                                <button onclick="sliderAnt(\''.$idant.'\',\''.$idatual.'\',\''.$idprox.'\')" type="button"><</button>
                                <button onclick="sliderProx(\''.$idant.'\',\''.$idatual.'\',\''.$idprox.'\')" type="button">></button>
                            </span>  
                        </div>

                    </div>';
                    
            }
            
            
        }
        
    }
    else {
        echo '<div style="display: -webkit-box;display: -webkit-flex;
        display: -moz-box;display: -ms-flexbox;display: flex;flex-wrap: wrap;justify-content: center;align-items: 
            center; text-align: center">
                <div class="card">
                    <h4><b>Sem pets perdidos no momento</b></h4>
                </div>
            </div>';
    }
