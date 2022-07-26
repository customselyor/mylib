@extends('layouts.app')

@section('template_title')
    {{ __('Books Type') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Books Type') }}</h1>
                <p class="breadcrumbs"><span><a
                            href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Books Type') }}
                </p>
            </div>
            <div>

                <a href="{{ route('books-types.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
                                        <th>{{ __('Number of books') }}</th>
                                        <th>{{ __('Books in Copy') }}</th>
                                        {{-- <th>{{ __('Icon Path') }}</th> --}}
                                        <th>{{ __('Image') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($booksTypes as $booksType)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{!! $booksType->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                            <td>{{ $booksType->title }}</td>
                                            <td>{!! \App\Models\BooksType::GetCountBookCountByBookTypeId($booksType->id)!!}</td>
                                            <td>{!! \App\Models\BooksType::GetCountBookByBookTypeId($booksType->id)!!}</td>
                                            <td>
                                                {!! \App\Models\BooksType::GetCountBookCopiesByBookTypeId($booksType->id)!!}
                                            </td>
                                            {{-- <td>{!! $booksType->icon_path !!}</td> --}}
                                            <td>
                                                @if ($booksType->image_path)
                                                    <img src="{{ asset('/storage/booksTypes/photo/' . $booksType->image_path) }}"
                                                        width="100px">
                                                @endif
                                            </td>

                                            <td>
                                                {{-- <form method="POST" action="{{ route('books-types.delete', [app()->getLocale(), $booksType->id]) }}">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm" data-toggle="tooltip" >{{ __('Delete from DataBase') }}</button>
                                                </form> --}}

                                                <form
                                                    action="{{ route('books-types.destroy', [app()->getLocale(), $booksType->id]) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('books-types.show', [app()->getLocale(), $booksType->id]) }}"><i
                                                            class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('books-types.edit', [app()->getLocale(), $booksType->id]) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                        <div class="clear"></div>
                        @if ($booksTypes->count() > 0)
                            {!! $booksTypes->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
