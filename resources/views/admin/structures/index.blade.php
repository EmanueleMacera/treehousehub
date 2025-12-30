@extends('layouts.admin')

@section('title', __('admin.structures.index_title'))

@section('content')
    <h1>{{ __('admin.structures.index_title') }}</h1>

    <p><a href="{{ route('admin.structures.create') }}">{{ __('admin.structures.actions.create') }}</a></p>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>{{ __('admin.structures.fields.name') }}</th>
            <th>{{ __('admin.structures.fields.slug') }}</th>
            <th>{{ __('admin.structures.fields.active') }}</th>
            <th>{{ __('admin.structures.fields.order') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($structures as $structure)
            <tr>
                <td>{{ $structure->id }}</td>
                <td>{{ $structure->name }}</td>
                <td>{{ $structure->slug }}</td>
                <td>{{ $structure->active ? '1' : '0' }}</td>
                <td>{{ $structure->sort_order }}</td>
                <td>
                    <a href="{{ route('admin.structures.edit', $structure) }}">{{ __('admin.actions.edit') }}</a>
                    <form method="POST" action="{{ route('admin.structures.destroy', $structure) }}" style="display:inline;">
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
