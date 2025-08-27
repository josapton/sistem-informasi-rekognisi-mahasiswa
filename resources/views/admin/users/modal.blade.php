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
                <strong>Username</strong>
            </div>
            <div class="col-6">
                : {{ $item->username }}
            </div>
            <div class="col-6">
                <strong>Nama</strong>
            </div>
            <div class="col-6">
                : {{ $item->nama }}
            </div>
            <div class="col-6">
                <strong>Email</strong>
            </div>
            <div class="col-6">
                : <a href="mailto:{{ $item->email }}">{{ $item->email }}</a>
            </div>
            <div class="col-6">
                <strong>Role</strong>
            </div>
            <div class="col-6">
                : <span class="badge badge-{{ $item->role === 'Admin' ? 'primary' : ($item->role === 'Dosen' ? 'info' : 'secondary') }}">{{ $item->role }}</span>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-1"></i>
            Batal
        </button>
        <form action="{{ route('usersDestroy', $item->id) }}" method="post">
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