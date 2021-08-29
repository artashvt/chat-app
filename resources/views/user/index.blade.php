@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Create Date</th>
                            </thead>
                            <tbody>
                            @if ($users->isEmpty())
                                <tr>
                                    <td colspan="4">No Users to display.</td>
                                </tr>
                            @endif

                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td><a href="{{url('/users/' . $user->id)}}">{{ $user->name }}</a></td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
