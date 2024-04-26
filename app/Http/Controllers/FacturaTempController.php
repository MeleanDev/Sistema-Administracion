<?php

namespace App\Http\Controllers;

use App\ProductosCLass;
use App\PuntoVentaClass;
use App\RegistroActividadesClass;
use App\VentaAnalisisClass;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FacturaTempController extends Controller
{
    private $puntoventa;
    private $producto;
    private $registro;
    private $VentaAnalisis;
    const OBJETO = "Factura"; // Define la variable constante OBJETO

    public function __construct(PuntoVentaClass $puntoventa, 
                                ProductosCLass $producto, 
                                RegistroActividadesClass $registro, 
                                VentaAnalisisClass $VentaAnalisis)
    {
        $this->puntoventa = $puntoventa;
        $this->producto = $producto;
        $this->registro = $registro;
        $this->VentaAnalisis = $VentaAnalisis;
    }

    public function index(){

        // datos de la factra
        $dataF = $this->puntoventa->FacturaTempTodos();
        $productoF = $this->puntoventa->ProductoTempTodos();
        $precioTotal = $this->puntoventa->ProductoTempSuma();

        $productos = $this->producto->DatosProducto();

        return view('panelAdmin.factura', compact('dataF', 'productoF', 'productos','precioTotal'));
    }

    public function guardarPro(Request $id){
        try {
            $producto = $this->producto->BuscarProductoid($id->producto);

            $disponible = $producto->cantidad;
            $precio = $producto->precio;
            $comprar = $id->cantidad;

            if ($disponible >= $comprar and $comprar > 0) {
                $preciot = $precio * $comprar;
                $descontar = $disponible - $comprar;

                $this->puntoventa->ProductoTempCrear($producto->nombre, $comprar, $preciot, $precio);

                $this->puntoventa->ProductoDescontar($producto, $descontar);

                return redirect()->route('Factura.crear')->with('correctamente', 'Producto Agregado a la factura');
            }
            return redirect()->route('Factura.crear')->with('incorrectamente', 'Cantidad no disponible del porducto');
        } catch (\Throwable $th) {
            return redirect()->route('Factura.crear')->with('incorrectamente', 'Producto No Agregado a la factura');
        }

    }

    public function eliminar($id){

        try {
            $productoTemp = $this->puntoventa->BuscarProductoid($id); // Obtén el modelo del registro que deseas eliminar
            $producto = $this->producto->BuscarProductoNombre($productoTemp->producto);

            $this->producto->ActualizarCantidadProducto($productoTemp->cantidad,$producto->cantidad,$producto);

            $this->puntoventa->productoTempEliminar($productoTemp);
            
            return redirect()->route('Factura.crear')->with('correctamente', 'Producto Eliminado de la factura');
        } catch (\Throwable $th) {
            return redirect()->route('Factura.crear')->with('incorrectamente', 'Producto No eliminado de la factura');
        }
    }

    public function crearF(){

        $validarExistenciaProduct = $this->puntoventa->ProductoTempSum();

        if ($validarExistenciaProduct >= 1) {
            try {
                // Crear datos de la factura 
                 $datosFactura = $this->puntoventa->RegistroFacturaTemp();
                 $cantidadProduc = $this->puntoventa->ProductoTempSum();
                 $totalCompra = $this->puntoventa->ProductoTempSuma();
                 $this->puntoventa->CrearFacturaCompra($datosFactura, $cantidadProduc, $totalCompra);
     
                 // Carga datos analisis
                 $mes = Carbon::now()->format('F');
                 $actual = $this->VentaAnalisis->Mes($mes);
                 $datosMes = $this->VentaAnalisis->obtenerMes($actual);
     
                     // sumamos las cantidades de compras 
                     $actualCantidad = $datosMes->cantidad;
                     $actualCompra = $datosMes->Compras;
                     
                     // Sumamos las compras  
                     $sumaCantidad = $actualCantidad + $totalCompra;
                     $sumaCompra = $actualCompra + 1;
     
                 // Cargamos el registro
                 $this->VentaAnalisis->SumarCompraMes($datosMes, $sumaCompra, $sumaCantidad);
     
                 // Registramos los productos en la BD
                 $productosGuardar = $this->puntoventa->ProductoTempTodos();
                 $this->producto->ventas($productosGuardar);
                 $this->puntoventa->guardarProductos( $productosGuardar ,$datosFactura->factura);
     
                 // Registramos la actividad
                 $this->registro->ActividadRegistro($datosFactura->factura, "Creo una", self::OBJETO);
     
                 // renicial tablas de facturatemp y productofactura
                 $this->puntoventa->reinicialTablas();
     
                 return redirect()->route('PuntoVentas')->with('correctamente', 'Factura Creada Exitosamente');
             } catch (\Throwable $th) {
                 return redirect()->route('PuntoVentas')->with('incorrectamente', 'Factura No Creada');
             }
        }
        return redirect()->route('PuntoVentas')->with('incorrectamente', 'No se puede Crear una factura sin sus productos');
    }
}