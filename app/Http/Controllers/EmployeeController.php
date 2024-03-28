<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeesCollection;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        /*$includeTasks = $request->query('includeTasks');
        if ($includeTasks){
            $employees = $employees->with('tasks');
        }*/
        return new EmployeesCollection($employees);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);
        $newEmployee = new Employee;

        $newEmployee->name = $request->name;
        $newEmployee->password = bcrypt($request->password);
        $newEmployee->email = $request->email;
        $newEmployee->role = $request->role;
        $newEmployee->save();
        return redirect()->route('employee.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id){

        //$employeeData = $employee->with('tasks')->get();

        $employeeData = Employee::Where('id', '=', $id)->with(['tasks' => function ($query) use ($id) {
            $query->where('employee_id', $id);
        }])->get();
        //dd($employeeData);
        return new EmployeeResource($employeeData);
        
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Emoloyee $employee)
    {
        //$editEmployee = Employee::findOrFail($employee);
        return view('employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        /*$updateEmployee = Employee::findOrFail($employee);
        $updateEmployee->name = $request->input('name');
        $updateEmployee->email = $request->input('email');
        $updateEmployee->role = $request->input('role');
        $updateEmployee->save();
        return redirect()->route('employee.index');*/
        $employee->update($request->only('name', 'email', 'role'));
        return redirect()->route('employee.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
