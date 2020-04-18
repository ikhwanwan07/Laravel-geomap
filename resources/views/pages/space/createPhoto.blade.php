@extends('layouts.app')

@section('content')

<x-navigation></x-navigation>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Photo</div>

                <div class="card-body">

                    {!! Form::open(['route' => 'image.store','method' => 'post' , 'files' => true]) !!}

                    <div class="form-group">
                        <label for="">Space</label>
                        <select name="space_id" class="form-control">
                            <option value="">Pilih data</option>
                        @foreach ($data as $datas)    
                        <option value="{{$datas->id}}">{{ $datas->title }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group increment">
                        <label for="">Photo</label>
                        <div class="input-group">
                            <input type="file" name="photo" class="form-control">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-primary "></button>
                            </div>
                        </div>
                    </div>
                    @if ($errors->has('photo'))
                    <ul class="alert alert-danger">
                        @foreach ($errors->get('photo') as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    
                    <button type="submit" class="btn btn-primary">Submmit</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    window.action = "submit"
    jQuery(document).ready(function() {
        jQuery(".btn-add").click(function() {
            let markup = jQuery(".invisible").html();
            jQuery(".increment").append(markup);
        });
        jQuery("body").on("click", ".btn-remove", function() {
            jQuery(this).parents(".input-group").remove();
        })
    })
</script>
@endpush