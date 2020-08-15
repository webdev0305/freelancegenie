<?php

namespace App\Http\Controllers;

use App\Model\Plan;
use App\Model\Subscription;
use Illuminate\Http\Request;
use URL;
use Input;
use App\User;
use App\Payment;
use App\model\Jobs;
use App\CreditToken;
use Stripe\Error\Card;
use Cartalyst\Stripe\Stripe;
use App\Model\EmailTemplate;
use App\Model\GlobalSettings;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ValidationRequest;
use Illuminate\Support\Facades\Validator;
use View;

class AddMoneyController extends Controller
{
    public function payWithStripe()
    {
       //echo decrypt(\Request::segment(2));
       //die('here');//gives plan id when plan expired
        
        if (!empty(\Sentinel::check())){
            // die('1st cond');
            $user_id=\Sentinel::getUser()->id;
            $plan_id=decrypt(\Request::segment(2));//Gives plan id when plan expired
            $plan  =  Plan::find($plan_id)->price;
        }else{
            //die('2nd cond'); 
            $user_id=decrypt(\Request::segment(2));//Gives user id when user is registering
            
            $subs =  Subscription::whereUserId($user_id)->first();
            
            ///echo '<pre>';print_r($subs); 
            $plan_id = $subs['plan_id'];
            $plan  =  Plan::find($plan_id)->price;
        }
        
        //echo $user_id;
        // echo '<pre>';print_r($subs);die('here');
         
         return view('paywithstripe',compact('plan','plan_id'));
    }
    public function postPaymentWithStripe(Request $request)
    {	//die('I am working here');
		$data = $request->input();       // print_r($data);               // die('checking here');               
        $plan_id = $data['plan_id'];       
        if (!empty(\Sentinel::check())){
            $user_id=\Sentinel::getUser()->id;
			$redirect='/dashboard';
			$plan_type=1;
        }else{
            $user_id=decrypt($data['user_id']);
			$redirect='/login';
			$plan_type=2;
        }
        $subs =  Subscription::whereUserId($user_id)->first();
        
        $validation = Validator::make($data, ValidationRequest::$stripeValid);
        if ($validation->fails()) {
            $errors = $validation->messages();
            return Redirect::back()->with('errors', $errors);
        }
        $input = $request->all();
        $input = array_except($input, array('_token'));
        
        // $stripe = Stripe::make('sk_test_51Fj4rvCxpWLiTHp6wrbUhCpC34d499CRyQWa1EcF407hn4fQERZVK4wPNce8sc0npZdjtY8WlLAgVJeF21bno2p200YyD2xyut');
        $stripe = \Stripe::setApiKey(env('STRIPE_SECRET'));
        // var_dump($stripe);die();
        try {
            $token = $stripe->tokens()->create([
                'card' => [
                    'number' => $request->get('card_no'),
                    'exp_month' => $request->get('ccExpiryMonth'),
                    'exp_year' => $request->get('ccExpiryYear'),
                    'cvc' => $request->get('cvvNumber'),
                ],
            ]);
            
            // var_dump($token);die();
            
            if (!isset($token['id'])) {
                return Redirect::back();
            }
          
            $plan  =  Plan::find($plan_id);
            
            // var_dump($plan);die();
            $charge = $stripe->charges()->create([
                'card' => $token['id'],
                'currency' => 'gbp',
                'amount' => $plan['price'],
                'description' => '',
            ]);
            // var_dump($charge);die();
            if ($charge['status'] == 'succeeded') {
                $subs->trans_id = $charge['id'];
                $subs->amount = $charge['amount'];
                $subs->balance_transaction = $charge['balance_transaction'];
                $subs->captured = $charge['captured'];
                $subs->created = $charge['created'];
                $subs->subscription_code = uniqid();
               // $subs->plan_id = $subs['plan_id'];
				$subs->plan_id = $plan_id;
                $subs->currency = $charge['currency'];
                $subs->save();

                \Session::flash('success', 'Subscription added successfully');
				$user = User::find($user_id);
				$to = $user->email;
				//$to = "krishankmr.bbdit@gmail.com";
				$email_template=EmailTemplate::first();
				$admin_email=GlobalSettings::where('name','admin_email')->first()->value;
				if($plan_type ==2){ // First time Subscription
					/*$subject = "FL Genie Subscription";
					$message = "
				<html>
				<head>
				<title>FL Genie Subscription</title>
				</head>
				<body>
				<p>Dear ".ucfirst($user->first_name) ." ".$user->last_name . ", You have successfully subscribed with FL Genie.</p>
				<p>Below are the plan details:</p>
				<p>Plan: ".ucfirst($plan->title)."<br>Duration: ".$plan->duration."<br>Cost: ".$plan->price."<br></p>
				<p>Thanks</p>
				<p>FL Genie</p>
				</body>
				</html>
				";*/
				
					$subject = "Freelance Genie Subscription";  
					$title = '<title>Freelance Genie Subscription</title>';
					 //Send Email to Admin				
					$content = "<p>Dear ".ucfirst($user->first_name) ." ".$user->last_name . ", You have successfully subscribed with Freelance Genie.</p>
					<p>Below are the plan details:</p>
					<p>Plan: ".ucfirst($plan->title)."<br>Duration: ".$plan->duration."<br>Cost: £".$plan->price."<br></p>
					<p>Thanks</p>
					<p>Freelance Genie</p>";
					$message=str_replace('<title></title>',$title,$email_template->body);
					$message=str_replace('<p></p>',$content,$message);
					//mail($tutor_email, $subject, $message, $headers);
				
				}else{ // Plan Renewal
				    $subject = "Freelance Genie Plan Renewal";  
					$title = '<title>Freelance Genie Plan Renewal</title>';
					 //Send Email to Admin				
					$content = "<p>Dear ".ucfirst($user->first_name) ." ".$user->last_name . ", You have successfully renewed your plan.</p>
                    <p>Below are the new plan details:</p>
                    <p>Plan: ".$plan->title."<br>Duration: ".$plan->duration."<br>Cost: £".$plan->price."<br></p>
                    <p>Thanks</p>
                    <p>Freelance Genie</p>";
					$message=str_replace('<title></title>',$title,$email_template->body);
					$message=str_replace('<p></p>',$content,$message);
					//mail($tutor_email, $subject, $message, $headers);
					
				}
				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				// More headers
				$headers .= 'From: <'.$admin_email.'>' . "\r\n";
				//$headers .= 'Cc: myboss@example.com' . "\r\n";

				// mail($to,$subject,$message,$headers);
                return Redirect::to($redirect);
            } else {
                \Session::flash('error', 'Money not add in wallet!!');
                return Redirect::back();
            }
        } catch (Exception $e) {
            \Session::flash('error', $e->getMessage());
            return Redirect::back();
        } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
            \Session::flash('error', $e->getMessage());
            return Redirect::back();
        } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            \Session::flash('error', $e->getMessage());
            return Redirect::back();
        }

    }
	public function payBooking()
    {   $jobs = Jobs::find(Input::get('job_id'));
        $total=$jobs->total;
        $half_paid=$jobs->half_paid;
        //echo Input::get('job_id');echo '<pre>';print_r($jobs);die;
        if($jobs->pay_method == 'credit')
            return view('booking',compact(['total','half_paid']));
        if($jobs->pay_method == 'bank'){
            \Stripe\Stripe::setApiKey('sk_test_51Fj4rvCxpWLiTHp6wrbUhCpC34d499CRyQWa1EcF407hn4fQERZVK4wPNce8sc0npZdjtY8WlLAgVJeF21bno2p200YyD2xyut');
            $product = \Stripe\Product::create([
                'name' => 'booking_tutor',
            ]);
            $total = $total * 100;
            
            $price = \Stripe\Price::create([
                'product' => $product->id,
                'unit_amount' => $total,
                'currency' => 'gbp',
            ]);
            $stripe = new \Stripe\StripeClient(
                'sk_test_51Fj4rvCxpWLiTHp6wrbUhCpC34d499CRyQWa1EcF407hn4fQERZVK4wPNce8sc0npZdjtY8WlLAgVJeF21bno2p200YyD2xyut'
            );
            $customer = $stripe->customers->create([
                'description' => 'My First Test Customer (created for API docs)',
            ]);
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['bacs_debit'],
                'line_items' => [[
                  'price' => $price->id,
                  'quantity' => 1,
                ]],
                'mode' => 'payment',
                'customer' => $customer->id,
                'payment_intent_data' => [
                  'setup_future_usage' => 'off_session',
                ],
                'success_url' => 'https://freelancegenie.co.uk/bank_alert',
                'cancel_url' => 'https://freelancegenie.co.uk/care_courses',
            ]);
            $sessionid = $session->id;
            if (!empty($sessionid)){
                $payment=new Payment;
                $payment->job_id = $jobs->id;
                $payment->trans_id = '';
                $payment->amount = $total;
                $payment->balance_transaction = $sessionid;
                $payment->captured = '0';
                $payment->created = time();
                $payment->currency = 'gbp';
                $payment->save();
                return view('booking_bank',compact(['sessionid']));
            }
            else 
                return Redirect::back()->with('errors', $errors);
        }
    }
	public function postPaymentBooking(Request $request)
    {		
		$data = $request->input();
		$job_id  = $request->get('job_id');
		$get_job =  Jobs::whereId($job_id)->first();
		$job =  Jobs::whereId($job_id);
		
		//return $job;
        $validation = Validator::make($data, ValidationRequest::$stripeValid);
        if ($validation->fails()) {
            $errors = $validation->messages();
            return Redirect::back()->with('errors', $errors);
        }
		//return $job_id;
		$input = $request->all();
        $input = array_except($input, array('_token'));
        $stripe = Stripe::make('sk_test_PVXtzkhKGE6eV0iuxTqgh4iZ');
        try {
            $token = $stripe->tokens()->create([
                'card' => [
                    'number' => $request->get('card_no'),
                    'exp_month' => $request->get('ccExpiryMonth'),
                    'exp_year' => $request->get('ccExpiryYear'),
                    'cvc' => $request->get('cvvNumber'),
                ],
            ]);
            if (!isset($token['id'])) {
                return Redirect::back();
            }
          
            //$plan  =  Plan::find($subs['plan_id']);
             $charge = $stripe->charges()->create([
                'card' => $token['id'],
                'currency' => 'gbp',
                'amount' => $request->get('amount_pay'),
                'description' => '',
            ]);

            if ($charge['status'] == 'succeeded') {
			    $payment=new Payment;
				$payment->job_id = $job_id;
                $payment->trans_id = $charge['id'];
                $payment->amount = $charge['amount'];
                $payment->balance_transaction = $charge['balance_transaction'];
                $payment->captured = $charge['captured'];
                $payment->created = $charge['created'];
                $payment->currency = $charge['currency'];
                $payment->save();
                  
                if($data['pending_paid'] == "1"){
                    $job->update(['half_paid' => "1"]);
				}
                if($data['half_paid'] == "1"){
				    $job->update(['half_paid' => "0"]);
                }
				
				if($get_job->assignment != "0"){ // for assignment
					$job->update(['status' => "6"]);
				}else{ // for rest all jobs
					$job->update(['status' => "1"]);
				}
				//echo '<pre>';print_r($job);echo '</pre>';die('here');
				
				//$job->save();

                \Session::flash('success', 'Payment successful');
                return Redirect::to('/dashboard');
            } else {
                \Session::flash('error', 'Payment fail,Please try again');
                return Redirect::back();
            }
        } catch (Exception $e) {
            \Session::flash('error', $e->getMessage());
            return Redirect::back();
        } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
            \Session::flash('error', $e->getMessage());
            return Redirect::back();
        } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            \Session::flash('error', $e->getMessage());
            return Redirect::back();
        }

    }
	 
    
	public function onAccount(Request $request)
    {
        $usrid  = decrypt($request->get('user_id'));
        $subs =  Subscription::whereUserId($usrid)->first();
        $subs->onaccount = 1;
        $subs->save();
        \Session::flash('success', 'Request for On Account subscription has been sent');
        try{
            $crtoken = new CreditToken;
            $crtoken->user_id = $usrid == NULL ? NULL : $usrid;
            $crtoken->token = 1;
            $crtoken->token_year = date("Y");
            $crtoken->save();
        }catch(\Exception $e){
            die($e->getMessage());
        }
        return Redirect::to('/');
    }

    public function webHooks(Request $request)
    {
        \Stripe\Stripe::setApiKey('sk_test_51Fj4rvCxpWLiTHp6wrbUhCpC34d499CRyQWa1EcF407hn4fQERZVK4wPNce8sc0npZdjtY8WlLAgVJeF21bno2p200YyD2xyut');
        
        $endpoint_secret = 'whsec_SuCyqvh063EI3992lMQ63ulLD2jsBUeD';
        $payload = file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;
        try {
            $event = \Stripe\Webhook::constructEvent(
              $payload, $sig_header, $endpoint_secret
            );
        } catch(\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
            exit();
        }
        $type = $event['type'];
        $object = $event['data']['object'];
        if($type == 'checkout.session.async_payment_succeeded') {
            Payment::where('balance_transaction', $object['id'])->update(['captured' => '1','trans_id' => $object['payment_intent']]);
        }
        http_response_code(200);

    }

}