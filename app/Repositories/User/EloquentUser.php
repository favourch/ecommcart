<?php

namespace App\Repositories\User;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentUser extends EloquentRepository implements BaseRepository, UserRepository
{
	protected $model;

	public function __construct(User $user)
	{
		$this->model = $user;
	}

    public function all()
    {
        if (!Auth::user()->isFromPlatform())
            return $this->model->level()->mine()->with('role', 'image', 'primaryAddress')->get();

        return $this->model->level()->fromPlatform()->with('role', 'image', 'primaryAddress')->get();
    }

    public function trashOnly()
    {
        if (!Auth::user()->isFromPlatform())
            return $this->model->level()->mine()->onlyTrashed()->with('image')->get();

        return $this->model->level()->fromPlatform()->onlyTrashed()->with('image')->get();
    }

    public function addresses($user)
    {
        return $user->addresses()->get();
    }

    public function store(Request $request)
    {
        $user = parent::store($request);

        $this->saveAdrress($request->all(), $user);

        if ($request->hasFile('image'))
            $user->saveImage($request->file('image'));

        return $user;
    }

    public function update(Request $request, $id)
    {
        $user = parent::update($request, $id);

        if ($request->hasFile('image') || ($request->input('delete_image') == 1))
            $user->deleteImage();

        if ($request->hasFile('image'))
            $user->saveImage($request->file('image'));

        return $user;
    }

    public function destroy($id)
    {
        $user = parent::findTrash($id);

        $user->flushAddresses();

        $user->flushImages();

        return $user->forceDelete();
    }

    public function saveAdrress(array $address, $user)
    {
        $user->addresses()->create($address);
    }
}