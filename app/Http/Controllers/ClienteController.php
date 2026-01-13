<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    // Mostrar todos los clientes
    public function index()
    {
        $clientes = DB::table('clientes')->get();
        return view('clientes.index', compact('clientes'));
    }

    // Mostrar formulario de crear cliente
    public function create()
    {
        return view('clientes.create');
    }

    // Guardar nuevo cliente
    public function store(Request $request)
    {
        $request->validate([
            'usuario' => 'required|unique:clientes,usuario',
            'contrasena' => 'required|min:6'
        ]);

        DB::table('clientes')->insert([
            'usuario' => $request->usuario,
            'contrasena' => Hash::make($request->contrasena),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente');
    }

    // Mostrar un cliente específico
    public function show($id)
    {
        $cliente = DB::table('clientes')->where('id', $id)->first();
        return view('clientes.show', compact('cliente'));
    }

    // Mostrar formulario de editar cliente
    public function edit($id)
    {
        $cliente = DB::table('clientes')->where('id', $id)->first();
        return view('clientes.edit', compact('cliente'));
    }

    // Actualizar cliente
    public function update(Request $request, $id)
    {
        $request->validate([
            'usuario' => 'required|unique:clientes,usuario,' . $id,
            'contrasena' => 'nullable|min:6'
        ]);

        $data = [
            'usuario' => $request->usuario,
            'updated_at' => now()
        ];

        if ($request->filled('contrasena')) {
            $data['contrasena'] = Hash::make($request->contrasena);
        }

        DB::table('clientes')
            ->where('id', $id)
            ->update($data);

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente');
    }

    // Eliminar cliente
    public function destroy($id)
    {
        DB::table('clientes')->where('id', $id)->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente');
    }
}
