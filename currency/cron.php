<?php
           
include "handles.php";

           if ($response_json === false){
            $cachedrates = file_get_contents($file);
        } else {
            $encode = json_decode(json_encode($response_json));
            $jsonrates = file_put_contents($file,$encode);
            $output = curl_exec($handle);
            curl_close($handle);
        }
?>