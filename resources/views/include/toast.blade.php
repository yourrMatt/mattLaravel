@if(session('error'))
    <div class="toast-container position-fixed bottom-0 end-0 p-5">
        <div class="toast align-items-center text-bg-danger border-0" role="alert">
            <div class="d-flex">
            <div class="toast-body">
                {{ session('error') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>
@endif
    
@if(session('success'))
    <div class="toast-container position-fixed bottom-0 end-0 p-5">
        <div class="toast align-items-center text-bg-success border-0" role="alert">
            <div class="d-flex">
            <div class="toast-body">
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>
@endif

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toastElList = document.querySelectorAll('.toast');
        toastElList.forEach(function(toastEl){
            const toast = new bootstrap.Toast(toastEl, {
                delay: 3000
            });
            toast.show();
        });
    });
</script>