<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            レミティー
        </h2>
    </x-slot>

    <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-10 py-12 mx-auto">
            <div class="flex flex-col text-center w-full mb-8">
                <h1 class="sm:text-3xl text-2xl font-medium title-font my-4 text-indigo-900">ランキング</h1>
            </div>
            @foreach($rankings as $ranking)
            <div class="-my-8 divide-y-2 divide-gray-100">
                <div class="py-8 flex flex-wrap md:flex-nowrap">
                    <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                        <span class="font-semibold title-font text-gray-700">第{{ $ranking['rank'] }}位</span>
                        @if($ranking['rating_score']>4.5)
                            <p class="lg:w-1/2 w-full leading-relaxed text-yellow-600">★★★★★</p>
                        @elseif($ranking['rating_score']>3.5)
                            <p class="lg:w-1/2 w-full leading-relaxed text-yellow-600">★★★★☆</p>
                        @elseif($ranking['rating_score']>2.5)
                            <p class="lg:w-1/2 w-full leading-relaxed text-yellow-600">★★★☆☆</p>
                        @elseif($ranking['rating_score']>1.5)
                            <p class="lg:w-1/2 w-full leading-relaxed text-yellow-600">★★☆☆☆</p>
                        @elseif($ranking['rating_score']>0.5)
                            <p class="lg:w-1/2 w-full leading-relaxed text-yellow-600">★☆☆☆☆</p>
                        @else
                            <p class="lg:w-1/2 w-full leading-relaxed text-yellow-600">☆☆☆☆☆</p>
                        @endif
                    </div>
                    <div class="md:flex-grow">
                        <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">{{ $ranking['title'] }}</h2>
                        <p class="leading-relaxed">{{ $ranking['comment'] }}</p>
                        <a href="{{ route('posts.show', ['post' => $ranking['id']])}}" class="text-indigo-500 inline-flex items-center mt-4">More
                            <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M12 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

</x-app-layout>