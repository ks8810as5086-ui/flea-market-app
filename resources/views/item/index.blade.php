<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECH フリマアプリ</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F6F6F6] min-h-screen font-sans">

    <header class="bg-black h-[80px] w-full flex items-center justify-between px-[40px] sticky top-0 z-50">

        <div class="flex items-center">
            <img src="{{ asset('img/coachtech-logo.png') }}" alt="COACHTECH" class="h-[32px] object-contain">
        </div>

        <div class="flex-1 max-w-[450px] mx-[20px]">
            <input type="text" placeholder="なにお探しですか？"
                class="w-full h-[40px] px-[16px] rounded-[4px] bg-white text-[14px] text-gray-700 placeholder-gray-400 focus:outline-none">
        </div>

        <div class="flex items-center gap-[40px]">
            <a href="#"
                class="w-[135px] h-[47px] text-[24px] text-white flex items-center justify-center font-normal hover:opacity-80">
                ログイン
            </a>
            <a href="#"
                class="w-[135px] h-[47px] text-[24px] text-white flex items-center justify-center font-normal hover:opacity-80">
                マイページ
            </a>
            <a href="#"
                class="w-[120px] h-[40px] bg-white text-black text-[20px] font-normal rounded-[4px] flex items-center justify-center hover:bg-gray-100 transition-colors">
                出品
            </a>
        </div>

    </header>


    <div class="bg-white border-b border-gray-200">
        <div class="max-w-[1374px] mx-auto px-[20px] flex gap-[60px] h-[50px] items-center text-[18px]">
            <a href="#" class="text-red-600 font-bold border-b-2 border-red-600 h-full flex items-center">おすすめ</a>
            <a href="#" class="text-gray-600 font-normal h-full flex items-center hover:text-black">マイリスト</a>
        </div>
    </div>

    <main class="max-w-[1374px] mx-auto py-[40px] px-[20px]">
    
        <div class="grid grid-cols-4 gap-x-[40px] gap-y-[70px]">
    
            @foreach ($items as $item)

                <div class="w-[290px] h-[320px] flex flex-col justify-between">

                    <div class="w-full h-[260px] bg-[#D9D9D9] rounded-[4px] overflow-hidden">

                        <img
                            src="{{ $item->image_path }}"
                            alt="{{ $item->name }}"
                            class="w-[290px] h-[290px] object-cover"
                        >

                    </div>

                    <p class="text-[18px] mt-[8px]">
                        {{ $item->name }}
                    </p>

                </div>

            @endforeach
    
        </div>
    
    </main>
</body>

</html>