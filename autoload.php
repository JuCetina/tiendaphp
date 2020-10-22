<?php

function autoCargar($nombre_clase){
    include 'controllers/' . $nombre_clase . '.php';
}

spl_autoload_register('autoCargar');