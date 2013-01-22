<?php slot('gmapheader'); ?>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAAVz9bgJO8P5f8lU2Xuk0I0hSo5y5amxCqIDxejWU4f3_AXLAKUBTPIGIVxkiR-nU7__cdDDPofAl3sg" type="text/javascript">

</script>


<script type="text/javascript">
    //<![CDATA[
    var googleMap;
    var geocoder = null;
    var addressMarker;
    var tabs = null;

    function zoomToCountry(address, countryCode){

        if (geocoder) {

            address = address.substring(0, address.indexOf('.'));
            geocoder.setBaseCountryCode(countryCode);
            geocoder.getLatLng(address,
            function(point) {
                if (!point) {
                } else {
                    if (addressMarker) {
                        googleMap.removeOverlay(addressMarker);
                    }
                    googleMap.setCenter(point,3);
                }
            }
        );
        }
    }

    function load() {
        if (GBrowserIsCompatible()) {
            geocoder = new GClientGeocoder();
            googleMap = new GMap2(document.getElementById("map"));
            googleMap.addMapType(G_PHYSICAL_MAP);
            googleMap.setMapType(G_PHYSICAL_MAP);
            googleMap.setCenter(new GLatLng(10,15), 1);
            googleMap.addControl(new GSmallMapControl());
            googleMap.setZoom(2);

<?php echo $sf_data->getRaw('mapString'); ?>
            zoomToCountry(entities[0], "countrycode");

            baseUrl = "/riks/web/images/poly/";
            for(var y =0; y < entities.length; y++){
                entitiesUrl = baseUrl+entities[y];
                GDownloadUrl(entitiesUrl, function(data, responseCode)
                {
                    if((200==responseCode)&&(0!=data.length))
                    {
                        try{
                            var iStart = 0;
                            var arePoints = false;
                            var polylineLevels = "";
                            do
                            {
                                var iEnd = data.indexOf("<br>",iStart);
                                if( false == arePoints)
                                {
                                    polylineLevels = data.substring(iStart,iEnd);
                                    arePoints = true;
                                }
                                else
                                {
                                    var polygon = new  GPolygon.fromEncoded({
                                        polylines: [{color: "#B61B02", weight: 2, opacity:1.0,
                                                points: data.substring(iStart,iEnd),
                                                levels: polylineLevels,
                                                zoomFactor: 2, numLevels: 18}],
                                        fill: true, color:" #B61B02", opacity: 0.3, outline: true});
                                    googleMap.addOverlay(polygon);
                                    arePoints = false;
                                }
                                iStart = iEnd + 4;
                            }while( data.length > iStart)
                            }catch(e){
                                alert ("A problem occured while parsing data file: " + entitiesUrl);
                            }
                        }
                        else
                        {
                            alert ("A problem occured while retrieving data file: " + entitiesUrl);
                        }
                    });//end GDownloadUrl
                }//end for
            }// end if
        }// end load


        //]]>
</script>


<?php end_slot(); ?>
<div id="content">
    <h1><?php echo $rikssym_arrangement->getName() ?></h1>
    <p>
        <h4>Interactive map of the regional arrangement:</h4>
        <div id="map"></div>
    </p>
    <p>
        <h4>Description:</h4>
        <?php echo $sf_data->getRaw('rikssym_arrangement')->getDescription(); ?>
    </p>
    <p><h4>Members:</h4>
        <?php
        if(sizeof($members)>10){
            echo '<table><tr>';
            for($i = 0; $i< sizeof($members); $i++){
                echo '<td><img src="'.$flagDir.$members[$i]->getName().'.png">';
                echo '</td><td><a href="';
                echo url_for('country/show?id='.$members[$i]->getId());
                echo '">'.$members[$i]->getName().'</a></td>';
                if($i % 3 == 0 && $i !=0){
                    echo "</tr><tr>";
                }
            }
            echo '</tr></table>';
        } else{ ?>
            <?php foreach ($members as $member): ?>
        <img src="<?php echo $flagDir ?><?php echo $member->getName().'.png' ?>">
        <a href="<?php echo url_for('country/show?id='.$member->getId())?>">
            <?php echo $member->getName() ?>
        </a><br />
        <?php endforeach; ?>

        <?php } ?>
    </p>
</div>
