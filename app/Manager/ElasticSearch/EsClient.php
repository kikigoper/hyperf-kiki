<?php
/**
 * ES 连接类
 */

namespace App\Manager\ElasticSearch;

use Hyperf\Contract\ContainerInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Elasticsearch\ClientBuilderFactory;

use Hyperf\Utils\ApplicationContext;

/**
 * Es7
 * Class EsClient
 * @package App\Manager\ElasticSearch
 */
class EsClient
{
    private $esClient;
    private $index;
    private $type;

    /**
     * @Inject()
     * @var ContainerInterface
     */
    protected $container;

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
        $this->container = ApplicationContext::getContainer();
        $clientBuilder = $this->container->get(ClientBuilderFactory::class);
        $builder = $clientBuilder->create();
        $host = explode(',', config('es_host'));
        $this->esClient = $builder->setHosts($host)->build();
    }


    /**
     * 判断索引是否存在
     **/

    public function indexExistsEs()
    {
        $params = [
            'index' => $this->index,
        ];

        $result = $this->esClient->indices()->exists($params);

        return $result;
    }


    /**
     * 创建索引
     **/

    public function createIndex()
    {
        $params = [
            'index' => $this->index,
        ];

        $result = $this->esClient->indices()->create($params);

        return $result;
    }

    /**
     * 设置mapping
     **/

    public function putMapping($params)
    {
        extract($params);

        $mapping['index'] = $this->index;

        $mapping['type'] = $this->type;

        $field_type['keyword'] = [
            'type' => 'keyword',
        ];

        $field_type['text'] = [
            'type' => 'text',
            'analyzer' => 'ik_max_word',
            'search_analyzer' => 'ik_max_word',
        ];

        $data = [

            'properties' => value(function () use ($mapping_key, $field_type) {
                $properties = [];

                foreach ($mapping_key as $key => $value) {
                    if (empty($value)) {
                        continue;

                    }

                    foreach ($value as $cvalue) {
                        $properties[$cvalue] = $field_type[$key];

                    }

                }

                return $properties;

            })

        ];

        $mapping['body'] = $data;

        return $this->esClient->indices()->putMapping($mapping);
    }


    /**
     * 判断文档是否存在
     **/
    public function existsEs($params)
    {
        return $this->esClient->exists($params);

    }

    /**
     * 创建文档
     **/

    public function indexEs($params = [], $id = '')
    {
//        extract($params);

        $index_data = [

            'index' => $this->index,

            'type' => $this->type,

            'id' => $id,

            'body' => $params,

        ];

        return $this->esClient->index($index_data);
    }

    /**
     * 修改文档
     **/

    public function updateEs($params,$id = '')
    {
//        extract($params);

        $update_data = [

            'index' => $this->index,

            'type' => $this->type,

            'id' => $id,

            'body' => [

                'doc' => $params,

            ],

        ];

        return $this->esClient->update($update_data);
    }


    /**
     * 修改文档
     **/

    public function deleteEs($params,$id = '')
    {
        extract($params);

        $delete_data = [

            'index' => $this->index,

            'type' => $this->type,

            'id' => $id,

        ];

        return $this->esClient->delete($delete_data);
    }


    /**
     * 查询数据
     * 请求参数实例：
     * $es_params['data']: 详细数据 键值对形式
     * $es_params['condition']['must_field']: es bool查询must对应字段 ['terms_field'=>['id','pid'],'range_field'=>['ctime','age']] 等
     * $es_params['condition']['should_field']: es bool查询should对应字段 ['terms_field'=>['id','pid'],'range_field'=>['ctime','age']] 等
     * $es_params['source_field']: es 查询需要获取的字段
     * $es_params['field_alias']:  查询字段别名 例如 'field'=>[{'a'=>'123'}] 查询时候拼接 field.a=*
     */

    public function searchEs($es_params)
    {
        extract($es_params);

        if (!isset($field_alias)) {
            $field_alias = [];

        }

        $offset = $data['offset'] ?? 0;

        $limit = $data['limit'] ?? 50;

        $order_field = $data['order_field'] ?? 'id';

        $order_type = $data['order_type'] ?? 'desc';

        if (!in_array($order_type, ['asc', 'desc'])) {
            $order_type = 'desc';

        }

        //初始化查询body

        $body = ['from' => $offset, 'size' => $limit, 'sort' => [$order_field => $order_type]];

        //获取bool查询条件

        $bool = $this->_getQueryInfo($data, $condition, $field_alias);

        if (!empty($bool)) {
            $body['query'] = ['bool' => $bool];

        }

        $source_field = $data['source_field'] ?? '';

        if (!empty($source_field)) {
            $body['_source'] = explode(',', $source_field);

        }


        $params = [

            'index' => $this->index,

            'type' => $this->type,

            'body' => $body,

        ];

        return $this->esClient->search($params);
    }


    /**
     * 查询数据
     * 请求参数实例：
     * $es_params['data']: 详细数据 键值对形式
     * $es_params['must_field']: es bool查询must对应字段 ['terms_field'=>['id','pid'],'range_field'=>['ctime','age']] 等
     * $es_params['should_field']: es bool查询should对应字段 ['terms_field'=>['id','pid'],'range_field'=>['ctime','age']] 等
     * $es_params['source_field']: es 查询需要获取的字段
     * $es_params['field_alias']:  查询字段别名 例如 ['a'=>['b','c','d']] 查询时候拼接 a.b=* a.c=*
     */

    public function new_searchEs($es_params)
    {
        extract($es_params);

        if (!isset($field_alias)) {
            $field_alias = [];

        }

        $offset = $data['offset'] ?? 0;

        $limit = $data['limit'] ?? 50;

        $bool = [];

        if (isset($must_field)) {
            $must_condition = $this->_getCondition($data, $must_field, $field_alias);

            if (!empty($must_condition)) {
                $bool['must'] = $must_condition;

            }

        }

        if (isset($should_field)) {
            $should_condition = $this->_getCondition($data, $should_field, $field_alias);

            if (!empty($should_condition)) {
                $bool['should'] = $should_condition;

                $bool['minimum_should_match'] = 1;

            }

        }

        $body = ['from' => $offset, 'size' => $limit];

        if (!empty($bool)) {
            $body['query'] = ['bool' => $bool];

        }


        if (!empty($source_field)) {
            $body['_source'] = $source_field;

        }

        $params = [

            'index' => $this->index,

            'type' => $this->type,

            'body' => $body,

        ];

        return $this->esClient->search($params);
    }


    public function updateByQueryEs($params)
    {
        extract($params);

        $query = $this->_getQueryInfo($condition_data, $condition, $field_alias);

        $script = ['params' => $data, 'lang' => 'painless'];

        $source = [];

        foreach ($data as $key => $value) {
            $source[] = 'ctx._source.' . $key . '=' . 'params.' . $key;

        }

        $script['source'] = implode(';', $source);

        $body = ['script' => $script, 'query' => $query];

        $update_data = [

            'index' => $this->index,

            'type' => $this->type,

            'body' => $body,

        ];

        return $this->esClient->updateByQuery($update_data);
    }


    public function deleteByQueryEs($params)
    {
        extract($params);

        $query = $this->_getQueryInfo($condition_data, $condition, $field_alias);

        $body = ['query' => $query];

        $delete_data = [

            'index' => $this->index,

            'type' => $this->type,

            'body' => $body,

        ];

        return $this->esClient->deleteByQuery($delete_data);
    }


    /**
     * 整理bool查询条件
     * 请求参数实例：
     * $es_params['data']: 详细数据 键值对形式
     * $condition['must_field']: es bool查询must对应字段 ['terms_field'=>['id','pid'],'range_field'=>['ctime','age']] 等
     * $condition['should_field']: es bool查询should对应字段 ['terms_field'=>['id','pid'],'range_field'=>['ctime','age']] 等
     * $field_alias:  查询字段别名 例如 ['a'=>['b','c','d']] 查询时候拼接 a.b=* a.c=*
     */

    private function _getQueryInfo($data, $condition, $field_alias)
    {
        extract($condition);

        $bool = [];

        if (isset($must_field)) {
            $must_condition = $this->_getCondition($data, $must_field, $field_alias);

            if (!empty($must_condition)) {
                $bool['must'] = $must_condition;

            }

        }

        if (isset($should_field)) {
            $should_condition = $this->_getCondition($data, $should_field, $field_alias);

            if (!empty($should_condition)) {
                $bool['should'] = $should_condition;

                $bool['minimum_should_match'] = 1;

            }

        }

        return $bool;
    }


    private function _getCondition($data, $condition_field, $field_alias = [])
    {
        extract($condition_field);

        $condition = [];

        foreach ($data as $key => &$value) {
            $middle_key = $key;

            if (!empty($field_alias)) {
                foreach ($field_alias as $alias_key => $alias_value) {
                    if (in_array($key, $alias_value)) {
                        $middle_key = $alias_key . '.' . $key;

                        break;

                    }

                }

            }

            if (isset($terms_field) && in_array($key, $terms_field)) {
                if (is_int($value)) {
                    $value = (string)$value;

                }

                $condition[] = ['terms' => [$middle_key => explode(',', $value)]];

                continue;

            }

            if (isset($range_field) && in_array($key, $range_field)) {
                list($from, $to) = $value;

                if ($from == 0) {
                    $condition[] = ['range' => [$middle_key => ['lte' => $to]]];

                } else {
                    if ($to == 0) {
                        $condition[] = ['range' => [$middle_key => ['gte' => $from]]];

                    } else {
                        $condition[] = ['range' => [$middle_key => ['gte' => $from, 'lte' => $to]]];

                    }
                }

                continue;

            }

            if (isset($match_field) && in_array($key, $match_field)) {
                $condition[] = ['match' => [$middle_key => $value]];

            }

        }

        return $condition;
    }
}
