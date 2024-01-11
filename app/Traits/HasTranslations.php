<?php

namespace App\Traits;

use Spatie\Translatable\HasTranslations as HasTranslationsBase;

trait HasTranslations
{
    use HasTranslationsBase {
        setTranslations as setTranslationsBase;
    }

    protected $lang = 'en';

    protected function getLang()
    {
        if (!$this->lang) $this->lang = view()->shared('lang', config('translatable.fallback_locale'));

        return $this->lang;
    }

    public function a($key)
    {
        return $this->getTranslation($key, $this->getLang());
    }

    public function getTranslation(string $key, string $locale, bool $useFallbackLocale = false)
    {
        $locale = $this->normalizeLocale($key, $locale, $useFallbackLocale);
        $translations = $this->getTranslations($key);

        $translation = $translations[$locale] ?? '';

        if ($this->hasGetMutator($key)) {
            return $this->mutateAttribute($key, $translation);
        }

        return $translation;
    }

    public function setTranslations(string $key, array $translations)
    {
        return $this->setTranslationsBase($key, array_filter($translations));
    }

    protected function asJson($value)
    {
        return json($value);
    }
}
