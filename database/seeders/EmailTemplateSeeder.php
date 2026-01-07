<?php

namespace Database\Seeders;

use App\Models\EmailTemplate;
use Illuminate\Database\Seeder;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            [
                'name' => 'Welcome Email',
                'subject' => 'Welcome to Rhema Deliverance Mission International',
                'body' => "Dear {name},\n\nWelcome to Rhema Deliverance Mission International!\n\nWe are delighted to have you join our community. Prophet Ejike Nwachukwu and the entire ministry team are here to support you in your spiritual journey.\n\nMay the power of the Holy Spirit guide and bless you.\n\nBlessings,\nRhema Deliverance Mission International\n(The Power Line of the Holy Spirit)",
                'type' => 'welcome',
                'is_active' => true,
            ],
            [
                'name' => 'Password Reset',
                'subject' => 'Password Reset - Rhema Deliverance Mission',
                'body' => "Dear {name},\n\nYour password has been reset. Your new password is: {password}\n\nPlease log in and change your password to something more secure.\n\nIf you did not request this password reset, please contact us immediately.\n\nBlessings,\nRhema Deliverance Mission International",
                'type' => 'password_reset',
                'is_active' => true,
            ],
            [
                'name' => 'Prayer Request Response',
                'subject' => 'Response to Your Prayer Request',
                'body' => "Dear {name},\n\nThank you for submitting your prayer request. Prophet Ejike Nwachukwu has received your request and will be praying for you.\n\nYour prayer request: {request}\n\nWe believe that God will answer your prayers according to His will. Continue to trust in the Lord and have faith.\n\nYou can track your prayer requests and responses through your dashboard.\n\nMay the Lord bless you abundantly.\n\nBlessings,\nRhema Deliverance Mission International\n(The Power Line of the Holy Spirit)",
                'type' => 'notification',
                'is_active' => true,
            ],
            [
                'name' => 'Newsletter',
                'subject' => 'Monthly Newsletter - Rhema Deliverance Mission',
                'body' => "Dear {name},\n\nGreetings in the name of our Lord Jesus Christ!\n\nWe hope this message finds you well and blessed. This is our monthly newsletter from Rhema Deliverance Mission International.\n\nStay connected with us through our various platforms:\n- YouTube\n- Facebook\n- TikTok\n- Instagram\n\nContinue to join us for powerful messages, testimonies, and prayers.\n\nMay the power of the Holy Spirit continue to work in your life.\n\nBlessings,\nProphet Ejike Nwachukwu\nRhema Deliverance Mission International",
                'type' => 'newsletter',
                'is_active' => true,
            ],
            [
                'name' => 'General Notification',
                'subject' => 'Important Update from Rhema Deliverance Mission',
                'body' => "Dear {name},\n\nWe hope this message finds you well.\n\n{message}\n\nThank you for being part of our ministry. May the Lord continue to bless you.\n\nBlessings,\nRhema Deliverance Mission International\n(The Power Line of the Holy Spirit)",
                'type' => 'general',
                'is_active' => true,
            ],
        ];

        foreach ($templates as $template) {
            EmailTemplate::updateOrCreate(
                ['name' => $template['name']],
                $template
            );
        }
    }
}
