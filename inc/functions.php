<?php

function toastSucces($storyName){
    return sprintf("Votre storie %s a bien été enregistrée.", $storyName );
}

function getStorySended($targetFile){
    if(($handle = fopen($targetFile,"r"))){
        //ob_start();
        while(($data = fgetcsv($handle,1000,",")) !== FALSE){
                $datas[] = $data; 
            }
            foreach($datas as $stories){
                echo "<p class='story shadow col-sm-4 text-center'>";
                foreach($stories as $story){
                    echo $story;
                    echo'<br>'; 
                }
                echo '</p>';
            };
        }
}