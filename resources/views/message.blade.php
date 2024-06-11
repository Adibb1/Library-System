<x-app-layout>
    <!-- Styling -->
    <x-slot name="header">
        <!-- HEADER -->
        <h2 class="font-semibold text-xl text-[#6B705C] leading-tight">
            {{ __('Messages') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#FFE8D6]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if ($messages->isEmpty())
            <div class="bg-[#A5A58D] overflow-hidden shadow-lg sm:rounded-lg flex items-center justify-between p-6 mb-4">
                <p class="text-white">All messages read</p>
            </div>
            @else
            @foreach ($messages as $message)
            @if ($message->read)
            <div class="bg-[#6B705C] overflow-hidden shadow-lg sm:rounded-lg flex items-center justify-between p-6 mb-4">
                <p class="text-white">{{ $message->text }}</p>
            </div>
            @else
            <div class="bg-[#3B3F2F] overflow-hidden shadow-lg sm:rounded-lg flex items-center justify-between p-6 mb-4 transition-transform transform hover:scale-105 hover:shadow-2xl cursor-pointer" onclick="readMessage('{{ $message->id }}')">
                <div>
                    <p class="text-white font-semibold">{{ $message->text }}</p>
                </div>
                <div class="text-sm text-gray-400">
                    <form id="read-{{ $message->id }}" action="/read_message/{{ $message->id }}" method="post">
                        @csrf
                    </form>
                </div>
            </div>
            @endif
            @endforeach
            @endif
        </div>
    </div>

    <script>
        function readMessage(id) {
            let form = document.getElementById('read-' + id);
            form.submit();
        }
    </script>
</x-app-layout>