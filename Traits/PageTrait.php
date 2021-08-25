<?php

namespace App\Traits;

trait PageTrait
{
    public function page()
    {
        return new \App\Models\Page(get_the_id());
    }
}