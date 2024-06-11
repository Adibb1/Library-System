<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Admin') }}
        </h2>
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Add Books Section -->
            <div class="bg-[#6B705C] overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-white flex flex-col items-center">
                    <button class="flex items-center w-full text-center bg-[#A5A58D] hover:bg-[#A5A58D] text-white font-bold py-2 px-4 rounded transition-all" onclick="toggleSection('formAdd')">ADD BOOKS</button>
                    <form id="formAdd" method="POST" action="/books" enctype="multipart/form-data" class="w-full max-w-sm mx-auto h-0 opacity-0 transition-all overflow-hidden mt-4">
                        @csrf
                        <div class="mb-2">
                            <label for="Title" class="block mb-2 text-sm font-medium text-white">Title</label>
                            <input type="text" name="Title" class="bg-[#B7B7A4] border border-gray-600 placeholder-white text-sm font-bold text-black rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Title" required />
                        </div>
                        <div class="mb-2">
                            <label for="Author" class="block mb-2 text-sm font-medium text-white">Author</label>
                            <input type="text" name="Author" class="bg-[#B7B7A4] border border-gray-600 placeholder-white text-sm font-bold text-black rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Author" required />
                        </div>
                        <div class="mb-2">
                            <label for="ISBN" class="block mb-2 text-sm font-medium text-white">ISBN</label>
                            <input type="text" name="ISBN" class="bg-[#B7B7A4] border border-gray-600 placeholder-white text-sm font-bold text-black rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Book Number" required />
                        </div>
                        <div class="mb-2">
                            <label for="Description" class="block mb-2 text-sm font-medium text-white">Description</label>
                            <input type="text" name="Description" class="bg-[#B7B7A4] border border-gray-600 placeholder-white text-sm font-bold text-black rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Description" required />
                        </div>
                        <div class="mb-2">
                            <label for="Description" class="block mb-2 text-sm font-medium text-white">Price</label>
                            <input type="text" name="Price" class="bg-[#B7B7A4] border border-gray-600 placeholder-white text-sm font-bold text-black rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Price" required />
                        </div>
                        <div class="mb-2">
                            <label for="Description" class="block mb-2 text-sm font-medium text-white">Language</label>
                            <select id="Language" name="Language" class="bg-[#B7B7A4] border border-gray-600 text-sm font-bold text-white rounded-lg block w-full p-2.5 focus:ring-0 focus:border-[#A5A58D]" onchange="changeTextColor(this)">
                                <option value="" disabled selected>Language</option>
                                <option value="1">English</option>
                                <option value="2">Mandarin</option>
                                <option value="3">Spanish</option>
                                <option value="4">Malay</option>
                                <option value="5">Hindi</option>
                                <option value="6">Others</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="Category" class="block mb-2 text-sm font-medium text-white">Category</label>
                            <select id="Category" name="Category" class="bg-[#B7B7A4] border border-gray-600 text-sm font-bold text-white rounded-lg block w-full p-2.5 focus:ring-0 focus:border-[#A5A58D]" onchange="changeTextColor(this)">
                                <option value="" disabled>Category</option><!--Others-->
                                <option value="2">Fiction</option>
                                <option value="3">Non-Fiction</option>
                                <option value="4">Young Adult</option>
                                <option value="5">Children</option>
                                <option value="6">Fantasy</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="block mb-2 text-sm font-medium text-white" for="picture">Picture</label>
                            <input type="file" class="block w-full text-sm text-white
        file:mr-4 file:py-2 file:px-4 file:rounded-md
        file:border-0 file:text-sm file:font-semibold
        file:bg-[#B7B7A4] file:text-white
        hover:file:bg-[#A5A58D]" name="picture" id="picture" />
                        </div>
                        <button class="text-white bg-[#B7B7A4] hover:bg-[#A5A58D] font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">Submit</button>
                    </form>
                </div>
            </div>

            <!-- View Books Section -->
            <div class="bg-[#6B705C] overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-white flex flex-col items-center">
                    <button class="flex items-center w-full text-center bg-[#A5A58D] hover:bg-[#A5A58D] text-white font-bold py-2 px-4 rounded transition-all" onclick="toggleSection('index')">VIEW BOOKS</button>
                    <div id="index" class="w-full max-w-7xl mx-auto h-0 opacity-0 transition-all overflow-hidden mt-4 flex flex-wrap gap-3 ">
                        @if (is_null($books))
                        <p>No books !!!!</p>
                        @else
                        @foreach ($books as $book)
                        <div class="bg-[#B7B7A4] lg:w-[30%] md:w-[40%] w-[90%] rounded-xl flex flex-col justify-center items-center overflow-hidden shadow-sm p-6 text-white relative transition-all duration-500 cursor-pointer">
                            <form action="/edit/{{$book->id}}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="card-summary flex flex-col justify-center ">
                                    <img class="h-[100px] w-[100px] object-cover flex" src="{{$book->picture}}" alt="{{$book->picture}}">
                                </div>
                                <div class="w-full card-details mt-4 overflow-hidden transition-all duration-500 flex flex-col">
                                    <div class="border-2 rounded-lg mt-2 p-3 border-[#6B705C]">
                                        <p class="font-semibold">Title:</p>
                                        <input class="text-black" type="text" name="Title" value="{{$book->title}}">
                                    </div>
                                    <div class="border-2 rounded-lg mt-2 p-3 border-[#6B705C]">
                                        <p class="font-semibold">Author:</p>
                                        <input class="text-black" type="text" name="Author" value="{{$book->author}}">
                                    </div>
                                    <div class="border-2 rounded-lg mt-2 p-3 border-[#6B705C]">
                                        <p class="font-semibold">Description:</p>
                                        <input class="text-black" type="text" name="Description" value="{{$book->description}}">
                                    </div>
                                    <div class="border-2 rounded-lg mt-2 p-3 border-[#6B705C]">
                                        <p class="font-semibold">ISBN:</p>
                                        <input class="text-black" type="text" name="ISBN" value="{{$book->ISBN}}">
                                    </div>
                                    <div class="border-2 rounded-lg mt-2 p-3 border-[#6B705C]">
                                        <p class="font-semibold">Price:</p>
                                        <input class="text-black" type="text" name="Price" value="{{$book->price}}">
                                    </div>
                                    <button class="text-white bg-[#6B705C] hover:bg-[#A5A58D] font-medium rounded-lg text-sm w-full px-2 py-2 text-center mt-1">Edit</button>
                                </div>
                            </form>
                            <div class="flex gap-1 flex-wrap justify-center">
                                <form method="POST" action="/delete/{{$book->id}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 hover:bg-red-600 py-1 px-2 rounded-lg mt-1 w-full ">Delete</button>
                                </form>

                                @if ($book->trending == True)
                                <form method="POST" action="/canceltrends/{{$book->id}}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="bg-yellow-500 hover:bg-yellow-600 py-1 px-2 rounded-lg mt-1 w-full ">Cancel Trends</button>
                                </form>
                                @else
                                <form method="POST" action="/trends/{{$book->id}}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="bg-yellow-500 hover:bg-yellow-600 py-1 px-2 rounded-lg mt-1 w-full ">Make Trends</button>
                                </form>
                                @endif

                                @if ($book->recommended == True)
                                <form method="POST" action="/cancelrecommends/{{$book->id}}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="bg-blue-500 hover:bg-blue-600 py-1 px-2 rounded-lg mt-1 w-full ">Cancel Recommended</button>
                                </form>
                                @else
                                <form method="POST" action="/recommends/{{$book->id}}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="bg-blue-500 hover:bg-blue-600 py-1 px-2 rounded-lg mt-1 w-full ">Make Recommended</button>
                                </form>
                                @endif


                            </div>

                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- All loans Section -->
            <div class="bg-[#6B705C] overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-white flex flex-col items-center">
                    <button class="flex items-center w-full text-center bg-[#A5A58D] hover:bg-[#A5A58D] text-white font-bold py-2 px-4 rounded transition-all" onclick="toggleSection('confirm_loan')">VIEW ALL LOANS</button>
                    <div id="confirm_loan" class="w-full max-w-7xl mx-auto h-0 opacity-0 transition-all overflow-hidden mt-4 flex flex-wrap gap-4 justify-center">
                        @if (is_null($books))
                        <p>No loans !!!!</p>
                        @else
                        @foreach ($loans as $loan)
                        <div class="bg-[#B7B7A4] lg:w-[30%] md:w-[40%] w-[90%] rounded-xl flex flex-col justify-center items-center overflow-hidden shadow-sm p-6 text-white relative transition-all duration-500 cursor-pointer">
                            <div class="card-summary flex flex-col justify-center ">
                                <img class="h-[100px] w-[100px] object-cover flex" src="{{$loan->book->picture}}" alt="{{$loan->book->picture}}">
                            </div>
                            <div class="w-full card-details mt-4 overflow-hidden transition-all duration-500 flex flex-col">
                                <div class="border-2 rounded-lg mt-2 p-3 border-[#6B705C]">
                                    <p class="font-semibold">Title:</p>
                                    <p class="text-black">{{$loan->book->title}}</p>
                                </div>
                                <div class="border-2 rounded-lg mt-2 p-3 border-[#6B705C]">
                                    <p class="font-semibold">Loaner Name:</p>
                                    <p class="text-black">{{$loan->name}}</p>
                                </div>
                                <div class="border-2 rounded-lg mt-2 p-3 border-[#6B705C]">
                                    <p class="font-semibold">Date Loan:</p>
                                    <p class="text-black">{{$loan->loan_date->format('j F Y')}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function toggleSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (section.style.height === '0px' || section.style.height === '0') {
                section.style.height = section.scrollHeight + 'px';
                section.style.opacity = '1';
            } else {
                section.style.height = '0';
                section.style.opacity = '0';
            }
        }

        function changeTextColor(selectElement) {
            if (selectElement.value !== "") {
                selectElement.classList.remove('text-white');
                selectElement.classList.add('text-black');
            } else {
                selectElement.classList.remove('text-black');
                selectElement.classList.add('text-white');
            }
        }
    </script>
</x-app-layout>