<x-app-layout> <!--styling-->
    <x-slot name="header"> <!--HEADER-->
        <h2 class="font-semibold text-xl text-gray-800 text-gray-200 leading-tight">
            {{ __('Confirm Loan') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-wrap ">
                <div class="p-6 text-gray-900 text-gray-100 ">

                    <h4>{{$book->title}}</h4>
                    <div class="flex flex-col gap-3">
                        <p class="bg-red-600 h-[100px] w-[100px]"><img class="h-[100px] w-[100px]" src="{{$book->picture}}"></p>
                        <p>author: {{$book->author}}</p>
                        <p>desc: {{$book->description}}</p>
                        <p>book num: {{$book->ISBN}}</p>
                        <p>ammount left: {{$book->ammount}}</p>
                    </div>
                </div>
            </div>
            <form method="POST" action="/makeloan?bookid={{$book->id}}">
                @csrf
                <div class="flex flex-col w-1/2 text-gray-800 ">
                    <label class="text-white" for="name">Loaner Name</label>
                    <input type="text" name="name" id="name" placeholder="Name">
                </div>
                <div class="flex flex-col w-1/2 text-gray-800 ">
                    <label class="text-white" for="name">Loan Date (Today)</label>
                    <input type="text" name="date_loan_display" id="date_loan_display" disabled>
                    <input type="hidden" name="date_loan" id="date_loan">
                </div>
                <div class="flex flex-col w-1/2 text-gray-800">
                    <label class="text-white" for="name">Return Date (1 week)</label>
                    <input type="text" name="date_return_display" id="date_return_display" disabled>
                    <input type="hidden" name="date_return" id="date_return">
                </div>
                <button class="bg-green-500">Confirm Loan</button>
            </form>
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        //set every9ghuavhaubolknb
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