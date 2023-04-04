<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            投稿編集
        </h2>
    </x-slot>

    <section class="text-gray-600 body-font relative">
      <div class="container px-5 py-5 mx-auto">
        <div class="flex flex-col text-center w-full mb-12">
          <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-indigo-900 text-bold">アウトプット｜編集</h1>
          <p class="lg:w-2/3 mx-auto leading-relaxed text-base">学んだことをアウトプットして脳に定着させよう！</p>
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
                <input type="text" id="title" name="title" value="{{ $post->title }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
              </div>
            </div>
            <div class="p-2 w-full">
              <div class="relative">
                <label for="category_id" class="leading-7 text-sm text-gray-600">カテゴリ</label></br>
                <select id="category_id" name="category_id" class="w-1/2 rounded border">
                  @foreach($category_lists as $category_list)
                    <option value="{{ $category_list['id'] }}">{{ $category_list['category_L'] }} | {{ $category_list['category_S'] }}</option>
                  @endforeach
                  <option value="ex">その他</option>
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
                <textarea id="comment" name="comment" value="{{ $post->comment }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
              </div>
            </div>
            <div class="p-2 w-full">
              <div class="relative">
                <label for="files" class="leading-7 text-sm text-gray-600">ファイル添付</label>
                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, MP3 or MP4(MAX. 800x400px)</p>
                        </div>
                        <input id="dropzone-file" name="files[]" type="file" class="hidden" multiple>
                    </label>
                </div> 
                <input type="files" id="dropzone-file" name="files" class="hidden" multiple/>
                <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}" >
            </div>
            <div class="p-2 w-full flex justify-around mt-4">
              <button type="button" onclick="location.href='{{ route('posts.show', [ $post->id ]) }}'" class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
              <button type="submit" class="text-white bg-indigo-900 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新</button>
            </div>
                     
          </div>
        </form> 
        </div>
      </div>
    </section>

</x-app-layout>