<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Services\SubscriptionService;

class SubscriptionController extends Controller
{
    public function __construct(public SubscriptionService $subscriptionService)
    {

    }

    public function subscribe(Request $request)
    {
        $planId = $request->plan === 'premium' ? env('premium_plan_stripe_id') : env('basic_plan_stripe_id');

        $oldSubscription = $request->user()?->subscriptions()?->active()?->first();

        if($oldSubscription?->type == "basic")
        {
            // if already subscribed to basic plan
            $request->user()->subscription('basic')->cancelNow();
        }

        auth()->user()->newSubscription($request->plan, $planId)->create($request->paymentMethodId);
    }

    public function showBasicPlan()
    {
         $stripeKey = env('STRIPE_KEY');
        return Inertia::render('BasicPlan', compact('stripeKey'));
    }

    public function showPremiumPlan()
    {
         $stripeKey = env('STRIPE_KEY');
        return Inertia::render('PremiumPlan', compact('stripeKey'));
    }

    public function cancelSubscription(Request $request)
    {
        $subscription = $request->user()?->subscriptions()?->active()?->first();

        if ($subscription) {
            $request->user()->subscription($subscription->type)->cancel();
            return redirect()->back();
        }

        return redirect()->back();
    }

    public function resumeSubscription(Request $request)
    {
        $subscription = $request->user()?->subscriptions()?->active()?->first();
        if ($subscription) {
            $request->user()->subscription($subscription->type)->resume();
            return redirect()->back();
        }
    }

    public function subscriptionDetail()
    {
         return Inertia::render('Admin/Subscription');
    }

    public function paymentLogs(Request $request)
    {
        $payments =  $request->user()->invoices();
        // return $payments;
        return Inertia::render('Admin/PaymentLogs',compact('payments'));
    }
}
