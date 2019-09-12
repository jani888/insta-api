<?php

namespace App\Http\Controllers;

use App\Models\InstagramAccount;
use Illuminate\Http\Request;

class AccountSelectorController extends Controller
{

    public function set(Request $request) {
        abort_unless(auth()->user()->accounts->contains('id', $request->account), 404);
        auth()->user()->update(['current_account_id' => $request->account]);
        return back();
    }
}
