@extends('layouts.app')

@section('content')

    <body id="page-top">
        <div id="wrapper">

            @include('layouts.sidebar')

            <div id="content-wrapper" class="d-flex flex-column">

                <div id="content">
                    @include('layouts.navbar')

                    <div class="container-fluid">
                        <div class="row">
                            @include('layouts.flash')
                            <div class="col-md-8">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Train Schedule List</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered w-100" id="dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Train</th>
                                                        <th>Location</th>
                                                        <th>Slot</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($schedules as $keySchedule=> $schedule)
                                                        <tr>
                                                            <td class="align-middle">{{ $keySchedule + 1 }}</td>
                                                            <td class="align-middle">
                                                                {{ $schedule['traindata']->alias }}
                                                            </td>
                                                            <td class="align-middle">{{ $schedule['locationdata']->location }}</td>
                                                            <td class="align-middle">
                                                                {{ $schedule->slot }}</td>
                                                            <td class="align-middle"> <span
                                                                    class="badge badge-{{ getStatusColors($schedule->status) }}">{{ App\Models\Schedule::$status[$schedule->status] }}</span>
                                                            </td>
                                                            <td class="align-middle"><i record="{{ $schedule->id }}"
                                                                    class="doedit far fa-edit mx-2 text-warning"></i><i
                                                                    record="{{ $schedule->id }}"
                                                                    class="dodelete fas fa-trash-alt mx-2 text-danger"></i>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="6">No Records Found</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <form method="POST" autocomplete="off" action="{{ route('schedules.enroll') }}">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Add / Update Train Schedules</h6>
                                        </div>
                                        <div class="card-body">
                                            @csrf
                                            <input id="isnew" name="isnew" value="1" type="hidden">
                                            <input id="id" name="id" value="" type="hidden">
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label for="train"><small>Train</small></label>
                                                    <select autocomplete="false" name="train" id="train"
                                                        class="form-control">
                                                        <option value="none" selected>- Select -</option>
                                                        @foreach ($trains as $train)
                                                            <option {{ old('train') == $train->id ? 'selected' : '' }}
                                                                value="{{ $train->id }}">{{ $train->alias }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('start')
                                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="location"><small>Location</small></label>
                                                    <select autocomplete="false" name="location" id="location"
                                                        class="form-control">
                                                        <option value="none" selected>- Select -</option>
                                                        @foreach ($locations as $location)
                                                            <option
                                                                {{ old('location') == $location->id ? 'selected' : '' }}
                                                                value="{{ $location->id }}">{{ $location->location }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('location')
                                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="end"><small>Slot</small></label>
                                                    <input class="form-control" type="datetime-local" name="slot"
                                                        id="slot">
                                                    @error('slot')
                                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="end"><small>Status</small></label>
                                                    <select autocomplete="false" class="form-control" name="status"
                                                        id="status">
                                                        <option {{ old('status') == 1 ? 'selected' : '' }} value="1">
                                                            Active
                                                        </option>
                                                        <option {{ old('status') == 2 ? 'selected' : '' }} value="2">
                                                            Inactive
                                                        </option>
                                                    </select>
                                                    @error('status')
                                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button type="reset" class="btn btn-danger w-100">Clear</button>
                                                </div>
                                                <div class="col-md-6">
                                                    <button class="btn btn-success w-100">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                @include('layouts.footer')

            </div>

        </div>

        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        @include('layouts.scripts')

        <script>
            $('.doedit').on('click', function() {
                let id = $(this).attr('record');
                showAlert('Are you aure to edit this record', function() {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('schedules.get') }}",
                        data: {
                            'id': id
                        },
                        success: function(response) {
                            $('#train').val(response.train);
                            $('#location').val(response.location);
                            $('#slot').val(response.slot);
                            $('#status').val(response.status);
                            $('#isnew').val(2);
                            $('#id').val(response.id);
                        }
                    });
                });
            });

            $('.dodelete').on('click', function() {
                let id = $(this).attr('record');
                showAlert('Are you aure to delete this record', function() {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('schedules.delete') }}",
                        data: {
                            'id': id
                        },
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                });
            });
        </script>
    </body>
@endsection
