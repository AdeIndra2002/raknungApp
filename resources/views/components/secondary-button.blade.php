<button {{ $attributes->merge(['type' => 'button', 'class' => 'text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl  font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2']) }}>

    {{ $slot }}
</button>
