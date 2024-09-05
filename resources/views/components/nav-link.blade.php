<a class="{{ $active ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'}} rounded-md px-3 py-2 text-sm font-medium " aria-current="{{ $active ?  'page' : 'false'}}"
{{ $attributes }}
>{{ $slot }}</a>

 {{-- <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700 active:bg-indigo-800">
                        <i class="bi bi-house-door-fill"></i> Dashboard
                    </a> --}}