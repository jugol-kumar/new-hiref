<?php

use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BusinessSettingController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\EducationLavelController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MessangerController;
use App\Http\Controllers\RecruiterJobController;
use App\Http\Controllers\RecruitersCompanyController;
use App\Http\Controllers\RecruitersController;
use App\Http\Controllers\RecruitersProfileController;
use App\Http\Controllers\SeekerController;
use App\Http\Controllers\SeekerJobController;
use App\Http\Controllers\SeekerProfileController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZoomController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MocktestController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ChildCategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PayPalPaymentController;

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
Route::get('/storage', function (){
   Artisan::call('storage:link');
});

Route::get('/clear', function (){
    Artisan::call('optimize:clear');
});

Route::controller(HomeController::class)->name('client.')->group(function (){
    Route::get('', 'home')->name('home');
    Route::get('single-job/{job_title_slug}', 'singleJob')->name('single_job');
    Route::get('recruiters', 'recruiter')->name('recruiter');
    Route::get('seekers', 'seekers')->name('seekers');
    Route::view('contact-us', 'frontend.contact')->name('contactUs');

    Route::get('all-categories', 'allCategories')->name('allCategories');

    Route::post('all-district', 'allDistrict')->name('allDistrict');
    Route::get('sub-categories/category-id/{id}', 'getSubCategories')->name('getSubCategories');
    Route::get('search', 'searchJob')->name('searchJObs');
});

Route::controller(RecruitersController::class)->prefix('recruiters')->name('recruiter.')->group(function (){
    Route::post('create', 'create')->name('create');
});

//
//Route::get('/', [HomeController::class, 'home']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/blog', [HomeController::class, 'blog']);
Route::get('/faq', [HomeController::class, 'faq']);
Route::get('/checkout/{slug}', [HomeController::class, 'checkout']);
Route::get('/details/{slug}', [HomeController::class, 'details']);

//Route::get('pay/paypal', [PayPalPaymentController::class, 'charge'])->middleware('auth')->name('paypal.pay');
//Route::get('pay/success', [PayPalPaymentController::class, 'success'])->name('paypal.success');
//Route::get('pay/error', [PayPalPaymentController::class, 'error'])->name('paypal.error');

Route::get('blogs', [HomeController::class, 'allApproveBlogs'])->name('all_approve_blogs');
Route::get('single-blog/{slug}', [HomeController::class, 'singleBlog'])->name('single_blog');
Route::post('submit-your-comment', [CommentController::class, 'submit_comment'])->name('submit_comment');
Route::post('replay-comment/submit-your-comment', [CommentController::class, 'replayComment'])->name('replay_comment');


Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate']);
    Route::get('register', [RegisterController::class, 'register'])->name('register');
    Route::post('recruiter/register', [RegisterController::class, 'create'])->name('recruiter.create');
    Route::post('recruiter/login', [LoginController::class, 'authenticate'])->name('recruiter.login');

    Route::get('seekers/register', [RegisterController::class, 'seekerRegister'])->name('seeker.register');
    Route::post('seeker/create', [RegisterController::class, 'registerSeeker'])->name('registerSeeker');

    Route::post('login/or/create', [LoginController::class, 'loginOrCreate'])->name('loginOrCreate');
});
Route::any('logout', [LoginController::class, 'destroy'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::prefix('oauth')->group(function (){
        Route::get('verification', [VerificationController::class, 'verification'])->name('verification');
        Route::post('verification-otp', [VerificationController::class, 'verificationCheckOtp'])->name('verificationOtp');
        Route::get('resend-verification-code', [VerificationController::class, 'resVCode'])->name('resVCode');
    });


    Route::prefix('student')->middleware('is_student')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'student'])->name('dashboard');
    });

    Route::prefix('panel')->group(function () {
        Route::prefix('admin')->group(function(){
            Route::get('dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

            Route::resource('categories', CategoryController::class);
            Route::resource('sub_categories', SubCategoryController::class);
            Route::resource('child_categories', ChildCategoryController::class);
            Route::resource('education-level', EducationLavelController::class);
            Route::resource('education', EducationController::class);

            Route::resource('companies', CompanyController::class);
            Route::post('companies/{id}/update', [CompanyController::class, 'updateCompany']);

            Route::resource('jobs', JobController::class);
            Route::post('child-categories-by-category-id', [JobController::class, 'allSubcategory'])->name('allSubCategory');
            Route::get('job-messages/{id}', [JobController::class, 'jobMessages'])->name('jobMessages');

            Route::get('seekers', [SeekerJobController::class, 'allSeekers'])->name('allSeekers');
            Route::get('view-single-seeker/{id}', [SeekerJobController::class, 'singleSeeker'])->name('singleSeeker');
            Route::delete('delete-seeker/{id}', [SeekerJobController::class, 'deleteSeeker'])->name('deleteSeeker');
            Route::get('seeker/change-activation-status/{id}/{status}', [SeekerJobController::class, 'changeAStatus'])->name('changeAStatus');

            Route::get('recruiters', [RecruiterJobController::class, 'allRecruiters'])->name('allRecruiters');
            Route::get('view-single-recruiters/{id}', [RecruiterJobController::class, 'singleRecruiters'])->name('singleRecruiters');
            Route::get('recruiters/change-activation-status/{id}/{status}', [RecruiterJobController::class, 'changeAStatus'])->name('changeAStatus');
            Route::post('recruiters/change-status', [RecruiterJobController::class, 'changeStatus'])->name('changeStatus');

            Route::resource('blogs', BlogController::class);
            Route::post('blogs/update/{id}', [BlogController::class, 'updateBlog'])->name('blogs.update_blog');
            Route::get('blogs/comments/{slug}', [BlogController::class, 'allComments'])->name('blog.comments');
            Route::get('blogs/comments/delete/{comment_id}', [CommentController::class, 'deleteBlogComment'])->name('delete.blog_comment');


            Route::get('settings',  [BusinessSettingController::class, 'index'])->name('setting.index');
            Route::post('settings',  [BusinessSettingController::class, 'updateSetting'])->name('setting.update');
            Route::post('settings/update-logo', [BusinessSettingController::class, 'logoUpdate'])->name('setting.updateLogo');

            Route::get('admin-profile', [UserController::class, 'profile'])->name('adminProfile');
            Route::post('admin-profile', [UserController::class, 'profile_update'])->name('settingUpdate');
        });

        Route::prefix('recruiters')->name('recruiter.')->middleware('recruiters')->group(function(){
            Route::withoutMiddleware('recruiters')->group(function(){
                Route::get('make-profile', [RecruitersController::class, 'makeProfile'])->name('makeProfile');
                Route::post('update-bio', [RecruitersController::class, 'updateBio'])->name('updateBio');

                Route::get('upload-business-files', [RecruitersController::class, 'uploadBusinessFile'])->name('uploadBusinessFile');
                Route::post('verify-work-mail', [RecruitersController::class, 'verifyWorkEmail'])->name('verifyWorkEmail');
                Route::get('verification/verify-work-mail', [RecruitersController::class, 'verificationWorkEmail'])->name('verificationWorkEmail');

                Route::post('verify-business-file', [RecruitersController::class, 'verifyBusinessFile'])->name('verifyBusinessFile');

                Route::get('show-before-verification-profile', [RecruitersController::class, 'showBeforeVerify'])->name('showBeforeVerify');
                Route::get('show-wait-for-verification-profile', [RecruitersController::class, 'waitForVerify'])->name('waitForVerify');

                Route::get('cancel-your-verification-request', [RecruitersController::class, 'cancelVerifyRequest'])->name('cancelVerifyRequest');

                Route::get('profile-inactive', [RecruitersController::class, 'profileInactive'])->name('profileInactive');
            });

            Route::get('dashboard', [DashboardController::class, 'recruiters'])->name('dashboard');

            Route::get('jobs', [RecruitersController::class, 'allJobs'])->name('allJobs');
            Route::get('jobs/create-job', [RecruitersController::class, 'createJob'])->name('createJob');
            Route::post('jobs/post-new-job', [RecruitersController::class, 'storeJob'])->name('storeJob');
            Route::delete('jobs/delete-job/{id}', [RecruitersController::class, 'deleteJob'])->name('deleteJob');
            Route::get('jobs/edit-single-job/{job_slug}', [RecruitersController::class, 'editJob'])->name('editJob');
            Route::put('jobs/update-single-job/{id}', [RecruitersController::class, 'updateJob'])->name('updateJob');
            Route::post('change-job-status', [RecruitersController::class, 'updateJobStatus'])->name('updateJobStatus');

            Route::get('sub-category/by-category-id/{id}', [RecruitersController::class, 'getSubCat'])->name('getSubCat');
            Route::get('child-category/by-sub-category-id/{id}', [RecruitersController::class, 'getChildCat'])->name('getChildCat');

            Route::get('company/my-all-companies', [RecruitersCompanyController::class, 'allCompanies'])->name('allCompanies');
            Route::post('company/save-new-companies', [RecruitersCompanyController::class, 'saveCompany'])->name('saveCompany');
            Route::delete('company/delete-single-companies/{id}', [RecruitersCompanyController::class, 'deleteCompany'])->name('deleteCompany');

            Route::get('save-jobs', [RecruitersController::class, 'saveJobs'])->name('saveJobs');

            Route::post('change-profile-picture', [RecruitersProfileController::class, 'changeProfilePicture'])->name('changeProfilePicture');
            Route::post('update-profile-information', [RecruitersProfileController::class, 'editPersonalInfo'])->name('editPersonalInfo');
            Route::get('edit-profile', [RecruitersProfileController::class, 'editProfile'])->name('editProfile');

            Route::get('security-page', [RecruitersProfileController::class, 'security'])->name('security');
            Route::post('update-email', [RecruitersProfileController::class, 'updateEmail'])->name('changeEmail');
            Route::post('update-security-password', [RecruitersProfileController::class, 'changePassword'])->name('changePass');

            Route::view('social-media-url-profile', 'recruiters.profile.socal_profile')->name('socialProfile');
            Route::post('update-social-profile', [RecruitersProfileController::class, 'updateSocialLinks'])->name('updateSocialLinks');
        });

        Route::prefix('seekers')->name('seeker.')->middleware('seekers')->withoutMiddleware('auth')->group(function (){
            // otp verification and profile complete for job seeker
            Route::withoutMiddleware('seekers')->group(function (){
                Route::get('second-step', [SeekerController::class, 'firstStep'])->name('firstStep');

                Route::get('get-sub-categories/{id}', [SeekerController::class, 'subCatById'])->name('getSubCat');
                Route::get('get-cities-by-state-id/{id}', [SeekerController::class, 'getCities'])->name('getCities');
                Route::get('get-upozila-by-district-id/{id}', [SeekerController::class, 'getUpozelaByDid'])->name('getupozela');

                // educations
                Route::get('get-educations-by-educations-label/{id}', [SeekerController::class, 'getEducations'])->name('getEducations');

                // first stape data save
                Route::post('data-save-first-step', [SeekerController::class, 'firstStapeSave'])->name('firstStapeSave');
                Route::post('data-save-second-step', [SeekerController::class, 'secondStapeSave'])->name('secondStapeSave');
                Route::post('data-save-third-step', [SeekerController::class, 'thirdStapeSave'])->name('thirdStapeSave');
                Route::post('data-save-last-step', [SeekerController::class, 'lastFormSave'])->name('lastFormSave');

                // profile review and goto dashboard
                Route::get('profile-review', [SeekerController::class, 'profileReview'])->name('profileReview');
                Route::post('update-seeker-profile-bio', [SeekerController::class, 'updateBio'])->name('updateBio');

                // seeker inactive
                Route::get('profile-inactive', [SeekerController::class, 'profileInactiveShow'])->name('profileInactive');
            });

            Route::get('dashboard', [SeekerController::class, 'dashboard'])->name('dashboard');


            // seeker sidebar related routes
            Route::get('save-jobs', [SeekerJobController::class, 'allSaveJobs'])->name('allSaveJobs');
            Route::get('upload-resume', [SeekerProfileController::class, 'uploadResume'])->name('uploadResume');
            Route::get('greeting-chat', [SeekerProfileController::class, 'greetingChat'])->name('greetingChat');
            Route::get('switch-to-recruiter', [SeekerProfileController::class, 'switchProfile'])->name('switchProfile');

            // seeker profile related routes
            Route::post('change-profile-picture', [SeekerProfileController::class, 'changeProfilePicture'])->name('changeProfilePicture');
            Route::post('update-profile-information', [SeekerProfileController::class, 'editPersonalInfo'])->name('editPersonalInfo');
            Route::get('edit-profile', [SeekerProfileController::class, 'editProfile'])->name('editProfile');
            Route::post('update-skills', [SeekerProfileController::class,'updateSkills'])->name('updateSkills');
            Route::post('update-portfolieo', [SeekerProfileController::class, 'updateProtfolio'])->name('updateProtfolio');
            Route::get('show-profile', [SeekerProfileController::class,'showProfile'])->name('showProfile');


            Route::get('security-page', [SeekerProfileController::class, 'security'])->name('security');
            Route::post('update-email', [SeekerProfileController::class, 'updateEmail'])->name('changeEmail');
            Route::post('update-security-password', [SeekerProfileController::class, 'changePassword'])->name('changePass');

            Route::view('social-media-url-profile', 'seekers.profile.socal_profile')->name('socialProfile');
            Route::post('update-social-profile', [SeekerProfileController::class, 'updateSocialLinks'])->name('updateSocialLinks');


            Route::post('send-message', [MessangerController::class, 'send'])->name('sendMessage');
        });
    });

    Route::get('save-job/{slug}/{id}', [HomeController::class,'saveJob'])->name('save.job');
    Route::delete('remove-save-jobs/{id}', [RecruitersController::class, 'removeSaveJOb'])->name('removeSaveJOb');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


Route::get('/test', function (){
    return view('auth.recruiter_workmail_verification');
});
