<x-app-layout>
    <!-- Styling -->
    <x-slot name="header">
        <!-- HEADER -->
        <h2 class="font-semibold text-xl text-gray-800 text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            Unread Message :
            @if ($URmessages->isEmpty())
            <div class="bg-gray-100 bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-wrap mb-2">
                <div class="p-6 text-gray-900 text-gray-100 cursor-not-allowed">
                    <p>All message read</p>
                </div>
            </div>
            @else
            @foreach ($URmessages as $URmessage)
            <div class="bg-gray-100 bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-wrap">
                <div class="p-6 text-gray-900 text-gray-100 cursor-pointer" onclick="readMessage('{{$URmessage->id}}')">
                    <p>{{ $URmessage->text }}</p>
                    <form id="read-{{ $URmessage->id }}" action="/read_message/{{$URmessage->id}}" method="post">
                        @csrf
                    </form>
                </div>
            </div>
            @endforeach
            @endif


            <br>
            Read Message :
            @foreach ($Rmessages as $Rmessage)
            <div class="bg-gray-100 bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-wrap mb-2">
                <div class="p-6 text-gray-900 text-gray-100">
                    <p>{{ $Rmessage->text }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script>
        function readMessage(id) {
            let form = document.getElementById('read-' + id);
            form.submit();
        }
    </script>
</x-app-layout>