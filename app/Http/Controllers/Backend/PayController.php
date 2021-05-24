<?php

namespace App\Http\Controllers\Backend;

// use App\Http\Requests\Plan\StorePlanRequest;
// use App\Http\Requests\Plan\UpdatePlanRequest;
use App\Models\Role;
use App\Models\Pay;
use App\Models\Plan;
use App\Models\Customers;
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
        $pay = Pay::get();
        $customers = Customers::get();
        $plan = Plan::get();
        return view('backend.pay.index', compact('pay', 'customers', 'plan'));
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.pay.create');
        $customers = Customers::get();
        $plan = Plan::get();

        return view('backend.pay.form', compact('plan', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $pay = Pay::create([
            'id_plan' => $request->id_plan,
            'id_user' => $request->id_user,
            'plan_date' => $request->plan_date,
            'expire' => $request->expire,
            'renewal' => $request->renewal,
        ]);

        notify()->success('EL pay se agrego con éxito.', 'Added');
        return redirect()->route('app.pay.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pay  $pay
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $pay)
    {
        $pay = Pay::findOrFail($pay);
        $customers = Customers::get();
        $plan = Plan::get();

        return view('backend.pay.show', compact('pay', 'plan', 'customers'));
    }

    /**
     * Muestra el formulario para editar el recurso especificado.
     *
     * @param  \App\Models\Pay  $pay
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        Gate::authorize('app.pay.edit');

        $pay = Pay::findOrFail($id);
        $customers = Customers::get();
        $plan = Plan::get();

        return view('backend.pay.form', compact('pay', 'plan', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Pay $pay
     * @return \Illuminate\Http\Response
     *
     */
    public function update(Request $request, $id)
    {

        $pay = Pay::findOrFail($id);
        $pay->update([
            'id_plan' => $request->id_plan,
            'id_user' => $request->id_user,
            'plan_date' => $request->plan_date,
            'expire' => $request->expire,
            'renewal' => $request->renewal,
        ]);

        notify()->success('Pay actualizado con éxito.', 'Updated');
        return redirect()->route('app.pay.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Pay $pay
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */

    public function destroy(Request $request, $id)
    {
        Gate::authorize('app.pay.destroy');

        $idEntero = intval($id);

        $pay = Pay::findOrFail($id);

        if ($pay->deletable == true) {
            $pay->delete();

            notify()->success("Pay correctamente eliminado", "Deleted");
        } else {
            notify()->error('Lo sentimos no se puede eliminar el Pago.', 'Error');
        }
        return redirect()->back();
    }
}
