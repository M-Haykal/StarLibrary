<div class="modal fade" id="editPetugasModal_{{ $ptg->id }}" tabindex="-1" role="dialog" aria-labelledby="editPetugasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPetugasModalLabel">Edit Petugas</h5>
            </div>
            <form action="{{ route('petugas.edit', ['id' => $ptg->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body container-fluid">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input autocomplete="off" type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $ptg->nama) }}">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="email" class="form-label">Email</label>
                        <input autocomplete="off" type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $ptg->email) }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="password" class="form-label">Password</label>
                        <input autocomplete="off" type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-gradient-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
