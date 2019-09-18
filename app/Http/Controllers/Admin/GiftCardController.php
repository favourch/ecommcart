<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Repositories\GiftCard\GiftCardRepository;
use App\Http\Requests\Validations\CreateGiftCardRequest;
use App\Http\Requests\Validations\UpdateGiftCardRequest;

class GiftCardController extends Controller
{
    use Authorizable;

    private $model_name;

    private $giftCard;

    /**
     * construct
     */
    public function __construct(GiftCardRepository $giftCard)
    {
        parent::__construct();

        $this->model_name = trans('app.model.gift_card');

        $this->giftCard = $giftCard;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $valid_cards = $this->giftCard->valid();

        $invalid_cards = $this->giftCard->invalid();

        $trashes = $this->giftCard->trashOnly();

        return view('admin.gift-card.index', compact('valid_cards', 'invalid_cards', 'trashes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gift-card._create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGiftCardRequest $request)
    {
        $this->giftCard->store($request);

        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $giftCard = $this->giftCard->find($id);

        return view('admin.gift-card._show', compact('giftCard'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $giftCard = $this->giftCard->find($id);

        return view('admin.gift-card._edit', compact('giftCard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGiftCardRequest $request, $id)
    {
        $this->giftCard->update($request, $id);

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request, $id)
    {
        $this->giftCard->trash($id);

        return back()->with('success', trans('messages.trashed', ['model' => $this->model_name]));
    }

    /**
     * Restore the specified resource from soft delete.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $this->giftCard->restore($id);

        return back()->with('success', trans('messages.restored', ['model' => $this->model_name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->giftCard->destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));
    }
}
