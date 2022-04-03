@extends('layouts.app')
@section('content')
<div class="col-12">
    <div id="warning-message" class="alert alert-info" role="alert">
    </div>
</div>
<div class="col-12">
    <div class="row container-stacks my-5">
        <stack class="col-4 d-flex justify-content-center align-items-center" style="min-height: 150px" v-for="(layer, index) of variations" :key="index" :images="layer"></stack>
    </div>
</div>
<div class="col-12">
    <div class="div d-flex justify-content-around">
        <button class="btn btn-primary" @click="fetchLayers()">Generate</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addLayerModal">
            Add new imagen
        </button>
    </div>
</div>


<!-- Modals -->
<div class="modal fade" id="addLayerModal" tabindex="-1" aria-labelledby="addLayerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLayerModalLabel">New image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="upload" action="{{ url('api/layers') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="layer_id">Array index</label>
                        <select class="form-control" name="layer_id" id="layer_id" required>
                                <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="file" name="image" class="form-control-file" accept=".png" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
