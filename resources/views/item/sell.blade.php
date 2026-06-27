@extends('layouts.app')

@section('content')
    <main class="bg-white min-h-screen pb-[80px]">
        <section class="w-[680px] mx-auto pt-[51px]">
            <h1 class="text-[36px] font-bold text-center">
                商品の出品
            </h1>

            <form action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data" class="mt-[43px]">
                @csrf

                @if ($errors->any())
                    <div class="text-red-500 mt-4">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                
                <div>
                    <label class="block text-[24px] font-bold mb-[12px]">
                        商品画像
                    </label>

                    <div
                        class="w-full h-[150px] border border-dashed border-[#5F5F5F] rounded-[4px] flex items-center justify-center">
                        <label for="image_path"
                            class="w-[165px] h-[43px] border-2 border-[#FF5555] rounded-[10px] text-[#FF5555] text-[16px] font-bold flex items-center justify-center cursor-pointer">
                            画像を選択する
                        </label>

                        <input id="image_path" type="file" name="image_path" class="hidden">
                    </div>

                    @error('image_path')
                        <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-[70px]">
                    <h2 class="text-[30px] font-bold text-[#5F5F5F] border-b border-[#5F5F5F] pb-[12px]">
                        商品の詳細
                    </h2>

                    <div class="mt-[28px]">
                        <label class="block text-[24px] font-bold mb-[20px]">
                            カテゴリー
                        </label>

                        <div class="flex flex-wrap gap-[16px]">
                            @foreach ($categories as $category)
                                <label>
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="hidden peer">
                                    <span
                                        class="px-[18px] py-[6px] border border-[#FF5555] rounded-[20px] text-[#FF5555] text-[15px] font-bold cursor-pointer peer-checked:bg-[#FF5555] peer-checked:text-white">
                                        {{ $category->name }}
                                    </span>
                                </label>
                            @endforeach
                        </div>

                        @error('categories')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-[60px]">
                        <label class="block text-[24px] font-bold mb-[12px]">
                            商品の状態
                        </label>

                        <select name="condition"
                            class="w-full h-[45px] border border-[#5F5F5F] rounded-[4px] px-[12px] text-[16px]">
                            <option value="">選択してください</option>
                            <option value="1" {{ old('condition') == 1 ? 'selected' : '' }}>良好</option>
                            <option value="2" {{ old('condition') == 2 ? 'selected' : '' }}>目立った傷や汚れなし</option>
                            <option value="3" {{ old('condition') == 3 ? 'selected' : '' }}>やや傷や汚れあり</option>
                            <option value="4" {{ old('condition') == 4 ? 'selected' : '' }}>状態が悪い</option>
                        </select>

                        @error('condition')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-[69px]">
                    <h2 class="text-[30px] font-bold text-[#5F5F5F] border-b border-[#5F5F5F] pb-[12px]">
                        商品名と説明
                    </h2>

                    <div class="mt-[30px]">
                        <label class="block text-[24px] font-bold mb-[8px]">
                            商品名
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full h-[45px] border border-[#5F5F5F] rounded-[4px] px-[12px] text-[20px]">
                        @error('name')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-[36px]">
                        <label class="block text-[24px] font-bold mb-[8px]">
                            ブランド名
                        </label>
                        <input type="text" name="brand_name" value="{{ old('brand_name') }}"
                            class="w-full h-[45px] border border-[#5F5F5F] rounded-[4px] px-[12px] text-[20px]">
                    </div>

                    <div class="mt-[39px]">
                        <label class="block text-[24px] font-bold mb-[8px]">
                            商品の説明
                        </label>
                        <textarea name="description"
                            class="w-full h-[125px] border border-[#5F5F5F] rounded-[4px] px-[12px] py-[8px] text-[20px]">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-[36px]">
                        <label class="block text-[24px] font-bold mb-[8px]">
                            販売価格
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xl">
                                ¥
                            </span>

                            <input 
                                type="number" name="price" 
                                value="{{ old('price') }}"
                                class="w-full h-[45px] border border-[#5F5F5F] rounded-[4px] pl-[45px] pr-[12px] text-[20px]"
                            >
                        </div>

                        @error('price')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <button type="submit"
                    class="w-full h-[60px] mt-[118px] bg-[#FF5555] rounded-[5px] text-white text-[26px] font-bold">
                    出品する
                </button>
            </form>
        </section>
    </main>
@endsection