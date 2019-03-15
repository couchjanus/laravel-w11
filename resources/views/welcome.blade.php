@extends('layouts.blog')

@section('content')


<div class="post-preview">

    <ais-index
    app-id="{{ config('scout.algolia.id') }}"
    api-key="{{ env('ALGOLIA_SEARCH') }}"
    index-name="posts"
  >
    <ais-input placeholder="Search posts..."></ais-input>
    <hr>
    <ais-results>
      <template scope="{ result }">
        <div>
        <h2>@{{ result.title }}</h2>
        <a :href="'/blog/'+ result.slug" class="btn btn-info">Continue reading</a>
        </div>
        
      </template>
      
    </ais-results>
    <ais-no-results></ais-no-results>

    <ais-pagination class="pagination"  :padding=5 :class-names="{
      'ais-pagination': 'pagination',
      'ais-pagination__item--active': 'active',
      'ais-pagination__item--disabled': 'disabled'

      }"></ais-pagination>


</ais-index>
</div>
@endsection
