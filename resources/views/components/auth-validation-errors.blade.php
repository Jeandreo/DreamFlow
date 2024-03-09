@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="mt-3 list-disc list-inside text-sm text-red-600 text-alert">
            @foreach ($errors->all() as $error)
            {{ $error }}
            @endforeach
        </div>
    </div>
@endif
