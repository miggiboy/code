@extends ('layouts.master')

@section ('title', 'Реклама')

{{-- @section ('subnavigation')
    @include('universities.partials.navigation', ['pageTitle' => 'Реклама'])
@endsection --}}

@section ('content')
<br>
<div class="ui grid">
  <div class="thirteen wide column">
    <div class="ui very padded segment">
      {{-- @include ('universities/partials/index/_search_form') --}}


      @if (count($advertisements))
        <div class="ui large celled very relaxed selection list">
        @foreach ($advertisements as $advertisement)
              <div class="advertisement item" style="cursor: default;">
                {{-- @include ('universities/partials/_options') --}}
                <div class="right floated content">
                </div>
                <i class="teal money icon"></i>
                <div class="content">
                  <a class="header" href="{{ route('advertisements.show', $advertisement) }}">
                    {{ $advertisement->description }}
                  </a><br>
                    {{ $advertisement->type }}
                </div>
              </div>
        @endforeach
        </div>
    @endif
    <br>



    </div>
  </div>

</div>
<br>
{{-- {{ $advertisements->appends(request()
    ->except('page', '_token'))
    ->links('vendor.pagination.default')
}} --}}
<br><br>
@endsection

@section ('script')
  <script src="/js/marks.js"></script>
@endsection
