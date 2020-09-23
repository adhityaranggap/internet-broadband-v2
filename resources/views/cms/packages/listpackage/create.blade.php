<form method="post" action="{{ route('list-package-store') }}">
@csrf

    <div class="form-group ">
    <label for="name">Name</label>
        <input class="form-control" name="name" type="text" value="" id="name" placeholder="Required">
    </div>
    <div class="form-group">
    <label for="upload">Upload</label>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <input class="form-control" name="upload" placeholder="Required" type="number" value="" id="upload">
                </div>
                <div class="col-xs-12 col-sm-6">
                    <select class="form-control" id="upload_unit" name="upload_unit">
                        <option value="Mbps">Mbps</option>
                        <option value="Kbps">Kbps</option>
                    </select>
                </div>
            </div>
    </div>
    <div class="form-group">
    <label for="download">Download</label>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <input class="form-control" name="download" placeholder="Required" type="number" value="" id="download">
                </div>
                <div class="col-xs-12 col-sm-6">
                    <select class="form-control" id="download_unit" name="download_unit">
                        <option value="M">Mbps</option>
                        <option value="K">Kbps</option>
                    </select>
                </div>
            </div>
    </div>
    <div class="form-group ">
    <label for="ip_gateway">IP Gateway</label>
    <input class="form-control" name="ip_gateway" type="text" placeholder="Required" value="" id="ip_gateway">
    </div>
    <div class="form-group">
    <label for="ip_pool">IP Pool</label>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <input class="form-control" name="ip_pool_start" placeholder="Start" type="text" value="" id="ip_pool_start">
                </div>
                <div class="col-xs-12 col-sm-6">
                    <input class="form-control" name="ip_pool_end" placeholder="End" type="text" value="" id="ip_pool_end">
                </div>
            </div>
    </div>
    <div class="form-group ">
    <label for="name">Price</label>
    <input class="form-control" name="price" type="text" placeholder="Required" value="" id="price">
    </div>
</form>
