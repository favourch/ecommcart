<?php

namespace App\Repositories\GiftCard;

interface GiftCardRepository {
    public function valid();

    public function invalid();
}