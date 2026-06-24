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

    <main class="w-[1512px] mx-auto">
        <div class="flex gap-[95px] px-[80px] pt-[53px]">

            <!-- 左側 -->
            <div class="w-[805px]">

                <!-- 商品情報 -->
                <div class="flex">
                    <img src="{{  $item->image_path }}" 
                    alt="{{ $item->name }}"
                    class="w-[178px] h-[178px] object-cover bg-gray-300">

                    <div class="ml-[40px]">
                        <h1 class="text-[30px] font-bold">
                            {{ $item->name }}
                        </h1>

                        <p class="mt-[25px] text-[27px]">
                            ¥ {{ number_format($item->price) }}
                        </p>
                    </div>
                </div>

                <hr class="mt-[50px] border-black">

                <!-- 支払い方法 -->
                <div class="pt-[20px] pl-[35px] h-[160px]">
                    <h2 class="text-[20px] font-bold">
                        支払い方法
                    </h2>

                    <select name="payment_method" class="mt-[35px] ml-[90px] w-[265px] h-[31px] border border-gray-400">
                        <option value="">選択してください</option>
                        <option value="convenience_store">コンビニ払い</option>
                        <option value="credit_card">カード払い</option>
                    </select>
                </div>

                <hr class="border-black">

                <!-- 配送先 -->
                <div class="pt-[20px] pl-[35px] h-[190px]">
                    <div class="flex items-center">
                        <h2 class="text-[20px] font-bold">
                            配送先
                        </h2>

                        <a href="#" 
                            class="ml-[580px] text-[20px] text-[#0073CC] font-normal">
                            変更する
                        </a>
                    </div>

                    <div class="mt-[35px] ml-[60px] text-[20px] font-semibold">
                        <p>〒 {{ Auth::user()->postal_code ?? 'XXX-YYYY' }}</p>
                        <p class="mt-[10px]">
                            {{ Auth::user()->address ?? 'ここには住所と建物が入ります' }}
                            {{ Auth::user()->building }}
                        </p>
                    </div>
                </div>

                <hr class="border-black">
            </div>

            <!-- 右側 -->
            <div class="w-[440px] h-[230px] border border-black">
                <div>
                    <div class="h-[115px] flex items-center border-b border-black">
                        <div class="w-1/2 text-center text-[20px]">
                            商品代金
                        </div>
                        <div class="w-1/2 text-center text-[24px]">
                            ¥ {{ number_format($item->price) }}
                        </div>
                    </div>

                    <div class="h-[115px] flex items-center">
                        <div class="w-1/2 text-center text-[20px]">
                            支払い方法
                        </div>
                        <div class="w-1/2 text-center text-[20px]">
                            コンビニ払い
                        </div>
                    </div>
                </div>

                <button class="
                        w-[440px]
                        h-[60px]
                        mt-[66px]
                        bg-[#FF5555]
                        rounded-[4px]
                        text-white
                        text-[26px]
                        font-bold
                    ">
                    購入する
                </button>
            </div>

        </div>
    </main>
</body>

</html>