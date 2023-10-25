<!-- Style for navbar -->
<style type="text/css">
.dropdown__header * {
  padding: 0;
  margin: 0;
}


.dropdown__header {
  display: flex;
  align-items: center;
    justify-content: center;
    font-size: 1.1rem;
}
.dropdown__header ul li a{
  padding-right: 1.2rem!important;
  padding-left: 1.2rem!important;
}

.dropdown__header strong {
  margin-left: 5px;
  margin-right: auto;
  font-size: 1.1rem;
}


@media only screen and (max-width: 763px) {
  .dropdown__header {
    font-size: 0.8rem;
    }
.dropdown__header strong {
      font-size: 0.8rem;
    }
.dropdown__header ul li a{
      padding-right: 0.4rem!important;
      padding-left: 0.4rem!important;
    }
}
.dropdown__header .dropdown__categories,
.dropdown__header .dropdown__menu {
  display: flex;
  list-style: none;
  padding: 0;
  margin: 0;
}

.dropdown__header li {
  padding: 5px;
  position: relative;
}

.dropdown__header li:hover {
  color: var(--primary);
  background-color: #f3f3f3; 
}

.dropdown__menu li:hover {
  color: var(--primary);
  background-color: #f3f3f3;
}

.dropdown__header .dropdown__category .dropdown__menu {
  display: none;
  position: absolute;
  background: #fff;
  width: 200px;
  top: 50px;
  left: 0;
}

.dropdown__header .dropdown__category:hover .dropdown__menu {
  display: block;
}
</style>
<!-- End Style for navbar -->
<header class="dropdown__header">
  <ul class="dropdown__categories">
  @foreach (\App\Models\Category::where('level', 0)->orderBy('order_level', 'desc')->get()->take(8) as $key => $category)
    <li class="dropdown__category category-nav-element nav-item dropdown" data-id="{{ $category->id }}">
        <a href="{{ route('products.category', $category->slug) }}" class="nav-link opacity-70 text-truncate text-reset py-2 d-block" data-bs-toggle="dropdown"> 
            <span class="cat-name">{{ $category->getTranslation('name') }}</span>
        </a>
      @if(count(\App\Utility\CategoryUtility::get_immediate_children_ids($category->id))>0)
      <ul class="dropdown__menu">
        @foreach (\App\Models\Category::where('parent_id', '=', $category->id)->orderBy('order_level', 'desc')->get()->take(6) as $key => $subcategory)
        <li class="category-nav-element nav-item dropdown" data-id="{{ $subcategory->id }}">
            <a href="{{ route('products.category', $subcategory->slug) }}" class="nav-link opacity-70 text-truncate text-reset py-2 px-1 d-block" data-bs-toggle="dropdown"> 
                <span class="cat-name">{{ $subcategory->getTranslation('name') }}</span>
            </a>
        </li>
        @endforeach
      </ul>
      @endif
    </li>
    @endforeach 
  </ul>
</header>

<!-- <div class="aiz-category-menu bg-white rounded @if(Route::currentRouteName() == 'home') shadow-sm" @else shadow-lg" id="category-sidebar" @endif>
    <div class="p-3 bg-soft-primary d-none d-lg-block rounded-top all-category position-relative text-left">
        <span class="fw-600 fs-16 mr-3">{{ translate('Categories') }}</span>
        <a href="{{ route('categories.all') }}" class="text-reset">
            <span class="d-none d-lg-inline-block">{{ translate('See All') }} ></span>
        </a>
    </div>
    <ul class="list-unstyled categories no-scrollbar py-2 mb-0 text-left">
        @foreach (\App\Models\Category::where('level', 0)->orderBy('order_level', 'desc')->get()->take(11) as $key => $category)
            <li class="category-nav-element" data-id="{{ $category->id }}">
                <a href="{{ route('products.category', $category->slug) }}" class="text-truncate text-reset py-2 px-3 d-block">
                    <img
                        class="cat-image lazyload mr-2 opacity-60"
                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ uploaded_asset($category->icon) }}"
                        width="16"
                        alt="{{ $category->getTranslation('name') }}"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                    >
                    <span class="cat-name">{{ $category->getTranslation('name') }}</span>
                </a>
                @if(count(\App\Utility\CategoryUtility::get_immediate_children_ids($category->id))>0)
                    <div class="sub-cat-menu c-scrollbar-light rounded shadow-lg p-4">
                        <div class="c-preloader text-center absolute-center">
                            <i class="las la-spinner la-spin la-3x opacity-70"></i>
                        </div>
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
</div> -->
