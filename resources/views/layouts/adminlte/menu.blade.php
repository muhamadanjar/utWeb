@if ((count($category->children) > 0) )
    <li class="treeview"><a href="{{ url($category->url) }}"><i class="{{$category->icon == '' ? 'icon-list-unordered':$category->icon }}"></i> <span>{{ $category->title }}</span> <i class="fa fa-angle-left"></i></a>
@else
    <li><a href="{{ url($category->url) }}"><i class="{{$category->icon == '' ? 'icon-list-unordered':$category->icon }}"></i> <span>{{ $category->title }}</span></a>

@endif

    @if (count($category->children) > 0)
        <ul class="treeview-menu">
        @foreach($category->children as $category)
            @include('layouts.adminlte.menu', $category)
        @endforeach
        </ul>

    @endif

</li>