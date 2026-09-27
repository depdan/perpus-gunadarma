<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-5 py-2.5 btn-primary-royal rounded-xl font-bold text-xs sm:text-sm tracking-wide shadow-royal-sm cursor-pointer transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
