<?php

namespace App\Http\Controllers\Backend;

// use App\Http\Requests\Plan\StorePlanRequest;
// use App\Http\Requests\Plan\UpdatePlanRequest;
use App\Models\Role;
use App\Models\Pay;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class PayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        Gate::authorize('app.pay.index');
        $pay = Plan::get();
        return view('backend.pay.index', compact('pay'));
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.pay.create');

        return view('backend.pay.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $pay = Plan::create([
            'payName' => $request->payName,
            'description' => $request->description,
            'validity' => $request->validity,
            'amount' => $request->amount,
        ]);

        notify()->success('EL pay se agrego con éxito.', 'Added');
        return redirect()->route('app.pay.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plan  $pay
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $pay)
    {
        $pay = Plan::findOrFail($pay);

        return view('backend.pay.show', compact('pay'));
    }

    /**
     * Muestra el formulario para editar el recurso especificado.
     *
     * @param  \App\Models\Plan  $pay
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        Gate::authorize('app.pay.edit');

        $pay = Plan::findOrFail($id);

        return view('backend.pay.form', compact('pay'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Plan $pay
     * @return \Illuminate\Http\Response
     *
     */
    public function update(Request $request, $id)
    {

        $pay = Plan::findOrFail($id);
        $pay->update([
            'payName' => $request->payName,
            'description' => $request->description,
            'validity' => $request->validity,
            'amount' => $request->amount,
        ]);

        notify()->success('Plan actualizado con éxito.', 'Updated');
        return redirect()->route('app.pay.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Plan $pay
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */

    public function destroy(Request $request, $id)
    {
        Gate::authorize('app.pay.destroy');

        $idEntero = intval($id);

        $pay = Plan::findOrFail($id);

        if ($pay->deletable == true) {
            $pay->delete();

            notify()->success("Plan correctamente eliminado", "Deleted");
        } else {
            notify()->error('Sorry you can\'t delete Cliente.', 'Error');
        }
        return redirect()->back();
    }
}
