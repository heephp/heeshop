<?php
namespace app\admin\controller;

use heephp\validata;

class article extends adminBase
{
    function manager($categoryid,$field='create_time',$order='desc')
    {
        $article= model('article');
        $article->where("category_id=$categoryid")->order("recommend desc,$field $order")->page();
        $article->category();
        $article->create_user();
        $this->assign('list', $article->data);
        $this->assign('pager', $article->pager['show']);

        $this->assign('field',$field);
        $this->assign('order',$order);
        $this->assign('categoryid',$categoryid);
        $this->assign('category_name',model('category')->where("category_id=$categoryid")->getByname());
        return $this->fetch();
    }

    function add($categoryid)
    {
        $category = model('category');
        $category->whereEmpty('parent_id')->select();
        $category->child();
        $this->assign('plist',$category->data);
        $this->assign('categoryid',$categoryid);
        $this->assign('category_name',model('category')->where('category_id='.$categoryid)->getByname());

        return $this->fetch('edit');
    }

    function edit($id)
    {

        $article = model('article');

        $category = model('category');
        $category->whereEmpty('parent_id')->select();
        $category->child();
        $this->assign('plist',$category->data);

        $m=$article->get($id);//var_dump($article->data);
        $this->assign('m', $m);
        $this->assign('categoryid',$m['category_id']);
        $this->assign('category_name',model('category')->where('category_id='.$m['category_id'])->getByname());
        return $this->fetch();

    }

    function recommend($id){
        $article = table('article');
        $m=$article->get($id);
        $recommend=$m['recommend']==0?1:0;
        $article->update(['recommend'=>$recommend,'article_id'=>$id]);
        return $this->redirect('manager',$m['category_id']);
    }

    function delete($id)
    {
        $article = model('article');
        $m = $article->get($id);
        $re = $article->delete($id);
        if ($re) {
            return $this->success('删除成功！', url('manager',$m['category_id']));
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
            $data['create_users_id']=request($this->session_id_str);
            $result = $article->insert($data);
        }
        if ($result) {
            return $this->success('保存成功！', url('manager',$data['category_id']));
        } else
            return $this->error('保存失败！');
    }


}