<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2018 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace hrzg\widget\models\crud;

use hrzg\widget\models\crud\base\WidgetTranslation;


/**
 * Class WidgetContentTranslation
 * @package hrzg\widget\models\crud
 * @author Elias Luhr <e.luhr@herzogkommunikation.de>
 */
class WidgetContentTranslation extends WidgetTranslation
{
    /**
     *  Check if user can language & application mode not is cli
     *
     * @param $attribute
     *
     * @return boolean
     */
    public function validateAccessDomain($attribute)
    {
        return $this->attributes[$attribute] !== \Yii::$app->language && php_sapi_name() !== 'cli';
    }
}