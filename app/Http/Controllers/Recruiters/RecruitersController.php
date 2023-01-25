<?php

namespace App\Http\Controllers\Recruiters;

use App\Http\Controllers\Controller;
use App\Mail\VerificationWorkMail;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Company;
use App\Models\Country;
use App\Models\Division;
use App\Models\Education;
use App\Models\EducationLabel;
use App\Models\Job;
use App\Models\Order;
use App\Models\Recruiter;
use App\Models\SaveJob;
use App\Models\Skill;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Models\User;
use App\Notifications\VerifyWorkMailNotefication;
use App\Properties;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use RealRashid\SweetAlert\Facades\Alert;

class RecruitersController extends Controller
{

    public function makeProfile()
    {
        return view('recruiters.profile.build_profile');
    }

    public function updateBio(Request $request)
    {
        $request->validate([
            'c_full_name' => 'required',
            'c_short_name' => 'required',
            'email' => 'required|email',
            'employee_size' => 'required',
            'first_name' => 'required',
            'full_address' => 'nullable',
            'gender' => 'required',
            'hot_industry' => 'required',
            'last_name' => 'required'
        ]);


        $user = Auth::user();

        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic')->store('user', 'public');
            $user->photo = $file;
        }
        $user->name = $request->first_name . " " . $request->last_name;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->update();


        $user->recruiter->update([
            'company_name' => $request->c_full_name,
            'company_sname' => $request->c_short_name,
            'designation' => $request->designation,
            'company_address' => $request->full_address,
            'emp_size' => $request->employee_size,
            'hot_industry' => $request->hot_industry
        ]);

        return response()->json([
            'status' => 200,
            'url' => URL::route('recruiter.dashboard')
        ]);
    }

    public function uploadBusinessFile()
    {
        return view('recruiters.profile.upload_business_file');
    }

    public function verifyWorkEmail(Request $request)
    {
        $request->validate([
            'work_mail' => 'required|email',
        ]);
        $user = User::findOrFail(Auth::id());
        $user->recruiter->work_mail = $request->work_mail;
        $user->recruiter->update();
        Mail::to($user->recruiter->work_mail)->send(new VerificationWorkMail($user));
        toast('Send verification email on your work mail. please verification your email...');
        return redirect()->route('recruiter.dashboard');
    }


    public function showBeforeVerify()
    {
        return view('recruiters.profile.wait_for_verify');
    }

    public function verificationWorkEmail()
    {
        $mail = base64_decode(\request()->input('_token'));
        $rec = Recruiter::where('work_mail', $mail)->first();
        if ($rec) {
            $rec->work_mail_verified_at = Carbon::now();
            $rec->status = Properties::$waiting;
            $rec->update();
            toast('Now Your Work-Mail Is Verified', 'success');
            return redirect()->route('recruiter.dashboard');
        } else {
            toast('Verification token is wrong', 'error');
            return redirect()->route('recruiter.dashboard');
        }
    }

    public function verifyBusinessFile(Request $request): \Illuminate\Http\RedirectResponse
    {
        if ($request->hasFile('business_files')) {
            $file = $request->file('business_files')->store('user', 'public');
            $user = User::findOrFail(Auth::id());
            $user->recruiter->business_file = $file;
            $user->recruiter->status = Properties::$waiting;
            $user->recruiter->update();
        }
        toast('Wait for verification your profile...');
        return redirect()->route('recruiter.dashboard');
    }


    public function waitForVerify()
    {
        return view('recruiters.profile.wait_for_verify');
    }

    public function cancelVerifyRequest()
    {
        return view('recruiters.profile.cancel_verify');
    }

    public function profileInactive()
    {
        return view('recruiters.profile.profile_inactive');
    }


    public function saveJobs()
    {
        $jobs = SaveJob::where('user_id', Auth::id())
            ->latest()
            ->with(['job', 'job.category', 'job.companyDetails.photos'])
            ->paginate(10);

        $save = true;
        return view('recruiters.jobs.save_jobs', compact('jobs', 'save'));
    }


    public function removeSaveJOb($id)
    {
        SaveJob::findOrFail($id)->delete();
        toast('Successfully remove save job', 'success');
        return back();
    }



    public function getSubCat($id)
    {
        $sub_categories = SubCategory::where('category_id', $id)->get();
        return response()->json(['data' => $sub_categories], 200);
    }

    public function getChildCat($id)
    {
        $sub_categories = ChildCategory::where('sub_category_id', $id)->get();
        return response()->json(['data' => $sub_categories], 200);
    }

    public function collectionPagination($items, $baseUrl = null, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ?
            $items : Collection::make($items);

        $lap = new LengthAwarePaginator($items->forPage($page, $perPage),
            $items->count(),
            $perPage, $page, $options);

        if ($baseUrl) {
            $lap->setPath($baseUrl);
        }
        return $lap;
    }

    public function appliedSeekers()
    {
        $jobId = \request()->input('job-id');
        $types = \request()->input('types');
        $states = Division::all();
        $degrees = EducationLabel::all();
        $educations = Education::all();

//        return \request();
        if ($jobId) {
            $query = Job::query()
                ->where("id", $jobId)
                ->with(['appliedUsers', 'appliedUsers.seeker'])
                ->when(\request()->input('types') != null, function ($query) use ($types) {
                    $query->withWhereHas("appliedUsers", function ($query) use ($types) {
                        $query->withWhereHas("seeker", function ($query) use ($types) {
                            $query
                                ->where('types', $types);
                        });
                    });
                })
                ->when(\request()->input('maxSalary') != null, function ($query) {
                    $query->withWhereHas("appliedUsers", function ($query) {
                        $query->withWhereHas("seeker", function ($query) {
                            $query->where('exp_min_sal', "<=", \request()->input('maxSalary'));
                        });
                    });
                })



//        $content = Content::whereHas('subcategories', function ($query) use($sub_category_id) {
//            $query->where('sub_category_id', $sub_category_id);
//        })->whereHas('categories', function($query) use($category_id) {
//            $query->where('category_id', $category_id);
//        })->get();

//                ->when(\request()->input('start_date'), function ($query) {
//                    $query->withWhereHas("appliedUsers", function ($query) {
//                        $query->withWhereHas("seeker", function ($query) {
//                            $query->whereDate('created_at', \request()->input('start_date')->format('Y-m-d'));
////                            $query->whereDate('created_at', \request()->input('start_date'));
//                        });
//                    });
//                })
//                ->when(\request()->input('maxSalary') != null, function ($query) {
//                    $query->withWhereHas("appliedUsers", function ($query) {
//                        $query->withWhereHas("seeker", function ($query) {
//                            $query->orWhere('exp_min_sal', '<=', request('maxSalary'));
//                        });
//                    });
//                });
            ;

//            if (\request()->has('start_date') || \request()->has('end_date')){
//                $query->withWhereHas("appliedUsers", function ($query) {
//                    $query->whereDate('created_at', '>=', \request()->input('start_date'));
////                    $query->whereBetween('created_at', array(\request()->input('start_date'), \request()->input('end_date')));
//                });
//            }

            $appliedSeekers = $this->collectionPagination($query->first()->appliedUsers ?? [], config('app.url'), 10)->withQueryString();

            $job = Job::find($jobId);


//            $appliedSeekers = Job::where('id', $jobId)->with(["appliedUsers.seeker"=> function($seeker)use($types){
//                $seeker->where("types", $types);
//            }])->first();
//            $appliedSeekers->setRelation("appliedUsers", $appliedSeekers->appliedUsers)->paginate(12)->withQueryString();

            return view('recruiters.jobs.applied_users', compact('appliedSeekers', 'job', 'states', 'degrees', 'educations'));
        }
        toast('This Job Not Found...', 'error');
        return back();

    }

    public function appliendSeekerProfile()
    {
        $user = User::findOrFail(\request()->input('user_id'))->load("seeker");
        return view('recruiters.jobs.applicents_details', compact('user'));
    }


    public function report()
    {

        $content = Order::whereHas('subcategories', function ($query) use($sub_category_id) {
                $query->where('sub_category_id', $sub_category_id);
            })->whereHas('categories', function($query) use($category_id) {
                    $query->where('category_id', $category_id);
            })->get();




        // total section =============================================================================================================

        // total sum or rejected product
        $total_rejected_product = ProductionLog::sum('rejected_product');
        // total sum of net product
        $total_net_product = ProductionLog::sum('net_product');
        // total sum of finising product
        $total_finishing_product = ProductionLog::where('status', 'fininshing')->sum('net_product');
        // total sum of swieng product
        $total_net_swieng_product = ProductionLog::where('status', 'sewing')->sum('net_product');
        // total rejected form swieng product
        $total_rejected_swieng_product = ProductionLog::where('status', 'sewing')->sum('rejected_product');

        // total section =============================================================================================================


        // today section =============================================================================================================

        // today total rejected product
        $total_today_rejected_product = ProductionLog::whereDate('created_at', date('Y-m-d'))->sum('rejected_product');

        // today total net product
        $total_today_net_product = ProductionLog::whereDate('created_at', date('Y-m-d'))->sum('net_product');

        // today finishing product
        $total_today_finishing_product = ProductionLog::where('status', 'fininshing')->whereDate('created_at', date('Y-m-d'))->sum('net_product');

        // today sum of swieng product
        $total_today_net_swieng_product = ProductionLog::where('status', 'sewing')->whereDate('created_at', date('Y-m-d'))->sum('net_product');

        // toay rejected form swieng product
        $total_today_rejected_swieng_product = ProductionLog::where('status', 'sewing')->whereDate('created_at', date('Y-m-d'))->sum('rejected_product');

        // today section =============================================================================================================


        // weekly section =============================================================================================================

        // weekly total rejected product
        $total_weekly_rejected_product = ProductionLog::whereBetween('created_at', [
            Carbon::parse('last monday')->startOfDay(),
            Carbon::parse('next friday')->endOfDay(),
        ])->sum('rejected_product');

        // weekly total net product
        $total_weekly_net_product = ProductionLog::whereBetween('created_at', [
            Carbon::parse('last monday')->startOfDay(),
            Carbon::parse('next friday')->endOfDay(),
        ])->sum('net_product');

        // weekly total net product
        $total_weekly_finishing_product = ProductionLog::where('status', 'fininshing')->whereBetween('created_at', [
            Carbon::parse('last monday')->startOfDay(),
            Carbon::parse('next friday')->endOfDay(),
        ])->sum('net_product');

        // weekly total rejected swieng product
        $total_weekly_rejected_swieng_product = ProductionLog::where('status', 'sewing')->whereBetween('created_at', [
            Carbon::parse('last monday')->startOfDay(),
            Carbon::parse('next friday')->endOfDay(),
        ])->sum('rejected_product');

        // weekly total net swieng product
        $total_weekly_net_swieng_product = ProductionLog::where('status', 'sewing')->whereBetween('created_at', [
            Carbon::parse('last monday')->startOfDay(),
            Carbon::parse('next friday')->endOfDay(),
        ])->sum('net_product');

        // weekly section =============================================================================================================


        // monthly section =============================================================================================================

        // monthly total rejected product
        $total_monthly_rejected_product = ProductionLog::whereMonth('created_at', date('m'))->sum('rejected_product');

        // monthly total net product
        $total_monthly_net_product = ProductionLog::whereMonth('created_at', date('m'))->sum('net_product');

        // monthly total finishing product
        $total_monthly_finishing_product = ProductionLog::where('status', 'fininshing')->whereMonth('created_at', date('m'))->sum('net_product');

        // monthly total net swieng product
        $total_monthly_rejected_swieng_product = ProductionLog::where('status', 'sewing')->whereMonth('created_at', date('m'))->sum('rejected_product');

        // monthly total rejected swieng product
        $total_monthly_net_swieng_product = ProductionLog::where('status', 'sewing')->whereMonth('created_at', date('m'))->sum('net_product');

        // monthly section =============================================================================================================


        // monthly section =============================================================================================================

        // yearly total rejected product
        $total_yearly_rejected_product = ProductionLog::whereYear('created_at', date('Y'))->sum('rejected_product');

        // yearly total net product
        $total_yearly_net_product = ProductionLog::whereYear('created_at', date('Y'))->sum('net_product');

        // yearly total net product
        $total_yearly_finishing_product = ProductionLog::where('status', 'fininshing')->whereYear('created_at', date('Y'))->sum('net_product');

        // yearly total rejected swieng product
        $total_yearly_rejected_swieng_product = ProductionLog::where('status', 'sewing')->whereYear('created_at', date('Y'))->sum('rejected_product');

        // yearly total net swieng product
        $total_yearly_net_swieng_product = ProductionLog::where('status', 'sewing')->whereYear('created_at', date('Y'))->sum('net_product');

        // monthly section =============================================================================================================


        $data = [];
        $data['total_rejected_sum'] = $total_rejected_product;
        $data['total_net_sum'] = $total_net_product;
        $data['total_finishing_product'] = $total_finishing_product;
        $data['total_net_swieng_product'] = $total_net_swieng_product;
        $data['total_rejected_swieng_product'] = $total_rejected_swieng_product;

        $data['total_today_rejected_product'] = $total_today_rejected_product;
        $data['total_today_net_product'] = $total_today_net_product;
        $data['total_today_finishing_product'] = $total_today_finishing_product;
        $data['total_today_net_swieng_product'] = $total_today_net_swieng_product;
        $data['total_today_rejected_swieng_product'] = $total_today_rejected_swieng_product;

        $data['total_weekly_rejected_product'] = $total_weekly_rejected_product;
        $data['total_weekly_net_product'] = $total_weekly_net_product;
        $data['total_weekly_finishing_product'] = $total_weekly_finishing_product;
        $data['total_weekly_rejected_swieng_product'] = $total_weekly_rejected_swieng_product;
        $data['total_weekly_net_swieng_product'] = $total_weekly_net_swieng_product;

        $data['total_monthly_rejected_product'] = $total_monthly_rejected_product;
        $data['total_monthly_net_product'] = $total_monthly_net_product;
        $data['total_monthly_finishing_product'] = $total_monthly_finishing_product;
        $data['total_monthly_rejected_swieng_product'] = $total_monthly_rejected_swieng_product;
        $data['total_monthly_net_swieng_product'] = $total_monthly_net_swieng_product;

        $data['total_yearly_rejected_product'] = $total_yearly_rejected_product;
        $data['total_yearly_net_product'] = $total_yearly_net_product;
        $data['total_yearly_finishing_product'] = $total_yearly_finishing_product;
        $data['total_yearly_rejected_swieng_product'] = $total_yearly_rejected_swieng_product;
        $data['total_yearly_net_swieng_product'] = $total_yearly_net_swieng_product;


        return $data;
        exit();


    }


}
