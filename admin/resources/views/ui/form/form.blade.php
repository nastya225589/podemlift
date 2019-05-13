<form method="POST" action="@yield('action')">
    @csrf

    <div class="row">
        <div class="col-md-11">
            @yield('fields')
        </div>
        <div class="col-md-1">
            <div class="control-button">
                @yield('control')
            </div>
        </div>
    </div>
</form>