const tienda = document.querySelector('#tienda');
const empleado = document.querySelector('#tienda');
const selectEmpleados = document.querySelector('#empleado');
const selectProductos = document.querySelector('#empleado');
const llenarFormulario = document.querySelector('#producto');

document.addEventListener('DOMContentLoaded', () => {
    tienda.addEventListener('change', fotoTienda);
    empleado.addEventListener('change', consultarEmpleados);
    selectEmpleados.addEventListener('change', fotoEmpleado);
    selectProductos.addEventListener('change', consultarProductos);
    llenarFormulario.addEventListener('change', formularioVenta);
});


async function consultarEmpleados() {
    const tienda_id = document.querySelector('#tienda').value;

    if (tienda_id == 0) {
        const seleccionEmpleado = document.querySelector('#empleado');
        const foto_tienda = document.querySelector('#foto_tienda');

        while (seleccionEmpleado.firstChild || foto_tienda.firstChild) {
            seleccionEmpleado.removeChild(seleccionEmpleado.firstChild)
            foto_tienda.removeChild(foto_tienda.firstChild)
        }

        const cargando = document.createElement('div');
        cargando.innerHTML = `<img src="https://us.123rf.com/450wm/alekseyvanin/alekseyvanin1712/alekseyvanin171200974/91724249-perfil-del-c%C3%ADrculo-para-avatar-.jpg" width="200" height="100">`;
        foto_tienda.appendChild(cargando);

        seleccionEmpleado.innerHTML = `<option value="0">-- Primero selecciona una tienda --</option>`;
        mostrarAlerta('Debes de seleccionar una tienda!');

    } else {
        try {
            const resultado = await fetch('/fotoEmpleado');
            const respuesta = await resultado.json();
            selectEmpleado(respuesta);
        } catch (error) {
            console.log('Hubo un error');
        }
    }
}

function selectEmpleado(empleados) {
    const tienda_id = document.querySelector('#tienda').value;
    const select = document.querySelector('#empleado');
    
    while (select.firstChild) {
        select.removeChild(select.firstChild);
    }
    
    const option0 = document.createElement('option');
    option0.value = "0";
    option0.text = "-- Primero selecciona una tienda --";
    select.appendChild(option0);

    empleados.forEach(empleado => {
        const {id, nombre, id_tienda} = empleado;
        
        if (tienda_id == id_tienda) {

            const option = document.createElement('option');
            option.value = id;
            option.textContent = nombre;
            option.id = "empleado";
            select.appendChild(option);
            return;
        }
    });
}

async function fotoEmpleado() {
    const empleado_id = document.querySelector('#empleado').value;
    const foto_empleado = document.querySelector('#foto_empleado');

    if (empleado_id == 0) {
        mostrarAlerta('Debes de seleccionar un empleado!');

        while (foto_empleado.firstChild) {
            foto_empleado.removeChild(foto_empleado.firstChild)
        }

        const cargando = document.createElement('div');
        cargando.innerHTML = `<img src="https://us.123rf.com/450wm/alekseyvanin/alekseyvanin1712/alekseyvanin171200974/91724249-perfil-del-c%C3%ADrculo-para-avatar-.jpg" width="200" height="100">`;
        foto_empleado.appendChild(cargando);


    } else {
        try {
            const resultado = await fetch('/fotoEmpleado');
            const respuesta = await resultado.json();
    
            mostrarImagenEmpleado(respuesta);
        } catch (error) {
            console.log('Hubo un error');
        }
    }
}

function mostrarImagenEmpleado(empleados) { 
    const empleado_id = document.querySelector('#empleado').value;

    empleados.forEach(empleado => {
        const {id, imagen} = empleado;
        if (empleado_id == id) {
            const fotoEmpleado = document.querySelector('#foto_empleado');

            while (fotoEmpleado.firstChild) {
                fotoEmpleado.removeChild(fotoEmpleado.firstChild)
            }

            fotoEmpleado.innerHTML = `
                    <img src="${imagen}" width="150" height="100">
            `;
        } 
    });
 }

async function fotoTienda() {
    const tienda_id = document.querySelector('#tienda').value;
    
    if (tienda_id == 0) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Debes de seleccionar una tienda!',
          })
    } else {
        try {
            const resultado = await fetch('/fotoTienda');
            const respuesta = await resultado.json();
    
            mostrarImagenTienda(respuesta);
        } catch (error) {
            console.log('Hubo un error');
        }
    }
}

function mostrarImagenTienda(tienda) {
    const tienda_id = document.querySelector('#tienda').value;

    tienda.forEach(tiendas => {
        const {id, foto, descuento} = tiendas;
        if (tienda_id == id) {
            const fotoTienda = document.querySelector('#foto_tienda');
            const descuento_tienda = document.querySelector('#form_products .descuento_tienda');

            while (fotoTienda.firstChild) {
                fotoTienda.removeChild(fotoTienda.firstChild);
            }

            fotoTienda.innerHTML = `
                <img src="${foto}" width="200" height="100">
            `;
            if(descuento == 0){
                eliminarDescuentoHTML();
                console.log('Sin descuento');
            } else {
                eliminarDescuentoHTML();
                const label_tienda = document.createElement('label');
                const desc_tienda = document.createElement('input');
                desc_tienda.type = 'checkbox';
                desc_tienda.value = descuento;
                desc_tienda.id = 'checkbox_tienda';
                desc_tienda.defaultChecked = true;
                desc_tienda.classList.add('appearance-none', 'indeterminate:bg-gray-300');
                label_tienda.classList.add('uppercase', 'tracking-wide', 'text-black', 'text-xs', 'font-bold', 'mb-2');
                label_tienda.textContent = ` Deseas aplicar un descuento de: ${descuento}% `;

                descuento_tienda.appendChild(label_tienda);
                descuento_tienda.appendChild(desc_tienda);
            }
        } 
    });
}

async function consultarProductos() { 
    const tienda_id = document.querySelector('#tienda').value;

    if (tienda_id == 0) {
        mostrarAlerta('Debes de seleccionar una tienda!');
    } else {
        try {
            const resultado = await fetch('/productos');
            const respuesta = await resultado.json();
            llenarSelectProductos(respuesta);
        } catch (error) {
            console.log('Hubo un error');
        }
    }
}

function llenarSelectProductos(productos) { 
    const tienda_id = document.querySelector('#tienda').value;
    const select = document.querySelector('#producto');

    while (select.firstChild) {
        select.removeChild(select.firstChild);
    }

    const option0 = document.createElement('option');
    option0.value = "0";
    option0.text = "-- Primero selecciona un producto --";
    select.appendChild(option0);

    productos.forEach(producto => {
        if (tienda_id == producto.id_tienda) {
            const option = document.createElement('option');
            option.value = producto.id;
            option.textContent = producto.nombre;
            option.id = "producto";
            select.appendChild(option);
            return;
        }
    });

}

 async function formularioVenta() {
    const productoSeleccionado = document.querySelector('#producto').value;

    if (productoSeleccionado == 0) {
        mostrarAlerta('Debes de seleccionar un producto!');
    } else {
        try {
            const resultado = await fetch('/productos');
            const respuesta = await resultado.json();
            formularioProducto(respuesta);
        } catch (error) {
            console.log('Hubo un error');
        }
    }
}

function formularioProducto(productos) {
    const productoSeleccionado = document.querySelector('#producto').value;
    limpiarHTMLProductos();
    productos.forEach(producto => {
        const {nombre, clave, imagen, precio, id, descuento} = producto;
        const form_products = document.querySelector('#form_products .form_products_data');
        
        if (productoSeleccionado == id) {

            const datos = document.createElement('div');
            
            datos.innerHTML = `
             <div class="-mx-3 md:flex mb-6">
             <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                 <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="nombre_clave">
                     Producto*
                   </label>
                   <input readonly name="nombre_clave" value="${nombre}/${clave}" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" id="nombre_clave" type="text">
             </div>

             <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                 <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="precio">
                     Precio*
                   </label>
                   <input readonly name="precio" value="${precio}" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" id="precio" type="text">
             </div>

             <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                 <img src="${imagen}" width="200" height="100"><br>
                 <span class="text-white">Foto de la tienda</span>
             </div>
             </div>

         <div class="-mx-3 md:flex mb-6">
         <div class="md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="cantidad">
                Desc. prod %
            </label>
           <input value="${descuento}" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" id="descuento_producto" type="number ">
         </div>

            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                 <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="cantidad">
                     Cantidad*
                   </label>
                   <input min="1" value="0" name="cantidad" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" id="cantidad" type="number">
             </div>
            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="total">
                Descuento total
               </label>
                <input readonly name="descuento" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" id="descuento" type="text">
            </div>

             <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                 <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="total">
                    Subtotal
                   </label>
                <input readonly name="subtotal" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" id="subtotal" type="text">
             </div>
             <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                 <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="total">
                     Total a pagar
                   </label>
                   <input readonly name="total" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" id="total" type="text">
             </div>
         </div>
             `;
            form_products.appendChild(datos);
        }

        document.addEventListener('click', () => {
            const checkbox_tienda = document.querySelector('#checkbox_tienda');
            const descuento_producto = document.querySelector('#descuento_producto').value;
            const cantidad = document.querySelector('#cantidad').value;
            const precio = document.querySelector('#precio').value;
            const total = document.querySelector('#total');
            const subtotal = document.querySelector('#subtotal');
            const descuento = document.querySelector('#descuento');
            if (cantidad <= 10) {
                if (!checkbox_tienda) {
                    //subtotal
                    var sub_total = precio * cantidad;
                    subtotal.value = sub_total;
    
                    //obtener cantidad de descuento
                    var suma_total_sin = descuento_producto * precio / 100;
                    var calculo = precio - suma_total_sin;
                    var total_pago = calculo * cantidad;
    
                    total.value = total_pago;
    
                    //Descuento total
                    const descuento_total = descuento_producto;
                    descuento.value = descuento_total;
                } else if(document.querySelector('#checkbox_tienda').checked) {
                    const desc_tienda = document.querySelector('#checkbox_tienda').value;
                    const sumar = parseInt(desc_tienda) + parseInt(descuento_producto);
                    descuento.value = sumar;
    
                    //subtotal
                    var sub_total = precio * cantidad;
                    subtotal.value = sub_total;
    
                    //obtener cantidad de descuento
                    var suma_total_sin = sumar * precio / 100;
                    var calculo = precio - suma_total_sin;
                    var total_pago = calculo * cantidad;
    
                    total.value = total_pago;
                    
                } else {
                    const des = descuento_producto;
                    descuento.value = des;
    
                    //subtotal
                    var sub_total = precio * cantidad;
                    subtotal.value = sub_total;
    
                    //obtener cantidad de descuento
                    var suma_total_sin = descuento_producto * precio / 100;
                    var calculo = precio - suma_total_sin;
                    var total_pago = calculo * cantidad;
    
                    total.value = total_pago;
                }
            } else {
                var total_mayor_10 = precio * cantidad;
                total.value = total_mayor_10;
                subtotal.value = total_mayor_10;
                descuento.value = "N/A";
            }
            
        });
    });
}

function mostrarAlerta(mensaje) { 
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: mensaje,
      });
 }

 function limpiarHTMLProductos() { 
    const form_products = document.querySelector('#form_products .form_products_data');
    while (form_products.firstChild) {
        form_products.removeChild(form_products.firstChild);
    }
  }

  function eliminarDescuentoHTML() {
    const descuento_tienda = document.querySelector('#form_products .descuento_tienda');
    while (descuento_tienda.firstChild) {
        descuento_tienda.removeChild(descuento_tienda.firstChild);
    }
  }