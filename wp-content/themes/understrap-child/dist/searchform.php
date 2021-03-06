<?php
/**
 * The template for displaying search forms in Underscores.me
 *
 * @package understrap
 */

?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<div class="input-group">
		<input class="field form-control" id="s" name="s" type="text"
			placeholder="<?php esc_attr_e( 'Search &hellip;', 'understrap' ); ?>" value="<?php the_search_query(); ?>">
		<span class="input-group-append">
			<!-- <input class="submit btn btn-primary" id="searchsubmit" name="submit" type="submit" value> -->
            <button class="submit btn btn-primary" id="searchsubmit" type="submit" name="submit">
                <i class="fa fa-search"></i>
            </button>
	    </span>
	</div>
</form>
