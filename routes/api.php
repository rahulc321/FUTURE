<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


// Route::group([
//     'middleware' => 'auth',
//     'prefix' => 'auth'

// ], function ($router) {

//     Route::post('register', 'Api\UserController@register');
//     Route::post('login', 'Api\UserController@login');
//     Route::post('logout', 'Api\UserController@logout');
//     Route::post('refresh', 'Api\UserController@refresh');
//     Route::get('profile', 'Api\UserController@profile');

// });


Route::group(['middleware' => ['api-access'], 'prefix' => '/v1'], function () {
// Route::group(['prefix' => '/v1'], function () {
    // User Registeration Process All Steps Routes
    Route::post('/user/login', 'Api\UserController@authenticate');

    /* Signup though facebook */
    Route::post('/user/facebook_register', 'Api\UserController@socialUserRegister');
    Route::post('/user/linkedin_register', 'Api\UserController@socialUserRegister');
    Route::post('/user/twitter_register', 'Api\UserController@socialUserRegister');

    Route::get('/trending-list/{userid}', 'Api\PublicProfileController@getTrendingsList');
    Route::get('/similar-product-list/{userid}', 'Api\PublicProfileController@getSimilarProductList');
    
    Route::get('/public-profile/{userid}/profile', 'Api\PublicProfileController@sellerPublicProfile');
    Route::post('/user', 'Api\UserController@register');
    
    Route::get('/verify/{token}', 'Api\UserController@verifyUser');  
    Route::post('/user/forgot-password', 'Api\PasswordController@forgotPassword');
    Route::get('/forgot/validate-url/{token}', 'Api\PasswordController@validateURL');
    Route::post('/user/reset-password', 'Api\PasswordController@setNewUserPasswordRq');

    Route::post('/contact-us', 'Api\ContactUsController@contactUs');
    // Talent open Api routes

    Route::get('/futurestarr/marketplace', 'Api\TalentCategoryController@futureStarrMarketplace');
    
    Route::get('/category/{id}/detail', 'Api\TalentCategoryController@categoryById');
    Route::post('/contact-us', 'Api\UserController@contactUs');
    
    /*************** ******************************/
    Route::get('/talents/{slug}/category', 'Api\TalentCategoryController@talentsByCategory');
    Route::get('/talents/{slug}/product-info', 'Api\TalentCategoryController@productByCategory');
    
    /****************************************************/
    Route::get('/star-search', 'Api\SearchController@index');
    Route::get('/star-search/{slug}', 'Api\SearchController@show');

    /*************** ******************************/
    //Social Buzz API's
    Route::get('/blog-categories', 'Api\BlogController@blogCategory');    
    Route::get('/blogs/{slug?}', 'Api\BlogController@blogs');
    Route::post('blog-subscribe', 'Api\BlogController@blogSubscribe');
    Route::get('/related-blogs/{slug?}', 'Api\BlogController@relatedBlogs');
    Route::get('/blogs/{category}/{blogId}', 'Api\BlogController@blogById');
    Route::get('/blogs/{category}/{blogId}/comments', 'Api\BlogController@getComment');

    Route::get('/social-buzz/listing', 'Api\SocialBuzzController@socialBuzz');
    Route::get('/social-buzz-awards/listing', 'Api\SocialBuzzController@getSocialBuzzAwards');
    Route::get('/social-buzz-riders/listing', 'Api\SocialBuzzController@getSocailBuzzRiders');
    Route::get('/social-buzz-comments/listing', 'Api\SocialBuzzController@getSocailBuzzComments');
    Route::get('/get-commercial-ads', 'Api\SocialBuzzController@getAds');

   Route::get('/buyer/{id}/', 'Api\PublicProfileController@index');
   Route::get('/seller/{id}/', 'Api\PublicProfileController@sellerPublicProfile');

    Route::post('twitter-login', 'Auth\RegisterController@twitter');
    Route::any('twitter-callback', 'Auth\RegisterController@twitterCallback');


    Route::get('/tallent-mall', 'Api\TalentMallController@index');
    Route::get('/tallent-mall/search', 'Api\TalentMallController@show');
    Route::get('/talent-mall/product-info/{id}', 'Api\TalentMallController@productInfo');
    Route::get('/talent-mall/similar-product/{id}', 'Api\TalentMallController@similarProduct');
    Route::get('/talent-mall/get-rider', 'Api\TalentMallController@getRider');
    Route::get('/talent-mall/award', 'Api\TalentMallController@TalentAwards');
    Route::get('/talent-mall/comment', 'Api\TalentMallController@talentComment');

});


// auth:api | jwt.verify
Route::group(['middleware' => ['jwt', 'XSS'], 'prefix' => '/v1'], function () {
    Route::post('/logout', 'Api\UserController@logout');
    //Authenticated routes will be written here
    Route::post('/user/update-role', 'Api\UserController@updateRole');
    Route::post('/user/picture', 'Api\UserController@updateProfilePicture');
    Route::get('/user/info', 'Api\UserController@fetchUserInfo');
    Route::get('/user/manage-public-profile', 'Api\UserController@managePublicProfile');
    Route::post('/user/delete-account', 'Api\UserController@deleteUserAccount');
    Route::post('/user/change-password', 'Api\UserController@changeUserAccountPassword');

    // Blogs
    Route::post('/blogs/add-comment', 'Api\BlogController@addComment');

    Route::post('/user/store-public-profile-image', 'Api\UserController@publicProfileStoreImage');
    Route::post('/user/store-public-profile', 'Api\UserController@publicProfileStore');
    Route::post('/user/store-public-profile-bio', 'Api\UserController@publicProfileStoreBio');
    Route::get('/buyer-account/details', 'Api\UserController@buyerAccount');
    Route::post('/user/edit-cover-pic', 'Api\UserController@editCoverPic');
    Route::post('/user-account-update', 'Api\UserController@userAccountUpdate');

    Route::get('/riders', 'Api\UserController@getRiders');
    Route::get('/followings', 'Api\UserController@getFollowing');
    Route::get('/awards', 'Api\UserController@getAwards');
    Route::get('/unfollow-user/{following}', 'Api\UserController@unfollowUser');
    Route::post('/follow-user', 'Api\SocialBuzzController@followUser');

    Route::post('/user/changePassword', 'Api\UserController@changePassword');
    Route::get('/categories', 'Api\TalentCategoryController@category');
    Route::get('/seller-account/details', 'Api\UserController@sellerAccount');
    Route::get('/seller-sales', 'Api\PublicProfileController@sellerSale');
    Route::post('/store-product-commercial', 'Api\PublicProfileController@storeProductCommercial');
    Route::post('/store-sample-product', 'Api\PublicProfileController@storeSampleProduct');
    Route::post('/store-upload-product', 'Api\PublicProfileController@storeUploadProduct');
    Route::post('/store-product', 'Api\PublicProfileController@storeProduct');
    Route::post('/update-product', 'Api\PublicProfileController@updateProduct');
    Route::any('/my-product/{days?}', 'Api\PublicProfileController@SellerProducts');    

    /*******************************************************
                Social Buzz API
    *******************************************************/
    Route::post('/create-social-buzz', 'Api\SocialBuzzController@postSocialBuzz');
    Route::post('/update-social-buzz', 'Api\SocialBuzzController@updateSocialBuzz');    
    Route::post('/social-buzz-comment', 'Api\SocialBuzzController@postSocialBuzzComment');
    Route::post('/social-buzz-rider', 'Api\SocialBuzzController@postSocialBuzzRider');
    Route::post('/social-buzz-award', 'Api\SocialBuzzController@postSocialBuzzAward');
    Route::post('/social-buzz-report', 'Api\SocialBuzzController@socialBuzzReport');
    Route::get('/social-buzz-product-listing', 'Api\SocialBuzzController@socialBuzzProductListing');


    Route::post('/post-talent-award', 'Api\TalentCategoryController@postTalentAward');
    Route::get('/talent-award/{talentId}/listing', 'Api\TalentCategoryController@talentAwardListing');
    Route::get('/talent-rider/{talentId}/listing', 'Api\TalentCategoryController@talentRiderListing');
    Route::post('/talent/add-to-cart', 'Api\TalentCategoryController@addtoCart');
    Route::post('/post-talent-rider', 'Api\TalentCategoryController@postTalentRider');
    Route::post('/contact-message', 'Api\TalentCategoryController@contactMe');
    Route::post('/talent-report-seller', 'Api\TalentCategoryController@reportSeller');

    /*******************************************************
                Seller API
    *******************************************************/
    Route::get('/get-deleted-product', 'Api\SellerController@getSellerDeletedProduct');
    Route::post('/bulk-delete-product', 'Api\SellerController@bulkDeleteProducts');
    Route::post('/recover-deleted-product', 'Api\SellerController@recoverDeleteProduct');
    Route::post('/deleted-product-permanently', 'Api\SellerController@deleteProductPermanently');

    Route::get('/seller-commercial-ads', 'Api\SellerController@commercialAds');
    Route::get('/seller-commercial-ad-dashboard', 'Api\SellerController@commercialAdDashboard');
    Route::get('/seller-add-commercial-ad', 'Api\SellerController@addCommercilaAds');
    Route::get('/seller-product-url', 'Api\SellerController@productUrl');
    Route::post('/seller-store-commercial-ad', 'Api\SellerController@storeCommercialAd');
    Route::post('/seller-store-custom-plan', 'Api\SellerController@postCustomPlan');

    /*******************************************************
                Message API
    *******************************************************/
    Route::get('/chat-message', 'Api\ChatMessageController@chat');
    Route::get('/chat-refresh', 'Api\ChatMessageController@refreshMessage');
    Route::post('/chat-message', 'Api\ChatMessageController@sendMessage');
    Route::get('/inbox-message', 'Api\ChatMessageController@getInboxMessage');
    Route::get('/getalluser', 'Api\ChatMessageController@getAllUser');
    Route::get('/getallreaduser', 'Api\ChatMessageController@getAllReadMsg');
    Route::get('/getallunreaduser', 'Api\ChatMessageController@getAllUnreadMsg');
    Route::post('/delete-message', 'Api\ChatMessageController@deleteInboxMessage');
    Route::post('/mass-delete-message', 'Api\ChatMessageController@massDeleteInboxMessage');
    Route::get('/get-all-contact', 'Api\ChatMessageController@getAllContact');
    Route::post('/autoreply-setting', 'Api\ChatMessageController@autoreplySetting');
    Route::get('/autoreply-setting', 'Api\ChatMessageController@getAutoMessage');
    Route::get('/auto-reply', 'Api\ChatMessageController@sendAutoMessage');


    Route::get('/load-latest-messages', 'Api\ChatMessageController@getLoadLatestMessages')->name('load-latest-message');
    Route::post('/send', 'Api\ChatMessageController@postSendMessage')->name('send-message');
    Route::post('/send/del', 'Api\ChatMessageController@deleteMessage');
    Route::get('/fetch-old-messages', 'Api\ChatMessageController@getOldMessages')->name('old-message');

    /*******************************************************
                Payment API
    *******************************************************/

    Route::get('/paypal', 'Api\PaymentController@paypal');
    Route::post('/paypal', 'Api\PaymentController@storePaypal');    
    Route::post('/paypal-test', 'Api\PaymentController@paypalTest');

    Route::get('/stripe', 'Api\PaymentController@stripe');
    Route::post('/stripe', 'Api\PaymentController@storeStripe');
    Route::post('/stripe-confirm', 'Api\PaymentController@confirmStripePayment');
    Route::post('/stripe-hotpay', 'Api\PaymentController@hotPayStripe');
    
    Route::get('/get-card', 'Api\BillingAccountController@index');
    Route::get('/get-card/{id}', 'Api\BillingAccountController@getCardDetails');
    Route::post('/add-card', 'Api\BillingAccountController@addCard');
    Route::post('/card-update', 'Api\BillingAccountController@updateCard');
    Route::post('/card-delete', 'Api\BillingAccountController@deleteCard');
    Route::post('/preferred-payment-method', 'Api\BillingAccountController@preferredPaymentMethod');
    /********************************************************************
    ***************************  Buyer API      *************************
    *********************************************************************/

    Route::get('/buyer-products', 'Api\BuyerController@index');
    Route::post('/add-comment-to-talent', 'Api\BuyerController@addCommentToTalent');
    Route::post('/add-buyer-rating', 'Api\BuyerController@addBuyerRating');
    Route::post('/download-buyer-product', 'Api\BuyerController@downloadBuyerProduct');
    Route::post('/delete-buyer-product', 'Api\BuyerController@deleteBuyerProduct');


    /*********************************************************************
                    Tallent Mall Controller API
    *********************************************************************/

    Route::post('/talent-mall/add-to-cart', 'Api\TalentMallController@addTalentToCart');    
    Route::post('/talent-mall/give-award', 'Api\TalentMallController@giveTalentAward');    
    Route::get('/cart-product', 'Api\TalentMallController@cartProducts');
    Route::post('/remove-cart-item', 'Api\TalentMallController@deleteCartItem');
    Route::post('/talent-mall/add-rider', 'Api\TalentMallController@addRiderToTalent');


    Route::post('/connect-stripe-account', 'Api\StripeConnectController@ConnectStripeAccount');
    Route::post('/link-stripe-account', 'Api\StripeConnectController@LinkStripeAccount');
});