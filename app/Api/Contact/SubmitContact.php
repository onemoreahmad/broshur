<?php

namespace App\Api\Contact;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class SubmitContact
{
    use AsAction;

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|min:1',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000|min:5',
        ];
    }

    public function handle(Request $request)
    {
        // Get tenant from config or try to find by domain/handle
        $tenant = currentTenant();
        
        // If tenant not in config, try to get from request
        if (!$tenant) {
            $host = $request->getHost();
            $domain = data_get(explode('.', $host), '1') . '.' . data_get(explode('.', $host), '2');
            $subdomain = $domain == config('app.domain') ? data_get(explode('.', $host), '0') : $host;
            
            $tenant = \App\Models\Tenant::where('handle', $subdomain)
                ->orWhere(function ($q) use ($host) {
                    $q->where('domain', $host)->where('domain_status', 1);
                })
                ->first();
        }
        
        $contactEmail = $tenant ? data_get($tenant, 'meta.contact_email', data_get($tenant, 'meta.email', 'info@broshur.com')) : 'info@broshur.com';
        
        $body = '
        <html dir="rtl">
            <div style="font-family: Tahoma, sans-serif; font-size: 15px; white-space: pre-line; background-color: #f4f4f4; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">        
                <div>الاسم: ' . htmlspecialchars($request->name) . '</div>
                <div>البريد الإلكتروني: ' . htmlspecialchars($request->email) . '</div>
                <div>الرسالة: <hr /> <div style="padding: 10px; white-space: pre-line;"> ' . nl2br(htmlspecialchars($request->message)) . '</div></div>
            </div>
        </html>
        ';
        
        try {
            \Mail::html($body, function ($message) use ($request, $tenant, $contactEmail) {
                $message->from('info@broshur.com', $request->name)
                        ->to($contactEmail)
                        ->replyTo($request->email, $request->name)
                        ->subject('رسالة من موقع ' . ($tenant ? $tenant->name : 'بروشور'));
            });
            
            return response()->json([
                'message' => 'شكراً لك، تم ارسال رسالتك بنجاح. سيتم التواصل معك قريباً جداً.',
                'success' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'حدث خطأ أثناء إرسال الرسالة. الرجاء المحاولة مرة أخرى.',
                'success' => false
            ], 500);
        }
    }
}

