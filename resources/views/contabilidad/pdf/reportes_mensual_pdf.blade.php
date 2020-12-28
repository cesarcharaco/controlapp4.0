<html>
<head>
  @yield('css')
  <style>
    body{
      font-family: sans-serif;
    }
    
    header { 

    }
    footer {
      position: fixed;
      left: 0px;
      bottom: -50px;
      right: 0px;
      height: 40px;
      border-bottom: 2px solid #ddd;
    }
    footer .page:after {
      content: counter(page);
    }
    footer table {
      width: 100%;
    }
    footer p {
      text-align: right;
    }
    footer .izq {
      text-align: left;
    }
    a {
      text-decoration: none;
      color: black;
    }

    table td {
      padding: 5px;
    }
    th {
      text-align: center;
    }
    .logo {
      width: 150px;
      height: 150px;
    }

    .text-right {
      text-align: right;
    }
  </style>
<body>
  <div class="content">
    <p align="center">
      <?php $image_path = '/assets/images/logo.jpg'; ?>
       <table width="100%" border="1" cellpadding="0" cellspacing="0" style="margin-bottom: 10px; ">
          <tr>
            <th rowspan="2"><img src="{{ public_path() . $image_path }}" class="logo"></th>
            <th colspan="3">REPORTE MENSUAL DEL BALANCE GENERAL</th>
          </tr>
         <tr>
           <th>Fecha: <?php echo date('d/m/Y'); ?></th>
           <th>Hora: <?php echo date('h:m A'); ?></th>
           <th>Usuario: {{\Auth::User()->email}}</th>
         </tr>
       </table>
    </p>
    <table width="100%" border="1" cellpadding="0" cellspacing="0">
      <thead>
      <tr>
        <th>Fecha</th>
        <th>Descripción</th>
        <th>Ingreso</th>
        <th>Egreso</th>
        <th>Saldo</th>
      </tr>
      </thead>
      <tbody>
        @foreach($contabilidad as $key)
        <tr>
          <td>{{$key->created_at}}</td>
          <td>{{$key->descripcion}}</td>
          <td>{{$key->ingreso}}</td>
          <td>{{$key->egreso}}</td>
          <td>{{$key->saldo}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>
</html>


