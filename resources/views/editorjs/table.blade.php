<table>
    @foreach($content as $key => $rowItems)
        <tr>
            @foreach($rowItems as $item)
                <td>{{ $item }}</td>
            @endforeach
        </tr>
    @endforeach
</table>