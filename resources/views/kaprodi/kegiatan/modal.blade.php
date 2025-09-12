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
                <p><strong>Nama Kegiatan</strong></p>
            </div>
            <div class="col-6">
                : {{ $item->nama_kegiatan }}
            </div>
            <div class="col-6">
                <p><strong>Tipe Konversi</strong></p>
            </div>
            <div class="col-6">
                : <span class="badge badge-{{ $item->tipe_konversi === 'SKS' ? 'success' : 'secondary' }}">{{ $item->tipe_konversi }}</span>
            </div>
            <div class="col-6">
                <p><strong>Bobot</strong></p>
            </div>
            <div class="col-6">
                : {{ $item->bobot }}
            </div>
            <div class="col-6">
                <strong>Detail</strong>
            </div>
            <div class="col-6"></div>
            <div class="col-6">
                Penempatan
            </div>
            <div class="col-6">
                : {{ $item->deskripsiKegiatan->penempatan }}
            </div>
            <div class="col-6">
                Kriteria
            </div>
            <div class="col-6">
                : {{ $item->deskripsiKegiatan->kriteria }}
            </div>
            <div class="col-6">
                Deskripsi
            </div>
            <div class="col-6">
                : {{ $item->deskripsiKegiatan->deskripsi }}
            </div>
            <div class="col-6">
                CPL
            </div>
            <div class="col-6">
                : {{ $item->deskripsiKegiatan->cpl }}
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-1"></i>
            Batal
        </button>
        <form action="{{ route('kegiatanDestroy', $item->id) }}" method="post">
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