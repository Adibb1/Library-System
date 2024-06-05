<x-app-layout> <!--styling-->
    <x-slot name="header"> <!--HEADER-->
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin') }}
        </h2>
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100 dark:text-gray-100 flex flex-col items-center transition-all">
                    <button class="flex items-center w-full text-center" onclick="expandAddBooks()">ADD BOOKS</button>
                    <form id="formAdd" method="POST" action="/books" enctype="multipart/form-data" class="w-100 max-w-sm mx-auto h-0 opacity-0 transition-all">
                        @csrf
                        <div class="mb-5">
                            <label for="Title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="text" name="Title" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Title" required />
                        </div>
                        <div class="mb-5">
                            <label for="Author" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Author</label>
                            <input type="text" name="Author" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Author" required />
                        </div>
                        <div class="mb-5">
                            <label for="ISBN" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ISBN</label>
                            <input type="text" name="ISBN" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Book Number" required />
                        </div>
                        <div class="mb-5">
                            <label for="Description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <input type="text" name="Description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Description" required />
                        </div>
                        <div class="mb-5">
                            <label for="Publish" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Publish Date</label>
                            <input type="date" name="Publish" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Publish Date" required />
                        </div>
                        <div class="mb-5">
                            <label for="Ammount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ammount</label>
                            <input type="number" name="Ammount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ammount" required />
                        </div>
                        <div class="mb-5">
                            <label for="Category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                            <select class="text-black" name="Category" id="Category">
                                <option value="7" disable>Category</option><!--Others-->
                                <option value="2">Fiction</option>
                                <option value="3">Non-Fiction</option>
                                <option value="4">Young Adult</option>
                                <option value="5">Children</option>
                                <option value="6">Fantasy</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="picture">Picture</label>
                            <input class="my-2.5 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="picture" type="file" required>
                        </div>
                        <button class="text-black bg-gray-100 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col items-center transition-all">
                    <button class="flex items-center w-full text-center" onclick="expandIndexBooks()">VIEW BOOKS</button>
                    <div id="index" class="w-100 max-w-sm mx-auto h-0 opacity-0 transition-all">
                        @foreach ($books as $book)
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-gray-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-wrap ">
                                <div class="p-6 text-gray-900 dark:text-gray-100 ">
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
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col items-center transition-all">
                    <button class="flex items-center w-full text-center" onclick="expandConfirmLoan()">VIEW NEED CONFIRM LOANS</button>
                    <div id="confirm_loan" class="w-100 max-w-sm mx-auto h-0 opacity-0 transition-all">
                        @foreach ($loans as $loan)
                        <div class="my-5">
                            <div>
                                <p><img src="{{$loan->book->picture}}" alt="aa"></p>
                                <p>name: {{$loan->name}}</p>
                                <p>book id: {{$loan->book_id}}</p>
                                <p>user id: {{$loan->user_id}}</p>
                                <p>loan date: {{$loan->loan_date}}</p>
                                <p>return date: {{$loan->due_date}}</p>
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
        </div>
    </div>
    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col items-center transition-all">
                    <button class="flex items-center w-full text-center" onclick="expandFines()">VIEW ALL FINES</button>
                    <div id="fines" class="w-100 max-w-sm mx-auto h-0 opacity-0 transition-all">
                        @foreach ($fines as $fine)
                        <div class="my-5">
                            <div>
                                <p>user name: {{$fine->loan->name}}</p>
                                <p>book: {{$fine->loan->book->title}}</p>
                                <p>user id: {{$fine->amount}}</p>
                                <form action="delete_fines/{{$fine->id}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-green-600">delete as admin</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col items-center transition-all">
                    <button class="flex items-center w-full text-center" onclick="expandMessage()">VIEW ADD MESSAGE</button>
                    <form id="formMessage" method="POST" action="/add_message" enctype="multipart/form-data" class="w-100 max-w-sm mx-auto h-0 opacity-0 transition-all">
                        @csrf
                        <div class="mb-5">
                            <label for="user" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                            <select class="text-black" name="user" id="user">
                                @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-5">
                            <label for="Title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Message</label>
                            <input type="text" name="message" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Message you want to send" required />
                        </div>
                        <button class="text-black bg-gray-100 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function expandAddBooks() {
            forms = document.getElementById("formAdd")
            forms.classList.toggle("h-0")
            forms.classList.toggle("h-[1000px]")
            forms.classList.toggle("opacity-0")
        }

        function expandIndexBooks() {
            forms = document.getElementById("index")
            forms.classList.toggle("h-0")
            forms.classList.toggle("h-[2000px]")
            forms.classList.toggle("opacity-0")
        }

        function expandConfirmLoan() {
            forms = document.getElementById("confirm_loan")
            forms.classList.toggle("h-0")
            forms.classList.toggle("h-[2000px]")
            forms.classList.toggle("opacity-0")
        }

        function expandFines() {
            forms = document.getElementById("fines")
            forms.classList.toggle("h-0")
            forms.classList.toggle("h-[2000px]")
            forms.classList.toggle("opacity-0")
        }

        function expandMessage() {
            forms = document.getElementById("formMessage")
            forms.classList.toggle("h-0")
            forms.classList.toggle("h-[2000px]")
            forms.classList.toggle("opacity-0")
        }
    </script>
</x-app-layout>