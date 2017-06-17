<?php
/**
 *
 */

namespace App\Repositories;


use App\Detail;

class DetailRepository
{
    public $detail;

    /**
     * DetailRepository constructor.
     * @param $detail
     */
    public function __construct(Detail $detail)
    {
        $this->detail = $detail;
    }

    /**
     *  根据文章的标题和内容模糊查询
     * @param $keyword
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function withKeywordsInContent($keyword)
    {
        // 模糊的文章数据
        $detailSearchRes = $this->detail
            ->select(['title','content'])
            ->where('title','like','%'.$keyword.'%')
            ->orWhere('content','like','%'.$keyword.'%')
            ->paginate(4);

        return $detailSearchRes;
    }

    /**
     *  查询相关类别的文章标题和作者
     * @param $note
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function withRelativeContent($note, $id)
    {
        return $this->detail
            ->where('note',$note)
            ->where('id','<>',$id)
            ->get(['title','author','id']);
    }

    /**
     *  依据ID 查询相关文章和作者
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function withIdRelatedAuthor($id)
    {
        return $this->detail->where('id',$id)->first(['id',
            'title','content','author','user_id']);
    }

}