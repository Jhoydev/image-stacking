@extends('layouts.app')
@section('content')
<div class="col-12">
    <h3>Variations</h3>
</div>
<div class="col-12">
    <div class="row container-stacks my-5">
        <stack class="col-4 d-flex justify-content-center align-items-center" style="min-height: 150px" v-for="(layer, index) of variations" :key="index" :images="layer"></stack>
    </div>
    <hr>
</div>
<div class="col-12 mt-50">
    <div class="div d-flex justify-content-between">
        <button class="btn btn-primary" @click="fetchLayers()">Generate</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Add new imagen
        </button>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="upload" class="" action="{{ url('/') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="layer_id">Array index</label>
                        <select class="form-control" name="layer_id" id="layer_id" required>
                            @foreach($layers_id as $layer_id)
                                <option value="{{$layer_id->layer_id}}">{{$layer_id->layer_id}}</option>
                            @endforeach
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
