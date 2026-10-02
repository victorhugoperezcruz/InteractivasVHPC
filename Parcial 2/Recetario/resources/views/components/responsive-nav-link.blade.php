@props(['active'])
@php
	$classes = ($active ?? false)
		? 'block w-full ps-3 pe-4 py-2 border-l-4 border-orange-500 text-start text-base font-bold text-orange-800 bg-orange-50 focus:outline-none focus:text-orange-900 focus:bg-orange-100 focus:border-orange-600 transition duration-200 ease-out'
		: 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-bold text-stone-500 hover:text-stone-900 hover:bg-orange-50 hover:border-orange-200 focus:outline-none focus:text-stone-900 focus:bg-orange-50 focus:border-orange-200 transition duration-200 ease-out';
@endphp
<a {{ $attributes->merge(['class' => $classes]) }}>
	{{ $slot }}
</a>
