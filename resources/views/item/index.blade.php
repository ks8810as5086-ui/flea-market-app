@extends('layouts.app')

@section('content')
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
                <a href="{{ route('item.show', $item) }}">
                    <div class="w-[290px]">
                        <div class="relative w-[290px] h-[290px] overflow-hidden rounded-[4px]">
                            @if ($item->image_path)
                                @if (str_starts_with($item->image_path, 'http'))
                                    <img src="{{ $item->image_path }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}"
                                        class="w-full h-full object-cover">
                                @endif
                            @endif

                            @if ($item->purchase)
                                <div class="absolute top-2 left-2 bg-red-600 text-white px-3 py-1 font-bold rounded">
                                    SOLD
                                </div>
                            @endif
                        </div>

                        <p class="mt-[4px] w-[290px] h-[30px] text-[25px] font-normal leading-none">
                            {{ $item->name }}
                        </p>
                    </div>
                </a>
            @endforeach
    
        </div>
    
    </main>
@endsection