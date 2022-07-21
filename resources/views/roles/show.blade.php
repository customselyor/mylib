@extends('layouts.app')

@section('template_title')
    {{ $role->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Roles') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/roles') }}">{{ __('Roles') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/roles') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">

                <div class="card">

                    <div class="card-body">
                        <div class="lead">
                            <strong>{{ __('Title') }}:</strong>
                            {{ $role->name }}
                        </div>
                        <div class="lead">
                            <strong>{{ __('Permission') }}:</strong>
                            @if(!empty($rolePermissions))
                                @foreach($rolePermissions as $permission)
                                    <label class="badge badge-success">{{ $permission->name }}</label>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection