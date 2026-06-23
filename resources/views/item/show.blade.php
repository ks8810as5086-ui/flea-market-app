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

    <main class="max-w-[1380px] mx-auto pt-[75px]">

        <div class="flex">
            <!--左-->
            <div class="w-[690px]">
                <div class="w-[600px] h-[600px] ml-[45px] mt-[36px]  rounded-[4px] overflow-hidden ">
                    <img 
                        src="{{ $item->image_path }}" 
                        alt="{{ $item->name }}"
                    >
                </div>
            </div>
            <!--右-->
            <div class="w-[690px] pt-[36px]">
                
                <div class="w-[570px] h-[273px]">
                
                    <h1 class="text-[45px] font-bold leading-none">
                        {{ $item->name }}
                    </h1>
                
                    <p class="text-[20px] mt-[8px] leading-none">
                        {{ $item->brand }}
                    </p>
                
                    <p class="mt-[28px] leading-none">
                        <span class="text-[30px]">¥</span>
                        <span class="text-[45px]">{{ number_format($item->price) }}</span>
                        <span class="text-[30px]">（税込）</span>
                    </p>
                
                    <!-- いいね・コメント -->
                    <div class="w-[144px] h-[67px] mt-[40px] flex justify-between">
                    
                        <!-- いいね -->
                        <div class="flex flex-col items-center">
                    
                            <img src="{{ asset('img/heart-logo-default.png') }}" alt="いいね" class="w-[50px] h-[50px]">
                    
                            <span class="text-[18px] leading-none">
                                {{ $item->favorites_count  }}
                            </span>
                    
                        </div>
                    
                        <!-- コメント -->
                        <div class="flex flex-col items-center">
                    
                            <img src="{{ asset('img/balloon-logo.png') }}" alt="コメント" class="w-[40px] h-[40px]">
                    
                            <span class="text-[18px] leading-none mt-[4px]">
                                {{ $item->comments_count  }}
                            </span>
                    
                        </div>
                    
                    </div>
                
                </div>
                
                <div class="w-[570px] h-[100px] flex items-center">
                
                    <button type="button" class="
                            w-[570px]
                            h-[56px]
                            bg-[#FF5555]
                            rounded-[4px]
                            text-white
                            text-[30px]
                            font-bold
                        ">
                        購入手続きへ
                    </button>
                
                </div>
                
                <!-- 商品説明 -->
                <div class="w-[559px] mt-[40px]">
                
                    <h2 class="text-[36px] font-bold leading-none">
                        商品説明
                    </h2>
                
                    <p class="mt-[40px] text-[24px] font-normal leading-normal">
                        {{ $item->description }}
                    </p>
                
                </div>

                <!-- 商品情報 -->
                <div class="w-[559px] mt-[60px]">
                
                    <h2 class="text-[36px] font-bold">
                        商品情報
                    </h2>
                
                    <!-- カテゴリー -->
                    <div class="flex gap-[16px]">
                        <span class="w-[214px] text-[24px] font-bold">
                            カテゴリー
                        </span>
                        @foreach($item->categories as $category)
                            <span class="
                                    px-[24px]
                                    h-[30px]
                                    rounded-[15px]
                                    bg-[#D9D9D9]
                                    text-[20px]
                                    text-black
                                    flex items-center
                                ">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>
                    <!-- 商品状態 -->
                    <div class="flex items-center mt-[30px]">
                    
                        <span class="w-[214px] text-[24px] font-bold">
                            商品の状態
                        </span>
                    
                        <span class="text-[20px]">
                            {{ $item->condition_label }}
                        </span>
                    
                    </div>
                    
                </div>
                <!-- コメント -->
                <div class="w-[570px] mt-[60px]">
                
                    <h2 class="text-[36px] font-bold text-[#5F5F5F]">
                        コメント（{{ $item->comments_count }}）
                    </h2>
                    @foreach ($item->comments as $comment)
                        <div class="mt-[30px]">

                            <!-- ユーザー -->
                            <div class="flex items-center">

                                <div class="w-[70px] h-[70px] rounded-full bg-gray-300">
                                </div>

                                <p class="ml-[18px] text-[30px] font-bold">
                                    {{ $comment->user->name }}
                                </p>

                            </div>

                            <!-- コメント本文 -->
                            <div class="
                                        w-[570px]
                                        h-[70px]
                                        mt-[19px]
                                        rounded-[5px]
                                        bg-[#E5E5E5]
                                        px-[15px]
                                        flex items-center
                                    ">
                                <p class="text-[20px] font-light">
                                    {{ $comment->comment }}
                                </p>
                            </div>

                        </div>

                    @endforeach
                
                    </div>
                    <form action="{{ route('comment.store', $item) }}" method="POST">
                        @csrf
                    
                        <!-- 商品へのコメント -->
                        <div class="mt-[50px]">
                            <p class="text-[28px] font-bold">
                                商品へのコメント
                            </p>
                    
                            <textarea name="comment" class="
                                    w-[570px]
                                    h-[246px]
                                    mt-[20px]
                                    border
                                    border-gray-300
                                    rounded-[5px]
                                    resize-none
                                    p-[15px]
                                    text-[20px]
                                    focus:outline-none
                                ">{{ old('comment') }}</textarea>
                    
                            @error('comment')
                                <p class="mt-[8px] text-red-500 text-[16px]">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    
                        <!-- コメント送信 -->
                        <div class="w-[570px] h-[100px] flex items-center">
                            <button type="submit" class="
                                    w-[570px]
                                    h-[56px]
                                    bg-[#FF5555]
                                    rounded-[4px]
                                    text-white
                                    text-[25px]
                                    font-bold
                                ">
                                コメントを送信する
                            </button>
                        </div>
                    </form>
            </div>
        </div>
    </main>
</body>

</html>