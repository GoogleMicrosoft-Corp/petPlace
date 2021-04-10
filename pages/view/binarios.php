<?php

    function ImgParaBase64($filepath)
    {
        $out = 'null';
        $handle = @fopen($filepath, 'rb');
        if ($handle) {
            $content = @fread($handle, filesize($filepath));
            $content = base64_encode($content);
            @fclose($handle);
            $out =  $content;
        }
        return $out;
    }
    
?>