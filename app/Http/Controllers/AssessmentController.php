<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class AssessmentController extends Controller
{
    /**
     * retorna una tabla de datos con los cumplimientos
     * de todas las instituciones.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = DB::table('fulfillments')
            ->join('institutions', 'fulfillments.institution_id', '=', 'institutions.id')
            ->join('milestones', 'fulfillments.milestone_id', '=', 'milestones.id')
            ->select('fulfillments.*', 'institutions.name', 'milestones.*');

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editActivity">Editar</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteActivity">Borrar</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $fulfillment = \App\Fulfillment::all();

        return view('assessment.index', compact('fulfillment'));

    }
}
