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
                                <div class="mb-3">
                                    <label for="denda" class="form-label">Denda:</label>
                                    <input type="text" class="form-control" id="denda" readonly>
                                </div>

                                <div id="button-container" class="mb-3">
                                    <!-- Button akan ditambahkan di sini -->
                                </div>
                            </form>
                            <form id="review-form" class="p-3 d-none">
                                @csrf
                                <input type="hidden" name="buku_id" id="buku_id">
                                <input type="hidden" name="peminjaman_id" id="review_peminjaman_id">
                                <input type="hidden" name="rating" id="rating" value="0">
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Comment</label>
                                    <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="rating" class="form-label">Rating</label>
                                    <div id="star-rating" class="d-flex align-items-center">
                                        <i class="star fas fa-star" data-value="1"></i>
                                        <i class="star fas fa-star" data-value="2"></i>
                                        <i class="star fas fa-star" data-value="3"></i>
                                        <i class="star fas fa-star" data-value="4"></i>
                                        <i class="star fas fa-star" data-value="5"></i>
                                    </div>
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-success" type="submit">Send Review</button>
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
    .star {
        font-size: 1.5rem;
        cursor: pointer;
        color: #d3d3d3;
    }
    .star.text-warning {
        color: #ffc107;
    }
</style>
@endpush
