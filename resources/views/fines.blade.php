@php
use Carbon\Carbon;
@endphp

<x-app-layout> <!-- Styling -->
    <x-slot name="header"> <!-- HEADER -->
        <h2 class="font-semibold text-xl text-gray-800 text-gray-200 leading-tight">
            {{ __('Fines') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#6B705C] overflow-hidden shadow-lg sm:rounded-lg mb-6">
                <div class="p-6 text-white">
                    {{ __("Your fines") }}
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach ($fines as $fine)
            <div class="bg-[#6B705C] overflow-hidden shadow-lg sm:rounded-lg transition-transform transform hover:scale-105 hover:shadow-2xl">
                <div class="p-6 text-white">
                    <p class="text-lg font-semibold">Name: {{$fine->loan->name}}</p>
                    <p>Book Title: {{$fine->loan->book->title}}</p>
                    <p>Amount: RM {{$fine->amount}}</p>
                    @php
                    $dueDate = Carbon::parse($fine->loan->due_date);
                    $currentDate = Carbon::now();
                    $daysPastDue = $currentDate->diffInDays($dueDate, false);
                    @endphp
                    <p>Days Past Due: {{ $daysPastDue > 0 ? $daysPastDue . ' days' : 'No days past due' }}</p>
                    <p>Paid: {{$fine->paid ? 'Yes' : 'No'}}</p>
                    <div class="bg-[#A5A58D] p-4 rounded-lg flex flex-col mt-4 space-y-2">
                        @if (!$fine->paid)
                        <form action="fines/{{$fine->id}}/pay" method="post">
                            @csrf
                            @method('PATCH')
                            <button class="bg-green-600 p-2 rounded-lg transition-colors hover:bg-green-500">Pay</button>
                        </form>
                        @else
                        <p class="bg-yellow-600 p-2 rounded-lg text-center">Paid</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>