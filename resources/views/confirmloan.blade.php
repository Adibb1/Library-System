@php
use Carbon\Carbon;
@endphp

<x-app-layout> <!-- Styling -->
    <x-slot name="header"> <!-- HEADER -->
        <h2 class="font-semibold text-xl text-gray-800 text-gray-200 leading-tight">
            {{ __('Confirm Loan') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#6B705C] overflow-hidden shadow-lg sm:rounded-lg mb-6">
                <div class="p-6 text-white">
                    <h4 class="text-2xl font-bold mb-4">{{$book->title}}</h4>
                    <div class="flex flex-col gap-3">
                        <img class="bg-red-600 h-[100px] w-[100px] rounded-lg" src="{{$book->picture}}">
                        <p><span class="font-semibold">Author:</span> {{$book->author}}</p>
                        <p><span class="font-semibold">Description:</span> {{$book->description}}</p>
                        <p><span class="font-semibold">Book Number (ISBN):</span> {{$book->ISBN}}</p>
                        <p><span class="font-semibold">Category:</span>{{$book->category->name}}</p>
                        <p><span class="font-semibold">Language:</span>{{$book->language->name}}</p>
                        <p><span class="font-semibold">Price:</span> RM {{$book->price}}</p>
                    </div>
                </div>
            </div>
            @if (!is_null($loan))
            <div class="bg-[#A5A58D] overflow-hidden shadow-lg sm:rounded-lg mb-6">
                <div class="p-6 text-white">
                    <div class="flex flex-col gap-3">
                        <p>You already loan this book!</p>
                    </div>
                </div>
            </div>
            @else
            <form method="POST" action="/makeloan?bookid={{$book->id}}" class="space-y-6 text-gray-900">
                @csrf
                <div class="flex flex-col text-gray-800">
                    <label class="mb-2" for="name">Loaner Name</label>
                    <input class="p-2 rounded-lg" type="text" name="name" id="name" placeholder="Name" required>
                </div>
                <button class="bg-green-600 text-white py-2 px-4 rounded-lg transition-colors hover:bg-green-500">Confirm Loan & Pay</button>
            </form>
            @endif
        </div>
    </div>
</x-app-layout>