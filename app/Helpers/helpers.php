<?php

use App\Helpers\AdvancedOptional;
use App\Model\Entities\Design\HomeText;
use App\Services\File\ImageProxyService;
use App\Services\Socialite\SocialShareService;
use Carbon\Carbon;

if (!function_exists('trans')) {
    /**
     * Translate the given message.
     *
     * @param string $key
     * @param array  $replace
     * @param string $locale
     *
     * @return \Illuminate\Contracts\Translation\Translator|string|array|null
     */
    function trans($key = null, $replace = [], $locale = null)
    {
        $translation = null;

        $list = app('fastshop.global')->get('translations', []);

        if (count($list) > 0) {
            $collection = collect($list);

            $translation = $collection->get($key);

            // 佔位符替換。
            if (!is_null($translation) && count($replace) > 0) {
                foreach ($replace as $string => $value) {
                    $translation = preg_replace("/:{$string}/", $value, $translation);
                }
            }
        }

        return filled($translation) ? $translation : app('translator')->trans($key, $replace, $locale);
    }
}

/**
 * In the debug mode, the exception is presented in a default manner.
 *
 * @param Exception $exception
 *
 * @throws Exception
 */
function exception_debug($exception)
{
    report($exception);

    if (config()->get('app.debug', false)) {
        throw $exception;
    }
}

if (!function_exists('advanced_optional')) {
    /**
     * @param $value
     *
     * @return AdvancedOptional
     */
    function advanced_optional($value)
    {
        return new AdvancedOptional($value);
    }
}

if (!function_exists('social_share_link')) {
    /**
     * 社群分享連結。
     *
     * @param string      $driver
     * @param string|null $content
     *
     * @return null|string
     */
    function social_share_link($driver, $content = null)
    {
        $socialShareService = new SocialShareService();

        return $socialShareService->generateShareLink($driver, $content);
    }
}

if (!function_exists('str_alpha_random')) {
    /**
     * Generate a more truly "random" alpha string.
     *
     * @param int $length
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    function str_alpha_random($length = 16)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $string = '';

        while (strlen($string) < $length) {
            $string .= $characters[rand(0, $charactersLength - 1)];
        }

        return $string;
    }
}

if (!function_exists('price_format')) {
    /**
     * 價格格式化。
     *
     * @param float $value
     *
     * @return string
     */
    function price_format($value)
    {
        $decimalPlace = app('fastshop.global')->get('currency.decimal_place');
        $symbol = app('fastshop.global')->get('currency.symbol');
        $symbol = $symbol ? $symbol . ' ' : null;

        $value = number_format($value, $decimalPlace);

        return $symbol . $value;
    }
}

if (!function_exists('price_round')) {
    /**
     * 價格四捨五入。
     *
     * @param float $value
     *
     * @return string
     */
    function price_round($value)
    {
        $decimalPlace = app('fastshop.global')->get('currency.decimal_place', 0);

        $value = round($value, $decimalPlace);

        if ((float)$value == (int)$value) {
            return (int)$value;
        }

        return (float)$value;
    }
}

if (!function_exists('global_setting')) {
    /**
     * Get the global setting value。
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return string
     */
    function global_setting($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('fastshop.global')->get('setting', $default);
        }

        return app('fastshop.global')->get('setting.' . $key, $default);
    }
}

if (!function_exists('global_locale_setting')) {
    /**
     * Get the global setting value。
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return string
     */
    function global_locale_setting($key = null, $default = null)
    {
        if (is_null($key)) {
            $value = app('fastshop.global')->get('setting', $default);
        } else {
            $value = app('fastshop.global')->get('setting.' . $key, $default);
        }

        if (is_array($value)) {
            return $value[config('app.language_id')] ?? null;
        }

        return $value;
    }
}

if (!function_exists('is_json')) {
    /**
     * Check the string is JSON。
     *
     * @param string $text
     *
     * @return string
     */
    function is_json($string)
    {
        if (!is_string($string)) {
            return false;
        }

        json_decode($string);

        return json_last_error() == JSON_ERROR_NONE;
    }
}

if (!function_exists('render_home_text')) {
    /**
     * @param HomeText $homeText
     *
     * @return mixed|null|string
     * @throws Throwable
     * @deprecated 繪製首頁文字。
     *
     */
    function render_home_text($homeText)
    {
        if (!isset($homeText) || is_null($homeText)) {
            return null;
        }

        return $homeText->content;
    }
}

if (!function_exists('shared_asset')) {
    /**
     * 使用共用的資源檔案。
     *
     * @param string $path
     * @param bool   $secure
     *
     * @return string
     */
    function shared_asset($path, $secure = null)
    {
        if (Url::isValidUrl($path)) {
            return $path;
        }

        $url = config('app.shared_asset_url') ?: request()->getBaseUrl();

        $path = $url . trim($path, '/');

        return app('url')->asset($path, $secure);
    }
}

if (!function_exists('database_table_comment')) {
    /**
     * 新增資料表註解。
     *
     * @param string $table
     * @param string $text
     */
    function database_table_comment($table, $text)
    {
        $prefix = DB::getTablePrefix();

        DB::statement("ALTER TABLE `{$prefix}{$table}` comment '{$text}';");
    }
}

if (!function_exists('replace_unique_key_in_soft_delete')) {
    /**
     * 軟刪除時，修改唯一鍵的內容。
     *
     * @param string $string
     */
    function replace_unique_key_in_soft_delete($string)
    {
        $now = Carbon::now()
                     ->format('YmdHis');

        return 'delete-' . $string . '-' . $now;
    }
}

if (!function_exists('get_image_url')) {
    /**
     * 取得圖片網址。
     *
     * @param string   $path
     * @param int|null $width
     * @param int|null $height
     *
     * @return string
     */
    function get_image_url($path, $width = null, $height = null)
    {
        $imageProxyService = app(ImageProxyService::class);

        $imageProxy = $imageProxyService->createImageProxy();

        return $imageProxy->generateUrl($path, ['w' => $width, 'h' => $height]);
    }
}

if (!function_exists('ajax_view')) {
    /**
     * Get the evaluated view contents for the given ajax view.
     *
     * @param string $path
     * @param array  $data
     * @param array  $mergeData
     *
     * @return string
     */
    function ajax_view($path = null, $data = [], $mergeData = [])
    {
        $view = view($path, $data, $mergeData);

        $path = $view->getPath();

        $data = array_merge($view->getFactory()
                                 ->getShared(), $view->getData());

        return $view->getEngine()
                    ->get($path, $data);
    }
}