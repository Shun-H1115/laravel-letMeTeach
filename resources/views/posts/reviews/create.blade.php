<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post_create->title }}
        </h2>
    </x-slot>

    <section class="text-gray-600 body-font relative">
      <div class="container px-5 py-5 mx-auto">
        <div class="flex flex-col text-center w-full mb-12">
          <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-indigo-900 text-bold"><span class="underline">{{ $post_create->title }}</span>をレビュー</h1>
          <p class="lg:w-2/3 mx-auto leading-relaxed text-base">投稿で学んだことを共有しよう！</p>
        </div>
        <div class="lg:w-1/2 md:w-2/3 mx-auto">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="post" action="{{ route('posts.reviews.store', [$post_create->id]) }}">
            @csrf
          <div class="flex flex-wrap -m-2">
            <div class="p-2 w-full">
              <div class="relative">
                <label for="title" class="leading-7 text-sm text-gray-600 border-l-4 border-indigo-900 px-1">タイトル</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
              </div>
            </div>
            <div class="p-2 w-full">
              <div class="relative">
                <label for="rating_score" class="leading-7 text-sm text-gray-600 border-l-4 border-indigo-900 px-1">評価</label></br>
                <select id="rating_score" name="rating_score" class="w-1/2 rounded border">
                  <option value=1 class="text-yellow-600">★☆☆☆☆</option>
                  <option value=2 class="text-yellow-600">★★☆☆☆</option>
                  <option value=3 class="text-yellow-600">★★★☆☆</option>
                  <option value=4 class="text-yellow-600">★★★★☆</option>
                  <option value=5 class="text-yellow-600">★★★★★</option>
                </select></br>
              </div>
            </div>
            <div class="p-2 w-full">
              <div class="relative">
                <label for="comment" class="leading-7 text-sm text-gray-600 border-l-4 border-indigo-900 px-1">内容</label>
                <textarea id="comment" name="comment" value="{{ old('comment') }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
              </div>
            </div>
            </div>
            <div class="p-2 w-full flex justify-around mt-4">
              <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}" >  
              <input type="hidden" id="post_id" name="post_id" value="{{ $post_create->id }}" >  
              <button type="button" onclick="location.href='{{ route('posts.show', [$post_create->id]) }}'" class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
              <button type="submit" class="text-white bg-indigo-900 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">投稿</button>
            </div>                    
          </div>
        </form> 
        </div>
      </div>
    </section>

</x-app-layout>