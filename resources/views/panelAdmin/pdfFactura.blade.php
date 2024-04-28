<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Factura</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <style>
    .table {
      margin-top: 20px;
    }
    .resumen {
      border: 1px solid #ddd;
      padding: 10px;
    }
    .firma {
      text-align: right;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h1>Factura</h1>
      </div>
      <div class="col-md-6 text-right">
        <p><strong>Factura N°:</strong> {{$idfactura}}</p>
        <p><strong>Fecha de emision:</strong> {{$fechacreacion}}</p>
      </div>
    </div>
  </div>

  <div class="container">
    <h3>Datos del cliente</h3>
    <address>
        Nombre y Apellido: {{$clienteNo}}<br>
        Cedula: {{$ClienteCe}}<br>
        Teléfono: {{$ClienteTe}}<br>

    </address>
  </div>

  <div class="container">
    <h3>Datos de la empresa</h3>
    <address>
      {{$nombre}}<br>
      Direccion: {{$direccion}}<br>
      Teléfono: {{$telefono}}<br>
      Correo electrónico: {{$correo}}
    </address>
  </div>

  <div class="container">
    <h3>Productos / {{$cantidadProductos}}</h3>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Num</th>
          <th>Producto</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($productoFactura as $produc)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$produc->producto}}</td>
            <td>{{$produc->precioUni}}</td>
            <td>{{$produc->cantidad}}</td>
            <td>{{$produc->precio}}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
          <tr>
            <th colspan="4">Total general</th>
            <th>{{$cantidadVenta}}</th>
          </tr>
        </tfoot>
      </table>
    </div>
  
    <div class="container firma">
      <p>---------------------------------------------</p>
      <p>Firma y sello de la empresa</p>
    </div>
  
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
  </body>
  </html>
  

