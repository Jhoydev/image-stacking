@extends('layouts.app')
@section('content')
<div class="col-12">
    <div class="row">
        @foreach($layers as $layer)
            <div class="col-4 mb-10" style="min-height: 200px">
                <div class="position-relative">
                    @foreach($layer as $img)
                        <img style="height: 100px" class="position-absolute" src="{{ asset('/images/layers/'.$img) }}" alt="">
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    <hr>

</div>
<div class="col-12 mt-50">
    <div class="div d-flex justify-content-between">
        <button class="btn btn-primary">Generate</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>



@endsection
