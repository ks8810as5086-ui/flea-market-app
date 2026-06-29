@extends('layouts.app')

@section('content')
                @php
    $purchaseAddress = session('purchase_address.' . $item->id);
                @endphp

            <main class="w-[1512px] mx-auto">
                <form action="{{ route('purchase.store', $item) }}" method="POST">
                    @csrf

                    <input type="hidden" name="postal_code" value="{{ $purchaseAddress['postal_code'] ?? Auth::user()->postal_code }}">
                    <input type="hidden" name="address" value="{{ $purchaseAddress['address'] ?? Auth::user()->address }}">
                    <input type="hidden" name="building" value="{{ $purchaseAddress['building'] ?? Auth::user()->building }}">

                    <div class="flex gap-[95px] px-[80px] pt-[53px]">

                        <!-- 左側 -->
                        <div class="w-[805px]">

                            <!-- 商品情報 -->
                            <div class="flex">
                                <div class="w-[177px] h-[177px] overflow-hidden rounded-[4px] shrink-0">
                                    @if ($item->image_path)
                                        @if (str_starts_with($item->image_path, 'http'))
                                            <img src="{{ $item->image_path }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                                        @else
                                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}"
                                                class="w-full h-full object-cover">
                                        @endif
                                    @endif
                                </div>

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

                                    <select id="payment_method" name="payment_method" class="mt-[35px] ml-[90px] w-[265px] h-[31px] border border-gray-400">
                                        <option value="">選択してください</option>
                                        <option value="1">コンビニ払い</option>
                                        <option value="2">カード払い</option>
                                    </select>
                                </div>

                                <hr class="border-black">

                                <!-- 配送先 -->
                                <div class="pt-[20px] pl-[35px] h-[190px]">
                                    <div class="flex items-center">
                                        <h2 class="text-[20px] font-bold">
                                            配送先
                                        </h2>

                                        <a href="{{ route('purchase.address.edit', $item) }}"
                                            class="ml-[580px] text-[20px] text-[#0073CC] font-normal">
                                            変更する
                                        </a>
                                    </div>

                                    <div class="mt-[35px] ml-[60px] text-[20px] font-semibold">
                                        <p>〒 {{ $purchaseAddress['postal_code'] ?? Auth::user()->postal_code }}
                                        </p>
                                        <p class="mt-[10px]">
                                            {{ $purchaseAddress['address'] ?? Auth::user()->address }}
                                            {{ $purchaseAddress['building'] ?? Auth::user()->building }}
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

                                        <div id="payment_method_text" class="w-1/2 text-center text-[20px]">
                                                選択してください
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="w-[440px]
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
                </form>
            </main>
        <script>
            const paymentMethod = document.getElementById('payment_method');
            const paymentMethodText = document.getElementById('payment_method_text');

            paymentMethod.addEventListener('change', function () {
                const selectedText = paymentMethod.options[paymentMethod.selectedIndex].text;
                paymentMethodText.textContent = selectedText;
            });
        </script>
@endsection