document.addEventListener('DOMContentLoaded', function () {
    // Inicializar Select2
    $('.select2').select2();

    // Variables globales
    let detalles = [];
    const detallesBody = document.getElementById('detalles-body');
    const totalGeneralElement = document.getElementById('total-general');

    // Selectores
    const selectProducto = document.getElementById('select-producto');
    const inputCantidad = document.getElementById('cantidad');
    const inputPrecio = document.getElementById('precio-unitario');
    const inputSubtotal = document.getElementById('subtotal');
    const btnAgregar = document.getElementById('btn-agregar-detalle');
    const formFactura = document.getElementById('form-factura');

    // Cargar precio al seleccionar producto
    $(selectProducto).on('change', function () {
        const selectedOption = $(this).find('option:selected');
        const precio = selectedOption.data('precio') || 0;
        inputPrecio.value = precio;
        calcularSubtotal();
    });

    // Calcular subtotal al cambiar cantidad
    inputCantidad.addEventListener('input', calcularSubtotal);

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

        if (!productoId || !cantidad || isNaN(cantidad) || cantidad <= 0) {
            alert('Por favor complete todos los campos del detalle correctamente');
            return;
        }

        // Agregar a array de detalles
        const detalle = {
            producto_id: productoId,
            producto_nombre: productoTexto,
            cantidad: cantidad,
            precio_unitario: precio,
            subtotal: subtotal
        };

        detalles.push(detalle);
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
    formFactura.addEventListener('submit', function (e) {
        e.preventDefault();

        if (detalles.length === 0) {
            alert('Debe agregar al menos un detalle a la factura');
            return;
        }

        // Crear inputs hidden para los detalles
        detalles.forEach((detalle, index) => {
            const inputDetalle = document.createElement('input');
            inputDetalle.type = 'hidden';
            inputDetalle.name = `detalles[${index}][producto_id]`;
            inputDetalle.value = detalle.producto_id;
            formFactura.appendChild(inputDetalle);

            const inputCantidad = document.createElement('input');
            inputCantidad.type = 'hidden';
            inputCantidad.name = `detalles[${index}][cantidad]`;
            inputCantidad.value = detalle.cantidad;
            formFactura.appendChild(inputCantidad);

            const inputPrecio = document.createElement('input');
            inputPrecio.type = 'hidden';
            inputPrecio.name = `detalles[${index}][precio_unitario]`;
            inputPrecio.value = detalle.precio_unitario;
            formFactura.appendChild(inputPrecio);
        });

        // Agregar campos automáticos
        const inputEstado = document.createElement('input');
        inputEstado.type = 'hidden';
        inputEstado.name = 'estado';
        inputEstado.value = 'Activo';
        formFactura.appendChild(inputEstado);

        const inputTotal = document.createElement('input');
        inputTotal.type = 'hidden';
        inputTotal.name = 'total';
        inputTotal.value = parseFloat(totalGeneralElement.textContent);
        formFactura.appendChild(inputTotal);

        // Asegurarnos que el cliente_id está incluido
        const clienteId = document.getElementById('select-cliente').value;
        const inputClienteId = document.createElement('input');
        inputClienteId.type = 'hidden';
        inputClienteId.name = 'cliente_id';
        inputClienteId.value = clienteId;
        formFactura.appendChild(inputClienteId);

        // Asegurarnos que la fecha está incluida
        const fecha = document.getElementById('fecha').value;
        const inputFecha = document.createElement('input');
        inputFecha.type = 'hidden';
        inputFecha.name = 'fecha';
        inputFecha.value = fecha;
        formFactura.appendChild(inputFecha);

        // Enviar formulario
        this.submit();
    });
});