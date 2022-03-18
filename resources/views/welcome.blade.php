<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
</head>

<body class="bg-gray-100 bg-local">

    @include('nav')
    @include('listaVentas')

    <div class="bg-white-100 mx-auto max-w-6xl bg-white py-20 px-12 lg:px-20 shadow-xl mb-20">
        <header class="px-5 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-800">Alta de ventas</h2>
        </header>
        @include('errores.session-flash')
        <form method="POST" action="{{ route('altaProductosVentas') }}" class="form-group">
            @csrf
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
                <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="location">
                            Selecciona una tienda*
                        </label>
                        <div>
                            <select class="w-full bg-gray-200 border border-gray-200 text-black text-xs py-3 px-4 pr-8 mb-3 rounded" name="id_tienda" id="tienda">
                                <option value="0">-- Selecciona una tienda --</option>
                                @foreach ($datos as $tienda)
                                    <option value="{{ $tienda->id }}">{{ $tienda->nombre }}</option>
                                @endforeach   
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="md:w-1/2 px-3 mb-6 md:mb-0" id="descuento_tienda">

                    </div>
                    <div class="md:w-1/2 px-3" id="foto_tienda">
                        <img src="{{ asset('/images/cargando.gif') }}" width="200" height="100"><br>
                        <span class="text-white">Foto de la tienda</span>
                    </div>
                </div>


                <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="location">
                            Selecciona un empleado*
                        </label>
                        <div id="empleados_select">
                            <select
                                class="w-full bg-gray-200 border border-gray-200 text-black text-xs py-3 px-4 pr-8 mb-3 rounded"
                                id="empleado"
                                name="id_empleado">
                                <option value="0">-- Selecciona un empelado --</option>
                            </select>
                        </div>
                    </div>
                    <div class="md:w-1/2 px-3" id="foto_empleado">
                        <img src="{{ asset('/images/cargando.gif') }}" width="200" height="100"><br>
                        <span class="text-white">Foto del empleado</span>
                    </div>
                </div>

                    <center>
                        <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="location">
                            Selecciona un producto*
                        </label>
                        <div id="empleados_select">
                            <select
                                class="w-full bg-gray-200 border border-gray-200 text-black text-xs py-3 px-4 pr-8 mb-3 rounded"
                                id="producto" name="id_producto">
                                <option value="0">-- Selecciona un producto --</option>
                            </select>
                        </div>
                    </center>
            </div>

            {{--  ---------------Formulario para las ventas----------------  --}}
            
            <div id="form_products" class="form_products">
                <div class="form_products_data" id="form_products_data"></div>
                <div class="descuento_tienda" id="descuento_tienda"></div>
            </div>
            {{--  ---------------------------------------------------------  --}}

            <div class="-mx-3 md:flex mt-2">
                <div class="md:w-full px-3">
                    <input type="submit" value="Enviar" class="md:w-full bg-gray-900 text-white font-bold py-2 px-4 border-b-4 hover:border-b-2 border-gray-500 hover:border-gray-100 rounded-full"/>
                </div>
            </div>
        </form>
    </div>

        <div>
            <br><br>
        </div>
    <script src="{{ asset('/js/ventas.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var suma = 0;
            $(this).find(".total_ventas").each(function() {
                suma += Number($(this).attr("dato"));
            });
            $(this).find(".vendidos").first().text('Total ventas: $' + suma);

            var subtotal_suma = 0;
            $(this).find(".subtotal").each(function() {
                subtotal_suma += Number($(this).attr("subtotal"));
            });
            $(this).find(".sub").first().text('Subtotal ventas: $' + subtotal_suma);
        });
    </script>
</body>

</html>
