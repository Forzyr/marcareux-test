@extends('layouts.main')

@section('title', '人口　一覧')

@section('content')

    {{-- 検索機能 --}}
    <form method="GET" action="{{ route('population.index') }}">
        <div class="row">
            <label class="col-sm-1 col-form-label">都道府県</label>
            <div class="col-sm-2">
                <select class="form-select" aria-label="Default select example" name="prefecture">
                    @if (!empty($years))
                        <option value="">Total</option>
                        @foreach ($prefectures as $prefecture)
                            <option value="{{ $prefecture }}" {{ request('prefecture') == $prefecture ? 'selected' : '' }}>{{ $prefecture }}</option>
                        @endforeach
                    @else
                        <option>データなし</option>
                    @endif
                </select>
            </div>
            <label class="col-sm-1 col-form-label">年</label>
            <div class="col-sm-2">
                <select class="form-select" aria-label="Default select example" name="year">
                    @if (!empty($years))
                        <option value="">Total</option>
                        @foreach ($years as $year)
                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    @else
                        <option>データなし</option>
                    @endif
                </select>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary mb-2">検索</button>
            </div>  
        </div>
    </form>

    {{-- データ表示 --}}
    @if (!empty($years) && !empty($prefectures))
    <div class="table-responsive" style="max-height: 80vh; overflow-y: auto;">
        <table class="table">
            <thead>
                <tr>
                <th class="sticky-row bg-dark"></th>
                    @foreach ($years as $year)
                        @if(!request('year') || request('year') == $year)
                            <th scope="col" class="sticky-row bg-dark text-white">{{ $year }}</th>
                        @endif
                    @endforeach
                </tr>
            </thead>
            @foreach ($prefectures as $prefecture)
                @if(!request('prefecture') || request('prefecture') == $prefecture)
                    <tr>
                        <td class="text-nowrap fw-bold sticky-col bg-light">{{ $prefecture }}</td>
                        @foreach ($years as $year)
                            @if(!request('year') || request('year') == $year)
                                <td>
                                    {{ $populations[$prefecture]->firstWhere('year', $year)->population ?? '-' }}
                                </td>
                            @endif
                        @endforeach
                    </tr>
                @endif
            @endforeach
        </table>
    @else
            <h3>データ不足　-　データを取り込んでください</h3>
            </div>
    @endif
@endsection