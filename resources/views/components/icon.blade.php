@switch($name)
    @case('book-open')
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 sm:w-8 sm:h-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v12M20.25 6.75V18a2.25 2.25 0 01-2.25 2.25H12M3.75 6.75V18A2.25 2.25 0 006 20.25h6" />
        </svg>
        @break
    @case('music-note')
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 sm:w-8 sm:h-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-2v13" />
        </svg>
        @break
    @default
        <!-- Default Icon -->
@endswitch
