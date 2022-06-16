@extends('layouts.app')


@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users Management</h2>
            @foreach($data as $key => $user)
            @endforeach
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User </a>
            <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit Profile</a>
        </div>
    </div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Roles</th>
        <th>Actions</th>
        <!-- <th width="280px">Action</th> -->
    </tr>
    @foreach ($data as $key => $user)
    <tr>
        @if(!(Auth::user()->name==$user->name))
        <td>{{ ++$i }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            @foreach($user->getRoleNames() as $v)
            <label>{{ $v }}</label>
            @endforeach
        </td>
        <td>
            <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>

            @if(Auth::user()->name==$user->name)
            @can('user-edit')
            <!-- <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a> -->
            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
            @endcan
            @endif
        </td>
        @endif
    </tr>

    @endforeach

</table>


{!! $data->render() !!}

@endsection
