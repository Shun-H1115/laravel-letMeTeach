<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <section class="text-gray-600 body-font">
      <div class="container px-5 py-8 mx-auto">
        <div class="flex flex-wrap w-full mb-20 border-b-4 border-indigo-200">
          <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">{{ $post->title }}</h1>
          </div>
        </div>  
        <div class="flex items-center lg:w-3/5 mx-auto border-b-4 pb-10 mb-10 border-gray-200 sm:flex-row flex-col">
          <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
            <p class="lg:w-1/2 w-full leading-relaxed">{{ $post->comment }}</p>
          </div>
        </div>
        <div class="flex flex-wrap -m-4">
          @foreach($images as $image)
            <div class="xl:w-1/2 md:w-1 p-4">           
              <div class="bg-gray-100 p-2 rounded-lg">
                <img class="rounded w-full object-cover object-center mb-2" alt="hero" src="{{ asset($image['file_path']) }}">
              </div>     
            </div>
          @endforeach
        </div>

        <div class="flex flex-wrap -m-4">
          @foreach($movies as $movie)
            <div class="xl:w-1/2 md:w-1 p-4">
              <div class="bg-gray-100 p-6 rounded-lg">
                <video controls autoplay muted playsinline src="{{ asset($movie['file_path']) }}"></video>
              </div>    
            </div>
          @endforeach
        </div>

        <div class="flex flex-wrap -m-4">
          @foreach($voices as $voice)
            <div class="xl:w-1/2 md:w-1 p-4">
              <div class="bg-gray-100 p-6 rounded-lg">
                <audio controls src="{{ asset($voice['file_path']) }}"></audio>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      <div class="container px-5 py-8 mx-auto">
        <div class="flex flex-wrap w-full mb-20 border-b-4 border-indigo-200">
          <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">レビュー</h1>
          </div>
          <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
            @if($reviews_avg>4.5)
              <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">平均評価：<span class="text-yellow-600">★★★★★</span></p>
            @elseif($reviews_avg>3.5)
              <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">平均評価：<span class="text-yellow-600">★★★★☆</span></p>
            @elseif($reviews_avg>2.5)
              <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">平均評価：<span class="text-yellow-600">★★★☆☆</span></p>
            @elseif($reviews_avg>1.5)
              <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">平均評価：<span class="text-yellow-600">★★☆☆☆</span></p>
            @elseif($reviews_avg>0.5)
              <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">平均評価：<span class="text-yellow-600">★☆☆☆☆</span></p>
            @elseif($reviews_avg!=NULL)
              <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">平均評価：<span class="text-yellow-600">☆☆☆☆☆</span></p>
            @endif
          </div>
        </div>
        @if($reviews==[])
        <h2 class="sm:text-2xl text-xl font-medium title-font mb-4">レビューはありません。<h2>
        @else
          @foreach($reviews as $review)
            <div class="flex items-center lg:w-3/5 mx-auto border-b pb-10 mb-10 border-gray-200 sm:flex-row flex-col">
              <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
                <h2 class="text-gray-900 text-lg title-font font-medium mb-2">{{ $review['title'] }} | <span class="text-xs">投稿者：</span>{{ $review['user_name'] }}</h2>
                @if($review['rating_score']>4.5)
                  <p class="lg:w-1/2 w-full leading-relaxed text-yellow-600">★★★★★</p>
                @elseif($review['rating_score']>3.5)
                  <p class="lg:w-1/2 w-full leading-relaxed text-yellow-600">★★★★☆</p>
                @elseif($review['rating_score']>2.5)
                  <p class="lg:w-1/2 w-full leading-relaxed text-yellow-600">★★★☆☆</p>
                @elseif($review['rating_score']>1.5)
                  <p class="lg:w-1/2 w-full leading-relaxed text-yellow-600">★★☆☆☆</p>
                @elseif($review['rating_score']>0.5)
                  <p class="lg:w-1/2 w-full leading-relaxed text-yellow-600">★☆☆☆☆</p>
                @else
                  <p class="lg:w-1/2 w-full leading-relaxed text-yellow-600">☆☆☆☆☆</p>
                @endif
                <p class="leading-relaxed text-base">{{ $review['comment'] }}</p>
                @if($review['user_id'] == "$user->id")
                  <button type="button" onclick="location.href='{{ route('posts.reviews.edit', ['post' => $post->id, 'review' => $review['id']]) }}'" class="text-white bg-indigo-900 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">編集</button>
                  <button type="button" onclick="location.href='{{ route('posts.reviews.destroy', ['post' => $post->id, 'review' => $review['id']]) }}'" class="text-white bg-orange-400 border-0 py-2 px-8 focus:outline-none hover:bg-orange-200 rounded text-lg">削除</button>
                @endif
              </div>
            </div>
          @endforeach
        @endif
      </div>

      <div class="p-2 w-full flex justify-around mx-auto">
        <button type="button" onclick="location.href='{{ route('categories.show', [$post->id]) }}'" class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
        @if($post->user_id==$user->id)
          <button type="button" onclick="location.href='{{ route('posts.edit', [$post->id]) }}'" class="text-white bg-indigo-900 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">編集</button>
          <button type="button" onclick="location.href='{{ route('posts.destroy', [$post->id]) }}'" class="text-white bg-orange-400 border-0 py-2 px-8 focus:outline-none hover:bg-orange-200 rounded text-lg">削除</button>
        @else
          <button type="button" onclick="location.href='{{ route('posts.reviews.create', [$post->id]) }}'" class="text-white bg-indigo-900 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">レビュー</button>
        @endif
      </div>
    </section>
</x-app-layout>