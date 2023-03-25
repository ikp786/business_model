@extends('layouts.app')

@section('content')
    @include('layouts.validation_message')
    <div class="container">
        <form method="POST" action="{{ route('branches.store') }}" id="branch-form" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="business_id">Select Branch:</label>
                <input type="text" class="form-control" name="name">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="business_id">Select Business:</label>
                <select class="form-control" name="business_id" id="business_id">
                    <option value="">-- Select Business --</option>
                    @foreach ($businesses as $business)
                        <option value="{{ $business->id }}">{{ $business->name }}</option>
                    @endforeach
                </select>
                @error('business_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                
            </div>

            <div class="form-group">
                <label for="working_days">Working Week Days:</label>
                <div class="row ml-1">
                    @foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                        <div class="col-auto">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="{{ $day }}"
                                    name="working_days[]" value="{{ $day }}">
                                <label class="custom-control-label" for="{{ $day }}">{{ $day }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group" id="day-times-container">
                <table class="table table-striped table-bordered" id="day-times-table">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>
                                <button type="button" class="btn btn-sm btn-primary" id="add-day-time"><i
                                        class="fas fa-plus"></i>Plus +</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="day-time-row">
                            <td>
                                <select class="form-control" name="day_of_week[]">
                                    <option value="0">Sunday</option>
                                    <option value="1">Monday</option>
                                    <option value="2">Tuesday</option>
                                    <option value="3">Wednesday</option>
                                    <option value="4">Thursday</option>
                                    <option value="5">Friday</option>
                                    <option value="6">Saturday</option>
                                </select>
                            </td>
                            <td><input type="time" class="form-control" name="start_time[]"></td>
                            <td><input type="time" class="form-control" name="end_time[]"></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger remove-day-time"><i
                                        class="fas fa-minus"></i>minus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                @error('working_days')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="business_id">Images</label>
                <input type="file" multiple class="form-control" name="images[]">
            </div>
            <button type="submit" class="btn btn-primary">Add Branch</button>


        </form>
    </div>
@endsection

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Custom JS -->


<!-- jQuery -->
{{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
<script>
    $(document).ready(function() {
        // add a new day/time row when the Add button is clicked
        $('#add-day-time').on('click', function() {
            var row = $('.day-time-row').first().clone();
            $('select[name="day_of_week[][]"]', row).val('');
            $('input[name="start_time[][]"]', row).val('');
            $('input[name="end_time[][]"]', row).val('');
            $('#day-times-table tbody').append(row);
        });

        // remove the current day/time row when the Remove button is clicked
        $('#day-times-table').on('click', '.remove-day-time', function() {
            $(this).closest('.day-time-row').remove();
        });
    });
</script>

<script>
    $(function() {
        $('#business_id').on('change', function() {
            var selected = $(this).val();
            if (selected) {
                $('#branch-form').prop('disabled', false);
            } else {
                $('#branch-form').prop('disabled', true);
            }
        });
    });
</script>
