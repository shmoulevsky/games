<?php

namespace App\Modules\Admin\Tag\Services;

class TagService
{
    public function make($tags)
    {
        $tagResult = [];

        foreach ($tags as $tag){
            $tagResult[] = [
                'title' => $tag->tag,
                'url' => $tag->url,
                'selected' => false,
            ];
        }

        return $tagResult;
    }
}
