<?php
namespace app\admin\controller;

use heephp\validata;

class article extends adminBase
{
    function manager($field='create_time',$order='desc')
    {
        $article= model('article');
        $article->order("$field $order")->page();
        $article->category();
        $article->create_user();
        $this->assign('list', $article->data);
        $this->assign('pager', $article->pager['show']);

        $this->assign('field',$field);
        $this->assign('order',$order);
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

        $article->get($id);//var_dump($article->data);
        $this->assign('m', $article->data);
        return $this->fetch();

    }

    function recommend($id){
        $article = table('article');
        $m=$article->get($id);
        $recommend=$m['recommend']==0?1:0;
        $article->update(['recommend'=>$recommend,'article_id'=>$id]);
        return $this->rediect('manager');
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
        $data['keyword']=implode(',',$data['keyword']);
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