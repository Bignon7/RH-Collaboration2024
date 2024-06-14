@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium mb-2 text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
