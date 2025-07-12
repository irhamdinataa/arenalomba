@php
 $dash.='-- ';   
@endphp 
@foreach($subcategories as $subcategory)
    <tr>
        <td></td>
        <td>{{$dash}}{{$subcategory->name}}</td>
        <td>{{$subcategory->slug}}</td>
        <td class="text-center">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle btn-sm" id="dropdownFadeInUp" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-cog"></i></button>
                <div class="dropdown-menu animated--fade-in-up" aria-labelledby="dropdownFadeInUp">
                    <a class="dropdown-item" href="{{ route('contest-category.edit', $subcategory->id) }}">Edit</a>
                    <form action="{{ route('contest-category.destroy', $subcategory->id) }}" method="POST" id="deleteForm{{ $subcategory->id }}">
                        @method('delete')
                        @csrf
                        <button class="dropdown-item btn-delete" data-form-id="deleteForm{{ $subcategory->id }}">
                        Hapus
                        </button>
                    </form>
                </div>
            </div>
        </td>
    </tr>
    @if(count($subcategory->subcategory))
        @include('pages.admin.contest-category.list-sub-category',['subcategories' => $subcategory->subcategory])
    @endif
@endforeach