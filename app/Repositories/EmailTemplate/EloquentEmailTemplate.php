<?php

namespace App\Repositories\EmailTemplate;

use Auth;
use App\EmailTemplate;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentEmailTemplate extends EloquentRepository implements BaseRepository, EmailTemplateRepository
{
	protected $model;

	public function __construct(EmailTemplate $emailTemplate)
	{
		$this->model = $emailTemplate;
	}

    public function all()
    {
        if (!Auth::user()->isFromPlatform())
            return $this->model->mine()->get();

        return parent::all();
    }

    public function trashOnly()
    {
        if (!Auth::user()->isFromPlatform())
            return $this->model->mine()->onlyTrashed()->get();

        return parent::trashOnly();
    }
}