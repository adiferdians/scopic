<container>
    <div class="input-split">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Name" value="Adi Ferdian">
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select type="text" class="form-control" id="type" placeholder="Type">
                    <option>Developer</option>
                    <option>Non Developer</option>
                </select>
            </div>
            <div class="form-group">
                <label for="Status">Status</label>
                <select type="text" class="form-control" id="status">
                    <option>Fulltime</option>
                    <option>Partime</option>
                    <option>Magang</option>
                </select>
            </div>
            <div class="form-group">
                <label for="Descriptions">Descriptions</label>
                <textarea class="form-control" id="descriptions" value="Test"></textarea>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="Salary">Salary</label>
                <input type="Salary" class="form-control" id="salary" value="500000">
            </div>
            <div class="form-group">
                <label for="placement">Placement</label>
                <select type="text" class="form-control" id="placement">
                    <option>Yogyakarta</option>
                    <option>Jakarta</option>
                    <option>Semarang</option>
                </select>
            </div>
            <div class="input-split">
                <div class="form-group col-lg-6">
                    <label for="start">Start</label>
                    <input type="date" class="form-control" id="start">
                </div>
                <div class="form-group col-lg-6">
                    <label for="close">Close</label>
                    <input type="date" class="form-control" id="close">
                </div>
            </div>
            <div class="form-group">
                <label for="requirements">Requirements</label>
                <textarea class="form-control" id="requirements" value="Test"></textarea>
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
        const name = $('#name').val();
        const type = $('#type').val();
        const status = $('#status').val();
        const placement = $('#placement').val();
        const descriptions = $('#descriptions').val();
        const salary = $('#salary').val();
        const start = $('#start').val();
        const close = $('#close').val();
        const requirements = $('#requirements').val();

        console.log(name, type, status, descriptions, salary, placement, start, close, requirements);

        $.ajax({
            url: '/job/store',
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