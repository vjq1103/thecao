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

use Illuminate\Support\Facades\Mail;

Route::post('send/otp', 'OtpController@sendOtp')->name('send.otp');


// use Illuminate\Support\Facades\Mail;
// Route::get('/mailabc', function () {
//     Mail::send('mail', [], function($message)
//     {
//         $message->to('vanson297.nguyen@gmail.com', 'test')->subject('Test send mail ok oy nay');
//         $message->from('khanhdev1602@gmail.com','Virat Gandhi');
//     });
// });




Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/api/tinh','UserController@showTinh')->name('api.tinh');

Route::get('/nap-the-frame','FrameController@naptheFrame')->name('napthe-frame');
Route::post('/frame-create','FrameController@createNap')->name('frame.createPayment');
Route::get('/napthe-confirm','FrameController@naptheConfirm')->name('frame.confirm');
Route::get('/embed/{id}','FrameController@naptheCreate')->name('frame-nap-the');
Route::get('/frame/search','FrameController@search')->name('api.search');
Route::get('/api/frame','FrameController@apiFrame')->name('api.frame');
Route::get('/nap-the/{id}','FrameController@naptructiep')->name('nap-truc-tiep');
Route::post('/xlNaptructiep','FrameController@xlNaptructiep')->name('xlNaptructiep');

//nap the cham
Route::get('/nap-the-cham/{id}','FrameController@naptructiepcham')->name('nap-truc-tiep-cham');
Route::post('/xlNaptructiepcham','FrameController@xlNaptructiepcham')->name('xlNaptructiepcham');


Route::group(['middleware' => 'auth'], function () {
    //show user profile
    Route::get('user/profile','UserController@showHistoryAddCard')->name('user.profle');
    Route::get('/user/history','HistoryController@index')->name('history');



    //search serial
    Route::get('/serial-search','SearchController@mySearch')->name('serial-search');
    Route::get('/my-search','SearchController@index')->name('mySearch');
    //Route nap the cao
    Route::get('/nap-the','NaptheController@index')->name('nap-the');
    Route::get('/nap-the/history','NaptheController@Historycard')->name('nap-the.Historycard');
    Route::get('/history-pending','NaptheController@HistoryPending')->name('nap-the.history-card');
    //NAP TRONG NGAY
    Route::get('/history-naptrongngay','NaptheController@HistoryPendingtoday')->name('naptrongngay.history-card');


    Route::post('/nap-card','NaptheController@napthecao')->name('nap-card');
    Route::get('/delete-card','NaptheController@deleteCard')->name('delete-card');

     //chuyen tien
    Route::get('/chuyen-tien','ChuyenTienController@index')->name('chuyen-tien.index');
    Route::post('/chuyen-tien','ChuyenTienController@chuyenTien')->name('chuyen-tien');
    Route::get('/history-chuyen-tien','ChuyenTienController@logHistory')->name('api.history-chuyen-tien');

    //RUT TIEN
    Route::get('/rut-tien','RuttienController@index')->name('rut-tien');
    Route::get('/api/bank','RuttienController@bankList')->name('api.bank');
    Route::get('/api/add-bank','RuttienController@addAccount')->name('api.add-bank');
    Route::get('/api/get-bank','RuttienController@getBank')->name('api.get-bank');
    Route::post('/withdraw','RuttienController@withDraw')->name('withdraw');
    Route::get('/history-rut-tien','RuttienController@historyRutTien')->name('rut-tien.history');

    //NAP TIEN
    Route::get('/nap-tien','NaptienController@index')->name('nap-tien.index');
    Route::get('/nap-tien/pock-up','NaptienController@pockup')->name('nap-tien.pockup');
    Route::get('/nap-tien/confirm','NaptienController@confirm')->name('nap-tien.confirm');
    Route::post('/nap-tien','NaptienController@NapTien')->name('nap-tien.nap');

    //Mua the
    Route::get('/mua-the','MuaTheController@index')->name('mua-the.index');
    Route::post('/mua-the/buy-card','MuaTheController@buyCard')->name('mua-the.buy-card');

    //frame
    Route::get('/frame','FrameController@index')->name('frame.index');
    Route::post('/frame/create','FrameController@createFrame')->name('frame.create');
    Route::get('/updateLink','FrameController@updateLink')->name('frame.updateLink');
    Route::get('/deleteAdmin','FrameController@deleteAdmin')->name('frame.deleteAdmin');
    Route::get('/deleteLink','FrameController@deleteLink')->name('frame.deleteLink');
 //frame
    Route::get('/frame2','FrameController@framehienthi')->name('frame2.framehienthi');
    Route::post('/frame2/create','FrameController@createFrame')->name('frame2.create');
    Route::get('/updateLinkk','FrameController@updateLink')->name('frame2.updateLink');
    Route::get('/deleteAdminn','FrameController@deleteAdmin')->name('frame2.deleteAdmin');
    Route::get('/deleteLinkk','FrameController@deleteLink')->name('frame2.deleteLink');
	//frame xoa sua link trong ma nhung



});

Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin/danh-sach-the-cao', 'AdminController@listCard')->name('admin.danh-sach-the-cao');
    Route::get('/admin/danh-sach-rut-tien', 'AdminController@listWithDraw')->name('admin.danh-sach-rut-tien');
    Route::post('/admin/addcard', 'AdminController@addCard')->name('admin.addcard');

   // rut tien
   Route::post('/admin/withdraw', 'AdminController@withDraw')->name('admin.withDraw');


   //nap tien
    Route::get('/admin/nap-tien','AdminController@listNapTien')->name('admin.nap-tien');
    Route::post('/admin/nap-tien/xac-nhan','AdminController@confirmAddMoney')->name('admin.xac-nhan-nap');

    //mua the
    Route::get('/admin/mua-the','AdminController@listMuathe')->name('admin.mua-the');
    Route::post('/admin/buy-card','AdminController@BuyCard')->name('admin.buy-card');

	//list memember
    Route::get('/admin/list-member','ListMemberController@index')->name('list-member');


	//list frame
    Route::get('/admin/list-frame','ListFrameController@index')->name('list-frame');


	//user manager
    Route::get('/admin/manager-user','UserController@Role')->name('user.role');
    Route::post('/admin/update-user','UserController@updateUser')->name('user.updateUser');
	//List user
    Route::get('/admin/list-view-member','ListMemberController@index')->name('list-view-member');





	// Lam them ve
    Route::get('/admin/list-adxs','ListAdXSController@index')->name('danh-sach-adxs');
    Route::get('/admin/danh-sach-log','ListLogController@index')->name('danh-sach-log');
    Route::get('/admin/danh-sach-log-payment','ListLogPaymentController@index')->name('danh-sach-log-payment');
    Route::get('/admin/danh-sach-tempuser','ListTempUserController@index')->name('danh-sach-tempuser');
    Route::get('/admin/danh-sach-listmoney','ListMoneyUserController@index')->name('danh-sach-listmoney');
    Route::get('/admin/danh-sach-listmoneyrozen','ListMoneyFrozenUserController@index')->name('danh-sach-listmoneyrozen');
	//tin tuc
    Route::resource('/news','NewController');


});

Route::get('/api/napthe','MuaTheController@apiMuathe');
//Route::get('new/{id}', 'NewController@showDetail');
Route::get('new/{slug}/{id}', 'NewController@showDetail');
