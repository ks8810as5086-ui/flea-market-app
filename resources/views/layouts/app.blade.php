<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECH フリマアプリ</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F6F6F6] min-h-screen font-sans">

    {{-- 共通ヘッダー --}}
    <header class="w-[1512px] h-[80px] bg-black">
        <div class="h-full px-[40px] flex items-center justify-between">

            <!-- ロゴ -->
            <img src="{{ asset('img/COACHTECH-logo.png') }}" alt="COACHTECH" class="w-[370px] h-[36px] object-contain">

            <!-- 検索 -->
            <form action="{{ route('item.index') }}" method="GET" class="w-[563px] h-[80px] flex items-center justify-center">
            
                @if (request('tab'))
                    <input type="hidden" name="tab" value="{{ request('tab') }}">
                @endif
            
                <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="なにをお探しですか？"
                    class="w-[500px] h-[50px] rounded-[5px] px-[31px] text-[24px] bg-white text-black placeholder:text-black focus:outline-none">
            </form>

            <!-- ナビ -->
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

                <a href="{{ route('mypage.index') }}" class="text-[24px] text-white">
                    マイページ
                </a>

                <a href="/sell"
                    class="w-[100px] h-[50px] bg-white text-black text-[24px] rounded-[4px] flex items-center justify-center">
                    出品
                </a>

            </div>

        </div>
    </header>

    {{-- 各画面の内容 --}}
    @yield('content')

</body>

</html>