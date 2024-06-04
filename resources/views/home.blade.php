<x-app-layout> <!--styling-->
    <x-slot name="header"> <!--HEADER-->
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">@foreach ($books as $book)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-wrap ">
                <div class="p-6 text-gray-900 dark:text-gray-100 ">
                    <h4>{{$book->title}}</h4>
                    <div class="flex flex-col gap-3">
                        <p class="bg-red-600 h-[100px] w-[100px]"><img class="h-[100px] w-[100px]" src="{{$book->picture}}"></p>
                        <p>author: {{$book->author}}</p>
                        <p>desc: {{$book->description}}</p>
                        <p>book num: {{$book->ISBN}}</p>
                        <p>ammount left: {{$book->ammount}}</p>
                        @if (auth()->check() && !auth()->user()->isAdmin)<!--check if admin or customer-->
                        <form method="get" action="/viewloan/{{$book->id}}">
                            @csrf
                            <button class="bg-green-600">loan</button>
                        </form>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>@endforeach
</x-app-layout>