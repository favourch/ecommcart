<?php

namespace App\Repositories\Ticket;

use Illuminate\Http\Request;

interface TicketRepository{

    public function open();

    public function closed();

    public function unAssigned();

    public function assignedToMe();

    public function storeReply(Request $request, $ticket);

    public function assign(Request $request, $ticket);

    public function reopen(Request $request, $ticket);

    public function recentlyUpdated();

    public function search($text);
}