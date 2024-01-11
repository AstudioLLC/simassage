<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class ItemsImport extends AbstractImport
{
    protected $rules = [
        'code' => 'required|string|max:255',
        'category' => 'required|integer',
        'title_hy' => 'required|string|max:500',
        'title_ru' => 'max:500',
        'title_en' => 'max:500',
        'count' => 'nullable|integer',
        'price' => 'nullable|numeric|between:1,10000000000',
        'bulk_price' => 'nullable|numeric|between:1,10000000000',
        'discount' => 'nullable|int|min:1|max:100',
        'criteria' => 'nullable|string',
        'country' => 'nullable|string',
        'color' => 'nullable|string',
        'brand' => 'nullable|string',
        'short_description_hy' => 'nullable|string',
        'short_description_ru' => 'nullable|string',
        'short_description_en' => 'nullable|string',
        'description_hy' => 'nullable|string',
        'description_ru' => 'nullable|string',
        'description_en' => 'nullable|string',
        'unit_of_measurement_hy' => 'nullable|string',
        'unit_of_measurement_ru' => 'nullable|string',
        'unit_of_measurement_en' => 'nullable|string'
    ];

    protected $names = [
        'code' => 'Код', // t('Admin excel import.code')
        'category' => 'категория', // t('Admin excel import.category')
        'title_hy' => 'название армянский', // t('Admin excel import.title hy')
        'title_ru' => 'название русский', // t('Admin excel import.title ru')
        'title_en' => 'название английский', // t('Admin excel import.title en')
        'count' => 'остаток', // t('Admin excel import.count')
        'price' => 'цена', // t('Admin excel import.price')
        'bulk_price' => 'цена 2', // t('Admin excel import.price 2')
        'discount' => 'скидка', // t('Admin excel import.discount')
        'criteria' => 'фильтры', // t('Admin excel import.filters')
        'country' => 'Фильтр стран', // t('Admin excel import.country')
        'color' => 'Фильтр цветов', // t('Admin excel import.color')
        'brand' => 'Фильтр бренда', // t('Admin excel import.brand')
        'short_description_hy' => 'Короткое описание армянский', // t('Admin excel import.short description hy')
        'short_description_ru' => 'Короткое описание русский', // t('Admin excel import.short description ru')
        'short_description_en' => 'Короткое описание английский', // t('Admin excel import.short description en')
        'description_hy' => 'Контент армянский', // t('Admin excel import.description hy')
        'description_ru' => 'Контент русский', // t('Admin excel import.description ru')
        'description_en' => 'Контент английский', // t('Admin excel import.description en')
        'unit_of_measurement_hy' => 'Ед. измерения армянский', // t('Admin excel import.unit of measurement hy')
        'unit_of_measurement_ru' => 'Ед. измерения русский', // t('Admin excel import.unit of measurement ru')
        'unit_of_measurement_en' => 'Ед. измерения английский', // t('Admin excel import.unit of measurement en')

    ];

    private $all_catalogue = [];
    private $all_criteria = [];
    private $all_country = [];
    private $all_color = [];
    private $all_brand = [];
    private $code = [];

    protected function filter($data)
    {
        $data['code'] = mb_strtolower($data['code']);
        if (in_array($data['code'], $this->code)) return $this->skip('duplicate_in_file');
        $this->code[] = $data['code'];
        $thisCatalogue = $data['category'];
        if (!in_array($thisCatalogue, $this->all_catalogue)) $this->all_catalogue[] = $thisCatalogue;
        if (!$data['count']) $data['available'] = 0;

        $this_criteria = [];
        if ($data['criteria']) {
            $criteria = explode(',', $data['criteria']);
            foreach ($criteria as $criterion) {
                $criterion = (int)trim($criterion);
                if (!in_array($criterion, $this_criteria)) $this_criteria[] = $criterion;
                if (!in_array($criterion, $this->all_criteria)) $this->all_criteria[] = $criterion;
            }
        }
        $data['criteria'] = $this_criteria;

        $this_country = [];
        if ($data['country']) {
            $countries = explode(',', $data['country']);
            foreach ($countries as $country) {
                $country = (int)trim($country);
                if (!in_array($country, $this_country)) $this_country[] = $country;
                if (!in_array($country, $this->all_country)) $this->all_country[] = $country;
            }
        }
        $data['country'] = $this_country;

        $this_color = [];
        if ($data['color']) {
            $colors = explode(',', $data['color']);
            foreach ($colors as $color) {
                $color = (int)trim($color);
                if (!in_array($color, $this_color)) $this_color[] = $color;
                if (!in_array($color, $this->all_color)) $this->all_color[] = $color;
            }
        }
        $data['color'] = $this_color;

        $this_brand = [];
        if ($data['brand']) {
            $brands = explode(',', $data['brand']);
            foreach ($brands as $brand) {
                $brand = (int)trim($brand);
                $brandExistsQuery = Brand::query()->where('id', $brand)->get();
                if (count($brandExistsQuery)) {
                    if (!in_array($brand, $this_brand)) $this_brand[] = $brand;
                    if (!in_array($brand, $this->all_brand)) $this->all_brand[] = $brand;
                }
            }
        }
        $data['brand'] = $this_brand;

        return $this->add($data);
    }

    protected function callback()
    {
        $result_parts = Item::select('id', 'code')->whereIn('code', $this->code)->get()->mapWithKeys(function ($item) {
            return [lower_case($item->code) => $item];
        });

        //$increment = Item::getIncrement();
        $incrementQuery = Item::query()->select('id')->orderBy('id', 'desc')->take(1)->first();
        if ($incrementQuery) {
            $increment = $incrementQuery->id+1;
        } else {
            $increment = Item::getIncrement();
        }
        $inserts = [];
        $updates = [];

        $items_having_criteria = [];
        $inserts_criterions = [];

        $items_having_country = [];
        $inserts_countries = [];

        $items_having_color = [];
        $inserts_colors = [];

        $items_having_brand = [];
        $inserts_brands = [];

        foreach ($this->rows as $index => $row) {
            $category = Category::query()->where('id', $row['category'])->first();

            if (empty($category)) {
                $this->errors->push([
                    'row' => ++$index,
                    'reason' => t('Admin items.no category'),
                ]);
            }
            $part = $result_parts[$row['code']] ?? null;
            if ($part) {
                $this_id = $part->id;
                $edit = true;
            } else {
                $this_id = $increment;
                $edit = false;
            }
            $continue = false;
            if ($continue) continue;

            /**
             * @property double $price
             * @property double $bulk_price
             */
            if ($row['price'] !== null) {
                $price = $row['price'] - ($row['price'] * $row['discount'] / 100);
            } else {
                if ($row['bulk_price'] !== null) {
                    $price = $row['bulk_price'] - ($row['bulk_price'] * $row['discount'] / 100);
                } else {
                    $price = $row['bulk_price'] ?? null;
                }
            }

            if ($row['bulk_price'] !== null) {
                $bulk_price = $row['bulk_price'];
            } else {
                if ($row['price'] !== null) {
                    $bulk_price = $row['price'];
                } else {
                    $bulk_price = $row['bulk_price'] ?? null;
                }
            }

            if ($edit) {
                /** if empty, not update existing columns */
                $item = Item::query()->where('id', $this_id)->firstOrFail()->toArray();
                if ($row['title_ru'] == null) {
                    $row['title_ru'] = isset($item['title']['ru']) ? $item['title']['ru'] : null;
                }
                if ($row['title_en'] == null) {
                    $row['title_en'] = isset($item['title']['en']) ? $item['title']['en'] : null;
                }
                if ($row['description_hy'] == null) {
                    $row['description_hy'] = isset($item['description']['hy']) ? $item['description']['hy'] : null;
                }
                if ($row['description_ru'] == null) {
                    $row['description_ru'] = isset($item['description']['ru']) ? $item['description']['ru'] : null;
                }
                if ($row['description_en'] == null) {
                    $row['description_en'] = isset($item['description']['en']) ? $item['description']['en'] : null;
                }
                if ($row['short_description_hy'] == null) {
                    $row['short_description_hy'] = isset($item['short_description']['hy']) ? $item['short_description']['hy'] : null;
                }
                if ($row['short_description_ru'] == null) {
                    $row['short_description_ru'] = isset($item['short_description']['ru']) ? $item['short_description']['ru'] : null;
                }
                if ($row['short_description_en'] == null) {
                    $row['short_description_en'] = isset($item['short_description']['en']) ? $item['short_description']['en'] : null;
                }

                /*if ($row['unit_of_measurement_hy'] == null) {
                    $row['unit_of_measurement_hy'] = isset($item['unit_of_measurement_hy']['hy']) ? $item['unit_of_measurement_hy']['hy'] : null;
                }
                if ($row['unit_of_measurement_ru'] == null) {
                    $row['unit_of_measurement_ru'] = isset($item['unit_of_measurement_ru']['ru']) ? $item['unit_of_measurement_ru']['ru'] : null;
                }
                if ($row['unit_of_measurement_en'] == null) {
                    $row['unit_of_measurement_en'] = isset($item['unit_of_measurement_en']['en']) ? $item['unit_of_measurement_en']['en'] : null;
                }*/

                $updates[] = [
                    'id' => $this_id,
                    'category_id' => explode(',', $row['category'])[0],
                    'code' => $row['code'],
                    'alias' => to_url_suf($row['title_hy']),
                    'title' => json_encode(['ru' => $row['title_ru'], 'hy' => $row['title_hy'], 'en' => $row['title_en']]),
                    'description' => json_encode(['ru' => $row['description_ru'], 'hy' => $row['description_hy'], 'en' => $row['description_en']]),
                    'short_description' => json_encode(['ru' => $row['short_description_ru'], 'hy' => $row['short_description_hy'], 'en' => $row['short_description_en']]),
                    'unit_of_measurement' => json_encode(['ru' => $row['unit_of_measurement_ru'], 'hy' => $row['unit_of_measurement_hy'], 'en' => $row['unit_of_measurement_en']]),
                    'price' => $price,
                    //'price' => $row['price'] - ($row['price'] * $row['discount'] / 100),
                    'count' => (!empty($row['count']) || $row['count'] === "0") ? $row['count'] : 0,
                    'bulk_price' => $bulk_price,
                    //'bulk_price' => $row['bulk_price'] ?? null,//$row['price'],
                    //'bulk_price' => null,
                    'discount' => $row['discount'] ?? null,
                    'updated_at' => now()->toDateTimeString(),
                ];
            } else {
                $increment++;
                $inserts[] = [
                    'id' => $this_id,
                    'code' => $row['code'],
                    'title' => json_encode(['ru' => $row['title_ru'], 'hy' => $row['title_hy'], 'en' => $row['title_en']]),
                    'description' => json_encode(['ru' => $row['description_ru'], 'hy' => $row['description_hy'], 'en' => $row['description_en']]),
                    'short_description' => json_encode(['ru' => $row['short_description_ru'], 'hy' => $row['short_description_hy'], 'en' => $row['short_description_en']]),
                    'unit_of_measurement' => json_encode(['ru' => $row['unit_of_measurement_ru'], 'hy' => $row['unit_of_measurement_hy'], 'en' => $row['unit_of_measurement_en']]),
                    //'price' => $row['price'] - ($row['price'] * $row['discount'] / 100),
                    'price' => $price,
                    //'bulk_price' => $row['bulk_price'] ?? null,//$row['price'],
                    'bulk_price' => $bulk_price,
                    //'bulk_price' => null,
                    'count' => $row['count'] ?? 0,
                    'active' => 0,
                    'discount' => $row['discount'] ?? null,
                    'alias' => to_url_suf($row['title_hy']),
                    'category_id' => explode(',', $row['category'])[0],
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString(),
                ];
            }

            if (!empty($row['criteria'])) {
                foreach ($row['criteria'] as $criteria) {
                    if (!in_array($this_id, $items_having_criteria)) {
                        $items_having_criteria[] = $this_id;
                    }
                    $inserts_criterions[] = [
                        'item_id' => $this_id,
                        'criterion_id' => $criteria,
                    ];
                }
            }

            if (!empty($row['country'])) {
                foreach ($row['country'] as $country) {
                    if (!in_array($this_id, $items_having_country)) {
                        $items_having_country[] = $this_id;
                    }
                    $inserts_countries[] = [
                        'item_id' => $this_id,
                        'filter_id' => $country,
                    ];
                }
            }

            if (!empty($row['color'])) {
                foreach ($row['color'] as $color) {
                    if (!in_array($this_id, $items_having_color)) {
                        $items_having_color[] = $this_id;
                    }
                    $inserts_colors[] = [
                        'item_id' => $this_id,
                        'filter_id' => $color,
                    ];
                }
            }

            if (!empty($row['brand'])) {
                foreach ($row['brand'] as $brand) {
                    if (!in_array($this_id, $items_having_brand)) {
                        $items_having_brand[] = $this_id;
                    }
                    $inserts_brands[] = [
                        'item_id' => $this_id,
                        'brand_id' => $brand,
                    ];
                }
            }

        }

        DB::transaction(function () use ($inserts, $updates, $inserts_criterions, $items_having_criteria) {
            if (count($inserts)) {
                if (Item::query()->insert($inserts) && count($inserts_criterions)) {
                    DB::table('item_criterion_references')->insert($inserts_criterions);
                }
            }

            if (count($updates)) {
                if (Item::insertOrUpdate($updates, ['title', 'code', 'description', 'short_description', 'discount', 'bulk_price', 'price', 'count', 'category_id', 'alias', 'unit_of_measurement']) && count($inserts_criterions)) {
                    DB::table('item_criterion_references')->whereIn('item_id', $items_having_criteria)->delete();
                    DB::table('item_criterion_references')->insert($inserts_criterions);
                }
            }
        });

        DB::transaction(function () use ($inserts, $updates, $inserts_countries, $items_having_country) {
            if (count($inserts)) {
                if (count($inserts_countries)) {
                    DB::table('country_filters_relations')->insert($inserts_countries);
                }
            }

            if (count($updates)) {
                if (count($inserts_countries)) {
                    DB::table('country_filters_relations')->whereIn('item_id', $items_having_country)->delete();
                    DB::table('country_filters_relations')->insert($inserts_countries);
                }
            }
        });

        DB::transaction(function () use ($inserts, $updates, $inserts_colors, $items_having_color) {
            if (count($inserts)) {
                if (count($inserts_colors)) {
                    DB::table('color_filters_relations')->insert($inserts_colors);
                }
            }

            if (count($updates)) {
                if (count($inserts_colors)) {
                    DB::table('color_filters_relations')->whereIn('item_id', $items_having_color)->delete();
                    DB::table('color_filters_relations')->insert($inserts_colors);
                }
            }
        });

        DB::transaction(function () use ($inserts, $updates, $inserts_brands, $items_having_brand) {
            if (count($inserts)) {
                if (count($inserts_brands)) {
                    DB::table('item_brands_relations')->insert($inserts_brands);
                }
            }

            if (count($updates)) {
                if (count($inserts_brands)) {
                    DB::table('item_brands_relations')->whereIn('item_id', $items_having_brand)->delete();
                    DB::table('item_brands_relations')->insert($inserts_brands);
                }
            }
        });
    }
}
