<button
        type="{{ !empty($type) ? $type : 'submit' }}"
        class="{{ !empty($class) ? $class : 'form-control' }}"
        @isset($id)    id="{{ $id }}"       @endisset
>{{ $slot }}</button>