<?php

include_once 'test.config.php';
include_once 'Book.php';

class Pretrazivac {

    public function pretraziTekst($polje, $upit) {
        error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
        $options = array (
            'hostname' => SOLR_SERVER_HOSTNAME,
            'login' => SOLR_SERVER_USERNAME,
            'password' => SOLR_SERVER_PASSWORD,
            'port' => SOLR_SERVER_PORT,
            'path' => SOLR_SERVER_PATH,
        );
        $client = new SolrClient($options);
        $query = new SolrQuery();
        $query->setQuery($polje . ':' . $upit);
        $query->setStart(0);
        $query->setRows(50);
        $query_response = $client->query($query); 
        $response = $query_response->getResponse(); 
        $books=array();
        foreach($response['response']['docs'] as $file) {
            $id= $file["id"];
            $title = $file["link"];
            $dateModified=$file["last_modified"];
            $size = $file["size"];
            $book = new Book($id,$title,$dateModified,$size);
            if($polje=="id")
            {
                $path=__DIR__ .'\Knjige\\'.$title;
                $fajlovi = glob($path); 
                foreach ($fajlovi as $fajl) {
                    $content=file_get_contents ($fajl);
                }
                $book->content=$content;
            }
            array_push($books, $book);
        }
        return $books;
    }

}
