<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Compra #{{ str_pad($compra->id, 6, '0', STR_PAD_LEFT) }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 13px;
            margin: 40px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 24px;
            color: #c40000;
            margin-bottom: 5px;
        }

        .header h3 {
            font-size: 16px;
            font-weight: normal;
            margin: 0;
            color: #555;
        }

        .header .factura-label {
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            border-top: 2px solid #c40000;
            display: inline-block;
            padding-top: 5px;
        }

        .info, .totales {
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .info p, .totales p {
            margin: 4px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 13px;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #c40000;
            color: #fff;
        }

        td.descripcion {
            text-align: left;
        }

        .totales p {
            font-size: 14px;
            font-weight: bold;
            text-align: right;
        }

        .firma {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }

        .firma div {
            width: 45%;
            text-align: center;
        }

        .firma-linea {
            margin-top: 50px;
            border-top: 1px solid #000;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 11px;
            color: #666;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>MISTER CHEF</h1>
        <h3>Pasión por la cocina</h3>
        <div class="factura-label">Orden de Compra</div>
    </div>

    <div class="info">
        <p><strong>Compra N°:</strong> {{ str_pad($compra->id, 6, '0', STR_PAD_LEFT) }}</p>
        <p><strong>Fecha:</strong> {{ $compra->created_at->format('d/m/Y H:i') }}</p>
        <p><strong>Proveedor:</strong> {{ $compra->proveedor->nombre ?? 'N/A' }}</p>
        <p><strong>Documento:</strong> {{ $compra->proveedor->documento ?? 'N/A' }}</p>
        <p><strong>Dirección:</strong> {{ $compra->proveedor->direccion ?? 'N/A' }}</p>
    </div>

    @php
        $total = 0;
    @endphp

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Valor unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($compra->detallesCompra as $detalle)
                @php
                    $subtotal = $detalle->cantidad * $detalle->precio_unitario;
                    $total += $subtotal;
                @endphp
                <tr>
                    <td>{{ $detalle->producto->id ?? 'N/A' }}</td>
                    <td class="descripcion">{{ $detalle->producto->nombre ?? 'Producto no disponible' }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>$ {{ number_format($detalle->precio_unitario ?? 0, 2) }}</td>
                    <td>$ {{ number_format($subtotal, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay productos en esta compra.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="totales">
        <p>Total de la compra: $ {{ number_format($total, 2) }}</p>
    </div>

    <div class="firma">
        <div>
            <div class="firma-linea"></div>
            <p>Firma del Emisor</p>
        </div>
        <div>
            <div class="firma-linea"></div>
            <p>Firma del Proveedor</p>
        </div>
    </div>

    <div class="footer">
        <p>Gracias por confiar en Mister Chef</p>
    </div>

</body>
</html>
