@extends('installation.layout')

@section('title', 'Pre-Installation Check')

@section('content')
<div class="container my-5">
    {{-- PHP Basic Requirements --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Minimum PHP Requirements</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Requirement</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $basic = [
                            'PHP Version >= 8.0' => version_compare(PHP_VERSION, '8.0.0', '>='),
                            'PDO Extension' => extension_loaded('pdo'),
                            'BCMath Extension' => extension_loaded('bcmath'),
                            'Fileinfo Extension' => extension_loaded('fileinfo')
                        ];
                    @endphp
                    @foreach ($basic as $requirement => $status)
                    <tr>
                        <td>{{ $requirement }}</td>
                        <td>
                            <span class="badge {{ $status ? 'bg-success' : 'bg-danger' }}">
                                {{ $status ? '✔ Enabled' : '✘ Missing' }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- PHP Version Check --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">PHP Version Details</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Setting</th>
                        <th>Current</th>
                        <th>Required</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>PHP Version</td>
                        <td>{{ phpversion() }}</td>
                        <td>^8.0.0</td>
                        <td>
                            <span class="badge {{ phpversion() >= 8.0 ? 'bg-success' : 'bg-danger' }}">
                                {{ phpversion() >= 8.0 ? 'Ok' : 'Error' }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- PHP Extensions --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Required PHP Extensions</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Extension</th>
                        <th>Current</th>
                        <th>Required</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $extensions = [
                            'MySQLi' => extension_loaded('mysqli'),
                            'GD' => extension_loaded('gd'),
                            'cURL' => function_exists('curl_version'),
                            'allow_url_fopen' => ini_get('allow_url_fopen'),
                            'OpenSSL' => extension_loaded('openssl'),
                            'PDO' => extension_loaded('pdo'),
                            'ZIP' => extension_loaded('zip'),
                            'BCMath' => extension_loaded('bcmath'),
                            'Ctype' => extension_loaded('ctype'),
                            'Fileinfo' => extension_loaded('fileinfo'),
                            'MBstring' => extension_loaded('mbstring'),
                            'Tokenizer' => extension_loaded('tokenizer'),
                            'XML' => extension_loaded('xml'),
                            'JSON' => extension_loaded('json')
                        ];
                    @endphp
                    @foreach ($extensions as $ext => $enabled)
                    <tr>
                        <td>{{ $ext }}</td>
                        <td>{{ $enabled ? 'On' : 'Off' }}</td>
                        <td>On</td>
                        <td>
                            <span class="badge {{ $enabled ? 'bg-success' : 'bg-danger' }}">
                                {{ $enabled ? 'Ok' : 'Error' }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Next Step --}}
       <div class="row justify-content-end mt-4">
    <div class="col-auto">
        <a href="{{ route('installer.configuration') }}" class="btn btn-success px-4">Next Step</a>
    </div>
</div>

    {{-- <div class="col-6">
                <a href="{{ route('ZaiInstaller::pre-install') }}" class="primary-btn">Close</a>
            </div> --}}
</div>
@endsection
