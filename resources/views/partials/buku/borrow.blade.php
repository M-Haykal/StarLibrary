<div class="modal fade" id="peminjaman" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Borrow Book</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="" class="img-thumbnail mb-3" id="thumbnail" alt="Thumbnail" style="max-width: 100%; height: auto;">
                        </div>
                        <div class="col-md-8">
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
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Add a Review</h3>
                                </div>
                                <form id="review-form" class="p-3">
                                    @csrf
                                    <input type="hidden" name="buku_id" value="">
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
