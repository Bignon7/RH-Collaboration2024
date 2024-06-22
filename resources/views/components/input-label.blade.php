@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold mb-2 text-gray-600']) }}>
    {{ $value ?? $slot }}
</label>
