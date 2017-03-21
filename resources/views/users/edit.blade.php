@extends('layouts.admin')

@section('content')
    <h2>Edit User</h2>

    <div class="row">
        <div class="col-md-12">
            <form role="form" method="post" class="form-horizontal form-groups-bordered validate" action="">

                <div class="row">
                    <div class="col-md-12">

                        <div class="panel panel-primary" data-collapsed="0">

                            <div class="panel-heading">
                                <div class="panel-title">
                                    User Settings
                                </div>
                            </div>

                            <div class="panel-body">

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Name</label>

                                    <div class="col-sm-5">
                                        <input type="hidden" name="id" id="id" value="{{ $users->id }}">
                                        <input type="text" autocomplete="off" class="form-control" name="name" id="name" value="{{ $users->name }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-sm-3 control-label">Email</label>

                                    <div class="col-sm-5">
                                        <input type="email" autocomplete="off" class="form-control" name="email" id="email" value="{{ $users->email }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="col-sm-3 control-label">Update password</label>

                                    <div class="col-sm-5">
                                        <input type="password" autocomplete="off" class="form-control" name="password" id="password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password2" class="col-sm-3 control-label">Confirm Password</label>

                                    <div class="col-sm-5">
                                        <input type="password" autocomplete="off" class="form-control" name="password2" id="password2">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="admin" class="col-sm-3 control-label">Make Admin</label>

                                    <div class="col-sm-5">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="admin" id="admin" @if($users->is_admin == 1) checked @endif>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <div class="form-group default-padding">
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>

            </form>
        </div>
    </div>
@endsection