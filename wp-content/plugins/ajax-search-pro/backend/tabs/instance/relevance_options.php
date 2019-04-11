<ul id="subtabs"  class='tabs'>
    <li><a tabid="801" class='subtheme current asp_be_rel_subtab asp_be_rel_regular'>Regular Engine</a></li>
    <li><a tabid="802" class='subtheme asp_be_rel_subtab asp_be_rel_index'>Index Table Engine</a></li>
</ul>
<div class='tabscontent' id="asp_be_rel_subtabs">
    <p class='infoMsg'>
        Every result gets a relevance value based on the weight numbers set below. The weight is the measure of
        importance.<br/>
        If you wish to change the the results basic ordering, then you can do it under the <a href="#107">General Options -> Ordering</a> panel.
    </p>

    <div tabid="801" class="asp_be_rel_subtab asp_be_rel_regular">

        <?php include(ASP_PATH."backend/tabs/instance/relevance/regular.php"); ?>

    </div>
    <div tabid="802" class="asp_be_rel_subtab asp_be_rel_index">

        <?php include(ASP_PATH."backend/tabs/instance/relevance/index_table.php"); ?>

    </div>
</div>
<div class="item">
    <input name="reset_<?php echo $search['id']; ?>" class="asp_submit asp_submit_transparent asp_submit_reset" type="button" value="Restore defaults">
    <input name="submit_<?php echo $search['id']; ?>" type="submit" value="Save all tabs!" />
</div>

