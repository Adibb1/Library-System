@php
use Carbon\Carbon;
@endphp

<x-app-layout>
    <h2 class="text-5xl font-semibold mt-12 mb-6 text-center text-[#6B705C]">Your Books</h2>
    <div class="py-12 bg-[#FFE8D6]" x-data="{ open: false, loanId: null }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-wrap gap-5">
            @foreach ($loans as $loan)
            <div class="w-full bg-[#A5A58D] overflow-hidden shadow-[0_35px_60px_-15px_rgba(0,0,0,0.3)] sm:rounded-lg transition-transform transform hover:scale-105 shadow-[25px_35px_60px_-15px_rgba(0,0,0,0.3)]">
                <div class="p-6 text-white">
                    <p class="text-lg font-semibold">Name: {{$loan->name}}</p>
                    <p>Loan Date: {{ Carbon::parse($loan->loan_date)->format('M d, Y') }}</p>
                    <div class="bg-[#DDBEA9] p-4 rounded-lg flex flex-col mt-4 space-y-4">
                        <div class="flex flex-col sm:flex-row items-center gap-2">
                            <div class="text-black space-y-2 flex flex-col sm:flex-row gap-5 w-full flex items-center">
                                <img class="h-[200px] w-[200px] object-cover rounded-md" src="{{$loan->book->picture}}" alt="Book Image">
                                <div class="w-full sm:w-3/5 flex flex-col">
                                    <p class="font-bold text-lg">Title: {{$loan->book->title}}</p>
                                    <div class="border-2 rounded-lg mt-2 p-2 border-[#CB997E] bg-[#FFE8D6]">
                                        <p class=" text-[#3E3E3E]">Author: {{$loan->book->author}}</p>
                                    </div>
                                    <div class="border-2 rounded-lg mt-2 p-2 border-[#CB997E] bg-[#FFE8D6]">
                                        <p class=" text-[#3E3E3E]">Description: {{ Str::limit($loan->book->description, 100) }}</p>
                                    </div>
                                    <div class="border-2 rounded-lg mt-2 p-2 border-[#CB997E] bg-[#FFE8D6]">
                                        <p class=" text-[#3E3E3E]">ISBN: {{$loan->book->ISBN}}</p>
                                    </div>
                                    <div class="border-2 rounded-lg mt-2 p-2 border-[#CB997E] bg-[#FFE8D6]">
                                        <p class=" text-[#3E3E3E]">Language: {{$loan->book->language->name}}</p>
                                    </div>
                                    <div class="border-2 rounded-lg mt-2 p-2 border-[#CB997E] bg-[#FFE8D6]">
                                        <p class=" text-[#3E3E3E]">Category: {{$loan->book->category->name}}</p>
                                    </div>
                                    <a class="text-white text-center py-1 px-2 mt-2 inline-block rounded bg-[#6B705C] hover:text-white/70 hover:bg-[#B7B7A4] transition duration-200" href="#">Link to download PDF</a>
                                </div>
                            </div>
                            <div class="w-full sm:w-2/5 min-h-[100px] rounded bg-[#CB997E]/50 mt-3 sm:mt-0 flex flex-col items-center p-2">
                                @if (!is_null($loan->testimony))
                                <h3 class="text-lg">Your Testimony:</h3>
                                <form method="post" action="/edit_testimony/{{$loan->testimony->id}}">
                                    @csrf
                                    @method('PATCH')
                                    <textarea required name="text" class="text-black focus:border-0 min-h-[100px] border-2 rounded-lg mt-2 p-2 border-[#CB997E] bg-[#FFE8D6]">{{$loan->testimony->text}}</textarea>
                                    <div class="mt-2 flex space-x-2">
                                        <button class="py-1 px-2 rounded bg-yellow-500 hover:bg-yellow-500/50 transition duration-200">Edit</button>
                                        <a href="/delete_testimony/{{$loan->testimony->id}}" class="py-1 px-2 rounded bg-red-500 hover:bg-red-500/50 hover:no-underline hover:text-black transition duration-200">Delete</a>
                                    </div>
                                </form>
                                @else
                                <button @click="open = true; loanId = {{$loan->id}}" class="py-1 px-2 rounded bg-[#DDBEA9] hover:bg-[#FFE8D6] transition duration-200 text-black ">Leave a Testimony</button>
                                @endif
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
            <div class="bg-[#CB997E] text-white rounded-lg p-6 mx-4 md:mx-0 max-w-lg w-full z-50 transform transition-all duration-300">
                <h2 class="text-xl font-semibold mb-4">Leave a Testimony</h2>
                <form method="POST" :action="'/testimony/' + loanId">
                    @csrf
                    <textarea name="text" class="w-full h-32 p-2 border rounded text-black focus:border-0 rounded-lg mt-2 border-[#CB997E] bg-[#FFE8D6]" placeholder="Enter your testimony here..."></textarea>
                    <div class="flex justify-end mt-4 space-x-2">
                        <button type="button" @click="open = false" class="py-2 px-4 bg-gray-600 text-white rounded hover:bg-gray-700 transition duration-200">Cancel</button>
                        <button type="submit" class="py-2 px-4 bg-green-600 text-white rounded hover:bg-green-700 transition duration-200">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>