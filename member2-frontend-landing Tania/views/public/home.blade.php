@extends('layouts.app')

@section('content')
<section class="max-w-7xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-10">
    <div>
        <h1 class="text-5xl font-bold">Secure File Transfer with EZE POST</h1>
        <p class="mt-6 text-slate-600">
            Register, subscribe, manage transfers, and download PDF receipts.
        </p>
        <a href="{{ route('pricing') }}" class="inline-block mt-8 bg-blue-700 text-white px-6 py-3 rounded-lg">
            View Pricing
        </a>
    </div>
</section>
@endsection
