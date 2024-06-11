<x-app-layout>
    <!-- Header Section -->
    <header>
        <img src="https://placehold.co/1450x700" alt="Banner" class="w-full">
    </header>

    <!-- Main Content -->
    <main class="py-8">
        <div class="container mx-auto w-4/5">
            <!-- Trending Books Section with Sliding Effect -->
            <section class="mb-28">
                <h2 class="text-5xl font-semibold mb-6 text-center text-[#6B705C]">Trending Books</h2>
                <div class="relative overflow-hidden" x-data="{ currentIndex: 0 }">
                    <div class="flex transition-transform duration-700" :style="'transform: translateX(-' + currentIndex * 50 + '%)'" :class="{'justify-center': {{ count($trendingBooks) }} < 5}">
                        @foreach ($trendingBooks as $book)
                        <div class="min-w-1/2 p-2">
                            <div class="bg-[#DDBEA9] shadow-md rounded-lg overflow-hidden">
                                <img src="{{ $book->picture }}" alt="{{ $book->title }}" class="w-full h-48 object-cover aspect-square">
                                <div class="p-4">
                                    <h3 class="text-xl font-semibold text-[#3E3E3E]">{{ $book->title }}</h3>
                                    <p class="text-[#3E3E3E]">{{ Str::limit($book->description, 150) }}</p>
                                    <a href="/viewloan/{{$book->id}}" class="text-[#6B705C] hover:text-[#CB997E] mt-2 block">Read More</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button @click="currentIndex = (currentIndex === 0) ? {{ count($trendingBooks) - 1 }} : currentIndex - 1" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-[#6B705C] text-white px-3 py-2 rounded-full">Prev</button>
                    <button @click="currentIndex = (currentIndex === {{ count($trendingBooks) - 1 }}) ? 0 : currentIndex + 1" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-[#6B705C] text-white px-3 py-2 rounded-full">Next</button>
                </div>
            </section>

            <!-- Recommended Books Section with Hover Effect -->
            <section class="mb-28">
                <h2 class="text-5xl font-semibold mb-6 text-center text-[#6B705C]">Recommended Books</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($recommendedBooks as $book)
                    <div class="bg-[#DDBEA9] shadow-md rounded-lg overflow-hidden transition-transform duration-300 transform hover:scale-105">
                        <img src="{{ $book->picture }}" alt="{{ $book->title }}" class="w-full h-48 object-cover aspect-square">
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-[#3E3E3E]">{{ $book->title }}</h3>
                            <p class="text-[#3E3E3E]">{{ Str::limit($book->description, 150) }}</p>
                            <a href="/viewloan/{{$book->id}}" class="text-[#6B705C] hover:text-[#CB997E] mt-2 block">Read More</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- User Testimonials Section with Sliding Effect -->
            <section class="mb-28">
                <h2 class="text-5xl font-semibold mb-6 text-center text-[#6B705C]">User Testimonials</h2>
                <div class="relative overflow-hidden" x-data="{ currentTestimonial: 0 }">
                    <div class="flex transition-transform duration-700" :style="'transform: translateX(-' + currentTestimonial * 100 + '%)'">
                        @foreach ($testimonials as $index => $testimonial)
                        <div class="min-w-full flex justify-center items-center">
                            <div class="w-4/5 bg-[#DDBEA9] shadow-md rounded-lg p-4 flex items-center">
                                <img src="{{ $testimonial->loan->book->picture }}" alt="{{ $testimonial->loan->book->title }}" class="w-24 h-24 object-cover aspect-square mr-4">
                                <div>
                                    <p class="text-[#3E3E3E]">{{ $testimonial->text }}</p>
                                    <p class="text-sm text-[#3E3E3E] mt-2">- {{ $testimonial->user->name }} on <strong>{{ $testimonial->loan->book->title }}</strong></p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button @click="currentTestimonial = (currentTestimonial === 0) ? {{ count($testimonials) - 1 }} : currentTestimonial - 1" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-[#6B705C] text-white w-10 h-10 rounded-full flex items-center justify-center">Prev</button>
                    <button @click="currentTestimonial = (currentTestimonial === {{ count($testimonials) - 1 }}) ? 0 : currentTestimonial + 1" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-[#6B705C] text-white w-10 h-10 rounded-full flex items-center justify-center">Next</button>
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