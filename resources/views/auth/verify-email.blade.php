<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メール認証</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white min-h-screen">
    <header class="w-[1512px] h-[80px] bg-black">
        <div class="h-full px-[40px] flex items-center">
            <img src="{{ asset('img/COACHTECH-logo.png') }}" alt="COACHTECH" class="w-[370px] h-[36px] object-contain">
        </div>
    </header>
    <main class="w-[1512px] mx-auto">

        <p class="pt-[239px] text-center text-[24px] font-bold leading-[1.6]">
            登録していただいたメールアドレスに認証メールを送付しました。<br>
            メール認証を完了してください。
        </p>

        <div class="mt-[56px] flex justify-center">
            <a href="http://localhost:8025" target="_blank"
                class="w-[257px] h-[69px] border border-black rounded-[10px] bg-[#D9D9D9] text-[24px] font-bold flex items-center justify-center">
                認証はこちらから
            </a>
        </div>

        <form action="{{ route('verification.send') }}" method="POST" class="mt-[35px] flex justify-center">
            @csrf

            <button type="submit" class="w-[257px] h-[53px] text-[20px] text-[#0073CC]">
                認証メールを再送する
            </button>
        </form>

        @if (session('status') === 'verification-link-sent')
            <p class="mt-[20px] text-center text-[18px] text-green-600">
                認証メールを再送しました。
            </p>
        @endif

    </main>
</body>

</html>