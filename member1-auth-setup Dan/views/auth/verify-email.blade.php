@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900">Email Verification</h2>
            <p class="mt-2 text-sm text-gray-600">
                Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?
            </p>
        </div>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mt-4 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <p class="text-sm text-green-700">
                    A new verification link has been sent to the email address you provided during registration.
                </p>
            </div>
        </div>
    @endif

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Resend Verification Email
                </button>
            </form>

            <div class="mt-6">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
