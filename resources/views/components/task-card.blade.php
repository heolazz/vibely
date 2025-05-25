@props(['title', 'color'])

<div class="{{ $color }} p-5 rounded-xl shadow hover:shadow-lg transition duration-300 cursor-pointer">
    <h3 class="text-lg font-semibold text-gray-800">{{ $title }}</h3>
</div>
