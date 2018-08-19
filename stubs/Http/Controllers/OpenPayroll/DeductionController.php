<?php

namespace App\Http\Controllers\OpenPayroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = \App\Models\OpenPayroll\DeductionType::all();

        return view('deductions.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'payslip' => 'required',
            'type'    => 'required',
            'amount'  => 'required',
        ]);

        $payslip = \App\Models\OpenPayroll\Payslip::with('payroll', 'user')->findByHashslugOrId($request->payslip);
        $type    = \App\Models\OpenPayroll\DeductionType::find($request->type);

        $payslip->deductions()->create([
            'user_id'           => $payslip->user_id,
            'payroll_id'        => $payslip->payroll_id,
            'deduction_type_id' => $request->type,
            'name'              => $type->name,
            'description'       => $type->name,
            'amount'            => money()->toMachine($request->amount),
        ]);

        swal()->success('Deduction', 'You have successfully added new earning.');

        return redirect()->route('payslip.show', $request->payslip);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Models\OpenPayroll\Deduction::hashslug($id)->delete();

        swal()->success('Deduction', 'You have successfully delete an earning.');

        return back();
    }
}
