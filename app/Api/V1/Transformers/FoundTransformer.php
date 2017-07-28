<?php

namespace App\Api\V1\Transformers;

use App\Found;
use League\Fractal\TransformerAbstract;
use Illuminate\Support\Collection;

class FoundTransformer extends TransformerAbstract
{
    public function transform(Found $found)
    {
        return [
            'what'  =>  $found->what,
            'where' =>  $found->where,
            'when'  =>  $found->when,
            'description'   =>  $found->description,
            'user_name' =>  $found->user->name,
            'user_email'    =>  $found->user->email
        ];
    }
}