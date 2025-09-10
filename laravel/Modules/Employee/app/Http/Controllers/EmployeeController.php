<?php

<<<<<<< HEAD
declare(strict_types=1);

namespace Modules\Employee\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
=======
namespace Modules\Employee\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
>>>>>>> cda86dd (.)

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
<<<<<<< HEAD
    public function index(): View
=======
    public function index()
>>>>>>> cda86dd (.)
    {
        return view('employee::index');
    }

    /**
     * Show the form for creating a new resource.
     */
<<<<<<< HEAD
    public function create(): View
    {
        /** @var view-string $view */
        $view = 'employee::create';

        return view($view);
=======
    public function create()
    {
        return view('employee::create');
>>>>>>> cda86dd (.)
    }

    /**
     * Store a newly created resource in storage.
     */
<<<<<<< HEAD
    public function store(Request $request): Response
    {
        // TODO: Implement store logic
        return response()->noContent();
    }
=======
    public function store(Request $request) {}
>>>>>>> cda86dd (.)

    /**
     * Show the specified resource.
     */
<<<<<<< HEAD
    public function show(int $id): View
    {
        /** @var view-string $view */
        $view = 'employee::show';

        return view($view);
=======
    public function show($id)
    {
        return view('employee::show');
>>>>>>> cda86dd (.)
    }

    /**
     * Show the form for editing the specified resource.
     */
<<<<<<< HEAD
    public function edit(int $id): View
    {
        /** @var view-string $view */
        $view = 'employee::edit';

        return view($view);
=======
    public function edit($id)
    {
        return view('employee::edit');
>>>>>>> cda86dd (.)
    }

    /**
     * Update the specified resource in storage.
     */
<<<<<<< HEAD
    public function update(Request $request, int $id): Response
    {
        // TODO: Implement update logic
        return response()->noContent();
    }
=======
    public function update(Request $request, $id) {}
>>>>>>> cda86dd (.)

    /**
     * Remove the specified resource from storage.
     */
<<<<<<< HEAD
    public function destroy(int $id): Response
    {
        // TODO: Implement destroy logic
        return response()->noContent();
    }
=======
    public function destroy($id) {}
>>>>>>> cda86dd (.)
}
