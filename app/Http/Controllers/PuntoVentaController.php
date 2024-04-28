<?php

namespace App\Http\Controllers;
use App\ClientesClass;
use App\Models\FacturaTemp;
use App\ProductosCLass;
use App\PuntoVentaClass;
use App\RegistroActividadesClass;
use App\VentaAnalisisClass;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PuntoVentaController extends Controller
{
    private $puntoventa;
    private $clientes;
    private $registro;
    private $VentaAnalisis;
    private $producto;
    const OBJETO = "Factura"; // Define la variable constante OBJETO

    public function __construct(PuntoVentaClass $puntoventa, 
                                ClientesClass $clientes,
                                RegistroActividadesClass $registro,
                                VentaAnalisisClass $VentaAnalisis,
                                ProductosCLass $producto)
    {
        $this->puntoventa = $puntoventa;
        $this->clientes = $clientes;
        $this->registro = $registro;
        $this->VentaAnalisis = $VentaAnalisis;
        $this->producto = $producto;
    }

    public function index(Request $request){
        if ($request->ajax()) {
            $datos = $this->puntoventa->DatosFacturas();
            return datatables()->of($datos)->toJson();
        } 
        $existeRegistro = FacturaTemp::existeRegistro('id', 1);
        $clientes = $this->clientes->DatosClientes();
        $facturas = $this->puntoventa->DatosFacturas();
        return view('panelAdmin.puntoVenta', compact('clientes', 'existeRegistro', 'facturas'));
    }

    public function CrearFactura(Request $data){
        try {
            // devolver los producto de factura no terminada
            $this->puntoventa->reinicialProductoF();

            // renicial tablas de facturatemp y productofactura
            $this->puntoventa->reinicialTablas();
            
            // se agarran los datos de $data para empezar con la factura con los datos del cliente
            $factura = $this->puntoventa->Factura($data->factura);
            if ($factura) {
                return redirect()->route('PuntoVentas')->with('incorrectamente', 'Codigo de factura ya existente');
            }
            $this->puntoventa->ClienteFactura($data);
            return redirect()->route('Factura.crear');
        } catch (\Throwable $th) {
            return redirect()->route('PuntoVentas')->with('incorrectamente', 'Cliente no encontrado en la base de dato');
        }
    }

    public function borrarF(Request $data){
        try {

            // Obtenemos los productos de la factura 
            $productos = $this->puntoventa->ProductosFactura($data['id']); 
            $this->puntoventa->DevolverProductos($productos);
            $this->producto->ventasResta($productos);
            $this->puntoventa->BorrarProductos($productos);
            
            // la factura
            $factura = $this->puntoventa->Factura($data['id']);
            
            // descontamos los datos ingresados al analisis
            $mes = $factura->created_at->format('F');
            $actual = $this->VentaAnalisis->Mes($mes);
            $datosMes = $this->VentaAnalisis->obtenerMes($actual);

            $CompraMes = $datosMes->Compras;
            $CantidadMes = $datosMes->cantidad;
            $cantidaFactura = $factura->totalCompra;
            
            $quitarCompra = $CantidadMes - $cantidaFactura;
            $quitarUno = $CompraMes - 1;
            
            $this->VentaAnalisis->SumarCompraMes($datosMes,  $quitarUno, $quitarCompra);
            
            // Eliminamos Factura 
            $factura->delete();
            $this->registro->ActividadRegistro($data['id'], "Elimino una", self::OBJETO);
            
            $respuesta = response()->json(['success' => true]); 
            } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true]); 
            }
            return $respuesta;
    }

    public function pdf(Request $datos){

        $idfactura = $datos->imprime;

        $datoFactura = $this->puntoventa->Factura($idfactura);
        $cantidadProductos = $datoFactura->cantidadProducto;
        $cantidadVenta = $datoFactura->totalCompra;

        $cedulaCliente = $datoFactura->cedula;
        $datoCliente = $this->clientes->BuscarClienteCedula($cedulaCliente);

        $clienteNo = $datoCliente->nombre." ".$datoCliente->apellido;
        $ClienteCe = $datoCliente->cedula;
        $ClienteTe = $datoCliente->telefono;

        $productoFactura = $this->puntoventa->ProductosFactura($idfactura);

        $pdf = Pdf::loadView('panelAdmin.pdfFactura', [
            'ClienteTe' => $ClienteTe,
            'ClienteCe' => $ClienteCe,
            'clienteNo' => $clienteNo,
            'cantidadVenta' => $cantidadVenta,
            'cantidadProductos' => $cantidadProductos,
            'productoFactura' => $productoFactura,
            'idfactura' => $idfactura,
        ]);

        return $pdf->download('FacturaCliente.pdf');
    }
}