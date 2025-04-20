<div class="d-flex justify-content-between opacity-1 position-relative">
    <span class="text-gray-700 fw-bold d-flex align-items-center">
        {{ Str::limit($item->food?->name ?? $item->dish?->name, 23) }}
        @if ($item->food->quantity > 1)
            @if ($item->food->type == 'unidade')
                <span class="fw-normal text-gray-500 fs-7 ms-2">{{ $item->food->quantity }}uni</span>
            @else
                <span class="fw-normal text-gray-500 fs-7 ms-2">{{ $item->food->quantity }}g</span>
            @endif
        @endif
    </span>
    <span class="text-gray-600">
        {{ floor($item->food?->calories ?? $item->dish?->getTotalCaloriesAttribute()) }}
    </span>
    <i class="fa-solid fa-circle-xmark text-danger text-hover-primary remove-item cursor-pointer opacity-0 p-1 shadow bg-white rounded-circle position-absolute" style="top: 0px;right: -23px;" data-item="{{ $item->id }}"></i>
</div>
<div class="separator separator-dashed my-2"></div>