<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            投稿編集
        </h2>
    </x-slot>

    <section class="text-gray-600 body-font relative">
      <div class="container px-5 py-5 mx-auto">
        <div class="flex flex-col text-center w-full mb-12">
          <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-indigo-900 text-bold">リクエスト｜編集</h1>
          <p class="lg:w-2/3 mx-auto leading-relaxed text-base">教えてほしいことをリクエストしよう！</p>
        </div>
        <div class="lg:w-1/2 md:w-2/3 mx-auto">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="post" action="{{ route('posts.update', ['post' => $post->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
          <div class="flex flex-wrap -m-2">
            <div class="p-2 w-full">
              <div class="relative">
                <label for="title" class="leading-7 text-sm text-gray-600">タイトル</label>
                <input type="text" id="title" name="title" value="{{ $commission_edit->title }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
              </div>
            </div>
            <div class="p-2 w-full">
              <div class="relative">
                <label for="category_id" class="leading-7 text-sm text-gray-600">カテゴリ</label></br>
                <select id="category_id" name="category_id" class="w-1/2 rounded border">
                  <option value="0">カテゴリを新規設定する</option>
                  @foreach($category_lists as $category_list)
                    <option value="{{ $category_list['id'] }}">{{ $category_list['category_L'] }} | {{ $category_list['category_S'] }}</option>
                  @endforeach
                </select></br>
                <div class="px-4">
                  <label for="category_id" class="leading-7 text-sm text-gray-600 border-l-4 px-2">カテゴリを新規設定する</label></br>
                  <label for="category_L" class="leading-5 text-sm text-gray-600 px-2">カテゴリ大</label></br>
                  <input type="text" id="category_L" name="category_L" value="{{ old('category_L') }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                  <label for="category_S" class="leading-5 text-sm text-gray-600 px-2">カテゴリ小</label></br>
                  <input type="text" id="category_S" name="category_S" value="{{ old('category_S') }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
              </div>
            </div>
            <div class="p-2 w-full">
              <div class="relative">
                <label for="comment" class="leading-7 text-sm text-gray-600">内容</label>
                <textarea id="comment" name="comment" value="{{ $commission_edit->comment }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
              </div>
            </div>
            <div class="p-2 w-full flex justify-around mt-4">
              <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}" >
              <button type="button" onclick="location.href='{{ route('categories.index') }}'" class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
              <button type="submit" class="text-white bg-indigo-900 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新</button>
            </div>
                     
          </div>
        </form> 
        </div>
      </div>
    </section>

</x-app-layout>