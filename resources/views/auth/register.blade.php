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
            <img src="{{ asset('img/COACHTECH-logo.png') }}" alt="COACHTECH" class="w-[370px] h-[36px] object-contain">

            
        </div>

    </header>

    <main class="w-[1512px] mx-auto">

        <form action="{{ route('register.store') }}" method="POST" class="w-[680px] mx-auto mt-[98px]">
        @csrf

            <h1 class="text-[36px] font-bold text-center">
                会員登録
            </h1>

            <div class="mt-[40px]">
                <label class="text-[24px] font-bold">ユーザー名</label>
                <input type="text" name="name" class="w-full h-[45px] border border-gray-400 mt-[8px]">
                @error('name')
                    <p class="mt-[6px] text-red-500 text-[16px]">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-[28px]">
                <label class="text-[24px] font-bold">メールアドレス</label>
                <input type="text" name="email" value="{{ old('email') }}" class="w-full h-[45px] border border-gray-400 mt-[8px]">
                @error('email')
                    <p class="mt-[6px] text-red-500 text-[16px]">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-[28px]">
                <label class="text-[24px] font-bold">パスワード</label>
                <input type="password" name="password" class="w-full h-[45px] border border-gray-400 mt-[8px]">
                @error('password')
                    <p class="mt-[6px] text-red-500 text-[16px]">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-[28px]">
                <label class="text-[24px] font-bold">確認用パスワード</label>
                <input type="password" name="password_confirmation" class="w-full h-[45px] border border-gray-400 mt-[8px]">
            </div>

            <button type="submit"
                class="w-full h-[65px] mt-[70px] bg-[#FF5555] rounded-[5px] text-white text-[26px] font-bold">
                登録する
            </button>

            <div class="mt-[20px] text-center">
                <a href="/login" class="text-[20px] text-[#0073CC]">
                    ログインはこちら
                </a>
            </div>
        </form>

    </main>

</body>

</html>