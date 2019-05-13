{!! Form::open(['class' => 'btn-group', 'url' => $url, 'method' => 'DELETE']) !!}
    <button class="btn btn-delete {{ $class ?? 'btn-danger' }}"
            data-toggle="tooltip"
            title="{{ $name ?? 'Delete' }}"
    >
        <i class="fal fa-trash-alt"></i>
    </button>
{!! Form::close() !!}