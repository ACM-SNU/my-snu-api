<?php

namespace App\Api\V1\Transformers;

use App\Lost;
use League\Fractal\TransformerAbstract;
use Illuminate\Support\Collection;

class LostTransformer extends TransformerAbstract
{
    public function transform(Lost $lost)
    {
        return [
            'what'  =>  $lost->what,
            'where' =>  $lost->where,
            'when'  =>  $lost->when,
            'description'   =>  $lost->description
        ];
    }
}