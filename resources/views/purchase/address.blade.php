<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品購入画面</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header class="w-[1512px] h-[80px] bg-black ">
        <div class="h-full px-[40px] flex items-center justify-between">

            <!--ロゴ-->
            <img src="{{ asset('img/COACHTECH-logo.png') }}" alt="COACHTECH" class="w-[370px] h-[36px] object-contain">

            <!--検索-->
            <div class="w-[563px] h-[80px] flex items-center justify-center">

                <input type="text" placeholder="なにをお探しですか？" class="
                                w-[500px]
                                h-[50px]
                                rounded-[5px]
                                px-[31px]
                                text-[24px]
                                bg-white
                                text-black
                                placeholder:text-black
                                focus:outline-none
                            ">

            </div>

            <!--ナビ-->
            <div class="w-[463px] flex items-center justify-end gap-[40px]">
                @guest
                    <a href="{{ route('login') }}" class="text-[24px] text-white">
                        ログイン
                    </a>
                @endguest

                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-[24px] text-white">
                            ログアウト
                        </button>
                    </form>
                @endauth

                <a href="#" class="text-[24px] text-white">
                    マイページ
                </a>

                <a href="#"
                    class="w-[100px] h-[50px] bg-white text-black text-[24px] rounded-[4px] flex items-center justify-center">
                    出品
                </a>
            </div>

        </div>
    </header>
<body>

    <main class="w-[1512px] mx-auto">
        <h1 class="mt-[40px] text-center text-[36px] font-bold">
            住所の変更
        </h1>

        <form action="{{ route('purchase.address.update', $item) }}" method="POST" class="w-[680px] mx-auto mt-[70px]">
            @csrf
            @method('PATCH')

            <div>
                <label class="block text-[24px] font-bold">
                    郵便番号
                </label>

                <input type="text" name="postal_code" value="{{ old('postal_code', Auth::user()->postal_code) }}"
                    class="w-[680px] h-[45px] mt-[8px] border border-[#5F5F5F] rounded-[4px] px-[12px] text-[20px]">

                @error('postal_code')
                    <p class="mt-[6px] text-red-500 text-[16px]">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-[55px]">
                <label class="block text-[24px] font-bold">
                    住所
                </label>

                <input type="text" name="address" value="{{ old('address', Auth::user()->address) }}"
                    class="w-[680px] h-[45px] mt-[8px] border border-[#5F5F5F] rounded-[4px] px-[12px] text-[20px]">

                @error('address')
                    <p class="mt-[6px] text-red-500 text-[16px]">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-[55px]">
                <label class="block text-[24px] font-bold">
                    建物名
                </label>

                <input type="text" name="building" value="{{ old('building', Auth::user()->building) }}"
                    class="w-[680px] h-[45px] mt-[8px] border border-[#5F5F5F] rounded-[4px] px-[12px] text-[20px]">
            </div>

            <button type="submit"
                class="w-[680px] h-[60px] mt-[111px] bg-[#FF5555] rounded-[5px] text-white text-[26px] font-bold">
                更新する
            </button>
        </form>
    </main>
</body>

</html>