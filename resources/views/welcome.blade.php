@extends('layouts.main_landing')
@section('content')
<div class="hero" data-aos="fade-up">
    <div class="hero-body text-center" id="home">
        <h1 class="fw-bolder">Welcome</h1>
        <h1 class="fw-bolder">To</h1>
        <h1 class="fw-bolder">StarLibrary</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">A library in Taruna Bhakti vocational high school</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a class="btn btn-light btn-lg px-4" href="#content" role="button">Get Started</a>
            </div>
        </div>
    </div>
</div>

<div class="container" id="content">
    <div class="col-xxl-8 px-4 py-5" id="about" data-aos="fade-right">
        <div class="row flex-lg-row-reverse align-items-center justify-content-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="{{ asset('img/smk.jpg') }}" class="d-block mx-lg-auto img-fluid img-about"
                    alt="Taruna Bhakti vocational high school" width="700" height="500" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="lh-1 mb-3">StarLibrary</h1>
                <p class="lead">Introducing this StarLibrary a library website created by Adrian Baihaqi, Afif Medya
                    Wisnu, Daniel Hansel, Muhammad Haykal and Resti Nuriqwanti, This is the result of a project given by
                    our teacher at school, our school is called Taruna Bhakti Vocational High School.</p>
            </div>
        </div>
    </div>

    @foreach($bukus as $buku)
    <!-- Modal for each book -->
    <div class="modal fade" id="peminjaman-{{ $buku->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-{{ $buku->id }}" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel-{{ $buku->id }}">Data Buku</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <!-- Row for Image -->
                        <div class="row">
                            <div class="col text-center">
                                <img src="{{ asset('storage/' . $buku->thumbnail) }}" class="img-thumbnail mb-3" alt="Thumbnail" style="max-width: 100%; height: auto;">
                            </div>
                        </div>
                        <!-- Row for Text Fields -->
                        <div class="row">
                            <div class="col">
                                <form onsubmit="borrowBook(event, {{ $buku->id }})" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="title-{{ $buku->id }}" class="form-label">Title:</label>
                                        <input type="text" class="form-control" id="title-{{ $buku->id }}" value="{{ $buku->judul }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description-{{ $buku->id }}" class="form-label">Description:</label>
                                        <textarea class="form-control" id="description-{{ $buku->id }}" readonly rows="4">{{ $buku->deskripsi ?? 'Tidak ada deskripsi di buku ini' }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="author-{{ $buku->id }}" class="form-label">Author:</label>
                                        <input type="text" class="form-control" id="author-{{ $buku->id }}" value="{{ $buku->pengarang }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="stock-{{ $buku->id }}" class="form-label">Stock:</label>
                                        <input type="text" class="form-control" id="stock-{{ $buku->id }}" value="{{ $buku->stok_buku }}" readonly>
                                    </div>
                                    <div class="mb-3 d-flex justify-content-between">
                                        <button class="btn btn-success">Pinjam</button>
                                    </div>
                                </form>
                                <form onsubmit="addToFavorite(event, {{ $buku->id }})" method="POST">
                                    @csrf
                                    <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                                    <button class="btn btn-warning">
                                        <i class="fa-regular fa-bookmark"></i> Add To Favorite
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <h2>Reviews</h2>
                            <div class="col-md-8">
                                <div class="card mb-4">
                                    <div class="card-body p-0">
                                        <ul class="list-group list-group-flush rounded-3" id="reviews-list-{{ $buku->id }}">
                                            <!-- Reviews will be dynamically inserted here by JavaScript -->
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
    @endforeach

    {{-- Untuk Buku offline --}}
    <div id="book" class="mt-5 mb-5">
        <h1 class="text-center" data-aos="fade-up">Book</h1>
        <p class="text-center lead mb-4" data-aos="fade-up" data-aos-delay="100">Here are the books available on StarLibrary</p>

        <div class="row row-cols-2 row-cols-md-5 g-4">
            @foreach ($bukus as $buku)
            <div class="col" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card h-100 shadow-sm border-0" style="transition: transform .2s; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#peminjaman-{{ $buku->id }}">
                    <img src="{{ asset('storage/' . $buku->thumbnail) }}" class="card-img-top rounded-top" alt="..." style="height: 400px; object-fit: cover;">
                    <div class="card-body">
                        <p class="card-text">
                            @php
                                $rating = $buku->totalRating;
                                $whole = floor($rating);
                                $fraction = $rating - $whole;
                            @endphp

                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $whole)
                                    <i class="fas star-total fa-star"></i>
                                @elseif ($fraction > 0 && $i == ($whole + 1))
                                    <i class="fas star-total fa-star-half-alt"></i>
                                @else
                                    <i class="far star-inactive fa-star"></i>
                                @endif
                            @endfor
                            {{ $buku->totalRating }}
                        </p>

                        <h5 class="card-title">{{ $buku->judul }}</h5>
                        <p class="card-text">Author: {{ $buku->pengarang }}</p>
                        <p class="card-text">Stock: {{ $buku->stok_buku }}</p>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
.card:hover {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    .card-img-top {
        height: 400px;
        object-fit: cover;
    }
    .card-body {
        background-color: #f8f9fa;
    }
    .card-title {
        font-weight: bold;
        font-size: 1.1rem;
    }
    .card-text {
        font-size: 0.9rem;
    }

    .star {
        font-size: 2rem;
        color: #ddd;
        cursor: pointer;
        transition: color 0.3s;
    }
    .star.selected, .star:hover{
        font-size: 2rem;
        color: #ffd700;
    }

    .star-inactive {
        font-size: 1rem;
        color: #ddd;
        cursor: pointer;
        transition: color 0.3s;
    }
    .star-total {
        font-size: 1rem;
        color: #ffd700;
        cursor: pointer;
        transition: color 0.3s;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    AOS.init();

document.addEventListener('DOMContentLoaded', function () {
        // Event listener for opening modals to fetch reviews
        @foreach($bukus as $buku)
        $('#peminjaman-{{ $buku->id }}').on('show.bs.modal', function () {
            fetchReviews({{ $buku->id }});
        });
        @endforeach
    });

    function fetchReviews(bookId) {
        fetch(`/costumer/buku/${bookId}/reviews`)
            .then(response => response.json())
            .then(data => {
                const reviewsList = document.getElementById(`reviews-list-${bookId}`);
                reviewsList.innerHTML = ''; // Clear existing reviews
                data.reviews.forEach(review => {
                    const listItem = document.createElement('li');
                    listItem.className = 'list-group-item d-flex justify-content-between align-items-center p-3';
                    listItem.innerHTML = `<p class="mb-0"><strong>${review.user_name}:</strong> ${review.comment} - ${'★'.repeat(review.rating)}${'☆'.repeat(5 - review.rating)}</p>`;
                    reviewsList.appendChild(listItem);
                });
            })
            .catch(error => console.error('Error fetching reviews:', error));
    }

        // Function to show success message with SweetAlert
        function showSuccessMessage(message) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: message,
            showConfirmButton: false,
            timer: 1500
        });
    }

    // Function to show error message with SweetAlert
    function showErrorMessage(message) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: message
        });
    }

    // Submit form event listener
    document.addEventListener('DOMContentLoaded', function() {
        // Select all forms with class 'borrow-form'
        const borrowForms = document.querySelectorAll('.borrow-form');

        // Loop through each form
        borrowForms.forEach(form => {
            // Add submit event listener to each form
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                // Get form action URL
                const url = form.getAttribute('action');

                // Send POST request to server
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        // Optionally include form data here
                    })
                })
                .then(response => response.json()) // Parse JSON response
                .then(data => {
                    if (data.status === 'success') {
                        // Show success message
                        showSuccessMessage(data.message);
                    } else {
                        // Show error message
                        showErrorMessage(data.message);
                    }
                })
                .catch(error => {
                    // Show error message
                    showErrorMessage('An error occurred.');
                    console.error('Error:', error);
                });
            });
        });
    });

    // Function to handle form submission for borrowing a book
     // Function to handle form submission for borrowing a book
     function borrowBook(event, bookId) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: '{{ route('borrow.book', ':id') }}'.replace(':id', bookId), // Update the URL with the bookId
            data: {
                "_token": "{{ csrf_token() }}",
                // No need to pass book_id here as it's already in the URL
            },
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        timer: 2000
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Info',
                        text: response.message,
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to borrow the book. Please try again later.',
                });
            }
        });
    }

    // Function to handle form submission for adding a book to favorites
    function addToFavorite(event, bookId) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: '{{ route('add.to.favorite') }}',
            data: {
                "_token": "{{ csrf_token() }}",
                "buku_id": bookId
            },
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        timer: 2000
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Info',
                        text: response.message,
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to add the book to favorites. Please try again later.',
                });
            }
        });
    }
</script>


@endpush
