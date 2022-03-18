{{--  Mostrar Informacion de las ventas  --}}
<!-- Table -->
<div class="w-full max-w-6xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
    <header class="px-5 py-4 border-b border-gray-100">
        <h2 class="font-semibold text-gray-800">Registro de ventas</h2>
    </header>
    <div class="p-3">
        <div class="overflow-x-auto">
            @if ($ventas->count() == 0)
            <div class="alert alert-danger" role="alert">
                <center><p>No se han registrado ventas</p></center>
            </div>
            @else
            <table class="table-auto w-full">
                <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                    <tr>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-left">id</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-center">Fecha de venta</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-center">Tienda</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-center">Vendedor</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-center">Producto</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-center">Precio</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-center">Cantidad</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-center">Descuento</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-center">Subtotal</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-center">Total</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-center">Acciones</div>
                        </th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                @foreach ($ventas as $venta)
                    <tr>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-left">{{ $venta->id }}</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-center">{{ $venta->created_at->format('d-m-Y') }}</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-center">{{ $venta->tienda->nombre }}</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-center">{{ $venta->empleado->nombre }}</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-center">{{ $venta->producto->nombre }}</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-center font-medium text-green-500">${{ $venta->precio }}</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-center font-medium text-green-500">{{ $venta->cantidad }}</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-center font-medium text-green-500">{{ $venta->descuento }}%</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-center font-medium text-green-500 subtotal" subtotal="{{ $venta->subtotal }}">${{ $venta->subtotal }}</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-center font-medium text-green-500 total_ventas" dato="{{ $venta->total }}">${{ $venta->total }}</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-center font-medium">
                                <form action="{{ route('borrar', ['id' => $venta->id]) }}" method="POST" name="borrar">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <input type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" value="borrar">
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    <td class="vendidos text-center font-medium text-green-500"></td>
                    <td class="sub text-center font-medium text-red-500 sub"></td>
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>