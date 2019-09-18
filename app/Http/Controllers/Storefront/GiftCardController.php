<?php

namespace App\Http\Controllers\Storefront;

use App\GiftCard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GiftCardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $giftCards = GiftCard::all();

        return view('gift_cards', compact('giftCards'));
    }
}
