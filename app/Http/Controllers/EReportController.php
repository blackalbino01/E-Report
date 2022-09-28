<?php

namespace App\Http\Controllers;

use App\Models\EReport;
use Illuminate\Http\Request;

use Validator;

class EReportController extends Controller
{
    protected $data = [];
    protected $response = "";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports= EReport::all();

        foreach ($reports as $report) {
            $this->data[] = [
                'full_name' => $report->full_name,
                'email' => $report->email,
                'phone_number' => $report->report,
                'state_code' => $report->state_code,
                'subject' => $report->subject,
                'report' => $report->report,
            ];
        }

        return response()->json($this->data) ;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $status= EReport::where([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone_number' => $request->report,
            'state_code' => $request->state_code,
            'subject' => $request->subject,
            'report' => $request->report
            ])
            ->first();

        if (!isset($status)) 
        {
            // Form validation
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string',
                'email' => 'required|email',
                'phone_number' => 'required|string',
                'state_code' => 'required|string',
                'subject' => 'required|string',
                'report' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => "fill all required field"
                ], 400);
            }

            
            //  Store data in database
            $report = EReport::create($request->all());

            return response()->json([
                'message' => 'E-Report Application submited Successfully!',
                'data' => $report
            ], 201);
           
        }
        return response()->json([
            'message' => 'Sorry! You have already submitted the E-Report request '
        ],403);
    }
}
