@extends('layouts.admin')

@section('content')




        @if ($currentUser)
            <h1>{{ $currentUser[0]->name }} Leads</h1>
        @else
            <h1>All Leads</h1>
        @endif

    <div class="row">
        <div class="col-md-12">

            <script>
                var base_url = '{{ url('/') }}';
                var base_url_view = '{{ url('/leads/view') }}';

                function goToPage() {
                    var user = document.getElementById('filterUsers').value;
                    window.location = base_url_view + '?userid=' + user;
                }

                function checkIfData() {
                    var selectedLeads = new Array();
                    $("input:checked").each(function () {
                        selectedLeads.push($(this).val());
                    });

                    if (selectedLeads.length > 0) {
                        return selectedLeads;
                    }
                }

                function selectAll(ele) {
                    if ($(ele).is(':checked')) {
                        $(':checkbox').each(function () {
                            this.checked = true;
                        });
                    }else {
                        $(':checkbox').each(function () {
                            this.checked = false;
                        });
                    }
                }
                function exportLeads() {
                    if (checkIfData()){
                        $("#exportData").submit();

                    }
                    //console.log(selectedLeads);
                }

                function deleteLeads() {
                    if (checkIfData()) {
                        if (confirm('Are you sure you want to delete selected leads?')) {
                            $("#exportData").attr('action', '{{ url('/leads/deleteleads') }}');
                            $("#exportData").submit();
                        }
                    }
                }


            </script>
            <label for="filterUsers">Filter Users</label>
            <select name="filterUsers" id="filterUsers">
                    <option value="">All</option>
                @foreach($users as $user)
                    @if ($user->id == $userID)
                        <option selected value="{{$user->id}}">{{$user->name}}</option>
                    @else
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endif

                @endforeach
            </select>


            <button onclick="goToPage()">Filter</button><br/><br/>
            <button onclick="exportLeads()">Export Selected</button>
            <button onclick="deleteLeads()">Delete Selected</button>
            <table class="table responsive">
                <thead>
                <tr>
                    <th><input type="checkbox" name="selectall" id="selectall" onchange="selectAll(this)" /></th>
                    <th>User</th>
                    <th>Lead Source</th>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Job Title</th>
                    <th>Address</th>
                    <th>Telephone</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Fleet Size</th>
                    <th>Vehicle Type</th>
                    <th>Industry</th>
                    <th>Industry Other</th>
                    <th>Customer Type</th>
                    <th>Customer Type Other</th>
                    <th>Product Interest</th>
                    <th>Product Interest Other</th>
                    <th>Newsletter</th>
                    <th>Brochures</th>
                    <th>Next Action</th>
                    <th>Next Action Other</th>
                    <th>Account Manager</th>
                    <th>Notes</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Image</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <form id="exportData" method="POST" action="{{ url('/leads/export/selected') }}">
                @foreach($leads as $lead)
                    @php($fleet = explode(',', $lead->fleet))
                    @php($customerType = explode(',', $lead->customerType))
                    @php($productInterest = explode(',', $lead->productInterest))

<?php
                        $created_at = new DateTime($lead->created_at);
                        $tz = new DateTimeZone('Europe/London'); // or whatever zone you're after
                        $created_at->setTimezone($tz);

                        $updated_at = new DateTime($lead->updated_at);
                        $tzone = new DateTimeZone('Europe/London'); // or whatever zone you're after
                        $updated_at->setTimezone($tzone);
                  ?>



                    <tr>
                        <td><input class="selectLeads" type="checkbox" name="selectedLeads[]" value="{{ $lead->id }}"></td>
                        <td>{{ $lead->username }}</td>
                        <td>{{ $lead->leadsource }}</td>
                        <td>{{ $lead->name }}</td>
                        <td>{{ $lead->company }}</td>
                        <td>{{ $lead->jobTitle }}</td>
                        <td>{{ $lead->address }}</td>
                        <td>{{ $lead->telephone }}</td>
                        <td>{{ $lead->mobile }}</td>
                        <td><a href="mailto:{{ $lead->email }}">{{ $lead->email }}</a></td>
                        <td>{{ $lead->fleetSize }}</td>
                        <td>
                            @foreach($fleet as $fleetSingle)
                                {{ $fleetSingle }}<br />
                            @endforeach
                        </td>


                        <td>{{ $lead->industry }}</td>
                        <td>{{ $lead->industryOther }}</td>
                        <td>
                            @foreach($customerType as $customerSingle)
                                {{ $customerSingle }}<br />
                            @endforeach
                        </td>
                        <td>{{ $lead->customerTypeOther }}</td>

                        <td>
                            @foreach($productInterest as $productSingle)
                                {{ $productSingle }}<br />
                            @endforeach
                        </td>
                        <td>{{ $lead->productInterestOther }}</td>

                        <td>@if($lead->subscribeNewsletters == "true")<i class="entypo-check"></i>@endif</td>
                        <td>@if($lead->subscribeBrochures == "true")<i class="entypo-check"></i>@endif</td>
                        <td>{{ $lead->nextAction }}</td>
                        <td>{{ $lead->nextActionOther }}</td>
                        <td>{{ $lead->accountManager }}</td>
                        <td>{{ $lead->notes }}</td>
                        <td>{{ $created_at->format('d-m-Y H:i:s') }}</td>
                        <td>{{ $updated_at->format('d-m-Y H:i:s') }}</td>
                        <td><a href="{{ $lead->image  }}" data-lightbox="image-{{ $loop->iteration }}"><img src="{{ $lead->image  }}" height="100" width="100" /></a></td>
                        <td><a href="{{ url('leads/delete/'.$lead->id) }}" onclick="return confirm('Are you sure you want to delete this lead?')"><i class="entypo-trash"></i></a></td>
                    </tr>

                @endforeach
                </form>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('css')
    <link href="{{ asset('css/lightbox.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/lightbox.js') }}"></script>
@endpush