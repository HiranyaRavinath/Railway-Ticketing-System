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
                                        <h6 class="m-0 font-weight-bold text-primary">Train Ticket List</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered w-100" id="dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Train</th>
                                                        <th>Route</th>
                                                        <th>Price</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($traintickets as $keyTrainTicket=> $trainticket)
                                                        <tr>
                                                            <td class="align-middle">{{ $keyTrainTicket + 1 }}</td>
                                                            <td class="align-middle">{{ $trainticket['traindata']->alias }} <br> <span class="badge badge-info">{{ App\Models\TrainTickets::$classes[$trainticket->class] }}</span></td>
                                                            <td class="align-middle">{{ $trainticket['startdata']->location }} <br> {{ $trainticket['enddata']->location }} </td>
                                                            <td class="align-middle">{{ format_currency($trainticket->price) }}</td>
                                                            <td class="align-middle"> <span
                                                                    class="badge badge-{{ getStatusColors($trainticket->status) }}">{{ App\Models\TrainTickets::$status[$trainticket->status] }}</span>
                                                            </td>
                                                            <td class="align-middle"><i record="{{ $trainticket->id }}"
                                                                    class="doedit far fa-edit mx-2 text-warning"></i><i
                                                                    record="{{ $trainticket->id }}"
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
                                <form method="POST" autocomplete="off" action="{{ route('tickets.enroll') }}">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Add / Update Train Tickets</h6>
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
                                                    <label for="class"><small>Class</small></label>
                                                    <select autocomplete="false" name="class" id="class"
                                                        class="form-control">
                                                        <option value="none" selected>- Select -</option>
                                                        @foreach (App\Models\TrainTickets::$classes as $classKey => $classVal)
                                                            <option {{ old('class') == $classKey ? 'selected' : '' }}
                                                                value="{{ $classKey }}">{{ $classVal }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('start')
                                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="start"><small>Start Location</small></label>
                                                    <select autocomplete="false" name="start" id="start"
                                                        class="form-control">
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
                                                    <select autocomplete="false" name="end" id="end" class="form-control">
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
                                                    <label for="end"><small>Is For Foreigner</small></label>
                                                    <select autocomplete="off" class="form-control" name="isforeigner"
                                                        id="isforeigner">
                                                        <option {{ old('isforeigner') == 1 ? 'selected' : '' }}
                                                            value="1">
                                                            Yes
                                                        </option>
                                                        <option {{ old('isforeigner') == 2 ? 'selected' : '' }}
                                                            value="2">
                                                            No
                                                        </option>
                                                    </select>
                                                    @error('status')
                                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="price"><small>Ticket Price</small></label>
                                                    <input name="price" id="price" type="number" class="form-control">
                                                    @error('status')
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
                        url: "{{ route('tickets.get') }}",
                        data: {
                            'id': id
                        },
                        success: function(response) {
                            $('#train').val(response.train);
                            $('#class').val(response.class);
                            $('#isforeigner').val(response.isforeigner);
                            $('#price').val(response.price);
                            $('#start').val(response.start);
                            $('#end').val(response.end);
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
                        url: "{{ route('tickets.delete') }}",
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
