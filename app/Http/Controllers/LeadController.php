<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\leads;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class LeadController extends Controller
{
    public function index() {
        $leads = leads
            ::join('users', 'users.id', '=', 'leads.userID')
            ->get(array('users.name as username', 'leads.leadsource', 'leads.id', 'leads.name as name', 'company', 'address', 'telephone', 'leads.email as email', 'fleet', 'industry', 'customerType', 'productInterest', 'productNotes', 'subscribeNewsletters', 'subscribeBrochures', 'nextAction', 'urgency', 'notes', 'image', 'leads.created_at', 'leads.updated_at'));

        return view('leads.view', compact('leads'));
    }

    public function export() {
        $leads = leads
            ::join('users', 'users.id', '=', 'leads.userID')
            ->get(array('users.name as username', 'leads.leadsource', 'leads.name as name', 'company', 'address', 'telephone', 'leads.email as email', 'fleet', 'industry', 'customerType', 'productInterest', 'productNotes', 'subscribeNewsletters', 'subscribeBrochures', 'nextAction', 'urgency', 'notes', 'leads.created_at', 'leads.updated_at'));

        $filename = 'Lead Export - '.date("d-m-y_G-i-s");
        Excel::create($filename, function($excel) use($leads) {
            $excel->setTitle('Brigade Electronics - All Leads');
            $excel->setCreator('Pete Simmons')
                  ->setCompany('Something Big');
            $excel->sheet('Sheetname', function($sheet) use($leads) {
                $sheet->freezeFirstRow();
                $sheet->fromArray($leads);
                $sheet->row(1, array(
                    'User', 'Lead Source', 'Name', 'Company', 'Address', 'Telephone', 'Email', 'Fleet', 'Industry', 'Customer Type', 'Product Interest', 'Product Notes', 'Subscribe to Newsletter', 'Subscribe to Brochures', 'Next Action', 'Urgency', 'Notes', 'Created At', 'Updated At'
                ));
            });
        })->download('xlsx');
    }

    public function delete($id) {
        $lead = leads::find($id);
        if($lead->delete()) {
            Session::flash('message', "Lead deleted");
            return Redirect::back();
        }
        else {
            Session::flash('message', "Something went wrong");
            return Redirect::back();
        }
    }


    public function api_save(Request $request) {
        $lead = new leads;
        $lead->userID = $request->userID;
        $lead->leadSource = $request->leadSource;
        $lead->name = $request->name;
        $lead->company = $request->company;
        $lead->address = $request->address;
        $lead->telephone = $request->telephone;
        $lead->email = $request->email;
        $lead->fleet = $request->fleet;
        $lead->industry = $request->industry;
        $lead->customerType = $request->customerType;
        $lead->productInterest = $request->productInterest;
        $lead->productNotes = $request->productNotes;
        $lead->subscribeNewsletters = $request->subscribeNewsletters;
        $lead->subscribeBrochures = $request->subscribeBrochures;
        $lead->nextAction = $request->nextAction;
        $lead->urgency = $request->urgency;
        $lead->notes = $request->notes;
        $lead->image = $request->image;
        if($lead->save()){
            return Response::json(['lead' => $lead], 200);

        }
        else {
            return Response::json(['error' => 'Something went wrong'], 500);
        }
    }

    public function api_list() {
        $leads = leads::all();
        return $leads;
    }

    public function api_edit(Request $request) {
        $lead = leads::find($request->id);
        $lead->userID = $request->userID;
        $lead->leadSource = $request->leadSource;
        $lead->name = $request->name;
        $lead->company = $request->company;
        $lead->address = $request->address;
        $lead->telephone = $request->telephone;
        $lead->email = $request->email;
        $lead->fleet = $request->fleet;
        $lead->industry = $request->industry;
        $lead->customerType = $request->customerType;
        $lead->productInterest = $request->productInterest;
        $lead->productNotes = $request->productNotes;
        $lead->subscribeNewsletters = $request->subscribeNewsletters;
        $lead->subscribeBrochures = $request->subscribeBrochures;
        $lead->nextAction = $request->nextAction;
        $lead->urgency = $request->urgency;
        $lead->notes = $request->notes;
        $lead->image = $request->image;
        if($lead->save()){
            return Response::json(['lead' => $lead], 200);

        }
        else {
            return Response::json(['error' => 'Something went wrong'], 500);
        }
    }
}
