<?php

namespace App\Http\Controllers\Site;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Collection;
use App\Models\ColorFilter;
use App\Models\CountryFilter;
use App\Models\Filter;
use App\Models\Item;
use App\Models\Gallery;
use App\Models\ItemRecommended;
use App\Models\Language;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class ItemsController extends BaseController
{
    public function index($categoryAlias)
    {
        /** @var Category $category */
        $category = Category::with(['children', 'parent' => function (BelongsTo $category) {
            return $category->with('children');
        }])->where('alias', $categoryAlias)->firstOrFail();

        $parentIds = $category->getNestedParents()->pluck('id')->toArray();
        $parentIds[] = $category->id;

        $pageData['filters'] = Filter::with(['criteria' => function (HasMany $criteria) use ($parentIds) {
            $criteria->whereHas('items', function (Builder $query) use ($parentIds) {
                $query->whereHas('category', function (Builder $query) use ($parentIds) {
                    $query->whereIn('categories.id', $parentIds);
                });
            });
        }])->whereHas('categories', function (Builder $query) use ($parentIds) {
            return $query->whereIn('categories.id', $parentIds);
        })->whereHas('criteria', function (Builder $query) use ($parentIds) {
            $query->whereHas('items', function (Builder $query) use ($parentIds) {
                $query->whereHas('category', function (Builder $query) use ($parentIds) {
                    $query->whereIn('categories.id', $parentIds);
                });
            });
        })->get();

        $pageData['category'] = $category;

        $pageData['colorFilters'] = ColorFilter::sort()->whereHas('items', function (Builder $query) use ($parentIds) {
            $query->where(['active' => true])->whereIn('category_id', $parentIds);
        })->get();

        $pageData['countryFilters'] = CountryFilter::sort()->whereHas('items', function (Builder $query) use ($parentIds) {
            $query->where(['active' => true])->whereIn('category_id', $parentIds);
        })->get();

        $pageData['brandFilters'] = Brand::sort()->whereHas('items', function (Builder $query) use ($parentIds) {
            $query->where(['active' => true])->whereIn('category_id', $parentIds);
        })->get();

        //dd(count($pageData['brandFilters']));
        $pageData['seo'] = $this->renderSEO($category);

        $breadcrumbs = [];
        $parent = $category->parent;
        $grandParent = $parent ? $parent->parent : null;

        if ($grandParent) {
            $breadcrumbs[] = [
                'title' => $grandParent->name
            ];
        }
        if ($parent) {
            $breadcrumbs[] = [
                'title' => $parent->name,
                'url' => !is_null($parent->parent_id) ? route('products.list', ['category' => $parent->alias]) : null
            ];
        }
        $breadcrumbs[] = [
            'title' => $category->name,
            'url' => route('products.list', ['category' => $category->alias])
        ];

        $pageData['breadcrumbs'] = $breadcrumbs;

        return view('site.pages.product.index', $pageData);
    }

    protected function detail($alias)
    {
        $item = Item::query()
            ->where('alias', $alias)
            ->where('active', 1)
            ->with(['category', 'options', 'brands'])->firstOrFail();
        $pageData['collection'] = Collection::query()
            ->where('active', 1)
            ->where('id', $item->collection_id)
            ->with('items')
            ->first();
        if ($pageData['collection']){
            $pageData['collection_gallery'] = Gallery::get('collections_item', $pageData['collection']->id);
        }
        $pageData['item_gallery'] = Gallery::get('items_item', $item->id);
        $pageData['item'] = $item;
        //$pageData['category'] = ItemCategories::where('item_id', $item->id)->with('categories')->first();
        //$brands = BrandsItems::where('item_id', $item->id)->with('brands')->first();
        //$pageData['brands'] = empty($brands) ? null : $brands->brands[0];
        $pageData['filters'] = Filter::with(['criteria' => function (HasMany $criteria) use ($item) {
            $criteria->whereHas('items', function (Builder $query) use ($item) {
                $query->where('items.id', $item->id);
            });
        }])->whereHas('criteria', function (Builder $query) use ($item) {
            $query->whereHas('items', function (Builder $query) use ($item) {
                $query->where('items.id', $item->id);
            });
        })->get();

        $id = [$pageData['item']->id];
        $pageData['colorFilters'] = ColorFilter::query()->whereHas('items', function (Builder $query) use ($id){
            $query->whereIn('color_filters_relations.item_id', $id);
        })->sort()->get();
        $pageData['countryFilters'] = CountryFilter::query()->whereHas('items', function (Builder $query) use ($id){
            $query->whereIn('country_filters_relations.item_id', $id);
        })->sort()->get();

        /*if (Auth::check() && auth()->user()->type == 0) {
            $pageData['item_favorite'] = Favorite::where('item_id', $item->id)->where('user_id', auth()->user()->id)->first();
        }
        if (Auth::check() && auth()->user()->type == 0) {
            $review = ReviewItem::where('item_id', $item->id)->where('user_id', \auth()->user()->id)->first();
        }*/
        $pageData['add_review'] = false;
        if (Auth::check() && auth()->user()->type == 0) {
            $pageData['basket_item'] = \App\Models\Basket::getItemView($item->id);
        }
        if (empty($review)) {
            $pageData['add_review'] = true;
        }

        $similiar_items = ItemRecommended::query()->where('item_id', $item->id)->pluck('recommended_id')->toArray();
        $similiar_items = Item::query()
            ->where('id', '!=', $item->id)
            ->where(['active' => 1])
            ->whereIn('id', $similiar_items)
            ->inRandomOrder()
            ->limit(10)
            ->get();
        $pageData['similiar_items'] = [];
        if (count($similiar_items) < 10) {
            $new_count = 10 - count($similiar_items);
            $new_items = Item::query()
                ->where('id', '!=', $item->id)
                ->where(['active' => 1, 'category_id' => $item->category_id])
                ->inRandomOrder()
                ->limit($new_count)
                ->get();
            foreach ($similiar_items as $item) {
                $pageData['similiar_items'][] = $item;
            }
            foreach ($new_items as $item) {
                $pageData['similiar_items'][] = $item;
            }
        }

        /*$companies_where_one_time_package = CompanyOneTimePayment::where('created_at', '>', Carbon::now()->subWeek()->toDateTimeString())->where(['status' => 1, 'package_id' => 3])->pluck('company_id')->toArray();
        $similiar_items = CompanyItems::whereIn('user_id', $companies_where_one_time_package)->pluck('item_id')->toArray();
        $pageData['reviews'] = ReviewItem::where('item_id', $item->id)->with('reviews', 'user')->get();
        $similiar_items = Items::where('active', 1)->where('moderated', 1)->whereIn('id', $similiar_items)->inRandomOrder()->limit(8)->get();
        $pageData['similar_items'] = [];
        if (count($similiar_items) < 8) {
            $new_count = 8 - count($similiar_items);
            $new_items = Items::where(['active' => 1, 'moderated' => 1])->inRandomOrder()->limit($new_count)->get();
            foreach ($new_items as $item) {
                $pageData['similar_items'][] = $item;
            }
            foreach ($similiar_items as $item) {
                $pageData['similar_items'][] = $item;
            }
        }*/
        $this->renderSEO($item);

        $breadcrumbs = [];
        $category = $item->category;
        $parent = $category->parent;
        $grandParent = $parent ? $parent->parent : null;

        if ($grandParent) {
            $breadcrumbs[] = [
                'title' => $grandParent->name
            ];
        }
        if ($parent) {
            $breadcrumbs[] = [
                'title' => $parent->name,
                'url' => !is_null($parent->parent_id) ? route('products.list', ['category' => $parent->alias]) : null
            ];
        }
        $breadcrumbs[] = [
            'title' => $category->name,
            'url' => route('products.list', ['category' => $category->alias])
        ];

        $breadcrumbs[] = [
            'title' => $item->title,
            'url' => route('product.detail', ['alias' => $item->alias])
        ];

        $pageData['breadcrumbs'] = $breadcrumbs;

        return view('site.pages.product.detail', $pageData);
    }

    public function search(Request $request)
    {
        if (empty($request->query('searchQuery'))) {
            return redirect()->back()->withErrors(['search_empty' => 'Заполните поле']);
        }

        /*$languages = Language::getLanguages();
        foreach ($languages as $language){
            $isos[] = $language->iso;
        }*/

        $query_parts = explode(' ', $request->query('searchQuery'));

        $items = Item::query();
        $items = $items->where('active', 1)->where(function ($q) use ($query_parts) {
            foreach ($query_parts as $part) {
                $q->where('code', 'LIKE', '%' . $part . '%')
                    ->orWhere('title->ru', 'LIKE', '%' . $part . '%')
                    ->orWhere('title->en', 'LIKE', '%' . $part . '%')
                    ->orWhere('title->hy', 'LIKE', '%' . $part . '%');
                    /*->orWhere('description->ru', 'LIKE', '%' . $part . '%')
                    ->orWhere('description->en', 'LIKE', '%' . $part . '%')
                    ->orWhere('description->hy', 'LIKE', '%' . $part . '%')
                    ->orWhere('short_description->ru', 'LIKE', '%' . $part . '%')
                    ->orWhere('short_description->en', 'LIKE', '%' . $part . '%')
                    ->orWhere('short_description->hy', 'LIKE', '%' . $part . '%');*/
            }
        });

        $data['items'] = $items->has('category')
            ->orderByDesc('id')
            ->paginate(48);
        $data['items']->appends($request->query());
        $data['search'] = $request->query('searchQuery');
        //$data['seo'] = $this->staticSEO($request->query('searchQuery') . ' - ' . __('app.search results'));

        return view('site.pages.product.search', $data);
    }

    public function getPortion(Request $request)
    {
        $items = Item::query()
            //->where('count', '>', 0)
            ->where(['active' => 1])->with('collection');

        $category = Category::with('children')->where('alias', $request->query('category'))->first();
        $items = $this->filterByRequest($items, $request);
        $items = $items->paginate(48);

        /** @var LengthAwarePaginator $items */
        $items->withPath(route('products.list', ['category' => $category->alias]));
        $items->appends($request->except('page'));

        return response()->view('site.layouts.products-constructor', [
            'items' => $items
        ]);
    }

    public function getPriceRange(Request $request)
    {
        $items = Item::query()
            ->select('id', 'price')
            ->where('active', 1)
            ->where(['active' => 1]);

        $items = $this->filterByRequest($items, $request, false);

        return response()->json([
            'min' => $items->min('price'),
            'max' => $items->max('price'),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function changeItemByCollection(Request $request)
    {
        $id = $request->input('itemId');
        $item = Item::query()
            ->where('id', $id)
            ->where('active', 1)
            ->with(['category', 'options', 'brands'])->firstOrFail();
        $collection = Collection::query()
            ->where('active', 1)
            ->where('id', $item->collection_id)
            ->with('items')
            ->first();
        if ($collection){
            $collection_gallery = Gallery::get('collections_item', $collection->id);
        }
        $item_gallery = Gallery::get('items_item', $item->id);

        $pageData['filters'] = Filter::with(['criteria' => function (HasMany $criteria) use ($item) {
            $criteria->whereHas('items', function (Builder $query) use ($item) {
                $query->where('items.id', $item->id);
            });
        }])->whereHas('criteria', function (Builder $query) use ($item) {
            $query->whereHas('items', function (Builder $query) use ($item) {
                $query->where('items.id', $item->id);
            });
        })->get();

        $id = [$item->id];
        $pageData['colorFilters'] = ColorFilter::query()->whereHas('items', function (Builder $query) use ($id){
            $query->whereIn('color_filters_relations.item_id', $id);
        })->sort()->get();
        $pageData['countryFilters'] = CountryFilter::query()->whereHas('items', function (Builder $query) use ($id){
            $query->whereIn('country_filters_relations.item_id', $id);
        })->sort()->get();

        return response()->view('site.components.itemByCollection', [
            'collection' => $collection,
            'item' => $item,
            'item_gallery' => $item_gallery,
            'filters' => count($pageData['filters']) ? $pageData['filters'] : null,
            'colorFilters' => count($pageData['colorFilters']) ? $pageData['colorFilters'] : null,
            'countryFilters' => count($pageData['countryFilters']) ? $pageData['countryFilters'] : null,
            'collection_gallery' => isset($collection_gallery) ? $collection_gallery : null
        ]);
    }

    /**
     * @param $items
     * @param Request $request
     * @param bool $filterByPrice
     * @return Builder
     */
    protected function filterByRequest(Builder $items, Request $request, $filterByPrice = true)
    {
        if ($categoryUrl = $request->query('category')) {
            $category = Category::with('children')->where('alias', $categoryUrl)->first();

            //$categoryIds = $category->children->pluck('id')->toArray();
            $categoryIds[] = $category->id;

            $items = $items->whereIn('category_id', $categoryIds);
        }
        if ($filterByPrice && ($colorFilters = $request->query('colorFilters'))) {
            $colorFilters = json_decode($colorFilters);
            $items = $items->whereHas('colorFilters', function (Builder $query) use ($colorFilters) {
                $query->whereIn('color_filters.id', $colorFilters);
            });
        }
        if ($filterByPrice && ($countryFilters = $request->query('country'))) {
            $countryFilters = json_decode($countryFilters);
            if (!empty($countryFilters)){
                $items = $items->whereHas('countryFilters', function (Builder $query) use ($countryFilters) {
                    $query->whereIn('country_filters.id', $countryFilters);
                });
            }
        }
        if ($filterByPrice && ($brandFilters = $request->query('brand'))) {
            $brandFilters = json_decode($brandFilters);
            if (!empty($brandFilters)){
                $items = $items->whereHas('brands', function (Builder $query) use ($brandFilters) {
                    $query->whereIn('brands.id', $brandFilters);
                });
            }
        }
        if ($filterByPrice && ($criteriaIds = $request->query('criteria'))) {
            $criteriaIds = json_decode($criteriaIds);
            $filters = Filter::with(['criteria' => function (HasMany $criteria) use ($criteriaIds) {
                $criteria->whereIn('criteria.id', $criteriaIds);
            }])->whereHas('criteria', function (Builder $query) use ($criteriaIds) {
                return $query->whereIn('criteria.id', $criteriaIds);
            })->get();

            foreach ($filters as $filter) {
                $items = $items->whereHas('criteria', function (Builder $query) use ($filter) {
                    $ids = $filter->criteria->pluck('id')->toArray();
                    $query->whereIn('criteria.id', $ids);
                });
            }
        }

        if ($filterByPrice && ($priceRange = $request->query('priceRange'))) {
            $priceRange = json_decode($priceRange, true);

            $items = $items->whereBetween('price', [$priceRange['from'], $priceRange['to']]);
        }

//        $items->orderByDesc('in_stock');
        if ($filterByPrice && ($sortType = $request->query('sortType'))) {
            switch ($sortType) {
                case 1:
                    $column = 'price';
                    $direction = 'desc';
                    break;
                case 2:
                    $column = 'price';
                    $direction = 'asc';
                    break;
                case 4:
                    $column = 'is_new';
                    $direction = 'desc';
                    break;
                case 5:
                    $column = 'discount';
                    $direction = 'desc';
                    break;
                default:
                    $column = 'ordering';
                    $direction = 'asc';
            }

            $items = $items->orderBy($column, $direction);
        }

        return $items;
    }
}
