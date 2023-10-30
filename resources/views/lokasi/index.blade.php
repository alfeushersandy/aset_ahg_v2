@extends('layouts.master')

@section('title')
    Daftar Lokasi
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Daftar Lokasi</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-12">
            <button onclick="addForm('{{ route('lokasi.store') }}')" class="btn btn-success btn-md btn-flat mb-2"><i class="fa fa-plus-circle"></i> Tambah</button>
            <div class="card">
                <div class="card-body">
                    <table id="tbl_list" class="table table-bordered table-hover dataTable dtr-inline collapsed" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Lokasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
        
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-4 col-12">
            <form action="{{ route('kategori.store') }}" method="POST">
            @method('post')
                <div class="card">
                    <div class="card-body">
                            <label for="nama_kategori" class="control-label">Nama Kategori</label>
                            <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required>
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                        <button class="btn btn-sm btn-flat btn-primary mt-3" id="tombol_simpan"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div> --}}
    </div>

@includeIf('lokasi.form')
@endsection
@push('scripts')
<script type="text/javascript">
    let table;
    $(document).ready(function(){
        table = $('#tbl_list').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('lokasi.data') }}'
        },
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'nama_lokasi'},
            {data: 'aksi', searchable: false, sortable: false},

        ]
        });
        

    $('#modal-form').on('submit', function (e) {
            if (! e.preventDefault()) {
                $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                    .done((response) => {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menyimpan data');
                        return;
                    });
            }
        });
    });

    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah lokasi');

        $('#modal-form [name=nama_lokasi]').val('');
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama_lokasi]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit lokasi');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama_lokasi]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form [name=nama_lokasi]').val(response.nama_lokasi);
            })
            .fail((errors) => {
                alert('Tidak dapat menampilkan data');
                return;
            });
    }

    function deleteData(url) {
        if (confirm('Yakin ingin menghapus data terpilih?')) {
            $.post(url, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'delete'
                })
                .done((response) => {
                    table.ajax.reload();
                })
                .fail((errors) => {
                    alert('Tidak dapat menghapus data');
                    return;
                });
        }
    }

    
</script>
@endpush