document.addEventListener('DOMContentLoaded', function () {
    // Inicializar Select2
    $('.select2').select2();

    // Variables globales
    let detalles = [];
    const detallesBody = document.getElementById('detalles-body');
    const totalGeneralElement = document.getElementById('total-general');

    // Selectores
    const selectProveedor = document.getElementById('select-proveedor');
    const selectProducto = document.getElementById('select-producto');
    const inputCantidad = document.getElementById('cantidad');
    const inputPrecio = document.getElementById('precio-unitario');
    const inputSubtotal = document.getElementById('subtotal');
    const btnAgregar = document.getElementById('btn-agregar-detalle');
    const formCompra = document.getElementById('form-compra');

    // Cargar productos cuando se selecciona un proveedor
    $(selectProveedor).on('change', function () {
        const proveedorId = $(this).val();
        
        if (!proveedorId) {
            $(selectProducto).empty().append('<option value="">Seleccione proveedor primero</option>');
            $(selectProducto).prop('disabled', true).trigger('change');
            return;
        }

        // AJAX para obtener productos del proveedor
        $.ajax({
            url: `/compras/productos-por-proveedor/${proveedorId}`,
            method: 'GET',
            success: function(response) {
                $(selectProducto).empty().append('<option value="">Seleccione producto</option>');
                
                response.forEach(function(producto) {
                    $(selectProducto).append(
                        `<option value="${producto.id}" data-precio="${producto.precio_compra}">${producto.nombre}</option>`
                    );
                });
                
                $(selectProducto).prop('disabled', false).trigger('change');
            },
            error: function(xhr) {
                console.error('Error al cargar productos:', xhr.responseText);
                alert('Error al cargar productos del proveedor');
            }
        });
    });

    // Cargar precio al seleccionar producto
    $(selectProducto).on('change', function () {
        const selectedOption = $(this).find('option:selected');
        const precio = selectedOption.data('precio') || 0;
        inputPrecio.value = precio;
        calcularSubtotal();
    });

    // Calcular subtotal al cambiar cantidad o precio
    inputCantidad.addEventListener('input', calcularSubtotal);
    inputPrecio.addEventListener('input', calcularSubtotal);

    function calcularSubtotal() {
        const cantidad = parseFloat(inputCantidad.value) || 0;
        const precio = parseFloat(inputPrecio.value) || 0;
        const subtotal = cantidad * precio;
        inputSubtotal.value = subtotal.toFixed(2);
    }

    // Agregar detalle a la tabla
    btnAgregar.addEventListener('click', function () {
        const productoId = selectProducto.value;
        const productoTexto = selectProducto.options[selectProducto.selectedIndex].text;
        const cantidad = parseFloat(inputCantidad.value);
        const precio = parseFloat(inputPrecio.value);
        const subtotal = parseFloat(inputSubtotal.value);

        if (!productoId || !cantidad || isNaN(cantidad) || cantidad <= 0 || !precio || isNaN(precio) || precio <= 0) {
            alert('Por favor complete todos los campos del detalle correctamente');
            return;
        }

        // Verificar si el producto ya está en los detalles
        const productoExistente = detalles.find(d => d.producto_id == productoId);
        if (productoExistente) {
            if (!confirm('Este producto ya está en la lista. ¿Desea actualizar la cantidad?')) {
                return;
            }
            // Actualizar cantidad y subtotal del producto existente
            productoExistente.cantidad += cantidad;
            productoExistente.subtotal = productoExistente.cantidad * productoExistente.precio_unitario;
        } else {
            // Agregar nuevo detalle
            const detalle = {
                producto_id: productoId,
                producto_nombre: productoTexto,
                cantidad: cantidad,
                precio_unitario: precio,
                subtotal: subtotal
            };
            detalles.push(detalle);
        }

        actualizarTablaDetalles();

        // Limpiar campos
        $(selectProducto).val(null).trigger('change');
        inputCantidad.value = '1';
        inputPrecio.value = '';
        inputSubtotal.value = '';
    });

    // Actualizar tabla de detalles
    function actualizarTablaDetalles() {
        detallesBody.innerHTML = '';
        let totalGeneral = 0;

        detalles.forEach((detalle, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${detalle.producto_nombre}</td>
                <td>${detalle.cantidad}</td>
                <td>${detalle.precio_unitario.toFixed(2)}</td>
                <td>${detalle.subtotal.toFixed(2)}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm btn-eliminar-detalle" data-index="${index}">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;
            detallesBody.appendChild(row);
            totalGeneral += detalle.subtotal;
        });

        totalGeneralElement.textContent = totalGeneral.toFixed(2);

        // Agregar event listeners a los botones de eliminar
        document.querySelectorAll('.btn-eliminar-detalle').forEach(btn => {
            btn.addEventListener('click', function () {
                const index = parseInt(this.getAttribute('data-index'));
                detalles.splice(index, 1);
                actualizarTablaDetalles();
            });
        });
    }

    // Enviar formulario
    formCompra.addEventListener('submit', function (e) {
        e.preventDefault();

        if (detalles.length === 0) {
            alert('Debe agregar al menos un detalle a la compra');
            return;
        }

        // Crear inputs hidden para los detalles
        detalles.forEach((detalle, index) => {
            const inputDetalle = document.createElement('input');
            inputDetalle.type = 'hidden';
            inputDetalle.name = `detalles[${index}][producto_id]`;
            inputDetalle.value = detalle.producto_id;
            formCompra.appendChild(inputDetalle);

            const inputCantidad = document.createElement('input');
            inputCantidad.type = 'hidden';
            inputCantidad.name = `detalles[${index}][cantidad]`;
            inputCantidad.value = detalle.cantidad;
            formCompra.appendChild(inputCantidad);

            const inputPrecio = document.createElement('input');
            inputPrecio.type = 'hidden';
            inputPrecio.name = `detalles[${index}][precio_unitario]`;
            inputPrecio.value = detalle.precio_unitario;
            formCompra.appendChild(inputPrecio);
        });

        // Agregar campos automáticos
        const inputTotal = document.createElement('input');
        inputTotal.type = 'hidden';
        inputTotal.name = 'total';
        inputTotal.value = parseFloat(totalGeneralElement.textContent);
        formCompra.appendChild(inputTotal);

        // Asegurarnos que el proveedor_id está incluido
        const proveedorId = document.getElementById('select-proveedor').value;
        const inputProveedorId = document.createElement('input');
        inputProveedorId.type = 'hidden';
        inputProveedorId.name = 'proveedor_id';
        inputProveedorId.value = proveedorId;
        formCompra.appendChild(inputProveedorId);

        // Asegurarnos que la fecha está incluida
        const fecha = document.getElementById('fecha').value;
        const inputFecha = document.createElement('input');
        inputFecha.type = 'hidden';
        inputFecha.name = 'fecha_compra';
        inputFecha.value = fecha;
        formCompra.appendChild(inputFecha);

        // Enviar formulario
        this.submit();
    });
});