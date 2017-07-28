<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\FoundTransformer;
use App\Found;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Dingo\Api\Exception\ValidationHttpException;
use Dingo\Api\Routing\Helpers;


class FoundController extends Controller
{
    use Helpers;

    public function store(Request $request)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();
        $validator = Validator::make($request->all(), [
            'what' => 'required',
            'where' => 'required',
            'when' => 'required'
        ]);
        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors()->all());
        }

        $description = '';
        if ($request->has('description')) {
            $description = $request->input('description');
        }
        Found::create([
            'what' => $request->input('what'),
            'where' => $request->input('where'),
            'when' => $request->input('when'),
            'description' => $description,
            'user_id'   => $currentUser->id
        ]);

        return $this->response->created();
    }


    public function index()
    {
        $lost = Found::paginate(10);
        return $this->response()->paginator($lost, new FoundTransformer());
    }
}
