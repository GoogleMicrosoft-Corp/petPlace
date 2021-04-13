<?php


    $pet = $conn -> SelectReturn("SELECT * FROM PETS" );
    if (count($pet) > 1)
    { 
        for ($i = 1; $i < count($pet); $i++)
        {
            $especie ='';
            if($pet[$i ][2] == '1'){$especie = 'CACHORRO';}
            else if($pet[$i ][2] == '2'){$especie = 'GATO';}
            else if($pet[$i ][2] == '3'){$especie = 'PAPAGAIO';}
            else if($pet[$i ][2] == '4'){$especie = 'PERIQUITO';}
            else if($pet[$i ][2] == '5'){$especie = 'CAMUNDONGO';}

            $idpet = "CadastrarPet.php?idpet=" . $pet[$i][0];

            $petperfil = $conn -> SelectReturn("SELECT * FROM IMAGEM_PET WHERE ATUAL = 'S' AND PET_ID = " . $pet[$i][0] );
            
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
?>

