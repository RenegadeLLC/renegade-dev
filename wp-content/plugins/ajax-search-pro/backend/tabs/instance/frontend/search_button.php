<div class="item">
    <?php
    $o = new wpdreamsYesNo("fe_search_button", "Display a search button within the settings drop-down?", $sd['fe_search_button']);
    ?>
</div>
<fieldset id="fe_sb_functionality">
    <legend>Functionality</legend>
    <div class="item item-flex-nogrow" style="flex-wrap: wrap;">
        <?php
        foreach ($_red_opts as $rok => $rov)
            if ( $rov['value'] == 'same' || $rov['value'] == 'nothing' )
                unset($_red_opts[$rok]);
        $o = new wpdreamsCustomSelect("fe_sb_action", "Action when pressing the button",
            array(
                'selects' => $_red_opts,
                'value' => $sd['fe_sb_action']
            ));
        $params[$o->getName()] = $o->getData();
        $o = new wpdreamsCustomSelect("fe_sb_action_location", " location: ",
            array(
                'selects' => array(
                    array('option' => 'Use same tab', 'value' => 'same'),
                    array('option' => 'Open new tab', 'value' => 'new')
                ),
                'value' => $sd['fe_sb_action_location']
            ));
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
    <div class="item">
        <?php
        $o = new wpdreamsText("fe_sb_redirect_url", "Custom redirect URL",
            $sd['fe_sb_redirect_url']);
        $params[$o->getName()] = $o->getData();
        ?>
        <p class="descMsg">You can use the <string>asp_redirect_url</string> filter to add more variables. See <a href="http://wp-dreams.com/go/?to=kb-redirecturl" target="_blank">this tutorial</a>.</p>
    </div>
</fieldset>
<fieldset id="fe_search_button">
    <legend>Visual</legend>
    <div class="item">
        <?php
        $o = new wpdreamsText("fe_sb_text", "Button text", $sd['fe_sb_text']);
        ?>
    </div>
    <div class="item">
        <?php
        $o = new wpdreamsCustomSelect("fe_sb_align", "Button alignment",
            array(
                'selects' => array(
                    array('option' => 'Left', 'value' => 'left'),
                    array('option' => 'Right', 'value' => 'right'),
                    array('option' => 'Center', 'value' => 'center')
                ),
                'value' => $sd['fe_sb_align']
            ));
        ?>
    </div>
    <div class="item">
        <?php $o = new wpdreamsColorPicker("fe_sb_bg", "Background color", $sd['fe_sb_bg']); ?>
    </div>
    <div class="item">
        <?php $o = new wpdreamsBorder("fe_sb_border", "Button border", $sd['fe_sb_border']); ?>
    </div>
    <div class="item">
        <?php $o = new wpdreamsBoxShadow("fe_sb_boxshadow", "Button box-shadow", $sd['fe_sb_boxshadow']); ?>
    </div>
    <div class="item item-flex-nogrow">
        <?php
        $o = new wd_ANInputs("fe_sb_padding", "Padding",
            array(
                'args' => array(
                    'inputs' => array(
                        array('Top', '0px'),
                        array('Right', '0px'),
                        array('Buttom', '0px'),
                        array('Left', '0px')
                    )
                ),
                'value' => $sd['fe_sb_padding']
            ));
        $o = new wd_ANInputs("fe_sb_margin", "Margin",
            array(
                'args' => array(
                    'inputs' => array(
                        array('Top', '0px'),
                        array('Right', '0px'),
                        array('Buttom', '0px'),
                        array('Left', '0px')
                    )
                ),
                'value' => $sd['fe_sb_margin']
            ));
        ?>
    </div>
    <div class="item">
        <?php
        $o = new wpdreamsFontComplete("fe_sb_font", "Button font", $sd['fe_sb_font']);
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
    <div style="display:none !important;">
        <input name="fe_sb_theme" type="hidden" value="default">
        <div class="triggerer"></div>
    </div>
    <div id="fe_sb_themes" style="display:none !important;"><?php echo json_encode(json_decode($_sb_themes)); ?></div>
    <div id="fe_sb_popup" class="hiddend"></div>
    <a href="#" id="fe_sb_trigger">Select a button theme</a>
    <div id="fe_sb_preview">
        <button class="asp_search_btn asp_s_btn">Search!</button>
    </div>
    <style id="fe_sb_css"></style>
</fieldset>
<?php if (ASP_DEBUG == 1): ?>
    <textarea id="sb_previewtext"></textarea>
    <script>
    jQuery(function($){
        $("#sb_previewtext").click(function(){
            var skip = ['fe_sb_text', 'fe_sb_align'];
            var parent = $('#fe_search_button');
            var content = "";
            var v = "";
            parent.find("input[isparam=1], select[isparam=1]").each(function(){
                var name = $(this).attr("name");
                if ( skip.indexOf(name) > -1 )
                    return true;
                var val = $(this).val().replace(/(\r\n|\n|\r)/gm,"");
                content += '"'+name+'":"'+val+'",\n';
            });

            content = content.trim();
            content = content.slice(0, - 1);
            $(this).val('"theme": {\n' + content + "\n}");
        });
    });
    </script>
<?php endif; ?>