<?php

function conection()
{
    
    $site="localhost";
    $user="root";
    $pass="adriana63506474";
    $base="oriempblog";
    
    
    $conection=mysqli_connect($site, $user, $pass, $base) or die ("No has podido establecer conexi�n con el servidor".mysql_error());
    
    if($conection)
    {
        echo("Muy bien hecho, te has conectado al servidor...EXCELENTE");
    }
    
    //mysql_select_db($base, $conection);
    
    }
    
?>