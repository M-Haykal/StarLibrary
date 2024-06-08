<div class="modal fade" id="peminjaman" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Data Buku</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- Row for Image -->
                    <div class="row">
                        <div class="col text-center">
                            <img src="" class="img-thumbnail mb-3" id="thumbnail" alt="Thumbnail"
                                style="max-width: 100%; height: auto;">
                        </div>
                    </div>
                    <!-- Row for Text Fields -->
                    <div class="row">
                        <div class="col">
                            <form id="borrow-book-form" action="" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="recipient-name" class="form-label">Title:</label>
                                    <input type="text" class="form-control" id="recipient-name" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description:</label>
                                    <textarea class="form-control" id="description" readonly rows="4"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="author" class="form-label">Author:</label>
                                    <input type="text" class="form-control" id="author" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stock:</label>
                                    <input type="text" class="form-control" id="stock" readonly>
                                </div>
                                <div class="mb-3 d-flex justify-content-between">
                                    <input class="btn btn-success" type="submit" value="Pinjam">
                                    <button type="button" class="btn btn-warning" id="add-to-favorite" data-buku-id="">
                                        <i class="fa-regular fa-bookmark"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <h2>Reviews</h2>
                        <div class="col-md-8">
                            <div class="card mb-4">
                                <div class="card-body p-0">
                                    <ul id="reviews-list" class="list-group list-group-flush rounded-3">
                                        <!-- Daftar ulasan akan dimasukkan di sini -->
                                    </ul>
                                </div>
                            </div>
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
