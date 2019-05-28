<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class ContentController extends Controller
{
    public function get(Request $request, $hashtag)
    {
        $this->validate($request, ['limit' => 'optional|integer|min:1|max:10']);
    }
}
