<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* Este código pode ser encontrado no site da W3C */
        * {
            box-sizing: border-box
        }

        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        .mySlides {
            display: none;
        }
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            margin-top: -22px;
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active,
        .dot:hover {
            background-color: #717171;
        }

        .fade {
            -webkit-animation-name: fade;
            -webkit-animation-duration: 1.5s;
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @-webkit-keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }

        @keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }
    </style>
    <script type="text/javascript">
        var slideIndex = 0;
    

        function showSlides() {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1
            }
            slides[slideIndex - 1].style.display = "block";
            setTimeout(showSlides, 2000); // Change image every 2 seconds
        }
    </script>

</head>

<body onload="showSlides()">
    <form method="post" enctype="multipart/form-data">
        <div class="slideshow-container">
            <?php
            include('view/conn.php');
            $conn = new conexao;
            $petperfil = $conn->SelectReturn("SELECT * FROM PUBLICIDADE");

            if (count($petperfil) > 1) {
                for ($i = 1; $i < count($petperfil); $i++) {
                    echo '
                    <div style="display: -webkit-box;display: -webkit-flex;
                    display: -moz-box;display: -ms-flexbox;display: flex;
                    flex-wrap: wrap;justify-content: center;align-items: center; width: 100%">
                            <div class="mySlides fade">
                                            <div class="numbertext">' . $i . '</div>
                                            <img src="data:image/jpg;base64,' . $petperfil[$i][1] . '" style="height: 90px;
                                object-fit: cover; object-position: center;">                        
                            </div>
                    </div>';
                }
            }
            ?>            
        </div>
    </form>

</body>

</html>