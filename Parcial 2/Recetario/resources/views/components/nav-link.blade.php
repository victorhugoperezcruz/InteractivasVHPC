@props(['active'])
@php
	$classes = ($active ?? false)
		? 'inline-flex items-center px-4 py-1.5 rounded-full bg-stone-900 text-sm font-bold leading-5 text-white shadow transition duration-200 ease-out'
		: 'inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold leading-5 text-stone-500 hover:text-stone-900 hover:bg-orange-100 focus:outline-none focus:text-stone-900 focus:bg-orange-100 transition duration-200 ease-out';
@endphp
<a {{ $attributes->merge(['class' => $classes]) }}>
	{{ $slot }}
</a>
