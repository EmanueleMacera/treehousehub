@extends('layouts.admin')

@section('title', __('admin.sales.index_title'))

@section('content')
    <h1>{{ __('admin.sales.index_title') }}</h1>

    <p><a href="{{ route('admin.sales.create') }}">{{ __('admin.sales.actions.create') }}</a></p>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>{{ __('admin.sales.fields.title') }}</th>
            <th>{{ __('admin.sales.fields.slug') }}</th>
            <th>{{ __('admin.sales.fields.active') }}</th>
            <th>{{ __('admin.sales.fields.order') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($properties as $property)
            <tr>
                <td>{{ $property->id }}</td>
                <td>{{ $property->title }}</td>
                <td>{{ $property->slug }}</td>
                <td>{{ $property->active ? '1' : '0' }}</td>
                <td>{{ $property->sort_order }}</td>
                <td>
                    <a href="{{ route('admin.sales.edit', ['sale' => $property]) }}">{{ __('admin.actions.edit') }}</a>
                    <form method="POST" action="{{ route('admin.sales.destroy', ['sale' => $property]) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('{{ __('admin.actions.confirm_delete') }}')">
                            {{ __('admin.actions.delete') }}
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
