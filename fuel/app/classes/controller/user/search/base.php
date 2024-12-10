<?php

/**
 * ユーザー求人検索ベースページコントローラ
 */
class Controller_User_Search_Base extends Controller_User_Base
{
    protected $region = null;
    protected $prefarea_name = '';
    protected $prefarea = '';
    protected $area_id = '';
    protected $area = null;
    protected $prefareas = null;
    protected $areas = null;
    protected $service_area = null;
    public $throughAfterFunction = true;
    public  $is_detail = false;

    public function before()
    {
        parent::before();
        $this->add_css("user/common/modal.css");
        $this->add_css("user/list.css");
        $this->add_js("user/common/modal.js");
        $this->add_js("user/top.js");
        $this->set_common_header("user/common/header_job");
        $this->set_common_footer("user/common/footer_job", ['is_detail' => $this->is_detail]);

        $this->service_area = new Service_User_Area();
        $this->prefareas = $this->service_area->get_master_and_small_areas();
        $this->prefarea_name = $this->param('prefarea', null);
        $this->prefarea = $this->service_area->get_pref_area_by_area_name2($this->prefarea_name);
        $this->areas = $this->service_area->get_area_groups_by_pref_id($this->prefarea['area_id']);

        $this->area_id = $this->param('area_id', null);
        if ($this->area_id == null) {
            $this->area = $this->prefarea;
            $is_small_area = false;
        } else {
            $this->area = $this->service_area->get_area_by_id($this->area_id);
            if ($this->prefarea['area_id'] != $this->area['master_area3']) {
                throw new HttpNotFoundException();
            }
            $is_small_area = true;
        }

        if ($this->area) {
            $this->region = $this->service_area->get_area_by_id($this->area['master_area_id']);
            if ($is_small_area) {
                $this->area['area_name'] = $this->service_area->get_area_group_name_by_id($this->area['group_area_id'] != 0 ? $this->area['group_area_id'] : $this->area['area_id']);
            }
            $this->area['area_name_rp'] = preg_replace('/(県|都|府)$/u', '', $this->area['area_name']);
        }

        if ($this->prefarea) {
            $prefarea_name = preg_replace('/(県|都|府)$/u', '', $this->prefarea['area_name']);
            $this->prefarea['area_name_rp'] = $prefarea_name;
            $this->pankuzu->add("{$prefarea_name}のメンズエステ求人", Uri::create("/{$this->prefarea_name}/"));
        }
        if ($this->area_id) {
            $pkz_area_id = $this->area['group_area_id'] != 0 ? $this->area['group_area_id'] : $this->area['area_id'];
            $this->pankuzu->add("{$this->area['area_name']}のメンズエステ求人", Uri::create("/{$this->prefarea_name}/a_{$pkz_area_id}/"));
        }
    }

    public function after($response)
    {
        if ($this->throughAfterFunction) {
            $response = parent::after($response);
            $this->template->set_global('area', $this->area);
            $this->template->set_global('areas', $this->areas);
            $this->template->set_global('prefarea', $this->prefarea);
            $this->template->set_global('prefareas', $this->prefareas);
        }

        return $response;
    }
}
