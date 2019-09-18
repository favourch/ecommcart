<?php
	// giftCards
	Route::delete('giftCard/{giftCard}/trash', 'GiftCardController@trash')->name('giftCard.trash'); // giftCard move to trash

	Route::get('giftCard/{giftCard}/restore', 'GiftCardController@restore')->name('giftCard.restore');

	Route::resource('giftCard', 'GiftCardController');
