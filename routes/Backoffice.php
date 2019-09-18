<?php
// Installer routes
include('admin/Installer.php');

include('admin/Auth.php');

// Admin Routes
Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'as' => 'admin.', 'prefix' => 'admin'], function()
{
	// Markerplace Admin only routes
	Route::middleware(['admin'])->group(function ()
	{
		Route::group(['namespace' => 'Report'], function()
		{
			include('admin/Report.php');
			include('admin/Visitor.php');
		});
	});

	// Merchant only routes
	Route::middleware(['merchant'])->group(function ()
	{
		Route::group(['namespace' => 'Report'], function()
		{
			include('admin/ShopReport.php');
		});
	});

	// Account Routes for Merchant and Admin
	Route::group(['as' => 'account.', 'prefix' => 'account'], function()
	{
		include('admin/Account.php');
		include('admin/Billing.php');
	});

	Route::get('secretLogout', 'DashboardController@secretLogout')->name('secretLogout');
	Route::middleware(['subscribed'])->group(function ()
	{
		// Dashboard
		Route::put('dashboard/config/{node}/toggle', 'DashboardController@toggleConfig')->name('dashboard.config.toggle')->middleware('ajax');
		Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard')->middleware('dashboard');
		Route::get('secretLogin/{user}', 'DashboardController@secretLogin')->name('user.secretLogin');

		include('admin/Notification.php');

		// Merchant Routes for Admin
		Route::group(['as' => 'admin.', 'prefix' => 'admin'], function()
		{
			include('admin/User.php');
			include('admin/Customer.php');
		});

		// Vendors Routes for Admin
		Route::group(['as' => 'vendor.', 'prefix' => 'vendor'], function()
		{
			include('admin/Merchant.php');
			include('admin/Shop.php');
		});

		// Catalog Routes for Admin
		Route::group(['as' => 'catalog.', 'prefix' => 'catalog'], function()
		{
			include('admin/CategoryGroup.php');
			include('admin/CategorySubGroup.php');
			include('admin/Category.php');
			include('admin/Product.php');
			include('admin/Attribute.php');
			include('admin/AttributeValues.php');
			include('admin/Manufacturer.php');
		});

		// Stock Routes for Admin
		Route::group(['as' => 'stock.', 'prefix' => 'stock'], function()
		{
			include('admin/Inventory.php');
			include('admin/Warehouse.php');
			include('admin/Supplier.php');
		});

		// Shipping Routes for Admin/Merchant
		Route::group(['as' => 'shipping.', 'prefix' => 'shipping'], function()
		{
			include('admin/ShippingZone.php');
			include('admin/ShippingRate.php');
			include('admin/Carrier.php');
			include('admin/Packaging.php');
		});

		// Order Routes for Admin/Merchant
		Route::group(['as' => 'order.', 'prefix' => 'order'], function()
		{
			include('admin/Order.php');
			include('admin/Cart.php');
		});

		// Utility Routes for Admin/Merchant
		Route::group(['as' => 'utility.', 'prefix' => 'utility'], function()
		{
			include('admin/Faq.php');
			include('admin/Page.php');
			include('admin/Blog.php');
			include('admin/Currency.php');
			include('admin/OrderStatus.php');
		});

		// Settings Routes for Admin/Merchant
		Route::group(['as' => 'setting.', 'prefix' => 'setting'], function()
		{
			include('admin/UserRole.php');
			include('admin/Tax.php');
			include('admin/EmailTemplate.php');
			include('admin/Config.php');
			include('admin/System.php');
			include('admin/SystemConfig.php');
			include('admin/PaymentConfig.php');
			include('admin/SubscriptionPlan.php');
			include('admin/Announcement.php');
		});

		// Appearances Routes for Admin
		Route::group(['as' => 'appearance.', 'prefix' => 'appearance'], function()
		{
			include('admin/Theme.php');
			include('admin/Banner.php');
			include('admin/Slider.php');
		});

		// Promotions Routes for Admin
		Route::group(['as' => 'promotion.', 'prefix' => 'promotion'], function()
		{
			include('admin/Coupon.php');
			include('admin/GiftCard.php');
		});

		// Support Routes for Admin
		Route::group(['as' => 'support.', 'prefix' => 'support'], function()
		{
			include('admin/Message.php');
			include('admin/Ticket.php');
			include('admin/Dispute.php');
			include('admin/Refund.php');
		});

		// Others
		// Route::resource('role', 'RoleController');
		// Route::resource('comment', 'CommentController');

		// AJAX routes
		Route::group(['middleware' => 'ajax'], function()
		{
			Route::get('catalog/ajax/getParrentAttributeType', 'AttributeController@ajaxGetParrentAttributeType')->name('ajax.getParrentAttributeType');
			Route::get('order/ajax/filterShippingOptions', 'AjaxController@filterShippingOptions')->name('ajax.filterShippingOptions');
		});
	});
});