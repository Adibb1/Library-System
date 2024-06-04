<x-app-layout> <!--styling-->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Amount</th>
                                <th>Paid</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fines as $fine)
                            <tr>
                                <td>RM {{ $fine->amount }}</td>
                                <td>{{ $fine->paid ? 'Yes' : 'No' }}</td>
                                <td>
                                    @if(!$fine->paid)
                                    <form action="fines/{{$fine->id}}/pay" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-primary">Pay</button>
                                    </form>
                                    @else
                                    <button class="btn btn-secondary" disabled>Paid</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>