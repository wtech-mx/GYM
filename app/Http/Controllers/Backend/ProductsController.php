<?php

namespace App\Http\Controllers\Backend;

use App\Models\Products;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        Gate::authorize('app.products.index');
        $products = Products::get();

        return view('backend.products.index', compact('products'));
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.products.create');

        return view('backend.products.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreproductsRequest $request
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $products = Products::create([
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
        ]);

        notify()->success('Productos agregado con éxito.', 'Added');
        return redirect()->route('app.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $products)
    {
        $products = Products::findOrFail($products);

        return view('backend.products.show', compact('products'));
    }


    /**
     * Muestra el formulario para editar el recurso especificado.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        Gate::authorize('app.products.edit');

        $products = Products::findOrFail($id);

        return view('backend.products.form', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductsRequest $request
     * @param products $products
     * @return \Illuminate\Http\Response
     *
     */
    public function update(Request $request, $id)
    {

        $products = Products::findOrFail($id);
        $products->update([
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
        ]);

        notify()->success('Producto actualizado con éxito.', 'Updated');
        return redirect()->route('app.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Products $products
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */

    public function destroy(Request $request, $id)
    {
        Gate::authorize('app.products.destroy');

        $idEntero = intval($id);

        $products = Products::findOrFail($id);

        if ($products->deletable == true) {
            $products->delete();

            notify()->success("Producto correctamente eliminado", "Deleted");
        } else {
            notify()->error('Sorry you can\'t delete Producto.', 'Error');
        }
        return redirect()->back();
    }
}
