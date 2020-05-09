<?php
include_once 'test.config.php';

class Indekser {
    public function indeksirajFajl($fajlPutanja)
    {
        $comment="";
        $options = array
        (
            'hostname' => SOLR_SERVER_HOSTNAME,
            'login'    => SOLR_SERVER_USERNAME,
            'password' => SOLR_SERVER_PASSWORD,
            'port'     => SOLR_SERVER_PORT,
            'path'     => SOLR_SERVER_PATH,
        );
        $solrKlijent = new SolrClient($options);
       
        $fajlovi = glob($fajlPutanja); 
        foreach ($fajlovi as $fajl) {
            $filename = basename($fajl); 
            $dokument = new SolrInputDocument();
            $dokument->addField('id', uniqid()); 
            $dokument->addField('last_modified', date(DateTime::W3C, filemtime($fajl))); 
            $dokument->addField('link', $filename);
            $dokument->addField('body', file_get_contents ($fajl)); 
            $size=filesize($fajl)/1024;
            $dokument->addField('size', strval(round($size,2))."KB");
            try {
                $response = $solrKlijent->addDocument($dokument);
                if (!is_null($response) && $response-> success()) {
                    $comment="Dokument uspešno dodat: " . $filename;
                  
                }
                else {
                    $comment="Greška pri dodavanju dokumenta: " . $response->getHttpStatusMessage();
                }
                
            }
            catch (Exception $ex) {
                
            }
        }
        $solrKlijent->commit();
        return $comment;
    }
    public function indeksirajFajlove($folderPutanja) {
        $options = array
        (
            'hostname' => SOLR_SERVER_HOSTNAME,
            'login'    => SOLR_SERVER_USERNAME,
            'password' => SOLR_SERVER_PASSWORD,
            'port'     => SOLR_SERVER_PORT,
            'path'     => SOLR_SERVER_PATH,
        );
        $solrKlijent = new SolrClient($options);
        $fajlovi = glob($folderPutanja); 
        foreach ($fajlovi as $fajl) {
            $filename = basename($fajl); 
            $dokument = new SolrInputDocument();
            $dokument->addField('id', uniqid()); 
            $dokument->addField('last_modified', date(DateTime::W3C, filemtime($fajl))); 
            $dokument->addField('link', $filename);
            $dokument->addField('body', file_get_contents ($fajl)); 
            $size=filesize($fajl)/1024;
            $dokument->addField('size', strval(round($size,2))."KB");
            try {
                $response = $solrKlijent->addDocument($dokument);
                if (!is_null($response) && $response-> success()) {
                    print("Dokument uspešno dodat: " . $filename);
                    print("<br/>");
                }
                else {
                    print("Greška pri dodavanju dokumenta: " . $response->getHttpStatusMessage());
                    print("<br/>");
                }
                
            }
            catch (Exception $ex) {
                print($ex);
                print("<br/>");
            }
        }
        $solrKlijent->commit();
    }
}
