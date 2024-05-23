<!-- resources/views/partials/peminjaman/edit_modal.blade.php -->

<div class="modal fade" id="editModal_{{ $peminjaman->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editModalLabel_{{ $peminjaman->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel_{{ $peminjaman->id }}">Edit Peminjaman - ID {{ $peminjaman->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add your form fields for editing peminjaman details here -->
                <form method="post" action="{{ route('peminjaman.update', $peminjaman->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Add your form fields for editing peminjaman details here -->
                    <!-- For example, you can have input fields for updating due date, etc. -->

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
