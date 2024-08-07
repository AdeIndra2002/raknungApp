<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br   font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2']) }}>

    {{ $slot }}
</button>
