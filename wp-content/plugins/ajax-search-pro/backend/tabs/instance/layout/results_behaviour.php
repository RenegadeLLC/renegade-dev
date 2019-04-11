<div class="item">
    <?php
    $o = new wpdreamsYesNo("results_click_blank", "Open the results in a new window?", $sd['results_click_blank']);
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $o = new wpdreamsYesNo("scroll_to_results", "Sroll the window to the result list?", $sd['scroll_to_results']);
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $o = new wpdreamsYesNo("resultareaclickable", "Make the whole result area clickable?", $sd['resultareaclickable']);
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $o = new wpdreamsYesNo("close_on_document_click", "Close result list on document click?", $sd['close_on_document_click']);
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item"><?php
    $o = new wpdreamsText("noresultstext", "No results text", $sd['noresultstext']);
    $params[$o->getName()] = $o->getData();
    ?></div>
<div class="item"><?php
    $o = new wpdreamsText("didyoumeantext", "Did you mean text", $sd['didyoumeantext']);
    $params[$o->getName()] = $o->getData();
    ?></div>