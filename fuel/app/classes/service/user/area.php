<?php

class Service_User_Area
{

    /**
     * @return array{
     *   array{
     *     area_id: int,
     *     area_name: string,
     *     area_name2: string,
     *     has_shop: int,
     *     ...
     *     area_pref: array {
     *       array{
     *         area_id: int,
     *         has_shop: int
     *               ...
     *       }
     *     }
     *   }
     * }
     */
    public function get_master_and_small_areas(): array
    {
        $areas = [];

        $areas_class_master = Model_Qzin_Area_Main::get_area_by_class(Model_Qzin_Area_Main::AREA_CLASS_MASTER_AREA);
        $area_names = array_column($areas_class_master, 'area_name2');
        $pref_area_ids_has_shop = Model_Qzin_Area_Main::get_pref_area_ids_has_shop();

        foreach (Model_Qzin_Area_Main::MASTER_AREA_SORT as $area_name2) {
            $found_key = array_search($area_name2, $area_names);
            $area_master = $areas_class_master[$found_key];
            $areas_class_pref = Model_Qzin_Area_Main::get_area_by_class_and_master_area_id(Model_Qzin_Area_Main::AREA_CLASS_PREF, $area_master['area_id']);
            $area_master['has_shop'] = 0;
            foreach ($areas_class_pref as &$pref) {
                $has_shop = isset($pref_area_ids_has_shop[(int)$pref['area_id']]);
                $pref['has_shop'] = $has_shop;
                $pref['area_name'] = preg_replace('/(県|都|府)$/u', '', $pref['area_name']);
                if ($has_shop) {
                    $area_master['has_shop'] = $has_shop;
                }
            }
            $area_master['area_pref'] = $areas_class_pref;
            $areas[$area_name2] = $area_master;
        }

        return $areas;
    }

    /**
     * @return array
     */
    public function get_popular_areas(): array
    {
        $areas = [];
        $config_popular_areas = Controller_User_Top::$popular_areas;

        $popular_areas = Model_Qzin_Area_Main::get_popular_areas($config_popular_areas);
        foreach ($popular_areas as $area) {
            $area['url'] = $area['area_name2'] . '/a_' . $area['area_id'];
            $areas[] = $area;
        }
        return $areas;
    }

    /**
     * @param string $area_name2
     * @return array|null
     */
    public function get_pref_area_by_area_name2($area_name2)
    {
        $areas = Model_Qzin_Area_Main::get_pref_area_by_area_name2($area_name2);
        if (!empty($areas)) {
            return $areas[0];
        }
        return null;
    }

    /**
     * @param int $area_id
     * @return array|null
     */
    public function get_area_by_id($area_id)
    {
        $areas = Model_Qzin_Area_Main::get_area_by_area_id($area_id);
        if (!empty($areas)) {
            return $areas[0];
        }
        return null;
    }

    /**
     * @param int $pref_id
     * @return array
     */
    public function get_areas_by_pref_id($pref_id)
    {
        $areas = [];
        $pref_area = $this->get_area_by_id($pref_id);
        $areas_by_pref_id = Model_Qzin_Area_Main::get_area_by_pref_id($pref_id);
        foreach ($areas_by_pref_id as $area) {
            $area['url'] = '/' . $pref_area['area_name2'] . '/a_' . $area['area_id'];
            $areas[] = $area;
        }
        return $areas;
    }

    /**
     * @param int $pref_id
     * @return array{
     *          *   area_id: int,
     *   url: string,
     *   has_shop: int
     *   ...
     * }
     */
    public function get_area_groups_by_pref_id($pref_id)
    {
        $areas = [];
        $pref_area = $this->get_area_by_id($pref_id);
        $areas_by_pref_id = Model_Qzin_Area_Group::get_area_by_pref_id($pref_id);
        $pref_area_ids_has_shop = Model_Qzin_Area_Main::get_area_ids_has_shop_by_pref_id($pref_id);

        foreach ($areas_by_pref_id as $area) {
            $area['url'] = '/' . $pref_area['area_name2'] . '/a_' . $area['area_id'];
            $has_shop = isset($pref_area_ids_has_shop[(int)$area['area_id']]);
            $area['has_shop'] = $has_shop ? $has_shop : 0;
            $areas[] = $area;
        }
        return $areas;
    }

    /**
     * @param mixed $pref_id
     * @return array
     */
    public function get_area2_by_pref_id($pref_id)
    {
        $area2_id_list = Model_Qzin_Area_Main::get_area_by_pref_id($pref_id, 'area_id');
        return $area2_id_list;
    }

    public function get_area_group_name_by_id($area_group_id)
    {
        $area_group_name = Model_Qzin_Area_Group::get_area_group_name_by_id($area_group_id);
        return $area_group_name[0]['area_name'];
    }

    /**
     * @param int $area_id
     *
     * @return int
     */
    public function get_group_area_id_by_area_id(int $area_id): int
    {
        $group_area_id = Model_Qzin_Area_Main::get_group_area_id_by_area_id($area_id);
        return $group_area_id;
    }

    /**
     * @param int $area1_id
     *
     * @return mixed
     */
    public function get_large_area_name_by_area_id(int $area1_id): string
    {
        $large_area_name = Model_Qzin_Area_Main::get_large_area_name_by_area_id($area1_id);
        return $large_area_name;
    }
}
