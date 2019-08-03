<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Payment IPN
Route::group(
	[
		'middleware' => [ 'laravelForceHttps' ]
	],
	function()
	{
Route::get('/ipnbtc', 'PaymentController@ipnBchain')->name('ipn.bchain');
Route::get('/ipnblockbtc', 'PaymentController@blockIpnBtc')->name('ipn.block.btc');
Route::get('/ipnblocklite', 'PaymentController@blockIpnLite')->name('ipn.block.lite');
Route::get('/ipnblockdog', 'PaymentController@blockIpnDog')->name('ipn.block.dog');
Route::post('/ipnpaypal', 'PaymentController@ipnpaypal')->name('ipn.paypal');
Route::post('/ipnperfect', 'PaymentController@ipnperfect')->name('ipn.perfect');
Route::post('/ipnstripe', 'PaymentController@ipnstripe')->name('ipn.stripe');
Route::post('/ipnskrill', 'PaymentController@skrillIPN')->name('ipn.skrill');
Route::post('/ipncoinpaybtc', 'PaymentController@ipnCoinPayBtc')->name('ipn.coinPay.btc');
Route::post('/ipncoinpayeth', 'PaymentController@ipnCoinPayEth')->name('ipn.coinPay.eth');
Route::post('/ipncoinpaybch', 'PaymentController@ipnCoinPayBch')->name('ipn.coinPay.bch');
Route::post('/ipncoinpaydash', 'PaymentController@ipnCoinPayDash')->name('ipn.coinPay.dash');
Route::post('/ipncoinpaydoge', 'PaymentController@ipnCoinPayDoge')->name('ipn.coinPay.doge');
Route::post('/ipncoinpayltc', 'PaymentController@ipnCoinPayLtc')->name('ipn.coinPay.ltc');
Route::post('/ipncoin', 'PaymentController@ipnCoin')->name('ipn.coinpay');
Route::post('/ipncoingate', 'PaymentController@ipnCoinGate')->name('ipn.coingate');


Route::post('/ipnpaytm', 'PaymentController@ipnPayTm')->name('ipn.paytm');
Route::post('/ipnpayeer', 'PaymentController@ipnPayEer')->name('ipn.payeer');
Route::post('/ipnpaystack', 'PaymentController@ipnPayStack')->name('ipn.paystack');
Route::post('/ipnvoguepay', 'PaymentController@ipnVoguePay')->name('ipn.voguepay');
//Payment IPN


Route::get('/', 'FrontendController@index')->name('homepage');
Route::get('/menu/{slug}', 'FrontendController@menu')->name('menu');
Route::get('/blog', 'FrontendController@blog')->name('blog');
Route::get('/details/{id}/{slug}', 'FrontendController@details')->name('blog.details');
Route::get('/cats/{id}/{slug}', 'FrontendController@categoryByBlog')->name('cats.blog');
Route::get('/about-us', 'FrontendController@about')->name('about');
Route::get('/faqs', 'FrontendController@faqs')->name('faqs');
Route::get('/click-add/{id}', 'FrontendController@clickadd');
Route::get('/contact-us', 'FrontendController@contactUs')->name('contact');
Route::post('/contact-us', 'FrontendController@contactSubmit')->name('contact.submit');
Route::post('/subscribe', 'FrontendController@subscribe')->name('subscribe');


Auth::routes();

Route::group(['prefix' => 'user'], function () {

    //Kingin Exerpt
    Route::post('/deposit/save', 'DepositController@saveCard')->name('save.card');

    Route::get('authorization', 'HomeController@authCheck')->name('user.authorization');

    Route::post('verification', 'HomeController@sendVcode')->name('user.send-vcode');
    Route::post('smsVerify', 'HomeController@smsVerify')->name('user.sms-verify');

    Route::post('verify-email', 'HomeController@sendEmailVcode')->name('user.send-emailVcode');
    Route::post('postEmailVerify', 'HomeController@postEmailVerify')->name('user.email-verify');


    Route::middleware(['CheckStatus'])->group(function () {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/vogue/{trx}/{type}', 'PaymentController@purchaseVogue')->name('vogue');


        /*Manage escrow*/
        Route::get('/add-escrow', 'HomeController@addMilestone')->name('add.milestone');
        Route::post('/add-escrow', 'HomeController@storeEscrow')->name('storeEscrow');
        Route::get('/new-escrow', 'HomeController@createMilestone')->name('createMilestone');
        Route::post('/new-escrow', 'HomeController@storeMilestone')->name('storeMilestone');


        Route::get('/escrow-list', 'HomeController@milestoneByUser')->name('escrow.list');
        Route::get('/earning-list', 'HomeController@earningList')->name('earn.list');

        Route::get('trans/{code}','HomeController@viewMileStone')->name('get.mileStone.list');
        Route::get('earns/{code}','HomeController@viewEarnMileStone')->name('get.earnStone.list');
        Route::post('create-milestone','HomeController@getMileStone')->name('get.mileStone');
        Route::post('release-amount', 'HomeController@releaseAmount')->name('release.amount');
        Route::post('reject-amount', 'HomeController@rejectAmount')->name('reject.amount');

        Route::post('user-report', 'HomeController@userReport')->name('user.report');

        Route::post('messages', 'ChatsController@sendMessage')->name('store.message');
        Route::post('get-chat', 'ChatsController@getChat')->name('get.chat');


        Route::get('report-log/{code}', 'HomeController@reportLogAuthor')->name('report.log.author');

        Route::get('/deposit', ['uses' => 'HomeController@deposit', 'as' => 'deposit']);
        Route::post('/deposit', ['uses' => 'HomeController@deposit', 'as' => 'deposit']);
        Route::post('/deposit-data-insert', 'HomeController@depositDataInsert')->name('deposit.data-insert');
        Route::get('/deposit-preview', 'HomeController@depositPreview')->name('user.deposit.preview');
        Route::post('/deposit-confirm', 'PaymentController@depositConfirm')->name('deposit.confirm');

        Route::get('/withdraw-money', 'HomeController@withdrawMoney')->name('withdraw.money');
        Route::post('/withdraw-preview', 'HomeController@requestPreview')->name('withdraw.preview');
        Route::post('/withdraw-submit', 'HomeController@requestSubmit')->name('withdraw.submit');

        Route::get('/transaction-log', 'HomeController@activity')->name('user.trx');
        Route::get('/deposit-log', 'HomeController@depositLog')->name('user.depositLog');
        Route::get('/withdraw-log', 'HomeController@withdrawLog')->name('user.withdrawLog');

        Route::get('change-password', 'HomeController@changePassword')->name('user.change-password');
        Route::post('change-password', 'HomeController@submitPassword')->name('user.change-password');

        Route::get('edit-profile', 'HomeController@editProfile')->name('edit-profile');
        Route::post('edit-profile', 'HomeController@submitProfile')->name('edit-profile');
    });
});


Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminLoginController@index')->name('admin.loginForm');
    Route::post('/', 'AdminLoginController@authenticate')->name('admin.login');
});


Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {


    /*demo start*/
    //Route::middleware(['demo'])->group(function () {

    Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');

    Route::get('reports', 'DashboardController@reports')->name('admin.reports');
    Route::get('reports/{id}', 'DashboardController@reportsAllView')->name('reports.view');
    Route::post('accept-milestone', 'DashboardController@milestoneAccepted')->name('milestone.accepted');
    Route::post('admin-report', 'DashboardController@storeReport')->name('admin.send.report');
    Route::post('get-chat', 'DashboardController@adminGetChat')->name('admin.get.chat');

    //    Blog Controller
    Route::get('/post-category', 'PostController@category')->name('admin.cat');
    Route::post('/post-category', 'PostController@UpdateCategory')->name('update.cat');
    Route::get('blog', 'PostController@index')->name('admin.blog');
    Route::get('blog/create', 'PostController@create')->name('blog.create');
    Route::post('blog/create', 'PostController@store')->name('blog.store');
    Route::delete('blog/delete', 'PostController@destroy')->name('blog.delete');
    Route::get('blog/edit/{id}', 'PostController@edit')->name('blog.edit');
    Route::post('blog-update', 'PostController@updatePost')->name('blog.update');

    //Our-client
    Route::get('our-client', 'OurClientController@ourClient')->name('our.client');
    Route::post('our-client', 'OurClientController@storeClient')->name('store.client');
    Route::delete('our-client', 'OurClientController@deleteClient')->name('delete.client');

    // Our-team
    Route::get('our-team', 'OurTeamController@ourTeam')->name('team');
    Route::get('our-team/create', 'OurTeamController@createOurTeam')->name('create.team');
    Route::post('our-team/create', 'OurTeamController@storeOurTeam')->name('store.team');
    Route::get('our-team/{id}', 'OurTeamController@editOurTeam')->name('edit.team');
    Route::post('our-team/{id}', 'OurTeamController@updateOurTeam')->name('update.team');
    Route::delete('our-team', 'OurTeamController@deleteOurTeam')->name('delete.team');

    //Slider

    Route::get('slider', 'WebSettingController@manageSlider')->name('slider');
    Route::post('slider', 'WebSettingController@storeSlider')->name('store.slider');
    Route::delete('slider', 'WebSettingController@deleteSlider')->name('slider-delete');


    //Gateway
    Route::get('/gateway', 'GatewayController@show')->name('gateway');
    Route::post('/gateway', 'GatewayController@update')->name('update.gateway');

    //Deposit
    Route::get('/deposits', 'DepositController@index')->name('deposits');
    Route::get('/deposits/requests', 'DepositController@requests')->name('deposits.requests');
    Route::put('/deposit/approve/{id}', 'DepositController@approve')->name('deposit.approve');
    Route::get('/deposit/{deposit}/delete', 'DepositController@destroy')->name('deposit.destroy');

    //withdraw
    Route::get('/withdraw', 'WithdrawController@index')->name('withdraw');
    Route::post('/withdraw', 'WithdrawController@store')->name('add.withdraw.method');
    Route::post('/withdraw-update', 'WithdrawController@withdrawUpdateSettings')->name('update.wsettings');

    Route::get('/withdraw/requests', 'WithdrawController@requests')->name('withdraw.requests');
    Route::get('/withdraw/approved', 'WithdrawController@requestsApprove')->name('withdraw.approved');
    Route::get('/withdraw/refunded', 'WithdrawController@requestsRefunded')->name('withdraw.refunded');

    Route::put('/withdraw/approve/{id}', 'WithdrawController@approve')->name('withdraw.approve');
    Route::post('/withdraw/refund', 'WithdrawController@refundAmount')->name('withdraw.refund');


    //Email Template
    Route::get('/template', 'EtemplateController@index')->name('email.template');
    Route::post('/template-update', 'EtemplateController@update')->name('template.update');
    //Sms Api
    Route::get('/sms-api', 'EtemplateController@smsApi')->name('sms.api');
    Route::post('/sms-update', 'EtemplateController@smsUpdate')->name('sms.update');


    // General Settings
    Route::get('/general-settings', 'GeneralSettingController@GenSetting')->name('admin.GenSetting');
    Route::post('/general-settings', 'GeneralSettingController@UpdateGenSetting')->name('admin.UpdateGenSetting');
    Route::get('/change-password', 'GeneralSettingController@changePassword')->name('admin.changePass');
    Route::post('/change-password', 'GeneralSettingController@updatePassword')->name('admin.changePass');
    Route::get('/profile', 'GeneralSettingController@profile')->name('admin.profile');
    Route::post('/profile', 'GeneralSettingController@updateProfile')->name('admin.profile');


    //User Management
    Route::get('users', 'GeneralSettingController@users')->name('users');
    Route::get('user-search', 'GeneralSettingController@userSearch')->name('search.users');
    Route::get('user/{user}', 'GeneralSettingController@singleUser')->name('user.single');
    Route::put('user/pass-change/{user}', 'GeneralSettingController@userPasschange')->name('user.passchange');
    Route::put('user/status/{user}', 'GeneralSettingController@statupdate')->name('user.status');
    Route::get('mail/{user}', 'GeneralSettingController@userEmail')->name('user.email');
    Route::post('/sendmail', 'GeneralSettingController@sendemail')->name('send.email');
    Route::get('/user-login-history/{id}', 'GeneralSettingController@loginLogsByUsers')->name('user.login.history');
    Route::get('/user-balance/{id}', 'GeneralSettingController@ManageBalanceByUsers')->name('user.balance');
    Route::post('/user-balance', 'GeneralSettingController@saveBalanceByUsers')->name('user.balance.update');
    Route::get('/user-banned', 'GeneralSettingController@banusers')->name('user.ban');
    Route::get('login-logs/{user?}', 'GeneralSettingController@loginLogs')->name('user.login-logs');
    Route::get('/user-transaction/{id}', 'GeneralSettingController@userTrans')->name('user.trans');
    Route::get('/user-deposit/{id}', 'GeneralSettingController@userDeposit')->name('user.deposit');
    Route::get('/user-withdraw/{id}', 'GeneralSettingController@userWithdraw')->name('user.withdraw');


    //Contact Setting
    Route::get('contact-setting', 'WebSettingController@getContact')->name('contact-setting');
    Route::put('contact-setting/{id}', 'WebSettingController@putContactSetting')->name('contact-setting-update');

    Route::get('manage-logo', 'WebSettingController@manageLogo')->name('manage-logo');
    Route::post('manage-logo', 'WebSettingController@updateLogo')->name('manage-logo');

    Route::get('manage-text', 'WebSettingController@manageFooter')->name('manage-footer');
    Route::put('manage-text', 'WebSettingController@updateFooter')->name('manage-footer-update');

    Route::get('manage-social', 'WebSettingController@manageSocial')->name('manage-social');
    Route::post('manage-social', 'WebSettingController@storeSocial')->name('manage-social');
    Route::get('manage-social/{product_id?}', 'WebSettingController@editSocial')->name('social-edit');
    Route::put('manage-social/{product_id?}', 'WebSettingController@updateSocial')->name('social-edit');
    Route::post('delete-social', 'WebSettingController@destroySocial')->name('del.social');

    Route::get('menu-create', 'WebSettingController@createMenu')->name('menu-create');
    Route::post('menu-create', 'WebSettingController@storeMenu')->name('menu-create');
    Route::get('menu-control', 'WebSettingController@manageMenu')->name('menu-control');
    Route::get('menu-edit/{id}', 'WebSettingController@editMenu')->name('menu-edit');
    Route::post('menu-update/{id}', 'WebSettingController@updateMenu')->name('menu-update');
    Route::delete('menu-delete', 'WebSettingController@deleteMenu')->name('menu-delete');



    Route::get('manage-about', 'WebSettingController@manageAbout')->name('manage-about');
    Route::post('manage-about', 'WebSettingController@updateAbout')->name('manage-about');

    Route::get('manage-privacy', 'WebSettingController@managePrivacy')->name('manage-privacy');
    Route::post('manage-privacy', 'WebSettingController@updatePrivacy')->name('manage-privacy');

    Route::get('manage-terms', 'WebSettingController@manageTerms')->name('manage-terms');
    Route::post('manage-terms', 'WebSettingController@updateTerms')->name('manage-terms');

    Route::get('faqs-create', 'WebSettingController@createFaqs')->name('faqs-create');
    Route::post('faqs-create', 'WebSettingController@storeFaqs')->name('faqs-create');
    Route::get('faqs-all', 'WebSettingController@allFaqs')->name('faqs-all');
    Route::get('faqs-edit/{id}', 'WebSettingController@editFaqs')->name('faqs-edit');
    Route::put('faqs-edit/{id}', 'WebSettingController@updateFaqs')->name('faqs-update');
    Route::delete('faqs-delete', 'WebSettingController@deleteFaqs')->name('faqs-delete');


    Route::get('/subscribers', 'DashboardController@manageSubscribers')->name('manage.subscribers');
    Route::post('/update-subscribers', 'DashboardController@updateSubscriber')->name('update.subscriber');
    Route::get('/send-email', 'DashboardController@sendMail')->name('send.mail.subscriber');
    Route::post('/send-email', 'DashboardController@sendMailsubscriber')->name('send.email.subscriber');

    Route::resource('advertisement', 'AdvertisementController');

    //});
    /*demo End*/

    Route::get('/logout', 'AdminController@logout')->name('admin.logout');

    //Kingin's Exerpt
    Route::get('/deposit/change/status/{id}' , 'DepositController@changeStatus')->name('admin.deposit.change.status');
    Route::resource('cards','CardController');
    Route::get('manage-breadcrumbs','AdminController@showBreadcrumbs')->name('show.breadcrumbs');
   
});


/*============== User Password Reset Route list ===========================*/
Route::get('user-password/reset', 'User\ForgotPasswordController@showLinkRequestForm')->name('user.password.request');
Route::post('user-password/email', 'User\ForgotPasswordController@sendResetLinkEmail')->name('user.password.email');
Route::get('user-password/reset/{token}', 'User\ResetPasswordController@showResetForm')->name('user.password.reset');
Route::post('user-password/reset', 'User\ResetPasswordController@reset');


});