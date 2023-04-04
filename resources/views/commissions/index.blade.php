<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            リクエスト一覧
        </h2>
    </x-slot>


    <section class="text-gray-600 body-font">
        <div class="container px-5 py-5 mx-auto">
            <div class="text-center mb-12">
                <x-flash-message status="session('status')" />
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-indigo-900 text-bold">リクエスト一覧</h1>
            </div>
            <div class="flex flex-wrap -mx-4 -my-8">
                @foreach($commissions as $commission)
                <div class="py-8 px-4 lg:w-1/3">
                    <div class="h-full flex items-start">
                        <div class="flex-grow pl-6 bg-indigo-100">
                            <h2 class="tracking-widest text-xs title-font font-medium text-indigo-900 mb-1">{{ $commission['category_L']}} | {{ $commission['category_S']}}</h2>
                            <h1 class="title-font text-xl font-medium text-gray-900 mb-3">{{ $commission['title']}}</h1>
                            <p class="leading-relaxed mb-5">{{ $commission['comment']}}</p>
                            <a href="{{ route('posts.create') }}" class="flex flex-row-reverse items-center pb-2 pr-4">
                                <button type="submit" class="text-white bg-indigo-900 border-0 py-1 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lx">投稿</button>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>           
        </div>
    </section>
</x-app-layout>