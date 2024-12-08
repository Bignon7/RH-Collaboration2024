@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'bg-white border border-gray-300 text-gray-500 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50',
]) !!}>
{{-- border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm --}}
