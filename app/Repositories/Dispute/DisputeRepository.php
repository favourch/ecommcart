<?php

namespace App\Repositories\Dispute;

use Illuminate\Http\Request;

interface DisputeRepository{

    public function open();

    public function closed();

    public function storeResponse(Request $request, $dispute);

    public function recentlyUpdated();
}