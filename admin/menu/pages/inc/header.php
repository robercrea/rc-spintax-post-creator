<?php
/**
 * author: Rober Crea
 * uri: https://robercrea.com
 * desc: menu pages header
 * since: 1.0
 */

defined('ABSPATH') || exit;

?>

<div class="robercrea-admin"> 
<header>
    <section>
            <img id="h_logo" src="<?php echo esc_url(RC_SPC_URL)?>images/icon.svg"/>
            <h1><?php esc_attr_e('Spintax Post Creator', 'rc-spintax-post-creator');?></h1>
            <a href="https://buymeacoffee.com/robercrea" target="_blank"><img id="bmac" src="<?php echo esc_url(RC_SPC_URL)?>images/btn_bmac.png"/></a>
    </section>
</header>


<section class="content">