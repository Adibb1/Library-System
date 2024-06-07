<x-app-layout> <!--styling-->
    <x-slot name="header"> <!--HEADER-->
        <h2 class="font-semibold text-xl text-gray-800 text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-gray-100">
                    {{ __("Your loans") }}
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($loans as $loan)
            <div class="bg-gray-100 bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-gray-100">
                    <p>name: {{$loan->name}}</p>
                    <p>book id: {{$loan->book_id}}</p>
                    <p>user id: {{$loan->user_id}}</p>
                    <p>loan date: {{$loan->loan_date}}</p>
                    <p>return date: {{$loan->due_date}}</p>
                    <div class="bg-gray-700 flex flex-col">
                        <p class="bg-red-600 h-[100px] w-[100px]"><img class="h-[100px] w-[100px]" src="{{$loan->book->picture}}"></p>
                        <p>author: {{$loan->book->author}}</p>
                        <p>desc: {{$loan->book->description}}</p>
                        <p>book num: {{$loan->book->ISBN}}</p>
                        <p>ammount left: {{$loan->book->ammount}}</p>
                        @if ($loan->confirm_end == False)
                        <form action="complete_loan/{{$loan->id}}" method="post">
                            @csrf
                            <button class="bg-green-600">complete loan</button>
                        </form>
                        @else
                        <p class="bg-yellow-600">WAITING FOR COFRIMATION</p>
                        @endif
                    </div>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>