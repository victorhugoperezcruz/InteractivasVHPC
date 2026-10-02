<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-primario text-sm uppercase tracking-widest']) }}>
	{{ $slot }}
</button>
