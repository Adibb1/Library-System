<x-app-layout>
    <!-- Styling -->
    <x-slot name="header">
        <!-- HEADER -->
        <h2 class="font-semibold text-xl text-gray-800 text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if ($URmessages->isEmpty())
            <div class="bg-[#A5A58D] overflow-hidden shadow-lg sm:rounded-lg flex items-center justify-between p-6 mb-4">
                <p class="text-white">All messages read</p>
            </div>
            @else
            @foreach ($URmessages as $URmessage)
            <div class="bg-[#3B3F2F] overflow-hidden shadow-lg sm:rounded-lg flex items-center justify-between p-6 mb-4 transition-transform transform hover:scale-105 hover:shadow-2xl cursor-pointer" onclick="readMessage('{{ $URmessage->id }}')">
                <div>
                    <p class="text-white font-semibold">{{ $URmessage->text }}</p>
                </div>
                <div class="text-sm text-gray-400">
                    <form id="read-{{ $URmessage->id }}" action="/read_message/{{ $URmessage->id }}" method="post">
                        @csrf
                    </form>
                </div>
            </div>
            @endforeach
            @endif

            @foreach ($Rmessages as $Rmessage)
            <div class="bg-[#6B705C] overflow-hidden shadow-lg sm:rounded-lg flex items-center justify-between p-6 mb-4">
                <p class="text-white">{{ $Rmessage->text }}</p>
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