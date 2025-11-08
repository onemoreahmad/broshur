<?php

namespace App\Api\Subscription;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;

class GetPlans
{
    use AsAction;

    public function handle(Request $request)
    {
        $plans = Plan::getAll()
            ->groupBy(function (Plan $plan) {
                return Str::before($plan->slug, '-') ?: $plan->slug;
            })
            ->map(function ($group, $subscriptionKey) {
                /** @var \Illuminate\Support\Collection<int, Plan> $group */
                $basePlan = $group->first();
                $config = (array) config('subscription.info.' . $subscriptionKey, []);

                return [
                    'key' => $subscriptionKey,
                    'name' => $basePlan->name,
                    'label' => $basePlan->label,
                    'meta' => $basePlan->meta,
                    'image' => $basePlan->image,
                    'info' => [
                        'summary' => data_get($config, 'info'),
                        'description' => data_get($config, 'about'),
                        'color' => data_get($config, 'color'),
                        'price' => data_get($config, 'price'),
                        'image' => data_get($config, 'image'),
                    ],
                    'options' => $group->map(function (Plan $plan) {
                        return [
                            'id' => $plan->id,
                            'slug' => $plan->slug,
                            'name' => $plan->name,
                            'price' => $plan->price,
                            'periodicity' => $plan->periodicity,
                            'periodicity_type' => $plan->periodicity_type,
                            'grace_days' => $plan->grace_days,
                            'active' => (bool) $plan->active,
                        ];
                    })
                        ->sortBy(function ($option) {
                            return match (strtolower((string) $option['periodicity_type'])) {
                                'day' => 1,
                                'week' => 2,
                                'month' => 3,
                                'year' => 4,
                                default => 0,
                            };
                        })
                        ->values(),
                ];
            })
            ->sortBy(function ($plan) {
                return data_get($plan, 'options.0.price', 0);
            })
            ->values();

        $tenant = $request->user()?->tenant;
        $currentSubscription = null;

        if ($tenant) {
            $tenant->loadMissing('subscription.plan');

            $subscription = $tenant->subscription;

            if ($subscription) {
                $currentSubscription = [
                    'plan_id' => $subscription->plan_id,
                    'plan_slug' => optional($subscription->plan)->slug,
                    'plan_name' => optional($subscription->plan)->name,
                    'started_at' => optional($subscription->started_at)?->format('Y-m-d'),
                    'expired_at' => optional($subscription->expired_at)?->format('Y-m-d'),
                    'grace_days_ended_at' => optional($subscription->grace_days_ended_at)?->format('Y-m-d'),
                    'was_switched' => (bool) $subscription->was_switched,
                    'is_overdue' => (bool) $subscription->is_overdue,
                    'periodicity_type' => optional($subscription->plan)->periodicity_type,
                    'canceled_at' => optional($subscription->canceled_at)?->format('Y-m-d'),
                    'suppressed_at' => optional($subscription->suppressed_at)?->format('Y-m-d'),
                ];
            }
        }

        return response()->json([
            'data' => $plans,
            'current_subscription' => $currentSubscription,
        ]);
    }
}

