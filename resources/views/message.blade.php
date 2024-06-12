<x-app-layout>
    <h2 class="text-5xl font-semibold mt-12 mb-6 text-center text-[#6B705C]">Message from Admins</h2>
    <div class="py-12 bg-[#FFE8D6]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if ($messages->isEmpty())
            <div class="bg-[#A5A58D] overflow-hidden shadow-lg sm:rounded-lg flex items-center justify-between p-6 mb-4">
                <p class="text-white">No message to read</p>
            </div>
            @else
            @foreach ($messages as $message)
            <div class="w-full flex justify-center">
                @if ($message->read)
                <div class="w-[90%] sm:w-full bg-[#6B705C] overflow-hidden shadow-lg rounded-lg flex items-center justify-between p-6">
                    <p class="text-white">{{ $message->text }}</p>
                </div>
                @else
                <div class="w-full bg-[#3B3F2F] overflow-hidden shadow-lg sm:rounded-lg flex items-center justify-between p-6 transition-transform transform hover:scale-105 hover:shadow-2xl cursor-pointer" onclick="readMessage('{{ $message->id }}')">
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
            </div>
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