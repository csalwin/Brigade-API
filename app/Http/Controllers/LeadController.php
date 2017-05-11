<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\leads;
use App\User;

use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class LeadController extends Controller
{
    public function index($userID = null, Request $request) {

        if ($request->has('userid')) {
            $userID = $request->input('userid');
        }


        $users = User::all();
        $currentUser = null;

        if ($userID){
            $currentUser = User::where('users.id', $userID)->get();
        }

        if ($userID){
            $leads = leads
                ::join('users', 'users.id', '=', 'leads.userID')
                ->where('leads.userID', $userID)
                ->get(array('users.name as username', 'leads.leadsource', 'leads.id', 'leads.name as name', 'company', 'jobTitle', 'address', 'telephone', 'mobile', 'leads.email as email', 'fleetSize', 'fleet', 'industry', 'industryOther', 'customerType','customerTypeOther', 'productInterest', 'productInterestOther', 'subscribeNewsletters', 'subscribeBrochures', 'nextAction', 'nextActionOther', 'accountManager', 'notes', 'image', 'leads.created_at', 'leads.updated_at'));
        }else {
            $leads = leads
                ::join('users', 'users.id', '=', 'leads.userID')
                ->get(array('users.name as username', 'leads.leadsource', 'leads.id', 'leads.name as name', 'company', 'jobTitle', 'address', 'telephone', 'mobile', 'leads.email as email', 'fleetSize', 'fleet', 'industry', 'industryOther', 'customerType','customerTypeOther', 'productInterest', 'productInterestOther', 'subscribeNewsletters', 'subscribeBrochures', 'nextAction', 'nextActionOther', 'accountManager', 'notes', 'image', 'leads.created_at', 'leads.updated_at'));

        }





//        $leads = leads
//            ::join('users', 'users.id', '=', 'leads.userID')
//            ->get(array('users.name as username', 'leads.leadsource', 'leads.id', 'leads.name as name', 'company', 'jobTitle', 'address', 'telephone', 'mobile', 'leads.email as email', 'fleetSize', 'fleet', 'industry', 'industryOther', 'customerType','customerTypeOther', 'productInterest', 'productInterestOther', 'subscribeNewsletters', 'subscribeBrochures', 'nextAction', 'nextActionOther', 'urgency', 'notes', 'image', 'leads.created_at', 'leads.updated_at'));

        return view('leads.view', compact('leads', 'users', 'userID', 'currentUser'));
    }

    public function export() {
        $leads = leads
            ::join('users', 'users.id', '=', 'leads.userID')
            ->get(array('users.name as username', 'leads.leadsource', 'leads.name as name', 'company', 'jobTitle', 'address', 'telephone', 'mobile', 'leads.email as email', 'fleetSize', 'fleet', 'industry', 'industryOther', 'customerType','customerTypeOther', 'productInterest', 'productInterestOther', 'subscribeNewsletters', 'subscribeBrochures', 'nextAction', 'nextActionOther', 'accountManager', 'notes', 'leads.created_at', 'leads.updated_at'));


        $filename = 'Lead Export - '.date("d-m-y_G-i-s");
        Excel::create($filename, function($excel) use($leads) {
            $excel->setTitle('Brigade Electronics - All Leads');
            $excel->setCreator('Pete Simmons')
                  ->setCompany('Something Big');
            $excel->sheet('Sheetname', function($sheet) use($leads) {
                $sheet->freezeFirstRow();
                $sheet->fromArray($leads);
                $sheet->row(1, array(
                    'User', 'Lead Source', 'Name', 'Company','Job Title', 'Address', 'Telephone', 'Mobile', 'Email', 'Fleet Size', 'Fleet', 'Industry', 'Industry Other', 'Customer Type' , 'Customer Type Other', 'Product Interest','Product Interest Other', 'Subscribe to Newsletter', 'Subscribe to Brochures', 'Next Action', 'Next Action Other', 'Account Manager', 'Notes', 'Created At', 'Updated At'
                ));
            });
        })->download('xlsx');
    }
    public function exportSelected() {
        $selectedLeads = Input::get('selectedLeads');

        $leads = leads
            ::join('users', 'users.id', '=', 'leads.userID')
            ->whereIn('leads.id', $selectedLeads)
            ->get(array('users.name as username', 'leads.leadsource', 'leads.name as name', 'company', 'jobTitle', 'address', 'telephone', 'mobile', 'leads.email as email', 'fleetSize', 'fleet', 'industry', 'industryOther', 'customerType','customerTypeOther', 'productInterest', 'productInterestOther', 'subscribeNewsletters', 'subscribeBrochures', 'nextAction', 'nextActionOther', 'accountManager', 'notes', 'leads.created_at', 'leads.updated_at'));

        $filename = 'Lead Export - '.date("d-m-y_G-i-s");
        Excel::create($filename, function($excel) use($leads) {
            $excel->setTitle('Brigade Electronics - All Leads');
            $excel->setCreator('Pete Simmons')
                ->setCompany('Something Big');
            $excel->sheet('Sheetname', function($sheet) use($leads) {
                $sheet->freezeFirstRow();
                $sheet->fromArray($leads);
                $sheet->row(1, array(
                    'User', 'Lead Source', 'Name', 'Company','Job Title', 'Address', 'Telephone', 'Mobile', 'Email', 'Fleet Size', 'Fleet', 'Industry', 'Industry Other', 'Customer Type' , 'Customer Type Other', 'Product Interest','Product Interest Other', 'Subscribe to Newsletter', 'Subscribe to Brochures', 'Next Action', 'Next Action Other', 'Account Manager', 'Notes', 'Created At', 'Updated At'
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

    public function deleteLeads () {
        $selectedLeads = Input::get('selectedLeads');
        $lead = leads::whereIn('leads.id', $selectedLeads);
        if($lead->delete()) {
            Session::flash('message', "Leads deleted");
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
        $lead->jobTitle = $request->jobTitle;
        $lead->address = $request->address;
        $lead->telephone = $request->telephone;
        $lead->mobile = $request->mobile;
        $lead->email = $request->email;
        $lead->fleetSize = $request->fleetSize;
        $lead->fleet = $request->fleet;
        $lead->industry = $request->industry;
        $lead->industryOther = $request->industryOther;
        $lead->customerType = $request->customerType;
        $lead->customerTypeOther = $request->customerTypeOther;
        $lead->productInterest = $request->productInterest;
        $lead->productInterestOther = $request->productInterestOther;
        $lead->productNotes = $request->productNotes;
        $lead->subscribeNewsletters = $request->subscribeNewsletters;
        $lead->subscribeBrochures = $request->subscribeBrochures;
        $lead->nextAction = $request->nextAction;
        $lead->nextActionOther = $request->nextActionOther;
        $lead->accountManager = $request->accountManager;
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
    public function api_userList(Request $request) {
        $user = $request->userID;
        $leads = leads::where('userID', $user)->get();


        foreach ($leads as $lead) {
            $updated_at = new DateTime( $lead->updated_at->toDateTimeString());
            $lead->updated_atConv = $updated_at->format('m/d/Y H:i:s');

        }



        return $leads;
    }

    public function api_edit(Request $request) {
        $lead = leads::find($request->id);
        $lead->userID = $request->userID;
        $lead->leadSource = $request->leadSource;
        $lead->name = $request->name;
        $lead->company = $request->company;
        $lead->jobTitle = $request->jobTitle;
        $lead->address = $request->address;
        $lead->telephone = $request->telephone;
        $lead->mobile = $request->mobile;
        $lead->email = $request->email;
        $lead->fleetSize = $request->fleetSize;
        $lead->fleet = $request->fleet;
        $lead->industry = $request->industry;
        $lead->industryOther = $request->industryOther;
        $lead->customerType = $request->customerType;
        $lead->customerTypeOther = $request->customerTypeOther;
        $lead->productInterest = $request->productInterest;
        $lead->productInterestOther = $request->productInterestOther;
        $lead->productNotes = $request->productNotes;
        $lead->subscribeNewsletters = $request->subscribeNewsletters;
        $lead->subscribeBrochures = $request->subscribeBrochures;
        $lead->nextAction = $request->nextAction;
        $lead->nextActionOther = $request->nextActionOther;
        $lead->accountManager = $request->accountManager;
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
