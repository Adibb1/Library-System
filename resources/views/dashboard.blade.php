<x-app-layout>
    <!-- Header Section -->
    <header>
        <img src="{{ asset('images/Library.svg') }}" alt="Banner" class="w-full">
    </header>

    <!-- Main Content -->
    <main class="py-8">
        <div class="container mx-auto w-11/12 sm:w-4/5">
            <!-- Trending Books Section with Sliding Effect -->
            <section class="mb-28 mt-10 relative">
                <h2 class="text-3xl sm:text-4xl md:text-6xl font-semibold mb-6 text-center text-[#6B705C]">Trending Books</h2>
                <div class="relative overflow-hidden" x-data="{ currentIndex: 0 }">
                    <div class="flex transition-transform duration-700" :style="'transform: translateX(-' + currentIndex * 100 + '%)'">
                        @foreach ($trendingBooks as $book)
                        <div class="min-w-full flex justify-center items-center">
                            <div class="sm:w-1/3 w-full bg-[#DDBEA9] shadow-md rounded-lg overflow-hidden">
                                <img src="{{ $book->picture }}" alt="{{ $book->title }}" class="w-full h-48 object-cover aspect-square">
                                <div class="p-4">
                                    <h3 class="text-lg sm:text-xl font-semibold text-[#3E3E3E]">{{ $book->title }}</h3>
                                    <p class="text-[#3E3E3E]">{{ Str::limit($book->description, 40) }}</p>
                                    <a href="/viewloan/{{$book->id}}" class="text-[#6B705C] hover:text-[#CB997E] mt-2 block">Read More</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="hidden sm:block">
                        <button @click="currentIndex = (currentIndex === 0) ? {{ count($trendingBooks) - 1 }} : currentIndex - 1" class="absolute top-1/2 left-24 transform -translate-y-1/2 bg-[#6B705C] text-white px-3 py-2 rounded-full z-10">Prev</button>
                        <button @click="currentIndex = (currentIndex === {{ count($trendingBooks) - 1 }}) ? 0 : currentIndex + 1" class="absolute top-1/2 right-24 transform -translate-y-1/2 bg-[#6B705C] text-white px-3 py-2 rounded-full z-10">Next</button>
                    </div>
                    <div class="block sm:hidden flex justify-center gap-3 mt-4">
                        <button @click="currentIndex = (currentIndex === 0) ? {{ count($trendingBooks) - 1 }} : currentIndex - 1" class="bg-[#6B705C] text-white px-3 py-2 rounded-full z-10">Prev</button>
                        <button @click="currentIndex = (currentIndex === {{ count($trendingBooks) - 1 }}) ? 0 : currentIndex + 1" class="bg-[#6B705C] text-white px-3 py-2 rounded-full z-10">Next</button>
                    </div>
                </div>
            </section>

            <!-- Recommended Books Section with Hover Effect -->
            <section class="mb-28">
                <h2 class="text-3xl sm:text-4xl md:text-6xl font-semibold mb-6 text-center text-[#6B705C]">Recommended Books</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($recommendedBooks as $book)
                    <div class="bg-[#DDBEA9] shadow-md rounded-lg overflow-hidden transition-transform duration-300 transform hover:scale-105">
                        <img src="{{ $book->picture }}" alt="{{ $book->title }}" class="w-full h-48 object-cover aspect-square">
                        <div class="p-4">
                            <h3 class="text-lg sm:text-xl font-semibold text-[#3E3E3E]">{{ $book->title }}</h3>
                            <p class="text-[#3E3E3E]">{{ Str::limit($book->description, 150) }}</p>
                            <a href="/viewloan/{{$book->id}}" class="text-[#6B705C] hover:text-[#CB997E] mt-2 block">Read More</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- User Testimonials Section with Sliding Effect -->
            <section class="mb-28 relative">
                <h2 class="text-3xl sm:text-4xl md:text-6xl font-semibold mb-6 text-center text-[#6B705C]">User Testimonials</h2>
                <div class="relative overflow-hidden" x-data="{ currentTestimonial: 0 }">
                    <div class="flex transition-transform duration-700" :style="'transform: translateX(-' + currentTestimonial * 100 + '%)'">
                        @foreach ($testimonials as $index => $testimonial)
                        <div class="min-w-full flex justify-center items-center">
                            <div class="w-full sm:w-4/5 bg-[#DDBEA9] shadow-md rounded-lg p-4 flex items-center h-full">
                                <img src="{{ $testimonial->loan->book->picture }}" alt="{{ $testimonial->loan->book->title }}" class="w-24 h-24 object-cover aspect-square mr-4">
                                <div>
                                    <p class="text-[#3E3E3E]">{{ $testimonial->text }}</p>
                                    <p class="text-sm text-[#3E3E3E] mt-2">- {{ $testimonial->user->name }} on <strong class="text-lg">{{ $testimonial->loan->book->title }}</strong></p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="sm:block hidden">
                        <button @click="currentTestimonial = (currentTestimonial === 0) ? {{ count($testimonials) - 1 }} : currentTestimonial - 1" class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-[#6B705C] text-white px-3 h-10 rounded-3xl flex items-center justify-center z-10">Prev</button>
                        <button @click="currentTestimonial = (currentTestimonial === {{ count($testimonials) - 1 }}) ? 0 : currentTestimonial + 1" class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-[#6B705C] text-white px-3 h-10 rounded-3xl flex items-center justify-center z-10">Next</button>
                    </div>
                    <div class="flex w-full justify-center gap-3 sm:hidden block mt-2">
                        <button @click="currentTestimonial = (currentTestimonial === 0) ? {{ count($testimonials) - 1 }} : currentTestimonial - 1" class=" left-2 bg-[#6B705C] text-white px-3 h-10 rounded-3xl flex items-center justify-center z-10">Prev</button>
                        <button @click="currentTestimonial = (currentTestimonial === {{ count($testimonials) - 1 }}) ? 0 : currentTestimonial + 1" class=" right-2 bg-[#6B705C] text-white px-3 h-10 rounded-3xl flex items-center justify-center z-10">Next</button>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <!-- Footer Section -->
    <footer class="bg-[#6B705C] text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} Adib Library. All rights reserved.</p>
        </div>
    </footer>
</x-app-layout>