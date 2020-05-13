<?php
namespace app\admin\controller;

use heephp\validata;

class article extends adminBase
{
    function manager()
    {
        $article= model('article');
        $article->page();
        $article->category();
        $article->create_user();
        $this->assign('list', $article->data);
        $this->assign('pager', $article->pager['show']);
        return $this->fetch();
    }

    function add()
    {
        $category = model('category');
        $category->whereEmpty('parent_id')->select();
        $category->child();
        $this->assign('plist',$category->data);

        return $this->fetch('edit');
    }

    function edit($id)
    {

        $article = model('article');

        $category = model('category');
        $category->whereEmpty('parent_id')->select();
        $category->child();
        $this->assign('plist',$category->data);

        $article->get($id);
        $this->assign('m', $article->data);
        return $this->fetch();

    }

    function delete($id)
    {
        $article = model('article');
        $re = $article->delete($id);
        if ($re) {
            return $this->success('删除成功！', url('manager'));
        } else
            return $this->error('删除失败');
    }

    function save()
    {
        $data = request('post.');//var_dump($data);exit;
        $article = model('article');
        if (!empty($data['article_id'])) {
            $result = $article->update($data);
        } else {
            $data['create_user_id']=request($this->session_id_str);
            $result = $article->insert($data);
        }
        if ($result) {
            return $this->success('保存成功！', url('manager'));
        } else
            return $this->error('保存失败！');
    }


}