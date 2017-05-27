<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Setting;
use Redirect;
use PayPal;
use Auth;

class PaypalHelper extends Controller
{
    private $_apiContext;

    public function __construct()
    {
    	$settings = Setting::find(1);

    	$client_id   = $settings->client_id;
    	$secret      = $settings->secret_id;
    	$paypal_mode = $settings->paypal_mode;

    	if ($settings->paypal_mode == 'sandbox') {
    		$paypal_link = "https://api.sandbox.paypal.com";
    	} else {
    		$paypal_link = "https://api.paypal.com";
    	}
    
    	$this->_apiContext = PayPal::ApiContext($client_id, $secret);
		
		$this->_apiContext->setConfig(array(
			'mode'                   => 'sandbox',
			'service.EndPoint'       => 'https://api.sandbox.paypal.com',
			'http.ConnectionTimeOut' => 30,
			'log.LogEnabled'         => true,
			'log.FileName'           => storage_path('logs/paypal.log'),
			'log.LogLevel'           => 'FINE'
		));
    }

    public function getCheckout($currency, $price)
	{
		$payer = PayPal::Payer();
		$payer->setPaymentMethod('paypal');

		$item = PayPal::Item();
		$item->setName('EmployMe Upgrade')
			 ->setCurrency($currency)
			 ->setQuantity(1)
			 ->setSku(Auth::user()->id)
			 ->setPrice($price);

		$itemList = PayPal::ItemList();
        $itemList->setItems(array($item));

		$details = PayPal::Details();
        $details->setShipping(0)
                ->setTax(0)
                ->setSubtotal($price);

		$amount = PayPal::Amount();
		$amount->setCurrency($currency)
			   ->setDetails($details)
			   ->setTotal($price);

		$transaction = PayPal::Transaction();
		$transaction->setAmount($amount)
					->setItemList($itemList)
					->setDescription('Upgrade Your Monthly EmployMe Account Subscription')
					->setInvoiceNumber(uniqid());

		if (Auth::user()->company->expire_date <= strtotime(Carbon::now())) {
			$redirectUrls = PayPal:: RedirectUrls()
						->setReturnUrl(action('CompanyController@getPaypalRenewCheck'))
						->setCancelUrl(action('CompanyController@paypalCancel'));
		} else {
			$redirectUrls = PayPal:: RedirectUrls()
						->setReturnUrl(action('CompanyController@paypalCheck'))
						->setCancelUrl(action('CompanyController@paypalCancel'));
		}

		$payment = PayPal::Payment();
		$payment->setIntent('sale')
				->setPayer($payer)
				->setRedirectUrls($redirectUrls)
				->setTransactions(array($transaction));

		$request = clone $payment;

        try {
            $payment->create($this->_apiContext);
        } catch (Exception $ex) {
            exit(1);
        }

        $approvalUrl = $payment->getApprovalLink();
        return Redirect($approvalUrl);
	}

	public function checkPayment($id,$token,$payer_id)
	{
		$payment = PayPal::getById($id, $this->_apiContext);
        $paymentExecution = PayPal::PaymentExecution();
        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

        return $executePayment;
	}
}