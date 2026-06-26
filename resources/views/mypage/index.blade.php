<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品購入画面</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    @extends('layouts.app')
    
    @section('content')
        <main class="bg-white min-h-screen">

            <section class="max-w-[1017px] mx-auto pt-[68px] flex items-center justify-between">
                <div class="flex items-center gap-[87px]">
                    <div class="w-[150px] h-[150px] rounded-full bg-[#D9D9D9] overflow-hidden">
                        @if ($user->profile_image)
                            <img src="{{ asset('storage/' . $user->profile_image) }}" alt=""
                                class="w-full h-full object-cover">
                        @endif
                    </div>

                    <h1 class="text-[36px] font-bold">
                        {{ $user->name }}
                    </h1>
                </div>

                <a href="/mypage.profile"
                    class="w-[310px] h-[59px] border-2 border-[#FF5555] rounded-[10px] text-[#FF5555] text-[20px] font-bold flex items-center justify-center">
                    プロフィールを編集
                </a>
            </section>

            <section class="mt-[77px] border-b border-[#5F5F5F]">
                <div class="flex gap-[52px] pl-[129px] h-[47px] items-center">
                    <a href="{{ route('mypage.index', ['page' => 'sell']) }}"
                        class="text-[24px] font-bold {{ $page !== 'buy' ? 'text-[#FF0000]' : 'text-[#5F5F5F]' }}">
                        出品した商品
                    </a>

                    <a href="{{ route('mypage.index', ['page' => 'buy']) }}"
                        class="text-[24px] font-bold {{ $page === 'buy' ? 'text-[#FF0000]' : 'text-[#5F5F5F]' }}">
                        購入した商品
                    </a>
                </div>
            </section>

            <section class="px-[69px] pt-[34px]">
                <div class="grid grid-cols-4 gap-x-[40px] gap-y-[50px]">
                    @foreach ($items as $item)
                        @if ($item)
                            <a href="{{ route('item.show', $item->id) }}">
                                <div class="w-full">
                                    <div class="aspect-square bg-[#D9D9D9] overflow-hidden">
                                        @if ($item->image_path)
                                            <img src="{{ $item->image_path }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-[24px]">
                                                商品画像
                                            </div>
                                        @endif
                                    </div>

                                    <p class="mt-[8px] text-[20px]">
                                        {{ $item->name }}
                                    </p>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </section>
        </main>
    @endsection

</body>

</html>