@extends('layouts.app')

@section('content')
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
@endsection