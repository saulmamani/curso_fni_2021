<?php

namespace App\Http\Controllers;
use App\Models\Producto;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $txtBuscar = "%";
        if($request->has("txtBuscar"))
        {
            $txtBuscar = $request->txtBuscar;
            $productos = Producto::with(['user:id,email'])
                            ->whereCodigo($txtBuscar)
                            ->orWhere('nombre', 'like', "%{$txtBuscar}%")
                            ->orderBy('precio')
                            ->get();
        }
        else
            $productos = Producto::with(['user:id,email'])->get();

        return response()->json($productos, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $producto = Prducto::create($input);
        return response()->json(["res" => true, "message" => "Registrado correctamente!"], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::with(['user:id,email'])->findOrFail($id);
        return response()->json($producto, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $input = $request->all();
        $producto->udpate($input);
        return response()->json(["res" => true, "message" => "Actualizado correctamente!"], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Producto::destroy($id);
        return response()->json(["res" => true, "message" => "Eliminado correctamente!"], 200);
    }

    public function setLike($id)
    {
        $producto = Producto::find($id);
        $producto->like = $producto->like + 1;
        $producto->save();
        return response()->json(["res" => true, "message" => "Like correcto!"], 200);
    }

    public function setDisLike($id)
    {
        $producto = Producto::find($id);
        $producto->dislike = $producto->dislike + 1;
        $producto->save();
        return response()->json(["res" => true, "message" => "Dislike correcto!"], 200);
    }
}
