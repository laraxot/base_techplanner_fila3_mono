<?php

declare(strict_types=1);

namespace Modules\Predict\Actions\Article;

use Illuminate\Support\Str;
use Modules\Lang\Models\Contracts\HasTranslationsContract;
use Modules\Xot\Actions\GetModelByModelTypeAction;
use Modules\Xot\Actions\GetModelClassByModelTypeAction;
use Webmozart\Assert\Assert;

class TranslateContentAction
{
    public function execute(string $model_class, string $article_id, array $locales, array $data, string $class): void
    {
        // dddx([app(GetModelClassByModelTypeAction::class)->execute($model_class), Article::class]);
        // dddx(app($class));
        $model = app(GetModelByModelTypeAction::class)->execute($model_class, $article_id);
        // Assert::isInstanceOf($model, app($class), '['.get_class($model).']['.$class.']['.__LINE__.']['.__FILE__.']');
        Assert::isInstanceOf($model, HasTranslationsContract::class, '['.get_class($model).']['.$class.']['.__LINE__.']['.__FILE__.']');
        // Assert::isArray($model_contents = $model->toArray(), '['.__LINE__.']['.__FILE__.']');

        foreach ($data as $item => $merge) {
            if (! $merge) {
                continue;
            }
            /*
            $model_content = $model_contents[$item];
            dddx([
                'item' => $item,
                'model_content' => $model_content,
                'model_cont1' => $model->getTranslation($item, 'it'),
            ]);
            */
            $model_content = $model->getTranslation($item, 'it');
            if (! is_array($model_content)) {
                $model_content = [];
            }

            foreach ($locales as $locale) {
                if ('it' == $locale) {
                    continue;
                }
                $model_content_locale = $model->getTranslation($item, $locale);
                if (! is_array($model_content_locale)) {
                    $model_content_locale = [];
                }

                if (count($model_content) == count($model_content_locale)) {
                    $c = count($model_content);
                    $model_content = array_values($model_content);
                    $model_content_locale = array_values($model_content_locale);
                    $content = [];
                    for ($i = 0; $i < $c; ++$i) {
                        $k = Str::uuid()->toString();
                        if (! is_array($model_content_locale[$i])) {
                            $model_content_locale[$i] = [];
                        }
                        if (! is_array($model_content[$i])) {
                            $model_content[$i] = [];
                        }
                        $content[$k] = array_merge($model_content_locale[$i], $model_content[$i]);
                    }
                    /*
                    dddx([
                        'item' => $item,
                        'locale' => $locale,
                        'content' => $content,
                        'model_content_locale' => $model_content_locale,
                    ]);
                    */
                    $model->setTranslation($item, $locale, $content);
                } else {
                    /*
                    dddx([
                        'item' => $item,
                        'locale' => $locale,
                        'content' => $model_content,
                    ]);
                    */
                    $model->setTranslation($item, $locale, $model_content);
                }
            }
        }

        $model->update();
    }
}
