<?php

namespace common\widgets;

use common\components\CategoryTree;
use common\models\Category;
use yii;
use yii\helpers\Html;

/**
 * Class CategoryList
 * @package common\widgets
 */
class CategoryList extends yii\base\Widget
{
    /**
     * @var
     */
    private $_htmlStr;

    /**
     * @var
     */
    public $options;

    /**
     *
     */
    public function init()
    {
        parent::init();

        $categories = CategoryTree::getInstance()->getAllCategories();

        $this->_htmlStr = '<ul>';

        if (!empty($categories)) {
            foreach ($categories as $v) {
                $this->_htmlStr .= '<li>';
                $this->_htmlStr .= str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $v['depth'] - 1) . Html::a($v['name'] . '(' . $v['count'] . ')', ['site/category', 'slug' => $v['slug']], $this->options);
                $this->_htmlStr .= '</li>';

                $category= Category::find()->andWhere(['slug'=>$v['slug']])->one();
                $posts=$category->getPosts()->all();
                foreach ($posts as $post) {
                    $this->_htmlStr .= '<li class="li-overflow-hidden">';
                    $this->_htmlStr .= str_repeat(
                        '&nbsp;&nbsp;&nbsp;&nbsp;', $v['depth']) . Html::a($post['title'],
                            ['post/'.$post['cid']],
                            // $this->options
                            [
                                'style' => [
                                    'color' => 'black',
                                    'font-size' => '14px',
                                ],
                            ]
                        );
                    $this->_htmlStr .= '</li>';
                }
            }
        }
        $this->_htmlStr .= '</ul>';
    }

    /**
     * @return mixed
     */
    public function run()
    {
        return $this->_htmlStr;
    }
}