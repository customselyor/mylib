@extends('layouts.app')

@section('template_title')
    {{ __('Where') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Where') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Where') }}
            </p>
        </div>
        <div>
            <a href="{{ route('wheres.create', app()->getLocale()) }}" class="btn btn-primary float-right">
                {{ __('Create') }}  
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="ec-vendor-list card card-default">
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    
                                    <th>{{ __('IsActive') }}</th> 
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Bibliographic record') }}</th>


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($wheres as $where)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{!! $where->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                        <td>{{ $where->title }}</td>
                                        <td>{{ $where->books->count() }}</td>


                                        <td>
                                            <form action="{{ route('wheres.destroy',[app()->getLocale(), $where->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('wheres.show', [app()->getLocale(), $where->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('wheres.edit', [app()->getLocale(), $where->id]) }}"> {{ __('Edit') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach                                    
                            </tbody>
                        </table>
                    </div>
                    @if ($wheres->count() > 0)
                        {!! $wheres->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
