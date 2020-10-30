<?php

namespace App\Helpers;

use App\Services\Common\Enum\ActiveEnum;
use App\Services\Field\Enum\FieldTypeEnum;
use Auth;
use FeatureChecker;
use App\Services\Feature\Enum\FeatureSnEnum;

class Helper
{

    /**
     * 取得後台發布狀態 icon class 列表。
     *
     * @return array
     */
    public static function getActiveIconClassList()
    {
        return [
            ActiveEnum::PUBLISHED => 'fa fa-check text-green',
            ActiveEnum::UNPUBLISHED => 'fa fa-remove text-red'
        ];
    }

    /**
     * 取得發布狀態列表。
     *
     * @return array
     */
    public static function getActiveList($hasAll = false)
    {
        $list = $hasAll ? [null => trans('database/general.active')] : [];

        return $list + [
                ActiveEnum::PUBLISHED => trans('other/helpers.helper.published'),
                ActiveEnum::UNPUBLISHED => trans('other/helpers.helper.unpublished')
            ];
    }

    /**
     * 取得後台選單發布狀態列表。
     *
     * @return array
     */
    public static function getBackendMenuActiveList($hasAll = false)
    {
        $list = $hasAll ? [null => trans('database/general.active')] : [];

        $list = $list + [
                ActiveEnum::PUBLISHED => trans('other/helpers.helper.published'),
                ActiveEnum::UNPUBLISHED => trans('other/helpers.helper.unpublished')
            ];

        $user = Auth::guard('backend')
                    ->user();

        if (!is_null($user) && $user->can('super-user')) {
            $list[ActiveEnum::SEO_USER] = trans('other/helpers.helper.seo') . ' #';
            $list[ActiveEnum::DESIGNER] = trans('other/helpers.helper.designer') . ' *';
            $list[ActiveEnum::HIDE] = trans('other/helpers.helper.hide') . ' **';
        } elseif (!is_null($user) && $user->can('seo-user')) {
            $list[ActiveEnum::SEO_USER] = trans('other/helpers.helper.seo') . ' #';
        } elseif (!is_null($user) && $user->can('designer')) {
            $list[ActiveEnum::DESIGNER] = trans('other/helpers.helper.designer') . ' *';
        }

        return $list;
    }

    /**
     * 取得 Form 類型列表。
     *
     * @return array
     */
    public static function getFormTypeList()
    {
        $formTypeList = [
                FieldTypeEnum::TEXT => trans('other/helpers.form_type.text'),
                FieldTypeEnum::TEXTAREA => trans('other/helpers.form_type.textarea'),
                FieldTypeEnum::PASSWORD => trans('other/helpers.form_type.password'),
                FieldTypeEnum::EMAIL => trans('other/helpers.form_type.email'),
                FieldTypeEnum::NUMBER => trans('other/helpers.form_type.number'),
                FieldTypeEnum::SELECT => trans('other/helpers.form_type.select'),
                FieldTypeEnum::CHECKBOX => trans('other/helpers.form_type.checkbox'),
                FieldTypeEnum::RADIO => trans('other/helpers.form_type.radio'),
                FieldTypeEnum::DATE => trans('other/helpers.form_type.date'),
                FieldTypeEnum::DATETIME => trans('other/helpers.form_type.date_time'),
                FieldTypeEnum::ADDRESS => trans('other/helpers.form_type.address'),
            ];
        //確認檔案上傳功能
        if (FeatureChecker::checkFeature(FeatureSnEnum::FORM_UPLOAD)) {
            $formTypeList[FieldTypeEnum::UPLOAD] = trans('other/helpers.form_type.upload');
        }

        return $formTypeList;
    }

    /**
     * 取得 Yes No 列表。
     *
     * @return array
     */
    public static function getYesNoList()
    {
        return [
            trans('other/helpers.helper.no'),
            trans('other/helpers.helper.yes')
        ];
    }
}