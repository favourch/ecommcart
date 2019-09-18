<?php

namespace App\Repositories\Message;

use Illuminate\Http\Request;

interface MessageRepository{

    public function labelOf($label);

    public function statusOf($status);

    public function createdByMe();

    public function markAsRead(Request $request, $message);

    public function updateStatusOrLabel(Request $request, $message, $statusOrLabel, $type);

    public function massUpdate($ids, $statusOrLabel, $type);

    public function storeReply(Request $request, $message);

    public function massDestroy($ids);
}