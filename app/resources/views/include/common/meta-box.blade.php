<div class="card">
    <div class="card-header">
        <h3 class="card-title">Thông tin SEO</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row m-0  pt-2">
            <div class="form-group col-6 p-2 mb-0">
                <label class="col-form-label text-right" for="meta_title">Meta title</label>
                <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Nhập meta title"
                    value="{{ $params['item']['meta_title'] ?? '' }}">
                <div class="input-error"></div>
            </div>
            <div class="form-group col-6 p-2 mb-0">
                <label class="col-form-label text-right" for="meta_keyword">Meta keyword</label>
                <input type="text" class="form-control" id="meta_keyword" name="meta_keyword"
                    placeholder="Nhập meta keyword" value="{{ $params['item']['meta_keyword'] ?? '' }}"></input>
                <div class="input-error"></div>
            </div>
            <div class="form-group col-12 p-2 mb-0">
                <label class="col-form-label text-right" for="meta_description">Meta description</label>
                <textarea class="form-control" name="meta_description" id="meta_description" placeholder="Nhập meta description">{{ $params['item']['meta_description'] ?? '' }}</textarea>
                <div class="input-error"></div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>
