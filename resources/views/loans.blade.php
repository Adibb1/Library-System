@php
use Carbon\Carbon;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#6B705C] leading-tight">
            {{ __('Loans') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#FFE8D6]" x-data="{ open: false, loanId: null }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach ($loans as $loan)
            <div class="bg-[#A5A58D] overflow-hidden shadow-lg sm:rounded-lg transition-transform transform hover:scale-105 hover:shadow-2xl">
                <div class="p-6 text-white">
                    <p class="text-lg font-semibold">Name: {{$loan->name}}</p>
                    <p>Username: {{$loan->user->name}}</p>
                    <p>Loan Date: {{ Carbon::parse($loan->loan_date)->format('M d, Y') }}</p>
                    <div class="bg-[#6B705C]/50 p-4 rounded-lg flex flex-col mt-4 space-y-4">
                        <div class="flex items-center space-x-4">
                            <img class="h-[100px] w-[100px] object-cover rounded-md" src="{{$loan->book->picture}}" alt="Book Image">
                            <div class="text-white space-y-2 flex justify-between w-full">
                                <div class="w-3/5">
                                    <p class="font-bold text-lg">Title: {{$loan->book->title}}</p>
                                    <p>Author: {{$loan->book->author}}</p>
                                    <p>Description: {{ Str::limit($loan->book->description, 100) }}</p>
                                    <p>ISBN: {{$loan->book->ISBN}}</p>
                                    <p>Language: {{$loan->book->language->name}}</p>
                                    <p>Category: {{$loan->book->category->name}}</p>
                                    <a class="py-1 px-2 mt-2 inline-block rounded bg-[#6B705C] hover:text-white/70 hover:bg-[#B7B7A4] transition duration-200" href="#">Link to download PDF</a>
                                </div>
                                <div class="w-2/5 p-4 rounded bg-[#6B705C]">
                                    @if (!is_null($loan->testimony))
                                    <h3 class="text-lg">Your Testimony:</h3>
                                    <form method="post" action="/edit_testimony/{{$loan->testimony->id}}">
                                        @csrf
                                        @method('PATCH')
                                        <textarea required name="text" class="rounded w-full bg-[#A5A58D] text-black focus:ring-0">{{$loan->testimony->text}}</textarea>
                                        <div class="mt-2 flex space-x-2">
                                            <button class="py-1 px-2 rounded bg-yellow-500 hover:text-white hover:bg-yellow-600 transition duration-200">Edit</button>
                                            <a href="/delete_testimony/{{$loan->testimony->id}}" class="py-1 px-2 rounded bg-red-500 hover:text-white hover:bg-red-600 transition duration-200">Delete</a>
                                        </div>
                                    </form>
                                    @else
                                    <button @click="open = true; loanId = {{$loan->id}}" class="py-1 px-2 rounded bg-[#CB997E] hover:text-white/70 hover:bg-[#B7B7A4] transition duration-200">Leave a Testimony</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Modal -->
        <div x-show="open" class="fixed inset-0 flex items-center justify-center z-50 transition-opacity">
            <div class="fixed inset-0 bg-black opacity-50" @click="open = false"></div>
            <div class="bg-[#6B705C] text-white rounded-lg p-6 mx-4 md:mx-0 max-w-lg w-full z-50 transform transition-all duration-300">
                <h2 class="text-xl font-semibold mb-4">Leave a Testimony</h2>
                <form method="POST" :action="'/testimony/' + loanId">
                    @csrf
                    <textarea name="text" class="w-full h-32 p-2 border rounded text-black" placeholder="Enter your testimony here..."></textarea>
                    <div class="flex justify-end mt-4 space-x-2">
                        <button type="button" @click="open = false" class="py-2 px-4 bg-gray-600 text-white rounded hover:bg-gray-700 transition duration-200">Cancel</button>
                        <button type="submit" class="py-2 px-4 bg-green-600 text-white rounded hover:bg-green-700 transition duration-200">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>