<?php

namespace App\Http\Controllers\Admin\Report;

use App\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

class VisitorController extends Controller
{

    /**
     * Get the performance indicators for the application.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.report.platform.visitors');

        return response()->json([
            'indicators' => $this->indicators->all(60),
            'last_month' => $this->indicators->forDate(Carbon::today()->subMonths(1)),
            'last_year' => $this->indicators->forDate(Carbon::today()->subYears(1)),
        ]);
    }

    public function ban(Request $request, Visitor $visitor)
    {
         $visitor->delete();

        return redirect()->back()->with('success', trans('messages.the_ip_banned'));
    }

    public function unban(Request $request, $id)
    {
         $visitor = Visitor::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->back()->with('success', trans('messages.the_ip_unbanned'));
    }

    // function will process the ajax request
    public function getVisitors(Request $request) {

        $visitors = Visitor::orderBy('hits', 'desc')->withTrashed()->get();

        return Datatables::of($visitors)
            ->addColumn('option', function ($visitor) {
                return view( 'admin.partials.actions.visitor.options', compact('visitor'));
            })
            ->editColumn('last_visits', function($visitor){
                return view( 'admin.partials.actions.visitor.last_visits', compact('visitor'));
            })
            ->rawColumns([ 'last_visits', 'option' ])
            ->make(true);
    }

}
