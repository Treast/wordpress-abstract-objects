<?php

namespace App\Models;

abstract class AbstractModel {
    public $id;
    public $title;
    public $permalink;
    public $content;
    public $thumbnail;
    
    public function __construct($id) {
        $this->id = $id;
        $this->title = get_the_title($id);
        $this->permalink = get_permalink($id);
        $this->content = get_the_content($id);
        $this->thumbnail = get_the_post_thumbnail($id);
    }
}