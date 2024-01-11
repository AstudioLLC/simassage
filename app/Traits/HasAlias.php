<?php


namespace App\Traits;

use App\Models\Item;
use App\Models\Language;
use App\Services\Support\Str;

/**
 * Trait HasAlias
 * @package App\Traits
 *
 * @property string $alias
 */
trait HasAlias
{
    /**
     * @return string
     */
    public function getAbsoluteUrl()
    {
        return '';
    }

    /**
     * @return void
     */
    public function generateAlias($code)
    {
        $alias = Str::slug($this->getTranslation($this->aliasSource, Language::getUrlLang()));
        $aliasesQuery = static::query();

        if ($this->id) {
            $aliasesQuery = $aliasesQuery->where('id', '!=', $this->id);
        }

        $existingAliases = $aliasesQuery->pluck('alias')->toArray();

        $this->setAttribute('alias', $this->incrementAlias($alias, $existingAliases, $code));
    }

    /**
     * @param $alias
     * @param $aliases
     * @param int $increment
     * @return string
     */
    protected function incrementAlias($alias, $aliases, $code, $increment = 1)
    {
        if (!in_array($alias, $aliases)) {
            return $alias;
        }


        $incrementedAlias = $alias . '-' . $code;
        if (!in_array($incrementedAlias, $aliases)) {
            return $incrementedAlias;
        }

        return $this->incrementAlias($alias, $aliases, $code, ++$increment);
    }
}
