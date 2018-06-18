<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\adminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\News;
use App\Model\Pagemeta;

class newsController extends adminController
{

    public function showList(){
        $pagemeta = Pagemeta::getPagemeta('AD-NS-000');
        $datas = News::getDatas();

        return view('admin.news.list', compact('pagemeta', 'datas'));
    }

    public function create(){
        $pagemeta = Pagemeta::getPagemeta('AD-NS-020');

        return view('admin.news.create', compact('pagemeta'));
    }

    public function insert(Request $request){
        // Validation
        $this->validation($request);
        $this->insertData($request);

        return redirect('admin/news');
    }

    public function edit($news_id){
        $pagemeta = Pagemeta::getPagemeta('AD-NS-050');
        $data = News::getData($news_id);

        return view('admin.news.edit', compact('pagemeta', 'data'));
    }

    public function update(Request $request){
        // Validation
        $this->validation($request);
        $this->updateData($request);

        return redirect('admin/news');
    }

    public function delete($news_id){
        News::where('news_id', $news_id)->delete();

        return redirect('admin/news');
    }

    public function unpublish($news_id){
        $data = News::where('news_id', $news_id)->first();
        if($data->flag_unpublish){
            $flag = null;
        }else{
            $flag = 1;
        }
        News::where('news_id', $news_id)->update([
            'flag_unpublish' => $flag,
        ]);

        return redirect('admin/news');
    }

    public function validation($request){
        $validates = [
            'hide_date_at' => 'required|date',
            'title' => 'required|min:5|max:30',
            'body' => 'required|min:20|max:1000',
            'hide_publish_start_at' => 'sometimes|nullable|date',
            'hide_publish_close_at' => 'sometimes|nullable|date',
        ];

        $this->validate($request, $validates);
    }

    public function insertData($request){
        $now_at = new \Datetime();
        $date_at = new \Datetime($request['hide_date_at']);
        $publish_start_at = ($request['hide_publish_start_at'])? new \Datetime($request['hide_publish_start_at']): null;
        $publish_close_at = ($request['hide_publish_close_at'])? new \Datetime($request['hide_publish_close_at']): null;
        $news_id = News::getNewId();
        News::create([
            'news_id' => $news_id,
            'date_at' => $date_at,
            'title' => $request['title'],
            'body' => $request['body'],
            'publish_start_at' => $publish_start_at,
            'publish_close_at' => $publish_close_at,
            'created_at' => $now_at,
            'updated_at' => $now_at,
        ]);
    }

    public function updateData($request){
        $now_at = new \Datetime();
        $date_at = new \Datetime($request['hide_date_at']);
        $publish_start_at = ($request['hide_publish_start_at'])? new \Datetime($request['hide_publish_start_at']): null;
        $publish_close_at = ($request['hide_publish_close_at'])? new \Datetime($request['hide_publish_close_at']): null;
        News::where('news_id', $request['news_id'])->update([
            'date_at' => $date_at,
            'title' => $request['title'],
            'body' => $request['body'],
            'publish_start_at' => $publish_start_at,
            'publish_close_at' => $publish_close_at,
            'updated_at' => $now_at,
        ]);
    }
}
