<?php
namespace App\Http\Controllers;
use App\Models\DenoatePayDetail;
use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\PayDetail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DenoateExample;
use App\Exports\AllDenoate;
use \Carbon\Carbon;
class MoneyReportController extends Controller
{
	 public function index()
    {
     	$allprojects = Projects::latest()->where('projectStatus',1)->paginate(10);
    	// dd($allprojects);
      return view('dashboard.moneyreport.index')->with([
        'allprojects'=>$allprojects,
      ]);
    }



    public function exportToExcel(Request $request ,$id)
    {
      $startDate = $request->query('startDate');
      $endDate   = $request->query('endDate');
      // $start = Carbon::parse($startDate);
      // $end   = Carbon::parse($endDate);
      // dd($start->month);
      // dd($start->year);
			$request->validate([
				'startDate'=>'required|date',
				'endDate'=>'required|date',
			]);
      // $reportName ="تقرير-شهر-$start->month-سنة-$start->year.xlsx";

	    // if($request->has('export'))
      // {
      //   if($query==null)
      //   {
      //      return view('includes.sperror');
      //   }
      //   else
      //   {
          return Excel::download(new DenoateExample($id,$startDate,$endDate), 'ex.xlsx');
      //   }
      // }

       // return $id;AllDenoate
    }



     public function dDetail($id)
    {
     $allDenoate = DenoatePayDetail::all()->where('projectTable',$id);

      return view('dashboard.moneyreport.projectReport')->with([
        'allDenoate'=>$allDenoate
      ]);
    }

}
