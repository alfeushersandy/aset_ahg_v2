@extends('layouts.master')

@section('title')
    Daftar Kategori
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Daftar Kategori</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8 col-12">
            <div class="card">
                <div class="card-body">
                    <table id="tbl_list" class="table table-bordered table-hover dataTable dtr-inline collapsed" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
        
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12">
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
        </div>
    </div>


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
            url: '{{ route('kategori.data') }}'
        },
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'nama_kategori'},
            {data: 'aksi', searchable: false, sortable: false},

        ]
        });
    })

    $('#tombol_simpan').click(function(e){
        e.preventDefault();
        
        let nama_kategori= $('#nama_kategori').val();
        let token   = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: $('form').attr('action'),
            type:  $('form [name=_method]').val().toUpperCase(),
            cache: false,
            data: {
                "nama_kategori": nama_kategori,
                "_token": token
            },
            success:function(){
                table.ajax.reload();
                $('#nama_kategori').val('');
                $('form [name=_method]').val('post');
                $('form').attr('action', `{{ route('kategori.store') }}`);
            }
            })
        })

        function editForm(url) {

        $('form').attr('action', url);
        $('form [name=_method]').val('put');
        $('form [name=nama_kategori]').focus();

        $.get(url)
            .done((response) => {
                $('form [name=nama_kategori]').val(response.nama_kategori);
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