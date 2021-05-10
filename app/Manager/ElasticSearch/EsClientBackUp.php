<?php
/**
 * ES 连接类
 */

namespace App\Manager\ElasticSearch;

/**
 * Es7
 * Class EsClient
 * @package App\Manager\ElasticSearch
 */
class EsClientBackUp
{
    private $client;
    private $index;
    private $type;

    /*
     * $throw  是否在未知参数时抛出异常
     *
     */

    /**
     * 初始化
     * EsClient constructor.
     * @param string $index 索引 默认test
     * @param string $type 类型 默认_doc
     * 注意如果是忽略es的报错应该增加 'client' => [ 'ignore' => 404 ]
     */
    public function __construct($index = '', $type = '')
    {
        $this->index = $index ?: 'test';
        $this->type = $type ?: '_doc';
        // 获取配置 按层级用点号分隔
        $config = new \EasySwoole\ElasticSearch\Config([
            'host' => env('ELASTICSEARCH_HOST','localhost'),
            'port' => env('ELASTICSEARCH_PORT','9200'),
        ]);

        $elasticsearch = new \EasySwoole\ElasticSearch\ElasticSearch($config);
        if (empty($this->client)) {
            $this->client = $elasticsearch;
        }
    }

    /**
     * @param array $params 插入参数(必填)
     * @param string $id 唯一id(必填)
     */
    public function insert($params = [], $id = '')
    {
        $bean = new \EasySwoole\ElasticSearch\RequestBean\Create();
        $bean->setIndex($this->index);
        //$bean->setType($this->type);
        $bean->setId($id);
        $bean->setBody($params);
        $response = $this->client->client()->create($bean)->getBody();
        $response = json_decode($response, true);
        print_r($response);
    }

    /**
     * 批量插入
     * @param $params
     * $params = [
     * [
     * 'id' => 23,
     * 'name' => '钟琪',
     * 'phone' => 13046252389,
     * ],
     * [
     * 'id' => 24,
     * 'name' => '钟琪1',
     * 'phone' => 13046252388,
     * ],
     * ];
     * @return mixed
     */
    public function bacthInsert($params)
    {
        $bean = new \EasySwoole\ElasticSearch\RequestBean\Bulk();
        $bean->setIndex($this->index);
        //$bean->setType($this->type);

        $body = [];
        foreach ($params as $k => $v) {

            $body[] = [
                'create' => [
                    '_index' => $this->index,
                    '_type' => $this->type,
                    '_id' => $v['id'],
                ],
            ];
            unset($v['id']);
            $body[] = $v;
        }
        //print_r($body);


        $bean->setBody($body);
        $response = $this->client->client()->bulk($bean)->getBody();
        $response = json_decode($response, true);
        return $response;
    }

    /**
     * 删除
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $bean = new \EasySwoole\ElasticSearch\RequestBean\Delete();
        $bean->setIndex($this->index);
        $bean->setId($id);
        $response = $this->client->client()->delete($bean)->getBody();
        $response = json_decode($response, true);
        return $response;
    }

    /**
     * 根据查询删除
     * @param $params
     * $params = ['name'=>'测试删除']
     */
    public function deleteByQuery($params)
    {
        $bean = new \EasySwoole\ElasticSearch\RequestBean\DeleteByQuery();
        $bean->setIndex($this->index);
        $bean->setBody([
            'query' => [
                'match' => $params,
            ],
        ]);
        $response = $this->client->client()->deleteByQuery($bean)->getBody();
        $response = json_decode($response, true);
        return $response;
    }

    /**
     * 根据id修改
     * @param $id 必填
     * @param $params
     * $params = ['test-field' => 'value']
     */
    public function update($id, $params)
    {
        $bean = new \EasySwoole\ElasticSearch\RequestBean\Update();
        $bean->setIndex($this->index);
        //$bean->setType($this->type);
        $bean->setId($id);
        $bean->setBody([
            'doc' => $params,
        ]);
        $response = $this->client->client()->update($bean)->getBody();
        $response = json_decode($response, true);
        return $response;
    }

    /**
     * 根据查询条件修改
     * @param $condition 更新条件
     * $condition = ['id' => '12']
     * @param $updateValue 更新值
     * $updateValue = ['name'=> 666,'phone'=> 13046252389]
     * @return mixed
     */
    public function updateByQuery($condition, $updateValue)
    {

        $bean = new \EasySwoole\ElasticSearch\RequestBean\UpdateByQuery();
        $bean->setIndex($this->index);
        //$bean->setType($this->type);
        foreach ($updateValue as $k => $v) {
            $source[] = 'ctx._source["' . $k . '"]="' . $v . '"';
        }
        $source = implode(';', $source);
        $bean->setBody([
            'query' => [
                'match' => $condition,
            ],
            'script' => [
                'source' => $source,
            ],
        ]);
        $response = $this->client->client()->updateByQuery($bean)->getBody();
        $response = json_decode($response, true);
        return $response;
    }

    /**
     * 根据id查询
     * @param $id
     *  [_index] => item_product
        [_type] => _doc
        [_id] => 1
        [_version] => 5
        [_seq_no] => 7
        [_primary_term] => 1
        [found] => 1 //要根据该字段来判断是否有数据返回
        [_source] => Array
        (
        [server_name] => 钟琪3
        [server_id] => 21
    )
     */
    public function get($id)
    {
        $bean = new \EasySwoole\ElasticSearch\RequestBean\Get();
        $bean->setIndex($this->index);
        //$bean->setType($this->type);
        $bean->setId($id);
        $response = $this->client->client()->get($bean)->getBody();
        return json_decode($response, true);
    }

    /**
     * 根据id数组查询
     * @param $ids
     * @return mixed
     * [docs] => Array
        (
        [0] => Array
            (
            [_index] => item_product
            [_type] => _doc
            [_id] => 1
            [_version] => 5
            [_seq_no] => 7
            [_primary_term] => 1
            [found] => 1 //要根据该字段来判断是否有数据返回
            [_source] => Array
            (
            [server_name] => 钟琪3
            [server_id] => 21
            )

        )

        [1] => Array
            (
            [_index] => item_product
            [_type] => _doc
            [_id] => 18
            [found] =>  //要根据该字段来判断是否有数据返回
        )

    )
     */
    public function mget($ids)
    {
        $bean = new \EasySwoole\ElasticSearch\RequestBean\Mget();
        $bean->setIndex($this->index);
        //$bean->setType($this->type);
        $bean->setBody(['ids' => $ids]);
        $response = $this->client->client()->mget($bean)->getBody();
        return json_decode($response, true);
    }

    //其他查询参考  https://www.easyswoole.com/Cn/Components/Elasticsearch/search.html

    /**
     * 搜索
     * @param array $params
     * @return mixed
     */
    public function search($params = [])
    {
        $bean = new \EasySwoole\ElasticSearch\RequestBean\Search();
        $bean->setIndex($this->index);
        $bean->setType($this->type);
        $bean->setBody([
            'query' => [
                'match' => $params,
            ],
        ]);
        $response = $this->client->client()->search($bean)->getBody();
        return json_decode($response, true);
    }
}
