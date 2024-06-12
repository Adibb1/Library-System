@php
use Carbon\Carbon;
@endphp

<x-app-layout> <!-- Styling -->
    <h2 class="text-5xl font-semibold mt-12 mb-6 text-center text-[#6B705C]">Loan a Book !</h2>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- BOOK DEATILS -->
            <div class="bg-[#A5A58D] overflow-hidden shadow-lg sm:rounded-lg mb-6">
                <div class="p-6 text-white">
                    <div class="flex gap-3 items-center flex-col sm:flex-row ">
                        <img class="h-[270px] w-[190px] rounded-lg" src="{{$book->picture}}">
                        <h4 class="text-4xl font-bold mb-4">{{$book->title}}</h4>
                    </div>

                    <div class="flex flex-col gap-3 mt-2">
                        <div class="border-2 rounded-lg mt-1 p-3 border-[#CB997E] bg-[#FFE8D6] shadow-xl">
                            <p class="text-black">Author: {{$book->author}}</p>
                        </div>
                        <div class="border-2 rounded-lg mt-1 p-3 border-[#CB997E] bg-[#FFE8D6] shadow-xl">
                            <p class="text-black">Description: {{$book->description}}</p>
                        </div>
                        <div class="border-2 rounded-lg mt-1 p-3 border-[#CB997E] bg-[#FFE8D6] shadow-xl">
                            <p class="text-black">Book Number (ISBN): {{$book->ISBN}}</p>
                        </div>
                        <div class="border-2 rounded-lg mt-1 p-3 border-[#CB997E] bg-[#FFE8D6] shadow-xl">
                            <p class="text-black">Category: {{$book->category->name}}</p>
                        </div>
                        <div class="border-2 rounded-lg mt-1 p-3 border-[#CB997E] bg-[#FFE8D6] shadow-xl">
                            <p class="text-black">Language: {{$book->language->name}}</p>
                        </div>
                        <div class="border-2 rounded-lg mt-1 p-3 border-[#CB997E] bg-[#FFE8D6] shadow-xl">
                            <p class="text-black">Price: {{$book->price}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BOOK TESTIMONIES -->
            <div class="bg-[#A5A58D] overflow-hidden shadow-lg sm:rounded-lg mb-6">
                <div class="p-6 text-white flex flex-col items-center">
                    <button class="flex border-2 border-[#CB997E] items-center w-full text-center bg-[#FFE8D6] hover:shadow-lg text-black font-bold py-2 px-4 rounded-lg transition-all" onclick="expand('testimonies')">View Testimonies !</button>
                    <div id="testimonies" class="w-full max-w-7xl mx-auto h-0 opacity-0 transition-all overflow-hidden flex flex-wrap gap-4 justify-center">
                        @if ($testimonies->isEmpty())
                        <p>No Testimonies :( !!!!</p>
                        @else
                        @foreach ($testimonies as $testimony)
                        <div class="bg-[#FFE8D6] border-2 border-[#CB997E] w-[90%] rounded-xl flex gap-3 justify-center items-center overflow-hidden shadow-xl p-6 text-white relative transition-all duration-500">
                            <div class="card-summary flex flex-col justify-center ">
                                <img class="h-[70px] w-[70px] object-cover flex rounded-full" src="{{$testimony->user->profile_picture}}" alt="pfp">
                                <p class="text-black text-center">{{$testimony->user->name}}</p>
                            </div>
                            <div class="w-full card-details overflow-hidden transition-all duration-500 flex flex-col">
                                <p class="text-black">{{ Carbon::parse($testimony->created_at)->format('j F Y') }}</p>
                                <div class="border-2 rounded-lg p-3 border-[#CB997E]">
                                    <p class="text-black">{{$testimony->text}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <!-- CHECK LOANED OR NOT -->
            <div class="w-full flex justify-center ">
                @if (!is_null($loan))
                <div class="bg-[#A5A58D] overflow-hidden shadow-lg sm:rounded-lg mb-6 w-[80%] sm:w-full">
                    <div class="p-6 text-white">
                        <div class="flex flex-col gap-3">
                            <p>You already loan this book!</p>
                        </div>
                    </div>
                </div>
                @else
                <form method="POST" action="/makeloan?bookid={{$book->id}}" class="flex flex-col gap-3 text-gray-900 w-[80%] sm:w-full">
                    @csrf
                    <div class="flex flex-col text-gray-800">
                        <label class="mb-2" for="name">Loaner Name</label>
                        <input class="p-2 rounded-lg" type="text" name="name" id="name" placeholder="Name" required>
                    </div>
                    <button class="bg-[#6B705C] text-white py-2 px-4 rounded-lg transition-colors hover:bg-[#A5A58D]">Confirm Loan & Pay</button>
                </form>
                @endif
            </div>

        </div>
    </div>
    <script>
        function expand(sectionId) {
            const section = document.getElementById(sectionId);
            if (section.style.height === '0px' || section.style.height === '0') {
                section.style.height = section.scrollHeight + 'px';
                section.style.opacity = '1';
                section.classList.add('mt-4');
                section.classList.add('pb-4');
            } else {
                section.style.height = '0';
                section.style.opacity = '0';
                section.classList.remove('mt-4');
                section.classList.remove('pb-4');
            }
        }
    </script>
</x-app-layout>