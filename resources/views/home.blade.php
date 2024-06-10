<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <form method="GET" action="{{ route('books.index') }}" class="flex flex-wrap gap-4 text-black">
                    <input type="text" name="title" placeholder="Title" class="border-gray-300 rounded-md shadow-sm focus:border-[#A5A58D] focus:ring-0">
                    <input type="text" name="author" placeholder="Author" class="border-gray-300 rounded-md shadow-sm focus:border-[#A5A58D] focus:ring-0">
                    <input type="text" name="ISBN" placeholder="ISBN" class="border-gray-300 rounded-md shadow-sm focus:border-[#A5A58D] focus:ring-0">
                    <input type="text" name="category" placeholder="Category" class="border-gray-300 rounded-md shadow-sm focus:border-[#A5A58D] focus:ring-0">
                    <input type="text" name="language" placeholder="Language" class="border-gray-300 rounded-md shadow-sm focus:border-[#A5A58D] focus:ring-0">
                    <button type="submit" class="text-black bg-[#A5A58D] rounded py-2 px-3 hover:no-underline hover:text-black/70 hover:bg-[#B7B7A4]">Search</button>
                </form>
            </div>
            <a class="text-black bg-[#A5A58D] rounded py-2 px-2 hover:no-underline hover:text-black/70 hover:bg-[#B7B7A4]" href="/home">Clear filters</a>

            <div class="flex flex-wrap justify-center gap-6">
                @foreach ($books as $book)
                <div class="bg-[#6B705C] lg:w-[30%] md:w-[40%] w-[90%] h-[100%] rounded-xl flex flex-col justify-center items-center overflow-hidden shadow-sm p-6 text-white relative transition-all duration-500 cursor-pointer" onclick="toggleCardDetails(this)">
                    <div class="card-summary">
                        <img class="h-[100px] w-[100px] object-cover mb-4" src="{{$book->picture}}" alt="{{$book->title}}">
                        <h4 class="font-semibold mb-2">{{$book->title}}</h4>
                        <p class="text-sm text-gray-300">{{$book->author}}</p>
                    </div>
                    <div class="w-full card-details mt-4 overflow-hidden transition-all duration-500 hidden flex flex-col">
                        <div class="border-2 rounded-lg mt-2 p-3 border-[#DDBEA9]">
                            <p class="font-semibold">Description:</p>
                            <p class="mt-2">{{$book->description}}</p>
                        </div>
                        <div class="border-2 rounded-lg mt-2 p-3 border-[#DDBEA9]">
                            <p class="font-semibold">ISBN:</p>
                            <p class="mt-2">{{$book->ISBN}}</p>
                        </div>
                        <div class="border-2 rounded-lg mt-2 p-3 border-[#DDBEA9]">
                            <p class="font-semibold">Price:</p>
                            <p class="mt-2">{{$book->price}}</p>
                        </div>
                        <div class="border-2 rounded-lg mt-2 p-3 border-[#DDBEA9]">
                            <p class="font-semibold">Language:</p>
                            <p class="mt-2">{{$book->language->name}}</p>
                        </div>
                        <div class="border-2 rounded-lg mt-2 p-3 border-[#DDBEA9]">
                            <p class="font-semibold">Category:</p>
                            <p class="mt-2">{{$book->category->name}}</p>
                        </div>

                        @if (auth()->check() && !auth()->user()->isAdmin)
                        <form method="get" action="/viewloan/{{$book->id}}">
                            @csrf
                            <button class="mt-4 bg-green-600 px-4 py-2 rounded hover:bg-green-500 transition-colors">View More Detail</button>
                        </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    let openCard = null;

    function toggleCardDetails(element) {
        const details = element.querySelector('.card-details');

        if (openCard === details) {
            details.classList.add('hidden');
            openCard = null;
        } else {
            if (openCard !== null) {
                openCard.classList.add('hidden');
            }
            details.classList.remove('hidden');
            openCard = details;
        }
    }
</script>