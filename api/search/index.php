<?php
class search_api
{
    const URL_ROOT = 'http://127.0.0.1:9200/official_website_sdcs/_search';
    const CHARSET = 'UTF-8';
    /**GET*/
    private $msGets = '';
    /**POST*/
    //private $maGetPostData = array();
    function __construct()
    {
        $query_str = $this->getGET();
        if($this->msGets != '')
        {
            if(count($this->msGets) > 0)
                $sUrl = self::URL_ROOT .'?'. $this->msGets;
            else
                $sUrl = self::URL_ROOT;
            echo $this->getContent($sUrl, $query_str);
        }
        else
        {
            echo $this->getContent(self::URL_ROOT, $query_str);
        }
    }

    function __destruct()
    {
        unset($msGets);
    }

    /*
     * 载入GET数
     * */
    private function getGET()
    {
        /*取得GET内容*/
        // from: ((currentPage -1) * itemsPerPage) + 1,
        // to: currentPage  * itemsPerPage
		$search_category = $_POST['cate'];
        $search_keywords = $_POST['q'];
        $pager = $_POST['pager'];
        $from = (($pager - 1) * 10) + 1 ;
        if ($pager == 1) $from = 0;
        $query_string = array(
            'from' => $from,
            'size'  => 10,
            'query' => array(
                    "function_score" => array(
                        'query' => array(
                            "bool"=> array(
                                "must"=> [
                                    array(
                                        'multi_match' => array(
                                            'query' => $search_keywords,
                                            'type' => 'best_fields',
                                            "minimum_should_match" => "80%",
                                            'fields' => array(
                                                'title^2',
                                                'content',
                                                'category'
                                            ),
                                            "fuzziness" => "AUTO"
                                        )
                                        ),
                                        array(
                                            'match' => array(
                                                'category' => array(
                                                    'query'=> $search_category,
                                                    'operator'=> 'and'
                                                )
                                            )
                                        )
                                ]
                            )
                        )
                    )
                ),
            'highlight' => array(
                'fields' => array(
                    'title' => (object)[],
                    'body'  => (object)[]
                )
            )
        );

        return $query_string;
    }

    /*
     * 读取远程接口返回的内
     * @return strin
     * */
    private function getContent($sGetUrl, $queryStr)
    {
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $sGetUrl); //设置GET的URL地址
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);//将结果保存成字符串
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 10);//连接超时时间s
        curl_setopt ($ch, CURLOPT_TIMEOUT, 10);//执行超时时间s
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper('POST'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($queryStr));
        $sData = curl_exec($ch);
        curl_close($ch);
        // unset($ch);
        return $sData;
    }
}

$o = new search_api();
// unset($o);
