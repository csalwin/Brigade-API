@extends('layouts.admin')

@section('content')




        @if ($currentUser)
            <h1>{{ $currentUser[0]->name }} Leads</h1>
        @else
            <h1>All Leads</h1>
        @endif

    <div class="row">
        <div class="col-md-12">

            <select name="users" id="users">
                    <option value="">All</option>
                @foreach($users as $user)
                    @if ($user->id == $id)
                        <option selected value="{{$user->id}}">{{$user->name}}</option>
                    @else
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endif

                @endforeach
            </select>
            <script>
                var base_url = '{{ url('/leads/view') }}';

                function goToPage() {
                    var page = document.getElementById('users').value;
                    window.location = base_url + '/' + page;
                }
            </script>
            <button onclick="goToPage()">Filter</button>
            <table class="table responsive">
                <thead>
                <tr>
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
                    <th>Fleet</th>
                    <th>Industry</th>
                    <th>Industry Other</th>
                    <th>Customer Type</th>
                    <th>Product Interest</th>
                    <th>Product Interest Other</th>
                    <th>Newsletter</th>
                    <th>Brochures</th>
                    <th>Next Action</th>
                    <th>Next Action Other</th>
                    <th>Urgency</th>
                    <th>Notes</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Image</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($leads as $lead)
                    @php($fleet = explode(',', $lead->fleet))
                    @php($customerType = explode(',', $lead->customerType))
                    @php($productInterest = explode(',', $lead->productInterest))
                    <tr>
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

                        <td>@if($lead->subscribeNewsletters == true)<i class="entypo-check"></i>@endif</td>
                        <td>@if($lead->subscribeBrochures == true)<i class="entypo-check"></i>@endif</td>
                        <td>{{ $lead->nextAction }}</td>
                        <td>{{ $lead->nextActionOther }}</td>
                        <td>{{ $lead->urgency }}</td>
                        <td>{{ $lead->notes }}</td>
                        <td>{{ $lead->created_at }}</td>
                        <td>{{ $lead->updated_at }}</td>
                        <td><a href="{{ $lead->image  }}" data-lightbox="image-{{ $loop->iteration }}"><img src="{{ $lead->image  }}" height="100" width="100" /></a></td>
                        <td><a href="{{ url('leads/delete/'.$lead->id) }}" onclick="return confirm('Are you sure you want to delete this lead?')"><i class="entypo-trash"></i></a></td>
                    </tr>
                @endforeach
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