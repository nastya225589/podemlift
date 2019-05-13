<a class="btn btn-back {{ $class ?? 'btn-secondary' }}"
   href="{{ $url ?? url()->to('/') }}"
   data-toggle="tooltip"
   title="Return to {{ $name ?? 'Dashboard' }}"
>
    <i class="fal fa-arrow-left"></i>
</a>