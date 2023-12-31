<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="post" class="form-horizontal">
            @csrf
            @method('post')

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-section">
                        <div class="form-group row">
                            <label for="nama_barang" class="col-lg-2 col-lg-offset-1 control-label">Nama</label>
                            <div class="col-lg-8">
                                <input type="text" name="nama_barang" id="nama_barang" class="form-control" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_kategori" class="col-lg-2 col-lg-offset-1 control-label">Kategori</label>
                            <div class="col-lg-8">
                                <select name="id_kategori" id="id_kategori" class="form-control" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategori as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="satuan" class="col-lg-2 col-lg-offset-1 control-label">Satuan</label>
                            <div class="col-lg-8">
                                <input type="text" name="satuan" id="satuan" class="form-control">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="merk" class="col-lg-2 col-lg-offset-1 control-label">Merk</label>
                            <div class="col-lg-8">
                                <input type="text" name="merk" id="merk" class="form-control">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="harga" class="col-lg-2 col-lg-offset-1 control-label">Harga</label>
                            <div class="col-lg-8">
                                <input type="number" name="harga" id="harga" class="form-control" required value="0">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="stok" class="col-lg-2 col-lg-offset-1 control-label">Stok</label>
                            <div class="col-lg-8">
                                <input type="number" name="stok" id="stok" class="form-control" required value="0">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div> 
                </div>
            </form>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i>Simpan</button>
                    <button type="button" class="btn btn-sm btn-flat btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal</button>
                </div>
            </div>
    </div>
</div>