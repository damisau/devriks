<?php use_helper('Javascript'); ?>
<div id="content">
    <div id="exportBox">
        <b>Export data:</b><br><br>
        <?php
        if(sizeof($indicatorClassnames) == 1  && sizeof($years) > 1) {
            ?>
        <a href="/riks/web/graphs/<?php echo $name; ?>.png" target="_blank">
            <img src="/riks/web/images/chart.png" border="none">&nbsp;View data as graph</a><br>

            <?php

        }else {

            ?>In order to export the data as a graph, select one indicator, and at least two years.<br><br>
            <?php }

        ?>

        <a href="/riks/web/graphs/<?php echo $name; ?>.xls" target="_blank">
            <img src="/riks/web/images/excel.png" border="none">&nbsp;Save data as sheet</a>
        <br><br>
    </div>
        <?php foreach($indicatorObjects as $indicatorObject):?>
        <table class="tableIndicator" width="480" border="0" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th class="thHeadIndicator" colspan="2">
                            <?php echo $indicatorObject->entity->getName()?>
                </th>
            </tr>
            <tr>
                <th class="thHeadIndicator" colspan="2">
                            <?php echo $indicatorObject->getName()." ".$indicatorObject->getUnitTitle() ?>
                </th>
            </tr>
        </thead>
        <?php $rowSelector = 1; ?>
                <?php foreach($years as $year): ?>
                    <?php if($rowSelector % 2 ==0) {
                        $style="trIndicatorPair";
                    }
                    else {
                        $style="trIndicatorImpair";
                    }
                    ?>
        <tr class="<?php echo $style; ?>">
            <td>
                            <?php echo $year; ?>
            </td>
            <td class="indicatorValue">
                <?php echo $indicatorObject->getValueOfYear($year, true); ?>
            </td>
        </tr>
                    <?php $rowSelector++; ?>
                <?php endforeach; ?>
        <tr><td><?php echo html_entity_decode($indicatorObject->getDescription());?></td></tr>
        <tr>
            <td>
                <a href="#" onclick="$('<?php echo $indicatorObject->getName().
                                   $indicatorObject->entity->getName()?>').toggle(); return false;">
                    View technical notes&nbsp;
                    <img src="/riks/web/images/bullet_arrow_down.png"  alt="show method" border="0" align="top"></a></td>
        </tr>
        <tr><td colspan="2">
                <div id="<?php echo $indicatorObject->getName().$indicatorObject->entity->getName()?>" style="display:none;">
                            <?php echo html_entity_decode($indicatorObject->getMethod()); ?>
                </div></td>
        </tr>
        <tr>
            <td>
                <a href="#" onclick="$('<?php echo $indicatorObject->getName().
                                   $indicatorObject->entity->getName()."frontendMessage"; ?>').toggle(); return false;">
                    View additional information&nbsp;
                    <img src="/riks/web/images/bullet_arrow_down.png"  alt="show method" border="0" align="top"></a></td>
        </tr>
        <tr>
            <td>
                 <div id="<?php echo $indicatorObject->getName().$indicatorObject->entity->getName()."frontendMessage"; ?>" style="display:none;">
                         <?php foreach($indicatorObject->getFrontendMessage() as $line): ?>
                         <?php echo $line."<br>" ?>
                         <?php endforeach; ?>

                 </div>
            </td>
        </tr>
    </table>
    <?php endforeach; ?>
</div>
