<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Customers\StoreCustomersRequest;
use App\Http\Requests\Customers\UpdateCustomersRequest;
use App\Models\Role;
use App\Models\Customers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        Gate::authorize('app.customers.index');
        $customers = Customers::get();
        return view('backend.customers.index', compact('customers'));
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.customers.create');

        return view('backend.customers.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCustomersRequest $request
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $customers = Customers::create([
            'username' => $request->username,
            'gender' => $request->gender,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'date_birth' => $request->date_birth,
            'joining_date' => $request->joining_date,
        ]);

        notify()->success('Los clientes agregaron con éxito.', 'Added');
        return redirect()->route('app.customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function show(Customers $customers)
    {
        return view('backend.customers.show', compact('customers'));
    }

    /**
     * Muestra el formulario para editar el recurso especificado.
     *
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        Gate::authorize('app.customers.edit');

        $customers = Customers::findOrFail($id);

        return view('backend.customers.form', compact('customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCustomersRequest $request
     * @param Customers $customers
     * @return \Illuminate\Http\Response
     *
     */
    public function update(Request $request, $id)
    {

        $customers = Customers::findOrFail($id);
        $customers->update([
            'username' => $request->username,
            'gender' => $request->gender,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'date_birth' => $request->date_birth,
            'joining_date' => $request->joining_date,
        ]);

        notify()->success('Clientes actualizados con éxito.', 'Updated');
        return redirect()->route('app.customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customers $customers
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */

    public function destroy(Request $request, $id)
    {
        Gate::authorize('app.menus.destroy');

        $idEntero= intval($id);

        $customers = Customers::findOrFail($id);

        if ($customers->deletable == true)
        {
            $customers->delete();

            notify()->success("Cliente correctamente eliminado", "Deleted");
        } else  {
            notify()->error('Sorry you can\'t delete Cliente.', 'Error');
        }
        return redirect()->back();
    }

}
