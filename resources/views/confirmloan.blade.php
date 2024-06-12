@php
use Carbon\Carbon;
@endphp

<x-app-layout> <!-- Styling -->
    <h2 class="text-5xl font-semibold mt-12 mb-6 text-center text-[#6B705C]">Loan a Book !</h2>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#A5A58D] overflow-hidden shadow-lg sm:rounded-lg mb-6">
                <div class="p-6 text-white">
                    <div class="flex gap-3 items-center flex-col sm:flex-row ">
                        <img class="h-[200px] w-[200px] rounded-lg" src="{{$book->picture}}">
                        <h4 class="text-4xl font-bold mb-4">{{$book->title}}</h4>
                    </div>

                    <div class="flex flex-col gap-3 mt-2">
                        <div class="border-2 rounded-lg mt-1 p-3 border-[#CB997E] bg-[#DDBEA9]">
                            <p class="text-black">Author: {{$book->author}}</p>
                        </div>
                        <div class="border-2 rounded-lg mt-1 p-3 border-[#CB997E] bg-[#DDBEA9]">
                            <p class="text-black">Description: {{$book->description}}</p>
                        </div>
                        <div class="border-2 rounded-lg mt-1 p-3 border-[#CB997E] bg-[#DDBEA9]">
                            <p class="text-black">Book Number (ISBN): {{$book->ISBN}}</p>
                        </div>
                        <div class="border-2 rounded-lg mt-1 p-3 border-[#CB997E] bg-[#DDBEA9]">
                            <p class="text-black">Category: {{$book->category->name}}</p>
                        </div>
                        <div class="border-2 rounded-lg mt-1 p-3 border-[#CB997E] bg-[#DDBEA9]">
                            <p class="text-black">Language: {{$book->language->name}}</p>
                        </div>
                        <div class="border-2 rounded-lg mt-1 p-3 border-[#CB997E] bg-[#DDBEA9]">
                            <p class="text-black">Price: {{$book->price}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full flex justify-center ">
                @if (!is_null($loan))
                <div class="bg-[#A5A58D] overflow-hidden shadow-lg sm:rounded-lg mb-6 w-[80%] sm:w-full">
                    <div class="p-6 text-white">
                        <div class="flex flex-col gap-3">
                            <p>You already loan this book!</p>
                        </div>
                    </div>
                </div>
                @else
                <form method="POST" action="/makeloan?bookid={{$book->id}}" class="space-y-6 text-gray-900 w-[80%] sm:w-full">
                    @csrf
                    <div class="flex flex-col text-gray-800">
                        <label class="mb-2" for="name">Loaner Name</label>
                        <input class="p-2 rounded-lg" type="text" name="name" id="name" placeholder="Name" required>
                    </div>
                    <button class="bg-[#6B705C] text-white py-2 px-4 rounded-lg transition-colors hover:bg-[#A5A58D]">Confirm Loan & Pay</button>
                </form>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>