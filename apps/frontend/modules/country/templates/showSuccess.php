<?php slot('gmapheader'); ?>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAVz9bgJO8P5f8lU2Xuk0I0hSbPSaRzfRyR-KfeYL-g-2q8Uf6XBSVuTxy1rshziUDLurXn4AfwaQH9g"
        type="text/javascript">
</script>
<script type="text/javascript">
    //<![CDATA[
    var googleMap;
    var geocoder = null;
    var addressMarker;
    var tabs = null;
    function zoomToCountry(address, countryCode){
        if (geocoder) {
            geocoder.setBaseCountryCode(countryCode);
            geocoder.getLatLng(address,
            function(point) {
                if (!point) {
                } else {
                    if (addressMarker) {
                        googleMap.removeOverlay(addressMarker);
                    }
                    addressMarker = new GMarker(point);
                    googleMap.setCenter(point,3);
                    googleMap.addOverlay(addressMarker);

                    var infoTabs = new Array();
                    infoTabs[0] = new GInfoWindowTab('News','<div class="infoWindow"><?php echo $sf_data->getRaw('feedData'); ?></div>');
                    infoTabs[1] = new GInfoWindowTab('Population','<div class="infoWindow"><?php echo $sf_data->getRaw('popTable'); ?></div>');
                    infoTabs[2] = new GInfoWindowTab('GDP','<div class="infoWindow"><?php echo $sf_data->getRaw('gdpTable'); ?></div>');
                    googleMap.openInfoWindowTabsHtml(point, infoTabs);

                    GEvent.addListener(addressMarker, 'click',
                    function() {
                        addressMarker.openInfoWindowTabsHtml([
                            new GInfoWindowTab('News','<div class="infoWindow"><?php echo $sf_data->getRaw('feedData'); ?></div>'),
                            new GInfoWindowTab('Population','<div class="infoWindow"><?php echo $sf_data->getRaw('popTable'); ?></div>'),
                            new GInfoWindowTab('GDP','<div class="infoWindow"><?php echo $sf_data->getRaw('gdpTable'); ?></div>')]);                                                 $


                    });
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


<?php
$countryName = $rikssym_country->getName();
$country = "";
$country .= 'var entities = new Array("';
$country .= $countryName.".ply";
$country .='");';
echo $country;
?>
            zoomToCountry("<?php echo $rikssym_country->getName() ?>", "countrycode");


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
                                iStart = iEnd + 4;//jump above '<br>' to the next polylines
                            }while( data.length > iStart)
                            }catch(e){
                                // alert ("A problem occured while parsing data file: " + entitiesUrl);
                            }
                        }
                        else
                        {
                            // alert ("A problem occured while retrieving data file: " + entitiesUrl);
                        }
                    });//end GDownloadUrl
                }//end for
            }// end if
        }// end load


        //]]>
</script>


<?php end_slot(); ?>
<h1><?php echo $rikssym_country->getName() ?></h1>
<p><h4><img src="<?php echo $flag; ?><?php echo $rikssym_country->getName(); ?>.png">&nbsp;
    <?php echo $rikssym_country->getName() ?> is a member of the following regional arrangements:</h4>
    <?php foreach($members as $member): ?>
    <a href="<?php echo url_for('arrangement/show?id='.$member->getId()) ?>">
        <?php echo $member->getName(); ?>
    </a>
    <br>
    <?php endforeach; ?>
</p>

<?php if(sizeof($documents)>0){ ?>
<p><h4>The following related documents are available</h4>
    <?php foreach($documents as $document):?>
        <a href="<?php echo '/riks/web/treaties/'.$document->getFileName(); ?>">
            <?php echo $document->getTitleLong();?>
        </a><br>
    <?php endforeach; ?>
    <?php } ?><br>
<p><h4>Search our complete archive</h4>
    <?php 
        
        echo link_to('Perform a full-text search on our archive to find related texts and working papers.',
        'document/index?words='.$countryName.'&go_search=1');
    ?>
</p>
<p>
<b>General information:</b><br>
More information about <?php echo $rikssym_country->getName() ?> on the
<a href="https://www.cia.gov/library/publications/the-world-factbook/geos/<?php echo strtolower($rikssym_country->getIsoCountrycode()); ?>.html">
CIA World Factbook</a>.<br><br>
<b>Related data on the <a href="http://first.sipri.org/">Facts on International Relations and Security Trends database:</a></b><br>
<a href="<?php echo $first_militarization; ?>">Militarization Index</a><br>
<a href="<?php echo $firstIOs; ?>">Membership in Internation Organizations</a><br>
<a href="<?php echo $firstPeaceMissions; ?>">Multilateral Peace Missions</a><br>
</p>

<div id="logDiv"></div>
<h4>Interactive Map: </h4>
<div id="map">

</div>
