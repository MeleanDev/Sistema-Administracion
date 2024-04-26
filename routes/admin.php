<?php

use App\Http\Controllers\AdministradoresController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacturaTempController;
use App\Http\Controllers\MetodosPagosController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\PuntoVentaController;
use App\Http\Controllers\RegistroActividadesController;
use App\Http\Controllers\VentasController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('Sistema')->group(function () {

        Route::get('/PanelPrincipal', [DashboardController::class, 'index'])->name('dashboard');
        
        // Punto de venta
        Route::get('PuntoDeVenta', [PuntoVentaController::class, 'index'])->name('PuntoVentas');
        Route::post('PuntoDeVenta/datos', [PuntoVentaController::class, 'CrearFactura'])->name('PuntoVentas.crear');
        Route::post('PuntoDeVenta/CompraRealizada/borrar', [PuntoVentaController::class, 'borrarF'])->name('PuntoVentas.borrar');

        // Factura
        Route::get('Factura/Crear', [FacturaTempController::class, 'index'])->name('Factura.crear');
        Route::post('Factura/guardarProducto', [FacturaTempController::class, 'guardarPro'])->name('Factura.guardarPro');
        Route::get('Factura/eliminarProducto/{id}', [FacturaTempController::class, 'eliminar'])->name('Factura.eliminar');
        Route::get('Factura/CompraRealizada', [FacturaTempController::class, 'crearF'])->name('Compra.crear');
        
        // Ventas
        Route::get('Ventas', [VentasController::class, 'index'])->name('Ventas');

        // Clientes
        Route::get('Clientes', [ClientesController::class, 'index'])->name('Clientes'); 
        Route::Post('Clientes/Crear', [ClientesController::class, 'crear'])->name('Clientes.crear');
        Route::Post('Clientes/Editar', [ClientesController::class, 'editar'])->name('Clientes.editar');
        Route::Post('Clientes/Eliminar', [ClientesController::class, 'eliminar'])->name('Clientes.eliminar');

        // Proveedores
        Route::get('Proveedores', [ProveedoresController::class, 'index'])->name('Proveedores');
        Route::Post('Proveedores/Crear', [ProveedoresController::class, 'crear'])->name('Proveedores.crear');
        Route::Post('Proveedores/Editar', [ProveedoresController::class, 'editar'])->name('Proveedores.editar');
        Route::Post('Proveedores/Eliminar', [ProveedoresController::class, 'eliminar'])->name('Proveedores.eliminar');

        // Productos
        Route::get('Productos', [ProductosController::class, 'index'])->name('Productos');
        Route::Post('Productos/Crear', [ProductosController::class, 'crear'])->name('Productos.crear');
        Route::Post('Productos/Editar', [ProductosController::class, 'editar'])->name('Productos.editar');
        Route::Post('Productos/Eliminar', [ProductosController::class, 'eliminar'])->name('Productos.eliminar');

        // Administradores
        Route::get('Administradores', [AdministradoresController::class, 'index'])->name('Administradores');
        Route::put('Administradores/editar/{id}', [AdministradoresController::class, 'editar'])->name('Administradores.editar');
        Route::post('Administradores/guardar', [AdministradoresController::class, 'crear'])->name('Administradores.guardar');
        Route::get('Administradores/eliminar/{id}', [AdministradoresController::class, 'eliminar'])->name('Administradores.eliminar');

        // registroActividades
        Route::get('RegistroActividades', [RegistroActividadesController::class, 'index'])->name('RegistroActividades');
        Route::Post('RegistroActividades/eliminar', [RegistroActividadesController::class, 'eliminar'])->name('RegistroActividades.eliminar');

    });
});