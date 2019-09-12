<?php

namespace App\Http\Controllers;

class DashboardController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $followers = auth()->user()->currentAccount->followers()->orderBy('created_at', 'DESC')->take(30)->get();
        $followersChart = [
            'week' => [
                'series' => $followers->slice(0, 7)->pluck('value')->reverse()->values(),
                'labels' => $followers->slice(0, 7)->map(function ($item) {
                    return $item->created_at->format('M d');
                })->reverse()->values(),
            ],
            'month' => [
                'series' => $followers->pluck('value')->reverse()->values(),
                'labels' => $followers->map(function ($item) {
                    return $item->created_at->format('M d');
                })->reverse()->values(),
            ]
        ];
        return view('dashboard', compact('followersChart'));
    }
}
