<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl  font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2']) }}>

    {{ $slot }}
</button>
