@extends('layouts.app')

@section('content')
<div class="container-fluid h-100">
    <div class="d-flex">
        <div class="flex-column w-100 mr-4">
            <whiteboard></whiteboard>
        </div>
        <div class="ml-auto">
            <tool-picker></tool-picker>
            <color-picker></color-picker>
        </div>
    </div>
</div>
@endsection
