@extends('layouts.app')

@section('content')
    <div class="container">


        <table class="table">
            <thead>
                <tr>
                    <th>Day</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($workingHours as $day => $hours)
                {{-- @dd($hours) --}}
                    <tr>
                        <td>{{ $day }}</td>
                        @if($hours == null)
                            <td>Closed</td>
                            <td>Closed</td>
                        @else
                            {{-- <td>{{ $hours->start_time }}</td> --}}
                            <td>{{ $hours['open'] }}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

        
      
        <h1>{{ $branch->name }}</h1>
      
        <h3>Branch Images:</h3>
        <div class="row">
             @foreach ($images as $image)
                <div class="col-md-4">
                    
                    <img src="{{ asset('branch_images/' . $image->image_name) }}" alt="{{ $image->image_name }} logo" class="img-thumbnail">
                </div>
            @endforeach 
        </div>
    </div>
@endsection
