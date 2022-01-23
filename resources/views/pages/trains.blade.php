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
                                        <h6 class="m-0 font-weight-bold text-primary">Train List</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered w-100" id="dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Alias</th>
                                                        <th>Start Location</th>
                                                        <th>End Location</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($trains as $keyTrain=> $train)
                                                        <tr>
                                                            <td>{{ $keyTrain + 1 }}</td>
                                                            <td>{{ $train->alias }}</td>
                                                            <td>{{ $train['startdata']->location }}</td>
                                                            <td>{{ $train['enddata']->location }}</td>
                                                            <td> <span
                                                                    class="badge badge-{{ getStatusColors($train->status) }}">{{ App\Models\Train::$status[$train->status] }}</span>
                                                            </td>
                                                            <td><i record="{{ $train->id }}"
                                                                    class="doedit far fa-edit mx-2 text-warning"></i><i
                                                                    record="{{ $train->id }}"
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
                                <form method="POST" autocomplete="off" action="{{ route('trains.enroll') }}">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Add / Update Trains</h6>
                                        </div>
                                        <div class="card-body">
                                            @csrf
                                            <input id="isnew" name="isnew" value="1" type="hidden">
                                            <input id="id" name="id" value="" type="hidden">
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label for="alias"><small>Train Alias</small></label>
                                                    <input  autocomplete="false" class="form-control" type="text" name="alias" id="alias"
                                                        value="{{ old('alias') }}">
                                                    @error('alias')
                                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="start"><small>Start Location</small></label>
                                                    <select autocomplete="false"  name="start" id="start" class="form-control">
                                                        <option value="none" selected>- Select -</option>
                                                        @foreach ($locations as $location)
                                                            <option {{ old('start') == $location->id ? 'selected' : '' }}
                                                                value="{{ $location->id }}">{{ $location->location }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('start')
                                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="end"><small>End Location</small></label>
                                                    <select autocomplete="false"  name="end" id="end" class="form-control">
                                                        <option value="none" selected>- Select -</option>
                                                        @foreach ($locations as $location)
                                                            <option {{ old('end') == $location->id ? 'selected' : '' }}
                                                                value="{{ $location->id }}">{{ $location->location }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('end')
                                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="perbox"><small>Seats Per Train Box</small></label>
                                                    <input  autocomplete="false" class="form-control" type="number" name="perbox" id="perbox"
                                                        value="{{ old('perbox') }}">
                                                    @error('perbox')
                                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="windowed"><small>Windowed Seats Count</small></label>
                                                    <input  autocomplete="false" class="form-control" type="number" name="windowed" id="windowed"
                                                        value="{{ old('windowed') }}">
                                                    @error('windowed')
                                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="nonwindowed"><small>Non Windowed Seats Count</small></label>
                                                    <input  autocomplete="false" class="form-control" type="number" name="nonwindowed" id="nonwindowed"
                                                        value="{{ old('nonwindowed') }}">
                                                    @error('nonwindowed')
                                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="end"><small>Status</small></label>
                                                    <select autocomplete="false"  class="form-control" name="status" id="status">
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
                        url: "{{ route('trains.get') }}",
                        data: {
                            'id': id
                        },
                        success: function(response) {
                            $('#alias').val(response.alias);
                            $('#start').val(response.start);
                            $('#end').val(response.end);
                            $('#status').val(response.status);
                            $('#perbox').val(response.seatsperbox);
                            $('#windowed').val(response.windowed);
                            $('#nonwindowed').val(response.nonwindowed);
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
                        url: "{{ route('trains.delete') }}",
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
