<!-- Modal -->
<div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus {{ $title }} ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-6">
                <p><strong>Nama Mata Kuliah</strong></p>
            </div>
            <div class="col-6">
                : {{ $item->nama_matakuliah }}
            </div>
            <div class="col-6">
                <p><strong>Bobot</strong></p>
            </div>
            <div class="col-6">
                : {{ $item->bobot }}
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-1"></i>
            Batal
        </button>
        <form action="{{ route('matakuliah.destroy', $item->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash mr-1"></i>
                Hapus
            </button>
        </form>
      </div>
    </div>
  </div>
</div>