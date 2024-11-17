<?php if (!defined('ABSPATH') || !is_admin()) exit;

// Don't return the form if user doesn't have the capabilities
if(!current_user_can("publish_pages")):
    echo '<p class="message message-error">' . esc_attr('You don\'t have permission to create pages','rc-spintax-post-creator') . '</p>';        
else: // allowed user capabilities
    $nonce = wp_create_nonce('rc_spintax_post_creator_nonce');

    $type = 'post';
    $status = 'draft';
    $change_kw = '';
    $titles = '';
    $spintax = '';
    $keywords = '';

    if(isset($_POST[$nonce]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST[$nonce])), '_create_nonce')){
        $type = isset($_POST['type']) ? sanitize_text_field(wp_unslash($_POST['type'])) : 'post';
        $status = isset($_POST['status']) ? sanitize_text_field(wp_unslash($_POST['status'])) : 'draft';
        $change_kw = isset($_POST['change_kw']) ? sanitize_text_field(wp_unslash($_POST['change_kw'])): '';
        $titles = isset($_POST['spintax_title']) ? sanitize_textarea_field(wp_unslash($_POST['spintax_title'])) : '';
        $spintax = isset($_POST['spintax_text']) ? wp_kses_post(wp_unslash($_POST['spintax_text'])) : '';
        $keywords = isset($_POST['keywords']) ? sanitize_textarea_field(wp_unslash($_POST['keywords'])) : '';
    }

include_once 'inc/header.php'; ?>


<h1><?php esc_attr_e('Create Posts or Pages', 'rc-spintax-post-creator');?></h1>


<?php
    if( // Check if all the fields are completed
        !empty($type) && 
        !empty($status) && 
        !empty($change_kw) &&
        !empty($titles) && 
        !empty($spintax) && 
        !empty($keywords) 
        ){
            // if all the fields completed, do the work
            $creator = new RC_SPC_Creator($type, $status, $change_kw, $titles, $spintax, $keywords);
            $count = $creator->init();
            if($type == "post"){
                /* translators: %s: number of posts created */
                echo '<div class="notification notification-success"><p>' . sprintf(esc_attr('%s posts created','rc-spintax-post-creator'), intval($count)) . '</p></div>';
            }
            else{
                /* translators: %s: number of pages created */
                echo '<div class="notification notification-success"><p>' . sprintf(esc_attr('%s pages created','rc-spintax-post-creator'), intval($count)) . '</p></div>';
            }
        } else {
            if (!empty($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST")  //Return message if empty field on Submit
                echo '<div class="notification notification-error"><p>' . esc_attr('Please complete all the fields','rc-spintax-post-creator') . '</p></div>';
        }
    ?>

    <form method="post">
        <?php wp_nonce_field('_create_nonce',esc_attr($nonce));?>
    <table class="form-table">
    <tr>
        <th scope="row">
            <label for="type"><?php esc_attr_e('Publish as Page or Post?','rc-spintax-post-creator');?></label>
        </th>
        <td>
            <input type="radio" name="type" value="post" <?php checked(esc_attr($type), "post");?>/><span><?php esc_attr_e('Post','rc-spintax-post-creator');?></span>
            <input type="radio" name="type" value="page" <?php checked(esc_attr($type), "page");?>/><span><?php esc_attr_e('Page','rc-spintax-post-creator');?></span>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="status"><?php esc_attr_e('Publish or Draft','rc-spintax-post-creator');?></label>
        </th>
        <td>
            <input type="radio" name="status" value="publish" <?php checked(esc_attr($status), "publish");?>/><span><?php esc_attr_e('Publish','rc-spintax-post-creator');?></span>
            <input type="radio" name="status" value="draft" <?php checked(esc_attr($status), "draft");?>/><span><?php esc_attr_e('Draft','rc-spintax-post-creator');?></span>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="change_kw"><?php esc_attr_e('Word from text to replace with the Keyword','rc-spintax-post-creator');?></label>
        </th>
        <td>
            <input type="text" name="change_kw" id="change_kw" value="<?php echo esc_attr($change_kw);?>" placeholder="<?php esc_attr_e('To Replace','rc-spintax-post-creator');?>"/>
        </td>
    </tr>
    <tr>
        <th scope="row">
        <label for="spintax_title"><?php esc_attr_e('Spintax Title','rc-spintax-post-creator');?></label>
        </th>
        <td>
        <textarea class="large-text" name="spintax_title" id="spintax_title" rows="5" placeholder="<?php esc_attr_e('Spintax for Title','rc-spintax-post-creator');?>"><?php echo esc_textarea($titles);?></textarea>
        </td>
    </tr>
    <tr>
        <th scope="row">
        <label for="spintax_text"><?php esc_attr_e('Spintax Text','rc-spintax-post-creator');?></label>
        </th>
        <td>
        <textarea class="large-text" name="spintax_text" id="spintax_text" rows="5" placeholder="<?php esc_attr_e('Spintax for Text','rc-spintax-post-creator');?>"><?php echo esc_textarea($spintax);?></textarea>
        </td>
    </tr>
    <tr>
        <th scope="row">
        <label for="keywords"><?php esc_attr_e('Keyword (One each line)','rc-spintax-post-creator');?></label>
        </th>
        <td>
        <textarea class="large-text" name="keywords" id="keywords" rows="5" placeholder="<?php esc_attr_e('Keywords','rc-spintax-post-creator');?>"><?php echo esc_textarea($keywords);?></textarea>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="submit" class="btn button-primary" value="<?php esc_attr_e('Create pages or posts','rc-spintax-post-creator');?>"/>
        </td>
    </tr>
    <tr>
        <td></td>
        <td class="alignright">
        <span id="off_btn" class="offbtn"><?php esc_attr_e('Fill with TEST content','rc-spintax-post-creator');?></span>
        </td>
    </tr>
    </table>
    </form>

<?php include_once 'inc/footer.php';?>

<?php endif; // End allowed user capabilities ?>