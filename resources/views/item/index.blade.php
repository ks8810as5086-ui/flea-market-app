<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECH フリマアプリ</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F6F6F6] min-h-screen font-sans">

    <header class="w-[1512px] h-[80px] bg-black ">
        <div class="h-full px-[40px] flex items-center justify-between">

            <!--ロゴ-->
            <img 
                src="{{ asset('img/COACHTECH-logo.png') }}" alt="COACHTECH" 
                class="w-[370px] h-[36px] object-contain"
            >

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
                    <a href="{{ route('login') }}" 
                    class="text-[24px] text-white">
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
                
                <a href="#" 
                    class="text-[24px] text-white">
                    マイページ
                </a>

                <a href="#"
                    class="w-[100px] h-[50px] bg-white text-black text-[24px] rounded-[4px] flex items-center justify-center">
                    出品
                </a>
            </div>

        </div>
    </header>

    <div class="max-w-[1512px] mx-auto mt-[40px] border-b border-[#5F5F5F]">
        <div class="pl-[190px] flex gap-[100px] h-[47px] items-center">
            <a href="#" class="text-[24px] font-bold leading-none text-red-600">
            おすすめ
            </a>

            <a href="#" class="text-[24px] font-bold leading-none text-[#5F5F5F]">
            マイリスト
            </a>
        </div>
    </div>

    <main class="max-w-[1374px] mx-auto pt-[60px] pb-[40px] px-[20px]">
    
        <div class="grid grid-cols-4 gap-x-[40px] gap-y-[70px]">
    
            @foreach ($items as $item)

                <div class="w-[290px]">
                    <div class="w-[290px] h-[290px] overflow-hidden rounded-[4px]">
                        <img src="{{ $item->image_path }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                    </div>

                    <p class="mt-[4px] w-[290px] h-[30px] text-[25px] font-normal leading-none">
                        {{ $item->name }}
                    </p>
                </div>

            @endforeach
    
        </div>
    
    </main>
</body>

</html>