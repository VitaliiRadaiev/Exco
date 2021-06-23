<?php

if (!defined('SEOSHIELD_ROOT_PATH')) {
    define('SEOSHIELD_ROOT_PATH', rtrim(realpath(dirname(__FILE__)), '/'));
}

class SeoShieldModule_links_block extends seoShieldModule
{
    public $links_block_csv = '';

    public function html_out_buffer($out_html)
    {
        if (function_exists('http_response_code')) {
            $response_code = http_response_code();
            if (404 == $response_code) {
                return $out_html;
            }
        }
        if ('POST' == $_SERVER['REQUEST_METHOD']
            || (isset($GLOBALS['SEOSHIELD_CONFIG']['html_comment_to_replace'])
                && false === strpos($out_html, $GLOBALS['SEOSHIELD_CONFIG']['html_comment_to_replace']))
            || !isset($GLOBALS['SEOSHIELD_CONFIG']['mysql'])
            || !$GLOBALS['SEOSHIELD_CONFIG']['mysql'] instanceof \seoShieldDb ) {
            return $out_html;
        }

        $this->links_block_csv = SEOSHIELD_ROOT_PATH.'/data/links_block.csv';

        $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_query("CREATE TABLE IF NOT EXISTS `links_block` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`url` varchar(255) NOT NULL,
			`ancor` varchar(255) NOT NULL,
			`shows` int(11) DEFAULT '0',
			PRIMARY KEY (`id`),
			UNIQUE KEY `id` (`id`),
			KEY `url` (`url`),
			KEY `ancor` (`ancor`),
			KEY `shows` (`shows`)
		) CHARACTER SET utf8 COLLATE utf8_general_ci");

        $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_query('CREATE TABLE IF NOT EXISTS `links_block_pages` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`url` varchar(255) NOT NULL,
			`date_add` int(11) NOT NULL,
			`selected_links` text NOT NULL,
			PRIMARY KEY (`id`),
			UNIQUE KEY `id` (`id`),
			KEY `url` (`url`)
		) CHARACTER SET utf8 COLLATE utf8_general_ci');

        if (file_exists($this->links_block_csv)
            && is_readable($this->links_block_csv)) {
            if ('' == $GLOBALS['SEOSHIELD_CONFIG']['links_block_csv_update_time']
                || $GLOBALS['SEOSHIELD_CONFIG']['links_block_csv_update_time'] < filemtime($this->links_block_csv)) {
                $this->links_sync();
                $this->csv_time_rewrite();
            }
        }

        if (isset($GLOBALS['SEOSHIELD_CONFIG']['is_group_by_supported']) && $GLOBALS['SEOSHIELD_CONFIG']['is_group_by_supported']){
            $links_block_template = $this->links_block();
        } else {
            $links_block_template = $this->links_block_without_grop_by();
        }
        if (!empty($GLOBALS['SEOSHIELD_CONFIG']['html_comment_to_replace']) && !empty($links_block_template)
            && false !== $links_block_template && false !== strpos($links_block_template, 'href=')) {
            $out_html = str_replace($GLOBALS['SEOSHIELD_CONFIG']['html_comment_to_replace'], $links_block_template, $out_html);
        }

        return $out_html;
    }

    public function links_block_template($selected_links)
    {
        if (!isset($GLOBALS['SEOSHIELD_CONFIG']['links_block_template'])) {
            $GLOBALS['SEOSHIELD_CONFIG']['links_block_template'] = [
                'before_ul' => '<div class="links_block"><ul>',
                'after_ul' => '</ul></div>',
                'before_li' => '<li>',
                'after_li' => '</li>',
            ];
        }

        $links_block_template = $GLOBALS['SEOSHIELD_CONFIG']['links_block_template']['before_ul'];
        foreach ($selected_links as $i => $s) {
            $anchor = $s['ancor'];
            if (false === strpos($GLOBALS['SEOSHIELD_CONFIG']['site_default_encoding'], 'utf')
            && function_exists('iconv')) {
                $anchor = iconv('utf-8', $GLOBALS['SEOSHIELD_CONFIG']['site_default_encoding'].'//IGNORE', $s['ancor']);
            }
            $links_block_template .= $GLOBALS['SEOSHIELD_CONFIG']['links_block_template']['before_li'].
                '<a href="'.$s['url'].'#'.$s['id'].'-'.$i.'">'.$anchor.'</a>'.$GLOBALS['SEOSHIELD_CONFIG']['links_block_template']['after_li'];
        }
        $links_block_template .= $GLOBALS['SEOSHIELD_CONFIG']['links_block_template']['after_ul'];

        return $links_block_template;
    }

    public function links_block()
    {
        // выбираем id ссылок
        $selected_ids = $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_query("SELECT `selected_links` FROM `links_block_pages` WHERE url='".$GLOBALS['SEOSHIELD_CONFIG']['page_uri']."'");

        if (0 == $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_num_rows($selected_ids)) {
            if (empty($GLOBALS['SEOSHIELD_CONFIG']['links_count'])) {
                $GLOBALS['SEOSHIELD_CONFIG']['links_count'] = '4';
            }

            $links_ids = $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_query("SELECT `id` FROM `links_block` WHERE `shows`=0 AND `url`<>'".$GLOBALS['SEOSHIELD_CONFIG']['page_uri']."' GROUP BY `url` LIMIT ".$GLOBALS['SEOSHIELD_CONFIG']['links_count']);

            if (0 == $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_num_rows($links_ids)) {
                return false;
            }

            $selected_ids = [];
            while ($res = $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_fetch_array($links_ids)) {
                $selected_ids[] = $res['id'];
            }

            $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_query("INSERT INTO `links_block_pages` (url,date_add,selected_links) VALUES ('".$GLOBALS['SEOSHIELD_CONFIG']['page_uri']."','".time()."','".implode(',', $selected_ids)."')");
            $selected_ids = implode(',', $selected_ids);
            $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_query('UPDATE `links_block` SET `shows`=1 WHERE id IN ('.$selected_ids.')');
        } else {
            $selected_ids = $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_fetch_array($selected_ids);
            $selected_ids = $selected_ids[0];
        }

        if (!empty($selected_ids)) {
            $result = $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_query('SELECT id,url,ancor FROM `links_block` WHERE id IN ('.$selected_ids.')');
            $selected_links = [];
            while ($row = $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_fetch_array($result)) {
                $selected_links[] = $row;
            }

            return $this->links_block_template($selected_links);
        }
    }

    public function links_block_without_grop_by()
    {
        // выбираем id ссылок
        $selected_ids = $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_query("SELECT `selected_links` FROM `links_block_pages` WHERE url='".$GLOBALS['SEOSHIELD_CONFIG']['page_uri']."'");

        if (0 == $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_num_rows($selected_ids)) {
            if (empty($GLOBALS['SEOSHIELD_CONFIG']['links_count'])) {
                $GLOBALS['SEOSHIELD_CONFIG']['links_count'] = '4';
            }

            $linksUrls =$GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_query("SELECT distinct `url` FROM `links_block` WHERE `shows`=0 AND `url`<>'".$GLOBALS['SEOSHIELD_CONFIG']['page_uri']."'LIMIT ".$GLOBALS['SEOSHIELD_CONFIG']['links_count']);
            if (0 == $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_num_rows($linksUrls)) {
                return false;
            }
            $foundUrls = [];
            $links_ids_to_find = [];
            while ($res = $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_fetch_array($linksUrls)) {
                $foundUrls[] = $res['url'];
                $links_ids_request = $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_query("SELECT `id` FROM `links_block` WHERE `shows`=0 AND `url` = '".$res['url']."' LIMIT 1");
                $links_ids_to_find[] = $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_fetch_array($links_ids_request)['id'];
            }

            $links_ids = $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_query("SELECT `id` FROM `links_block` WHERE `shows`=0 AND `id` IN (".implode(', ', $links_ids_to_find).")");


            if (0 == $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_num_rows($links_ids)) {
                return false;
            }

            $selected_ids = [];
            while ($res = $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_fetch_array($links_ids)) {
                $selected_ids[] = $res['id'];
            }

            $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_query("INSERT INTO `links_block_pages` (url,date_add,selected_links) VALUES ('".$GLOBALS['SEOSHIELD_CONFIG']['page_uri']."','".time()."','".implode(',', $selected_ids)."')");
            $selected_ids = implode(',', $selected_ids);
            $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_query('UPDATE `links_block` SET `shows`=1 WHERE id IN ('.$selected_ids.')');
        } else {
            $selected_ids = $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_fetch_array($selected_ids);
            $selected_ids = $selected_ids[0];
        }

        if (!empty($selected_ids)) {
            $result = $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_query('SELECT id,url,ancor FROM `links_block` WHERE id IN ('.$selected_ids.')');
            $selected_links = [];
            while ($row = $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_fetch_array($result)) {
                $selected_links[] = $row;
            }

            return $this->links_block_template($selected_links);
        }
    }

    public function csv_time_rewrite()
    {
        $config_file = file_get_contents(SEOSHIELD_ROOT_PATH.'/configs/links_block.php');
        $config_file = str_replace(['<?php', '?>'], '', str_replace("\$GLOBALS['SEOSHIELD_CONFIG']", '$tmp_global', $config_file));
        eval($config_file);
        foreach ($tmp_global as $t => $v) {
            if ('links_block_csv_update_time' == $t) {
                $tmp_global[$t] = filemtime($this->links_block_csv);
            }
        }
        $new_config_file = "<?php\r\n";
        foreach ($tmp_global as $t => $v) {
            if (is_array($v)) {
                $value = "array(\n";
                foreach ($v as $v_key => $v_value) {
                    $value .= "\t'".$v_key."' => '".$v_value."',\n";
                }
                $value .= ')';
            } else {
                $value = '"'.$v.'"';
            }
            $new_config_file .= "\$GLOBALS['SEOSHIELD_CONFIG']['".$t."']".'='.$value.";\r\n";
        }
        file_put_contents(SEOSHIELD_ROOT_PATH.'/configs/links_block.php', $new_config_file, LOCK_EX);
    }

    public function links_sync()
    {
        $links_data = $this->csv2array($this->links_block_csv);
        $links_block_result = $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_query('SELECT url,ancor FROM `links_block`');

        if (0 == $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_num_rows($links_block_result)) {
            $data_to_insert = [];
            foreach ($links_data as $l) {
                $url = preg_replace('#^https?://[^/]+#is', '', trim($l[1]));
                $anchor = $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_escape_string_s($l[0]);
                if ('' == $url) {
                    $url = '/';
                }
                $data_to_insert[] = "('".$url."','".$anchor."')";
            }
            $data_to_insert = implode(', ', $data_to_insert);

            $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_query('INSERT INTO `links_block` (url,ancor) VALUES '.$data_to_insert);
        } else {
            $links_block_db = [];
            while ($res = $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_fetch_array($links_block_result)) {
                $links_block_db[] = $res;
            }

            $links_data_diff = [];
            foreach ($links_data as $l => $v) {
                $url = preg_replace('#^https?://[^/]+#is', '', trim($v[1]));
                if ('' == $url) {
                    $url = '/';
                }
                $links_data_diff[] = $v[0].';'.$url;
            }

            $links_block_db_diff = [];
            foreach ($links_block_db as $l => $v) {
                $links_block_db_diff[] = $v[1].';'.$v[0];
            }

            // удаляем из базы записи которые отсутствуют в csv
            $array_diff = array_diff($links_block_db_diff, $links_data_diff);
            if (sizeof($array_diff) > 0) {
                $data_to_del = [];
                foreach ($array_diff as $a) {
                    $a = explode(';', $a);
                    $data_to_del[] = "(`ancor`='".$a[0]."' && `url`='".$a[1]."')";
                }
                $data_to_del = implode(' || ', $data_to_del);
                $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_query('DELETE FROM `links_block` WHERE '.$data_to_del);
            }

            // записываем в базу новые записи из csv
            $array_diff = array_diff($links_data_diff, $links_block_db_diff);
            if (sizeof($array_diff) > 0) {
                $data_to_insert = [];
                foreach ($array_diff as $a) {
                    $a = explode(';', $a);
                    $url = $a[1];
                    $anchor = $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_escape_string_s($a[0]);
                    $data_to_insert[] = "('".$url."','".$anchor."')";
                }
                $data_to_insert = implode(', ', $data_to_insert);
                $GLOBALS['SEOSHIELD_CONFIG']['mysql']->mysql_query('INSERT INTO `links_block` (url,ancor) VALUES '.$data_to_insert);
            }
        }
    }
}
