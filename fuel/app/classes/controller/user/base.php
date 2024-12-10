<?php

use Fuel\Core\Asset;
use Fuel\Core\Controller_Hybrid;
use Fuel\Core\Request;
use Fuel\Core\Uri;
use Fuel\Core\View;

class Controller_User_Base extends Controller_Hybrid
{
    /** @var string media (PC/SP) */
    protected $media = '';
    /** @var string|View fuel view template */
    public $template = '';
    /** @var array<string> css file list */
    protected $css = [];
    /** @var array<string> js file list */
    protected $js = [];
    /** @var ?View header */
    protected $header = null;
    /** @var ?View footer */
    protected $footer = null;
    /** @var ?Func_Pankuzu pankuzu */
    protected $pankuzu;
    /** @var int $page_response_status */
    private $page_response_status = 200;

    /**
     * メタ
     * @var array{
     *   title: string,
     *   description: string,
     *   keywords: string,
     *   width: string,
     *   noindex: string,
     *   nofollow: string,
     *   canonical: string,
     *   h1: string,
     *   refresh: bool
     * }
     */
    protected $meta = [
        'title' => '',
        'description' => '',
        'keywords' => '',
        'width' => '',
        'noindex' => '',
        'nofollow' => '',
        'canonical' => '',
        'h1'  => '',
        'refresh' => false,
    ];
    /** @var array */
    protected $header_data = [];
    /** @var bool */
    protected $disp_gtm = true;

    public $json_ld   = [];

    protected function set_header(View $view)
    {
        $this->header = $view;
    }

    protected function set_footer(View $view)
    {
        $this->footer = $view;
    }

    protected function set_common_header(string $filePath, array $params = [])
    {
        $this->set_header(View::forge($filePath, $params, false));
    }

    protected function set_common_footer(string $filePath, array $params = [])
    {
        $this->set_footer(View::forge($filePath, $params, false));
    }

    protected function set_page_content(View $view, int $response_status = 200)
    {
        $this->template->content = $view;
        $this->page_response_status = $response_status;
    }

    protected function add_css(string $path)
    {
        $this->css[$path] = $path;
    }

    protected function add_js(string $path)
    {
        $this->js[$path] = $path;
    }

    public function before()
    {
        // 404で入ってきた場合はリダイレクト処理をしない
        $controllername = Request::main()->controller;

        if ($controllername !== 'Controller_User_404') {
            $this->handle_invalid_url();
        }

        // useragent judgment
        if (empty($this->media)) {
            if (Service_Useragent::is_smartphone()) {
                $this->media = CONST_ENV_SP;
            } else {
                $this->media = CONST_ENV_PC;
            }
        }

        $this->pankuzu = new Func_Pankuzu();

        parent::before();

        if ($this->is_restful() === false) {
            $this->template = View::forge("user/common/template");
        }

        // common resources
        $this->add_css("user/common/reset.css");
        $this->add_css("user/common/common.css");
        $this->add_css("user/common/header.css");
        $this->add_css("user/common/footer.css");

        $this->add_js("user/common/jquery-3.7.1.min.js");
        $this->add_js("user/common/common.js");
    }


    public function after($response)
    {

        // set header/footer
        $this->template->set('header', $this->header ?? '');
        $this->template->set('footer', $this->footer ?? '');

        // set css/js tags
        $css_tags = '';
        foreach ($this->css as $css) {
            $css_tags .= Asset::css($css);
        }
        $this->template->set_safe('css', $css_tags, false);
        $js_tags = '';
        foreach ($this->js as $js) {
            $js_tags .= Asset::js($js);
        }
        $this->template->set_safe('js', $js_tags, false);

        // set meta data
        $this->template->set('title', $this->meta['title']);
        $this->template->set('description', $this->meta['description']);
        $this->template->set('keywords', $this->meta['keywords']);
        $this->template->set('width', $this->meta['width']);
        $this->template->set('noindex', $this->meta['noindex']);
        $this->template->set('nofollow', $this->meta['nofollow']);
        $this->template->set('canonical', $this->meta['canonical']);
        $this->template->set('refresh', $this->meta['refresh']);
        $this->template->set_global('h1', $this->meta['h1']);

        // GTM（404 is hide）
        $this->template->set_safe('disp_gtm', $this->disp_gtm);

        $pankuzu = $this->pankuzu->getPankuzuList();
        $this->template->set_global('pankuzu', $pankuzu);

        // JSON-LD
        $this->json_ld['pankuzu'] = $this->pankuzu->getPankuzuList();
        $this->template->json_ld  = View::forge("user/common/jsonld/pankuzu", ['json_ld' => $this->json_ld['pankuzu']], false);

        $datalayer_obj = new Service_User_Datalayer_Detail();
        $this->template->set_global('datalayer_mail_to', $datalayer_obj->create_onmousedown_mailto());

        return parent::after($response ?? Response::forge($this->template, $this->page_response_status));
    }

    /**
     * URLチェック
     * @return void
     */
    private function handle_invalid_url(): void
    {
        $url_str = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $parsed_url = parse_url($url_str);

        /**
         * パスに".html"が含まれている場合は404
         */
        if (strpos($parsed_url['path'] ?? '','.html') !== false) {
            throw new HttpNotFoundException;
        }

        /**
         * パスに連続した"/"が含まれている場合は404
         */
        if (preg_match('/\/{2,}/', $parsed_url['path'] ?? '') === 1) {
            throw new HttpNotFoundException;
        }

        /**
         * パスの末尾に"/"が無い場合、"/"が含まれるURIに301リダイレクト
         */
        if (isset($parsed_url['path']) && $parsed_url['path'][-1] !== "/") {
            $parsed_url['path'] .= '/';
            $redirect_url = http_build_url($parsed_url);

            Response::redirect($redirect_url, 'location', 301);
        }
    }
}
