<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package understrap
 */

if ( ! is_active_sidebar( 'left-sidebar' ) ) {
	return;
}

// when both sidebars turned on reduce col size to 3 from 4.
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>

<?php if ( 'both' === $sidebar_pos ) : ?>
<div class="col-md-3 widget-area" id="left-sidebar" role="complementary">
	<?php else : ?>
<div class="col-md-4 widget-area" id="left-sidebar" role="complementary">
	<?php endif; ?>
<?php 
    // dynamic_sidebar( 'left-sidebar' ); 
?>

    <h4 class="black">Renegade</h4>
    <p>151 West 25th Street, 11th Floor
        <br> New York, NY 10001</p>
    <div class="bold">Phone:
        <a href="tel:646-838-9000" style="color:#000;">646-838-9000</a>
    </div>
    <div class="sep"></div>
    <h5 class="black">Contact:</h5>
    <p>
        <a class="green" href="mailto:dneisser@renegade.com">Drew Neisser</a>
    </p>
    <div class="sep"></div>
    <h5 class="black">Directions</h5>
    <p>151 West 25th Street is located between 6th and 7th Avenues.</p>
    <div class="sep"></div>
    <h5 class="black">Subways</h5>
    <div style="width: 100%;">
        <div class="subway-ct">
            <div class="subway" style="background: #f78200;">F</div>
            <div class="subway" style="background: #f78200;">M</div>
        </div>
        <p>
            <!--subway-ct-->
        </p>
    </div>
    <p>Take the F or M, to 23rd Street. From there, walk two blocks north on 6th Ave.</p>
    <div class="subway-ct">
        <div class="subway" style="background: #f11d17;">1</div>
        <div class="subway" style="background: #f11d17;">2</div>
    </div>
    <p>
        <!--subway-ct-->
    </p>
    <p>Take the 1 or 2 to 23rd Street and walk two blocks north on 7th Ave.</p>
    <div class="subway-ct">
        <div class="subway" style="background: #009e54;">5</div>
    </div>
    <p>
        <!--subway-ct-->
    </p>
    <p>Alternatively, take the 5 to 23rd Street and walk two blocks north on 7th Ave.</p>

</div><!-- #left-sidebar -->
