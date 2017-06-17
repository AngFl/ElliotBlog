<?php

namespace App\Http\Controllers;

use App\Services\ResumeService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Markdown\Markdown;

use Illuminate\Support\Facades\Redis;
use Session;

class AboutController extends Controller
{
    /**
     * 使用MarkDown Parser 格式文本数据
     * @var Markdown
     */
    protected $markdownParser;
    

    public function __construct(Markdown $markdownParser)
    {
        $this->markdownParser = $markdownParser;
    }

    public function about(ResumeService $resume)
    {
        $profile = $resume->getResume();

        $html = $this->markdownParser->markdown($profile);
        return view('about.me', compact('html'));
    }

    
}
