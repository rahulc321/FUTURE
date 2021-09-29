<?php

/*
|--------------------------------------------------------------------------
| Web Routes Buyer Dashboard
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'buyer','middleware' => ['auth', 'buyer']], function () {
    
    Route::get('/dashboard', 'BuyerController@index')->name('buyer.dashboard');
    Route::get('/account-setting', 'BuyerController@edit')->name('buyer.edit');

    Route::get('/public-profile', 'BuyerController@profile')->name('buyer.public.profile');
    Route::post('/store-public-profile', 'BuyerController@public_profile_store')->name('buyer.public.profile.store');

    Route::post('/update-account-setting', 'BuyerController@update')->name('buyer.update');
    Route::post('/add-buyer-message', 'BuyerController@addBuyerMessage')->name('buyer.addBuyerMessage');
    Route::post('/add-buyer-rating', 'BuyerController@addBuyerRating')->name('buyer.addBuyerRating');
    Route::post('/download-buyer-product', 'BuyerController@downloadBuyerProduct')->name('buyer.downloadBuyerProduct');
    Route::post('/add-comment-to-talent', 'BuyerController@addCommentToTalent')->name('buyer.addCommentToTalent');
    Route::post('/delete-buyer-product', 'BuyerController@deleteBuyerProduct')->name('buyer.deleteBuyerProduct');
    Route::get('/change-password', 'BuyerController@changePassword')->name('buyer.changePassword');
    Route::post('/set-buyer-password', 'BuyerController@setPassword')->name('buyer.setPassword');
    Route::get('/message', 'BuyerController@chatMessagees')->name('buyer.chatMessagees');

    Route::get('/checkUserlogin', 'BuyerController@show')->name('buyer.checkUserlogin');
    Route::post('/update-user-account', 'BuyerController@updateUserAccount')->name('buyer.update-user-account');

    Route::post('/pay-with-stripe', 'StripeController@payithStripe')->name('buyer.pay-with-stripe');


    // T Shirt Route
    Route::get('/t-shirt', 'TShirtProductController@show')->name('buyer.t-shirt');
    Route::post('/t-shirt', 'TShirtProductController@tShirtAddToCart')->name('buyer.t-shirt-store');
    Route::get('/t-shirt-checkout', 'TShirtProductController@tShirtCheckoutShow')->name('buyer.checkout.show');
    Route::post('/change-shipping', 'TShirtProductController@changeShipping')->name('buyer.change-shipping');
    Route::post('/remove-cart-product', 'TShirtProductController@removeCartProduct')->name('buyer.remove-cart-product');
    Route::post('/save-shipping-address', 'TShirtProductController@saveShippingAddress')->name('buyer.save-shipping-address');
    Route::post('/save-billing-address', 'TShirtProductController@saveBillingAddress')->name('buyer.save-billing-address');
    Route::get('/t-shirt-payment', 'TShirtProductController@payment');    
    Route::post('/t-shirt-stripe', 'TShirtProductController@stripe');    
    Route::post('/t-shirt-paypal', 'TShirtProductController@paypal');
    Route::get('/t-shirt-paypal-success', 'TShirtProductController@paypalStatusSuccess');
    Route::get('/t-shirt-paypal-cancel', 'TShirtProductController@paypalStatusCancel');

    // T Shirt End Route


    Route::get('/custom-logout', function(){
        Auth::logout();
        return Redirect::to('register', 301); 
    })->name('custom-logout');

    Route::get('/support-chat', 'Admin\SupportChatController@frontIndex')->name('buyer.support.chat');
    Route::get('api/support-chat/send-msg', 'Admin\SupportChatController@store')->name('buyer.support.chat.send');
    Route::get('api/get-unread/{receiver_id}/{sender_id}', 'Admin\SupportChatController@getUnreadMessages')->name('buyer.chat.get.unread');
    Route::post('api/send/message', 'Admin\SupportChatController@store')->name('buyer.chat.message.store');

    Route::get('/billing-account', 'BillingAccountController@index')->name('buyer.billing.account');
    Route::post('/billing-account', 'BillingAccountController@update')->name('buyer.billing.account.post');
    Route::post('/billing-account-add', 'BillingAccountController@store')->name('buyer.billing.account.store');    
    Route::get('/card-details/{card_id}', 'BillingAccountController@getCardDetails')->name('buyer.card.details');
    
 });

    Route::get('api/message/getalluser/{current_id}', 'getallusercontroller@getAllUser');
    Route::get('api/message/msgRead/{current_id}/{sent_by}', 'getallusercontroller@msgRead');
    Route::get('api/message/msgReadTwo/{current_id}/{sent_by}', 'getallusercontroller@msgReadTwo');
    Route::get('api/message/getinboxuser/{current_id}', 'getallusercontroller@getInboxUser');
    Route::get('/api/message/getUserMsg/{user_id}/{receiver_id}', 'getallusercontroller@getUserMsg');
    Route::post('api/message/store_msg', 'getallusercontroller@store_user_msg');
    Route::get('/api/message/get_all_contact/{currentUser}', 'getallusercontroller@get_all_contact');
    Route::get('/api/message/delete_message/{currentUser}/{messageid}', 'getallusercontroller@delete_message');
    Route::get('api/message/getreadmsg/{current_id}', 'getallusercontroller@getreadmsg');
    Route::get('api/message/getunreadmsg/{current_id}', 'getallusercontroller@getunreadmsg');

    Route::post('api/autoreply-setting', 'getallusercontroller@autoreplySetting');
