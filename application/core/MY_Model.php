<?php

/**
 * Class MY_Model 模型基类
 *
 * @property CI_DB_forge        $dbforge
 * @property CI_Benchmark       $benchmark
 * @property CI_Calendar        $calendar
 * @property CI_Cart            $cart
 * @property CI_Config          $config
 * @property CI_Controller      $controller
 * @property CI_DB_pdo_driver   $db
 * @property CI_Email           $email
 * @property CI_Encrypt         $encrypt
 * @property CI_Exceptions      $exceptions
 * @property CI_Form_validation $form_validation
 * @property CI_Ftp             $ftp
 * @property CI_Hooks           $hooks
 * @property CI_Image_lib       $image_lib
 * @property CI_Input           $input
 * @property CI_Lang            $lang
 * @property CI_Loader          $load
 * @property CI_Log             $log
 * @property CI_Model           $model
 * @property CI_Output          $output
 * @property CI_Pagination      $pagination
 * @property CI_Parser          $parser
 * @property CI_Profiler        $profiler
 * @property CI_Router          $router
 * @property CI_Session         $session
 * @property CI_Table           $table
 * @property CI_Trackback       $trackback
 * @property CI_Typography      $typography
 * @property CI_Unit_test       $unit_test
 * @property CI_Upload          $upload
 * @property CI_URI             $uri
 * @property CI_User_agent      $user_agent
 * @property CI_Xmlrpc          $xmlrpc
 * @property CI_Xmlrpcs         $xmlrpcs
 * @property CI_Zip             $zip
 * @property CI_Javascript      $javascript
 * @property CI_Jquery          $jquery
 * @property CI_Utf8            $utf8
 * @property CI_Security        $security
 * @property User_model         $user_model
 */
class MY_Model extends CI_Model
{
    /**
     * @var string 操作的主表名
     */
    protected $_table;
    /**
     * @var array 左关联查询相关表和条件
     *            ['right_table_name' => 'join_condition']
     *            eg: ['user_profile' => 'user.id = user_profile.id']
     */
    protected $_leftJoin = [];
    /**
     * @var array 右关联查询相关表和条件
     *            ['left_table_name' => 'join_condition']
     *            eg: ['user' => 'user_profile.id = user.id']
     */
    protected $_rightJoin = [];
    /**
     * @var string 查询数据库的字段
     */
    protected $_selectFields = 'id';
    /**
     * @var array 查询条件
     */
    protected $_conditions = [];
    /**
     * @var array 插入的数据
     */
    protected $_insertData = [];
    /**
     * @var array 更新的数据
     */
    protected $_updateData = [];

    /**
     * MY_Model constructor.
     */
    public function __construct()
    {
        parent::__construct();

        // 加载DB类
        $this->load->database();
        // 主表名和调用的模型名相同
        $this->_table = strtolower(substr(get_class($this), 0, -6));
    }

    /**
     * get_page 分页获取模型指定表的数据
     *
     * @param int    $page      第几页
     * @param int    $page_size 页大小,默认为20
     * @param string $order     排序
     * @param array  $where     额外的查询条件
     * @return array 结果集
     */
    public function getPage($page = 0, $page_size = 20, $order = '', $where = [])
    {
        // search
        if (! empty($where)) {
            $this->_conditions = $where;
        }
        // page limit offset
        $page = 0 >= $page ? 1 : $page;
        $limit = 0 >= $page_size ? 20 : $page_size;
        $offset = 0 > $page ? 0 : ($page - 1) * $page_size;
        $this->_conditions['LIMIT'] = [$limit, $offset];
        // order
        $this->_conditions['ORDER'] = empty($order) ? 'created_at DESC' : $order;
        $this->conditions();
        // select
        $select_filed = empty($this->_selectFields) ? 'id' : $this->_selectFields;
        $this->_selectFields = 'id';
        return $this->db->select($select_filed)
            ->from($this->_table)
            ->get()
            ->result_array();
    }

    /**
     * count 查询记录总条数
     *
     * @param bool $clean_up 是否清理查询条件,默认清理
     * @return int 查询记录的总条数
     */
    public function count($clean_up = true)
    {
        $this->conditions($clean_up);

        return $this->db->from($this->_table)
            ->count_all_results();
    }

    /**
     * leftCount 左关联查询总数
     *
     * @param bool $clean_up 是否清理查询条件,默认清理
     *
     * @return bool|int 查询记录的总条数
     */
    public function leftCount($clean_up = true)
    {
        reset($this->_leftJoin);
        $table = key($this->_leftJoin);
        $join_cond = current($this->_leftJoin);
        if (empty($table) || empty($join_cond)) {
            return false;
        }

        $this->conditions($clean_up);
        $this->db->join($table, $join_cond, 'left');
        if (true === $clean_up) {
            $this->_leftJoin = [];
        }

        return $this->db->from($this->_table)
            ->count_all_results();
    }

    public function rightCount($clean_up = true)
    {
        reset($this->_rightJoin);
        $table = key($this->_rightJoin);
        $join_cond = current($this->_rightJoin);
        if (empty($table) || empty($join_cond)) {
            return false;
        }

        $this->conditions($clean_up);
        $this->db->join($table, $join_cond, 'right');
        if (true === $clean_up) {
            $this->_rightJoin = [];
        }

        return $this->db->from($this->_table)
            ->count_all_results();
    }

    /**
     * leftGet 左关联查询单条数据
     *
     * @param bool $clean_up 是否清理查询条件,默认清理
     * @return array|bool
     */
    public function leftGet($clean_up = true)
    {
        reset($this->_leftJoin);
        $table = key($this->_leftJoin);
        $join_cond = current($this->_leftJoin);
        if (empty($table) || empty($join_cond)) {
            return false;
        }

        $this->conditions($clean_up);
        $this->db->join($table, $join_cond, 'left');
        $select_fields = $this->_selectFields;
        if (true === $clean_up) {
            $this->_selectFields = 'id';
            $this->_leftJoin = [];
        }

        return $this->db->select($select_fields)
            ->from($this->_table)
            ->limit(1)
            ->get()
            ->row_array();
    }

    /**
     * rightGet 右关联查询单条数据
     *
     * @param bool $clean_up 是否清理查询条件,默认清理
     * @return array|bool
     */
    public function rightGet($clean_up = true)
    {
        reset($this->_rightJoin);
        $table = key($this->_rightJoin);
        $join_cond = current($this->_rightJoin);
        if (empty($table) || empty($join_cond)) {
            return false;
        }

        $this->conditions($clean_up);
        $this->db->join($table, $join_cond, 'right');
        $select_fields = $this->_selectFields;
        if (true === $clean_up) {
            $this->_selectFields = 'id';
            $this->_rightJoin = [];
        }

        return $this->db->select($select_fields)
            ->from($this->_table)
            ->limit(1)
            ->get()
            ->row_array();
    }

    /**
     * leftRead 左关联查询
     *
     * @param bool $clean_up 是否清理查询条件,默认清理
     * @return array|bool
     */
    public function leftRead($clean_up = true)
    {
        reset($this->_leftJoin);
        $table = key($this->_leftJoin);
        $join_cond = current($this->_leftJoin);
        if (empty($table) || empty($join_cond)) {
            return false;
        }

        $this->conditions($clean_up);
        $this->db->join($table, $join_cond, 'left');
        $select_fields = $this->_selectFields;
        if (true === $clean_up) {
            $this->_selectFields = 'id';
            $this->_leftJoin = [];
        }

        return $this->db->select($select_fields)
            ->from($this->_table)
            ->get()
            ->result_array();
    }

    /**
     * rightRead 右关联查询
     *
     * @param bool $clean_up 是否清理查询条件,默认清理
     * @return array|bool
     */
    public function rightRead($clean_up = true)
    {
        reset($this->_rightJoin);
        $table = key($this->_rightJoin);
        if (empty($table) || $join_cond = current($this->_rightJoin)) {
            return false;
        }

        $this->conditions($clean_up);
        $this->db->join($table, $join_cond, 'right');
        $select_fields = $this->_selectFields;
        if (true === $clean_up) {
            $this->_selectFields = 'id';
            $this->_rightJoin = [];
        }

        return $this->db->select($select_fields)
            ->from($this->_table)
            ->get()
            ->result_array();
    }

    /**
     * delete 根据条件删除数据
     *
     * @param bool $clean_up 是否清理查询条件,默认清理
     * @return bool
     */
    public function delete($clean_up = true)
    {
        $this->conditions($clean_up);
        $data['deleted_at'] = date('Y-m-d H:i:s');

        return $this->db->update($this->_table, $data);
    }

    /**
     * remove 根据ID删除数据
     *
     * @param int  $id       删除的条件主键
     * @param bool $clean_up 是否清理查询条件,默认清理
     * @return bool
     */
    public function remove($id, $clean_up = true)
    {
        if (0 >= $id) {
            return false;
        }

        // 设置修改条件为只有id
        $this->_conditions = [
            'AND' => ['id' => $id,],
        ];
        $this->conditions($clean_up);
        $data['deleted_at'] = date('Y-m-d H:i:s');

        return $this->db->update($this->_table, $data);
    }

    /**
     * update 根据条件更新数据
     *
     * @param array $data     更新的数据
     * @param bool  $clean_up 是否清理查询条件和更新数据,默认清理
     * @return bool
     */
    public function update($data = [], $clean_up = true)
    {
        $data = array_merge($this->_updateData, $data);
        if (empty($data) || ! is_array($data)) {
            return false;
        }

        // 清理
        true === $clean_up && $this->_updateData = [];
        $this->conditions($clean_up);

        return $this->db->update($this->_table, $data);
    }

    /**
     * modify 根据ID修改数据
     *
     * @param int   $id       更新的条件主键
     * @param array $data     更新的数据
     * @param bool  $clean_up 是否清理查询条件和更新数据,默认清理
     * @return bool
     */
    public function modify($id, array $data = [], $clean_up = true)
    {
        if (0 >= $id) {
            return false;
        }

        $data = array_merge($this->_updateData, $data);
        if (empty($data) || ! is_array($data)) {
            return false;
        }
        // 清理
        true === $clean_up && $this->_updateData = [];

        // 设置修改条件为只有id
        $this->_conditions = [
            'AND' => ['id' => $id,],
        ];
        $this->conditions($clean_up);

        return $this->db->update($this->_table, $data);
    }

    /**
     * find 根据数据表的ID查询一条数据
     *
     * @param int  $id       数据ID
     * @param bool $clean_up 是否清理查询条件和查询数据,默认清理
     * @return array|bool 查询的结果集
     */
    public function find($id, $clean_up = true)
    {
        if (0 >= $id) {
            return false;
        }

        $select_fields = $this->_selectFields;
        true === $clean_up && $this->_selectFields = 'id';

        return $this->db->select($select_fields)
            ->from($this->_table)
            ->where(['id' => $id, 'deleted_at' => '0000-00-00 00:00:00'])
            ->limit(1)
            ->get()
            ->row_array();
    }

    /**
     * get 根据条件获取一条数据
     *
     * @param bool $clean_up 是否清理查询条件和查询字段,默认清理
     * @return array 数组结果集
     */
    public function get($clean_up = true)
    {
        $this->conditions($clean_up);
        $this->db->limit(1);
        $select_fields = $this->_selectFields;
        true === $clean_up && $this->_selectFields = 'id';

        return $this->db->select($select_fields)
            ->from($this->_table)
            ->get()
            ->row_array();
    }

    /**
     * read 根据条件获取一组数据
     *
     * @param bool $clean_up 是否清理查询条件和查询字段,默认清理
     * @return array 二维结果集数组
     */
    public function read($clean_up = true)
    {
        $this->conditions($clean_up);
        $select_fields = $this->_selectFields;
        true === $clean_up && $this->_selectFields = 'id';

        return $this->db->select($select_fields)
            ->from($this->_table)
            ->get()
            ->result_array();
    }

    /**
     * create 单条添加数据方法
     *
     * @param array $data     需要插入的数据
     * @param bool  $clean_up 是否清理插入的数据,默认清理
     * @return mixed 成功:插入的主键,失败:false
     */
    public function create(array $data = [], $clean_up = true)
    {
        $data = array_merge($this->_insertData, $data);
        if (empty($data) || ! is_array($data)) {
            return false;
        }

        true === $clean_up && $this->_insertData = [];

        return true === $this->db->insert($this->_table, $data) ? $this->db->insert_id() : false;
    }

    /**
     * createBatch 批量插入数据
     *
     * @param array $data     需要插入的数据,二维数组,每一维代表一条数据
     * @param bool  $clean_up 是否清理插入的数据,默认清理
     * @return mixed 插入的行数或false
     */
    public function createBatch(array $data = [], $clean_up = true)
    {
        $data = array_merge($this->_insertData, $data);
        if (empty($data) || ! is_array($data)) {
            return false;
        }

        true === $clean_up && $this->_insertData = [];

        return $this->db->insert_batch($this->_table, $data);
    }

    /**
     * setAndCond 设置查询的AND条件
     *
     * @param array $condition AND条件数组
     * @return $this|bool
     */
    public function setAndCond(array $condition)
    {
        if (empty($condition) || ! is_array($condition)) {
            return false;
        }
        $this->_conditions['AND'] = $condition;

        return $this;
    }

    /**
     * conditions 设置查询条件
     *
     * @param bool $clean_up 是否清理查询条件,默认清理
     * @return $this|bool
     */
    protected function conditions($clean_up = true)
    {
        if (empty($this->_conditions) || ! is_array($this->_conditions)) {
            return false;
        }

        foreach ($this->_conditions as $condition_k => $condition_v) {
            $conditions[strtoupper($condition_k)] = $condition_v;
        }
        $logical = empty($conditions['AND']) ? 'AND' : 'OR';
        $this->parseConditions($this->_conditions, $logical);
        $this->db->where($this->_table . '.deleted_at', '0000-00-00 00:00:00');
        // 清理查询条件
        true === $clean_up && $this->_conditions = [];

        return $this;
    }

    /**
     * parseConditions 解析传入的条件表达式数组
     *
     * @param array  $conditions 条件表达式数组
     * @param string $logical    当前被解析的表达式数组各元素之间的逻辑关系 ['AND', 'OR']
     * @return bool
     */
    private function parseConditions(array $conditions, $logical)
    {
        if (empty($conditions) || ('AND' != $logical && 'OR' != $logical)) {
            return false;
        }

        // 对 conditions 条件数组按照规则进行解析
        foreach ($conditions as $condition_k => $condition_v) {
            switch (strtoupper($condition_k)) {
                case 'AND':
                case 'OR':
                    if ('AND' == $logical) {
                        $this->db->group_start();
                    } else {
                        $this->db->or_group_start();
                    }
                    $this->parseConditions($condition_v, $condition_k);
                    $this->db->group_end();
                    break;
                case 'GROUP':
                    $this->db->group_by($condition_v);
                    break;
                case 'ORDER':
                    $this->db->order_by($condition_v);
                    break;
                case 'LIMIT' :
                    if (is_array($condition_v)) {
                        $this->db->limit($condition_v[0], $condition_v[1]);
                    } else {
                        $this->db->limit($condition_v);
                    }
                    break;
                default:
                    $this->parseConditionOperator($logical, $condition_k, $condition_v);
                    break;
            }
        }

        return true;
    }

    /**
     * parseConditionOperator 条件表达式的符号运算规则解析
     *
     * @param string $logical    逻辑运算符['AND', 'OR']
     * @param string $expression 表达式
     * @param mixed  $value      值
     * @return bool
     */
    private function parseConditionOperator($logical, $expression, $value)
    {
        $logical = strtoupper($logical);
        if ('AND' != $logical && 'OR' != $logical || empty($expression)) {
            return false;
        }

        // 区分出字段名和操作符
        $expression_array = explode(' ', $expression);
        $field = $expression_array[0]; // 字段名
        $operator = empty($expression_array[1]) ? '=' : $expression_array[1]; // 操作符
        $supported_operator = [
            '=',
            '!=',
            '>',
            '>=',
            '<',
            '<=',
            '[]',
            '![]',
            '<>',
            '!<>',
            '%*',
            '*%',
            '%%',
            '!%*',
            '!*%',
            '!%%',
        ];
        if (empty($field) || ! in_array($operator, $supported_operator)) {
            return false;
        }

        // 根据具体的操作符选择执行的条件
        switch ($operator) {
            case '=':
            case '!=':
            case '>':
            case '>=':
            case '<':
            case '<=':
                if ('AND' == $logical) {
                    $this->db->where($expression, $value);
                } else {
                    if ('OR' == $logical) {
                        $this->db->or_where($expression, $value);
                    }
                }
                break;
            case '[]': // IN
                if ('AND' == $logical) {
                    $this->db->where_in($field, $value);
                } else {
                    if ('OR' == $logical) {
                        $this->db->or_where_in($field, $value);
                    }
                }
                break;
            case '![]': // NOT IN
                if ('AND' == $logical) {
                    $this->db->where_not_in($field, $value);
                } else {
                    if ('OR' == $logical) {
                        $this->db->or_where_not_in($field, $value);
                    }
                }
                break;
            case '<>':  // BETWEEN AND
                if ('AND' == $logical) {
                    $this->db->where("{$field} BETWEEN  {$value[0]} AND {$value[1]}");
                } else {
                    if ('OR' == $logical) {
                        $this->db->or_where("{$field} BETWEEN  {$value[0]} AND {$value[1]}");
                    }
                }
                break;
            case '!<>':  // NOT BETWEEN AND
                if ('AND' == $logical) {
                    $this->db->where("{$field} NOT BETWEEN  {$value[0]} AND {$value[1]}", null, false);
                } else {
                    if ('OR' == $logical) {
                        $this->db->or_where("{$field} NOT BETWEEN  {$value[0]} AND {$value[1]}", null, false);
                    }
                }
                break;
            case '%*':  // LIKE '%words'
                if ('AND' == $logical) {
                    $this->db->like($field, $value, 'before');
                } else {
                    if ('OR' == $logical) {
                        $this->db->or_like($field, $value, 'before');
                    }
                }
                break;
            case '*%':  // LIKE 'words%'
                if ('AND' == $logical) {
                    $this->db->like($field, $value, 'after');
                } else {
                    if ('OR' == $logical) {
                        $this->db->or_like($field, $value, 'after');
                    }
                }
                break;
            case '%%':  // LIKE '%words%'
                if ('AND' == $logical) {
                    $this->db->like($field, $value, 'both');
                } else {
                    if ('OR' == $logical) {
                        $this->db->or_like($field, $value, 'both');
                    }
                }
                break;
            case '!%*':  // NOT LIKE '%words'
                if ('AND' == $logical) {
                    $this->db->not_like($field, $value, 'before');
                } else {
                    if ('OR' == $logical) {
                        $this->db->or_not_like($field, $value, 'before');
                    }
                }
                break;
            case '!*%':  // NOT LIKE 'words%'
                if ('AND' == $logical) {
                    $this->db->not_like($field, $value, 'after');
                } else {
                    if ('OR' == $logical) {
                        $this->db->or_not_like($field, $value, 'after');
                    }
                }
                break;
            case '!%%':  // NOT LIKE '%words%'
                if ('AND' == $logical) {
                    $this->db->not_like($field, $value, 'both');
                } else {
                    if ('OR' == $logical) {
                        $this->db->or_not_like($field, $value, 'both');
                    }
                }
                break;
        }

        return true;
    }

    /**
     * query 执行sql语句
     *
     * @param string $sql
     * @return array
     */
    public function query($sql)
    {
        return $this->db->query($sql)->result_array();
    }

    /**
     * last_query 最后一次查询预约
     *
     * @return string
     */
    public function last_query()
    {
        return $this->db->last_query();
    }

    /**
     * print_query 打印最后一条查询语句
     *
     * @return $this
     */
    public function print_query()
    {
        echo $this->last_query();
        return $this;
    }

    /**
     * print_query_error 打印查询错误
     *
     * @return $this
     */
    public function print_query_error()
    {
        var_dump($this->db->error());
        return $this;
    }

    /**
     * setUpdateData
     *
     * @param array $updateData
     * @return $this
     */
    public function setUpdateData(array $updateData)
    {
        $this->_updateData = $updateData;
        return $this;
    }

    /**
     * setInsertData
     *
     * @param array $insertData
     * @return $this
     */
    public function setInsertData($insertData)
    {
        $this->_insertData = $insertData;
        return $this;
    }

    /**
     * setConditions
     *
     * @param array $conditions
     * @return $this
     */
    public function setConditions(array $conditions)
    {
        $this->_conditions = $conditions;
        return $this;
    }

    /**
     * setSelectFields
     *
     * @param string $selectFields
     * @return $this
     */
    public function setSelectFields($selectFields)
    {
        $this->_selectFields = $selectFields;
        return $this;
    }

    /**
     * setTable
     *
     * @param string $table_name
     * @return $this
     */
    public function setTable($table_name)
    {
        $this->_table = $table_name;
        return $this;
    }

    /**
     * setLeftJoin
     *
     * @param array $leftJoin
     * @return MY_Model
     */
    public function setLeftJoin(array $leftJoin)
    {
        $this->_leftJoin = $leftJoin;
        return $this;
    }

    /**
     * setRightJoin
     *
     * @param array $rightJoin
     * @return MY_Model
     */
    public function setRightJoin(array $rightJoin)
    {
        $this->_rightJoin = $rightJoin;
        return $this;
    }
}
