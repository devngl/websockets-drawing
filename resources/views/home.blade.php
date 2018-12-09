@extends('layouts.app')

@section('content')
    <div class="d-flex h-100">
        <div class="w-100 h-100 d-flex flex-column mr-4">
            <whiteboard></whiteboard>
        </div>
        <div class="ml-auto d-flex flex-column">
            <tool-picker class="mb-1"></tool-picker>
            <color-picker></color-picker>
        </div>
    </div>
@endsection
