<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/register');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('tickets/publico/crear/', 'TicketController@store')->name('ticket.store');
Route::get('tickest/consultar/{id}/cliente/', 'TicketController@consultar')->name('ticket.consultar');
Route::get('tickest/consultar/{id}/juridica/', 'TicketController@consultarJuridica')->name('ticket.consultarJuridica');

//cambiar contraseñas
Route::get('usuarios/contrasenia/cambiar', 'UsuarioController@vistacontrasenia')->name('usuario.vistacontrasenia');
Route::post('usuarios/contrasenia/cambiar/finalizar', 'UsuarioController@cambiarcontrasenia')->name('usuario.cambiarcontrasenia');
Route::post('usuarios/contrasenia/cambiar/admin/finalizar', 'UsuarioController@cambiarPass')->name('usuario.cambiarPass');

//TODOS LOS MENUS
//GRUPO DE RUTAS PARA LA ADMINISTRACIÓN
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('usuarios', 'MenuController@usuarios')->name('admin.usuarios');
    Route::get('general', 'MenuController@general')->name('admin.general');
    Route::get('mantenimiento', 'MenuController@mantenimiento')->name('admin.mantenimiento');
    Route::get('reporte', 'MenuController@reporte')->name('admin.reporte');
    Route::post('acceso', 'HomeController@confirmaRol')->name('rol');
    Route::get('inicio', 'HomeController@inicio')->name('inicio');
});

//GRUPO DE RUTAS PARA LA ADMINISTRACIÓN DE USUARIOS
Route::group(['middleware' => 'auth', 'prefix' => 'usuarios'], function () {
    //MODULOS
    Route::resource('modulo', 'ModuloController');
    //PAGINAS O ITEMS DE LOS MODULOS
    Route::resource('pagina', 'PaginaController');
    //GRUPOS DE USUARIOS
    Route::resource('grupousuario', 'GrupousuarioController');
    Route::get('grupousuario/{id}/delete', 'GrupousuarioController@destroy')->name('grupousuario.delete');
    Route::get('privilegios', 'GrupousuarioController@privilegios')->name('grupousuario.privilegios');
    Route::get('grupousuario/{id}/privilegios', 'GrupousuarioController@getPrivilegios');
    Route::post('grupousuario/privilegios', 'GrupousuarioController@setPrivilegios')->name('grupousuario.guardar');
    //USUARIOS
    Route::resource('usuario', 'UsuarioController');
    Route::get('usuario/{id}/delete', 'UsuarioController@destroy')->name('usuario.delete');
    Route::post('operaciones', 'UsuarioController@operaciones')->name('usuario.operaciones');
    Route::post('usuario/contrasenia/cambiar/admin/finalizar', 'UsuarioController@cambiarPass')->name('usuario.cambiarPass');
});

//GRUPO DE RUTAS PARA GENERAL
Route::group(['middleware' => 'auth', 'prefix' => 'general'], function () {
    //EQUIPOS
    Route::resource('equipos', 'EquipoController');
    Route::get('equipos/{id}/delete', 'EquipoController@destroy')->name('equipos.delete');
    //TICKETS
    Route::resource('tickets', 'TicketController');
    Route::get('tickets/{id}/delete', 'TicketController@destroy')->name('tickets.delete');
    Route::post('tickets/asignar/empleado/asignar', 'TicketController@asignar')->name('tickets.asignar');
    Route::get('tickets/cambiar/{ticketid}/{estado}/{obs}/estado', 'TicketController@estado')->name('tickets.estado');
    //EMPLEADO
    Route::resource('empleado', 'EmpleadoController');
    Route::get('empleado/{id}/delete', 'EmpleadoController@destroy')->name('empleado.delete');

});


//GRUPO DE RUTAS PARA MANTENIMIENTO
Route::group(['middleware' => 'auth', 'prefix' => 'mantenimiento'], function () {
    //MANTENIMIENTO
    Route::resource('mantenimiento','MantenimientoController');
});
