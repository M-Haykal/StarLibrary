<!-- Modal -->
<div class="modal fade" id="createBuku" tabindex="-1" role="dialog" aria-labelledby="createBukuLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createBukuLabel">Buat Buku</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('buku.create') }}" method="POST" enctype="multipart/form-data"> <!-- Add enctype="multipart/form-data" for file upload -->
              @csrf
              <div class="modal-body container-fluid">
                  <div class="mb-3">
                      <label for="judul" class="form-label">Judul Buku</label>
                      <input autocomplete="off" type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}" style="color: white;">
                      @error('judul')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror

                      <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5" cols="100" style="color: white;">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                      <label for="penerbit" class="form-label">Penerbit</label>
                      <input autocomplete="off" type="text" class="form-control @error('penerbit') is-invalid @enderror" id="penerbit" name="penerbit" value="{{ old('penerbit') }}" style="color: white;">
                      @error('penerbit')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror

                      <label for="pengarang" class="form-label">Pengarang</label>
                      <input autocomplete="off" type="text" class="form-control @error('pengarang') is-invalid @enderror" id="pengarang" name="pengarang" value="{{ old('pengarang') }}" style="color: white;">
                      @error('pengarang')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror

                      <label for="stok_buku" class="form-label">Stok Buku</label>
                      <input autocomplete="off" type="number" class="form-control @error('stok_buku') is-invalid @enderror" id="stok_buku" name="stok_buku" value="{{ old('stok_buku') }}" style="color: white;">
                      @error('stok_buku')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                      <label for="category_id" class="form-label">Kategori</label>
                        <select class="form-select" id="category_id" name="category_id">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>


                      <label for="thumbnail" class="form-label" >Thumbnail</label> <!-- Add input for thumbnail -->
                      <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn bg-gradient-primary">Save changes</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
