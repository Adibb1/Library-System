<x-app-layout>
    <h2 class="text-5xl font-semibold mt-12 mb-6 text-center text-[#6B705C]">Admin Controllers</h2>
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
                            <label for="Price" class="block mb-2 text-sm font-medium text-white">Price</label>
                            <input type="text" name="Price" class="bg-[#B7B7A4] border border-gray-600 placeholder-white text-sm font-bold text-black rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Price" required />
                        </div>
                        <div class="mb-2">
                            <label for="Language" class="block mb-2 text-sm font-medium text-white">Language</label>
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
                                <option value="" disabled selected>Category</option><!--Others-->
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
                                hover:file:bg-[#A5A58D]" name="picture" id="picture" required />
                        </div>
                        <button class="text-white bg-[#B7B7A4] hover:bg-[#A5A58D] font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">Submit</button>
                    </form>
                </div>
            </div>

            <!-- View Edit Books Section -->
            <div class="bg-[#6B705C] overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-white flex flex-col items-center">
                    <button class="flex items-center w-full text-center bg-[#A5A58D] hover:bg-[#A5A58D] text-white font-bold py-2 px-4 rounded transition-all" onclick="toggleSection('index')">EDIT BOOKS</button>
                    <div id="index" class="w-full max-w-7xl mx-auto h-0 opacity-0 transition-all overflow-hidden mt-4 flex flex-wrap gap-3 justify-center">
                        @if (is_null($books))
                        <p>No books !!!!</p>
                        @else
                        @foreach ($books as $book)
                        <div class="bg-[#B7B7A4] lg:w-[30%] md:w-[40%] w-[90%] rounded-xl flex flex-col flex-wrap justify-center items-center overflow-hidden shadow-sm px-2 py-3 sm:p-6 text-white relative transition-all duration-500">
                            <div class="flex flex-col justify-start items-start mt-4 sm:mt-0 items-center w-full md:w-1/2">
                                <img id="book-picture-{{$book->id}}" class="h-[150px] w-[150px] mb-4 rounded-xl object-cover cursor-pointer" src="{{$book->picture}}" alt="Book Picture">
                                <form id="update-picture-book-{{$book->id}}" action="/edit_picture/{{$book->id}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <input name="picture" type="file" class="hidden" id="picture-{{$book->id}}" required />
                                    <button class="text-black shadow-lg border bg-[#DDBEA9] hover:bg-[#CB997E] font-medium rounded-lg text-sm w-full px-2 py-2 text-center mt-1">{{ __('Update picture') }}</button>
                                </form>
                            </div>
                            <form action="/edit/{{$book->id}}" method="post">
                                @csrf
                                @method('PATCH')

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
                                    <button class="text-white shadow-lg border bg-green-600 hover:bg-green-700 font-medium rounded-lg text-sm w-full px-2 py-2 text-center mt-1">Edit</button>
                                </div>
                            </form>
                            <div class="flex gap-1 flex-wrap justify-center">
                                <form method="POST" action="/delete/{{$book->id}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 hover:bg-red-600 py-1 px-2 rounded-lg mt-1 w-full shadow-lg border ">Delete</button>
                                </form>

                                @if ($book->trending == True)
                                <form method="POST" action="/canceltrends/{{$book->id}}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="bg-yellow-500 hover:bg-yellow-600 py-1 px-2 rounded-lg mt-1 w-full shadow-lg border ">Cancel Trends</button>
                                </form>
                                @else
                                <form method="POST" action="/trends/{{$book->id}}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="bg-yellow-500 hover:bg-yellow-600 py-1 px-2 rounded-lg mt-1 w-full shadow-lg border ">Make Trends</button>
                                </form>
                                @endif

                                @if ($book->recommended == True)
                                <form method="POST" action="/cancelrecommends/{{$book->id}}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="bg-blue-500 hover:bg-blue-600 py-1 px-2 rounded-lg mt-1 w-full shadow-lg border ">Cancel Recommended</button>
                                </form>
                                @else
                                <form method="POST" action="/recommends/{{$book->id}}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="bg-blue-500 hover:bg-blue-600 py-1 px-2 rounded-lg mt-1 w-full shadow-lg border ">Make Recommended</button>
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

        // Add event listeners to all book picture and file input elements
        document.addEventListener('DOMContentLoaded', function() {
            @foreach($books as $book)
            document.getElementById('book-picture-{{$book->id}}').addEventListener('click', function() {
                document.getElementById('picture-{{$book->id}}').click();
            });

            document.getElementById('picture-{{$book->id}}').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('book-picture-{{$book->id}}').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
            @endforeach
        });
    </script>

</x-app-layout>