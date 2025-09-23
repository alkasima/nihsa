<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Display the general settings page.
     */
    public function general()
    {
        // In a real implementation, we would fetch settings from the database
        // $settings = Setting::where('group', 'general')->get()->keyBy('key');
        
        // For now, we'll create some dummy data
        $settings = [
            'site_title' => 'Nigeria Hydrological Services Agency',
            'site_description' => 'Official website of the Nigeria Hydrological Services Agency (NIHSA)',
            'contact_email' => 'info@nihsa.gov.ng',
            'contact_phone' => '+234 801 234 5678',
            'contact_address' => 'Plot 222, Foundation Plaza, Shettima Ali Monguno Crescent, Utako, Abuja, Nigeria',
            'social_facebook' => 'https://facebook.com/nihsa',
            'social_twitter' => 'https://twitter.com/nihsa',
            'social_instagram' => 'https://instagram.com/nihsa',
            'social_linkedin' => 'https://linkedin.com/company/nihsa',
            'social_youtube' => 'https://youtube.com/nihsa',
            'footer_text' => '© ' . date('Y') . ' Nigeria Hydrological Services Agency. All rights reserved.',
            'google_analytics_id' => 'UA-XXXXXXXXX-X',
            'maintenance_mode' => false,
            'maintenance_message' => 'We are currently performing maintenance. Please check back soon.',
        ];
        
        return view('admin.settings.general', compact('settings'));
    }

    /**
     * Update the general settings.
     */
    public function updateGeneral(Request $request)
    {
        $validated = $request->validate([
            'site_title' => 'required|string|max:255',
            'site_description' => 'required|string|max:500',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:255',
            'contact_address' => 'required|string|max:500',
            'social_facebook' => 'nullable|url|max:255',
            'social_twitter' => 'nullable|url|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'social_linkedin' => 'nullable|url|max:255',
            'social_youtube' => 'nullable|url|max:255',
            'footer_text' => 'required|string|max:255',
            'google_analytics_id' => 'nullable|string|max:255',
            'maintenance_mode' => 'boolean',
            'maintenance_message' => 'nullable|string|max:500',
        ]);

        // In a real implementation, we would update settings in the database
        // foreach ($validated as $key => $value) {
        //     Setting::updateOrCreate(
        //         ['key' => $key, 'group' => 'general'],
        //         ['value' => $value]
        //     );
        // }

        return redirect()->route('admin.settings.general')->with('success', 'General settings updated successfully.');
    }

    /**
     * Display the appearance settings page.
     */
    public function appearance()
    {
        // In a real implementation, we would fetch settings from the database
        // $settings = Setting::where('group', 'appearance')->get()->keyBy('key');
        
        // For now, we'll create some dummy data
        $settings = [
            'logo' => 'images/logo.png',
            'favicon' => 'images/favicon.ico',
            'primary_color' => '#0056b3',
            'secondary_color' => '#28a745',
            'accent_color' => '#17a2b8',
            'font_family' => 'Roboto, sans-serif',
            'enable_dark_mode' => false,
            'hero_image' => 'images/hero.jpg',
            'hero_title' => 'Nigeria Hydrological Services Agency',
            'hero_subtitle' => 'Providing hydrological services for sustainable water resources management',
        ];
        
        return view('admin.settings.appearance', compact('settings'));
    }

    /**
     * Update the appearance settings.
     */
    public function updateAppearance(Request $request)
    {
        $validated = $request->validate([
            'primary_color' => 'required|string|max:255',
            'secondary_color' => 'required|string|max:255',
            'accent_color' => 'required|string|max:255',
            'font_family' => 'required|string|max:255',
            'enable_dark_mode' => 'boolean',
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'required|string|max:500',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // In a real implementation, we would update settings in the database
        // foreach ($validated as $key => $value) {
        //     if ($request->hasFile($key)) {
        //         // Handle file upload
        //         $path = $request->file($key)->store('images');
        //         $value = $path;
        //     }
        //     
        //     Setting::updateOrCreate(
        //         ['key' => $key, 'group' => 'appearance'],
        //         ['value' => $value]
        //     );
        // }

        return redirect()->route('admin.settings.appearance')->with('success', 'Appearance settings updated successfully.');
    }

    /**
     * Display the email settings page.
     */
    public function email()
    {
        // In a real implementation, we would fetch settings from the database
        // $settings = Setting::where('group', 'email')->get()->keyBy('key');
        
        // For now, we'll create some dummy data
        $settings = [
            'mail_driver' => 'smtp',
            'mail_host' => 'smtp.mailtrap.io',
            'mail_port' => '2525',
            'mail_username' => 'username',
            'mail_password' => 'password',
            'mail_encryption' => 'tls',
            'mail_from_address' => 'info@nihsa.gov.ng',
            'mail_from_name' => 'Nigeria Hydrological Services Agency',
            'enable_email_notifications' => true,
        ];
        
        // Email templates
        $templates = [
            [
                'id' => 1,
                'name' => 'Welcome Email',
                'subject' => 'Welcome to NIHSA',
                'body' => 'Dear {name},<br><br>Welcome to the Nigeria Hydrological Services Agency (NIHSA) website. Thank you for registering with us.<br><br>Regards,<br>NIHSA Team',
                'variables' => ['name', 'email'],
            ],
            [
                'id' => 2,
                'name' => 'Password Reset',
                'subject' => 'Reset Your Password',
                'body' => 'Dear {name},<br><br>You have requested to reset your password. Please click the link below to reset your password:<br><br>{reset_link}<br><br>If you did not request a password reset, please ignore this email.<br><br>Regards,<br>NIHSA Team',
                'variables' => ['name', 'email', 'reset_link'],
            ],
            [
                'id' => 3,
                'name' => 'Data Request Confirmation',
                'subject' => 'Data Request Confirmation',
                'body' => 'Dear {name},<br><br>Thank you for your data request. Your request has been received and is being processed. Your request ID is {request_id}.<br><br>We will get back to you soon.<br><br>Regards,<br>NIHSA Team',
                'variables' => ['name', 'email', 'request_id', 'data_type'],
            ],
            [
                'id' => 4,
                'name' => 'Data Request Approved',
                'subject' => 'Data Request Approved',
                'body' => 'Dear {name},<br><br>Your data request (ID: {request_id}) has been approved. We will prepare the requested data and send it to you soon.<br><br>Regards,<br>NIHSA Team',
                'variables' => ['name', 'email', 'request_id', 'data_type', 'notes'],
            ],
            [
                'id' => 5,
                'name' => 'Data Request Rejected',
                'subject' => 'Data Request Rejected',
                'body' => 'Dear {name},<br><br>We regret to inform you that your data request (ID: {request_id}) has been rejected for the following reason:<br><br>{rejection_reason}<br><br>If you have any questions, please contact us.<br><br>Regards,<br>NIHSA Team',
                'variables' => ['name', 'email', 'request_id', 'data_type', 'rejection_reason'],
            ],
        ];
        
        return view('admin.settings.email', compact('settings', 'templates'));
    }

    /**
     * Update the email settings.
     */
    public function updateEmail(Request $request)
    {
        $validated = $request->validate([
            'mail_driver' => 'required|string|max:255',
            'mail_host' => 'required|string|max:255',
            'mail_port' => 'required|string|max:255',
            'mail_username' => 'required|string|max:255',
            'mail_password' => 'required|string|max:255',
            'mail_encryption' => 'required|string|max:255',
            'mail_from_address' => 'required|email|max:255',
            'mail_from_name' => 'required|string|max:255',
            'enable_email_notifications' => 'boolean',
        ]);

        // In a real implementation, we would update settings in the database
        // foreach ($validated as $key => $value) {
        //     Setting::updateOrCreate(
        //         ['key' => $key, 'group' => 'email'],
        //         ['value' => $value]
        //     );
        // }

        return redirect()->route('admin.settings.email')->with('success', 'Email settings updated successfully.');
    }

    /**
     * Display the email template edit page.
     */
    public function editEmailTemplate($id)
    {
        // In a real implementation, we would fetch the template from the database
        // $template = EmailTemplate::findOrFail($id);
        
        // For now, we'll create a dummy template
        $templates = [
            1 => [
                'id' => 1,
                'name' => 'Welcome Email',
                'subject' => 'Welcome to NIHSA',
                'body' => 'Dear {name},<br><br>Welcome to the Nigeria Hydrological Services Agency (NIHSA) website. Thank you for registering with us.<br><br>Regards,<br>NIHSA Team',
                'variables' => ['name', 'email'],
            ],
            2 => [
                'id' => 2,
                'name' => 'Password Reset',
                'subject' => 'Reset Your Password',
                'body' => 'Dear {name},<br><br>You have requested to reset your password. Please click the link below to reset your password:<br><br>{reset_link}<br><br>If you did not request a password reset, please ignore this email.<br><br>Regards,<br>NIHSA Team',
                'variables' => ['name', 'email', 'reset_link'],
            ],
            3 => [
                'id' => 3,
                'name' => 'Data Request Confirmation',
                'subject' => 'Data Request Confirmation',
                'body' => 'Dear {name},<br><br>Thank you for your data request. Your request has been received and is being processed. Your request ID is {request_id}.<br><br>We will get back to you soon.<br><br>Regards,<br>NIHSA Team',
                'variables' => ['name', 'email', 'request_id', 'data_type'],
            ],
            4 => [
                'id' => 4,
                'name' => 'Data Request Approved',
                'subject' => 'Data Request Approved',
                'body' => 'Dear {name},<br><br>Your data request (ID: {request_id}) has been approved. We will prepare the requested data and send it to you soon.<br><br>Regards,<br>NIHSA Team',
                'variables' => ['name', 'email', 'request_id', 'data_type', 'notes'],
            ],
            5 => [
                'id' => 5,
                'name' => 'Data Request Rejected',
                'subject' => 'Data Request Rejected',
                'body' => 'Dear {name},<br><br>We regret to inform you that your data request (ID: {request_id}) has been rejected for the following reason:<br><br>{rejection_reason}<br><br>If you have any questions, please contact us.<br><br>Regards,<br>NIHSA Team',
                'variables' => ['name', 'email', 'request_id', 'data_type', 'rejection_reason'],
            ],
        ];
        
        $template = $templates[$id] ?? abort(404);
        
        return view('admin.settings.email-template-edit', compact('template'));
    }

    /**
     * Update the email template.
     */
    public function updateEmailTemplate(Request $request, $id)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // In a real implementation, we would update the template in the database
        // $template = EmailTemplate::findOrFail($id);
        // $template->subject = $validated['subject'];
        // $template->body = $validated['body'];
        // $template->save();

        return redirect()->route('admin.settings.email')->with('success', 'Email template updated successfully.');
    }

    /**
     * Display the system settings page.
     */
    public function system()
    {
        // In a real implementation, we would fetch settings from the database
        // $settings = Setting::where('group', 'system')->get()->keyBy('key');
        
        // For now, we'll create some dummy data
        $settings = [
            'pagination_limit' => 10,
            'timezone' => 'Africa/Lagos',
            'date_format' => 'F j, Y',
            'time_format' => 'g:i A',
            'enable_registration' => true,
            'enable_captcha' => true,
            'enable_api' => false,
            'api_key' => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
            'log_level' => 'info',
            'backup_enabled' => true,
            'backup_frequency' => 'daily',
            'backup_retention' => 7,
        ];
        
        $timezones = [
            'Africa/Lagos' => 'Africa/Lagos',
            'Africa/Cairo' => 'Africa/Cairo',
            'Africa/Johannesburg' => 'Africa/Johannesburg',
            'Africa/Nairobi' => 'Africa/Nairobi',
            'America/New_York' => 'America/New_York',
            'America/Chicago' => 'America/Chicago',
            'America/Denver' => 'America/Denver',
            'America/Los_Angeles' => 'America/Los_Angeles',
            'Asia/Tokyo' => 'Asia/Tokyo',
            'Asia/Dubai' => 'Asia/Dubai',
            'Asia/Kolkata' => 'Asia/Kolkata',
            'Australia/Sydney' => 'Australia/Sydney',
            'Europe/London' => 'Europe/London',
            'Europe/Paris' => 'Europe/Paris',
            'Europe/Berlin' => 'Europe/Berlin',
            'UTC' => 'UTC',
        ];
        
        $dateFormats = [
            'F j, Y' => date('F j, Y'), // January 1, 2025
            'Y-m-d' => date('Y-m-d'),   // 2025-01-01
            'd/m/Y' => date('d/m/Y'),   // 01/01/2025
            'm/d/Y' => date('m/d/Y'),   // 01/01/2025
            'd.m.Y' => date('d.m.Y'),   // 01.01.2025
            'j F Y' => date('j F Y'),   // 1 January 2025
        ];
        
        $timeFormats = [
            'g:i A' => date('g:i A'),   // 12:00 AM
            'H:i' => date('H:i'),       // 00:00
            'g:i a' => date('g:i a'),   // 12:00 am
            'H:i:s' => date('H:i:s'),   // 00:00:00
        ];
        
        $logLevels = [
            'debug' => 'Debug',
            'info' => 'Info',
            'notice' => 'Notice',
            'warning' => 'Warning',
            'error' => 'Error',
            'critical' => 'Critical',
            'alert' => 'Alert',
            'emergency' => 'Emergency',
        ];
        
        $backupFrequencies = [
            'hourly' => 'Hourly',
            'daily' => 'Daily',
            'weekly' => 'Weekly',
            'monthly' => 'Monthly',
        ];
        
        return view('admin.settings.system', compact('settings', 'timezones', 'dateFormats', 'timeFormats', 'logLevels', 'backupFrequencies'));
    }

    /**
     * Update the system settings.
     */
    public function updateSystem(Request $request)
    {
        $validated = $request->validate([
            'pagination_limit' => 'required|integer|min:5|max:100',
            'timezone' => 'required|string|max:255',
            'date_format' => 'required|string|max:255',
            'time_format' => 'required|string|max:255',
            'enable_registration' => 'boolean',
            'enable_captcha' => 'boolean',
            'enable_api' => 'boolean',
            'log_level' => 'required|string|max:255',
            'backup_enabled' => 'boolean',
            'backup_frequency' => 'required|string|max:255',
            'backup_retention' => 'required|integer|min:1|max:365',
        ]);

        // In a real implementation, we would update settings in the database
        // foreach ($validated as $key => $value) {
        //     Setting::updateOrCreate(
        //         ['key' => $key, 'group' => 'system'],
        //         ['value' => $value]
        //     );
        // }

        // Generate new API key if requested
        if ($request->has('generate_api_key')) {
            // $apiKey = Str::random(32);
            // Setting::updateOrCreate(
            //     ['key' => 'api_key', 'group' => 'system'],
            //     ['value' => $apiKey]
            // );
        }

        return redirect()->route('admin.settings.system')->with('success', 'System settings updated successfully.');
    }
}
