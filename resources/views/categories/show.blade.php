<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $category->category_L }} | {{ $category->category_S }}
        </h2>
    </x-slot>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-5 mx-auto">
            <div class="text-center mb-12">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-indigo-900 text-bold">{{ $category->category_L }} | {{ $category->category_S }}</h1>
            </div>
            <div class="flex flex-wrap -m-4">
              @if($posts==NULL)
              <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-indigo-900 text-bold">カテゴリに投稿はありません。<h1>
              @elseif  
                @foreach($posts as $post)
                <div class="p-4 lg:w-1/4 md:w-1/2">
                  <div class="h-full flex flex-col items-center text-center">
                    <img alt="team" class="flex-shrink-0 rounded-lg w-full h-56 object-cover object-center mb-4" src="https://dummyimage.com/200x200">
                    <div class="w-full">
                      <h2 class="title-font font-medium text-lg text-gray-900">{{ $post->title }}</h2>
                      <h3 class="text-gray-500 mb-3">{{ $post->user_name }}</h3>
                      <p class="mb-4 line-clamp-3">{{ $post->comment }}</p>
                    </div>
                  </div>
                </div>
                @endforeach
              @endif
            </div>
        </div>
    </section>
</x-app-layout>