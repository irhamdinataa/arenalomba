<!--Search Form-->
<div class="main-search-form transition-02s">
    <div class="container">
        <div class="pt-50 pb-50 main-search-form-cover">
            <div class="row mb-20">
                <div class="col-12">
                    <form action="" method="get" class="search-form position-relative" autocomplete="off">
                        <div class="search-form-icon"><i class="ti-search"></i></div>
                        <label>
                            <input type="text" name="keyword" class="search_field" id="search_field" placeholder="Enter keywords for search...">
                        </label>
                        <div class="search-switch">
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="#" class="active">Video</a></li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('extra-script')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<style>
    .ui-autocomplete {
        z-index: 9999;
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
    }

    .ui-menu-item-wrapper {
        padding: 0.5rem 1rem;
        font-size: 14px;
        cursor: pointer;
    }
</style>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
    let path = "{{ route('autocomplete-video') }}";

    $('#search_field').autocomplete({
        source: function(request, response) {
            $.get(path, { query: request.term }, function(data) {
                response($.map(data, function(item) {
                    return {
                        label: item.value, 
                        value: item.value, 
                        slug: item.slug  
                    };
                }));
            });
        },
        select: function(event, ui) {
            window.location.href = '/video/' + ui.item.slug;
        },
        autoFocus: true,
        position: { my: "left top", at: "left bottom", collision: "none" },
        open: function() {
            let ac = $('.ui-autocomplete');
            let input = $(this);
            ac.outerWidth(input.outerWidth());
        }
    });
</script>
@endpush