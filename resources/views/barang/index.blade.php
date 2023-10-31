@extends('layouts.master')

@section('title')
    Daftar Sparepart
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Daftar Sparepart</li>
@endsection

@section('content')
    <div class="col-12">
        <button onclick="addForm('{{ route('barang.store') }}')" class="btn btn-success btn-sm btn-flat mb-2"><i class="fa fa-plus-circle"></i> Tambah</button>
        <div class="card">
            <div class="card-body">
                <table id="tbl_list" class="table table-bordered table-hover dataTable dtr-inline collapsed" style="width:100%">
                <thead>
                    <tr>
                        <th width="5%">
                            <input type="checkbox" name="select_all" id="select_all">
                        </th>
                        <th width="5%">No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>Merk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
    
                </tbody>
                </table>
            </div>
        </div>
    </div>
@include('barang.form_ban')
@include('barang.form')
@endsection

@push('scripts')
<script type="text/javascript">
    let table;
    let form = 1
    
        $(document).ready(function(){
            table = $('#tbl_list').DataTable({
            responsive: true,
            processing: false,
            serverSide: false,
            autoWidth: false,
            ajax: {
                url: '{{ route('barang.data') }}',
            },
            columns: [
                {data: 'select_all', searchable: false, sortable: false},
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'kode_produk'},
                {data: 'nama_barang'},
                {data: 'nama_kategori'},
                {data: 'satuan'},
                {data: 'merk'},
                {data: 'harga'},
                {data: 'stok'},
                {data: 'aksi', searchable: false, sortable: false},
            ]
        });

        $('#modal-form').on('submit', function (e) {
            if (! e.preventDefault()) {
                $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                    .done((response) => {
                        form = 1
                        if(response.produk.id_kategori == 5){
                            $('#modal-form').modal('hide');
                            $('#modal-form-ban').modal('show');
                            $('#modal-form-ban .modal-body').empty();
                            let stock = response.produk.stok;
                            for (let index = 0; index < stock; index++) {
                            $('#modal-form-ban .modal-body').append(`
                            <div class="after-add-more mt-2">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <input type="text" name="ban[${index}]['nomor_seri']" id="nomor_seri[]" class="form-control" placeholder="nomor seri">
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" name="ban[${index}]['stamp_ban']" id="stamp_ban[]" class="form-control" placeholder="stamp ban">
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" name="ban[${index}]['no_po']" id="no_po[]" class="form-control" placeholder="Nomor PO">
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="date" name="ban[${index}]['tgl_datang']" id="tgl_datang[]" class="form-control" placeholder="tanggal datang">
                                    </div>
                                </div>
                            </div>
                            `)}
                            
                        }else{
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                        }
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menyimpan data');
                        return;
                    });
            }
        });

        $('[name=id_kategori]').on('change', function () {
            let kategori = $('#modal-form [name=id_kategori]').val();
            if(kategori == 5){ 
                $('#modal-form .btn-primary').text('Next');
            }else{
                $('#modal-form .btn-primary').html('<i class="fa fa-save"></i> Simpan');
            }
        });
    });


    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah Produk');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama_barang]').focus();
        $('#modal-form .btn-primary').html('<i class="fa fa-save"></i> Simpan');
        $('#modal-form-ban .modal-body').empty();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Barang');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama_produk]').focus();

        $.get(url)
            .done((response) => {
                console.log(response)
                if(response.id_kategori == 5){
                    $('#modal-form .btn-primary').text('Next');
                    $('#modal-form .btn-primary').on('click', function(){
                        $('#modal-form').modal('hide');
                        $('#modal-form-ban').modal('show');
                    });
                }else{
                    $('#modal-form .btn-primary').html('<i class="fa fa-save"></i> Simpan');
                }
                $('#modal-form [name=nama_barang]').val(response.nama_barang);
                $('#modal-form [name=id_kategori]').val(response.id_kategori);
                $('#modal-form [name=merk]').val(response.merk);
                $('#modal-form [name=satuan]').val(response.satuan);
                $('#modal-form [name=harga]').val(response.harga);
                $('#modal-form [name=stok]').val(response.stok);
                $('#modal-form .modal-body').append(`
                                            <div class="form-group row">
                                                <div class="col-lg-6">
                                                    <input type="hidden" name="kode_barang" id="kode_barang" class="form-control">
                                                    <span class="help-block with-errors"></span>
                                                </div>`)
                $('#modal-form [name=kode_barang]').val(response.kode_barang);
            })
            .fail((errors) => {
                alert('Tidak dapat menampilkan data');
                return;
            });
    }


</script>
@endpush