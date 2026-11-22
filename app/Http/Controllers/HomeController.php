<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Event;
use App\Models\Product;
use App\Models\UserMembership;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::latest()->limit(6)->get();
        $events = Event::latest()->limit(4)->get();
        $ads = Ads::latest()->get();
        return view('pages.home', [
            'products' => $products,
            'events' => $events,
            'ads' => $ads
        ]);
    }

    public function membership()
    {
        $membership = UserMembership::all();
        $membership->load('user', 'chapter');
        return response($membership);
    }

    public function detailProduct($id)
    {
        $product = Product::where('slug', $id)->first();
        return view('pages.product-detail', [
            'product' => $product,
        ]);
    }

    public function detailEvent($id)
    {
        $event = Event::where('slug', $id)->first();
        
        return view('pages.event-detail', [
            'event' => $event,
        ]);
    }

    public function eventPage(){
        $currentDate = Carbon::now();
        $eventsfinished = Event::whereDate('start_date', '<=', $currentDate)->paginate(6);
        $eventsunfinished = Event::whereDate('start_date', '>=', $currentDate)->orWhere('is_comingsoon', '1')->paginate(6);
        $eventlimited = Event::whereDate('start_date', '>=', $currentDate)->orWhere('is_comingsoon', '1')->limit(6)->get();
        return view('pages.event', [
            'eventsfinished' => $eventsfinished,
            'eventsunfinished' => $eventsunfinished,
            'eventlimited' => $eventlimited
        ]);
    }

    public function marketPage(){
        $products = Product::latest()->paginate(6);
        $events = Event::latest()->limit(2)->get();

        return view('pages.marketplace', [
            'events' => $events,
            'products' => $products
        ]);
    }

    public function aboutusPage(){
        return view('pages.aboutus');
    }
}
