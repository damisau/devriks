<h1>
    Legal texts of selected countries and arrangements:
</h1>
        <?php
        if(sizeof($countryDocumentArray) > 0){
            $gna = $sf_data->getRawValue('RikssymDocumentEntity');
            $documentEntities = $gna['countryDocumentPeer'];

            $doneCountries = array();
            foreach($documentEntities as $singleDocumentEntity){
                $singleCountry = $singleDocumentEntity->getRikssymCountry();
                if(!in_array($singleCountry, $doneCountries)){
                    echo "<h4>".$singleCountry->getName()."</h4>";
                }
                $doneCountries[] = $singleCountry;
                
                $singleDocument = $singleDocumentEntity->getRikssymDocument();
                echo "<a href=\"/riks/web/treaties/".$singleDocument->getFilename()."\">";
                echo $singleDocument->getTitleLong()."</a><br>";
            }
        }
        if(sizeof($arrangementDocumentArray) > 0){
            echo "<h3>".$arrangement->getName().":</h3>";
            $gna = $sf_data->getRawValue('RikssymDocumentEntity');
            $documentEntities = $gna['arrangementDocumentPeer'];

            $doneCountries = array();
            foreach($documentEntities as $singleDocumentEntity){
                $singleCountry = $singleDocumentEntity->getRikssymCountry();
                if(!in_array($singleCountry, $doneCountries)){
                    echo "<h4>".$singleCountry->getName()."</h4>";
                }
                $doneCountries[] = $singleCountry;

                $singleDocument = $singleDocumentEntity->getRikssymDocument();
                echo "<a href=\"/riks/web/treaties/".$singleDocument->getFilename()."\">";
                echo $singleDocument->getTitleLong()."</a><br>";
            }

        }
        ?>