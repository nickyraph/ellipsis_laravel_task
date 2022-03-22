@extends('layouts.app', ['nav' => 'links', 'title' => 'View URLs'])

@section('content-header', 'List of URLs')

@section('content-body')

    <a href="{{ route('links.create') }}" class="btn btn-primary my-4">Shorten A URL</a>
    <div class="table-responsive">
        <table class="table text-center">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">URL</th>
                <th scope="col">Shortened URL</th>
                <th scope="col">Status</th>
                <th scope="col">Time Left</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($links as $link)
                <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $link->link }}</td>
                <td>
                    @if($link->disabled)
                        {{ env('URL_DOMAIN', 'ellps.co') . '/' . $link->shortcode }}
                    @else
                    <a href="{{ route('redirect', $link->shortcode) }}" target="_blank">
                        {{ env('URL_DOMAIN', 'ellps.co') . '/' . $link->shortcode }}
                    </a>
                    @endif
                </td>
                <td>
                    @if($link->disabled)
                    <i class="bi bi-stop-circle-fill text-danger"></i>
                    @else
                    <i class="bi bi-check-circle-fill text-success"></i>
                    @endif
                </td>
                <td>
                    {{abs(now()->diffInMinutes($link->created_at) - 5)}} Minutes
                </td>
                <td>
                    <a class="btn btn-sm text-white btn-primary" href="{{ route('links.edit', $link ) }}">
                        <i class="bi bi-gear-wide-connected me-2"></i>
                        Manage
                    </a>
                </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="6">No URLS yet</td>
                    </tr>
                @endforelse

                <tr>
                    <td colspan="6">
                        <span class="fw-bold">Key:</span>
                        <i class="bi bi-stop-circle-fill text-danger"></i> <span class="me-2">Disabled</span>
                        <i class="bi bi-check-circle-fill text-success"></i> <span class="me-2">Enabled</span>
                    </td>
                </tr>

            </tbody>
            </table>
            <div class="d-flex justify-content-center mt-2">
                <p>{{$links->links()}}</p>
            </div>
        </div>
    </div>

@endsection
