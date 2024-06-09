@php
use Carbon\Carbon;
@endphp

<x-app-layout> <!-- Styling -->
    <x-slot name="header"> <!-- HEADER -->
        <h2 class="font-semibold text-xl text-gray-800 text-gray-200 leading-tight">
            {{ __('Loans') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#6B705C] overflow-hidden shadow-lg sm:rounded-lg mb-6">
                <div class="p-6 text-white">
                    {{ __("Your loans") }}
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach ($loans as $loan)
            <div class="bg-[#6B705C] overflow-hidden shadow-lg sm:rounded-lg transition-transform transform hover:scale-105 hover:shadow-2xl">
                <div class="p-6 text-white">
                    <p class="text-lg font-semibold">Name: {{$loan->name}}</p>
                    <p>Book Title: {{$loan->book->title}}</p>
                    <p>Username: {{$loan->user->name}}</p>
                    <p>Loan Date: {{ Carbon::parse($loan->loan_date)->format('j F Y') }}</p>
                    <p>Return Date: {{ Carbon::parse($loan->due_date)->format('j F Y') }}</p>
                    <div class="bg-[#A5A58D] p-4 rounded-lg flex flex-col mt-4 space-y-2">
                        <div class="flex items-center space-x-4">
                            <img class="h-[100px] w-[100px] object-cover rounded-md" src="{{$loan->book->picture}}" alt="Book Image">
                            <div class="text-white space-y-1">
                                <p>Author: {{$loan->book->author}}</p>
                                <p>Description: {{$loan->book->description}}</p>
                                <p>ISBN: {{$loan->book->ISBN}}</p>
                                <p>Amount Left: {{$loan->book->ammount}}</p>
                            </div>
                        </div>
                        @if ($loan->confirm_end == False)
                        <form action="complete_loan/{{$loan->id}}" method="post" class="mt-4">
                            @csrf
                            <button class="bg-green-600 p-2 rounded-lg transition-colors hover:bg-green-500">Complete Loan</button>
                        </form>
                        @else
                        <p class="bg-yellow-600 p-2 rounded-lg text-center">WAITING FOR CONFIRMATION</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>