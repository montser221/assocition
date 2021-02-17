<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use App\Models\SliderImage;
Route::get('viewFile',[App\Http\Controllers\ViewFileController::class,'viewFile'])->name('viewFile');
Route::get('/',[App\Http\Controllers\MainController::class,'index'])->name('/');
// Route::get('test',function(){
//   $allsliderimages =  SliderImage::latest()->take(1)->get();
//     return view('pages.testslider',compact('allsliderimages'));

// })->name('test');
Route::resource('subscribenow',App\Http\Controllers\TrainningSubscriberController::class);
Route::get('/subscriber', [App\Http\Controllers\TrainningSubscriberController::class,'subscriber'])->name('subscriber');
Route::post('activate/{id}', [App\Http\Controllers\TrainningSubscriberController::class,'activate'])->name('activate');
Route::post('deactivate/{id}', [App\Http\Controllers\TrainningSubscriberController::class,'deactivate'])->name('deactivate');
// payee 
Route::post('payee/activate/{id}', [App\Http\Controllers\ApplicableController::class,'activate'])->name('pactivate');
Route::post('payee/deactivate/{id}', [App\Http\Controllers\ApplicableController::class,'deactivate'])->name('pdeactivate');
//payeee
Route::get('/exportAllDenoate', [App\Http\Controllers\DenoateController::class,'exportAllDenoate'])->name('exportAllDenoate')->middleware('auth');
Route::get('/exportToExcel/{id}', [App\Http\Controllers\MoneyReportController::class,'exportToExcel'])->name('exportToExcel')->middleware('auth');
Route::get('money', [App\Http\Controllers\MoneyReportController::class,'index'])->name('money.index')->middleware('auth');
Route::get('dDetail/{id?}', [App\Http\Controllers\MoneyReportController::class,'dDetail'])->name('dDetail')->middleware('auth');
Route::get('courseDetail/{id?}', [App\Http\Controllers\TrainningCoursesController::class,'courseDetail'])->name('courseDetail');
Route::get('ourcourses', [App\Http\Controllers\TrainningCoursesController::class,'ourcourses'])->name('ourcourses');

// public pages
Route::get('login',[App\Http\Controllers\LoginController::class,'login'])->name('login');
Route::get('logout',[App\Http\Controllers\LoginController::class,'logout'])->name('logout');
Route::get('needy',[App\Http\Controllers\DulniController::class,'needy'])->name('needy');
Route::post('checklogin',[App\Http\Controllers\LoginController::class,'checklogin'])->name('checklogin');
Route::get('home',[App\Http\Controllers\MainController::class,'index'])->name('home');
Route::get('/get_project_data',[App\Http\Controllers\ProjectsController::class,'get_project_data'])->name('get_project_data');
Route::get('cart',[App\Http\Controllers\MainController::class,'cart'])->name('cart');
Route::get('ourproject',[App\Http\Controllers\MainController::class,'ourproject'])->name('ourproject');
Route::get('paymethod',[App\Http\Controllers\paymethodController::class,'paymethod'])->name('paymethod');
Route::get('zakat',[App\Http\Controllers\MainController::class,'zakat'])->name('zakat');
Route::get('aboutus',[App\Http\Controllers\aboutController::class,'aboutus'])->name('aboutus');
Route::get('volnt',[App\Http\Controllers\VolntController::class,'volnt'])->name('volnt')->middleware('auth');
Route::delete('volnt/{id}',[App\Http\Controllers\VolntController::class,'destroy'])->name('volnt.destroy')->middleware('auth');
Route::get('applicable',[App\Http\Controllers\ApplicableController::class,'applicable'])->name('applicable')->middleware('auth');
Route::delete('destroy/{id}',[App\Http\Controllers\ApplicableController::class,'destroy'])->name('destroy')->middleware('auth');

// cart routes
Route::post('addToCart/{id}',[App\Http\Controllers\CartController::class,'addToCart'])->name('addToCart');
Route::post('addToCartNow/{id}',[App\Http\Controllers\CartController::class,'addToCartNow'])->name('addToCartNow');

Route::post('sdad',[App\Http\Controllers\CartController::class,'sdad'])->name('sdad');
Route::post('card',[App\Http\Controllers\CartController::class,'card'])->name('card');
Route::delete('destory/{id}',[App\Http\Controllers\CartController::class,'destory'])->name('cart.destory');
Route::get('projectDetail/{id?}',[App\Http\Controllers\ProjectsController::class,'projectDetail'])->name('projectDetail');
Route::get('customProjectDetail',[App\Http\Controllers\ProjectsController::class,'customProjectDetail'])->name('customProjectDetail');

Route::get('/projectReport/{projectId}',[App\Http\Controllers\ProjectsController::class,'projectReport'])->name('projectReport');

Route::resource('dulni',App\Http\Controllers\DulniController::class);
Route::resource('voluntary',App\Http\Controllers\VoluntaryController::class);
Route::resource('benfit',App\Http\Controllers\BenfitController::class);
Route::resource('jobs',App\Http\Controllers\JobController::class);
// Route::post('store2',[App\Http\Controllers\ContactController::class,'store2'])->name('contact.store2');
Route::get('contact2',[App\Http\Controllers\ContactController::class,'contact'])->name('contact.contact')->middleware('auth');
Route::get('msgDetail/{contact}',[App\Http\Controllers\ContactController::class,'msgDetail'])->name('contact.msgDetail')->middleware('auth');
Route::resource('contact',App\Http\Controllers\ContactController::class);

//all videos and all files
Route::get('allVideos',[App\Http\Controllers\videosController::class,'allVideos'])->name('allVideos');
Route::get('allFiles',[App\Http\Controllers\pdfFileController::class,'allFiles'])->name('allFiles');
Route::get('allReportFiles',[App\Http\Controllers\ManageMoneyReportController::class,'allReportFiles'])->name('allReportFiles');

// Dashboard Area
Route::get('stat',[App\Http\Controllers\StatisticsController::class,'statistics'])->name('stat')->middleware('auth');
//arrow route
Route::resource('arrows',App\Http\Controllers\ArrowsController::class)->middleware('auth');
// Route::resource('courses',App\Http\Controllers\TrainningCoursesController::class);
Route::resource('courses',App\Http\Controllers\TrainningCoursesController::class)->middleware('auth');

Route::resource('statistics',App\Http\Controllers\StatisticsController::class)->middleware('auth');
Route::resource('denoate',App\Http\Controllers\DenoateController::class);

Route::get('payments',[App\Http\Controllers\DenoateController::class,'payments'])->name('payments');
Route::resource('dashboard',App\Http\Controllers\Dashboard\DashboardController::class)->middleware('auth');
Route::resource('sliderimages',App\Http\Controllers\SliderImageController::class)->middleware('auth');
Route::resource('userscategories',App\Http\Controllers\UsersCategoriesController::class)->middleware('auth');
Route::resource('users',App\Http\Controllers\UsersController::class)->middleware('auth');
Route::resource('paymentmethod',App\Http\Controllers\PaymentMethodController::class)->middleware('auth');
Route::resource('aboutassoiation',App\Http\Controllers\AboutAssociationController::class)->middleware('auth');
Route::resource('services',App\Http\Controllers\ServicesController::class)->middleware('auth');
Route::resource('projectcategories',App\Http\Controllers\ProjectsCategoriesController::class)->middleware('auth');
Route::resource('projects',App\Http\Controllers\ProjectsController::class)->middleware('auth');
Route::resource('settings',App\Http\Controllers\SettingsController::class)->middleware('auth');
Route::resource('attendace',App\Http\Controllers\AttendaceController::class)->middleware('auth');
Route::resource('members',App\Http\Controllers\MembersController::class)->middleware('auth');
Route::resource('agents',App\Http\Controllers\AgentsController::class)->middleware('auth');
Route::resource('videos',App\Http\Controllers\videosController::class)->middleware('auth');
Route::resource('payees',App\Http\Controllers\PayeeManagementController::class)->middleware('auth');
Route::resource('policies',App\Http\Controllers\PoliciesController::class)->middleware('auth');
Route::resource('images',App\Http\Controllers\ImageManagementController::class)->middleware('auth');
Route::resource('files',App\Http\Controllers\pdfFileController::class)->middleware('auth');
Route::resource('goals',App\Http\Controllers\OurGoalController::class)->middleware('auth');
Route::resource('reportfiles',App\Http\Controllers\ManageMoneyReportController::class)->middleware('auth');
Route::resource('otherfiles',App\Http\Controllers\OtherMemberController::class)->middleware('auth');

 