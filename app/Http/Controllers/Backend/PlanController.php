<?php

namespace App\Http\Controllers\Backend;

// use App\Http\Requests\Plan\StorePlanRequest;
// use App\Http\Requests\Plan\UpdatePlanRequest;
use App\Models\Role;
use App\Models\Plan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        Gate::authorize('app.plan.index');
        $plan = Plan::get();
        return view('backend.plan.index', compact('plan'));
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.plan.create');

        return view('backend.plan.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $plan = Plan::create([
            'planName' => $request->planName,
            'description' => $request->description,
            'validity' => $request->validity,
            'amount' => $request->amount,
        ]);

        notify()->success('EL plan se agrego con éxito.', 'Added');
        return redirect()->route('app.plan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $plan)
    {
        $plan = Plan::findOrFail($plan);

        return view('backend.plan.show', compact('plan'));
    }

    /**
     * Muestra el formulario para editar el recurso especificado.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        Gate::authorize('app.plan.edit');

        $plan = Plan::findOrFail($id);

        return view('backend.plan.form', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Plan $plan
     * @return \Illuminate\Http\Response
     *
     */
    public function update(Request $request, $id)
    {

        $plan = Plan::findOrFail($id);
        $plan->update([
            'planName' => $request->planName,
            'description' => $request->description,
            'validity' => $request->validity,
            'amount' => $request->amount,
        ]);

        notify()->success('Plan actualizado con éxito.', 'Updated');
        return redirect()->route('app.plan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Plan $plan
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */

    public function destroy(Request $request, $id)
    {
        Gate::authorize('app.plan.destroy');

        $idEntero = intval($id);

        $plan = Plan::findOrFail($id);

        if ($plan->deletable == true) {
            $plan->delete();

            notify()->success("Plan correctamente eliminado", "Deleted");
        } else {
            notify()->error('Sorry you can\'t delete Cliente.', 'Error');
        }
        return redirect()->back();
    }
}
