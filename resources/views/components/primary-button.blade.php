<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-[#CB997E] inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white text-gray-800 uppercase tracking-widest hover:bg-[#B7B7A4] hover:bg-[#B7B7A4] focus:bg-gray-700 active:bg-gray-900 active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>