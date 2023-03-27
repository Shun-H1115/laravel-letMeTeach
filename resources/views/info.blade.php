<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            レミティーとは
        </h2>
    </x-slot>

    <section class="text-gray-600 body-font">
        <div class="container px-5 pt-24 pb-12 mx-auto bg-blue-100">
            <div class="flex flex-col text-center w-full mb-12">
                <h1 class="sm:text-3xl text-4xl font-medium title-font mb-4 text-indigo-900 text-bold">レミティー</h1>
                <h1 class="sm:text-3xl text-4xl font-medium title-font mb-4 text-bold">科学に基づいた学習サイト</h1>
            </div>
        </div>
    
        <div class="container px-5 pt-8 pb-24 mx-auto">
            <div class="flex flex-col">
                <div class="flex flex-col text-center w-full mb-12">
                    <h1 class="sm:text-3xl text-4xl font-medium title-font mb-2 text-bold">レミティーの<span class="text-4xl text-indigo-900">３</span>つの特徴</h1>
                </div>
            </div>
            <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4">
                <div class="p-4 md:w-1/3 sm:mb-0 mb-6">
                    <h2 class="title-font text-2xl font-medium text-indigo-900">一生身につくアウトプット</h2>
                    <div class="w-full h-2 bg-gradient-to-r from-indigo-900 to-gray-100 ...">
                    </div>
                    <div class="rounded-lg h-64 overflow-hidden pt-4">
                        <img alt="content" class="object-cover object-center h-full w-full bg-white" src="{{ asset('images/info01.png') }}">
                    </div>
                    <p class="text-base leading-relaxed mt-2">アメリカ国立訓練研究所の研究で、<span class="text-indigo-900 text-bold underline">最も定着率が高い学習方法は人に教えること</span>であることが示された。</br>学んだことを人に教えて一生使える技術にしよう！</p>
                </div>
                <div class="p-4 md:w-1/3 sm:mb-0 mb-6">
                    <h2 class="title-font text-2xl font-medium text-indigo-900">認知特性に合わせたインプット</h2>
                    <div class="w-full h-2 bg-gradient-to-r from-indigo-900 to-gray-100 ...">
                    </div>
                    <div class="rounded-lg h-64 overflow-hidden pt-4">
                        <img alt="content" class="object-cover object-center h-full w-full bg-white" src="{{ asset('images/info02.png') }}">
                    </div>
                    <p class="text-base leading-relaxed mt-2">人の認知特性は3タイプに分けられる。</br>自分の<span class="text-indigo-900 text-bold underline">タイプに合わせた学習方法</span>で効率的なインプットが可能に！</p>
                </div>
                <div class="p-4 md:w-1/3 sm:mb-0 mb-6">
                    <h2 class="title-font text-2xl font-medium text-indigo-900">評価機能で教える力が向上</h2>
                    <div class="w-full h-2 bg-gradient-to-r from-indigo-900 to-gray-100 ...">
                    </div>
                    <div class="rounded-lg h-64 overflow-hidden pt-4">
                        <img alt="content" class="object-cover object-center h-full w-full bg-white" src="{{ asset('images/info03.png') }}">
                    </div>
                    <p class="text-base leading-relaxed mt-2">アウトプットに対してフィードバックをもらおう！</br><span class="text-indigo-900 text-bold underline">フィードバックを取り入れてアウトプットをよりわかりやすいもの</span>に修正しよう！</p>
                </div>              
            </div>
        </div>
    </section>


</x-app-layout>