<?php

use App\Http\Controllers\AdministradoresController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\MetodosPagosController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\RegistroActividadesController;
use App\Http\Controllers\VentasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {
    Route::prefix('Administracion')->group(function () {

        // Ventas
        Route::get('Ventas', [VentasController::class, 'index'])->name('Ventas');

        // MetodosPagos
        Route::get('MetodosPagos', [MetodosPagosController::class, 'index'])->name('MetodosPagos');

        // Clientes
        Route::get('Clientes', [ClientesController::class, 'index'])->name('Clientes'); 
        Route::Post('Clientes/Crear', [ClientesController::class, 'crear'])->name('Clientes.crear');
        Route::Post('Clientes/Editar', [ClientesController::class, 'editar'])->name('Clientes.editar');
        Route::Post('Clientes/Eliminar', [ClientesController::class, 'eliminar'])->name('Clientes.eliminar');

        // Proveedores
        Route::get('Proveedores', [ProveedoresController::class, 'index'])->name('Proveedores');

        // Productos
        Route::get('Productos', [ProductosController::class, 'index'])->name('Productos');
        Route::Post('Productos/Crear', [ProductosController::class, 'crear'])->name('Productos.crear');
        Route::Post('Productos/Editar', [ProductosController::class, 'editar'])->name('Productos.editar');
        Route::Post('Productos/Eliminar', [ProductosController::class, 'eliminar'])->name('Productos.eliminar');

        // Administradores
        Route::get('Administradores', [AdministradoresController::class, 'index'])->name('Administradores');

        // registroActividades
        Route::get('RegistroActividades', [RegistroActividadesController::class, 'index'])->name('RegistroActividades');
        Route::Post('RegistroActividades/eliminar', [RegistroActividadesController::class, 'eliminar'])->name('RegistroActividades.eliminar');

    });
});