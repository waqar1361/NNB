@extends('layouts.app')
@section('content')

    <h2 class="text-light mb-4">{{ $document->subject }}</h2>
    <div class="col-6 p-0 text-capitalize">
        <table class="table table-bordered">
            <tr class="table-active">
                <th>Type :</th>
                <th>department :</th>
            </tr>
            <tr>
                <td>{{ $document->type }}</td>
                <td>{{ \App\Department::find($document->department_id)->name }}</td>
            </tr>
            <tr class="table-active">
                <th>date issued :</th>
                <th>size :</th>
            </tr>
            <tr>
                <td>{{ $document->issued_at->format("M, d, Y") }}</td>
                <td>{{ round(filesize("storage/" . $document->file . ".pdf")/1000000,2) }} MB</td>
            </tr>
            <tr class="table-active">
                <th>View :</th>
                <th>Download :</th>
            </tr>
            <tr>
                <td><a href="/documents/{{ $document->file }}">open</a></td>
                <td><a href="/download/{{ $document->file }}">download</a></td>
            </tr>
        </table>
    </div>

@endsection