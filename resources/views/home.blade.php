<x-app-layout>
    <h2 class="text-5xl font-semibold mt-12 mb-1 text-center text-[#6B705C]">Library</h2>
    <div class="pb-12 pt-8 bg-[#FFE8D6]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <form method="GET" action="{{ route('books.index') }}" class="flex flex-col md:flex-row mx-5 flex-wrap gap-4 text-[#6B705C]">
                    <input type="text" name="title" placeholder="Title" class="border-gray-300 rounded-md shadow-sm focus:border-[#A5A58D] focus:ring-0">
                    <input type="text" name="author" placeholder="Author" class="border-gray-300 rounded-md shadow-sm focus:border-[#A5A58D] focus:ring-0">
                    <input type="text" name="ISBN" placeholder="ISBN" class="border-gray-300 rounded-md shadow-sm focus:border-[#A5A58D] focus:ring-0">
                    <input type="text" name="category" placeholder="Category" class="border-gray-300 rounded-md shadow-sm focus:border-[#A5A58D] focus:ring-0">
                    <input type="text" name="language" placeholder="Language" class="border-gray-300 rounded-md shadow-sm focus:border-[#A5A58D] focus:ring-0">
                    <button type="submit" class="text-white bg-[#6B705C] rounded py-2 px-3 hover:no-underline hover:text-white/70 hover:bg-[#A5A58D]">Search</button>
                    <a class="text-white text-center bg-[#6B705C] rounded py-2 px-2 hover:no-underline hover:text-white/70 hover:bg-[#A5A58D]" href="/home">Clear filters</a>
                </form>
            </div>


            <div class="flex flex-wrap justify-center gap-6 mt-8">
                @foreach ($books as $book)
                <div class="bg-[#B7B7A4] lg:w-[30%] md:w-[40%] w-[80%] h-[230px] rounded-xl flex flex-col items-center overflow-hidden shadow-[3px_3px_15px_5px_rgba(0,0,0,0.3)] p-6 text-[#3E3E3E] relative transition-all duration-500 cursor-pointer card-height" onclick="toggleCardDetails(this)">
                    <div class="card-summary text-center flex flex-col justify-center items-center">
                        <img class="h-[100px] w-[100px] object-cover mb-4 rounded-lg" src="{{$book->picture}}" alt="{{$book->title}}">
                        <h4 class="font-semibold mb-2">{{$book->title}}</h4>
                        <p class="text-sm text-[#3E3E3E]">- {{$book->author}}</p>
                    </div>
                    <div class="w-full card-details mt-4 overflow-hidden transition-all duration-500 hidden flex flex-col">
                        <div class="border-2 rounded-lg mt-2 p-3 border-[#CB997E] bg-[#FFE8D6]">
                            <p class="font-semibold text-[#6B705C]">Description:</p>
                            <p class="mt-2 text-[#3E3E3E]">{{Str::limit($book->description, 50)}}</p>
                        </div>
                        <div class="border-2 rounded-lg mt-2 p-3 border-[#CB997E] bg-[#FFE8D6]">
                            <p class="font-semibold text-[#6B705C]">Language:</p>
                            <p class="mt-2 text-[#3E3E3E]">{{$book->language->name}}</p>
                        </div>
                        <div class="border-2 rounded-lg mt-2 p-3 border-[#CB997E] bg-[#FFE8D6]">
                            <p class="font-semibold text-[#6B705C]">Price:</p>
                            <p class="mt-2 text-[#3E3E3E]">{{$book->price}}</p>
                        </div>
                        @if (auth()->check() && !auth()->user()->isAdmin)
                        <form method="get" action="/viewloan/{{$book->id}}">
                            @csrf
                            <button class="mt-4 bg-[#6B705C] text-white px-4 py-2 rounded hover:bg-[#CB997E] transition-colors">View More Detail</button>
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
        const card = element;

        if (openCard === details) {
            details.classList.add('hidden');
            card.classList.remove('h-[650px]');
            card.classList.add('h-[230px]');

            openCard = null;
        } else {
            if (openCard !== null) {
                openCard.classList.add('hidden');
                openCard.parentElement.classList.remove('h-[650px]');
                openCard.parentElement.classList.add('h-[230px]');
            }
            details.classList.remove('hidden');
            card.classList.add('h-[650px]');
            card.classList.remove('h-[230px]');

            openCard = details;
        }
    }
</script>