<?php

namespace App\Http\Controllers;

use App\Http\Requests\SocialMediaRequest;
use Illuminate\Http\Request;
use App\social_media;
use Carbon\Carbon;
use App\Company;
use App\Payment;
use App\User;
use Redirect;
use Helper;
use PayPal;
use Auth;

class CompanyController extends Controller
{
    public function index()
    {
        $jobs  = Auth::user()->jobs;
        return view('company.index', compact('jobs'));
    }

    public function companyInfo(Request $request)
    {        
        $check_query = Company::where('user_id', '=', Auth::id())->first();

        if ($check_query) {
            $companyInfo = $check_query;
        } else {
            $companyInfo = new Company;
            $companyInfo->user_id = Auth::id();
        }

        if ($request->logo) {
            $companyInfo->logo = Helper::uploadImage('logo','logo');
        }

        $companyInfo->company_size = $request->company_size;
        $companyInfo->industry     = $request->company_industry;
        $companyInfo->phone        = $request->company_phone;
        $companyInfo->fax          = $request->company_fax;
        $companyInfo->country      = $request->company_country;
        $companyInfo->city         = $request->company_city;
        $companyInfo->save();
    }

    public function getPaymentList()
    {
        $payments = Payment::where('user_id', '=', Auth::id())->get();
        return view('company.paypal.list', compact('payments'));
    }

    public function companyAbout(Request $request)
    {
        $check_query = Company::where('user_id', '=', Auth::id())->first();

        if ($check_query) {
            $companyAbout = $check_query;
        } else {
            $companyAbout = new Company;
            $companyAbout->user_id = Auth::id();
        }

        $companyAbout->about  = $request->about_us;
        $companyAbout->save(); 
    }

    public function socialMedia(SocialMediaRequest $request)
    {
        // get [company]'s [social_media] if exists
        $check_query = social_media::where('user_id', '=', Auth::id())->first();
        
        if ($check_query) {
            $socialMedia = $check_query;
        } else {
            $socialMedia = new social_media;
            $socialMedia->user_id  = Auth::id();
        }

        $socialMedia->website  = $request->website;
        $socialMedia->facebook = $request->facebook;
        $socialMedia->twitter  = $request->twitter;
        $socialMedia->linkedin = $request->linkedin;
        $socialMedia->save();

        return response()->json(['success' => true]);
    }

    public function companyLocation(Request $request)
    {
        $check_query = Company::where('user_id', '=', Auth::id())->first();

        if ($check_query) {
            $companyLocation = $check_query;
        } else {
            $companyLocation = new Company;
            $companyLocation->user_id  = Auth::id();
        }

        $companyLocation->latitude = $request->latitude;
        $companyLocation->langtude = $request->langtude;
        $companyLocation->save();
    }

    public function companyCover(Request $request)
    {
        $check_query = Company::where('user_id', '=', Auth::id())->first();

        if ($check_query) {
            $companyCover = $check_query;
        } else {
            $companyCover = new Company;
            $companyCover->user_id  = Auth::id();
        }

        if ($request->cover) {
            $companyCover->cover = Helper::uploadImage('cover', 'cover');
        }
        
        $companyCover->save();      
    }

    public function upgrade()
    {
        $paypal_class = new PaypalHelper;
        return $paypal_class->getCheckout('USD', 50);
    }

    public function getPaypalRenew()
    {
        return view('company.paypal.renew');
    }

    public function getPaypalPay()
    {
        $paypal_class = new PaypalHelper;
        return $paypal_class->getCheckout('USD', 50);
    }

    public function getPaypalRenewCheck(Request $request)
    {
        $id       = $request->get('paymentId');
        $token    = $request->get('token');
        $payer_id = $request->get('PayerID');

        $paypal_class = new PaypalHelper();
        $method = $paypal_class->checkPayment($id, $token, $payer_id);

        $newExpireDate = strtotime(Carbon::now()->addMonth());

        $companyPayment                 = new Payment;
        $companyPayment->user_id        = Auth::id();
        $companyPayment->amount         = $method->transactions[0]->amount->total;
        $companyPayment->invoice_number = $method->transactions[0]->invoice_number;
        $companyPayment->payment_date   = Carbon::now();
        $companyPayment->expire_date    = $newExpireDate;
        if($companyPayment->save()) {

            $companyExpire = Company::where('user_id', '=', Auth::id())->first();
            $companyExpire->expire_date = $newExpireDate;
            $companyExpire->type        = 'paid';
            $companyExpire->save();

            session()->forget('method');
            session()->put('method', $method);
            return redirect('company/checkout/success');
        }
    }

    public function paypalCheck(Request $request)
    {
        $id       = $request->get('paymentId');
        $token    = $request->get('token');
        $payer_id = $request->get('PayerID');

        $paypal_class = new PaypalHelper();
        $method = $paypal_class->checkPayment($id, $token, $payer_id);

        $newExpireDate = strtotime(Carbon::now()->addMonth());

        $companyPayment                 = new Payment;
        $companyPayment->user_id        = Auth::id();
        $companyPayment->amount         = $method->transactions[0]->amount->total;
        $companyPayment->invoice_number = $method->transactions[0]->invoice_number;
        $companyPayment->payment_date   = Carbon::now();
        $companyPayment->expire_date    = $newExpireDate;
        if($companyPayment->save()) {

            $companyExpire = Company::where('user_id', '=', Auth::id())->first();
            $companyExpire->expire_date = $newExpireDate;
            $companyExpire->type        = 'paid';
            $companyExpire->save();

            session()->forget('method');
            session()->put('method', $method);
            return redirect('company/checkout/success');
        }
    }

    public function paypalDone()
    {
        if (session()->get('method')) {
            $method = session()->get('method');
            session()->forget('method');

            return view('company.paypal.success', compact('method'));
        } else {
            return redirect('company');
        }
    }

    public function paypalCancel()
    {
        return view('company.paypal.cancel');
    }

    public function getJobSeekers()
    {
        $jobseekers = User::Where('type', '=', 'jobseeker')->get();
        return view('company.jobseeker.index', compact('jobseekers'));
    }

    public function getJobSeekerProfile($id)
    {
        $user = User::find($id);
        return view('company.jobseeker.details', compact('user'));
    }
}