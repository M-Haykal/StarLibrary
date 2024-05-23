<!-- Modal -->
<div class="modal fade" id="editBukuOnline_{{ $bukuOnline->id }}" tabindex="-1" role="dialog" aria-labelledby="editBukuLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editBukuLabel">Edit Buku</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('buku_online.edit', ['id' => $bukuOnline->id]) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <input type="hidden" id="editBookId" value="{{ $bukuOnline->id }}">
              <div class="modal-body container-fluid">
                  <div class="mb-3">
                      <label for="judul" class="form-label">Judul Buku</label>
                      <input autocomplete="off" type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $bukuOnline->judul) }}">
                      @error('judul')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror

                      <div class="mb-3">
                          <label for="deskripsi" class="form-label">Deskripsi</label>
                          <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5" cols="100">{{ old('deskripsi', $bukuOnline->deskripsi) }}</textarea>
                          @error('deskripsi')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>

                      <label for="penerbit" class="form-label">Penerbit</label>
                      <input autocomplete="off" type="text" class="form-control @error('penerbit') is-invalid @enderror" id="penerbit" name="penerbit" value="{{ old('penerbit', $bukuOnline->penerbit) }}">
                      @error('penerbit')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror

                      <label for="pengarang" class="form-label">Pengarang</label>
                      <input autocomplete="off" type="text" class="form-control @error('pengarang') is-invalid @enderror" id="pengarang" name="pengarang" value="{{ old('pengarang', $bukuOnline->pengarang) }}">
                      @error('pengarang')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror

                      <label for="stok_buku" class="form-label">Stok Buku</label>
                      <input autocomplete="off" type="number" class="form-control @error('stok_buku') is-invalid @enderror" id="stok_buku" name="stok_buku" value="{{ old('stok_buku', $bukuOnline->stok_buku) }}">
                      @error('stok_buku')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror

                      <label for="category_id" class="form-label">Kategori</label>
                      <select class="form-select" id="category_id" name="category_id">
                          <option value="">Pilih Kategori</option>
                          @foreach($categories as $category)
                              <option value="{{ $category->id }}" {{ $bukuOnline->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                          @endforeach
                      </select>

                      <label for="thumbnail" class="form-label">Thumbnail</label>
                      <input type="file" class="form-control" id="thumbnail" name="thumbnail">

                      <label for="pdf_file" class="form-label">PDF File</label>
                      <input type="file" class="form-control" id="pdf_file" name="pdf_file">
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
