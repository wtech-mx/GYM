<?php

namespace App\Http\Controllers\Backend;

use App\Models\Sales;
use App\Models\Customers;
use App\Models\Products;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        Gate::authorize('app.sales.index');
        $sales = Sales::get();
        $customers = Customers::get();
        $products = Products::get();

        return view('backend.sales.index', compact('sales', 'customers', 'products'));
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.sales.create');
        $customers = Customers::get();
        $products = Products::get();

        return view('backend.sales.form', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSalesRequest $request
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $sales = Sales::create([
            'id_user' => $request->id_user,
            'id_product' => $request->id_product,
            'lot' => $request->lot,
            'amount' => $request->amount,
        ]);

        notify()->success('Venta agregado con éxito.', 'Added');
        return redirect()->route('app.sales.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $sales)
    {
        $sales = Sales::findOrFail($sales);
        $customers = Customers::get();
        $products = Products::get();

        return view('backend.sales.show', compact('sales', 'customers', 'products'));
    }


    /**
     * Muestra el formulario para editar el recurso especificado.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        Gate::authorize('app.sales.edit');

        $sales = Sales::findOrFail($id);
        $customers = Customers::get();
        $products = Products::get();

        return view('backend.sales.form', compact('sales', 'customers', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSalesRequest $request
     * @param sales $sales
     * @return \Illuminate\Http\Response
     *
     */
    public function update(Request $request, $id)
    {

        $sales = Sales::findOrFail($id);
        $sales->update([
            'id_user' => $request->id_user,
            'id_product' => $request->id_product,
            'lot' => $request->lot,
            'amount' => $request->amount,
        ]);

        notify()->success('Venta actualizado con éxito.', 'Updated');
        return redirect()->route('app.sales.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Sales $sales
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */

    public function destroy(Request $request, $id)
    {
        Gate::authorize('app.sales.destroy');

        $idEntero = intval($id);

        $sales = Sales::findOrFail($id);

        if ($sales->deletable == true) {
            $sales->delete();

            notify()->success("Venta correctamente eliminado", "Deleted");
        } else {
            notify()->error('Sorry you can\'t delete Venta.', 'Error');
        }
        return redirect()->back();
    }
}
