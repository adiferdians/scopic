<container>
    <div class="input-split">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Name" value="{{$job->name}}">
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select type="text" class="form-control" id="type" placeholder="Type">
                    <option {{ $job->type == "Developer" ? 'selected' : ''}}>Developer</option>
                    <option {{ $job->type == "Non Developer" ? 'selected' : ''}}>Non Developer</option>
                </select>
            </div>
            <div class="form-group">
                <label for="Status">Status</label>
                <select type="text" class="form-control" id="status">
                    <option {{ $job->status == "Fulltime" ? 'selected' : ''}}>Fulltime</option>
                    <option {{ $job->status == "Partime" ? 'selected' : ''}}>Partime</option>
                    <option {{ $job->status == "Magang" ? 'selected' : ''}}>Magang</option>
                </select>
            </div>
            <div class="form-group">
                <label for="Descriptions">Descriptions</label>
                <textarea class="form-control" id="descriptions">{{$job->descriptions}}</textarea>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="Salary">Salary</label>
                <input type="Salary" class="form-control" id="salary" value="{{$job->salary}}">
            </div>
            <div class="form-group">
                <label for="placement">Placement</label>
                <select type="text" class="form-control" id="placement">
                    <option {{ $job->placement == "Yogyakarta" ? 'selected' : ''}}>Yogyakarta</option>
                    <option {{ $job->placement == "Jakarta" ? 'selected' : ''}}>Jakarta</option>
                    <option {{ $job->placement == "Semarang" ? 'selected' : ''}}>Semarang</option>
                </select>
            </div>
            <div class="input-split">
                <div class="form-group col-lg-6">
                    <label for="start">Start</label>
                    <input type="date" class="form-control" id="start" value="{{ $job->start }}">
                </div>
                <div class="form-group col-lg-6">
                    <label for="close">Close</label>
                    <input type="date" class="form-control" id="close" value="{{ $job->close }}">
                </div>
            </div>
            <div class="form-group">
                <label for="requirements">Requirements</label>
                <textarea class="form-control" id="requirements">{{$job->requirements}}</textarea>
            </div>
        </div>
    </div>
    <div class="button-modal">
        <button type="submit" class="btn btn-primary mr-2" id="send">Submit</button>
        <button class="btn btn-dark">Cancel</button>
    </div>
</container>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    $('#send').click(function() {
        const jobId = '{{$job->id}}';
        const name = $('#name').val();
        const type = $('#type').val();
        const status = $('#status').val();
        const placement = $('#placement').val();
        const descriptions = $('#descriptions').val();
        const salary = $('#salary').val();
        const start = $('#start').val();
        const close = $('#close').val();
        const requirements = $('#requirements').val();

        console.log(jobId);
        $.ajax({
            url: '/job/store/'+ jobId,
            type: 'POST',
            data: {
                name,
                type,
                status,
                placement,
                descriptions,
                salary,
                start,
                close,
                requirements
            },
            success: function(response) {
                Swal.fire({
                    title: 'Success...',
                    position: 'top-end',
                    icon: 'success',
                    text: 'Success! Data added successfully.',
                    showConfirmButton: false,
                    width: '400px',
                    timer: 3000
                }).then(() => {
                    location.reload();
                });
            },
            error: function(xhr) {
                Swal.fire({
                    title: 'Error',
                    position: 'top-end',
                    icon: 'error',
                    text: xhr.responseJSON.error,
                    showConfirmButton: false,
                    width: '400px',
                    timer: 3000
                });
            }
        });
    })
</script>