@extends('layouts.app')

@section('template_title')
    {{ $bookFileType->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Book File Type') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/book-file-types') }}">{{ __('Book File Type') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/book-file-types') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                         
                        <div class="form-group">
                            <strong>{{ __('Title') }}:</strong>
                            {{ $bookFileType->title }}
                        </div>

                        <div class="form-group">
                            <strong>{{ __('IsActive') }}:</strong>
                            {!! $bookFileType->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Created By') }}:</strong>
                            {!! $bookFileType->created_by ? $bookFileType->createdBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated By') }}:</strong>
                            {!! $bookFileType->updated_by ? $bookFileType->updatedBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Created At') }}:</strong>
                            {{ $bookFileType->created_at  }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated At') }}:</strong>
                            {{ $bookFileType->updated_at  }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
