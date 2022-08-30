<?php

Route::get('/', 'PromocionController@inicio');
Route::get('/registrar-compra', 'PromocionController@registrar_compra');
Route::get('/registrar-factura', 'PromocionController@registrar_factura');
Route::get('/verificar_nro_factura', 'PromocionController@verificar_nro_factura');
Route::get('/felicidades', 'PromocionController@felicitaciones');

Route::get('/registrar-participante', function () {
    return view('pages.registrar-participante');
});
Route::get('/bases-y-condiciones', function () {
    return view('pages.condiciones');
});
Route::get('/mecanica', function () {
    return view('pages.mecanica');
});


Route::post('/verificar_es_cliente', 'PromocionController@verificar_es_cliente');
Route::post('/registrar_concursante', 'PromocionController@registrar_concursante');
Route::post('/subir-factura', 'PromocionController@subir_factura');

Route::get('/administrador', 'AdministradoController@inicio');


Auth::routes();

Route::get('/backend', 'HomeController@index')->name('home');
Route::get('/canjes', 'HomeController@canjes')->name('canjes');
Route::get('/obtener_canjes', 'HomeController@obtener_canjes')->name('obtener_canjes');
Route::get('/edit/canje/{id}', 'HomeController@editar_canje')->name('editar_canje');
Route::get('/clientes', 'HomeController@clientes')->name('clientes');
Route::get('/obtener-clientes', 'HomeController@obtener_clientes')->name('obtener_clientes');
Route::post('/editar/canje', 'HomeController@guardar_canje_editado')->name('guardar_canje_editado');
Route::get('/ver/canje/{id}', 'HomeController@ver_canje')->name('ver_canje');
Route::get('/estaciones', 'HomeController@estaciones')->name('estaciones');
Route::get('/obtener_estaciones', 'HomeController@obtener_estaciones')->name('obtener_estaciones');
Route::get('/razones_sociales', 'HomeController@razones_sociales')->name('razones_sociales');
Route::get('/obtener_razones_sociales', 'HomeController@obtener_razones_sociales')->name('obtener_razones_sociales');
