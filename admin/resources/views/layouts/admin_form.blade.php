@extends('admin::layouts.admin')

@section('content')

    <form method="POST" action="@yield('action')">
        @csrf
        @if($action == 'edit')
            @method('PUT')
        @endif

        <div class="row">
            <div class="col-md-10">
                @yield('fields')
            </div>
            <div class="col-md-2">
                <div class="control-buttons">
                    @yield('controls')
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-md-12">
            @yield('additional')
        </div>
    </div>

@endsection
