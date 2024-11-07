<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Date</th>
            <th>Type</th>
            <th>Product Name</th>
            <th>Selling Price</th>
            <th>Customer Name</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td
                    rowspan="{{ $order->type == 'order' ? $order->orderItems->count() : $order->customOrderItems->count() }}">
                    {{ $loop->iteration }}</td>
                <td
                    rowspan="{{ $order->type == 'order' ? $order->orderItems->count() : $order->customOrderItems->count() }}">
                    {{ $order->created_at->format('d/m/o') }}</td>
                <td
                    rowspan="{{ $order->type == 'order' ? $order->orderItems->count() : $order->customOrderItems->count() }}">
                    {{ $order->type == 'order' ? 'Regular Order' : 'Custom Request' }}</td>
                @if ($order->type == 'order')
                    <td>
                        {{ $order->orderItems->first()->product->name }}
                    </td>
                    <td>
                        Rp {{ number_format($order->orderItems->first()->price, 0, ',', '.') }}
                    </td>
                @else
                    <td>
                        {{ $order->customOrderItems->first()->name }}
                    </td>
                    <td>
                        Rp {{ number_format($order->customOrderItems->first()->total_price, 0, ',', '.') }}
                    </td>
                @endif
                <td
                    rowspan="{{ $order->type == 'order' ? $order->orderItems->count() : $order->customOrderItems->count() }}">
                    {{ $order->user->fullname }}
                </td>
            </tr>
            @if ($order->type == 'order' && $order->orderItems->count() > 1)
                @foreach ($order->orderItems->skip(1) as $item)
                    <tr>
                        <td>
                            {{ $item->product->name }}
                        </td>
                        <td>
                            Rp {{ number_format($item->price, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            @elseif ($order->type == 'custom' && $order->customOrderItems->count() > 1)
                @foreach ($order->customOrderItems->skip(1) as $item)
                    <tr>
                        <td>
                            {{ $item->name }}
                        </td>
                        <td>
                            Rp {{ number_format($item->total_price, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            @endif
        @endforeach
    </tbody>
</table>
