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
                        <p><span class="font-semibold">Amount Left:</span> {{$book->ammount}}</p>
                    </div>
                </div>
            </div>
            <form method="POST" action="/makeloan?bookid={{$book->id}}" class="space-y-6 text-gray-900">
                @csrf
                <div class="flex flex-col text-gray-800">
                    <label class="mb-2" for="name">Loaner Name</label>
                    <input class="p-2 rounded-lg" type="text" name="name" id="name" placeholder="Name">
                </div>
                <div class="flex flex-col text-gray-800">
                    <label class="mb-2" for="date_loan_display">Loan Date (Today)</label>
                    <input class="p-2 rounded-lg" type="text" name="date_loan_display" id="date_loan_display" disabled>
                    <input type="hidden" name="date_loan" id="date_loan">
                </div>
                <div class="flex flex-col text-gray-800">
                    <label class="mb-2" for="date_return_display">Return Date (1 week)</label>
                    <input class="p-2 rounded-lg" type="text" name="date_return_display" id="date_return_display" disabled>
                    <input type="hidden" name="date_return" id="date_return">
                </div>
                <button class="bg-green-600 text-white py-2 px-4 rounded-lg transition-colors hover:bg-green-500">Confirm Loan</button>
            </form>
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dateLoan = document.getElementById('date_loan');
        var dateLoanDisplay = document.getElementById('date_loan_display');
        var dateReturn = document.getElementById('date_return');
        var dateReturnDisplay = document.getElementById('date_return_display');

        var today = new Date();
        var day = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0'); // January is 0
        var year = today.getFullYear();
        var currentDate = day + '/' + month + '/' + year;

        // Set dateLoan values
        dateLoanDisplay.value = currentDate;
        dateLoan.value = year + '-' + month + '-' + day;

        // Calculate 7 days ahead
        var futureDate = new Date();
        futureDate.setDate(today.getDate() + 7);
        var futureDay = String(futureDate.getDate()).padStart(2, '0');
        var futureMonth = String(futureDate.getMonth() + 1).padStart(2, '0'); // January is 0
        var futureYear = futureDate.getFullYear();
        var futureDateString = futureDay + '/' + futureMonth + '/' + futureYear;

        // Set dateReturn values
        dateReturnDisplay.value = futureDateString;
        dateReturn.value = futureYear + '-' + futureMonth + '-' + futureDay;
    });
</script>