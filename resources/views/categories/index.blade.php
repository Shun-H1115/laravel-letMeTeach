<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            カテゴリ一覧
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
                        <div><button type="submit" class="ml-auto text-white bg-indigo-900 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">検索</button>
                    </div>
                </div>
            </div>
        </form>
    </x-slot>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-5 mx-auto">
            <div class="text-center mb-12">
                <x-flash-message status="session('status')" />
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-indigo-900 text-bold">カテゴリ一覧</h1>
            </div>
            <div class="flex flex-wrap -m-4">
            @for ($i = 0; $i < $num_l; $i++)    
            <div class="p-4 lg:w-1/4 sm:w-1/2 w-full">
                <h2 class="font-medium title-font tracking-widest text-gray-900 mb-4 text-sm text-center sm:text-left">{{ $category_l_lists[$i][1] }}</h2>
                <nav class="flex flex-col sm:items-start sm:text-left text-center items-center -mb-1 space-y-2.5">
                @for ($j = $category_l_lists[$i][0]; $j < $category_l_lists[$i+1][0]; $j++)
                <a href="{{ route('categories.show', $category_lists[$j]['id']) }}">
                    <span class="bg-indigo-100 text-indigo-500 w-4 h-4 mr-2 rounded-full inline-flex items-center justify-center">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" class="w-3 h-3" viewBox="0 0 24 24">
                        <path d="M20 6L9 17l-5-5"></path>
                    </svg>
                    </span>{{ $category_lists[$j]['category_S'] }}
                </a>
                @endfor
                </nav>
            </div>
            @endfor
        </div>
    </section>
</x-app-layout>