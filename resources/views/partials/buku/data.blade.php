<div class="modal fade" id="datapeminjaman" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Data Buku</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="" class="img-thumbnail mb-3" id="thumbnail" alt="Thumbnail" style="max-width: 100%; height: auto;">
                        </div>
                        <div class="col-md-8">
                            <form action="" method="POST" id="returnBookForm">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="peminjaman_id" id="peminjaman_id">
                                <div class="mb-3">
                                    <label for="book-title" class="form-label">Title:</label>
                                    <input type="text" class="form-control" id="book-title" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="book-author" class="form-label">Author:</label>
                                    <input type="text" class="form-control" id="book-author" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description:</label>
                                    <textarea class="form-control" id="description" readonly rows="4"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status:</label>
                                    <input type="text" class="form-control" id="status" readonly>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .modal-body {
        background-color: #f8f9fa;
    }
    .modal-header, .modal-footer {
        border: none;
    }
    .card {
        border-radius: 1rem;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .btn-close {
        background-color: transparent;
        border: none;
    }
    .img-thumbnail {
        border: none;
        border-radius: 1rem;
    }
    .form-label {
        font-weight: bold;
    }
    .form-control:read-only {
        background-color: #e9ecef;
        opacity: 1;
    }
</style>
@endpush
