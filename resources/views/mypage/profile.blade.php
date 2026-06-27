@extends('layouts.app')

@section('content')
    <main class="bg-white min-h-screen">
        <section class="w-[680px] mx-auto pt-[70px]">
            <h1 class="text-[36px] font-bold text-center">
                プロフィール設定
            </h1>

            <form action="{{ route('mypage.profile.update') }}" method="POST" enctype="multipart/form-data"
                class="mt-[47px]">
                @csrf
                @method('PATCH')

                <div class="flex items-center gap-[40px]">
                    <div class="w-[150px] h-[150px] rounded-full bg-[#D9D9D9] overflow-hidden">
                        @if ($item->image_path)
                            @if (str_starts_with($item->image_path, 'http'))
                                <img src="{{ $item->image_path }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                            @endif
                        @endif
                    </div>

                    <label for="profile_image"
                        class="w-[179px] h-[49px] border-2 border-[#FF5555] rounded-[10px] text-[#FF5555] text-[20px] font-bold flex items-center justify-center cursor-pointer">
                        画像を選択する
                    </label>

                    <input id="profile_image" type="file" name="profile_image" class="hidden">
                </div>

                @error('profile_image')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                @enderror

                <div class="mt-[76px]">
                    <label class="block text-[24px] font-bold mb-[8px]">
                        ユーザー名
                    </label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                        class="w-full h-[55px] border border-[#5F5F5F] rounded-[4px] px-[15px] text-[24px]">
                    @error('name')
                        <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-[35px]">
                    <label class="block text-[24px] font-bold mb-[8px]">
                        郵便番号
                    </label>
                    <input type="text" name="postal_code" value="{{ old('postal_code', Auth::user()->postal_code) }}"
                        class="w-full h-[55px] border border-[#5F5F5F] rounded-[4px] px-[15px] text-[24px]">
                    @error('postal_code')
                        <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-[35px]">
                    <label class="block text-[24px] font-bold mb-[8px]">
                        住所
                    </label>
                    <input type="text" name="address" value="{{ old('address', Auth::user()->address) }}"
                        class="w-full h-[55px] border border-[#5F5F5F] rounded-[4px] px-[15px] text-[24px]">
                    @error('address')
                        <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-[35px]">
                    <label class="block text-[24px] font-bold mb-[8px]">
                        建物名
                    </label>
                    <input type="text" name="building" value="{{ old('building', Auth::user()->building) }}"
                        class="w-full h-[55px] border border-[#5F5F5F] rounded-[4px] px-[15px] text-[24px]">
                </div>

                <button type="submit"
                    class="w-full h-[60px] mt-[67px] bg-[#FF5555] rounded-[5px] text-white text-[26px] font-bold">
                    更新する
                </button>
            </form>
        </section>
    </main>
@endsection