<?php

function authorize($apikey){
$APIKEY = 'kugI&^t7^(H&T8Tg';

    if($apikey != $APIKEY){
        echo json_encode(
            array("message" => "Incorrect apikey")
        );
    }else{
        return true;
    }
}

?>