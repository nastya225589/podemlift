<section class="table">
    <table>
        <thead class="table__head">
            <tr>
                <td></td>
                @foreach ($page->properties as $item)
                    <td class="table__head-name">{{ $item->name }}</td>
                @endforeach
            </tr>
        </thead>
        <tfoot class="table__foot">
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tfoot>
        <tbody class="table__body">
            @foreach ($page->categories as $item)
                <tr>
                    <td class="table__body-name">{{ $item->name }} {{ $item->measure }}</td>
                    @foreach ($page->properties as $prop)
                        @php ($value = $item->property($prop))
                        @if ($value)
                            @if ($prop->type === 'number')
                                <td>
                                    до {{ $item->property($prop) . ' ' . $prop->measure }}
                                </td>
                            @else
                                <td>
                                    {{ $value }}
                                </td>
                            @endif
                        @else
                            <td>
                                -
                            </td>   
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
