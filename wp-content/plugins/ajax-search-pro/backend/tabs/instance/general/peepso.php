<fieldset>
    <legend>Peepso Groups</legend>
    <div class="item item item-flex-nogrow" style="flex-wrap: wrap;">
        <?php
        $o = new wpdreamsYesNo("peep_gs_public", "Search Public:", $sd['peep_gs_public']);
        $params[$o->getName()] = $o->getData();

        $o = new wpdreamsYesNo("peep_gs_closed", " ..Closed:", $sd['peep_gs_closed']);
        $params[$o->getName()] = $o->getData();

        $o = new wpdreamsYesNo("peep_gs_secret", " ..Secret:", $sd['peep_gs_secret']);
        $params[$o->getName()] = $o->getData();
        ?><div>&nbsp;&nbsp;&nbsp;PeepSo groups.</div>
    </div>
    <div class="item item item-flex-nogrow" style="flex-wrap: wrap;">
        <?php
        $o = new wpdreamsYesNo("peep_gs_title", "Search within group titles:", $sd['peep_gs_title']);
        $params[$o->getName()] = $o->getData();

        $o = new wpdreamsYesNo("peep_gs_content", " ..and descriptions:", $sd['peep_gs_content']);
        $params[$o->getName()] = $o->getData();

        $o = new wpdreamsYesNo("peep_gs_categories", " .. and categories:", $sd['peep_gs_categories']);
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
    <div class="item">
        <?php
        $o = new wpdreamsTextarea("peep_gs_exclude", "Exclude Groups by ID", $sd['peep_gs_exclude']);
        $params[$o->getName()] = $o->getData();
        ?>
        <p class="descMsg">Comma separated list.</p>
    </div>
</fieldset>
<fieldset>
    <legend>Peepso Group Activities - Posts and Comments</legend>
    <div class="item item item-flex-nogrow" style="flex-wrap: wrap;">
        <?php
        $o = new wpdreamsYesNo("peep_s_posts", "Search Group Posts:", $sd['peep_s_posts']);
        $params[$o->getName()] = $o->getData();

        $o = new wpdreamsYesNo("peep_s_comments", " and Comments:", $sd['peep_s_comments']);
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
    <div class="item">
        <?php
        $o = new wpdreamsYesNo("peep_pc_follow", "Search activities only within groups, which the user follows?", $sd['peep_pc_follow']);
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
    <div class="item item item-flex-nogrow" style="flex-wrap: wrap;">
        <?php
        $o = new wpdreamsYesNo("peep_pc_public", "Include activities only from public", $sd['peep_pc_public']);
        $params[$o->getName()] = $o->getData();

        $o = new wpdreamsYesNo("peep_pc_closed", " ..Closed:", $sd['peep_pc_closed']);
        $params[$o->getName()] = $o->getData();

        $o = new wpdreamsYesNo("peep_pc_secret", " ..Secret:", $sd['peep_pc_secret']);
        $params[$o->getName()] = $o->getData();
        ?><div>&nbsp;&nbsp;&nbsp;PeepSo groups.</div>
    </div>
</fieldset>