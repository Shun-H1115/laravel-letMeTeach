<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            投稿一覧
        </h2>
        <form method="get" action="{{ route('posts.index')}}">
            <div class="lg:flex lg:justify-around">
                <div class="lg:flex items-center">
                    <select name="category" class="mb-2 lg:mb-0 lg:mr-2">カテゴリ
                        <option value="0" @if(\Request::get('category') === '0') selected @endif>全て</option>
                        @for ($i = 0; $i < $num_l; $i++)
                        <optgroup label="{{ $category_l_lists[$i][1] }}">
                            @for ($j = $category_l_lists[$i][0]; $j < $category_l_lists[$i+1][0]; $j++)
                            <option value="{{ $category_lists[$j]['id'] }}" @if(\Request::get('category') == $category_lists[$j]['id']) selected @endif>
                                {{ $category_lists[$j]['category_S']}}
                            </option>
                            @endfor
                        @endfor
                    </select>
                    <div class="flex space-x-2 items-center">
                        <div><input name="keyword" class="border border-gray-500 py-2" placeholder="キーワードを入力"></div>
                        <div><button class="ml-auto text-white bg-indigo-900 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">検索</button>
                    </div>
                </div>
            </div>
        </form>
    </x-slot>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-5 mx-auto">
            <div class="text-center mb-12">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-indigo-900 text-bold">投稿一覧</h1>
            </div>
            <div class="flex flex-wrap -m-4">
                @if($posts==[])
                <h2 class="sm:text-2xl text-xl font-medium title-font mb-4">カテゴリに投稿はありません。<h2>
                @else
                    @foreach($posts as $post)
                    <div class="p-4 lg:w-1/4 md:w-1/2">
                    <a href="{{ route('posts.show', [ $post['id'] ])}}">
                        <div class="h-full flex flex-col items-center text-center">
                        @if($post['file_path'])
                            <img alt="image" class="flex-shrink-0 rounded-lg w-full h-56 object-cover object-center mb-4" src="{{ Storage::get($post['file_path']) }}">
                        @else
                            <img alt="image" class="flex-shrink-0 rounded-lg w-full h-56 object-cover object-center mb-4" src="{{ asset('/images/noImage.jpeg') }}">
                        @endif
                        <div class="w-full">
                            <h2 class="title-font font-medium text-lg text-gray-900">{{ $post['title'] }} | <span class="text-xs">投稿者：</span>{{ $post['user_name'] }}</h2>
                            <h3 class="text-gray-500 mb-3"></h3>
                            <p class="mb-4 line-clamp-3">{{ $post['comment'] }}</p>
                        </div>
                        </div>
                    </a>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
</x-app-layout>