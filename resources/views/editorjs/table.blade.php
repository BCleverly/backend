<table class="table">
    @foreach($content as $key => $rowItems)
        <tr class="table-row {{ $loop->even ? 'table-row__even' : 'table-row__odd' }}">
            @foreach($rowItems as $item)
                <td class="table-column {{ $loop->even ? 'table-column__even' : 'table-column__odd' }}">{{ $item }}</td>
            @endforeach
        </tr>
    @endforeach
</table>