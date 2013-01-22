<?php
/**
 * This class provides a very basic interface for the jpgraph library.
 * If the correct parameters are send to the constructor, a graph will
 * be created in the submitted filename. If parameters do not meet the
 * requirements, an error message is returned.
 *
 * @author BFuhne
 */
class RikssymGraph {

    var $graph;
    var $colors;
    var $graphX = 750;
    var $graphY = 850;
    var $graphMargins = array(140,250,40,430);
    var $marginColor = 'white';
    var $scale = 'textint';
    var $drawSuccess = false;
    var $error;

    var $request;
    var $indicatorObjects;
    var $years;
    var $filename;

    public function __construct(sfWebRequest $request,
            $indicatorObjects,
            $years,
            $filename) {

        include(sfConfig::get('app_jpgraph')."jpgraph.php");
        include(sfConfig::get('app_jpgraph')."jpgraph_line.php");
        //TODO insert sanity checks

        $this->request = $request;
        $this->indicatorObjects = $indicatorObjects;
        $this->filename = $filename;
        $this->years = $years;

        $this->executeImage($this->request, $indicatorObjects,
                $this->years,
                $this->filename);
        $this->drawSuccess = true;
    }


    public function executeImage(sfWebRequest $request,
            $indicatorObjects,
            $years,
            $filename) {
        $autoMin;
        $yAxis = -1;
        $graphCount = 0;

        function formatYAxis($value) {
            $value = number_format($value,0,"",".");
            return $value;
        }
        $graph = new Graph($this->graphX,$this->graphY);
        $graph->SetMargin($this->graphMargins[0],$this->graphMargins[1],
                $this->graphMargins[2],$this->graphMargins[3]);
        $graph->SetMarginColor($this->marginColor);
        $graph->SetScale('textint');
        $graph->img->SetAntiAliasing();
        $graph->ygrid->SetFill(true,'#EFEFEF@0.5','#BBCCFF@0.5');
        $graph->ygrid->Show (true,true);
        $graph->xgrid->Show (true,true);
        $colors = array("#000000", "#FF0000","#00FF00","#0000FF","#FF00FF","#447799","#998C99","#E5E500");
        $graph->xaxis->SetTickLabels($years);
        if(sizeof($years) > 10) {
            $graph->xaxis->SetTextLabelInterval(2);
        }
        $graph->xaxis->HideTicks(true,false);
        $graph->xaxis->title->Set("Year");

        $titleString;
        $indicatorSource;
        foreach($indicatorObjects as $indicator) {
            $titleString = $indicator->getName()." ".$indicator->getUnitTitle()."\n";
            $indicatorSource = strip_tags($indicator->getDescription());
            $indicatorUnit;

            $yearValueArray = $indicator->getValues();
            $lowestValue = min($yearValueArray);
            if($lowestValue < 0){
                $autoMin = $lowestValue -1;
            } else {
                $autoMin = 0;
            }
            $tempValues = array();
            foreach($years as $year) {
                if(!is_numeric($yearValueArray[$year])) {
                    $tempValues[] = preg_replace("/%/","",$yearValueArray[$year]);
                } else {
                    $tempValues[] = $yearValueArray[$year];
                }
            }
            ${"datay".$graphCount} = $tempValues;

            ${"p".$graphCount} = new LinePlot(${"datay".$graphCount});
            $graph->Add(${"p".$graphCount});
            ${"p".$graphCount}->SetColor($colors[$graphCount]);
            ${"p".$graphCount}->SetLegend($indicator->entity->getName().", ".$indicator->getName()."\n ");
            $graphCount++;

            $graph->yaxis->SetTitle($indicator->getName());
            $graph->yaxis->scale->SetAutoMin($autoMin);
            $graph->yaxis->SetTitleMargin(100);
            $graph->yaxis->scale->SetGrace(1);
            $yAxis++;
            
        }
        $graph->footer->right->Set(sfConfig::get('app_imageCopyright', "Visualization (c) RIKS 2009".
                "\n".$indicatorSource));
        //setup of y- and x-axis labelling
        $graph->yaxis->SetTitleMargin(100);
        $graph->yaxis->SetFont(FF_ARIAL);

        $graph->xaxis->SetTitleMargin(35);
        $graph->xaxis->SetFont(FF_ARIAL);
        $graph->xaxis->SetLabelAngle(45);
        $graph->yaxis->HideZeroLabel();


        $graph->legend->Pos(0.1,0.72,"right","bottom");
        $graph->legend->SetFont(FF_ARIAL, FS_NORMAL, 8);
        $graph->footer->right->SetFont(FF_ARIAL, FS_NORMAL, 8);

        $graph->title->Set($titleString);


        $graph->yaxis->SetLabelFormatCallback('formatYAxis');
        $graph->yaxis->scale->ticks->SetFormatCallback('formatYAxis');
        //spit it out
        $gdImgHandler = $graph->Stroke(_IMG_HANDLER);
        $localfile = "graphs/".$filename.".png";

        $graph->img->Stream($localfile);
        sfView::NONE;
    }
}
?>
