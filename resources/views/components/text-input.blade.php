@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-slate-50 border-slate-200 focus:border-royal-500 focus:ring-2 focus:ring-royal-500 focus:bg-white rounded-xl shadow-xs text-sm font-medium transition']) }}>
