<?php

namespace App\Models;

abstract class AbstractCPT {
    CONST NAME = '';

    CONST LABELS = array(
        'name' => '',
        'all_items' => '',
        'singular_name' => '',
        'add_new_item' => '',
        'edit_item' => '',
        'menu_name' => '',
    );

    CONST SUPPORTS = array('title', 'editor','thumbnail');
    CONST MENU_POSITION = 5;
    CONST HAS_ARCHIVE = true;

    CONST ICON = 'dashicons-admin-customizer';

    public function __construct() {}

    public static function init() {
        add_action('init', array(get_called_class(), 'register_CPT'));
    }

    public static function register_CPT() {
        $args = array(
            'labels' => get_called_class()::LABELS,
            'public' => true,
            'show_in_rest' => true,
            'has_archive' => get_called_class()::HAS_ARCHIVE,
            'supports' => get_called_class()::SUPPORTS,
            'menu_position' => get_called_class()::MENU_POSITION,
            'menu_icon' => get_called_class()::ICON,
        );

        register_post_type(get_called_class()::NAME, $args);
    }

    public static function findAll($customArgs = []) {
        $defaultArgs = array(  
            'post_type' => get_called_class()::NAME,
            'post_status' => 'publish',
            'posts_per_page' => -1, 
            'orderby' => 'date', 
            'order' => 'DESC', 
        );

        $args = array_merge($defaultArgs, $customArgs);

        $posts = get_posts($args);
        $model = get_called_class();

        return array_map(function($post) use ($model) {
            return new $model($post->ID);
        }, $posts);
    }
}