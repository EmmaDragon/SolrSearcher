<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            include_once 'Indekser.php';
            include_once 'Pretrazivac.php';
            include_once 'Book.php';
            // Deo koda koji poziva indeksiranje
            //$indekser = new Indekser();
            //$indekser->indeksirajFajlove(__DIR__ . '\Knjige\*.txt');
           // $indekser->indeksirajFajl("C:\Users\Emma\Desktop\Knjige\The Odyssey.txt");
            // __DIR__ je konstanta koja sadrži apsolutnu putanju do foldera gde 
            // je smešten PHP fajl koji se trenutno izvršava.
            
            // Deo koda koji poziva pretraživanje
           /* $pretrazivac = new Pretrazivac();
            $response = $pretrazivac->pretraziTekst("last_modified", "2020-05-08T07:04:13Z");
            
            print('Pronađeni dokumenti:');
            print('<br/>');
            
            foreach($response as $doc) {
                print('<p>');
                print_r($doc);
                print('</p>');
            }*/
        ?>
    </body>
</html>
