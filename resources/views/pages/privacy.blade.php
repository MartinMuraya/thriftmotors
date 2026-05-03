@extends('layouts.app')

@section('title', 'Privacy Policy - ThriftMotors')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 py-16 transition-colors duration-300">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 md:p-12 border border-transparent dark:border-gray-700">
            <h1 class="text-3xl font-bold dark:text-white mb-8 border-b dark:border-gray-700 pb-4">Privacy Policy</h1>
            
            <div class="prose prose-red dark:prose-invert max-w-none space-y-6 text-gray-600 dark:text-gray-400">
                <p>At ThriftMotors, we are committed to protecting your privacy and ensuring your personal information is handled in a safe and responsible manner.</p>

                <section>
                    <h2 class="text-xl font-bold dark:text-white text-gray-900">1. Information We Collect</h2>
                    <p>We collect information you provide directly to us, such as when you create an account, make a reservation, or contact our support team. This may include:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Name and contact information (email, phone number)</li>
                        <li>Payment information for reservation deposits</li>
                        <li>Profile details including your avatar image</li>
                        <li>Vehicle preferences and inquiry history</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold dark:text-white text-gray-900">2. How We Use Your Information</h2>
                    <p>We use the information we collect to:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Process your vehicle reservations and payments</li>
                        <li>Communicate with you about your inquiries</li>
                        <li>Improve our platform and customer service</li>
                        <li>Ensure the security of our transactions</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold dark:text-white text-gray-900">3. Data Security</h2>
                    <p>We implement a variety of security measures to maintain the safety of your personal information. Your sensitive data is encrypted via SSL technology and handled through secure payment gateways like M-Pesa.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold dark:text-white text-gray-900">4. Sharing of Information</h2>
                    <p>We do not sell, trade, or otherwise transfer your personally identifiable information to outside parties except for verified dealers or payment processors required to complete your transaction.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold dark:text-white text-gray-900">5. Your Rights</h2>
                    <p>You have the right to access, correct, or delete your personal information through your profile settings or by contacting our support team directly.</p>
                </section>

                <div class="pt-8 text-sm italic">
                    Last Updated: {{ date('F d, Y') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
