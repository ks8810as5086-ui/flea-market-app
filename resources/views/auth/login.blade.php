<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECH フリマアプリ</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="w-[1512px] h-[80px] bg-black">
        <div class="h-full px-[40px] flex items-center">
            <img src="{{ asset('img/COACHTECH-logo.png') }}" alt="COACHTECH" class="w-[370px] h-[36px] object-contain">
        </div>
    </header>

    <main class="w-[1512px] mx-auto">
        <form action="{{ route('login') }}" method="POST" class="w-[680px] mx-auto mt-[180px]">
            @csrf

            <h1 class="text-[36px] font-bold text-center leading-none">
                ログイン
            </h1>

            <div class="mt-[52px]">
                <label for="email" class="block text-[24px] font-bold leading-none">
                    メールアドレス
                </label>

                <input id="email" type="email" name="email" value="{{ old('email') }}"
                    class="w-full h-[57px] mt-[10px] border border-[#5F5F5F] rounded-[4px] px-[12px] text-[20px] focus:outline-none">

                @error('email')
                    <p class="mt-[6px] text-red-500 text-[16px]">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-[36px]">
                <label for="password" class="block text-[24px] font-bold leading-none">
                    パスワード
                </label>

            <input id="password" type="password" name="password"
                class="w-full h-[56px] mt-[10px] border border-[#5F5F5F] rounded-[4px] px-[12px] text-[20px] focus:outline-none">

            @error('password')
                <p class="mt-[6px] text-red-500 text-[16px]">{{ $message }}</p>
            @enderror
            </div>

            <button type="submit" class="w-full h-[65px] mt-[60px] bg-[#FF5555] rounded-[5px] text-white text-[26px] font-bold">
                ログインする
            </button>

            <div class="mt-[18px] text-center">
                <a href="/register" class="text-[20px] text-[#0073CC]">
                    会員登録はこちら
                </a>
            </div>
        </form>
    </main>

</body>

</html>