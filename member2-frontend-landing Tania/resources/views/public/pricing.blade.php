@extends('layouts.app')

@section('content')
<section class="max-w-7xl mx-auto px-6 py-16">
    <h1 class="text-4xl font-bold text-center">Pricing Plans</h1>
    <div class="grid md:grid-cols-3 gap-6 mt-12">
        @foreach($plans as $plan)
            <div class="bg-white rounded-2xl shadow p-6">
                <h2 class="text-2xl font-bold">{{ $plan->name }}</h2>
                <p class="mt-2">Currency: {{ $plan->currency }}</p>
                <p>Package Code: {{ $plan->package_size_code }}</p>
                <a href="{{ route('register.individual', ['plan' => $plan->id]) }}"
                   class="block text-center mt-6 bg-blue-700 text-white py-3 rounded-lg">
                    Subscribe
                </a>
            </div>
        @endforeach
    </div>
</section>
@endsection
