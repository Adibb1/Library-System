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
                    <p>Username: {{$loan->user->name}}</p>
                    <p>Loan Date: {{$loan->loan_date}}</p>
                    <div class="bg-[#A5A58D] p-4 rounded-lg flex flex-col mt-4 space-y-2">
                        <div class="flex items-center space-x-4">
                            <img class="h-[100px] w-[100px] object-cover rounded-md" src="{{$loan->book->picture}}" alt="Book Image">
                            <div class="text-white space-y-1">
                                <p class="font-bold text-lg">Title: {{$loan->book->title}}</p>
                                <p>Author: {{$loan->book->author}}</p>
                                <p>Description: {{$loan->book->description}}</p>
                                <p>ISBN: {{$loan->book->ISBN}}</p>
                                <p>Language: {{$loan->book->language->name}}</p>
                                <p>Category: {{$loan->book->category->name}}</p>
                                <a class="py-1 px-2 rounded bg-[#6B705C] hover:no-underline hover:text-white/50 hover:bg-[#B7B7A4]" href="">Link to download PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>