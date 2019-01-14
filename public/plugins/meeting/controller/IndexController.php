<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace plugins\meeting\controller; //Demo插件英文名，改成你的插件英文就行了
use cmf\controller\PluginBaseController;
use think\Db;
use plugins\meeting\model\PortalPostModel;
use plugins\meeting\model\MeetingModel;

class IndexController extends PluginBaseController
{

    function test()
    {
            $meeting       = new MeetingModel();
            $meeting->AddMeeting();
        return $this->fetch("/test");
    }

    function meeting()
    {
            $meeting       = new MeetingModel();
            $data = $meeting->getMeeting();
            $this->assign('meeting', $data);
            return $this->fetch("/meeting");
    }

    function add()
    {
          $content = hook_one('portal_admin_article_add_view');

            if (!empty($content)) {
                return $content;
            }

            $themeModel        = new \app\admin\model\ThemeModel();
            $articleThemeFiles = $themeModel->getActionThemeFiles('portal/Article/index');
            $this->assign('article_theme_files', $articleThemeFiles);


        return $this->fetch("/add");
    }

public function select()
    {
        $ids                 = $this->request->param('ids');
        $selectedIds         = explode(',', $ids);
        $portalCategoryModel = new \app\portal\model\PortalCategoryModel();

        $tpl = <<<tpl
<tr class='data-item-tr'>
    <td>
        <input type='checkbox' class='js-check' data-yid='js-check-y' data-xid='js-check-x' name='ids[]'
               value='\$id' data-name='\$name' \$checked>
    </td>
    <td>\$id</td>
    <td>\$spacer <a href='\$url' target='_blank'>\$name</a></td>
</tr>
tpl;

        $categoryTree = $portalCategoryModel->adminCategoryTableTree($selectedIds, $tpl);

        $categories = $portalCategoryModel->where('delete_time', 0)->select();

        $this->assign('categories', $categories);
        $this->assign('selectedIds', $selectedIds);
        $this->assign('categories_tree', $categoryTree);
        return $this->fetch("/public/select");
    }

    public function addPost()
        {
            if ($this->request->isPost()) {
                $data = $this->request->param();

                //状态只能设置默认值。未发布、未置顶、未推荐
                $data['post']['post_status'] = 1;
                $data['post']['is_top']      = 0;
                $data['post']['recommended'] = 0;

                $post = $data['post'];

                $result = $this->validate($post, 'Article');
                if ($result !== true) {
                    $this->error($result);
                }

                $portalPostModel = new PortalPostModel();

                if (!empty($data['photo_names']) && !empty($data['photo_urls'])) {
                    $data['post']['more']['photos'] = [];
                    foreach ($data['photo_urls'] as $key => $url) {
                        $photoUrl = cmf_asset_relative_url($url);
                        array_push($data['post']['more']['photos'], ["url" => $photoUrl, "name" => $data['photo_names'][$key]]);
                    }
                }

                if (!empty($data['file_names']) && !empty($data['file_urls'])) {
                    $data['post']['more']['files'] = [];
                    foreach ($data['file_urls'] as $key => $url) {
                        $fileUrl = cmf_asset_relative_url($url);
                        array_push($data['post']['more']['files'], ["url" => $fileUrl, "name" => $data['file_names'][$key]]);
                    }
                }


                $portalPostModel->AddArticle($data['post'], $data['post']['categories']);

                $data['post']['id'] = $portalPostModel->id;
                $hookParam          = [
                    'is_add'  => true,
                    'article' => $data['post']
                ];
                hook('portal_admin_after_save_article', $hookParam);


                $this->success('添加成功!', url('Meeting/add'));
            }

        }

}
