<?php 
if (!defined('ABSPATH')) exit; // Exit if accessed directly

class RC_SPC_Creator{
    
    private $type;
    private $status;
    private $change_kw;
    private $titles;
    private $spintax;
    private $keywords;

    function __construct($type, $status, $change_kw, $titles, $spintax, $keywords){
        $this->type = $type;
        $this->status = $status;
        $this->change_kw = $change_kw;
        $this->titles = $titles;
        $this->spintax = $spintax;
        $this->keywords = $keywords;
    }

    // We get the keywords, one by line and create post
    function init(){
        $kw_list = explode("\n", $this->keywords);
        $count = 0;
        foreach($kw_list as $kw){
            $this->create_post(trim($kw));
            $count = $count + 1;
        }
        return $count;
    }
    
    // Create post
    function create_post($kw){
        
        // Generate random title
        $title = $this->generate_random($this->titles);
        $title = str_replace($this->change_kw, $kw, $title);

        // Generate random content
        $content = $this->generate_random($this->spintax);
        $content = str_replace($this->change_kw, $kw, $content);

        // Post or page content
        $args = array(
            'post_content'  =>  wp_kses_post($content),
            'post_title'    =>  sanitize_text_field($title),
            'post_status'   =>  $this->sanitized_status(),
            'post_type'     =>  $this->sanitized_post_type()
        );

        // Insert post or page
        wp_insert_post($args);
    }

    // Sanitize status to only the two valid options
    function sanitized_status(){
        if($this->status == "publish" || $this->status == "draft") return $this->status;
        else return "draft";
    }

    // Sanitize post type to only the two valid options
    function sanitized_post_type(){
        if($this->type == "post" || $this->type == "page") return $this->type;
        else return "post";
    }
    
    // Generating random text from spintax
    function generate_random($text){
        return preg_replace_callback('/\{(((?>[^\{\}]+)|(?R))*)\}/x', array($this, 'replace_text'), $text );
    }

    // Generating random text
    function replace_text($text){
        $text = $this->generate_random( $text[ 1 ] );
        $parts = explode( '|', $text );
        $part = $parts[ array_rand( $parts ) ];
        return $part;
    }
}