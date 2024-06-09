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
                        <div class="mb-5">
                            <label for="Title" class="block mb-2 text-sm font-medium text-white">Title</label>
                            <input type="text" name="Title" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Title" required />
                        </div>
                        <div class="mb-5">
                            <label for="Author" class="block mb-2 text-sm font-medium text-white">Author</label>
                            <input type="text" name="Author" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Author" required />
                        </div>
                        <div class="mb-5">
                            <label for="ISBN" class="block mb-2 text-sm font-medium text-white">ISBN</label>
                            <input type="text" name="ISBN" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Book Number" required />
                        </div>
                        <div class="mb-5">
                            <label for="Description" class="block mb-2 text-sm font-medium text-white">Description</label>
                            <input type="text" name="Description" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Description" required />
                        </div>
                        <div class="mb-5">
                            <label for="Publish" class="block mb-2 text-sm font-medium text-white">Publish Date</label>
                            <input type="date" name="Publish" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Publish Date" required />
                        </div>
                        <div class="mb-5">
                            <label for="Ammount" class="block mb-2 text-sm font-medium text-white">Amount</label>
                            <input type="number" name="Ammount" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Amount" required />
                        </div>
                        <div class="mb-5">
                            <label for="Category" class="block mb-2 text-sm font-medium text-white">Category</label>
                            <select class="text-black bg-gray-700 border border-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" name="Category" id="Category">
                                <option value="7" disabled>Category</option><!--Others-->
                                <option value="2">Fiction</option>
                                <option value="3">Non-Fiction</option>
                                <option value="4">Young Adult</option>
                                <option value="5">Children</option>
                                <option value="6">Fantasy</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-white" for="picture">Picture</label>
                            <input class="block w-full text-sm text-gray-400 border border-gray-600 rounded-lg cursor-pointer bg-gray-700 focus:outline-none" name="picture" type="file" required>
                        </div>
                        <button class="text-white bg-blue-600 hover:bg-[#A5A58D] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">Submit</button>
                    </form>
                </div>
            </div>

            <!-- View Books Section -->
            <div class="bg-[#6B705C] overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-white flex flex-col items-center">
                    <button class="flex items-center w-full text-center bg-[#A5A58D] hover:bg-[#A5A58D] text-white font-bold py-2 px-4 rounded transition-all" onclick="toggleSection('index')">VIEW BOOKS</button>
                    <div id="index" class="w-full max-w-7xl mx-auto h-0 opacity-0 transition-all overflow-hidden mt-4">
                        @foreach ($books as $book)
                        <div class="bg-[#A5A58D] overflow-hidden shadow-sm sm:rounded-lg flex flex-wrap p-4 my-2">
                            <div class="p-6 text-gray-900 flex flex-col items-center">
                                <h4>{{$book->title}}</h4>
                                <div class="flex flex-col gap-3">
                                    <a>{{$book->id}}</a>
                                    <p class="bg-red-600 h-[100px] w-[100px]"><img class="h-[100px] w-[100px]" src="{{$book->picture}}"></p>
                                    <form method="POST" action="/edit/{{$book->id}}">
                                        @csrf
                                        @method('PATCH')
                                        <input class="text-black" type="text" name="Title" value="{{$book->title}}">
                                        <input class="text-black" type="text" name="Author" value="{{$book->author}}">
                                        <input class="text-black" type="number" name="ISBN" value="{{$book->ISBN}}">
                                        <input class="text-black" type="text" name="Description" value="{{$book->description}}">
                                        <input class="text-black" type="date" name="Publish" value="{{ $book->published_date ? $book->published_date->format('Y-m-d') : 'not date' }}">
                                        <input class="text-black" type="number" name="Ammount" value="{{$book->ammount}}"><br>
                                        <input class="text-black" type="number" name="Category" value="{{$book->category_id}}"><br>
                                        <button class="bg-yellow-500">edit</button>
                                    </form>
                                </div>
                                <form method="POST" action="/delete/{{$book->id}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600">delete</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Confirm Loans Section -->
            <div class="bg-[#6B705C] overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-white flex flex-col items-center">
                    <button class="flex items-center w-full text-center bg-[#A5A58D] hover:bg-[#A5A58D] text-white font-bold py-2 px-4 rounded transition-all" onclick="toggleSection('confirm_loan')">VIEW NEED CONFIRM LOANS</button>
                    <div id="confirm_loan" class="w-full max-w-7xl mx-auto h-0 opacity-0 transition-all overflow-hidden mt-4">
                        @foreach ($loans as $loan)
                        <div class="my-5 bg-[#A5A58D] overflow-hidden shadow-sm sm:rounded-lg p-4">
                            <div>
                                <p><img src="{{$loan->book->picture}}" alt="Book Image"></p>
                                <p>Name: {{$loan->name}}</p>
                                <p>Book ID: {{$loan->book_id}}</p>
                                <p>User ID: {{$loan->user_id}}</p>
                                <p>Loan Date: {{$loan->loan_date}}</p>
                                <p>Return Date: {{$loan->due_date}}</p>
                                <form action="confirm_loan_admin/{{$loan->id}}?bookid{{$book->id}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-green-600">confirm as admin</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- View Fines Section -->
            <div class="bg-[#6B705C] overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-white flex flex-col items-center">
                    <button class="flex items-center w-full text-center bg-[#A5A58D] hover:bg-[#A5A58D] text-white font-bold py-2 px-4 rounded transition-all" onclick="toggleSection('view_fine')">VIEW FINES</button>
                    <div id="view_fine" class="w-full max-w-7xl mx-auto h-0 opacity-0 transition-all overflow-hidden mt-4">
                        @foreach ($fines as $fine)
                        <div class="bg-[#A5A58D] overflow-hidden shadow-sm sm:rounded-lg flex flex-wrap p-4 my-2">
                            <div class="p-6 text-gray-900 flex flex-col items-center">
                                <h4>Fine ID: {{$fine->id}}</h4>
                                <div class="flex flex-col gap-3">
                                    <p>User ID: {{$fine->user_id}}</p>
                                    <p>Amount: {{$fine->amount}}</p>
                                    <form method="POST" action="/fine_update/{{$fine->id}}">
                                        @csrf
                                        @method('PATCH')
                                        <input class="text-black" type="text" name="amount" value="{{$fine->amount}}">
                                        <button class="bg-yellow-500">update</button>
                                    </form>
                                </div>
                                <form method="POST" action="/delete_fine/{{$fine->id}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600">delete</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
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
    </script>
</x-app-layout>