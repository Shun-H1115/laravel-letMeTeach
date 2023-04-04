<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            レミティー
        </h2>
    </x-slot>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-20">
                <a href="{{ route('info') }}" class="rounded-lg overflow-hidden pt-4">
                    <img alt="content" class="rounded lg:w-2/3 mx-auto leading-relaxed bg-gray-200" src="{{ asset('images/beginner.png') }}">
                </a>
                <h1 class="sm:text-3xl text-2xl font-medium title-font my-4 text-indigo-900">レミティー</h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">勉強しているけど、なかなか覚えられないという経験はありませんか？</br>
                    勉強した内容を効率よく脳に定着させるには能動的なアウトプットが有効です。</br>
                    このサイトを利用して学んだことを確実に脳に定着させましょう！</p>
            </div>
            <div class="flex flex-wrap">
                <div class="xl:w-1/4 lg:w-1/2 md:w-full px-8 py-6 border-l-2 border-gray-200 border-opacity-60">
                    <h2 class="text-lg sm:text-xl text-gray-900 font-medium title-font">カテゴリ</h2>
                    <div class="w-full h-1 bg-gradient-to-r from-indigo-900 to-gray-100 mb-2 ...">
                    </div>
                    <p class="leading-relaxed text-base mb-4">アウトプットはカテゴリ別に分かれています。カテゴリ一覧から自分の知りたい内容を探しましょう！</p>
                    <a href="{{ route('categories.index') }}" class="text-indigo-500 inline-flex items-center">カテゴリ一覧
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                    </a>
                </div>
                <div class="xl:w-1/4 lg:w-1/2 md:w-full px-8 py-6 border-l-2 border-gray-200 border-opacity-60">
                    <h2 class="text-lg sm:text-xl text-gray-900 font-medium title-font">ランキング</h2>
                    <div class="w-full h-1 bg-gradient-to-r from-indigo-900 to-gray-100 mb-2 ...">
                    </div>
                    <p class="leading-relaxed text-base mb-4">ランキング上位のアウトプットを参考に、教え方も身につけましょう！</p>
                    <a href="{{ route('posts.ranking') }}" class="text-indigo-500 inline-flex items-center">ランキングを見る
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                    </a>
                </div>
                <div class="xl:w-1/4 lg:w-1/2 md:w-full px-8 py-6 border-l-2 border-gray-200 border-opacity-60">
                    <h2 class="text-lg sm:text-xl text-gray-900 font-medium title-font">アウトプット</h2>
                    <div class="w-full h-1 bg-gradient-to-r from-indigo-900 to-gray-100 mb-2 ...">
                    </div>
                    <p class="leading-relaxed text-base mb-4">学んだことはアウトプットして脳に定着させよう！</p>
                    <a href="{{ route('posts.create') }}" class="text-indigo-500 inline-flex items-center">投稿する
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                    </a>
                </div>
                <div class="xl:w-1/4 lg:w-1/2 md:w-full px-8 py-6 border-l-2 border-gray-200 border-opacity-60">
                    <h2 class="text-lg sm:text-xl text-gray-900 font-medium title-font">リクエスト</h2>
                    <div class="w-full h-1 bg-gradient-to-r from-indigo-900 to-gray-100 mb-2 ...">
                    </div>
                    <p class="leading-relaxed text-base mb-4">知りたい内容のアウトプットがないときはリクエストしてみよう！</p>
                    <a href="{{ route('commissions.create') }}" class="text-indigo-500 inline-flex items-center">リクエストする
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>


</x-app-layout>