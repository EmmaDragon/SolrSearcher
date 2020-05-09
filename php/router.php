<?php
    include_once 'Indekser.php';
    include_once 'Pretrazivac.php';

    $indekser=new Indekser();
    $pretrazivac=new Pretrazivac();

    if(isset($_POST["indexFile"]))
    {
        $path=__DIR__ .'\Knjige\\'.$_POST["title"];
        $document = fopen($path, "w");
        fwrite($document, $_POST["content"]);
        fclose($document);
        $comment=$indekser->indeksirajFajl($path);
        echo json_encode($comment);
        
    }
    else if(isset($_POST["searchFiles"]))
    {
        $query=$_POST["query"];
        $param=$_POST["param"];
        $response = $pretrazivac->pretraziTekst($param, $query);
        echo json_encode($response);
    }

?>