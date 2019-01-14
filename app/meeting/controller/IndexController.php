<?php

namespace app\meeting\controller;

use cmf\controller\AdminBaseController;
use app\meeting\Model\MeetingModel;
use app\meeting\Model\MeetingCheckinModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;


class IndexController extends AdminBaseController
{
    public function index()
    {
        $data       = new MeetingModel();
        $meeting = $data->getMeeting();
        $this->assign("meeting", $meeting);
        return $this->fetch("index");
    }

    function detail()
    {
        $id = $this->request->param('id');
        $this->assign("id",$id);
        $meetingData       = new MeetingModel();
        $meeting = $meetingData->where('id','=',$id)->select();
        $this->assign("meeting",$meeting[0]);

        $data = new MeetingCheckinModel();
        $obj = $data->where('meetingId', '=', $id)->select();
        $this->assign("obj",$obj);

        return $this->fetch("detail");

    }

    function add()
    {
        $themeModel        = new \app\admin\model\ThemeModel();
        $articleThemeFiles = $themeModel->getActionThemeFiles('portal/Article/index');
        $this->assign('article_theme_files', $articleThemeFiles);
        return $this->fetch("add");
    }

    public function addPost()
        {

            if ($this->request->isPost()) {
                $data = $this->request->param();
                $post = $data['post'];
                $meetingPost       = new MeetingModel();
                $meetingPost->AddMeeting($data['post']);
                $this->success('添加成功!', url('Index/index'));



            }

//
//            if ($this->request->isPost()) {
//                $data = $this->request->param();
//
//                //状态只能设置默认值。未发布、未置顶、未推荐
//                $data['post']['post_status'] = 1;
//                $data['post']['is_top']      = 0;
//                $data['post']['recommended'] = 0;
//
//                $post = $data['post'];
//
//                $portalPostModel = new PortalPostModel();
//
//                if (!empty($data['photo_names']) && !empty($data['photo_urls'])) {
//                    $data['post']['more']['photos'] = [];
//                    foreach ($data['photo_urls'] as $key => $url) {
//                        $photoUrl = cmf_asset_relative_url($url);
//                        array_push($data['post']['more']['photos'], ["url" => $photoUrl, "name" => $data['photo_names'][$key]]);
//                    }
//                }
//
//                if (!empty($data['file_names']) && !empty($data['file_urls'])) {
//                    $data['post']['more']['files'] = [];
//                    foreach ($data['file_urls'] as $key => $url) {
//                        $fileUrl = cmf_asset_relative_url($url);
//                        array_push($data['post']['more']['files'], ["url" => $fileUrl, "name" => $data['file_names'][$key]]);
//                    }
//                }
//
//
//                $portalPostModel->AddArticle($data['post'], $data['post']['categories']);
//
//                $data['post']['id'] = $portalPostModel->id;
//                $hookParam          = [
//                    'is_add'  => true,
//                    'article' => $data['post']
//                ];
//                hook('portal_admin_after_save_article', $hookParam);
//
//
//                $this->success('添加成功!', url('Meeting/index/index'));
//            }

        }

        public function download(){
            $id = $this->request->param('id');
            $data = new MeetingCheckinModel();
            $json = $data->where('meetingId', '=', $id)->select();

            ini_set("memory_limit", "-1");
            $spreadsheet = new Spreadsheet();
            $sheet       = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'ID');
            $sheet->setCellValue('B1', '姓名');
            $sheet->setCellValue('C1', '用户ID');
            $sheet->setCellValue('D1', '时间');
            $sheet->setCellValue('E1', '会议ID');
            $i     = 1;
            foreach ($json as $data) {
                $i++;
                $sheet->setCellValue('A' . $i, $data['Id']);
                $sheet->setCellValue('B' . $i, $data['user']);
                $sheet->setCellValue('C' . $i, $data['userId']);
                $sheet->setCellValue('D' . $i, $data['time']);
                $sheet->setCellValue('E' . $i, $data['meetingId']);
            }

            $filename = '会议签到表.xlsx';
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');

        }

}
