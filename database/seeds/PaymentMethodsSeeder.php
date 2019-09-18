<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->insert([
            'name' => 'PayPal Express Checkout',
            'code' => 'paypal-express',
            'type' => 1,
            'company_name' => 'PayPal Inc.',
            'website' => 'https://www.paypal.com/',
            'help_doc_link' => 'https://www.paypal.com/us/webapps/mpp/express-checkout',
            'description' => 'Add PayPal as a payment method to allow customers to checkout with PayPal. Express Checkout offers the ease of convenience and security of PayPal, can turn more shoppers into buyers. You must have a PayPal business account to activate this payment method. - You must have a PayPal business account.<br/><strong>To activate PayPal Express: </strong><br/>- You must have a PayPal business account to accept payments.<br/>- Create an app to receive API credentials for testing and live transactions.<br/>- Go to this link to create your app: <small>https://developer.paypal.com/webapps/developer/applications/myapps</small>',
            'admin_description' => 'Add PayPal as a payment method to any checkout with Express Checkout. Express Checkout offers the ease of convenience and security of PayPal, can be set up in minutes and can turn more shoppers into buyers.',
            'admin_help_doc_link' => 'https://developer.paypal.com/docs/integration/direct/express-checkout/integration-jsv4/',
            'order' => 1,
            'created_at' => Carbon::Now(),
            'updated_at' => Carbon::Now(),
        ]);
        DB::table('payment_methods')->insert([
            'name' => 'Stripe',
            'code' => 'stripe',
            'type' => 2,
            'company_name' => 'Stripe Inc.',
            'website' => 'https://stripe.com/',
            'help_doc_link' => 'https://stripe.com/docs/checkout/tutorial',
            'description' => 'Stripe is one of the best and safe option to charge credit and debit cards around the world. Stripe has a simple fee structure and no hidden costs. No other gateway or merchant account is required. <br/><strong>By using Stripe: </strong><br/>- You have to connect our platform to your Stripe account. <br/>- You agree to Stripe\'s <a href="https://stripe.com/us/privacy" target="_blank">Terms of Service</a>.',
            'admin_description' => 'Stripe is one of the best and safe option to charge credit and debit cards around the world. Stripe has a product for marketplace like this. To enable Stripe to your vendors, you must have to register your platform with Stripe.<br/><strong> Follow This Simple steps:</strong><br/>- Create an Stripe application using the bellow information. <a href="https://stripe.com/docs/connect/quickstart" target="_blank">Check their documentation for help.</a><br/>- Update the .env file on your server with Stripe API credentials.<br/><br/><strong>Remember </strong> when you register your platform use this information: <br/>- Name: \'' . get_platform_title() . '\'<br/>- Website URL: \'' . route('homepage') . '\'<br/>- Redirect URL: \'' . route('admin.setting.stripe.redirect') .'\'',
            'admin_help_doc_link' => 'https://stripe.com/docs/connect/quickstart',
            'order' => 2,
            'created_at' => Carbon::Now(),
            'updated_at' => Carbon::Now(),
        ]);
        DB::table('payment_methods')->insert([
            'name' => 'Authorize.Net',
            'code' => 'authorize-net',
            'type' => 2,
            'company_name' => 'Authorize.Net',
            'website' => 'https://www.authorize.net/',
            'help_doc_link' => 'https://www.authorize.net/support/',
            'description' => 'More solutions for your business. More support when you need it. More strength to stand on. <br/><strong>By using Authorize.Net: </strong><br/>- You have to have an Authorize.Net account. <br/>- You agree to Authorize.Net\'s <a href="https://www.authorize.net/about-us/terms/" target="_blank">Terms of Use</a>.',
            'admin_description' => 'Authorize.Net helps makes it simple to accept electronic and credit card payments.',
            'admin_help_doc_link' => 'https://www.authorize.net/about-us/',
            'order' => 3,
            'created_at' => Carbon::Now(),
            'updated_at' => Carbon::Now(),
        ]);
        DB::table('payment_methods')->insert([
            'name' => 'Instamojo',
            'code' => 'instamojo',
            'type' => 2,
            'company_name' => 'Instamojo Technologies Pvt. Ltd.',
            'website' => 'https://instamojo.com/',
            'help_doc_link' => 'https://instamojo.com/docs/checkout/tutorial',
            'description' => 'Instamojo is one of the most popular and Multi-Channel Payment Gateway for India - Accept Credit/Debit Cards, Wallets, Net Banking, UPI & EMI. <br/><strong>By using Instamojo: </strong><br/>- You have to have your Instamojo business account. <br/>- You agree to Instamojo\'s <a href="https://www.instamojo.com/terms/" target="_blank">Terms of Service</a>.',
            'admin_description' => 'Instamojo is one of the most popular and Multi-Channel Payment Gateway for India - Accept Credit/Debit Cards, Wallets, Net Banking, UPI & EMI. Enable Instamojo to your vendors.',
            'admin_help_doc_link' => 'https://www.instamojo.com/',
            'order' => 2,
            'created_at' => Carbon::Now(),
            'updated_at' => Carbon::Now(),
        ]);
        DB::table('payment_methods')->insert([
            'name' => 'Paystack',
            'code' => 'paystack',
            'type' => 4,
            'company_name' => 'Paystack',
            'website' => 'https://paystack.com/',
            'help_doc_link' => 'https://paystack.helpscoutdocs.com/',
            'description' => 'Modern online and offline payments for Africa. Paystack helps businesses in Africa get paid by anyone, anywhere in the world. <br/><strong>By using Paystack: </strong><br/>- You agree to Paystack\'s <a href="https://paystack.com/terms" target="_blank">Terms of Service</a>.',
            'admin_description' => 'Modern online and offline payments for Africa. Paystack helps businesses in Africa get paid by anyone, anywhere in the world.',
            'admin_help_doc_link' => 'https://paystack.helpscoutdocs.com/',
            'order' => 4,
            'created_at' => Carbon::Now(),
            'updated_at' => Carbon::Now(),
        ]);
        DB::table('payment_methods')->insert([
            'name' => 'Cash On Delivery',
            'code' => 'cod',
            'type' => 3,
            'company_name' => 'Cash on Delivery',
            'description' => 'Cash on delivery (COD), sometimes called collect on delivery, is the sale of goods by mail order where payment is made on delivery rather than in advance.',
            'admin_description' => 'Cash on delivery (COD), sometimes called collect on delivery, is the sale of goods by mail order where payment is made on delivery rather than in advance.',
            'admin_help_doc_link' => '',
            'order' => 5,
            'created_at' => Carbon::Now(),
            'updated_at' => Carbon::Now(),
        ]);
        DB::table('payment_methods')->insert([
            'name' => 'Bank Wire Transfer',
            'code' => 'wire',
            'type' => 3,
            'company_name' => 'Pay by bank wire transfer',
            'description' => 'Pay by bank wire transfer,  transfer the invoice amount via wire tranfer to the merchant account and confirm manually. After payment confirmation the goods will be shipped.',
            'admin_description' => 'Pay by bank wire transfer,  transfer the invoice amount via wire tranfer to the merchant account and confirm manually. After payment confirmation the goods will be shipped.',
            'admin_help_doc_link' => '',
            'order' => 6,
            'created_at' => Carbon::Now(),
            'updated_at' => Carbon::Now(),
        ]);
    }
}
