<fieldset>
    <legend>More results text and behavior</legend>
    <div class="item item-flex-nogrow" style="flex-wrap: wrap;">
        <?php
        $o = new wpdreamsYesNo("showmoreresults", "Show 'More results..' text in the bottom of the search box?", $sd['showmoreresults']);
        $params[$o->getName()] = $o->getData();
        $o = new wpdreamsCustomSelect("more_results_action", " action", array(
            'selects'=>array(
                array('option' => 'Load more ajax results', 'value' => 'ajax'),
                array('option' => 'Redirect to Results Page', 'value' => 'results_page'),
                array('option' => 'Redirect to WooCommerce Results Page', 'value' => 'woo_results_page'),
                array('option' => 'Redirect to custom URL', 'value' => 'redirect')
            ),
            'value'=>$sd['more_results_action']
        ));
        $params[$o->getName()] = $o->getData();
        ?>
        <div class="descMsg" style="min-width: 100%;flex-wrap: wrap;flex-basis: auto;flex-grow: 1;box-sizing: border-box;">
            "Load more ajax results" option will not work if Polaroid layout or Grouping is activated, or if results are removed when no images are present.
        </div>
    </div>
    <div class="item">
        <?php
        $o = new wpdreamsText("more_redirect_url", "' Show more results..' url", $sd['more_redirect_url']);
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
    <div class="item item-flex-nogrow" style="flex-wrap: wrap;">
        <?php
        $o = new wpdreamsText("showmoreresultstext", "' Show more results..' text", $sd['showmoreresultstext']);
        $params[$o->getName()] = $o->getData();
        $o = new wpdreamsCustomSelect("more_redirect_location", " location: ",
            array(
                'selects' => array(
                    array('option' => 'Use same tab', 'value' => 'same'),
                    array('option' => 'Open new tab', 'value' => 'new')
                ),
                'value' => $sd['more_redirect_location']
            ));
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
</fieldset>
<fieldset>
    <legend>Results text keyword highlighter</legend>
    <div class="item"><?php
        $o = new wpdreamsYesNo("highlight", "Highlight search text in results?", $sd['highlight']);
        $params[$o->getName()] = $o->getData();
        ?></div>
    <div class="item"><?php
        $o = new wpdreamsYesNo("highlightwholewords", "Highlight only whole words?", $sd['highlightwholewords']);
        $params[$o->getName()] = $o->getData();
        ?></div>
    <div class="item"><?php
        $o = new wpdreamsColorPicker("highlightcolor", "Highlight text color", $sd['highlightcolor']);
        $params[$o->getName()] = $o->getData();
        ?></div>
    <div class="item"><?php
        $o = new wpdreamsColorPicker("highlightbgcolor", "Highlight-text background color", $sd['highlightbgcolor']);
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
</fieldset>