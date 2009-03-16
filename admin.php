<?php
if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'admin.php');
require_once(DOKU_INC.'inc/confutils.php');
 
class admin_plugin_confmanager extends DokuWiki_Admin_Plugin {

    var $cnffiles = array('acronyms','entities','interwiki','mime','smileys');

    function getInfo(){
        return array(
            'author' => 'Dominik Eckelmann',
            'email'  => 'dokuwiki@cosmocode.de',
            'date'   => '2009-01-27',
            'name'   => 'configuration file manager',
            'desc'   => 'Plugin to manage variouse .conf files',
            'url'    => 'http://www.dokuwiki.org/plugin:confmanager',
        );
    }

    function getMenuSort() {
        return 101;
    }

    function handle() {
        if (isset($_REQUEST['cnf']) && in_array($_REQUEST['cnf'],$this->cnffiles)) {
			if (isset($_REQUEST['local']))
				$this->_change($_REQUEST['cnf'],$_REQUEST['local']);
			if (isset($_REQUEST['newkey']) && isset($_REQUEST['newval']))
				$this->_add($_REQUEST['newkey'],$_REQUEST['newval']);
        }
    }

    function _change($file,$conf) {
        if (!is_file(DOKU_INC.'conf/'.$file.'.conf')) return;
        $org = confToHash(DOKU_INC.'conf/'.$file.'.conf');
        $cnftext = "";
        foreach ($conf as $k => $v) {
            if ( empty($v) ) {
                // delete a key
                continue;
            }
            if ( ! isset($org[$k]) ) {
                // if no overwrite
                $cnftext.= sprintf("%-30s %s\n",$this->_escape($k),$this->_escape($v));
                continue;
            }
            if ( $org[$k] != $v ) {
                $cnftext.= sprintf("%-30s %s\n",$this->_escape($k),$this->_escape($v));
                continue;
            }
        }
        if (empty($cnftext)) @unlink(DOKU_INC.'conf/'.$file.'.local.conf');
        else file_put_contents(DOKU_INC.'conf/'.$file.'.local.conf',$cnftext);

    }

	function _add($key,$val) {
		if (empty($key) || empty($val)) return;
		$file = $_REQUEST['cnf'];
        $conf = $this->_readConf($file);
        $key = str_replace(' ','',$key);
        $key = str_replace("\t",'',$key);
		$cnftext = "";
		foreach ($conf as $k=>$v) {
			if ($v[1] == 0) continue;
			if ($k != $key) {
				$cnftext.= sprintf("%-30s %s\n",$this->_escape($k),$this->_escape($v[0]));
				continue;
			}
		}
		$cnftext.= sprintf("%-30s %s\n",$this->_escape($key),$this->_escape($val));
		if (empty($cnftext)) @unlink(DOKU_INC.'conf/'.$file.'.local.conf');
        else file_put_contents(DOKU_INC.'conf/'.$file.'.local.conf',$cnftext);
	}

    function html() {
        if (isset($_REQUEST['cnf']) && in_array($_REQUEST['cnf'],$this->cnffiles)) {
            $this->display($_REQUEST['cnf']);
        } else {
            $this->welcome();
        }
        $this->edit();
    }

    function display($name) {
        $data = $this->_readConf($name);
        ptln('<h1>'.$this->getLang('head_'.$name).'</h1>');
        ptln('<p>'.$this->getLang('text_'.$name).'</p>');
        ptln('<p>'.$this->getLang('edit_desc').'</p>');
        ptln('<form method="post" action="doku.php">');
        ptln('<input type="hidden" name="do" value="'.$_REQUEST['do'].'" />');
        ptln('<input type="hidden" name="page" value="'.$_REQUEST['page'].'" />');
        ptln('<input type="hidden" name="id" value="'.$_REQUEST['id'].'" />');
        ptln('<input type="hidden" name="cnf" value="'.hsc($_REQUEST['cnf']).'" />');
        ptln('<table class="confmanager">');
        foreach( $data as $k => $v ) {
            ptln('<tr>');
            ptln('<td>');
            if ($v[1] == 0) ptln('<b>');
            ptln( hsc($k) );
            if ($v[1] == 0) ptln('</b>');
            ptln('</td>');
            ptln('<td>');
            ptln('<input type="text" name="local['.hsc($k).']" value="'.hsc($v[0]).'" class="edit" style="width:400px" /></td>');
            ptln('</tr>');
        }
        ptln('</table>');
        ptln('<input class="button" type="submit" value="'.$this->getLang('submitchanges').'" />');
        ptln('<input class="button" type="reset" value="'.$this->getLang('reset').'" />');
        ptln('</form>');
        ptln('<h2><a name="__add">'.$this->getLang('addvarhead').'</a></h2>');
		ptln('<p>');
		ptln($this->getLang('addvartext'));
		ptln('<form method="post" action="doku.php">');
        ptln('<input type="hidden" name="do" value="'.$_REQUEST['do'].'" />');
        ptln('<input type="hidden" name="page" value="'.$_REQUEST['page'].'" />');
        ptln('<input type="hidden" name="id" value="'.$_REQUEST['id'].'" />');
        ptln('<input type="hidden" name="cnf" value="'.hsc($_REQUEST['cnf']).'" />');
		ptln('<input type="text" name="newkey" class="edit key" /> ');
		ptln('<input type="text" name="newval" class="edit val" />');
		ptln('<input type="submit" value="'.$this->getLang('additem').'" class="button" />');
		ptln('</form>');
		ptln('</p>');
    }

	function _escape($s) {
		return str_replace('#','\#',$s);
	}

    function _readConf($name) {
        if (!is_file(DOKU_INC.'conf/'.$name.'.conf')) return array();
        if (!in_array($name,$this->cnffiles)) return array();
        $result = array();
        $cnf = confToHash(DOKU_INC.'conf/'.$name.'.conf');
        foreach ($cnf as $k => $v) {
            $result[$k] = array($v,0);
        }
        if (!is_file(DOKU_INC.'conf/'.$name.'.local.conf')) return $result;
        $cnf = confToHash(DOKU_INC.'conf/'.$name.'.local.conf');
        foreach ($cnf as $k => $v) {
            $result[$k] = array($v,1);
        }
        return $result;

    }

    function welcome() {
        ptln('<h1>'.$this->getLang('welcomehead').'</h1>');
        ptln('<p>'.$this->getLang('welcome').'</p>');
    }

    function edit() {
        ptln('<h2>'.$this->getLang('edithead').'</h2>');
        ptln('<p>'.$this->getLang('editdesc').'</p>');
        ptln('<form method="post" action="doku.php">');
        ptln('<input type="hidden" name="do" value="'.$_REQUEST['do'].'" />');
        ptln('<input type="hidden" name="page" value="'.$_REQUEST['page'].'" />');
        ptln('<input type="hidden" name="id" value="'.$_REQUEST['id'].'" />');
        ptln('<select name="cnf">');
        foreach ($this->cnffiles as $cnf) {
            ptln('<option value="'.$cnf.'">'.$this->getLang('cnf_'.$cnf).'</option>');
        }
        ptln('</select>');
        ptln('<input type="submit" value="'.$this->getLang('editcnf').'" class="button" />');
        ptln('</form>');
    }
}
?>
