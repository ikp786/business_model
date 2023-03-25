@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> 
                <a href="{{ route('business.create') }}">
                  Add Business
                </a>  
                </div>
                @include('layouts.auth_message')
                
                <div class="card-body">
                  
                  
                  <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Logo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($businesses as $business)
                        <tr>
                            <td>{{ $business->name }}</td>
                            <td>{{ $business->email }}</td>
                            <td>{{ $business->phone_number }}</td>
                            <td>
                                @if($business->logo)
                                    <img src="{{ asset('business_logo/' . $business->logo) }}" alt="{{ $business->name }} logo" width="50">
                                @endif
                            </td>
                            <td>
                                {{-- <a href="{{ route('business.edit', $business->id) }}" class="btn btn-primary btn-sm">Edit</a> --}}
                                <form action="{{ route('business.destroy', $business->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
