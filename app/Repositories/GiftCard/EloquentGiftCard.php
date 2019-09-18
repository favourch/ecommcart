<?php

namespace App\Repositories\GiftCard;

use App\GiftCard;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentGiftCard extends EloquentRepository implements BaseRepository, GiftCardRepository
{
	protected $model;

	public function __construct(GiftCard $giftCard)
	{
		$this->model = $giftCard;
	}

    public function valid()
    {
        return $this->model->valid()->with('image:path,imageable_id,imageable_type')->get();
    }

    public function invalid()
    {
        return $this->model->invalid()->get();
    }

    public function store(Request $request)
    {
        $giftCard = parent::store($request);

        if ($request->hasFile('image'))
            $giftCard->saveImage($request->file('image'));

        return $giftCard;
    }

    public function update(Request $request, $id)
    {
        $giftCard = parent::update($request, $id);

        if ($request->hasFile('image') || ($request->input('delete_image') == 1))
            $giftCard->deleteImage();

        if ($request->hasFile('image'))
            $giftCard->saveImage($request->file('image'));

        return $giftCard;
    }

}