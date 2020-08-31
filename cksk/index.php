<?php
class cksk_relay
{
    const URL_ROOT = 'https://beian.qingcloud.com/cksk';
    const CHARSET = 'UTF-8';
    /**GET*/
    private $msGets = '';
    /**POST*/
    //private $maGetPostData = array();
    function __construct()
    {
        $this->getGET();
        if($this->msGets != '')
        {
            if(count($this->msGets) > 0)
                $sUrl = self::URL_ROOT .'?'. $this->msGets;
            else
                $sUrl = self::URL_ROOT;
            header('Content-Type: text/html; charset='. self::CHARSET);
            echo $this->getContent($sUrl);
        }
        else
        {
            header('Content-Type: text/html; charset='. self::CHARSET);
            echo $this->getContent(self::URL_ROOT);
        }
    }

    function __destruct()
    {
        unset($msGets);
    }

    /*
     * 载入GET数
     * @return boo
     * */
    private function getGET()
    {
        /*取得GET内容*/
        if (count($_GET) > 0)
        {
            $aTmp = array();
            foreach ($_GET as $sKey => $sVal)
                $aTmp[] = $sKey .'='. urlencode($sVal);
            $this->msGets = implode('&', $aTmp);
            return true;
        }
        else
            return false;
    }

    /*
     * 读取远程接口返回的内
     * @return strin
     * */
    private function getContent($sGetUrl)
    {
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $sGetUrl); //设置GET的URL地址
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);//将结果保存成字符串
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 10);//连接超时时间s
        curl_setopt ($ch, CURLOPT_TIMEOUT, 10);//执行超时时间s
        curl_setopt ($ch, CURLOPT_DNS_CACHE_TIMEOUT, 1800);//DNS解析缓存保存时间半小时
        if (isset($_COOKIE['sk'])) {
            curl_setopt($ch, CURLOPT_COOKIE,'sk='.$_COOKIE['sk']);
        }
        curl_setopt($ch, CURLOPT_HEADER,0);//丢掉头信息
        $sData = curl_exec($ch);
        curl_close($ch);
        // unset($ch);
        return $sData;
    }
}

$o = new cksk_relay();
// unset($o);
