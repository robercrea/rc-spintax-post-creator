<?php
/**
 * author: Rober Crea
 * uri: https://robercrea.com
 * desc: menu pages footer
 * since: 1.0
 */

defined('ABSPATH') || exit;

?>

</section> <!-- end content -->

<footer>
    <section>
        <img src="<?php echo esc_url(RC_SPC_URL)?>images/robercrea.svg"/>
        <p>
            <?php esc_attr_e('Visit', 'rc-spintax-post-creator');?> 
            <a href="https://robercrea.com/" target="_blank">robercrea.com</a> 
            <?php esc_attr_e('to discover more plugins!', 'rc-spintax-post-creator');?>
        </p>
        <a class="smallbtn" target="_blank" href="<?php echo esc_html(RC_SPC_URI);?>"><?php esc_attr_e('Report Bug/Leave Comment', 'rc-spintax-post-creator');?></a>
    </section>
</footer>

</div><!-- end rc-admin -->