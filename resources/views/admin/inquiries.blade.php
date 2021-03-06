@extends('admin.layouts.app')

@section('name','Inquiries')

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Inquiries</h3>
                    </div>
                    <div class="card-body">
                        @if(! $inquiries->count())
                            <h3>There's nothing to be answer yet</h3>
                        @endif
                        @if($inquiries->count())
                            <h4 class="mb-3">Questions to be answered</h4>
                            <ol class="col-8">
                                @foreach($inquiries as $inquiry)
                                    <li class="">
                                        <span class="col-6">{{ $inquiry->question }}</span>
                                        <a class="btn btn-sm btn-primary" href="/admin/inquiries/{{$inquiry->id}}">Answer</a>
                                    </li>
                                @endforeach
                            </ol>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card">
                    <div class="card-header"> <h4 class="card-title">Archives</h4></div>
                    <div class="card-body">
                        @forelse($archives as $stat)
                            <p>{{ $loop->iteration }}- <a href="{{ route('admin.show.inquiries',$stat->id) }}">{{ $stat->question
                            }}</a></p>
                            @empty
                            <p>Nothing to show</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection