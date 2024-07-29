@extends('layouts.admin')
@section('content')
@section('job', 'active')
@section('title', 'Certificate')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4 border-left-primary">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Job Opportunities</h6>
                    <a href="#" class="btn btn-secondary btn-icon-split" id="addJob">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Add New Data</span>
                    </a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" style="text-align: center;">
                            <thead>
                                <tr style="text-align: left;">
                                    <th>ACTION</th>
                                    <th>NAME</th>
                                    <th>TYPE</th>
                                    <th>STATUS</th>
                                    <th>DASCRIPTIONS</th>
                                    <th>SALARY</th>
                                    <th>PLACEMENT</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr style="text-align: left;">
                                    <th>ACTION</th>
                                    <th>NAME</th>
                                    <th>TYPE</th>
                                    <th>STATUS</th>
                                    <th>DASCRIPTIONS</th>
                                    <th>SALARY</th>
                                    <th>PLACEMENT</th>
                                </tr>
                            </tfoot>
                            @foreach($jobs as $job)
                            <tbody>
                                <tr style="text-align: left;">
                                    <td>
                                        <div>
                                            <button class="btn btn-primary actBtn" title="Edit" id="update" onclick="getUpdateJob({{$job->id}})">
                                                <i class="fas fa-fw fa-pen"></i>
                                            </button>
                                            <button class="btn btn-info  actBtn" title="Detil" id="detil" onclick="detailClient({{$job->id}})">
                                                <i class="fas fa-fw fa-eye"></i>
                                            </button>
                                            <button class="btn btn-danger actBtn" title="Hapus" onclick="delClient({{$job->id}})" {{ (session('role') == 2 || session('role') == 4) ? 'hidden' : ''}}>
                                                <i class="fas fa-fw fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td>{{$job->name}}</td>
                                    <td>{{$job->type}}</td>
                                    <td>{{$job->status}}</td>
                                    <td style="max-width: 300px; text-align: justify;">{{$job->descriptions}}</td>
                                    <td>{{$job->salary}}</td>
                                    <td>{{$job->placement}}</td>
                                    <td>

                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                        <div class="row">
                            {{ $jobs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

<script>
    $(document).ready(function() {

    });


    $('#addJob').click(function() {
        $.ajax({
            url: '/job/create',
            type: 'GET',
            success: function(response) {
                $('.modal-title').html("Add New Job");
                $(".modal-dialog").removeClass("modal-md").addClass("modal-xl");
                $('.modal-body').html(response);
                $('#myModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });

    function getUpdateJob(id) {
        $.ajax({
            url: '/job/get/' + id,
            type: 'GET',
            success: function(response) {
                $('.modal-title').html("Update Job");
                $(".modal-dialog").removeClass("modal-md").addClass("modal-xl");
                $('.modal-body').html(response);
                $('#myModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }
</script>

@endsection