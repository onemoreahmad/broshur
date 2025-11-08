<?php

namespace App\Api\Subscription;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\WithAttributes;

class SubscribeToPlan
{
    use AsAction;
    use WithAttributes;

    public function rules(): array
    {
        return [
            'plan_id' => [
                'required',
                'integer',
                Rule::exists('plans', 'id')->where(fn ($query) => $query->where('is_system', true)->where('active', true)),
            ],
            'immediate' => ['nullable', 'boolean'],
        ];
    }

    public function handle(Request $request)
    {
        $this->fill($request->all());

        $validated = $this->validateAttributes();

        /** @var \App\Models\User $user */
        $user = $request->user();
        $tenant = $user?->tenant;

        abort_if(is_null($tenant), 404, __('Tenant not found.'));

        $plan = Plan::where('id', $validated['plan_id'])
            ->where('is_system', true)
            ->where('active', true)
            ->firstOrFail();

        // $immediately = (bool) data_get($validated, 'immediate', true);

        $tenant->load('subscription.plan');

        if ($tenant->subscription && $tenant->subscription->plan_id === $plan->id) {
            return $this->response($tenant, __('أنت مشترك بالفعل في هذه الباقة.'));
        }

        if ($tenant->subscription) {
            $tenant->switchTo($plan, immediately: true);
        } else {
            $tenant->subscribeTo($plan);
        }

        $tenant->refresh();

        return $this->response($tenant, __('تم تحديث اشتراكك بنجاح.'));
    }

    protected function response($tenant, $message)
    {
        $tenant->loadMissing('subscription.plan');

        $subscription = $tenant->subscription;

        return response()->json([
            'message' => $message,
            'subscription' => [
                'plan_id' => $subscription?->plan_id,
                'plan_slug' => optional($subscription?->plan)->slug,
                'plan_name' => optional($subscription?->plan)->name,
                'started_at' => optional($subscription?->started_at)?->toDateTimeString(),
                'expired_at' => optional($subscription?->expired_at)?->toDateTimeString(),
                'grace_days_ended_at' => optional($subscription?->grace_days_ended_at)?->toDateTimeString(),
                'was_switched' => (bool) ($subscription?->was_switched),
                'is_overdue' => (bool) ($subscription?->is_overdue ?? false),
                'canceled_at' => optional($subscription?->canceled_at)?->toDateTimeString(),
                'suppressed_at' => optional($subscription?->suppressed_at)?->toDateTimeString(),
            ],
        ]);
    }
}

