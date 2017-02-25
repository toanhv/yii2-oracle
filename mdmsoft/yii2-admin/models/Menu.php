<?php

namespace mdm\admin\models;

use Yii;
use mdm\admin\components\Configs;

/**
 * This is the model class for table "MENU".
 *
 * @property integer $ID
 * @property string $NAME
 * @property integer $PARENT
 * @property string $ROUTE
 * @property integer $PRIORITY
 * @property string $DATA
 *
 * @property Menu $menuParent Menu parent
 * @property Menu[] $menus Menu children
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class Menu extends \yii\db\ActiveRecord {

    public $parent_name;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return Configs::instance()->menuTable;
    }

    /**
     * @inheritdoc
     */
    public static function getDb() {
        if (Configs::instance()->db !== null) {
            return Configs::instance()->db;
        } else {
            return parent::getDb();
        }
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['NAME'], 'required'],
            [['ID', 'PARENT', 'PRIORITY'], 'integer'],
            [['NAME'], 'string', 'max' => 128],
            [['ROUTE', 'DATA'], 'string', 'max' => 256],
            [['ID'], 'unique'],
            [['ROUTE'], 'in',
                'range' => static::getSavedRoutes(),
                'message' => 'Route "{value}" not found.'],
            [['parent_name'], 'in',
                'range' => static::find()->select(['name'])->column(),
                'message' => 'Menu "{value}" not found.'],
        ];
    }

    /**
     * Use to loop detected.
     */
    public function filterParent() {
        $value = $this->parent_name;
        $parent = self::findOne(['name' => $value]);
        if ($parent) {
            $id = $this->ID;
            $parent_id = $parent->ID;
            while ($parent) {
                if ($parent->ID == $id) {
                    $this->addError('parent_name', 'Loop detected.');

                    return;
                }
                $parent = $parent->menuParent;
            }
            $this->PARENT = $parent_id;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('rbac-admin', 'ID'),
            'name' => Yii::t('rbac-admin', 'Name'),
            'parent' => Yii::t('rbac-admin', 'Parent'),
            'parent_name' => Yii::t('rbac-admin', 'Parent Name'),
            'route' => Yii::t('rbac-admin', 'Route'),
            'order' => Yii::t('rbac-admin', 'Order'),
            'data' => Yii::t('rbac-admin', 'Data'),
        ];
    }

    /**
     * Get menu parent
     * @return \yii\db\ActiveQuery
     */
    public function getMenuParent() {
        return $this->hasOne(Menu::className(), ['ID' => 'PARENT']);
    }

    /**
     * Get menu children
     * @return \yii\db\ActiveQuery
     */
    public function getMenus() {
        return $this->hasMany(Menu::className(), ['PARENT' => 'ID']);
    }

    /**
     * Get saved routes.
     * @return array
     */
    public static function getSavedRoutes() {
        $result = [];
        foreach (Yii::$app->getAuthManager()->getPermissions() as $name => $value) {
            if ($name[0] === '/' && substr($name, -1) != '*') {
                $result[] = $name;
            }
        }

        return $result;
    }

}
